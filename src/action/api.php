<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function _api_config() {
    $baseAPI = "$_SERVER[REQUEST_SCHEME]://$_SERVER[HTTP_HOST]$_SERVER[SCRIPT_NAME]";
    return array(
        'issuer' => $baseAPI,
        'authorization_endpoint' => $baseAPI . '/authorize',
        'token_endpoint' => $baseAPI . '/token',
        'token_endpoint_auth_methods_supported' => array('client_secret_basic', 'private_key_jwt'),
        'token_endpoint_auth_signing_alg_values_supported' => array('RS256'),
        'userinfo_endpoint' => $baseAPI . '/userinfo',
        'check_session_iframe' => $baseAPI . '/check_session',
        'end_session_endpoint' => $baseAPI . '/end_session',
        'jwks_uri' => $baseAPI . '/jwks.json',
        'registration_endpoint' => $baseAPI . '/register',
        'scopes_supported' => array('openid'),
        'response_types_supported' => array('code', 'code id_token', 'id_token', 'token id_token'),
        'acr_values_supported' => array("urn:mace:incommon:iap:silver",
            "urn:mace:incommon:iap:bronze"),
        'subject_types_supported' => array("public", "pairwise"),
        'userinfo_signing_alg_values_supported' => array("RS256", "ES256", "HS256"),
        "userinfo_encryption_alg_values_supported" => array("RSA1_5", "A128KW"),
        "userinfo_encryption_enc_values_supported" => array("A128CBC-HS256", "A128GCM"),
        "id_token_signing_alg_values_supported" => array("RS256", "ES256", "HS256"),
        "id_token_encryption_alg_values_supported" =>
        array("RSA1_5", "A128KW"),
        "id_token_encryption_enc_values_supported" =>
        array("A128CBC-HS256", "A128GCM"),
        "request_object_signing_alg_values_supported" =>
        array("none", "RS256", "ES256"),
        "display_values_supported" =>
        array("page", "popup"),
        "claim_types_supported" =>
        array("normal", "distributed"),
        "claims_supported" =>
        array("sub", "iss", "auth_time", "acr",
            "name", "given_name", "family_name", "nickname",
            "profile", "picture", "website",
            "email", "email_verified", "locale", "zoneinfo",
            "http://example.info/claims/groups"),
        "claims_parameter_supported" =>
        true,
        "service_documentation" =>
        "http://server.example.com/connect/service_documentation.html",
        "ui_locales_supported" =>
        array("fr-FR", "en-US")
    );
}

function api_config() {
    echo json_encode(_api_config());
    quit();
}

function b64url2b64($base64url) {
// "Shouldn't" be necessary, but why not
    $padding = strlen($base64url) % 4;
    if ($padding > 0) {
        $base64url .= str_repeat("=", 4 - $padding);
    }
    return strtr($base64url, '-_', '+/');
}

function base64url_decode($base64url) {
    return base64_decode(b64url2b64($base64url));
}

function b642b64url($base64) {
    return rtrim(strtr($base64, '+/', '-_'), '=');
}

function base64url_encode($text) {
    return b642b64url(base64_encode($text));
}

