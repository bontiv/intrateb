<?php

/**
 * Controleur par défaut
 * Ce controleur permet d'afficher la page d'accueil du site, mais aussi aux
 * utilisateurs de se connecter. L'accès à ce module est forcé en mode publique
 * par le framework.
 * @package Epicenote
 */

/**
 * Petite page de présentation du projet
 * @global Template $tpl
 * @global PDO $pdo
 */
function index_index() {
	global $tpl, $pdo;

	$nbEvents = $pdo->query("SELECT COUNT(*) FROM events WHERE event_start > NOW()")->fetch();
	$tpl->assign('nbEvents', $nbEvents[0]);

	if (hasAcl(ACL_USER)) {
		$nbSQL = $pdo->prepare("SELECT COUNT(*) FROM card RIGHT JOIN mandate ON card_mandate = mandate_id AND mandate_end > NOW() WHERE card_user = ? AND card_status != 'NOPICTURE'");
		$nbSQL->bindValue(1, $_SESSION['user']['user_id']);
		$nbSQL->execute();
		$nbCards = $nbSQL->fetch();
		$tpl->assign('nbCards', $nbCards[0]);
	}

	$nbSQL = $pdo->prepare("SELECT COUNT(*) FROM ftp_users WHERE fu_member = ?");
	$nbSQL->bindValue(1, $_SESSION['user']['user_id']);
	$nbSQL->execute();
	$nbFtp = $nbSQL->fetch();
	$tpl->assign('nbFtp', $nbFtp[0]);

	$tpl->assign('isMember', hasAcl(ACL_USER));
	$tpl->display('index.tpl');
	quit();
}

/**
 * Permet de connecter un utilisateur
 * @global type $tpl
 * @global type $pdo
 */
function index_login() {
	global $tpl;

	$tpl->assign('msg', false);

	//Tentative de connexion
	if (isset($_POST['login'])) {
		if (isset($_POST['otp_code'])) {
			$result = login_user($_POST['login'], $_POST['password'], $_POST['otp_code']);
		} else {
			$result = login_user($_POST['login'], $_POST['password']);
		}

		if ($result === true) {
			$url = explode('/', $_REQUEST['redirect'], 3);
			$opt = array();
			if (isset($url[2])) {
				parse_str($url[2], $opt);
			}
			redirect($url[0], $url[1], $opt);
		}

		if ($result === -1) {
			//Erreur µ-1 = OTP requis
			if (isset($_POST['otp_code'])) {
				$tpl->assign('msg', 'Code erroné.');
			}
			$tpl->display('index_login_otp.tpl');
			quit();
		}
		// Et oui, pas de redirection = erreur de login ...
		$tpl->assign('msg', 'Utilisateur ou mot de passe erroné.');
	}

	$_SESSION['random'] = md5(uniqid());
	$tpl->assign('random', $_SESSION['random']);
	$tpl->display('index_login.tpl');
	quit();
}

/**
 * Ferme une session utilisateur
 * @global type $tpl
 */
function index_logout() {
	global $tpl;

	$_SESSION['user'] = false;
	redirect('index');
}

/**
 * Inscrire un nouvel utilisateur
 * Cette page permet à un visiteur de s'inscrire sur le site.
 */
function index_create() {
	global $tpl, $pdo;
	$tpl->assign('error', false);
	$tpl->assign('succes', false);

	if (isset($_POST['user_name'])) {
		$pass = md5($_POST['user_name'] . ':' . $_POST['user_pass']);

		$stm = $pdo->prepare('SELECT COUNT(*) FROM users WHERE user_name LIKE ?');
		$stm->bindValue(1, $_POST['user_name']);
		$stm->execute();
		$rst = $stm->fetch();
		if ($rst[0] == 0) {

			if (strlen($_POST['user_pass']) < 4) {
				$tpl->assign('error', 'Mot de passes pas assez long...');
			} elseif ($_POST['user_pass'] != $_POST['confirmPassword']) {
				$tpl->assign('error', 'Mot de passes différents...');
			} elseif (autoInsert('users', 'user_', array(
				'user_pass' => $pass,
				'user_role' => 'GUEST',
			))) {
				$tpl->assign('succes', true);
			} else {
				$tpl->assign('error', 'Erreur SQL...');
			}

		} else {
			//Block d'erreur utilisateur existant
			$tpl->assign('error', "Ce nom d'utilisateur est déjà utilisé.");
		}
	}

	$sql = $pdo->prepare('SELECT * FROM user_types');
	$sql->execute();
	while ($type = $sql->fetch()) {
		$tpl->append('types', $type);
	}

	$tpl->display('index_create.tpl');
	quit();
}

