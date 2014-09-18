<?php
/**
 * Fichier pour lancer l'installation de Epicenote (et oui il faut bien)
 *
 * C'est un fichier d'installation en un seul fichier et sans utiliser de lib
 * du coup c'est un peu le "bazare" mais ça ouvre la possibilité de faire un
 * updateur online pour l'installation.
 */
session_start();
define('DS', DIRECTORY_SEPARATOR);
define('NPE_INDEX', true);

//Variables par défaut
$variables = array(
    'dsn' => 'mysql:host=localhost;dbname=epicenote',
    'db_user' => 'epicenote',
    'db_pass' => 'epicenote',
    'env' => 'def',
    'urlbase' => 'index.php?',
    'srcdir' => '..' . DIRECTORY_SEPARATOR . 'src',
    'tmpdir' => '..' . DIRECTORY_SEPARATOR . 'tmp',
    'admin_user' => null,
    'admin_pass' => null,
);

$defined = array();

$valid = array();

foreach (array_keys($variables) as $var) {
    $defined[$var] = isset($_SESSION[$var]);
    $valid[$var] = true; // C'est juste une initialisation
}

// Variables sans vérification
foreach (array('env', 'urlbase', 'admin_user', 'admin_pass') as $var)
    if (isset($_POST[$var]))
        $_SESSION[$var] = $_POST[$var];

// vérification du répertoire de destination
if (isset($_POST['srcdir']))
    if (file_exists($_POST['srcdir'] . DIRECTORY_SEPARATOR . 'loader.php'))
        $_SESSION['srcdir'] = $_POST['srcdir'];

// vérification du dossier temporaire
if (isset($_POST['tmpdir'])) {
    if (!file_exists($_POST['tmpdir']))
        mkdir($_POST['tmpdir'], 0777);
    if (is_dir($_POST['tmpdir']) && !is_writable($_POST['tmpdir']))
        chmod($_POST['tmpdir'], 0777);
    if (file_exists($_POST['tmpdir']) && is_dir($_POST['tmpdir']) && is_writable($_POST['tmpdir']))
        $_SESSION['tmpdir'] = $_POST['tmpdir'];
}

// vérification de la configuration BDD
if (isset($_POST['dsn'], $_POST['db_user'], $_POST['db_pass'])) {
    try {
        $pdo = new PDO($_POST['dsn'], $_POST['db_user'], $_POST['db_pass']);
        $_SESSION['dsn'] = $_POST['dsn'];
        $_SESSION['db_user'] = $_POST['db_user'];
        $_SESSION['db_pass'] = $_POST['db_pass'];
    } catch (PDOException $e) {
        // Erreur de connexion
    }
}

