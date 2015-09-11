<?php
require_once('include/config.php');
require_once($basedir . "/include/functions.php");

$homemenu='active';
$notice_display = "none";
$item_radio = false;
$bet_radio = false;
$notify_radio = false;
$include_bet_modal = false;
$user_bettings = false;
$include_bet_status = false;
$disable_betting = false;
$is_future_game = false;
$is_closed = false;
$top_winners = false;
$bi_id_of_winner = false;
$win_item_placed_coins = 0;
$game_timer_id = "gameTimer";
$game_timer = false;
$user_won = false;
$user_congratulations_text = '';
$user_won_after_commission = false;
$user_may_earn = 0;
$notice = '';

$user_coins = getUserCoins($user_id); // how much coins does the user have?

// ex: details.php?game=Ng==
// 7: Nw==
// 2: Mg==
// 8: OA==
$game_id = base64_decode($_GET['game']);
if (!$game_id) {
	echo 'no game id. refresh to main page';
	//header('Location: ' . $baseurl);
	exit;
}
if ($user_id) {
	$is_liked = checkIsLiked($user_id, $game_id);
	$is_bookmarked = checkIsBookmarked($user_id, $game_id);
} else {
	$is_liked = false;
	$is_bookmarked = false;
}
//$game = getGame($game_id);
$game = getGameFromCache($game_id);
if (!$game) {
	header('Location: '. $baseurl);
	exit;
}

if ($user_coins < $game['g_coinPerBet'] AND !$game['g_isTrial']) {
	$disable_betting = true;
	$notice .= $lang[226]; // you have less than minimum coins...
	$notice_display = "block";
	$notice_class = 'needcoins';
}

$game_timer = $game['g_schedTo'];
$game_tags = $game['g_tags'];
$game_cat = $game['g_categories' . $suffix];
$game_cat_id = getCategoryId($game['g_categories']);
// if game has started
if ($game['g_schedFrom'] <= $time AND $game['g_isCancelled'] == 0 AND $game['g_isClosed'] == 0) {
	// if user is logged in
	if ($user_id) {
		$user_bettings = getUserBets($game_id, $user_id);

		if ($user_bettings) {
			$notice .= $lang[227];
			$notice_display = "block";
			$notice_class = "joined";
			$include_bet_status = true;
		}
	}

	$display_uri = ($user_bettings) ? "?q=yourgame&cat={$game_cat}&sort=time" : "?q=live&cat={$game_cat}&sort=time";
}

// if game has not yet started
if ($game['g_schedFrom'] > $time AND $game['g_isCancelled'] == 0 AND $game['g_isClosed'] == 0) {
	$is_future_game = true;
	$display_uri = ($user_bettings) ? "?q=yourgame&cat={$game_cat}&sort=time" : "?q=upcoming&cat={$game_cat}&sort=time";
	$game_timer = $game['g_schedFrom'];
	$game_timer_id = '';
	$temp = date('M d, Y h:i A', $game['g_schedFrom']);
	$notice .= str_replace('$DATE_VARIABLE', $temp, $lang[237]);
	$notice_display = "block";
	$notice_class = "notstarted";
}

$all_bets = getAllBets($game_id);
$game_placed_coins = getGameCoins($all_bets); // get total placed coins for this game
$total_joined = getTotalUsersJoined($all_bets); // count all users who played
$bet_items = getBetItems($game_id);
$disable_betting = (time() > $game['g_schedTo']) ? true : false; // disabled betting when game ended
foreach($bet_items as $bi) {
	$bet_items2[$bi['bi_id']] = $bi['bi_description' . $suffix]; // assign bi_id as key and bi_description as value
	$bi_id_of_winner = ($bi['bi_winner']) ? $bi['bi_id'] : $bi_id_of_winner;
}
$info_per_bet_item = getInfoPerBetItem($all_bets); // get placed coins, bet users, and ratio
$user_may_earn = getUserMayEarn($info_per_bet_item, $game['g_houseCom']);

