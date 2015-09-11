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
$prev_page = (isset($_GET['prev_page']) AND $_GET['prev_page'] != '') ? $_GET['prev_page'] : $baseurl;
$q = (isset($_GET['q'])) ? $_GET['q'] : 'live'; // live; results; upcoming

if ($q == '') {
	header('Location: ' . $prev_page);
}

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
$games_file = $basedir . '/temp/all_games.txt';
if (file_exists($games_file)) {
	$all_games = json_decode(file_get_contents($games_file), true);
} else {
	$all_games = getAllGames();
}
if ($all_games) {
	$all_games = filterPublicGames($all_games);
	$q = strtolower($q);
	if (preg_match('/\s/',$q)) {
		$search = explode(" ", $q);
	} else {
		$search = array($q);
	}

	$exclude_words = array('from', 'is', 'to', 'the', 'a', 'from', 'for', 'when', 'on', 'in', 'at', 'then', 'and', 'therefore', 'however');
	foreach ($all_games as $ag) {
		$title = strtolower($ag['g_title' . $suffix]);
		$description = strtolower($ag['g_description' . $suffix]);
		$category = strtolower($ag['g_categories' . $suffix]);
		$tags = strtolower($ag['g_tags' . $suffix]);
		$betInfo = strtolower($ag['g_betInfo' . $suffix]);
		$addInfo = strtolower($ag['g_addInfo' . $suffix]);
		foreach ($search as $s) {
			if (in_array($s, $exclude_words)) { continue; }
			if (strstr($title, $s) OR strstr($category, $s) OR strstr($tags, $s) OR strstr($description, $s) OR strstr($betInfo, $s) OR strstr($addInfo, $s)) {
				$games[] = $ag;
			}
		}
	}
	$data = filterAllGames($games, $sort, $cat);
	// sort it
	$data = sortGames($data, $sort);
} // if $all_games

$total_data = count($data);
if ($user_id) {
	$user_coins = getUserCoins2($user_id); // how much coins does the user have?
	$_SESSION['user_coins'] = $user_coins;
}
include $basedir . '/views/search_v.php';
?>