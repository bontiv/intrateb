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
 * Menus par défaut
 */
$menu = array();

$menu['DEFAULT'] = array(
    'SECTIONS' => array(
        'label' => 'Sections',
        'url' => 'section',
    ),
    'TOOLS' => array(
        'label' => 'Outils',
        'sub' => array(
            'DEV' => array(
                'label' => 'Développeurs',
                'url' => 'developer',
            ),
        ),
    ),
    'EVENTS' => array(
        'label' => 'Events',
        'url' => 'event',
    ),
    'MARKING' => array(
        'label' => 'Notation',
        'sub' => array(
            'MARK' => array(
                'label' => 'Notes',
                'url' => 'note',
            ),
            'REPORT' => array(
                'label' => 'Bulletins',
                'url' => 'bulletin',
            ),
        ),
    ),
    'ADMIN' => array(
        'label' => 'Administration',
        'sub' => array(
            'USERS' => array(
                'label' => 'Utilisateurs',
                'url' => 'user',
            ),
            'SCHOOL' => array(
                'label' => 'Ecoles',
                'url' => 'ecole',
            ),
            'MANDATE' => array(
                'label' => 'Mandats',
                'url' => 'mandate',
            ),
            'MARKING' => array(
                'label' => 'Notation',
                'url' => 'admin_note',
            ),
            'MAILLING' => array(
                'label' => 'Mailling list',
                'url' => 'ml',
            ),
            'MODELS' => array(
                'label' => 'Instances de donnée',
                'url' => 'admin_modeles',
            ),
            'ACLS' => array(
                'label' => 'Droits d\'accès',
                'url' => 'admin',
            ),
            'CARDS' => array(
                'label' => 'Gestion des cartes',
                'url' => 'cards',
            ),
            'WIFI' => array(
                'label' => 'Gestion du Wifi',
                'url' => 'wifi',
            ),
            'CONFIG' => array(
                'label' => 'Configuration',
                'url' => 'config',
            ),
            'MODS' => array(
                'label' => 'Extensions',
                'url' => 'mod',
            ),
        ),
    ),
);

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
    if ($txt == "ADMINISTRATOR")
        return ACL_ADMINISTRATOR;
    throw new Exception("ACL not valid: " . $txt);
}

/**
 * Test si l'utilisateur a un niveau d'accès
 * @param type $acl
 * @return type
 */
function hasAcl($acl, $action = null, $page = 'index', $params = null) {
    global $pdo;

    if (!isset($_SESSION['user']) || $_SESSION['user'] == false || !isset($_SESSION['user']['role']))
        $user = ACL_ANNONYMOUS;
    elseif ($action != null) {
        $user = modsecu($action, $page, $params);
        if ($user < $_SESSION['user']['role'])
            $user = $_SESSION['user']['role'];
    } else
        $user = $_SESSION['user']['role'];

    // Tentative de rattrapage par groupe
    if ($user < ACL_SUPERUSER && $acl <= ACL_SUPERUSER) {
        $sql = $pdo->prepare('SELECT ag_group FROM access_groups RIGHT JOIN acces ON ag_access = acl_id WHERE acl_action = ? AND acl_page = ?');
        $sql->bindValue(1, $action !== null ? $action : 'index');
        $sql->bindValue(2, $page);
        $sql->execute();
        while ($line = $sql->fetch()) {
            // Test si utilisateur dans section $line[0]
            if (isset($_SESSION['user']['sections'][$line[0]]) && $_SESSION['user']['sections'][$line[0]]['us_type'] == 'manager') {
                $user = ACL_SUPERUSER;
            }
        }
    }

    return $user >= $acl;
}

/**
 * Affiche une page d'erreur si le niveau d'accès de l'utilisateur
 * est trop faible
 * @param type $acl
 */
function needAcl($acl, $action = null, $page = null, $params = null) {
    if (!hasAcl($acl, $action, $page, $params))
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

        if ((isset($params['action'], $params['page']) && hasAcl($need, $params['action'], $params['page'], $params)) || hasAcl($need))
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
    if (!hasAcl(getAclLevel($action, $page), $action, $page, $params))
        return mkurl('index', 'error403');

    return mkurl($action, $page, $params);
}

/**
 * Créé un item de menu
 *
 * @param type $item tableau d'items
 * @param type $level niveau du menu
 * @return string HTML
 */
function mkmenuItem($item, $level = 0) {
    $txt = "";

    if (isset($item['sub'])) {
        $stxt = '';
        $txt = '<li class="dropdown">
              <a href="#" data-toggle="dropdown" class="dropdown-toggle">'
                . $item['label'] . '
                <b class="caret"></b></a>
              <ul class="dropdown-menu">';
        foreach ($item['sub'] as $sub) {
            $stxt .= mkmenuItem($sub, $level + 1);
        }
        if (strlen($stxt) == 0) {
            return "";
        }
        $txt .= $stxt;
        $txt .= '</ul></li>';
    } else {
        $opts = array();
        $action = 'index';
        $page = 'index';

        if (is_string($item['url'])) {
            $action = $item['url'];
        } else {
            if (isset($item['url']['action'])) {
                $action = $item['url']['action'];
            }

            if (isset($item['url']['page'])) {
                $page = $item['url']['page'];
            }
            $opts = $item['url'];
            unset($opts['action']);
            unset($opts['page']);
        }
        $url = mkurl($action, $page, $opts);
        $need = getAclLevel($action, $page);
        $acl = hasAcl($need, $action, $page, $opts);

        if ($acl) {
            $txt = '<li><a href="' . $url . '">' . $item['label'] . '</a></li>';
        }
    }

    return $txt;
}