// installation BDD
if (isset($_GET['etape']) && $_GET['etape'] == 'dbsync') {
    extract($_SESSION);
    $root = $srcdir . DS;
    require_once $root . 'libs' . DS . 'spyc.php';
    require_once $root . 'libs' . DS . 'common.php';
    require_once $root . 'libs' . DS . 'models.php';
    $pdo = new PDO($dsn, $db_user, $db_pass);

    $need_tables = array();
    $define_tables = mdle_get_tables();
    foreach (mdle_get_tables() as $t)
        $need_tables[] = $t['name'];
    $installed_tables = array();
    $sql = $pdo->query('SHOW TABLES');
    while ($t = $sql->fetch())
        $installed_tables[] = $t[0];
    $delete_tables = array_diff($installed_tables, $need_tables);
    $install_tables = array_diff($need_tables, $installed_tables);
    $verify_tables = array_intersect($need_tables, $installed_tables);

    $modify_tables = array();
    foreach ($verify_tables as $table) {
        $sql = $pdo->query("SHOW COLUMNS FROM $table");
        $fields = array();
        $modify_fields = array();
        while ($c = $sql->fetch()) {
            $fields[] = $c['Field'];
            if ($c['Type'] != mdle_field_type($define_tables[$table], $c['Field']))
                $modify_fields[] = $c['Field'];
            elseif (isset($define_tables[$table]['fields'][$c['Field']]['null']) && $c['Null'] != 'YES')
                $modify_fields[] = $c['Field'];
        }
        $del_fields = array_diff($fields, array_keys($define_tables[$table]['fields']));
        $add_fields = array_diff(array_keys($define_tables[$table]['fields']), $fields);
        if (count($add_fields) + count($del_fields) + count($modify_fields) != 0) {
            $modify_tables[] = array(
                'table' => $table,
                'add' => $add_fields,
                'del' => $del_fields,
                'modify' => $modify_fields,
            );
        }
    }

    $sql_queries = array();
    foreach ($delete_tables as $table)
        $sql_queries[] = "DROP TABLE $table";

    foreach ($install_tables as $table)
        $sql_queries[] = mdle_sql_create($define_tables[$table]);

    foreach ($modify_tables as $tdef) {
        $sql = 'ALTER TABLE `' . $tdef['table'] . "`";
        $first = true;
        foreach ($tdef['del'] as $col) {
            if ($first)
                $first = false;
            else
                $sql .= ',';
            $sql .= "\n    DEL `$col`";
        }
        foreach ($tdef['add'] as $col) {
            if ($first)
                $first = false;
            else
                $sql .= ',';
            $sql .= "\n    ADD `$col` ";
            $sql .= mdle_sql_fielddef($define_tables[$tdef['table']], $col);
        }
        foreach ($tdef['modify'] as $col) {
            if ($first)
                $first = false;
            else
                $sql .= ',';
            $sql .= "\n    MODIFY `$col` ";
            $sql .= mdle_sql_fielddef($define_tables[$tdef['table']], $col);
        }
        $sql_queries[] = $sql;
    }

    if (isset($_POST['installed'])) {
        $pdo->beginTransaction();
        foreach ($sql_queries as $sql)
            if ($pdo->exec($sql) === false)
                $valid[] = false;

        // Ajout du compte admin
        $sql = $pdo->prepare('SELECT * FROM users WHERE user_name = ?');
        $sql->bindValue(1, $_SESSION['admin_user']);
        $sql->execute();
        if ($sql->rowCount() == 0 && $_SESSION['admin_user'] != '' && $_SESSION['admin_pass'] != '') {
            $sql = $pdo->prepare('INSERT INTO users (user_name, user_pass, user_firstname, user_lastname, user_type, user_login, user_email, user_phone, user_role) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
            $sql->bindValue(1, $_SESSION['admin_user']);
            $sql->bindValue(2, $_SESSION['admin_pass']);
            $sql->bindValue(3, 'Admin');
            $sql->bindValue(4, 'Admin');
            $sql->bindValue(5, 0);
            $sql->bindValue(6, $_SESSION['admin_user']);
            $sql->bindValue(7, 'root@localhost');
            $sql->bindValue(8, '0000000000');
            $sql->bindValue(9, 'ADMINISTRATOR');
            if (!$sql->execute())
                $valid[] = false;
        }
        // TODO : il y a surement d'autres choses à faire mais bon...
        if ($pdo->commit() === false)
            $valid[] = false;
        if (count(array_keys($valid, false)) == 0)
            $_SESSION['installed'] = true;
    }
}

// installation BDD
if (isset($_GET['etape']) && $_GET['etape'] == 'configwrite') {
    $configwrite = '<?php

/**
 * Liste des paramètres
 */

// Chaine de connexion SQL
$dsn = \'' . addslashes($_SESSION['dsn']) . '\';

// Utilisateur SQL
$db_user = \'' . addslashes($_SESSION['db_user']) . '\';

// Mot de passe SQL
$db_pass = \'' . addslashes($_SESSION['db_pass']) . '\';

// Environnement
$env = \'' . addslashes($_SESSION['env']) . '\';

// Base des URLs
$urlbase = \'' . addslashes($_SESSION['urlbase']) . '\';

// Options de base des URLs
$urlops = array();

// Dossier des sources
$srcdir = \'' . addslashes($_SESSION['srcdir']) . '\';

// Dossier des fichiers temporaires
$tmpdir = \'' . addslashes($_SESSION['tmpdir']) . '\';

';
    if (isset($_POST['configwrite'])) {
        $valid[] = file_put_contents('bootstrap.php', $configwrite);
        if (count(array_keys($valid, false)) == 0)
            $_SESSION['configured'] = true;
    }
}

// Variables définies
foreach (array_keys($variables) as $var) {
    if (isset($_SESSION[$var]))
        $variables[$var] = $_SESSION[$var];
    if (isset($_POST[$var]) && (!isset($_SESSION[$var]) || $_POST[$var] != $_SESSION[$var]))
        $valid[$var] = false;
    if (isset($_POST[$var]))
        $variables[$var] = $_POST[$var];
}

// On détermine où nous en sommes
$etape = 1;
if (isset($_SESSION['srcdir'], $_SESSION['tmpdir']))
    $etape = 2;
if ($etape == 2 && isset($_SESSION['dsn'], $_SESSION['db_user'], $_SESSION['db_pass']))
    $etape = 3;
if ($etape == 3 && isset($_SESSION['urlbase'], $_SESSION['env']))
    $etape = 4;
if ($etape == 4 && isset($_SESSION['admin_user'], $_SESSION['admin_pass']))
    $etape = 5;
if ($etape == 5 && isset($_SESSION['installed']))
    $etape = 6;
if ($etape == 6 && isset($_SESSION['configured']))
    $etape = 7;

// Liste des pages de l'install
$pages = array(1 => 'dirselect', 2 => 'dbconfig', 3 => 'serverconfig', 4 => 'userinfo', 5 => 'dbsync', 6 => 'configwrite', 7 => 'endinstall');
$transition = array('dirselect' => 'dbconfig', 'dbconfig' => 'serverconfig', 'serverconfig' => 'userinfo', 'userinfo' => 'dbsync', 'dbsync' => 'configwrite', 'configwrite' => 'endinstall', 'endinstall' => 'endinstall');

$titles = array('dirselect' => 'Selection des dossiers', 'dbconfig' => 'Information BDD', 'serverconfig' => 'Information système', 'userinfo' => 'Compte admin', 'dbsync' => 'Mise à jour des tables', 'configwrite' => 'Ecriture configuration', 'endinstall' => 'Fin de l\'installation');

// Première page ? On va sur la selection des dossiers
if (!isset($_GET['etape']) || !in_array($_GET['etape'], $pages)) {
    header('Location: install.php?etape=dirselect');
    exit();
}

// Si formulaire et tout valide
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !in_array(false, $valid)) {
    header('Location: install.php?etape=' . $transition[$_GET['etape']]);
    exit();
}

