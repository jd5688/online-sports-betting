<?php
session_start();
require_once("../include/config.php");
require_once($basedir . "/include/functions.php");
require_once($basedir . "/include/user_functions.php");

if (!$user_id) { exit; }

$private_key = $config['private_key'];

$hash = (isset($_POST['hash'])) ? $_POST['hash'] : 0;
$public_key = (isset($_POST['public'])) ? $_POST['public'] : 0;
$time = (isset($_POST['t'])) ? $_POST['t'] : 0;


$myhash = md5($public_key . $private_key . $time);

if ($hash != $myhash) {
	echo json_encode(array('error' => 1, 'status' => 'Hash is invalid'));
	exit;
}

$priv_page = (isset($_POST['pp'])) ? $_POST['pp'] : false; // mail_sports
$priv_result = (isset($_POST['pr'])) ? $_POST['pr'] : false; // game_result user_notify

$bool = updateUserPrivacy($user_id, $priv_page, $priv_result);

if ($bool) {
	echo json_encode(array('error' => 0, 'status' => $bool, 'message' => $lang[344]));
	exit;
}
?>