/**
 * Modification du profil utilisateur
 * @global type $tpl
 */
function index_profile() {
	global $tpl, $srcdir, $pdo;

	$mdl = new Modele('users');

	$mdl->fetch($_SESSION['user']['user_id']);

	if (isset($_POST['edit'])) {
		$tpl->assign('hsuccess', $mdl->modFrom($_POST));
	}

	if (isset($_POST['editpass'])) {
		if ($_POST['pwd1'] == '' || $_POST['oldpass'] != md5($_SESSION['user']['user_pass'] . $_SESSION['random'])) {
			$tpl->assign('hsuccess', false);
		} else {
			$tpl->assign('hsuccess', $mdl->modFrom(array('user_pass' => $_POST['pwd1']), false));
		}
	}

	$mdt = new Modele('mandate');
	if ($mdt->find('`mandate_start` < now() and `mandate_end` > now()')) {
		while ($line = $mdt->next()) {
			$tpl->append('mandate', $line);
		}
	}

	$mdtu = $pdo->prepare('SELECT * FROM user_mandate LEFT JOIN mandate ON um_mandate = mandate_id WHERE um_user = ? ORDER BY `mandate_end` DESC');
	$mdtu->bindValue(1, $_SESSION['user']['user_id']);
	$mdtu->execute();
	while ($line = $mdtu->fetch()) {
		$tpl->append('usr_mandate', $line);
	}

	$_SESSION['random'] = md5(uniqid('epicenote'));
	$tpl->assign('random', $_SESSION['random']);
	$tpl->assign('isMember', hasAcl(ACL_USER));
	$tpl->assign('form', $mdl->edit());

	$mdl = new Modele('card');
	$mdl->find(array('card_user' => $_SESSION['user']['user_id']));
	$l = $mdl->next();
	if (!$l) {
		$tpl->assign('cards', false);
	}
	while ($l) {
		$o = new Modele('card');
		$o->fetch($mdl->card_id);
		$tpl->append('cards', $o);
		$l = $mdl->next();
	}

	//GoogleAuthentificator
	require_once $srcdir . '/libs/GoogleAuthenticator/GoogleAuthenticator.php';
	$api = new GoogleAuthenticator();
	$_SESSION['user']['GoogleAuthenticator'] = $api->generateSecret();
	$tpl->assign('GoogleAuth', $api);
	//FIN GoogleAuthentificator

	display();
}

function index_subscriptions() {
	$sub = new Modele('subscription');
	if ($sub->find()) {
		//if ($sub->find(array('subscription_mandate' => $_GET['mandate']))) {
		while ($line = $sub->next()) {
			echo '<option value="' . $line['subscription_id'] . '">' . $line['subscription_label'] . ' (montant ' . $line['subscription_price'] . ' €)</option>';
		}
	}
	quit();
}

