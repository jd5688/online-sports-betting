<?php
session_start();
require_once("../include/config.php");
require_once($basedir . "/include/functions.php");
require_once($basedir . "/include/user_functions.php");

$private_key = $config['private_key'];

$hash = (isset($_POST['hash'])) ? $_POST['hash'] : 0;
$public_key = (isset($_POST['public'])) ? $_POST['public'] : 0;
$time = (isset($_POST['t'])) ? $_POST['t'] : 0;


$myhash = md5($public_key . $private_key . $time);

if ($hash != $myhash) {
	echo json_encode(array('error' => 1, 'status' => 'Hash is invalid'));
	exit;
}

$bio = (isset($_POST['bio'])) ? $_POST['bio'] : false;
$fullname = (isset($_POST['fn'])) ? $_POST['fn'] : false;
$sex = (isset($_POST['sex'])) ? $_POST['sex'] : false;
$web = (isset($_POST['web'])) ? $_POST['web'] : false;
$ra = (isset($_POST['ra'])) ? $_POST['ra'] : false; // remove avatar

if ($ra) {
	$_SESSION['user_pic'] = '';
}

$bool = editUserProfile($user_id, $bio, $fullname, $sex, $web, $ra);

if ($bool) {
	echo json_encode(array('error' => 0, 'status' => $bool, 'message' => $lang[344]));
	exit;
}
?>