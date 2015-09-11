<?php
session_start();
require_once("../../../include/config.php");
require_once($basedir . "/admin/include/functions.php");

$private_key = $config['private_key'];

$hash = (isset($_POST['hash'])) ? $_POST['hash'] : 0;
$public_key = (isset($_POST['public'])) ? $_POST['public'] : 0;
$time = (isset($_POST['t'])) ? $_POST['t'] : 0;


$myhash = md5($public_key . $private_key . $time);

if ($hash != $myhash) {
	echo json_encode(array('error' => '1', 'status' => $lang[215]));
	exit;
}


$game_id = (isset($_POST['game_id'])) ? $_POST['game_id'] : '';
if (!$game_id) {
	echo json_encode(array('error' => '1', 'status' => $lang[213]));
	exit;
}

$bool = deleteGame($game_id);

if ($bool) {
	// erase the cache
	$filename = $basedir . '/temp/all_games.txt';
	if (file_exists($filename)) {
		unlink($filename);
	}
	
	echo json_encode(array('error' => '0', 'status' => 'success'));
	exit;
}
?>