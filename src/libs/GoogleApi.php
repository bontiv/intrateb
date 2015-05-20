<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GoogleApi
 *
 * @author bontiv
 */
class GoogleApi {

    private $scopes;
    private $mail;
    private $bearer;
    private $key;
    private $user;
    private $expire;

    // Mecanisme de Google : https://developers.google.com/accounts/docs/OAuth2ServiceAccount

    public function __construct($scopes = null, $apiData = null, $user = null) {
        global $config;

        if ($apiData == null) {
            $apiData = json_decode($config['GoogleApps']['json'], true);
        }

        if ($user == null) {
            $user = $config['GoogleApps']['user'];
        }

        if ($scopes == null) {
            $scopes = array("https://www.googleapis.com/auth/admin.directory.group");
        } elseif (!is_array($scopes)) {
            $scopes = array($scopes);
        }

        $this->mail = $apiData['client_email'];
        $this->scopes = $scopes;
        $this->key = $apiData['private_key'];
        $this->user = $user;
    }

    private function readCache() {
        global $tmpdir;

        if (!file_exists($tmpdir . '/apicred.cache')) {
            return array();
        }
        $data = file_get_contents($tmpdir . '/apicred.cache');
        $now = time() - 5;
        if ($data != false) {
            $data = unserialize($data);
            foreach ($data as $k => $scope) {
                if ($scope['expire'] < $now) {
                    unset($data[$k]);
                }
            }
        }
        return $data;
    }

    private function writeCache($data) {
        global $tmpdir;

        file_put_contents($tmpdir . '/apicred.cache', serialize($data));
    }

    private function base64encode($data) {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    private function createJWTHeader() {
        return $this->base64encode('{"alg":"RS256","typ":"JWT"}');
    }

    private function createJWTClaim($aud = 'https://www.googleapis.com/oauth2/v3/token') {
        $iat = time();
        $exp = $iat + 3600;
        $this->expire = $exp;

        $jwt = "{"
                . "\"iss\":\"$this->mail\","
                . "\"sub\":\"$this->user\","
                . "\"scope\":\"" . implode(' ', $this->scopes) . "\","
                . "\"aud\":\"$aud\","
                . "\"exp\":$exp,"
                . "\"iat\":$iat}";

        return $this->base64encode($jwt);
    }

    private function createJWT($aud = 'https://www.googleapis.com/oauth2/v3/token') {
        $header = $this->createJWTHeader();
        $body = $this->createJWTClaim($aud);
        $sign = '';

        $hash = defined("OPENSSL_ALGO_SHA256") ? OPENSSL_ALGO_SHA256 : "sha256";
        openssl_sign("${header}.${body}", $sign, $this->key, $hash);

        return "${header}.${body}." . $this->base64encode($sign);
    }

    private function getAccessToken() {
        $assertion = $this->createJWT();
        $post = "grant_type=" . urlencode('urn:ietf:params:oauth:grant-type:jwt-bearer')
                . "&assertion=" . urlencode($assertion);

        $curl = curl_init('https://www.googleapis.com/oauth2/v3/token');
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
        $token = curl_exec($curl);

        $jans = json_decode($token);

        if (isset($jans->access_token)) {
            $this->bearer = $jans->access_token;
        }

        return $this->bearer;
    }

    public function getTocken() {
        if ($this->bearer == null || $this->expire > time()) {
            $key = sha1(implode(';', $this->scopes));
            $data = $this->readCache();
            if (isset($data[$key])) {
                $this->bearer = $data[$key]['token'];
                $this->expire = $data[$key]['expire'];
            } else {
                $this->getAccessToken();
                $data[$key] = array(
                    'token' => $this->bearer,
                    'expire' => $this->expire,
                );
                $this->writeCache($data);
            }
        }
        return $this->bearer;
    }

    public function getGroupMembers($ml = 'membres@epitanime.com') {
        $ch = curl_init('https://www.googleapis.com/admin/directory/v1/groups/' . $ml . '/members?maxResults=1000&access_token=' . $this->getTocken());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $ret = curl_exec($ch);
        return json_decode($ret);
    }

    public function getGroupsList() {
        $ch = curl_init('https://www.googleapis.com/admin/directory/v1/groups?domain=epitanime.com&access_token=' . $this->getTocken());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $ret = curl_exec($ch);
        return json_decode($ret);
    }

    public function getGroupsDetails($groupKey) {
        $ch = curl_init('https://www.googleapis.com/admin/directory/v1/groups/' . $groupKey . '?access_token=' . $this->getTocken());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $ret = curl_exec($ch);
        return json_decode($ret);
    }

    public function addGroupMember($groupKey, $email) {
        $ch = curl_init('https://www.googleapis.com/admin/directory/v1/groups/' . $groupKey . '/members?access_token=' . $this->getTocken());
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, '{"email":"' . $email . '","role":"MEMBER"}');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $ret = curl_exec($ch);
        return json_decode($ret);
    }

    public function delGroupMember($groupKey, $email) {
        $ch = curl_init('https://www.googleapis.com/admin/directory/v1/groups/' . $groupKey . '/members/' . $email . '?access_token=' . $this->getTocken());
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $ret = curl_exec($ch);
        return json_decode($ret);
    }

    public function findUserGroups($email) {
        $ch = curl_init('https://www.googleapis.com/admin/directory/v1/groups?userKey=' . $email . '&maxResults=100&access_token=' . $this->getTocken());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $ret = curl_exec($ch);
        return json_decode($ret);
    }

    public function getGroupMemberDetails($groupid, $memberid) {
        $ch = curl_init('https://www.googleapis.com/admin/directory/v1/groups/' . $groupid . '/members/' . $memberid . '?access_token=' . $this->getTocken());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $ret = curl_exec($ch);
        return json_decode($ret);
    }

    public function setGroupMemberLevel($groupid, $memberid, $level) {
        $mbr = $this->getGroupMemberDetails($groupid, $memberid);
        if (isset($mbr->error)) {
            return $mbr;
        }

        $ch = curl_init('https://www.googleapis.com/admin/directory/v1/groups/' . $groupid . '/members/' . $mbr->id . '?access_token=' . $this->getTocken());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, '{"email":"' . $mbr->email . '","role":"' . $level . '"}');
        $ret = curl_exec($ch);
        return json_decode($ret);
    }

}
