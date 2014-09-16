<?php

/**
 * Fonctions de base du framework
 * Fichier avec les fonctions permettant le fonctionnement par défaut de l'app.
 * @package FrameTool
 */
/**
 */
/**
 * Niveau d'accès pour les visiteurs non connectés
 */
define('ACL_ANNONYMOUS', 0);

/**
 */
/**
 * Niveau d'accès pour les utilisateurs enregistré mais non membre
 */
define('ACL_GUEST', 1);

/**
 * Niveau d'accès pour les membres
 */
define('ACL_USER', 2);

/**
 * Niveau d'accès pour les membres avec surclassement par un module
 * Ce niveau d'accès particulier est donné par un module lors de son chargement si l'utilisateur peut réaliser des actions spéciales sur ce module. Par exemple, pour une section, l'utilisateur qui est "responsable de section" va avoir ce niveau sur toutes les pages qui concerne sa section.
 */
define('ACL_SUPERUSER', 3);

/**
 * Niveau d'accès pour les administrateurs
 */
define('ACL_ADMINISTRATOR', 4);

/**
 * Pour récupérer la valeur numérique associé à un rôle
 * @param type $txt
 */
function aclFromText($txt) {
    if ($txt == "ANNONYMOUS")
        return ACL_ANNONYMOUS;
    if ($txt == "GUEST")
        return ACL_GUEST;
    if ($txt == "USER")
        return ACL_USER;
    if ($txt == "SUPERUSER")
        return ACL_SUPERUSER;
    return ACL_ADMINISTRATOR;
}

/**
 * Test si l'utilisateur a un niveau d'accès
 * @param type $acl
 * @return type
 */
function hasAcl($acl) {
    if (!isset($_SESSION['user']) || $_SESSION['user'] == false || !isset($_SESSION['user']['role']))
        $user = ACL_ANNONYMOUS;
    else
        $user = $_SESSION['user']['role'];
    return $user >= $acl;
}

/**
 * Affiche une page d'erreur si le niveau d'accès de l'utilisateur
 * est trop faible
 * @param type $acl
 */
function needAcl($acl) {
    if (!hasAcl($acl))
        modexec('syscore', 'forbidden');
}

/**
 * Permet de cacher quelque chose en fonction de l'accréditation
 *
 * __Dans le template __
 * SYNTAXE1 :
 * {acl level="ADMINISTRATOR"}...{/acl}
 * Pour s'afficher il faut le niveau demandé. Level peut être :
 * ADMINISTRATOR, SUPERUSER, USER, GUEST, ANNONYMOUS
 *
 * SYNTAXE2:
 * {acl action="act" page="pge"}..{/acl}
 * Pour s'afficher, l'utilisateur doit avoir les accès à la page pge de l'action
 * act.
 *
 * @param type $params
 * @param type $content
 * @param type $smarty
 * @param type $repeat
 * @return type
 */
function acl_smarty($params, $content, $smarty, &$repeat) {
    if (isset($content)) {
        $need = ACL_ADMINISTRATOR;
        if (isset($params['level']))
            $need = aclFromText($params['level']);
        if (!isset($params['page']))
            $params['page'] = 'index';
        if (isset($params['action']))
            $need = getAclLevel($params['action'], $params['page']);

        if (hasAcl($need))
            return $content;
        else
            return '';
    }
}

/**
 * Récupère le niveau nécessaire pour aller effectuer une action
 * @global type $pdo
 * @param type $action
 * @param type $page
 * @return string
 */
function getAclLevel($action, $page) {
    global $pdo;

    //Pour certain cas c'est vu d'avance
    if ($action == "admin")
        return ACL_ADMINISTRATOR;
    if ($action == "index")
        return ACL_ANNONYMOUS;

    //Pour le reste ...
    $sql = $pdo->prepare('SELECT * FROM acces WHERE acl_action = ? AND acl_page = ?');
    $sql->bindValue(1, $action);
    $sql->bindValue(2, $page);
    $sql->execute();

    if ($acl = $sql->fetch()) {
        return aclFromText($acl['acl_acces']);
    } else {
        // En fait ça c'est pour le gros fénéant qui veut remplir sa base d'accès
        // tout seul
        $sql = $pdo->prepare('INSERT INTO acces (acl_action, acl_page) VALUES (?, ?)');
        $sql->bindValue(1, $action);
        $sql->bindValue(2, $page);
        $sql->execute();
        return ACL_ADMINISTRATOR;
    }
}

/**
 * Permet de créer des URL pour le framework
 * @global type $urlops
 * @global type $urlbase
 * @param type $page
 * @param type $options
 * @return string
 */