// Pas la charrue avant les beoufs, on retourne sur la bonne voie
$index = array_keys($pages, $_GET['etape']);
if ($etape < $index[0]) {
    header('Location: install.php?etape=' . $pages[$etape]);
    exit();
}

/*
 * --------------------------------------
 * Fonctions utilisés pour le template
 * --------------------------------------
 */

function tpl_form_field($name, $desc, $type = 'text') {
    global $variables, $valid;
    ?>
    <div class="form-group<?php if (!$valid[$name]) echo ' has-error'; ?>">
      <label for="<?php echo $name; ?>"><?php echo $desc; ?></label>
      <input type="<?php echo $type; ?>" class="form-control" id="<?php echo $name; ?>" name="<?php echo $name; ?>" placeholder="<?php echo $desc; ?>" value="<?php echo $variables[$name]; ?>">
    </div>
    <?php
}

function tpl_menu_item($name) {
    global $etape, $titles, $pages;

    $index = array_keys($pages, $name);

    echo '<li class="';
    if ($etape < $index[0])
        echo 'disabled"><a href="#">';
    elseif ($name == $_GET['etape'])
        echo ' active disabled"><a href="#">';
    else
        echo '"><a href="install.php?etape=' . $name . '">';

    echo $titles[$name];
    echo '</a></li>';
}

/*
 * --------------------------------------
 * Pages
 * --------------------------------------
 */

function tpl_pge_dirselect() {
    extract($GLOBALS);
    if (count(array_keys($valid, false))) {
        echo '<div class="alert alert-warning"><h4>Information erronée</h4><p>Les champs en rouge sont invalides</p></div>';
    }
    ?>

    <h2><?php echo $titles['dirselect']; ?></h2>
    <form role="form" method="POST" action="install.php?etape=dirselect">
        <?php
        tpl_form_field('srcdir', 'Dossier des fichiers source');
        tpl_form_field('tmpdir', 'Dossier des fichiers temporaires');
        ?>
      <button type="submit" class="btn btn-default">Valider</button>
    </form>


    <?php
}