function index_print() {
	global $root, $srcdir, $tmpdir;

	include_once $srcdir . DS . 'libs' . DS . 'fpdf.php';
	include_once $srcdir . DS . 'libs' . DS . 'barcode.php';

	if (!isset($_POST['mandate'])) {
		$_POST['mandate'] = 1;
	}

	if (!isset($_POST['subscription'])) {
		$_POST['subscription'] = 1;
	}

	$mdt = new Modele('mandate');
	$mdt->fetch($_POST['mandate']);
	$sub = new Modele('subscription');
	$sub->fetch($_POST['subscription']);
	$usr = new Modele('users');
	$usr->fetch($_SESSION['user']['user_id']);
	$sublist = new Modele('subscription');
	//$sublist->find(array('subscription_mandate' => $mdt->mandate_id));
	$sublist->find();

	if (new DateTime($mdt->mandate_start) > new DateTime() || new DateTime($mdt->mandate_end) < new DateTime()) {
		modexec('syscore', 'moderror');
	}

	ob_start();

	$pdf = new FPDF();
	$pdf->AddPage();

	$pdf->SetXY(18, 12);
	$pdf->SetFont('Arial', '', 30);
	$pdf->Cell(180, 10, 'EPITANIME', 0, 0, 'C');

	$pdf->SetFont('Arial', '', 10);
	$pdf->SetXY(18, 21);
	$pdf->Cell(180, 5, 'FEUILLE DE RENSEIGNEMENTS ' . uc($mdt->mandate_label), 0, 0, 'C');
	$pdf->SetXY(18, 26);
	$pdf->Cell(180, 5, 'Veuillez remplir lisiblement en lettres capitales', 0, 0, 'C');

	$pdf->SetFont('Arial', 'B', 10);
	$pdf->SetXY(18, 35);
	$pdf->Cell(180, 5, 'Informations essentielles :', 0, 0, '');
	$pdf->SetXY(18, 40);
	$pdf->Cell(50, 5, 'Pseudo', 1, 0, '');
	$pdf->SetXY(18, 45);
	$pdf->Cell(50, 5, 'Nom', 1, 0, '');
	$pdf->SetXY(18, 50);
	$pdf->Cell(50, 5, uc('Prénom'), 1, 0, '');
	$pdf->SetXY(18, 55);
	$pdf->Cell(50, 5, 'Adresse', 1, 0, '');
	$pdf->SetXY(18, 60);
	$pdf->Cell(50, 5, 'Code postal', 1, 0, '');
	$pdf->SetXY(18, 65);
	$pdf->Cell(50, 5, 'Ville', 1, 0, '');
	$pdf->SetXY(18, 70);
	$pdf->Cell(50, 5, 'Sexe', 1, 0, '');
	$pdf->SetXY(18, 75);
	$pdf->Cell(50, 5, 'Date de naissance', 1, 0, '');
	$pdf->SetXY(18, 80);
	$pdf->Cell(50, 5, uc('Téléphone'), 1, 0, '');
	$pdf->SetXY(18, 85);
	$pdf->Cell(50, 5, 'Courriel', 1, 0, '');

	$pdf->SetXY(18, 95);
	$pdf->Cell(50, 5, uc('Réservé aux étudiants IONIS'), 0, 0, '');

	$pdf->SetXY(18, 100);
	$pdf->Cell(50, 5, 'Login', 1, 0, '');
	$pdf->SetXY(18, 105);
	$pdf->Cell(50, 5, 'Ecole', 1, 0, '');
	$pdf->SetXY(18, 110);
	$pdf->Cell(50, 5, 'Promotion', 1, 0, '');

	$pdf->SetXY(18, 120);
	$pdf->Cell(50, 5, uc('Réservé aux membres prenant l\'inscription FFG (fédération française de GO)'), 0, 0, '');

	$pdf->SetXY(18, 125);
	$pdf->Cell(50, 5, uc('Nationalité'), 1, 0, '');
	$pdf->SetXY(18, 130);
	$pdf->Cell(50, 5, 'Niveau', 1, 0, '');
	$pdf->SetXY(18, 135);
	$pdf->Cell(50, 5, 'Pseudo FFG', 1, 0, '');

	$pdf->SetFont('Arial', '', 12);
	$pdf->SetXY(18, 222);
	$pdf->Cell(160, 5, uc('Reçu par ______________________ le ___/___/20___ , accompagné de la cotisation choisie.'), 0, 0, '');

	$pdf->SetFont('Arial', 'B', 10);
	$pdf->SetXY(38, 230);
	$pdf->Cell(50, 5, 'Signature du membre', 1, 0, '');
	$pdf->Rect(38, 235, 50, 20);
	$pdf->SetXY(130, 230);
	$pdf->Cell(50, 5, uc('Signature du récepteur'), 1, 0, '');
	$pdf->Rect(130, 235, 50, 20);

	$pdf->SetFont('Arial', '', 8);
	$pdf->SetXY(18, 260);
	$pdf->MultiCell(180, 3, uc('Les informations recueillies sont nécessaires pour votre adhésion. Elles font l’objet d’un traitement informatique et sont destinées au secrétariat de l’association. En application de l’article 34 de la loi du 6 janvier 1978, vous bénéficiez d’un droit d’accès et de rectification aux informations qui vous concernent. Si vous souhaitez exercer ce droit et obtenir communication des informations vous concernant, veuillez vous adresser au secrétariat de l’association.'));

	$pdf->SetFont('Arial', '', 10);
	$pdf->SetXY(68, 40);
	$pdf->Cell(130, 5, uc($usr->user_name), 1, 0, '');
	$pdf->SetXY(68, 45);
	$pdf->Cell(130, 5, uc($usr->user_lastname), 1, 0, '');
	$pdf->SetXY(68, 50);
	$pdf->Cell(130, 5, uc($usr->user_firstname), 1, 0, '');
	$pdf->SetXY(68, 55);
	$pdf->Cell(130, 5, uc($usr->user_address), 1, 0, '');
	$pdf->SetXY(68, 60);
	$pdf->Cell(130, 5, uc($usr->user_cp), 1, 0, '');
	$pdf->SetXY(68, 65);
	$pdf->Cell(130, 5, uc($usr->user_town), 1, 0, '');
	$pdf->SetXY(68, 70);
	$pdf->Cell(130, 5, uc($usr->user_sexe), 1, 0, '');
	$pdf->SetXY(68, 75);
	$pdf->Cell(130, 5, uc($usr->user_born), 1, 0, '');
	$pdf->SetXY(68, 80);
	$pdf->Cell(130, 5, uc($usr->user_phone), 1, 0, '');
	$pdf->SetXY(68, 85);
	$pdf->Cell(130, 5, uc($usr->user_email), 1, 0, '');

	$pdf->SetXY(68, 100);
	$pdf->Cell(130, 5, uc($usr->user_login), 1, 0, '');
	$pdf->SetXY(68, 105);
	$pdf->Cell(130, 5, uc($usr->user_type->ut_name), 1, 0, '');
	$pdf->SetXY(68, 110);
	$pdf->Cell(130, 5, uc($usr->user_promo), 1, 0, '');

	$pdf->SetXY(68, 125);
	$pdf->Cell(130, 5, '', 1, 0, '');
	$pdf->SetXY(68, 130);
	$pdf->Cell(130, 5, '', 1, 0, '');
	$pdf->SetXY(68, 135);
	$pdf->Cell(130, 5, '', 1, 0, '');

	$pdf->SetFont('Arial', 'B', 10);
	$pdf->SetXY(18, 145);
	$pdf->Cell(50, 5, uc('Cotisation'), 0, 0, '');

	$cb = '9' . str_pad($mdt->getKey(), 4, '0', STR_PAD_LEFT) . str_pad($usr->getKey(), 7, '0', STR_PAD_LEFT);

	$cbfile = tempnam($tmpdir, 'cb');
	imagebarcode($cbfile, $cb, 200, 40, 2);
	$pdf->Image($cbfile, 10, 10, 30, 0, 'PNG');
	unlink($cbfile);

	$pdf->SetFont('Arial', 'I', 8);
	$pdf->SetXY(185, 10);
	$pdf->Cell(10, 5, $usr->getKey(), 0, 0, 'R');

	$pos = -1;
	$pdf->SetFont('Arial', '', 10);
	while ($c = $sublist->next()) {
		$pos++;

		$x = 25 + ($pos % 2) * 90;
		$y = 150 + 5 * floor($pos / 2);

		$pdf->SetXY($x, $y);
		$pdf->Cell(60, 5, uc($c['subscription_label']), 1, 0, '');
		$pdf->Cell(15, 5, number_format($c['subscription_price'], 2, ',', '') . ' ' . chr(128), 1, 0, '');
		$pdf->Rect($x + 75, $y, 5, 5);

		if ($c['subscription_id'] == $sub->subscription_id) {
			$pdf->SetFont('Arial', 'B', 12);
			$pdf->Cell(5, 5, 'X', 0, 0, 'C');
			$pdf->SetFont('Arial', '', 10);
		}
	}

	if (ob_get_flush() == '') {
		$pdf->Output('inscription.pdf', 'I');
	}
	quit();
}

