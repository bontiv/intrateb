<?php

/*
 * Ficher d'interface avec l'intra EPITECH
 */

class EIntranet {

    private
            $baseUrl;
    private
            $cookies;

    function __construct($config = null) {
        global $tmpdir;

        if ($config === null) {
            $config = $GLOBALS['config']['epitech'];
        }

        $this->baseUrl = rtrim($config['baseUrl'], '/');
        $this->cookies = $tmpdir . '/intracred.cache';
        $this->login = $config['login'];
        $this->password = $config['pass'];
    }

    public function isConnected() {
        $ch = curl_init($this->baseUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookies);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $this->cookies);
        $out = curl_exec($ch);
        return strpos($out, '<input type="text" id="auth-input-login" name="login" placeholder="Login" />') === false;
    }

    public function connect() {
        $ch = curl_init($this->baseUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, array(
            'login' => $this->login,
            'password' => $this->password,
        ));
        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookies);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $this->cookies);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
        curl_exec($ch);

        return curl_getinfo($ch, CURLINFO_HTTP_CODE) == 302;
    }

    public function getSpicesList() {
        $ch = curl_init($this->baseUrl . '/spice/delegation/list?format=json&offset=0');
        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookies);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $this->cookies);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $ret = curl_exec($ch);

        // Not connected
        if (curl_getinfo($ch, CURLINFO_HTTP_CODE) == 403) {
            if (!$this->connect()) {
                return false;
            }
            return $this->getSpicesList();
        }

        $ret = preg_replace('`^ *//.*\n`', '', $ret);
        return json_decode($ret);
    }

    public function getUserInfos($login) {
        $ch = curl_init($this->baseUrl . '/user/' . $login . '/?format=json');
        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookies);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $this->cookies);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $ret = curl_exec($ch);

        // Not connected
        if (curl_getinfo($ch, CURLINFO_HTTP_CODE) == 403) {
            if (!$this->connect()) {
                return false;
            }
            return $this->getSpicesList();
        }

        $ret = preg_replace('`^ *//.*\n`', '', $ret);
        return json_decode($ret);
    }

}
