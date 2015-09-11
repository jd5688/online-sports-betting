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
	//echo json_encode(array('error' => 1, 'status' => 'Hash is invalid'));
	//exit;
}

$g_id = (isset($_POST['game_id'])) ? $_POST['game_id'] : false;
$game = getGameFromCache($g_id);

echo '<pre>';
print_r($game);
exit;

if ($data) {
	echo json_encode(array('error' => 0, 'status' => 'success'));
	exit;
} else {
	echo json_encode(array('error' => 1, 'status' => 'authentication failure'));
	exit;
}
?>