function index_photoedit() {
	global $tmpdir;

	$ext = strtolower(strrchr($_FILES['photo']['name'], '.'));

	if ($ext == '.jpg' || $ext == '.jpeg') {
		$imgs = imagecreatefromjpeg($_FILES['photo']['tmp_name']);
	} elseif ($ext == '.png') {
		$imgs = imagecreatefrompng($_FILES['photo']['tmp_name']);
	} elseif ($ext == '.gif') {
		$imgs = imagecreatefromgif($_FILES['photo']['tmp_name']);
	}

	$sz = getimagesize($_FILES['photo']['tmp_name']);

	$imgd = imagecreatetruecolor(210, 270);
	imagefill($imgd, 0, 0, imagecolorallocate($imgd, 255, 255, 255));

	if ($sz[0] / 210 > $sz[1] / 270) {
		$w = 210;
		$h = ceil(210 * $sz[1] / $sz[0]);
	} else {
		$w = ceil(270 * $sz[0] / $sz[1]);
		$h = 270;
	}

	imagecopyresized($imgd, $imgs, (210 - $w) / 2, (270 - $h) / 2, 0, 0, $w, $h, $sz[0], $sz[1]);

	$usr = new Modele('users');
	$usr->fetch($_SESSION['user']['user_id']);

	$filename = tempnam($tmpdir, 'photo');
	error_reporting(E_ALL);
	imagepng($imgd, $filename);
	$usr->user_photo = $filename;
	redirect('index', 'profile');
}

