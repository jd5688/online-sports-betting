<?php
/*
	This cron checks each LIVE game if minimum bet was reached
	within 15 minutes before betting ends.
	Will cancel game if minimum bet not reached.
*/
require_once("../include/config.php");
require_once($basedir . "/include/functions.php");

// get all user bets cache
$cachefile = $basedir . '/temp/user_bets_active.php';
if (file_exists($cachefile)) {
	$all_bets = json_decode(file_get_contents($cachefile), TRUE);
} else {
	$all_bets = getAllUserBetsNoWinnerAndWriteToCache();
}

$time1 = time();
$time2 = time() + (60*60*15);
$where = "g_schedTo >= '$time1' AND g_schedTo <= '$time2' AND g_betMinimum > 0 AND g_isClosed = 0";
$all_games = getAllGames($where); // get all the games

if ($all_games) {
	foreach ($all_games as $ag) {
		$total_coins = 0;
		$g_id = $ag['g_id'];
		$bet_minimum = $ag['g_betMinimum'];
		if ($all_bets) {
			foreach ($all_bets as $ab) {
				if ($ab['g_id'] == $g_id) {
					$total_coins += $ab['ub_coins'];
				}
			}
		} else {
			break;
		}

		if ($bet_minimum > $total_coins) {
			cancelGame($g_id); // cancel this game
		}
	} // foreach $all_games
}
?>