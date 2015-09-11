<?php 
require_once('include/config.php');
require_once($basedir . "/include/functions.php");
require_once($basedir . "/include/user_functions.php");

if (!$user_id) { 
	header('Location: ' . $baseurl . '#login');
	exit;
}

$dashboardmenu='active';

$user = getUserFromCache($user_id); // getUser($user_id) will get user from DB
$account_is_complete = true;
$payinfo_is_complete = paymentInfoExists($user_id);
$withdraw_setting_is_complete = false;
$profile_is_complete = (!$user['user_fullname'] OR !$user['user_pic']) ? false : true;

$account_is_complete = (!$profile_is_complete OR !$payinfo_is_complete or !$withdraw_setting_is_complete) ? false : true;

if (checkCacheExists('all_coin_deals.txt')) {
	$all_coin_deals = getCoinDealsFromCache();
} else {
	$all_coin_deals = getCoinDeals();
}

$coin_deals = getUserCoinDeals($user_id, $all_coin_deals);
// get 7 days graph data
$from = time() - (60*60*24*7);
$to = time();
$graph = createGraphData($from, $to, $coin_deals);

// get all data
$fromto = getAllRange($coin_deals);
$from = $fromto['from'];
$to = $fromto['to'];
$ret = winLoseRatio($user_id, $from, $to, $coin_deals);

$pie = $ret['pie'];
$win_lose = $ret['data'];

$my_bets = currentBettingAndResultsGame($user_id);
$activities_array = getActivities($user_id);
//echo '<pre>';
//print_r($activities_array);
//exit;
if ($activities_array) {
	updateActivities($user_id);
	$activities = $activities_array['ret'];
}

include $basedir . '/views/dashboard_v.php';
?>