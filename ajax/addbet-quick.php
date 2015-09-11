<?php
session_start();

if (!$_SESSION['user_id']) { exit; }

require_once("../include/config.php");
require_once($basedir . "/include/functions.php");

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
$bet_item = (isset($_POST['item'])) ? $_POST['item'] : '';
$bet_amount = (isset($_POST['bet'])) ? $_POST['bet'] : '';
//$bet_notify = (isset($_POST['notify'])) ? $_POST['notify'] : '';
$bet_notify = 0; // for historical purposes. this is no longer being used
$game_id = (isset($_POST['game_id'])) ? $_POST['game_id'] : '';
$is_trial = (isset($_POST['istrial'])) ? $_POST['istrial'] : 0;

$bi_id = getBetId($bet_item, $game_id);

// make sure these have value
if (!$bet_item OR !$bet_amount OR !$game_id) { 
	if (!$is_trial) {
		exit; 
	}
}

$bool = addBet($_SESSION['user_id'], $game_id, $bi_id, $bet_amount, $bet_notify);
if ($bool) {
	echo json_encode(array('error' => '0', 'status' => 'success'));
	exit;
}
?>