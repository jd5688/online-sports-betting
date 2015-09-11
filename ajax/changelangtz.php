<?php
require_once("../include/config.php");
require_once($basedir . "/include/user_functions.php");

$saved = $lang[344];
if (!$user_id) { exit; }

$private_key = $config['private_key'];

$hash = (isset($_POST['hash'])) ? $_POST['hash'] : 0;
$public_key = (isset($_POST['public'])) ? $_POST['public'] : 0;
$time = (isset($_POST['t'])) ? $_POST['t'] : 0;


$myhash = md5($public_key . $private_key . $time);

if ($hash != $myhash) {
	echo json_encode(array('error' => '1', 'status' => $lang[215]));
	exit;
}

$bool = false;
$lang = (isset($_POST['lang'])) ? $_POST['lang'] : '';
$tz = (isset($_POST['tz'])) ? $_POST['tz'] : '';

if (!$lang AND !$tz) { exit; }

$bool = changeLangAndTz($lang, $tz, $user_id);
if ($bool) {
	if ($tz) {
		$_SESSION['user_timezone'] = $tz;
	}
	if ($lang) {
		$_SESSION['user_lang'] = $lang;
		$_SESSION['language'] = $lang;
	}
	echo json_encode(array('error' => '0', 'status' => 'success', 'message' => $saved));
	exit;
}
?>