<?php
require_once("../../../include/config.php");
require_once($basedir . "/admin/include/functions.php");
$private_key = $config['private_key'];

$hash = (isset($_POST['hash'])) ? $_POST['hash'] : 0;
$public_key = (isset($_POST['public'])) ? $_POST['public'] : 0;
$time = (isset($_POST['t'])) ? $_POST['t'] : 0;
$myhash = md5($public_key . $private_key . $time);
if ($hash != $myhash) {
	echo json_encode(array('error' => '1', 'status' => 'Hash is invalid'));
	exit;
}

$bot_system = (isset($_POST['botSystem'])) ? $_POST['botSystem'] : 0;
$bot_username = (isset($_POST['botUsername'])) ? $_POST['botUsername'] : 0;

$bool = setBotSystem($bot_system, $bot_username);
if ($bool) {
	echo json_encode(array('error' => '', 'status' => $bool));
	exit;
} else {
	echo json_encode(array('error' => '1', 'status' => 'fail'));
	exit;
}

?>