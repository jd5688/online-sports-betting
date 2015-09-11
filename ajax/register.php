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
$username = (isset($_POST['uname'])) ? $_POST['uname'] : false;

$data = register(htmlspecialchars($email), htmlspecialchars($username));

if ($data == 'success') {
	$newdata = array();
	$all_users = getAllUsers();
	foreach($all_users as $au) {
		$newdata[$au['user_id']] = $au;
	}
	recreateCache('all_users.txt', $newdata);

	echo json_encode(array('error' => 0, 'status' => $data)); // 'success'
	exit;
} else {
	echo json_encode(array('error' => 1, 'status' => $data));
	exit;
}
?>