function tpl_pge_dbconfig() {
    extract($GLOBALS);
    if (count(array_keys($valid, false))) {
        echo '<div class="alert alert-warning"><h4>Information erronée</h4><p>Les champs en rouge sont invalides</p></div>';
    }
    ?>

    <h2><?php echo $titles['dbconfig']; ?></h2>
    <form role="form" method="POST" action="install.php?etape=dbconfig">
        <?php
        tpl_form_field('dsn', 'Adresse de la base de donnée');
        tpl_form_field('db_user', 'Utilisateur de la BDD');
        tpl_form_field('db_pass', 'Mot de passe BDD', 'password');
        ?>
      <button type="submit" class="btn btn-default">Valider</button>
    </form>


    <?php
}

function tpl_pge_serverconfig() {
    extract($GLOBALS);
    ?>

    <h2><?php echo $titles['serverconfig']; ?></h2>
    <form role="form" method="POST" action="install.php?etape=serverconfig">
        <?php
        tpl_form_field('urlbase', 'Base des URL (si url rewrite)');
        tpl_form_field('env', 'Environnement');
        ?>
      <button type="submit" class="btn btn-default">Valider</button>
    </form>


    <?php
}

function tpl_pge_userinfo() {
    extract($GLOBALS);
    ?>
    <h2><?php echo $titles['userinfo']; ?></h2>
    <form role="form" method="POST" action="install.php?etape=userinfo">
        <?php
        tpl_form_field('admin_user', 'Utilisateur admin');
        tpl_form_field('admin_pass', 'Mot de passe admin', 'password');
        ?>
      <button type="submit" class="btn btn-default">Valider</button>
    </form>


    <?php
}

function tpl_pge_dbsync() {
    extract($GLOBALS);
    ?>
    <h2><?php echo $titles['dbsync']; ?></h2>
    <?php
    if (count(array_keys($valid, false))) {
        echo '<div class="alert alert-warning"><h4>Erreur SQL</h4><p>Une erreur d\'exécution SQL s\'est produite.</p><p>' . nl2br(print_r($pdo->errorInfo(), true)) . '</p></div>';
    }
    ?>
    <form role="form" method="POST" action="install.php?etape=dbsync">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#settings" data-toggle="tab">Paramètres</a></li>
        <li><a href="#tables" data-toggle="tab">Tables</a></li>
        <li><a href="#columns" data-toggle="tab">Colonnes</a></li>
        <li><a href="#sql" data-toggle="tab">Requêtes SQL</a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="settings">
          <h3>Paramètres</h3>
          <p>L'installation va commencer avec les paramètres suivantes :</p>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Variable</th>
                <th>Valeur</th>
              </tr>
            </thead>
            <tbody>
                <?php
                foreach ($variables as $var => $val) {
                    echo '<tr><td>' . $var . '</td><td>';
                    if (!in_array($var, array('admin_pass', 'db_pass')))
                        echo $val;
                    else
                        echo '******';
                    echo '</td></tr>';
                }
                ?>
            </tbody>
          </table>
        </div>
        <div class="tab-pane" id="tables">
          <h3>Vérification des tables</h3>
          <p>L'installation va effectuer les actions suivantes sur les tables :</p>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Table</th>
                <th>Fichier</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                <?php
                foreach ($delete_tables as $table) {
                    echo "<tr><td>$table</td><td><span class=\"text-muted\"><em>#NDEF</em></span></td><td><span class=\"label label-danger\">Supression</span></td></tr>";
                }
                foreach ($install_tables as $table) {
                    echo "<tr><td>$table</td><td>" . $define_tables[$table]['file'] . "</td><td><span class=\"label label-success\">Création</span></td></tr>";
                }
                foreach ($modify_tables as $table) {
                    echo "<tr><td>$table[table]</td><td>" . $define_tables[$table['table']]['file'] . "</td><td><span class=\"label label-warning\">Modification</span></td></tr>";
                }
                ?>
            </tbody>
          </table>
        </div>
        <div class="tab-pane" id="columns">
          <h3>Vérification des colonnes</h3>
          <p>L'installation va effectuer les actions suivantes sur les colonnes :</p>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Table</th>
                <th>Colonne</th>
                <th>Fichier</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                <?php
                foreach ($modify_tables as $tdef) {
                    foreach ($tdef['add'] as $col)
                        echo "<tr><td>$tdef[table]</td><td>$col</td><td>" . $define_tables[$tdef['table']]['file'] . "</td><td><span class=\"label label-success\">Ajout</span></td></tr>";
                    foreach ($tdef['del'] as $col)
                        echo "<tr><td>$tdef[table]</td><td>$col</td><td>" . $define_tables[$tdef['table']]['file'] . "</td><td><span class=\"label label-danger\">Suppression</span></td></tr>";
                    foreach ($tdef['modify'] as $col)
                        echo "<tr><td>$tdef[table]</td><td>$col</td><td>" . $define_tables[$tdef['table']]['file'] . "</td><td><span class=\"label label-warning\">Modification</span></td></tr>";
                }
                ?>
            </tbody>
          </table>
        </div>
        <div class="tab-pane" id="sql">
          <h3>Requêtes SQL à exécuter</h3>
          <p>Voilà le fichier SQL généré qui sera exécuté sur la base de donnée.</p>
          <p><pre>
                                # ------------------------------------------------------------
                                # Fichier SQL généré par le système d'installation automatique
                                # @Copyright bonnetlive
                                # ------------------------------------------------------------

            <?php
            echo "\n";
            foreach ($sql_queries as $query) {
                echo "$query;\n\n";
            }
            ?>
          </pre></p>
        </div>
      </div>
      <input type="hidden" name="installed" value="true">
      <button type="submit" class="btn btn-default">Valider</button>
    </form>


    <?php
}

