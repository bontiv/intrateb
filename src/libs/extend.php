<?php

class Extend {

    private static $mods = null;
    private static $actions = null;
    private static $enabled = null;
    private $defs;
    private $extdir;

    public function __construct($mod) {
        global $srcdir;

        $this->extdir = $srcdir . '/extends/' . $mod;
        $defs = $this->extdir . '/defs.yml';
        if (file_exists($defs)) {
            $this->defs = spyc_load_file($defs);
        }
        $this->defs['sysdir'] = $mod;
    }

    /**
     * Load mods for file system.
     */
    private static function _loadMods() {
        global $srcdir;

        self::$mods = array();
        $fobjs = scandir($srcdir . '/extends');

        foreach ($fobjs as $obj) {
            $defs = $srcdir . '/extends/' . $obj . '/defs.yml';
            if ($obj[0] != '.' && is_file($defs)) {
                $mod = spyc_load_file($defs);
                $mod['sysdir'] = $obj;
                self::$mods[] = $mod;
            }
        }
    }

    /**
     * Load data from DB.
     */
    public static function _loadDB() {
        self::$actions = array();
        self::$enabled = array();
        $mdl = new Modele('mod_list');
        $mdl->find();

        while ($mdl->next()) {
            self::$actions[$mdl->mod_action] = $mdl->mod_dir;
            if (!in_array($mdl->mod_dir, self::$enabled)) {
                self::$enabled[] = $mdl->mod_dir;
            }
        }
    }

    /**
     * Get extentions.
     */
    public static function getMods() {
        if (self::$mods == null) {
            self::_loadMods();
        }

        return self::$mods;
    }

    /**
     * Get extend by action
     *
     * @param str $action Action
     * @return Extend Extend or false
     */
    public static function getAction($action) {
        if (self::$actions == null) {
            self::_loadDB();
        }

        if (!isset(self::$actions[$action])) {
            return false;
        }

        return new Extend(self::$actions[$action]);
    }

    /**
     * Test if an extention is installed.
     *
     * @param $sysdir Extention system directoy's name
     */
    public static function isInstalled($sysdir) {
        if (self::$enabled == null) {
            self::_loadDB();
        }

        return in_array($sysdir, self::$enabled);
    }

    public static function getInstalledMods() {
        if (self::$enabled == null) {
            self::_loadDB();
        }

        $mods = array();
        foreach (self::$enabled as $mod) {
            $mods[] = new Extend($mod);
        }

        return $mods;
    }