function api_authorize() {

//response_type code uniquement
    if ($_GET['response_type'] != 'code') {
        redirect('syscore', 'custom', array('error' => 'Type de reponse non supporté.'));
        return; //Force l'arrêt
    }

//Recherche du client
    $cli = new Modele('api_clients');
    $cli->find(array('ac_client' => $_GET['client_id']));
    if (!$cli->next()) {
        redirect('syscore', 'custom', array('error' => 'Client API non enregistré.'));
        return; //Force l'arrêt
    }

//Verif callback client
    $allowed_callbaks = explode("\n", $cli->ac_callback);
    foreach ($allowed_callbaks as &$callback) {
        $callback = trim($callback, " \t\n\r\0\x0B/");
    }
    if (isset($_GET['redirect_uri']) && $_GET['redirect_uri'] == '' || !in_array($_GET['redirect_uri'], $allowed_callbaks)) {
        redirect('syscore', 'custom', array('error' => 'Callback non enregistré:' . $_GET['redirect_uri']));
        return; //Force l'arrêt
    }

// FIXME : vérifier le scope.
// Pas login ? Go login.
    if (!isset($_SESSION['user']) || $_SESSION['user'] === false) {
        $options = http_build_query(array(
            'redirect_uri' => $_GET['redirect_uri'],
            'response_type' => $_GET['response_type'],
            'client_id' => $_GET['client_id'],
            'nonce' => $_GET['nonce'],
            'state' => $_GET['state'],
            'scope' => $_GET['scope'],
        ));

        redirect("index", "login", array('redirect' => 'api/authorize/' . $options));
        return;
    }
    $token = array(
        'at_client' => $cli->getKey(),
        'at_type' => 'AUTH',
        'at_code' => md5(uniqid('', true)),
        'at_nonce' => $_GET['nonce'],
        'at_state' => $_GET['state'],
        'at_scope' => $_GET['scope'],
        'at_user' => $_SESSION['user']['user_id'],
        'at_start' => time(),
        'at_expire' => time() + 3600,
    );

    if (isset($_GET['redirect_uri'])) {
        $token['at_uri'] = $_GET['redirect_uri'];
    }

    $tok = new Modele('api_tokens');
    if (!$tok->addFrom($token)) {
        redirect('syscore', 'custom', array('error' => 'Token writing ERROR.'));
        return; //Force l'arrêt
    }

    $answer = array(
        'code' => $token['at_code'],
    );

    if ($token['at_state'] != '') {
        $answer['state'] = $token['at_state'];
    }

    $url = parse_url($_GET['redirect_uri']);
    $args = false;
    $uri = "$url[scheme]://";

    if (isset($url['query'])) {
        parse_str($url['query'], $args);
        $url['query'] = http_build_query(array_merge($args, $answer));
    } else {
        $url['query'] = http_build_query($answer);
    }

    if (isset($url['user'])) {
        $uri .= urlencode($url['user']);
        if (isset($url['pass'])) {
            $uri .= ':' . urlencode($pass);
        }
        $uri .= '@';
    }

    $uri .= $url['host'] . $url['path'] . '?' . $url['query'];
    if (isset($url['fragment'])) {
        $uri .= '#' . $url['fragment'];
    }

    header('Location: ' . $uri);
    quit();
}

function _api_error($id = 1000, $desc = 'Une erreur est survenue') {
    echo json_encode(array(
        'error' => $id,
        'error_description' => $desc,
    ));
    quit();
}

function _api_sign($payload) {
    global $srcdir, $config;

    $sign = '';

    $key = openssl_pkey_get_private($config['api']['rsakey']);
    $hash = defined("OPENSSL_ALGO_SHA256") ? OPENSSL_ALGO_SHA256 : "sha256";
    openssl_sign($payload, $sign, $key, $hash);

    return $sign;
}

