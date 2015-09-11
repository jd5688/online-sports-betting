<?php
session_start();
require_once("../include/config.php");
require_once($basedir . "/include/functions.php");

$private_key = $config['private_key'];

$hash = (isset($_POST['hash'])) ? $_POST['hash'] : 0;
$public_key = (isset($_POST['public'])) ? $_POST['public'] : 0;
$time = (isset($_POST['t'])) ? $_POST['t'] : 0;


$myhash = md5($public_key . $private_key . $time);

/*
if ($hash != $myhash) {
	echo json_encode(array('error' => '1', 'status' => $lang[215]));
	exit;
}
*/

$g_id = (isset($_POST['game_id'])) ? $_POST['game_id'] : 0;
$comm = (isset($_POST['comm'])) ? $_POST['comm'] : 0; // house commission

if (!$g_id) { exit; }
// check if this game is already closed
if (checkGameisClosed($g_id)) {
	// return with message
	echo json_encode(array('error' => '0', 'status' => 'closed'));
	exit;
}

$bet_items = array();
// get all active bet items
$betitems_cache = $basedir . '/temp/bet_items_active.php';
if (file_exists($betitems_cache)) {
	$bet_items = json_decode(file_get_contents($betitems_cache), TRUE);
} else {
	$bet_items = getAllBetItemsNoWinnerAndWriteToCache();
}

$user_bets = array();
// get all active bet items
$userbets_cache = $basedir . '/temp/user_bets_active.php';
if (file_exists($userbets_cache)) {
	$user_bets = json_decode(file_get_contents($userbets_cache), TRUE);
} else {
	$user_bets = getAllUserBetsNoWinnerAndWriteToCache();
}


$all_bets = getAllBetsFromCache2($bet_items, $user_bets, $g_id);
$info_per_bet_item = getInfoPerBetItem($all_bets);
$user_may_earn = getUserMayEarn($info_per_bet_item, $comm);
if ($info_per_bet_item) {
	echo json_encode(array('error' => '0', 'status' => 'success', 'data' => array(0 => $info_per_bet_item, 1 => $user_may_earn)));
	//echo json_encode(array('error' => '0', 'status' => 'success', 'data' => $info_per_bet_item));
	exit;
}
?>