function mkurl($action, $page = 'index', $options = null) {
    global $urlops, $urlbase;

    if ($options == null)
        $options = array();

    $data = array_merge($urlops, $options);
    ksort($data);

    $url = $urlbase . 'action=' . urlencode($action);
    $url .= '&page=' . urlencode($page);
    foreach ($data as $key => $val)
        $url.= '&' . urlencode($key) . '=' . urlencode($val);

    return $url;
}

/**
 * Ajout de la fonction mkurl dans le moteur Smarty
 * La fonction mkurl permet de créer des liens beaucoup plus rapidement sur les templates.
 */
function mkurl_smarty($params, $smarty) {
    $action = $params['action'];
    unset($params['action']);
    $page = 'index';
    if (isset($params['page'])) {
        $page = $params['page'];
        unset($params['page']);
    }

    //Petit troll pour les accès refusés :
    if (!hasAcl(getAclLevel($action, $page)))
        return '#';

    return mkurl($action, $page, $params);
}

/**
 * Permet de quitter proprement le CMS
 */
function quit() {
    exit();
}

/**
 * Redirige l'utilisateur.
 * @param type $page
 * @param type $options
 */
function redirect($action, $page = 'index', $options = null) {
    $url = mkurl($action, $page, $options);
    header("Location: $url");
    quit();
}

/**
 * Laisser la possibilité à un module de gérer sa sécurité
 * @global type $root
 * @param type $action
 * @param type $page
 */
function modsecu($action, $page = 'index') {
    global $root;

    include_once $root . 'action' . DS . $action . '.php';

    if (function_exists($action . '_security')) {
        call_user_func($action . '_security', $page);
    }
}

/**
 * Execute un controleur
 * @global type $root
 * @param type $action
 * @param type $page
 */
function modexec($action, $page = 'index') {
    global $root, $exec_mod, $exec_action;

    include_once $root . 'action' . DS . $action . '.php';

    $exec = false;
    if (function_exists($action . '_autoload')) {
        call_user_func($action . '_autoload', $page);
        $exec = true;
    }
    if (function_exists($action . '_' . $page)) {
        $exec_mod = $action;
        $exec_action = $page;
        call_user_func($action . '_' . $page);
        $exec = true;
    }

    if ($exec == false) {
        modexec('syscore', 'nopage');
    }
}

/**
 * Génère une URL de la même page avec des paramètres différents
 * @param type $options
 */
function urldup($options) {
    $opt = $_GET;
    unset($opt['action']);
    unset($opt['page']);
    $opt = array_merge($opt, $options);

    $action = 'index';
    if (isset($_GET['action']))
        $action = $_GET['action'];

    $page = 'index';
    if (isset($_GET['page']))
        $page = $_GET['page'];

    return mkurl($action, $page, $opt);
}

/**
 * Cette fonction un peu pratique permet d'insérer en BDD des données
 * à partir d'un formulaire.
 * @global type $pdo
 * @param type $table
 * @param type $prefix
 * @param array $extra
 * @return type
 */
function autoInsert($table, $prefix, $extra = null) {
    global $pdo;

    if ($extra == null)
        $extra = array();
    $data = array();
    foreach ($_REQUEST as $var => $val) {
        if ($prefix == substr($var, 0, strlen($prefix))) {
            if (preg_match('/^[0-9a-zA-Z_]*$/', $var))
                $data[$var] = $val;
            else
                echo "Skip $var;";
        }
    }

    $data = array_merge($data, $extra);
    foreach ($data as &$val)
        $val = $pdo->quote($val);

    $sql = 'INSERT INTO `' . $table . '` (`';
    $sql .= implode('`, `', array_keys($data));
    $sql .= '`) VALUES (';
    $sql .= implode(', ', array_values($data));
    $sql .= ')';

    return $pdo->exec($sql);
}

/**
 * Petite classe très pratique qui permet de créer un gestionnaire de page
 * facilement.
 */
class SimplePager {

    /**
     * numéro du premier enregistrement
     * @var type
     */
    protected $start;

    /**
     * Nombre d'enregistrements par page
     * @var type
     */
    protected $nbByPage;

    /**
     * Prefix des variables pour ce pager
     * @var type
     */
    protected $prepose;

    /**
     * Requete SQL contenant la limite préparé avec PDO
     * @var type
     */
    protected $sql;

    /**
     * Requete SQL préparé avec PDO qui servira à compter les enregistrements
     * @var type
     */
    protected $sqlCount;

    /**
     * Petit racourcis pour avoir la variable du numéro de page
     * @var type
     */
    protected $key;

