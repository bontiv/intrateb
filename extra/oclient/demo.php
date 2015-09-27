<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
header('Content-Type: text/plain');

require_once './phpseclib/Math/BigInteger.php';
require_once './phpseclib/Crypt/RSA.php';
require_once './lib/OpenIDConnectClient.php';

$oidc = new OpenIDConnectClient('http://localhost/epicenote/htdocs/api.php', 'ClientIDHere', 'ClientSecretHere');

$oidc->authenticate();

echo 'Pseudo: ' . $oidc->requestUserInfo('nickname') . "\n";
echo 'Nom: ' . $oidc->requestUserInfo('family_name') . "\n";
echo 'Prénom: ' . $oidc->requestUserInfo('given_name') . "\n";
echo 'Email: ' . $oidc->requestUserInfo('email') . "\n";

echo 'Epitanime ACL: ' . $oidc->requestUserInfo('acl') . "\n";

var_dump($oidc->requestUserInfo('groups'));