// if game is already closed
if ($game['g_isClosed']) {
	$is_closed = true;
	$display_uri = ($user_bettings) ? "?q=yourgame&cat={$game_cat}&sort=time" : "?q=results&cat={$game_cat}&sort=time";
	$notice .= $lang[254]; // "This game already closed"
	$notice_display = "block";
	$notice_class = "gameclosed";
	$user_bettings = getUserBets($game_id, $user_id);
	$user_won = checkUserWon($user_id, $game_id);

	$top_winners = getTopWinners($info_per_bet_item, $bet_items2, $bi_id_of_winner); // get maximum of 10 top winners
	if ($user_won) {
		//$user_won_after_commission = $user_won - ($user_won * ($game['g_houseCom'] / 100));
		$user_congratulations_text = str_replace('$COIN_VARIABLE', $user_won_after_commission, $lang[257]);
	}
}

// if game has ended but not yet closed or judged
if (time() > $game['g_schedTo'] AND !$game['g_isClosed']) {
	$display_uri = ($user_bettings) ? "?q=yourgame&cat={$game_cat}&sort=time" : "?q=results&cat={$game_cat}&sort=time";
	$notice = $lang[556];
	$notice_display = "block";
	$notice_class = "judgement";
} else {
	// if this is a trial game and game is not yet closed
	if ($game['g_isTrial'] AND !$game['g_isClosed']) {
		$notice = $lang[557];
		$notice_display = "block";
		$notice_class = "freebet";
	}
}

$high_bet_users = getHighBetUsers($info_per_bet_item, $bet_items2); // get top betting users
$tags = explode(',', $game['g_tags' . $suffix]);
$bet_minimum = $game['g_betMinimum']; // called by $lang[228]
$minimum_reached = ($game_placed_coins < $bet_minimum) ? false : true; // if game reached its minimum bet coins

// check if user submitted a bet
if (isset($_POST['item_radio']) AND isset($_POST['bet_radio'])) {
	$item_radio = $_POST['item_radio'];
	$bet_radio = $_POST['bet_radio'];
	$notify_radio = (isset($_POST['notify_radio'])) ? $_POST['notify_radio'] : 0;
	$include_bet_modal = true;
	if (!$user_id) {
		// this is redundant. user will not be able to bet if not logged in.
		// but i put it here anyways.
		header('Location: ' . $baseurl . '/login.php');
		exit;
	}
}

// betarea pre-set bets
$coinperbet = $game['g_coinPerBet'];
$betarr = array(
		$coinperbet, $coinperbet * 2, $coinperbet * 3, $coinperbet * 4, $coinperbet * 5, ($coinperbet * 5) * 2
	);

// for getting related games
$temp = array();
$related_games = array();
$games_file = $basedir . '/temp/all_games.txt';
if (file_exists($games_file)) {
	$all_games = json_decode(file_get_contents($games_file), true);
} else {
	$all_games = getAllGames();
}
$all_games = filterPublicGames($all_games);
if ($user_id) {
	$my_likes = getLikes($user_id);
	$my_bookmarks = getBookmarks($user_id);
} else {
	$my_likes = false;
	$my_bookmarks = false;
}

$i = 0;
foreach ($all_games as $ag) {
	if ($LANGUAGE == 'en') {
		$this_field = 'g_engPage';
	} else {
		$this_field = 'g_japPage';
	}
	if ($i == $config['list_area_recs_per_page']) { break; }
	$agtags = $ag['g_tags'];
	$agcat = $ag['g_categories' . $suffix];
	if ($ag['g_id'] !== $game_id AND $ag[$this_field] == 1) {
		if (compareTags($game_tags, $agtags)) {
			$temp[] = $ag;
			$i++;
		} elseif ($agcat == $game_cat) {
			$temp[] = $ag;
			$i++;
		}
	}
}
$related_games = filterAllGames($temp, '', 'all');

include 'views/details_v.php';
?>