function index_photo() {
	$usr = new Modele('users');
	$usr->fetch($_SESSION['user']['user_id']);

	header('Content-Type: image/png');
	readfile($usr->user_photo);
	quit();
}

function index_securimage_show() {
	global $srcdir;

	require_once $srcdir . '/libs/securimage/securimage_show.php';

	quit();
}

function index_password() {
	global $tpl;

	if (isset($_POST['valider'])) {
		$securimage = new Securimage();
		if ($securimage->check($_POST['captcha_code']) == false) {
			$tpl->assign('msg', 'Le captcha est incorrect');
			$tpl->assign('error_captcha', true);

			//catcha valide
		} else {
			// Recherche du membre
			$mdl = new Modele('users');
			$mdl->find(array('user_email' => $_POST['mail']));
			if (!$mdl->next()) {
				$tpl->assign('msg', 'L\'adresse email est introuvable');
				$tpl->assign('error_mail', true);

				// Membre existe
			} else {
				$_SESSION['index_password_code'] = uniqid();
				$_SESSION['index_password_email'] = $_POST['mail'];
				$tpl->assign('url', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . mkurl('index', 'password_change', array(
					session_name() => session_id(),
					'valid' => $_SESSION['index_password_code'],
				)));
				$mail = getMailer();
				$mail->AddAddress($_SESSION['index_password_email']);
				$mail->Subject = '[intra LATEB] mot de passe perdu';
				$mail->Body = $tpl->fetch('mail_password.tpl');
				$tpl->assign('msuccess', $mail->Send());
			}
		}
	}

	display();
}

function index_password_change() {
	global $tpl;

	if (!isset($_GET['valid']) || $_GET['valid'] != $_SESSION['index_password_code']) {
		$tpl->assign('hsuccess', false);
		modexec('index');
	}

	$mdl = new Modele('users');
	$mdl->find(array('user_email' => $_SESSION['index_password_email']));
	$mdl->next();

	if (isset($_POST['pwd1'])) {
		$success = $mdl->modFrom(array('user_pass' => $_POST['pwd1']), false);
		$tpl->assign('hsuccess', $success);
		if ($success) {
			unset($_SESSION['index_password_code']);
			$_SESSION['user'] = $mdl->toArray();
			$_SESSION['user']['role'] = aclFromText($mdl->user_role);
			$tpl->assign('_user', $_SESSION['user']);
			modexec('index');
		}
	}

	$tpl->assign('user', $mdl);
	display();
}

function index_error403() {
	header("HTTP/1.1 403 Unauthorized");

	display();
}
