<?php 
require_once('include/config.php');
require_once($basedir . "/include/functions.php");
require_once($basedir . "/include/user_functions.php");

if (!$user_id) { 
	header('Location: ' . $baseurl . '#login');
	exit;
}
$temp = array();
$user = getUserFromCache($user_id);
$range = (isset($_GET['range'])) ? $_GET['range'] : '30';
$from_y = (isset($_GET['fy'])) ? $_GET['fy'] : false;
$from_m = (isset($_GET['fm'])) ? $_GET['fm'] : false;
$from_d = (isset($_GET['fd'])) ? $_GET['fd'] : false;
$to_y = (isset($_GET['ty'])) ? $_GET['ty'] : false;
$to_m = (isset($_GET['tm'])) ? $_GET['tm'] : false;
$to_d = (isset($_GET['td'])) ? $_GET['td'] : false;
$graph_label = '';
$graph_label2 = '';
$graph_label3 = '';

if (checkCacheExists('all_coin_deals.txt')) {
	$all_coin_deals = getCoinDealsFromCache();
} else {
	$all_coin_deals = getCoinDeals();
}

$temp = getUserCoinDeals($user_id, $all_coin_deals);
for ($i = count($temp) - 1; $i > -1; $i--) {
	$coin_deals[] = $temp[$i];
}

$from = ($from_y AND $from_m AND $from_d) ? true : false;
$to = ($to_y AND $to_m AND $to_d) ? true : false;

if (!$from OR !$to) {
	// get range
	switch ($range) {
		case '30': // last 30 days
			$from = time() - (60*60*24*30);
			$to = time();
			$graph_label = $lang[358];
			$graph_label2 = $lang[365];
			$graph_label3 = $lang[381];
			break;
		case 'today':
			$from = strtotime(date('Y-m-d 00:00:00'));
			$to = $from; // breakdownTransactions() function will add 23 hours, 59 mins and 59 secs later
			$graph_label = $lang[361];
			$graph_label2 = $lang[143];
			$graph_label3 = $lang[384];
			break;
		case 'yesterday':
			$from = strtotime(date('Y-m-d 00:00:00')) - 86400; // less one day
			$to = $from; // breakdownTransactions() function will add 23 hours, 59 mins and 59 secs later
			$graph_label = $lang[361];
			$graph_label2 = $lang[144];
			$graph_label3 = $lang[384];
			break;

		/*
		case 'thisyear':
			$str = "first day of January ". date('Y');
			$from = strtotime($str);
			$str = "last day of December ". date('Y');
			$to = strtotime($str);
			$graph_label = $lang[361];
			$graph_label2 = $lang[368];
			$graph_label3 = $lang[384];
			break;
		case 'lastyear':
			$str = "first day of January ". (date('Y') - 1);
			$from = strtotime($str);
			$str = "last day of December ". (date('Y') - 1);
			$to = strtotime($str);
			$graph_label = $lang[362];
			$graph_label2 = $lang[369];
			$graph_label3 = $lang[385];
			break;
		*/
		case '7':
			$from = time() - (60*60*24*7);
			$to = time();
			$graph_label = $lang[360];
			$graph_label2 = $lang[367];
			$graph_label3 = $lang[383];
			break;
		case 'month':
			$from = strtotime('first day of this month', time());
			$to = time();
			$graph_label = $lang[359];
			$graph_label2 = $lang[366];
			$graph_label3 = $lang[382];
			break;
		default:
			$fromto = getAllRange($coin_deals);
			$from = $fromto['from'];
			$to = $fromto['to'];
			$graph_label = $lang[363];
			$graph_label2 = $lang[370];
			$graph_label3 = $lang[386];
			// get all records
			break;
	}

	$from_y = date('Y', $from);
	$from_m = date('m', $from);
	$from_d = date('d', $from);
	$to_y = date('Y', $to);
	$to_m = date('m', $to);
	$to_d = date('d', $to);
} else {
	$strinf = "$from_y-$from_m-$from_d";
	$strint = "$to_y-$to_m-$to_d";
	$from = strtotime($strinf);
	$to = strtotime($strint);

	$graph_label = $lang[364];
	$graph_label = str_replace('$FROM_VARIABLE', date('Y-m-d', $from), $graph_label);
	$graph_label = str_replace('$TO_VARIABLE', date('Y-m-d', $to), $graph_label);
	$graph_label2 = $lang[371];
	$graph_label2 = str_replace('$FROM_VARIABLE', date('Y-m-d', $from), $graph_label2);
	$graph_label2 = str_replace('$TO_VARIABLE', date('Y-m-d', $to), $graph_label2);
	$graph_label3 = $lang[404];
	$graph_label3 = str_replace('$FROM_VARIABLE', date('Y-m-d', $from), $graph_label3);
	$graph_label3 = str_replace('$TO_VARIABLE', date('Y-m-d', $to), $graph_label3);
}

$graph = createGraphData($from, $to, $coin_deals);
$transactions_array = breakdownTransactions($user_id, $from, $to, $coin_deals);
$transactions = $transactions_array['transactions'];
$details = $transactions_array['details'];

$balancemenu='active';

include $basedir . '/views/balance_v.php';
?>