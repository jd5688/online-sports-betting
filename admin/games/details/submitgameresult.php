<?php
require_once("../../../include/config.php");
require_once($basedir . "/admin/include/functions.php");
$private_key = $config['private_key'];

$hash = (isset($_POST['hash'])) ? $_POST['hash'] : 0;
$public_key = (isset($_POST['public'])) ? $_POST['public'] : 0;
$time = (isset($_POST['t'])) ? $_POST['t'] : 0;
$myhash = md5($public_key . $private_key . $time);

if ($hash != $myhash) {
	echo json_encode(array('error' => 'Hash is invalid'));
	exit;
}

$bool = false;

$game_id = (isset($_POST['gi'])) ? $_POST['gi'] : 0;
$bi_id = (isset($_POST['wi'])) ? $_POST['wi'] : 0; // winning item
$coin_div = (isset($_POST['div'])) ? $_POST['div'] : 0; // commission
$is_cancel = (isset($_POST['cancel'])) ? $_POST['cancel'] : 0; // cancel this game
$house_com = (isset($_POST['hc'])) ? $_POST['hc'] : 0; // house commission
$total_bet_amt =  (isset($_POST['tc'])) ? $_POST['tc'] : 0; // total coins bet for this game

if ($is_cancel != 'false') {
	// cancel the game; return bets
	cancelGame($game_id);
	$user_bets = getUserBets($game_id); // get all user bets from this game
	$bool = returnUserBets($user_bets, $game_id, true); // insert to coin_deals table and update users' COIN. true means it's cancelled
} else {
	// close the game; process winners
	closeGame($game_id); // close this game
	setBetItemWinner($bi_id); // bet_item db table
	setUserBetWinners($game_id, $bi_id); // tag the winners in user_bets db table
	$winners = getUserBetWinners($game_id, $bi_id); // get all user bets that won from this game
		//$total_bet_amt = returnUserBets($winners); // return users' bets and update users' coins
	$house_com_amt = ($house_com / 100) * $total_bet_amt;
	$total_bet_amt_after_commission = $total_bet_amt - $house_com_amt;
	
	if ($total_bet_amt) {
		insertHouseCommission($game_id, $house_com_amt); // insert house commission in coin_deals
	}
	$bool = insertUserWinnings($winners, $coin_div, $total_bet_amt, $game_id); // insert users' winnings and update users' coins
}

if ($bool) {
	$all_users = getAllUsers();
	recreateCache('all_users.txt', $all_users);
	getAllUserBetsNoWinnerAndWriteToCache(); // rewrite 'all_user_bets.php' cache file
	echo json_encode(array('error' => '', 'status' => 'success'));
	exit;
} else {
	echo json_encode(array('error' => '', 'status' => 'fail'));
	exit;
}

?>