/**
 * Efface le cache du menu
 *
 * @global type $tmpdir Dossier tmp
 * @param type $type Type de menu
 */
function cleanMenu($type = 'DEFAULT') {
    global $tmpdir;

    $cachefile = $tmpdir . '/menu_' . $type . '.php';

    if (file_exists($cachefile)) {
        unlink($cachefile);
    }
}

/**
 * Construit un menu
 *
 * @global array $menu menus par défault
 * @global type $tmpdir dossier tmp
 * @param type $type type de menu
 * @return str HTML
 */
function mkmenu($type = 'DEFAULT') {
    global $menu, $tmpdir;

    $html = "";
    $cachefile = $tmpdir . '/menu_' . $type . '.php';
    $xmenu = array();

    if (!file_exists($cachefile)) {
        $xmenu = $menu[$type];

        foreach (Extend::getInstalledMods() as $mod) {
            $xmenu = array_merge_recursive($xmenu, $mod->getMenu($type));
        }

        file_put_contents($cachefile, "<?php\n\$xmenu = " . var_export($xmenu, true) . ";\n");
    } else {
        include $cachefile;
    }

    foreach ($xmenu as $item) {
        $html .= mkmenuItem($item);
    }

    return $html;
}

/**
 * Créé le menu (smarty)
 *
 * @param type $params
 * @param type $smarty
 */
function mkmenu_smarty($params, $smarty) {
    return mkmenu();
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
    if (!CONSOLE) {
        $url = mkurl($action, $page, $options);
        header("Location: $url");
        quit();
    }
}

/**
 * Laisser la possibilité à un module de gérer sa sécurité
 * @global type $root
 * @param type $action
 * @param type $page
 */
function modsecu($action, $page = 'index', $params = null) {
    global $root;

    if (!file_exists($root . 'action' . DS . $action . '.php'))
        return false;

    include_once $root . 'action' . DS . $action . '.php';

    if (function_exists($action . '_security')) {
        return call_user_func($action . '_security', $page, $params);
    }
    return false;
}

/**
 * Execute un controleur
 * @global type $root
 * @param type $action
 * @param type $page
 */
function modexec($action, $page = 'index') {
    global $root, $exec_mod, $exec_action;

    if (file_exists($root . 'action' . DS . $action . '.php')) {
        include_once $root . 'action' . DS . $action . '.php';
    } else {
        $act = Extend::getAction($action);
        $act->init($action);
    }

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

    $act = Extend::getAction($exec_mod);
    $tplName = $exec_mod . '_' . $exec_action;

    if ($act != null) {
        $tpl->display($act->getTemplates($tplName));
    } else {
        $tpl->display($tplName . '.tpl');
    }
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

/**
 * Permet d'authentifier un utilisateur
 *
 * @global type $pdo
 * @param type $user Utilisateur
 * @param type $pass Mot de passe chiffré
 * @return boolean True si authentification réussie
 */
function login_user($user, $pass, $otp_code = null) {
    global $pdo, $srcdir;

    $sql = $pdo->prepare('SELECT * FROM users WHERE user_name = ?');
    $sql->bindValue(1, $user);
    $sql->execute();
    if ($user = $sql->fetch()) {
        //Ici l'utilisateur existe
        if (strlen($user['user_pass']) != 32) // Mot de passe non chiffré ...
            $user['user_pass'] = md5($user['user_name'] . ':' . $user['user_pass']);

        if (strlen($user['user_otp'])) {
            require_once $srcdir . '/libs/GoogleAuthenticator/GoogleAuthenticator.php';
            $otp = new GoogleAuthenticator();
            if (!$otp->checkCode($user['user_otp'], $otp_code)) {
                return -1;
            }
        }

        //Mot de passe correct ?
        if (md5($user['user_pass'] . $_SESSION['random']) == $pass) {
            $_SESSION['user'] = $user;
            $_SESSION['user']['role'] = aclFromText($user['user_role']);
            unset($_SESSION['random']);
            return true;
        }
    }
    return false;
}

/**
 * Récupère la liste des configurations
 */
function get_configs() {
    global $root, $_cfg_cache;

    if ($_cfg_cache !== null)
        return $_cfg_cache;

    $files = scandir($root . 'configs');
    $config = array();
    foreach ($files as $name) {
        $file = $root . 'configs' . DS . $name;
        if (is_file($file)) {
            $data = spyc_load_file($file);
            $data['file'] = $name;
            foreach ($data['fields'] as $fname => &$fdata) {
                $fdata['name'] = $fname;
                if (!isset($fdata['size']))
                    $fdata['size'] = 50;
            }
            if (isset($data['name']))
                $config[$data['name']] = $data;
        }
    }

    $_cfg_cache = $config;
    return $config;
}

function getMailer() {
    global $config;

    $mc = $config['PHPMailer'];
    $m = new PHPMailer();

    if ($mc['enable'] == 'no') {
        dbg_error(__FILE__, 'Les mails sont désactivés');
        return null;
    }

    $m->Mailer = $mc['enable'];
    $m->From = $mc['from'];
    $m->FromName = $mc['from_name'];
    $m->Sender = $mc['from'];
    $m->Host = $mc['smtp_host'];
    $m->Port = $mc['smtp_port'];
    $m->SMTPSecure = $mc['smtp_enc'] == 'no' ? '' : $mc['smtp_enc'];
    $m->SMTPAuth = $mc['smtp_auth_user'] != '' && $mc['smtp_auth_pass'] != '';
    $m->Username = $mc['smtp_auth_user'];
    $m->Password = $mc['smtp_auth_pass'];

    $m->CharSet = 'utf-8';
    $m->IsHTML();

    return $m;
}
