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

    // Mecanisme de Google : https://developers.google.com/accounts/docs/OAuth2ServiceAccount

    private function createJWTHeader() {
        return base64_encode('{"alg":"RS256","typ":"JWT"}');
    }

    private function createJWTClaim($aud = 'https://accounts.google.com/o/oauth2/token') {
        $exp = time() + 400;
        $iat = time();
        return base64_encode("{"
                . "\"iss\":\"$this->mail\","
                . "\"scope\":\"" . implode(' ', $this->scopes) . "\","
                . "\"aud\":\"$aud\","
                . "\"exp\":\"$exp\","
                . "\"iat\":\"$iat\"}");
    }

    private function createJWT($aud = 'https://accounts.google.com/o/oauth2/token') {
        global $srcdir;

        $header = $this->createJWTHeader();
        $body = $this->createJWTClaim();
        $sign = hash('sha256', "${header}.${body}");
        $key = openssl_pkey_get_private($srcdir . "/libs/google.p12");
        $hash = defined("OPENSSL_ALGO_SHA256") ? OPENSSL_ALGO_SHA256 : "sha256";
        openssl_sign("${header}.${body}", $sign, $key, $hash);
        openssl_pkey_free($key);

        return base64_encode("${header}.${body}.${sign}");
    }

    private function getAccessToken() {
        $curl = curl_init('https://accounts.google.com/o/oauth2/token');
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, "grant_type=" . urlencode(' urn:ietf:params:oauth:grant-type:jwt-bearer') . "&assertion=" . urlencode($this->createJWT()));
        $token = curl_exec($curl);

        var_dump($token);
        $matchs = array();
        if (!preg_match('`"access_token" ?: ?"([^"]*)"`', $token, $matchs)) {
            return false;
        }

        $this->bearer = $matchs[1];
        return $this->bearer;
    }

    private function run() {
        "Authorization: Bearer $this->bearer";
    }

}
