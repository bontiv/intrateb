<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class BocalAnswer {

    private $answerData;

    public function __construct($rawData, $baseUrl) {
        $this->answerData = array();
        //user
        if (preg_match('`\[([^\]]*)\]`', $rawData, $matches)) {
            $this->answerData['user'] = trim(strip_tags($matches[1]));
        }

        //date
        if (preg_match('`Post&eacute; le</span> ([^<]*)<`', $rawData, $matches)) {
            $this->answerData['date'] = trim(strip_tags($matches[1]));
        }

        //content
        $start = strpos($rawData, '<td colspan="2">');
        $end = strpos($rawData, '</td>', $start);
        $this->answerData['content'] = trim(strip_tags(substr($rawData, $start, $end - $start), '<br></br>'), "\n\r\t ");

        //image
        if (preg_match('`<img src="([^"]*)"`', $rawData, $matches)) {
            $this->answerData['image'] = str_replace('..', $baseUrl, trim(strip_tags($matches[1])));
        }

        if (preg_match('`<td colspan="2"><span id=\'styleTickets\'>Statut :</span>([^<]*)</td>`', $rawData, $matches)) {
            $this->answerData['state'] = trim(strip_tags($matches[1]));
        }
    }

    public function __get($name) {
        if (isset($this->answerData[$name])) {
            return $this->answerData[$name];
        }
        return false;
    }

}

class Bocal {

    private
            $baseUrl;
    private
            $cookies;
    private
            $ticketData;

    function __construct($config = null) {
        global $tmpdir;

        if ($config === null) {
            $config = $GLOBALS['config']['bocal'];
        }

        $this->baseUrl = rtrim($config['baseUrl'], '/');
        $this->cookies = $tmpdir . '/bocalcred.cache';
        $this->login = $config['user'];
        $this->password = $config['pass'];
    }

    public function __get($name) {
        if (isset($this->ticketData[$name])) {
            return $this->ticketData[$name];
        }
        return false;
    }

    public function isConnected() {
        $ch = curl_init($this->baseUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookies);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $this->cookies);
        $out = curl_exec($ch);
        return strpos($out, '<input type="text" name="login" size=\'10\' value=\'\' />') === false;
    }

    public function connect() {
        $ch = curl_init($this->baseUrl . '/index.php');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, array(
            'login' => $this->login,
            'pass' => $this->password,
            'submit' => 'submit',
            'logout' => '',
        ));
        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookies);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $this->cookies);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
        $out = curl_exec($ch);
        if (strpos($out, '<input type="text" name="login"') !== false) {
            global $tpl;

            $tpl->assign('msg', 'Configuration bocal incorrect');
            $tpl->display('syscore_error.tpl');
            quit();
        }
    }

    public function getTicket($id) {
        $ch = curl_init($this->baseUrl . '/index.php?pgid=read&m_tickets_id=' . $id);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookies);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $this->cookies);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $out = curl_exec($ch);
        if (strpos($out, '<p id=\'error\'>') !== false) {
            if (strpos($out, 'demande une identification')) {
                $this->connect();
                return $this->getTicket($id);
            } else {
                return false;
            }
        }

        $this->ticketData = array();
        $this->ticketData['id'] = $id;

        // BLOCK Parsing des donnes communes
        if (preg_match('`<label NAME=\'m_tickets_subject\'>([^<]*)<`', $out, $matches)) {
            $this->ticketData['title'] = $matches [1];
        }
        $start = strpos($out, '<b>Personne(s) assign&eacute;e(s)');
        $end = strpos($out, '<br', $start);
        if ($start && $end) {
            foreach (explode(',', substr($out, $start + 40, $end - $start - 40)) as $user) {
                $this->ticketData ['assignation'] [] = trim(strip_tags($user));
            }
        }
        $start = strpos($out, '<b>Diffusion(s) :</b>', $end);
        $end = strpos($out, '<br', $start);
        if ($start && $end) {
            foreach (explode(',', substr($out, $start + 22, $end - $start - 22)) as $user) {
                $this->ticketData ['diffusion'] [] = trim(strip_tags($user));
            }
        }
        // END BLOCK
        $this->ticketData['answers'] = array();
        while (true) {
            $start = strpos($out, 'class="tableContent"', $end);
            $end = strpos($out, '</table>', $start);
            if ($start && $end) {
                $this->ticketData['answers'] [] = new BocalAnswer(substr($out, $start, $end - $start), $this->baseUrl);
            } else {
                break;
            }
        }

        return true;
    }

    public function updateDB($id) {
        $mdl = new Modele('event_bocal');
        $mdl->fetch($id);

        $last = $this->answers[count($this->answers) - 1];

        if ($mdl->eb_state != $last->state || $mdl->eb_last_update != $last->date) {
            $mdl->eb_state = $last->state;
            $mdl->eb_last_update = $last->date;
            return true;
        }
        return false;
    }

    public function getUser($login) {
        $ch = curl_init($this->baseUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookies);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $this->cookies);
        curl_setopt($ch, CURLOPT_POSTFIELDS, array(
            'pgid' => 'userinfo',
            'm_userinfo_user_name' => '',
            'm_userinfo_user_firstname' => '',
            'm_userinfo_user_login' => $login,
            'm_userinfo_user_prom' => '',
            'm_userinfo_user_school' => '',
            'm_userinfo_user_town' => '',
            'm_userinfo_submit' => 'Rechercher',
        ));
        $ret = curl_exec($ch);

        //Erreur et connexion
        if (strpos($ret, '<p id=\'error\'>') !== false) {
            if (strpos($ret, 'demande une identification')) {
                $this->connect();
                return $this->getUser($login);
            } else {
                return false;
            }
        }

        $dom = new DOMDocument();
        @$dom->loadHTML($ret);
        $xpath = new DOMXPath($dom);

        if ($xpath->query('/html/body/div[6]/table/tr[2]')->length == 0)
            return false;

        $userInfos = array(
            'login' => trim($xpath->query('/html/body/div[6]/table/tr[2]/td[1]')->item(0)->textContent),
            'lastname' => trim($xpath->query('/html/body/div[6]/table/tr[2]/td[2]')->item(0)->textContent),
            'raw_firstname' => trim($xpath->query('/html/body/div[6]/table/tr[2]/td[3]')->item(0)->textContent),
            'uid' => trim($xpath->query('/html/body/div[6]/table/tr[2]/td[4]')->item(0)->textContent),
            'gid' => trim($xpath->query('/html/body/div[6]/table/tr[2]/td[5]')->item(0)->textContent),
            'raw_promo' => trim($xpath->query('/html/body/div[6]/table/tr[2]/td[6]')->item(0)->textContent),
            'school' => trim($xpath->query('/html/body/div[6]/table/tr[2]/td[7]')->item(0)->textContent),
            'town' => trim($xpath->query('/html/body/div[6]/table/tr[2]/td[8]')->item(0)->textContent),
            'close' => trim($xpath->query('/html/body/div[6]/table/tr[2]/td[9]')->item(0)->textContent),
        );

        $userInfos['firstname'] = preg_replace('`[0-9]`', '', $userInfos['raw_firstname']);
        $userInfos['promo'] = preg_replace('`^[^0-9]*([0-9]*)$`', '\1', $userInfos['raw_promo']);
        return $userInfos;
    }

}
