<?php
/*
	This cron renews all the caches
*/
require_once("../include/config.php");
require_once($basedir . "/include/functions.php");

//user_bets_active.php
getAllUserBetsNoWinnerAndWriteToCache();

//all_users.txt
$all_users = getAllUsers();
$file = $basedir . '/temp/all_users.txt';
$data = array();
foreach ($all_users as $au) {
	$data[$au['user_id']] = $au;
}
unlink($file);
file_put_contents($file, json_encode($data));

//all_coin_deals.txt
$coin_deals = getCoinDeals();
$file = $basedir . '/temp/all_coin_deals.txt';
$data = array();
foreach ($coin_deals as $cd) {
	$data[] = $cd;
}
unlink($file);
file_put_contents($file, json_encode($data));
?>