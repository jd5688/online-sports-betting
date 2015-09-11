<?php
session_start();
require_once("../include/config.php");
require_once($basedir . "/include/functions.php");
$data = array();
$private_key = $config['private_key'];

$hash = (isset($_POST['hash'])) ? $_POST['hash'] : 0;
$public_key = (isset($_POST['public'])) ? $_POST['public'] : 0;
$time = (isset($_POST['t'])) ? $_POST['t'] : 0;


$myhash = md5($public_key . $private_key . $time);

if ($hash != $myhash) {
	echo json_encode(array('error' => 1, 'status' => 'Hash is invalid'));
	exit;
}

$email = (isset($_POST['email'])) ? $_POST['email'] : false;
$pword = (isset($_POST['p'])) ? $_POST['p'] : false;
$ksi = (isset($_POST['ksi'])) ? $_POST['ksi'] : false;

$data = login(htmlspecialchars($email), htmlspecialchars($pword));

if ($data) {
	$_SESSION['user_id'] = $data['user_id'];
	$_SESSION['user_name'] = $data['user_name'];
	$_SESSION['user_email'] = $data['user_email'];
	$_SESSION['user_fullname'] = $data['user_fullname'];
	$_SESSION['user_coins'] = $data['user_coins'];
	$_SESSION['user_password'] = $data['user_password']; 
	$_SESSION['user_lang'] = $data['user_lang']; 
	$_SESSION['user_pic'] = $data['user_pic'];

	if ($ksi == 'true') {
		setcookie("keep_signed_in", '1', time() + (86400*100), '/'); // 100 days 
		setcookie("email", $data['user_email'], time() + (86400*100), '/'); // 100 days 
		setcookie("password", $pword, time() + (86400*100), '/'); // 100 days 
	} else {
		setcookie("keep_signed_in", '0', time() + (86400*100), '/'); // 100 days 
	}

	echo json_encode(array('error' => 0, 'status' => 'success'));
	exit;
} else {
	echo json_encode(array('error' => 1, 'status' => 'authentication failure'));
	exit;
}
?>