    /**
     * On construit le pager
     *
     * @global type $pdo
     * @param type $table
     * @param type $where
     * @param type $id
     * @param type $nbpage
     */
    public function __construct($table, $where = '', $id = 'p', $nbpage = 50) {
        global $pdo;

        $this->prepose = $id;
        $this->key = $this->prepose . 'id';
        $this->nbByPage = $nbpage;

        $sqlInner = ' FROM `' . $table . '` ' . $where;
        $this->sqlCount = $pdo->prepare('SELECT COUNT(*)' . $sqlInner);

        if (isset($_REQUEST[$this->key]))
            $this->start = intval($_REQUEST[$this->key]);
        else
            $this->start = 0;

        $this->sql = $pdo->prepare('SELECT *' . $sqlInner . ' LIMIT ' . $this->start . ', ' . $this->nbByPage);
    }

    /**
     * Bind une valeur sur les requetes SQL préparés
     * @param type $param
     * @param type $value
     */
    public function bindValue($param, $value) {
        $this->sql->bindValue($param, $value);
        $this->sqlCount->bindValue($param, $value);
    }

    /**
     * Applique le pager à un template
     */
    public function run(&$tpl) {
        global $pdo;

        $this->sql->execute();
        $this->sqlCount->execute();

        $total = $this->sqlCount->fetch();
        $total = $total[0];

        if ($this->start < 0 || $this->start > $total)
            throw new Exception('Out of range');

        $hasPrev = $this->start - $this->nbByPage >= 0;
        $hasNext = $this->start + $this->nbByPage < $total;

        $table = array(
            'total' => $total,
            'prev' => urldup(array($this->key => $hasPrev ? $this->start - $this->nbByPage : 0)),
            'next' => urldup(array($this->key => $hasNext ? $this->start + $this->nbByPage : $this->start)),
            'showNext' => $hasNext,
            'showPrev' => $hasPrev,
            'rows' => array(),
        );

        while ($line = $this->sql->fetch())
            $table['rows'][] = $line;

        $tpl->assign($this->prepose . 'table', $table);
    }

}

/**
 * Permet de récupérer des informations de debug (en retirant une partie de la
 * pile d'exécution.
 * @param type $pile
 * @return type
 */
function dbg_getInfos($pile = 0) {
    $log = debug_backtrace();
    for ($i = 0; $i < $pile; $i++)
        array_shift($log);
    $log = array_reverse($log);
    return $log;
}

/**
 * Fonction plus ou moins système permettant l'affichage des informations
 * détaillé sur un message de debug.
 * @param type $file
 * @param type $msg
 * @param type $log
 */
function dbg_show_msg($file, $msg, $log) {
    echo "<p>Erreur $msg dans le module $file.</p><p><u>Backtrace:</u><br>\n";
    echo "<table border=1><tr class=\"font-weight:bold;\"><th>Fichier</th><th>Ligne</th><th>Fonction</th><th>Arguments</th></tr>\n";

    foreach ($log as $line) {
        if (!isset($line['class']))
            $line['class'] = '';
        if (!isset($line['type']))
            $line['type'] = '';
        if (!isset($line['line']))
            $line['line'] = '<i>Undef</i>';
        if (!isset($line['file']))
            $line['file'] = '<i>Undef</i>';

        $line['argsStr'] = '';
        foreach ($line['args'] as $input) {
            if ($line['argsStr'] != '')
                $line['argsStr'] .= ', ';
            $line['argsStr'] .= var_export($input, true);
        }

        echo "<tr><td>$line[file]</td><td>$line[line]</td><td>$line[class]$line[type]$line[function]</td><td>$line[argsStr]</td></tr>";
    }
    echo "</table></p><br>";
}

/**
 * Lance une erreur critique.
 * @param type $file
 * @param type $msg
 * @param type $pile
 */
function dbg_error($file, $msg, $pile = FALSE) {
    echo "<br><br><strong>ERREUR CRITIQUE</strong><br>\n";
    echo "<p>Une erreur de type critique a intérrompu l'exécution</p>";
    dbg_show_msg($file, $msg, dbg_getInfos($pile));
    exit(1);
}

/**
 * Lance une erreur non critique.
 * @param type $file
 * @param type $msg
 * @param type $pile
 */
function dbg_warning($file, $msg, $pile = 0) {
    echo "<br><br><strong>ATTENTION</strong><br>\n";
    echo "<p>Une erreur non crtitique est intervenue. Elle n'est pas bloquante mais peut mériter d'y jetter un coup d'oeil.</p>";
    dbg_show_msg($file, $msg, dbg_getInfos($pile + 1));
}

/**
 * Affiche le template pour le module en exécution
 */
function display() {
    global $tpl, $exec_mod, $exec_action;

    $tpl->display($exec_mod . '_' . $exec_action . '.tpl');
    quit();
}

/**
 * Convertie une chaine UTF-8
 * @param string $txt
 * @return string
 */
function uc($txt) {
    return iconv('UTF-8', 'ISO-8859-1//TRANSLIT//IGNORE', $txt);
}
