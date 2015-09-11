<?php
require_once("../../../include/config.php");
require_once($basedir . "/admin/include/functions.php");
$private_key = $config['private_key'];

//computeGameResult(6, 12);
//exit;

$hash = (isset($_POST['hash'])) ? $_POST['hash'] : 0;
$public_key = (isset($_POST['public'])) ? $_POST['public'] : 0;
$time = (isset($_POST['t'])) ? $_POST['t'] : 0;
$myhash = md5($public_key . $private_key . $time);
if ($hash != $myhash) {
	echo json_encode(array('error' => 'Hash is invalid'));
	exit;
}


$game_id = (isset($_POST['gi'])) ? $_POST['gi'] : 0;
$bi_id = (isset($_POST['wi'])) ? $_POST['wi'] : 0; // winning item
$comm = (isset($_POST['comm'])) ? $_POST['comm'] : 0; // commission
$total_coins = (isset($_POST['tc'])) ? $_POST['tc'] : 0; // total bets in coins

$data = computeGameResult($game_id, $bi_id, $comm, $total_coins);

if ($data) {
	echo json_encode($data);
	//echo json_encode(array('error' => '', 'status' => 'success', 'data' => $data));
	exit;
} else {
	echo json_encode(array('error' => '', 'status' => 'fail'));
	exit;
}

?>