    /**
     * Install actions.
     */
    private function _installActions() {
        $actdir = $this->extdir . '/actions';
        $matchs = null;

        foreach (scandir($actdir) as $actfile) {
            if (preg_match('`^(.*)\.php$`', $actfile, $matchs)) {
                $mod = new Modele('mod_list');
                if (!$mod->addFrom(
                                array(
                                    'mod_dir' => $this->defs['sysdir'],
                                    'mod_action' => $matchs[1],
                                )
                        )
                ) {
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * Install models.
     */
    public function _installModels() {
        global $pdo;

        $moddir = $this->extdir . '/models';
        $matchs = null;

        foreach (scandir($moddir) as $modfile) {
            if (preg_match('`^(.*)\.yml$`', $modfile, $matchs)) {
                $def = spyc_load_file($moddir . '/' . $modfile);
                $pdo->exec(mdle_sql_create($def));
            }
        }

        return true;
    }

    public function _updateModels() {
        global $pdo;

        $moddir = $this->extdir . '/models';
        $matchs = null;

        $sqlTables = $pdo->query('show tables');
        $inTables = array();
        $defTables = array();

        while ($line = $sqlTables->fetch()) {
            $inTables[$line[0]] = array();
        }

        foreach (scandir($moddir) as $modfile) {
            if (preg_match('`^(.*)\.yml$`', $modfile, $matchs)) {
                $def = spyc_load_file($moddir . '/' . $modfile);
                $defTables[$def['name']] = $def;
            }
        }

        //Ajout des tables
        $addTables = array_diff_key($defTables, $inTables);
        foreach ($addTables as $table) {
            $pdo->execute(mdle_sql_create($table));
        }

        $checkTables = array_intersect_key($defTables, $inTables);
        $modTables = array();
        foreach ($checkTables as $table => $def) {
            $sql = $pdo->query("SHOW COLUMNS FROM $table");
            $fields = array();
            $modify_fields = array();
            while ($c = $sql->fetch()) {
                $fields[] = $c['Field'];
                if ($c['Type'] != mdle_field_type($defTables[$table], $c['Field']))
                    $modify_fields[] = $c['Field'];
                elseif (isset($defTables[$table]['fields'][$c['Field']]['null']) && $c['Null'] != 'YES')
                    $modify_fields[] = $c['Field'];
            }
            $del_fields = array_diff($fields, array_keys($defTables[$table]['fields']));
            $add_fields = array_diff(array_keys($defTables[$table]['fields']), $fields);
            if (count($add_fields) + count($del_fields) + count($modify_fields) != 0) {
                $modTables[] = array(
                    'table' => $table,
                    'add' => $add_fields,
                    'del' => $del_fields,
                    'modify' => $modify_fields,
                );
            }
        }

        foreach ($modTables as $tdef) {
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
                $sql .= mdle_sql_fielddef($defTables[$tdef['table']], $col);
            }
            foreach ($tdef['modify'] as $col) {
                if ($first)
                    $first = false;
                else
                    $sql .= ',';
                $sql .= "\n    MODIFY `$col` ";
                $sql .= mdle_sql_fielddef($defTables[$tdef['table']], $col);
            }
            $pdo->query($sql);
        }

        return true;
    }

    /**
     * Insert ACL if not exists
     *
     * @param str $action Action
     * @param str $page Page
     * @param str $acl Default ACL
     * @return boolean
     */
    private function _insertAcl($action, $page, $acl) {
        $mdl = new Modele('acces');

        $obj = array(
            'acl_page' => $page,
            'acl_action' => $action,
        );

        $mdl->find($obj);

        if ($mdl->count() > 0) {
            return true;
        }

        $add = new Modele('acces');
        $obj['acl_acces'] = $acl;
        return $add->addFrom($obj);
    }

    /**
     * Install ACLs
     */
    private function _installAcls() {
        $err = 0;

        if (!isset($this->defs['acces'])) {
            return true;
        }

        foreach ($this->defs['acces'] as $action => $pages) {
            foreach ($pages as $page => $acl) {
                $this->_insertAcl($action, $page, $acl) or $err++;
            }
        }
        return $err == 0;
    }

    private function _syncMenu() {
        if (isset($this->defs['menu'])) {
            $types = array_keys($this->defs['menu']);
            foreach ($types as $type) {
                cleanMenu($type);
            }
        }
    }

    /**
     * Install extention.
     */
    public function install() {
        $err = 0;

        $this->_installActions() or $err++;
        $this->_installModels() or $err++;
        $this->_installAcls() or $err++;
        $this->_syncMenu();

        #Uninstall if errors
        if ($err > 0) {
            $this->uninstall();

            return false;
        }

        return true;
    }

    /**
     * Uninstall actions.
     */
    private function _uninstallActions() {
        $mod = new Modele('mod_list');
        $mod->find(array('mod_dir' => $this->defs['sysdir']));
        while ($mod->next()) {
            $mod->delete();
        }
        return true;
    }

    /**
     * Uninstall models.
     */
    private function _uninstallModels() {
        global $pdo;

        $moddir = $this->extdir . '/models';

        foreach (scandir($moddir) as $modfile) {
            if (preg_match('`^(.*)\.yml$`', $modfile, $matchs)) {
                $def = spyc_load_file($moddir . '/' . $modfile);
                $pdo->exec('DROP TABLE IF EXISTS `' . $def['name'] . '`');
            }
        }
    }

    /**
     * Uninstall ACLs
     */
    private function _uninstallAcls() {
        if (!isset($this->defs['acces'])) {
            return;
        }

        foreach ($this->defs['acces'] as $action => $pages) {
            foreach ($pages as $page => $acl) {
                $mdl = new Modele('acces');
                $mdl->find(array(
                    'acl_page' => $page,
                    'acl_action' => $action,
                ));
                if ($mdl->next()) {
                    $mdl->delete();
                }
            }
        }
    }

    /**
     * Uninstall extention.
     */
    public function uninstall() {
        $this->_uninstallActions();
        $this->_uninstallModels();
        $this->_uninstallAcls();
        $this->_syncMenu();

        return true;
    }

    /**
     * Test if this mod is valid
     *
     * @return boolean
     */
    public function isValid() {
        return isset($this->defs['infos']);
    }

    /**
     * Init action
     *
     * @param type $action
     */
    public function init($action) {
        require_once $this->extdir . '/actions/' . $action . '.php';
    }

    public function useTemplate($file) {
        global $tpl;

        $tpldir = realpath($this->extdir . '/templates');
        $tpl->assign('extendTpls', $tpldir);
        $tpl->display($tpldir . '/' . $file . '.tpl');
    }

    public function getModels() {
        $moddir = $this->extdir . '/models';
        $matchs = null;
        $tables = array();

        foreach (scandir($moddir) as $modfile) {
            if (preg_match('`^(.*)\.yml$`', $modfile, $matchs)) {
                $def = spyc_load_file($moddir . '/' . $modfile);
                $def['file'] = $modfile;
                $def['mod'] = $this->defs['sysdir'];
                $tables[$def['name']] = $def;
            }
        }

        return $tables;
    }

    /**
     * Get menu
     *
     * @param type $type menu type
     * @return array menu def
     */
    public function getMenu($type) {
        if (!isset($this->defs['menu'], $this->defs['menu'][$type])) {
            return array();
        }

        return $this->defs['menu'][$type];
    }

    public function update() {
        $err = 0;

        $this->_uninstallActions() or $err++;
        $this->_installActions() or $err++;
        $this->_updateModels() or $err++;
        $this->_syncMenu();

        return $err == 0;
    }

}

/* End class Extend */