function api_token() {
//    $_POST['grant_type'];
//    $_POST['code'];
//    $_POST['redirect_uri'];
//    $_POST['client_id'];
//    $_POST['client_secret'];
    //On ne fait que des tokens d'auth
    if ($_REQUEST['grant_type'] != 'authorization_code') {
        return _api_error('grant_type', 'Only authorization_code is supported');
    }

    //Recherche du client
    $cli = new Modele('api_clients');
    $cli->find(array(
        'ac_client' => $_REQUEST['client_id'],
        'ac_secret' => $_REQUEST['client_secret'],
    ));
    if (!$cli->next()) {
        return _api_error('unauthorized_client', 'API client denied.');
    }

    //Verif callback client
    $allowed_callbaks = explode("\n", $cli->ac_callback);
    foreach ($allowed_callbaks as &$callback) {
        $callback = trim($callback, " \t\n\r\0\x0B/");
    }
    if ($_REQUEST['redirect_uri'] == '' || !in_array($_REQUEST['redirect_uri'], $allowed_callbaks)) {
        return _api_error('invalid_request_uri', 'Callback not registred 1 :' . $_REQUEST['redirect_uri']); //Force l'arrêt
    }

    //Recherche du token
    $tok = new Modele('api_tokens');
    $tok->find(array(
        'at_client' => $cli->getKey(),
        'at_code' => $_REQUEST['code'],
        'at_type' => 'AUTH',
    ));
    if (!$tok->next()) {
        return _api_error('invalid_grant', 'API token not found.');
    }

    if ($tok->at_expire < time()) {
        return _api_error('invalid_grant', 'API token too old.');
    }

    if ($tok->at_uri != '' && (!isset($_REQUEST['redirect_uri']) || $tok->at_uri != $_REQUEST['redirect_uri'])) {
        return _api_error('invalid_request', 'Request URI invalid');
    }

    $update = array(
        'at_type' => 'ACCESS',
        'at_code' => md5(uniqid('', true)),
        'at_start' => time(),
        'at_expire' => time() + 3600,
    );

    if (!$tok->modFrom($update)) {
        return _api_error('server_error', 'API token update.');
    }

    //Reponse
    $config = _api_config();

    $header = array(
        'alg' => 'RS256',
        'typ' => 'JWT',
            //'kid' => 12, // Key ID
    );

    $claims = array(
        'iss' => $config['issuer'],
        'sub' => $update['at_code'],
        'aud' => $cli->ac_client,
        'exp' => $update['at_expire'],
        'iat' => $update['at_start'],
    );
    if ($tok->at_nonce != '') {
        $claims['nonce'] = $tok->at_nonce;
    }

    $payload = base64url_encode(json_encode($header)) . '.' . base64url_encode(json_encode($claims));

    $token = array(
        'id_token' => $payload . '.' . base64url_encode(_api_sign($payload)),
        'access_token' => $update['at_code'],
        'token_type' => 'bearer',
        'expires_in' => 3600,
    );

    if ($tok->at_scope != '') {
        $token['scope'] = $tok->at_scope;
    }

    echo json_encode($token);
    quit();
}

function api_jwks() {
    global $srcdir, $config, $pdo;

    if (!isset($config['api']['rsakey']) || $config['api']['rsakey'] == '') {
        $key = openssl_pkey_new(array(
            'private_key_bits' => 512,
            'encrypt_key' => false,
        ));
        $update = isset($config['api']['rsakey']);
        openssl_pkey_export($key, $config['api']['rsakey']);
        if ($update) {
            $sql = $pdo->prepare('UPDATE config SET value = ? WHERE name = \'api!!rsakey\'');
        } else {
            $sql = $pdo->prepare('INSERT INTO config (value, name, env) VALUES (?, \'api!!rsakey\', \'def\')');
        }
        $sql->bindValue(1, $config['api']['rsakey']);
        $sql->execute();
    }

    $pub = openssl_pkey_get_private($config['api']['rsakey']);
    $ext = openssl_pkey_get_details($pub);

    $jwks = array(
        'keys' => array(
            array(
                'alg' => 'RSA',
                //'kid' => 1, //Key by ID
                'kty' => 'RSA', //Key by algo
                'n' => base64url_encode($ext['rsa']['n']),
                'e' => base64url_encode($ext['rsa']['e']),
            )
        ),
    );
    echo json_encode($jwks);
    quit();
}

function _api_getUser() {
    $tok = new Modele('api_tokens');
    $tok->find(array(
        'at_code' => $_REQUEST['access_token'],
        'at_type' => 'ACCESS',
    ));
    if (!$tok->next()) {
        _api_error('invalid_grant', 'API token not found.');
        return null;
    }
    return $tok->at_user;
}

function api_userinfo() {
    $usr = _api_getUser();
    if ($usr === null) {
        return;
    }

    $infos = array(
        'sub' => $usr->user_id,
        'name' => $usr->user_name,
        'given_name' => $usr->user_firstname,
        'family_name' => $usr->user_lastname,
        'nickname' => $usr->user_name,
        'email' => $usr->user_email,
        'email_verified' => false,
        'gender' => $usr->user_sexe == 'GIRL' ? 'female' : 'male',
        'birthdate' => $usr->user_born,
        'phone_number' => $usr->user_phone,
        'phone_number_verified' => false,
        'acl' => $usr->raw_user_role,
        'groups' => array(),
    );

    $sections = new Modele('user_sections');
    $sections->find(array('us_user' => $usr->getKey()));

    while ($sections->next()) {
        $infos['groups'][] = array(
            'gid' => $sections->us_section->section_id,
            'name' => $sections->us_section->section_name,
            'role' => $sections->raw_us_type,
        );
    }

    echo json_encode($infos);
    quit();
}
