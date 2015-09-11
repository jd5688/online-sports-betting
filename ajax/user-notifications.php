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

$ms = (isset($_POST['ms'])) ? $_POST['ms'] : false; // mail_sports
$gr = (isset($_POST['gr'])) ? $_POST['gr'] : false; // game_result user_notify
$gd = (isset($_POST['gd'])) ? $_POST['gd'] : false; // game_digest
$mr = (isset($_POST['mr'])) ? $_POST['mr'] : false; // mail_remind 30 mins
$sn = (isset($_POST['sn'])) ? $_POST['sn'] : false; // site_news

$bool = updateUserNotifications($user_id, $ms, $gr, $gd, $mr, $sn);

if ($bool) {
	echo json_encode(array('error' => 0, 'status' => $bool, 'message' => $lang[344]));
	exit;
}
?>