function tpl_pge_configwrite() {
    extract($GLOBALS);
    if (count(array_keys($valid, false))) {
        echo '<div class="alert alert-warning"><h4>Erreur d\'écriture</h4><p>Le fichier de configuration n\'a pas pu être écrit</p></div>';
    }
    ?>
    <h2><?php echo $titles['dbsync']; ?></h2>
    <p>Voilà le fichier de configuration <code>bootstrap.php</code></p>
    <pre>
        <?php
        echo htmlentities($configwrite);
        ?>
    </pre>
    <br/>
    <form method="POST" action="install.php?etape=configwrite">
      <input type="hidden" name="configwrite" value="true" />
      <button type="submit"class="btn btn-default">Ecrire la configuration</button>
    </form>
    <?php
}

function tpl_pge_endinstall() {
    global $titles;
    ?>
    <h2><?php echo $titles['endinstall']; ?></h2>
    <p>Bravo ! votre site est installé !</p>
    <?php
}
?>
<html>
  <head>
    <title>Installation de EpiceNote (intranet)</title>
    <!-- Css -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-select.css" rel="stylesheet">
    <!-- /Css -->
    <!-- Scripts -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap-select.js"></script>
    <!-- /Scripts -->

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body background="../images/bg3.png" style="background-attachment: fixed; width: 100%; height: 100%; background-position: top center; z-index: 1; position: relative;">
    <nav class="navbar navbar-default" role="navigation">
      <div class="navar-header">
        <a class="navbar-brand" href="install.php">EpiceNotator Install</a>
      </div>
      <div class="collapse navbar-collapse navbar-ex1-collapse" >
        <ul class="nav navbar-nav">
          <li><a href="index.php">Page d'accueil</a></li>
        </ul>
      </div>
    </nav>
    <div class="container-fluid">
      <div class="row-fluid">
        <div class="col-xs-2" style="background: #faf2cc">
          <h2>Menu</h2>
          <ul class="nav nav-pills nav-stacked">
              <?php
              foreach ($pages as $item)
                  tpl_menu_item($item);
              ?>
          </ul>
        </div>
        <div class="col-xs-10">
          <h1>Installation Epicenote</h1>
          <?php call_user_func('tpl_pge_' . $_GET['etape']); ?>
        </div>
      </div>
    </div>
  </body>
</html>