<?php 
require_once('include/config.php');
require_once($basedir . "/include/functions.php");

if ($user_id) {
	$my_likes = getLikes($user_id);
	$my_bookmarks = getBookmarks($user_id);
} else {
	$my_likes = false;
	$my_bookmarks = false;
}
$user_coins = 0;
$homemenu='active';
$public_key = $config['public_key'];
$time = time();
$games = false;
$hash = md5($public_key . $config['private_key'] . $time);
$data = array();
$categories = getCategories();
$cat = (isset($_GET['cat']) AND $_GET['cat'] != '') ? $_GET['cat'] : 'all';
$sort = (isset($_GET['sort']) AND $_GET['sort'] != '') ? $_GET['sort'] : 'time'; // time; coin; new; likes
$q = (isset($_GET['q']) AND $_GET['q'] != '') ? $_GET['q'] : 'live'; // live; results; upcoming
$page = (isset($_GET['page']) AND $_GET['page'] != '') ? $_GET['page'] : '1';
$cat_label = ($cat == 'all') ? $lang[280] : ucfirst($cat);
if (!$cat_label) { exit; }
if ($sort == 'time') {
	$sort_label = $lang[281]; // End Time
} elseif ($sort == 'coin') {
	$sort_label = $lang[282]; // Placed COIN
} elseif ($sort == 'new') {
	$sort_label = $lang[283]; // New Game
} elseif ($sort == 'like') {
	$sort_label = $lang[284]; // like
} else {
	exit;
}

//$is_live_data = ($q == 'live') ? true : false;
$is_yourgame = ($q == 'yourgame') ? true : false;
$games_file = $basedir . '/temp/all_games.txt';
if (file_exists($games_file)) {
	$all_games = json_decode(file_get_contents($games_file), true);
} else {
	$all_games = getAllGames();
}
if ($all_games) {
	$all_games = filterPublicGames($all_games);
	if ($q == 'yourgame') {
		$temp = array();
		$mybets = getUserBetsGroupByGameId($user_id);
		foreach ($all_games as $ag) {
			$temp[$ag['g_id']] = $ag;
		}
		foreach ($mybets as $mb) {
			$g_id = $mb['g_id'];
			if (isset($temp[$g_id])) {
				$games[] = $temp[$g_id];
			}
		}
		$data = filterAllGames($games, $sort, $cat);
	} elseif ($q == 'upcoming') {
		$now = time();
		foreach ($all_games as $ag) {
			$sched_from = $ag['g_schedFrom'];
			if ($sched_from > $now) {
				$games[] = $ag;
			}
		}
		$data = filterAllGames($games, $sort, $cat);
	} elseif ($q == 'results') {
		foreach ($all_games as $ag) {
			$now = time();
			$to = $ag['g_schedTo'];
			$is_closed = $ag['g_isClosed'];
			if ($is_closed  OR ($now > $to AND $ag['g_isClosed'] == 0)) {
				$games[] = $ag;
			}
		}
	
		$data = filterAllGames($games, $sort, $cat);
	} else {
		// live
		foreach ($all_games as $ag) {
			$now = time();
			$from = $ag['g_schedFrom'];
			$to = $ag['g_schedTo'];
			$is_closed = $ag['g_isClosed'];
			if (!$is_closed AND $now > $from AND $now < $to) {
				$games[] = $ag;
			}
		}
		$data = filterAllGames($games, $sort, $cat);
	}
	// sort it
	$data = sortGames($data, $sort);
} // if $all_games
$total_data = count($data);
if ($user_id) {
	$user_coins = getUserCoins2($user_id); // how much coins does the user have?
	$_SESSION['user_coins'] = $user_coins;
}
include $basedir . '/views/index_v.php';
?>