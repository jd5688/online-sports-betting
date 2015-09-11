<?php
// OTHER
function savePackage($checked, $notchecked) {
	$q = "UPDATE coinpackage SET cpenabled = 1 WHERE cpid IN ($checked)";
	mysql_query($q);

	$q = "UPDATE coinpackage SET cpenabled = 0 WHERE cpid IN ($notchecked)";
	mysql_query($q);

	return true;
}
function saveGeneralSettings($data) {
	foreach ($data as $key => $val) {
		$q = "UPDATE config SET cf_value = '$val' WHERE cf_name = '$key'";
		mysql_query($q);
	}
	return true;
}
// computation of the winning bet game result
function computeGameResult($game_id, $bi_id, $commission, $total_coins) {
	$data = array();
	$temp = array();
	//$total_coins = 0;
	$bets = getAllBetsByBiId($game_id, $bi_id);
	foreach ($bets as $bet) {
		$total_coins_this_bet += $bet['ub_coins'];
		$temp[$bet['user_id']] = 1;
	}
	$percentage = $total_coins_this_bet / $total_coins; // percentage of this bet

	$total_winners = count($temp);
	$total_comm = ($commission / 100) * $total_coins;
	$sub_total = $total_coins - $total_comm;
	$coin_div = $sub_total / ($percentage * 100);

	$data['status'] = 'success';
	$data['total_coins'] = $total_coins;
	$data['total_commission'] = $total_comm;
	$data['sub_total'] = $sub_total;
	$data['total_winners'] = $total_winners;
	$data['coin_dividend'] = number_format($coin_div, 2);
	$data['winner_name'] = getBetItemName($bi_id);
	return $data;
}
function closeGame($game_id) {
	$q = "UPDATE games SET g_isClosed = 1, g_isCancelled = 0 WHERE g_id = '$game_id'";
	mysql_query($q);

	$param['filename'] = 'all_games.txt';
	$param['target_field'] = 'g_isClosed';
	$param['new_value'] = '1';
	$param['this_id'] = 'g_id';
	$param['this_id_value'] = $game_id;
	$param['is_delete'] = false;
	modifyCache($param);

	return true;
}
function cancelGame($game_id) {
	$q = "UPDATE games SET g_isClosed = 0, g_isCancelled = 1 WHERE g_id = '$game_id'";
	mysql_query($q);

	$param['filename'] = 'all_games.txt';
	$param['target_field'] = 'g_isCancelled';
	$param['new_value'] = '1';
	$param['this_id'] = 'g_id';
	$param['this_id_value'] = $game_id;
	$param['is_delete'] = false;
	modifyCache($param);
	notifyCancelledGame($game_id);
	return true;
}
function returnUserBets($winners, $g_id = false, $was_cancelled = false) {
	global $config;
	$basedir = $config['basedir'];

	if (!$winners) { return false; }
	$total_bets = 0;
	foreach ($winners as $w) {
		$user_id = $w['user_id'];
		$total_bet = $w['total_bet'];
		increaseUserCoins($user_id, $total_bet);
		$total_bets += $total_bet;
		$now = time();
		$q = "INSERT INTO coin_deals (user_id, cd_amount, cd_inout, tx_id, cd_type, cd_tx_date) VALUES ('$user_id', '$total_bet', 'in', '0', 'bet return', '$now')";
		mysql_query($q);

		// append all_coin_deals.txt cache
	    $coindeal['cd_id'] = mysql_insert_id();
	    $coindeal['user_id'] = $user_id;
	    $coindeal['g_id'] = 0;
	    $coindeal['cd_amount'] = $total_bet;
	    $coindeal['cd_inout'] = 'in';
	    $coindeal['tx_id'] = 0;
	    $coindeal['cd_type'] = 'bet return';
	    $coindeal['cd_tx_date'] = $now;

		$file = $basedir . '/temp/all_coin_deals.txt';
		if (file_exists($file)) {
			$data = json_decode(file_get_contents($file), true);
			$data[] = $coindeal;
			unlink($file);
			file_put_contents($file, json_encode($data));
		}
		
		if ($was_cancelled) {
			$activity = 'gamecancelled';
			$seen = 0;
			$fieldname = 'g_id';
			$fieldvalue = $g_id;
			addActivity($user_id, $activity, $seen, $fieldname, $fieldvalue);
		}
	}
	return $total_bets;
}
function increaseUserCoins($uid, $coins) {
	global $config;
	$basedir = $config['basedir'];
	$q = "UPDATE users SET user_coins = user_coins + $coins WHERE user_id = '$uid'";
	mysql_query($q);
	
	$file = $basedir . '/temp/all_users.txt';
	if (file_exists($file)) {
		$data = json_decode(file_get_contents($file), true);
		$data[$uid]['user_coins'] += $coins;
		unlink($file);
		file_put_contents($file, json_encode($data));
	}

	return true;
}
// modify the cache
function modifyCache($param) {
	// $param['filename'] -> the source cache filename;
	// $param['target_field'] -> apply new_value on this field, if this field is not FALSE. If this field is FALSE, replace all record
	// $param['new_value'] -> contains the new data;
	// $param['this_id'] -> look for this data id
	// $param['this_id_value'] -> look for this id value
	// $param['is_delete'] -> if true, delete the record / if false, do nothing

	global $config;
	$data = array();
	$cache = $param['filename'];
	$cachefile = $config['basedir'] . '/temp/' . $cache;

	if (file_exists($cachefile)) {
		$this_id = $param['this_id']; // ex: g_id
		$this_id_value = $param['this_id_value']; // ex: 2
		$target_field = $param['target_field'];
		$new_value = $param['new_value']; // can be an array or a string
		$is_delete = $param['is_delete'];
		$srcdata = json_decode(file_get_contents($cachefile), true);
		foreach ($srcdata as $d) {
			if (isset($d[$this_id]) AND $d[$this_id] == $this_id_value) {
				if ($target_field AND !$is_delete) {
					// replace value of this field to new one
					$d[$target_field] = $new_value;
					$data[] = $d;
				} elseif (!$target_field AND !$is_delete) {
					// replace value of this record
					$data[] = $new_value;
				} elseif ($is_delete) {
					// do nothing here
				}
			} else {
				$data[] = $d;
			}
		}
		file_put_contents($cachefile, json_encode($data));
	}
	return true;
}
function recreateCache($filename, $data) {
	global $config;
	$cache = $filename;
	$cachefile = $config['basedir'] . '/temp/' . $cache;

	if (file_exists($cachefile)) {
		unlink($cachefile);
	}

	file_put_contents($cachefile, json_encode($data));
	return true;
}
function duplicateGame($game_id) {
	global $config;
	$basedir = $config['basedir'];
	$g = getGame($game_id);
	$bet_items = getBetItems($g['g_id']);
	
	$title = $g['g_title'];
	$description = $g['g_description'];
	$imgfilename = $g['g_image'];
	$category = $g['g_categories'];
	$tags = $g['g_tags'];
	$bet_info = $g['g_betInfo'];
	$bet_condition = $g['g_addInfo'];

	$title_jp = $g['g_title_jp'];
	$description_jp = $g['g_description_jp'];
	$category_jp = $g['g_categories_jp'];
	$tags_jp = $g['g_tags_jp'];
	$bet_info_jp = $g['g_betInfo_jp'];
	$bet_condition_jp = $g['g_addInfo_jp'];

	$reserve_time1 = time();
	$reserve_time2 = time();
	$timezone = $g['g_timezone'];
	$coin_per_bet = $g['g_coinPerBet'];
	$house_comm = $g['g_houseCom'];
	$publish_type = 'draft';
	$is_recommend = $g['g_isRecommend'];
	$is_trial = $g['g_isTrial'];
	$jap_page = $g['g_japPage'];
	$eng_page = $g['g_engPage'];
	$bet_minimum = $g['g_betMinimum'];	
	
	$q = "INSERT INTO games ";
	$q .= "(g_title, g_title_jp, g_description, g_description_jp, g_image, g_categories, g_categories_jp, g_tags, g_tags_jp, g_betInfo, g_betInfo_jp, g_addInfo, g_addInfo_jp, g_schedFrom, g_schedTo, g_timezone, g_coinPerBet, g_houseCom, g_publishType, g_isRecommend, g_isTrial, g_japPage, g_engPage, g_betMinimum, g_isCancelled, g_isClosed, g_isDeleted) ";
	$q .= "VALUES ";
	$q .= "('$title', '$title_jp', '$description', '$description_jp', '$imgfilename', '$category', '$category_jp', '$tags', '$tags_jp', '$bet_info', '$bet_info_jp', '$bet_condition', '$bet_condition_jp', '$reserve_time1', '$reserve_time2', '$timezone', '$coin_per_bet', '$house_comm', '$publish_type', '$is_recommend', '$is_trial', '$jap_page', '$eng_page', '$bet_minimum', '0', '0', '0')";
	mysql_query($q);
	$insert_id = mysql_insert_id();
	
	$cachefile = $basedir . '/temp/bet_items_active.php';
	$cachedata = false;
	if (file_exists($cachefile)) {
		$cachedata = json_decode(file_get_contents($cachefile), true);
	}
	foreach($bet_items as $bi) {
		$description = $bi['bi_description'];
		$description_jp = $bi['bi_description_jp'];
		$bet_id = addBetItem($insert_id, $description_jp, $description);
		if ($bet_id AND $cachedata) {
			$cachedata[] = array
						(
							'bi_id' => $bet_id,
							'bi_game_id' => $insert_id,
							'bi_description' => $description,
							'bi_winner' => 0
						);
		}
	}

	if ($cachedata) {
		file_put_contents($cachefile, json_encode($cachedata));
	}
	
	// erase the cache
	$filename = $basedir . '/temp/all_games.txt';
	unlink($filename);

	$games = getAllGames();
	file_put_contents($filename, json_encode($games));
	return true;
}
// /OTHER
// INSERT
function insertHouseCommission($g_id, $amount) {
	$now = time();
	$q = "INSERT INTO coin_deals (user_id, g_id, cd_amount, cd_inout, tx_id, cd_type, cd_tx_date) VALUES ('0', '$g_id', '$amount', 'in', '0', 'house com', '$now')";
	mysql_query($q);
	return true;
}
function insertUserWinnings($winners, $coin_div, $total_bet_amt, $game_id) {
	global $config;
	$basedir = $config['basedir'];
	$do_write = false;
	// get the cache file
	$cache_file = $config['basedir'] . '/temp/all_users.txt';
	if (!file_exists($cache_file)) { return; }
	$all_users = json_decode(file_get_contents($cache_file), TRUE);
	$won_users = array();
	$file = $basedir . '/temp/all_coin_deals.txt';
	if (file_exists($file)) {
		$data = json_decode(file_get_contents($file), true);
	} else {
		$data = array();
	}

	foreach ($winners as $w) {
		$user_id = $w['user_id'];
		$total_user_bet = $w['total_bet'];
		//$total_win_amt = $total_user_bet - ($total_user_bet * ($house_com / 100));
		$ration = ($total_user_bet / $total_bet_amt) * 100; // get the percentage of the user's total take

		$total_win_amt = $ration * $coin_div; // multiply by coins
		$now = time();
		$won_users[] = $all_users[$w['user_id']];
		increaseUserCoins($user_id, $total_win_amt);
		$q = "INSERT INTO coin_deals (user_id, g_id, cd_amount, cd_inout, tx_id, cd_type, cd_tx_date) VALUES ('$user_id', '$game_id', '$total_win_amt', 'in', '0', 'bet winning', '$now')";
		mysql_query($q);

		// append all_coin_deals.txt cache
	    $coindeal['cd_id'] = mysql_insert_id();
	    $coindeal['user_id'] = $user_id;
	    $coindeal['g_id'] = $game_id;
	    $coindeal['cd_amount'] = $total_win_amt;
	    $coindeal['cd_inout'] = 'in';
	    $coindeal['tx_id'] = 0;
	    $coindeal['cd_type'] = 'bet winning';
	    $coindeal['cd_tx_date'] = $now;

		if ($data) {
			$data[] = $coindeal;
			$do_write = true;
		}
		
		$activity = 'won';
		$seen = 0;
		$fieldname = 'g_id';
		$fieldvalue = $game_id;
		addActivity($user_id, $activity, $seen, $fieldname, $fieldvalue);
	}
	if ($do_write) {
		unlink($file);
		file_put_contents($file, json_encode($data));
	}
	notifyWonUsers($won_users, $game_id);
	return true;
}
// /INSERT

// SET
function setMaintenance($m_on, $m_off) {
	if ($m_on AND !$m_off) {
		$mode = 1;
	} elseif (!$m_on AND $m_off) {
		$mode = 0;
	} else {
		return false;
	}
	
	$q = "UPDATE config SET cf_value = '$mode' WHERE cf_name = 'maintenance_mode'";
	mysql_query($q);
	return 'success';
}

function setTwitter($twitter_id, $tweet_live, $tweet_ends) {
	$q = "UPDATE config SET cf_value = '$twitter_id' WHERE cf_name = 'twitter id'";
	mysql_query($q);
	
	$q = "UPDATE config SET cf_value = '$tweet_live' WHERE cf_name = 'tweet when game live'";
	mysql_query($q);
	
	$q = "UPDATE config SET cf_value = '$tweet_ends' WHERE cf_name = 'tweet when game ends'";
	mysql_query($q);
	
	return 'success';
}
function setBotSystem($bot_system, $bot_username) {
	$q = "UPDATE config SET cf_value = '$bot_system' WHERE cf_name = 'bot system'";
	mysql_query($q);
	
	$q = "UPDATE config SET cf_value = '$bot_username' WHERE cf_name = 'bot username'";
	mysql_query($q);
	
	return 'success';
}
function setBetItemWinner($bi_id) {
	$q = "UPDATE bet_item SET bi_winner = 1 WHERE bi_id = '$bi_id'";
	mysql_query($q);
	return true;
}
function setUserBetWinners($game_id, $bi_id) {
	$q = "UPDATE user_bets SET ub_iswinner = 1 WHERE g_id = '$game_id' AND bi_id = '$bi_id'";
	mysql_query($q);
	return true;
}
// /SET

// GET
function getUserInfo($uid) {
	$data = array();
	$q = "SELECT user_name, user_pic FROM users WHERE user_id = '$uid' LIMIT 0, 1";
	$result = mysql_query($q);

	$numrows = mysql_num_rows($result);

	if ($numrows) {
		while ($row = mysql_fetch_array($result)) {
			return $row;
		}
	}

	return $data;
}
function getGameTotalPlacedCoins($game_id) {
	$q = "SELECT sum(ub_coins) as total_coins FROM user_bets WHERE g_id = '$game_id' GROUP BY g_id";
	$result = mysql_query($q);
	$numrows = mysql_num_rows($result);

	if ($numrows) {
		while ($row = mysql_fetch_array($result)) {
			return $row['total_coins'];
		}
	}

	return 0;

}
function getUserFromCache($user_id) {
	global $config;
	$basedir = $config['basedir'];
	$file = $basedir . '/temp/all_users.txt';
	if (file_exists($file)) {
		$data = json_decode(file_get_contents($file), true);
		return $data[$user_id];
	} else {
		// write to cache
		$users = array();
		$users = getAllUsers();
		file_put_contents($file, json_encode($users));
		return $users[$user_id];
	}
	return array();
}
function getUserBetWinners($game_id, $bi_id) {
	$data = array();
	$q = "SELECT user_id, ub_notify, sum(ub_coins) as total_bet FROM user_bets WHERE g_id = '$game_id' AND bi_id = '$bi_id' AND ub_iswinner = '1' GROUP BY user_id";
	$result = mysql_query($q);
	$numrows = mysql_num_rows($result);

	if ($numrows) {
		while ($row = mysql_fetch_array($result)) {
			$data[] = $row;
		}
	}

	return $data;
}
function getUserBets($game_id, $bi_id) {
	$data = array();
	$q = "SELECT user_id, ub_notify, sum(ub_coins) as total_bet FROM user_bets WHERE g_id = '$game_id' GROUP BY user_id";
	$result = mysql_query($q);
	$numrows = mysql_num_rows($result);

	if ($numrows) {
		while ($row = mysql_fetch_array($result)) {
			$data[] = $row;
		}
	}

	return $data;
}
function getCoinPackages() {
	$data = array();
	$q = "SELECT * FROM coinpackage";
	$result = mysql_query($q);
	$numrows = mysql_num_rows($result);

	if ($numrows) {
		while ($row = mysql_fetch_array($result)) {
			$data[] = $row;
		}
	}

	return $data;
}

function getLanguages() {
	$data = array();
	$q = "SELECT * FROM languages";
	$result = mysql_query($q);
	$numrows = mysql_num_rows($result);

	if ($numrows) {
		while ($row = mysql_fetch_array($result)) {
			$data[] = $row;
		}
	}

	return $data;
}

function getCategories() {
	$data = array();
	$q = "SELECT * FROM sports_category";
	$result = mysql_query($q);

	$numrows = mysql_num_rows($result);

	if ($numrows) {
		while ($row = mysql_fetch_array($result)) {
			$data[] = $row;
		}
	}

	return $data;
}

function getTags() {
	$data = array();
	$q = "SELECT * FROM sports_tags";
	$result = mysql_query($q);

	$numrows = mysql_num_rows($result);

	if ($numrows) {
		while ($row = mysql_fetch_array($result)) {
			$data[] = $row;
		}
	}

	return $data;
}
function getAllUsers() {
	$data = array();
	$q = "SELECT * FROM users";
	$result = mysql_query($q);

	$numrows = mysql_num_rows($result);

	if ($numrows) {
		while ($row = mysql_fetch_array($result)) {
			$data[$row['user_id']] = $row;
		}
	}

	return $data;
}
function getTag($tag, $lang = 'jp') {
	$q = "SELECT * FROM sports_tags WHERE st_name = '$tag' AND st_lang = '$lang'";
	$result = mysql_query($q);

	$numrows = mysql_num_rows($result);

	if ($numrows) {
		while ($row = mysql_fetch_array($result)) {
			return $row['st_name'];
		}
	}

	return false;
}

function getGames($data, $which = 'categories') {
	// do something here
	
	return $data;
}

function getAllGames($where = false) {
	$data = array();
	$now = time();
	$isWhere = '';
	
	/*
	if ($where == 'all') {
		// get all games
		$isWhere = '';
	} elseif ($where == 'judgement') {
		// games that need to be finalized or judged
		$isWhere = "WHERE g_schedTo < '$now' AND g_publishType != 'draft' AND g_isCancelled = 0 AND g_isClosed = 0";
	} elseif ($where == 'live') {
		// games that are currently playing
		$isWhere = "WHERE g_schedFrom <= '$now' AND $g_schedTo >= '$now' AND g_publishType != 'draft' AND g_isCancelled = 0 AND g_isClosed = 0";
	} elseif ($where == 'coming') {
		// games that are not yet playing
		$isWhere = "WHERE g_schedFrom > '$now' AND g_publishType != 'draft' AND g_isCancelled = 0 AND g_isClosed = 0";
	} elseif ($isWhere == 'closed') {
		// games that are closed
		$isWhere = "WHERE g_isClosed = '1'";
	} elseif ($isWhere == 'cancelled') {
		// games that are cancelled
		$isWhere = "WHERE g_isCancelled = '1'";
	} elseif ($isWhere == 'draft') {
		// games that are draft
		$isWhere = "WHERE g_publishType = 'draft'";
	} else {
		// games that are currently playing
		$isWhere = "WHERE g_schedFrom <= '$now' AND $g_schedTo >= '$now' AND g_publishType != 'draft' AND g_isCancelled = 0 AND g_isClosed = 0";
	}
	*/

	if ($isWhere) {
		$q = "SELECT * FROM games $isWhere AND g_isDeleted = 0 ORDER BY g_id DESC";
	} else {
		// all games
		$q = "SELECT * FROM games WHERE g_isDeleted = 0 ORDER BY g_id DESC";
	}
	$result = mysql_query($q);

	$numrows = mysql_num_rows($result);

	if ($numrows) {
		while ($row = mysql_fetch_array($result)) {
			$data[] = $row;
		}
	}

	return $data;
}

function getBetItems($game_id) {
	$data = array();
	$q = "SELECT * FROM bet_item WHERE bi_game_id = '$game_id' ORDER BY bi_id ASC";
	$result = mysql_query($q);

	$numrows = mysql_num_rows($result);

	if ($numrows) {
		while ($row = mysql_fetch_array($result)) {
			$data[] = $row;
		}
	}

	return $data;
}
function getSuffix($game) {
	global $suffix;

	// if game has no english texts
	if ($suffix == '' AND !$game['g_engPage']) {
		$suffix = '_jp'; // switch to jp
	}

	// if game has no jp textx
	if ($suffix == '_jp' AND !$game['g_japPage']) {
		$suffix = ''; // switch to en
	}
	return $suffix;
}
function getBetItemName($bi_id, $suffix = '_jp') {
	$q = "SELECT bi_description, bi_description_jp FROM bet_item WHERE bi_id = '$bi_id' LIMIT 0, 1";
	$result = mysql_query($q);

	$numrows = mysql_num_rows($result);

	if ($numrows) {
		while ($row = mysql_fetch_array($result)) {
			// if suffix is english but there's no english description for the bet
			if (!$row['bi_description'] AND $suffix == '') {
				return $row['bi_description_jp']; // get jp description instead
			}

			// if suffix is japanese but there's no japanese description
			if (!$row['bi_description_jp'] AND $suffix == '_jp') {
				return $row['bi_description']; // get en description instead
			}

			return $row['bi_description' . $suffix];
		}
	}

	return false;
}
/*
function getAllBets($game_id) {
	$data = array();
	$q = "SELECT * FROM user_bets WHERE g_id = '$game_id'";
	$result = mysql_query($q);
	$numrows = mysql_num_rows($result);

	if ($numrows) {
		while ($row = mysql_fetch_array($result)) {
			$data[] = $row;
		}
	}

	return $data;
}*/
function getAllBets($game_id = false) {
	$data = array();
	$bi_ids = array();
	$g_ids = array(); // array containing all game ids
	if ($game_id) {
		$is_where = "WHERE bi_game_id = '".$game_id."'";
		$is_where2 = "WHERE g_id = '".$game_id."'";
	} else {
		$is_where = "";
		$is_where2 = "";
	}

	// first, get all the bi ids of all the bets
	$q = "SELECT bi_id FROM bet_item $is_where";
	$result = mysql_query($q);
	$numrows = mysql_num_rows($result);
	if ($numrows) {
		while ($row = mysql_fetch_array($result)) {
			// based from the bet_item table data
			// populate the $bi_ids array with bi_id as the key and false as the initial value
			// this will later be used to determine which bet items have bets and which have none
			$bi_ids[$row['bi_id']] = false; 
		}
	}

	// now, get all the bets
	$q = "SELECT * FROM user_bets $is_where2";
	$result = mysql_query($q);
	$numrows = mysql_num_rows($result);

	if ($numrows) {
		while ($row = mysql_fetch_array($result)) {
			// based from the user_bets table data,
			// loop and change the value to true
			// if true, it means that there were users who betted on this item 
			$bi_ids[$row['bi_id']] = true;

			$data[] = $row;
			$g_ids[$row['bi_id']] = $row['g_id'];
		}
	}

	// loop bi_ids to determine which items are false (no bets)
	foreach ($bi_ids as $key => $val) {
		$row = false;

		// if $val is false, then there were no bets for this bet item
		// so populate with 0 values so this bet item will still be displayed
		// we need to show the users that this item has 0 bets
		if (!$val) {
			$row = array(
					'ub_id' => 0,
					'user_id' => 0,
					'g_id' => $g_ids[$key],
					'bi_id' => $key,
					'ub_coins' => 0,
					'cd_id' => 0,
					'ub_iswinner' => 0
				);
			$data[] = $row;
		}
	}

	return $data;
}
function getAllBetsByBiId($game_id, $bi_id) {
	$data = array();
	$q = "SELECT * FROM user_bets WHERE g_id = '$game_id' AND bi_id = '$bi_id'";
	$result = mysql_query($q);
	$numrows = mysql_num_rows($result);

	if ($numrows) {
		while ($row = mysql_fetch_array($result)) {
			$data[] = $row;
		}
	}

	return $data;
}
/*
function getInfoPerBetItem($data) {
	$temp = array();
	if ($data) {
		foreach ($data as $d) {
			$temp[$d['bi_id']]['total_bets'] = count($data);
			$temp[$d['bi_id']]['bi_id'] = $d['bi_id']; 
			$temp[$d['bi_id']]['bet_users'][$d['user_id']] += $d['ub_coins'];
			$temp[$d['bi_id']]['bet_users_total'] = count($temp[$d['bi_id']]['bet_users']);
			$temp[$d['bi_id']]['placed_coins'] += $d['ub_coins'];
		}
		$temp2 = $temp;
		$total_users = 0;
		foreach ($temp2 as $t) {
			$total_users += $t['bet_users_total']; // count total users who bet
			$total_coins += $t['placed_coins']; // count total coins placed
		}
		foreach ($temp2 as $t) {
			$temp[$t['bi_id']]['ratio'] = ($t['bet_users_total'] / $total_users) * 100; // get percentage
			$temp[$t['bi_id']]['coins_ratio'] = ($t['placed_coins'] / $total_coins) * 100;
		}
	}
	return $temp;
}*/
function getInfoPerBetItem($data) {
	$temp = array();
	$temp2 = array();
	$temp3 = array();
	$temp4 = array();
	$new_data = array();
	if ($data) {
		foreach ($data as $d) {
			$temp[$d['bi_id']]['total_bets'] = count($data);
			$temp[$d['bi_id']]['bi_id'] = $d['bi_id']; 
			$temp3[$d['bi_id']] = $d['bi_id'];
			if ($d['user_id']) {
				$temp4[$d['user_id']] = true;
			}

			if ($d['user_id']) {
				$temp[$d['bi_id']]['bet_users'][$d['user_id']] += $d['ub_coins'];
			}
			
			$temp[$d['bi_id']]['bet_users_total'] = count($temp[$d['bi_id']]['bet_users']);
			$temp[$d['bi_id']]['placed_coins'] += $d['ub_coins'];
			$temp[$d['bi_id']]['is_winner'] = $d['ub_iswinner'];
		}
		asort($temp3);
		$temp2 = $temp;
		$total_users = 0;
		foreach ($temp2 as $t) {
			$total_users += $t['bet_users_total']; // count total users who bet
			$total_coins += $t['placed_coins']; // count total coins placed
		}
		foreach ($temp2 as $t) {
			$temp[$t['bi_id']]['ratio'] = ($t['bet_users_total'] / $total_users) * 100; // get percentage
			$temp[$t['bi_id']]['coins_ratio'] = ($t['placed_coins'] / $total_coins) * 100;
			$temp[$t['bi_id']]['total_users_who_bet'] = count($temp4);
		}

		// sort it
		foreach ($temp3 as $t) {
			$new_data[] = $temp[$t];
		}
	}
	return $new_data;
}
function getInfoPerBetItemByUsername($all_bets, $bet_items2) {
	$data = array();
	$temp = array();
	$temp2 = array();
	$temp3 = array();
	$all_coin_bets = 0;

	foreach ($all_bets as $a) {
		$all_coin_bets += $a['ub_coins'];
		$info = getUserInfo($a['user_id']);
		$temp[$a["bi_id"]]['bi_id'] = $a['bi_id'];
		$temp[$a["bi_id"]]['bet_item'] = $bet_items2[$a["bi_id"]];
		$temp[$a["bi_id"]]['total_bets'] += $a['ub_coins'];
		$temp[$a["bi_id"]]['users'][$a['user_id']]['user_id'] = $a['user_id'];
		$temp[$a["bi_id"]]['users'][$a['user_id']]['user_name'] = $info['user_name'];
		$temp[$a["bi_id"]]['users'][$a['user_id']]['user_pic'] = $info['user_pic'];
		$temp[$a["bi_id"]]['users'][$a['user_id']]['user_bet'] += $a['ub_coins'];
		$temp[$a["bi_id"]]['users'][$a['user_id']]['is_highroller'] += $info['user_ishighroller'];
	}

	foreach ($temp as $t) {
		$total_bets = $t['total_bets'];
		$users = $t['users'];
		$temp2[$i] = $t;
		foreach ($users as $u) {
			$temp2[$i]['users'][$u['user_id']]['user_ratio'] = ($u['user_bet'] / $all_coin_bets) * 100;
			$temp3[$u['user_id']] = $u['user_bet'];
		}
		$users = $temp2[$i]['users'];
		asort($temp3);
		$data[$t['bi_id']]['bi_id'] = $t['bi_id'];
		$data[$t['bi_id']]['bet_item'] = $t['bet_item'];
		$data[$t['bi_id']]['total_bets'] = $t['total_bets'];
		foreach($temp3 as $key => $val) {
			// reassign users in sorted order by user bet
			$data[$t['bi_id']]['users'][] = $users[$key];
		}
	}

	return $data;
}

function getGame($game_id) {
	$data = array();
	$q = "SELECT * FROM games WHERE g_id = '$game_id'";
	$result = mysql_query($q);

	$numrows = mysql_num_rows($result);

	if ($numrows) {
		while ($row = mysql_fetch_array($result)) {
			$data = $row;
		}
	}

	return $data;
}

function getAdmins() {
	$data = array();
	$q = "SELECT * FROM users WHERE user_isadmin = '1'";
	$result = mysql_query($q);

	$numrows = mysql_num_rows($result);

	if ($numrows) {
		while ($row = mysql_fetch_array($result)) {
			$data[] = $row;
		}
	}

	return $data;
}

function getDateFormat($unix) {
	// 06/14/2014 12:00 AM
	return date('m/d/Y h:i A', $unix);
}

function getGameStatus($g, $lang) {
	$now = time();
	if ($g['g_publishType'] == 'draft') {
		return $lang[61];
	} elseif ($g['g_isClosed'] == '1') {
		// closed
		return $lang[54];
	} elseif ($g['g_isCancelled'] == '1') {
		// cancelled
		return $lang[62];
	} elseif ($g['g_schedFrom'] > $now AND $g['g_publishType'] != 'draft' AND $g['g_isCancelled'] == 0 AND $g['g_isClosed'] == 0) {
		// coming
		return $lang[56];
	} elseif ($g['g_schedFrom'] <= $now AND $g['g_schedTo'] >= $now AND $g['g_publishType'] != 'draft' AND $g['g_isCancelled'] == 0 AND $g['g_isClosed'] == 0) {
		// live
		return $lang[55];
	} elseif ($g['g_schedTo'] < $now AND $g['g_publishType'] != 'draft' AND $g['g_isCancelled'] == 0 AND $g['g_isClosed'] == 0) {
		// judgement
		return $lang[53];
	} else {
		return false;
	}
}

function getUserBetsByUserId($user_id) {
	$data = array();
	$q = "SELECT * FROM user_bets WHERE user_id = '$user_id'";
	$result = mysql_query($q);

	$numrows = mysql_num_rows($result);

	if ($numrows) {
		while ($row = mysql_fetch_array($result)) {
			$data[] = $row;
		}
	}

	return $data;
}

function getUserLikes($user_id) {
	global $GAMES;
	$data = array();
	$temp = array();
	$i = 0;
	$q = "SELECT * FROM user_likes WHERE user_id = '$user_id'";
	$result = mysql_query($q);

	$numrows = mysql_num_rows($result);

	if ($numrows) {
		while ($row = mysql_fetch_array($result)) {
			$temp[] = $row;
		}
	}

	foreach ($temp as $t) {
		$g_id = $t['g_id'];
		if (!isset($GAMES[$g_id])) {
			$GAMES[$g_id] = getGame($g_id);
		}
		$data[$i]['g_id'] = $g_id;
		$data[$i]['g_title'] = $GAMES[$g_id]['g_title'];
		$i++;
	}

	return $data;
}
function getUserCoinDeals($user_id) {
	$data = array();
	$q = "SELECT * FROM coin_deals WHERE user_id = '$user_id'";
	$result = mysql_query($q);

	$numrows = mysql_num_rows($result);

	if ($numrows) {
		while ($row = mysql_fetch_array($result)) {
			$data[] = $row;
		}
	}

	return $data;
}
function getUserBookmarks($user_id) {
	global $GAMES;
	$data = array();
	$temp = array();
	$i = 0;
	$q = "SELECT * FROM user_bookmarks WHERE user_id = '$user_id'";
	$result = mysql_query($q);

	$numrows = mysql_num_rows($result);

	if ($numrows) {
		while ($row = mysql_fetch_array($result)) {
			$temp[] = $row;
		}
	}

	foreach ($temp as $t) {
		$g_id = $t['g_id'];
		if (!isset($GAMES[$g_id])) {
			$GAMES[$g_id] = getGame($g_id);
		}
		$data[$i]['g_id'] = $g_id;
		$data[$i]['g_title'] = $GAMES[$g_id]['g_title'];
		$i++;
	}

	return $data;
}

function getUserNowBetting($user_bets) {
	global $GAMES;
	$data = array();
	$i = 0;
	foreach ($user_bets as $ub) {
		$g_id = $ub['g_id'];
		if (!$ub['ub_iswinner']) {
			if (!isset($GAMES[$g_id])) {
				$GAMES[$g_id] = getGame($g_id);
			}

			if (!$GAMES[$g_id]['g_isClosed'] AND !$GAMES[$g_id]['g_isCancelled'] AND !$GAMES[$g_id]['g_isDeleted']) {
				$data[$g_id]['g_id'] = $g_id;
				$data[$g_id]['g_title'] = $GAMES[$g_id]['g_title'];
				$data[$g_id]['ub_coins'] += $ub['ub_coins'];
			}
		}
	}
	return $data;
}
function getUserClosedBetting($user_bets) {
	global $GAMES;
	$data = array();
	$i = 0;
	foreach ($user_bets as $ub) {
		$g_id = $ub['g_id'];
		if (!isset($GAMES[$g_id])) {
			$GAMES[$g_id] = getGame($g_id);
		}

		// only closed games
		if ($GAMES[$g_id]['g_isClosed']) {
			if ($ub['ub_iswinner']) {
				$data['win'][$g_id]['g_id'] = $g_id;
				$data['win'][$g_id]['g_title'] = $GAMES[$g_id]['g_title'];
				$data['win'][$g_id]['ub_coins'] += $ub['ub_coins'];
				$data['win'][$g_id]['is_winner'] = 1;

				$data['all'][$g_id]['g_id'] = $g_id;
				$data['all'][$g_id]['g_title'] = $GAMES[$g_id]['g_title'];
				$data['all'][$g_id]['ub_coins_win'] += $ub['ub_coins'];
			} else {
				$data['lose'][$g_id]['g_id'] = $g_id;
				$data['lose'][$g_id]['g_title'] = $GAMES[$g_id]['g_title'];
				$data['lose'][$g_id]['ub_coins'] += $ub['ub_coins'];
				$data['lose'][$g_id]['is_winner'] = 0;

				$data['all'][$g_id]['g_id'] = $g_id;
				$data['all'][$g_id]['g_title'] = $GAMES[$g_id]['g_title'];
				$data['all'][$g_id]['ub_coins_lose'] += $ub['ub_coins'];
			}
		}
		$i++;
	}
	/*
	$data
	(
	    [win] => Array
	        (
	            [6] => Array
	                (
	                    [g_id] => 6
	                    [g_title] => Pacquiao vs. Mayweather
	                    [ub_coins] => 120
	                    [is_winner] => 1
	                )

	        )

	    [all] => Array
	        (
	            [6] => Array
	                (
	                    [g_id] => 6
	                    [g_title] => Pacquiao vs. Mayweather
	                    [ub_coins_win] => 120
	                    [ub_coins_lose] => 80
	                )

	        )

	    [lose] => Array
	        (
	            [6] => Array
	                (
	                    [g_id] => 6
	                    [g_title] => Pacquiao vs. Mayweather
	                    [ub_coins] => 80
	                    [is_winner] => 0
	                )

	        )

	)
	*/

	return $data;
}
function getAllUserBetsNoWinnerAndWriteToCache() {
	global $config;
	$user_bets = array();
	$win_gids = array();
	$all_user_bets = array();
	
	$q = "SELECT * FROM user_bets";
	$result = mysql_query($q);
	$numrows = mysql_num_rows($result);
	
	if (!$numrows) { return $user_bets; }
	while ($row = mysql_fetch_array($result)) {
		$all_user_bets[] = $row;
	}
	
	if ($all_user_bets) {
		// reject g_ids that have bi_winner = 1
		foreach ($all_user_bets as $aub) {
			// first get all g_ids that have bi_winner = 1
			if ($aub['ub_iswinner']) {
				$win_gids[$aub['g_id']] = true;
			}
		}
		
		foreach ($all_user_bets as $bub) {
			if (!isset($win_gids[$bub['g_id']])) {
				$user_bets[] = $bub;
			}	
		}
		
		$cachefile = $config['basedir'] . '/temp/user_bets_active.php';
		if (file_exists($cachefile)) {
			unlink($cachefile);
		}
		file_put_contents($cachefile, json_encode($user_bets));
	}
	return $user_bets;
}
function getAllTransactions() {
	$data = array();
	$q = "SELECT * FROM transactions ORDER BY tr_id DESC";
	$result = mysql_query($q);
	$numrows = mysql_num_rows($result);

	if ($numrows) {
		while ($row = mysql_fetch_array($result)) {
			$data[] = $row;
		}
	}

	return $data;
}
function getTransactions($from, $to) {
	$data = array();
	$q = "SELECT * FROM transactions WHERE tr_date >= '$from' AND tr_date <= '$to' ORDER BY tr_id DESC";
	$result = mysql_query($q);
	$numrows = mysql_num_rows($result);

	if ($numrows) {
		while ($row = mysql_fetch_array($result)) {
			$data[] = $row;
		}
	}

	return $data;
}
function getUserRegistrations($from, $to) {
	$data = array();
	$q = "SELECT * FROM user WHERE user_registered >= '$from' AND user_registered <= '$to' ORDER BY user_id DESC";
	$result = mysql_query($q);
	$numrows = mysql_num_rows($result);

	if ($numrows) {
		while ($row = mysql_fetch_array($result)) {
			$data[] = $row;
		}
	}

	return $data;
}
function getHouseCommissions($from, $to) {
	$data = array();
	$q = "SELECT * FROM coin_deals WHERE cd_type = 'house com' AND cd_tx_date >= '$from' AND cd_tx_date <= '$to' ORDER BY cd_id DESC";
	$result = mysql_query($q);
	$numrows = mysql_num_rows($result);

	if ($numrows) {
		while ($row = mysql_fetch_array($result)) {
			$data[] = $row;
		}
	}

	return $data;
}
// get

// add
function addPackage($coinvalue, $dollarvalue) {
	$q = "SELECT * FROM coinpackage WHERE cpcoin = '$coinvalue' AND cpamount = '$dollarvalue' LIMIT 0, 1";
	$result = mysql_query($q);
	$numrows = @mysql_num_rows($result);


	if ($numrows) {
		return false;
	} else {
		$q = "INSERT INTO coinpackage (cpcoin, cpamount, cpenabled) VALUES ('$coinvalue', '$dollarvalue', 0)";
		mysql_query($q);
		return mysql_insert_id();
	}
}

function addNewAdmin($data) {
	$name = $data['name'];
	$email = $data['email'];
	$password = $data['password1'];
	$nick = $data['nick'];
	$reg = date('m-d-Y');

	$q = "INSERT INTO users (user_name, user_password, user_fullname, user_email, user_lastlogin, user_isadmin, user_status) VALUES ('$nick', '$password', '$name', '$email', '', '1', '1')";
		mysql_query($q);
		return mysql_insert_id();
}

function addTag($tag, $description = '', $lang = 'jp') {
	$q = "INSERT INTO sports_tags (st_name, st_description, st_lang) VALUES ('$tag', '$description', '$lang')";
		mysql_query($q);
		return mysql_insert_id();
}

function addBetItem($game_id, $description = '', $description_en = '') {
	$q = "SELECT * FROM bet_item WHERE bi_game_id = '$game_id' AND bi_description_jp = '$description' LIMIT 0, 1";
	$result = mysql_query($q);
	$numrows = @mysql_num_rows($result);


	if ($numrows) {
		return false;
	} else {
		$q = "INSERT INTO bet_item (bi_game_id, bi_description, bi_description_jp, bi_winner) VALUES ('$game_id', '$description_en', '$description', '0')";
		mysql_query($q);
		return mysql_insert_id();
	}
}

function deleteBetItem($game_id) {
	$q = "DELETE FROM bet_item WHERE bi_game_id = '$game_id'";
	$result = mysql_query($q);
	return true;
}
function addCouponCode($keyword, $coins, $is_welcome = 0) {
	$q = "SELECT c_id FROM coupons WHERE c_keyword = '$keyword' LIMIT 0, 1";
	$result = mysql_query($q);
	$numrows = @mysql_num_rows($result);


	if ($numrows) {
		$q = "UPDATE coupons SET c_isWelcome = '$is_welcome', c_coins = '$coins' WHERE c_keyword = '$keyword'";
		mysql_query($q);
		return true;
	} else {
		$q = "INSERT INTO coupons (c_keyword, c_coins, c_isWelcome) VALUES ('$keyword', '$coins', '$is_welcome')";
		mysql_query($q);
		return mysql_insert_id();
	}
}
function addActivity($user_id, $activity, $seen, $fieldname, $fieldvalue) {
	// activities:
	// 'like','unlike','withdraw','deposit','userfollow','bookmark','unbookmark','won','joinedgame','gamecancelled'
	
	$q = "SELECT ua_id FROM user_activities WHERE ua_seen = '$seen' AND ua_activity = '$activity' AND ua_fieldname = '$fieldname' AND ua_fieldvalue = '$fieldvalue' AND user_id = '$user_id' LIMIT 0, 1";
	$result = mysql_query($q);
	$numrows = mysql_num_rows($result);
	
	if ($numrows) {
		while ($row = mysql_fetch_array($result)) {
			$ua_id = $row['ua_id'];
			$q = "DELETE FROM user_activities WHERE ua_id = '$ua_id'";
			mysql_query($q);
			break;
		}
	}
	
	$now = time();
	$q = "INSERT INTO user_activities (ua_seen, user_id, ua_fieldname, ua_fieldvalue, ua_activity, ua_date) ";
	$q .= "VALUES ";
	$q .= "('$seen', '$user_id', '$fieldname', '$fieldvalue', '$activity', '$now')";
	mysql_query($q);
	return true;
}
// add

// delete
function deleteGame($game_id) {
	global $config;
	$data = array();
	$q = "UPDATE games SET g_isDeleted = 1 WHERE g_id = '$game_id'";
	//$q = "DELETE FROM games WHERE g_id = '$game_id'";
	mysql_query($q);
	
	$filename = $config['basedir'] . '/temp/all_games.txt';
	if (file_exists($filename)) {
		$cache = json_decode(file_get_contents($filename), true);
		foreach ($cache as $c) {
			if ($c['g_id'] != $game_id) {
				$data[] = $c;
			}
		}
		
		unlink($filename);
		file_put_contents($filename, json_encode($data));
	}
	
	return true;
}
// delete

// NOTIFY
function notifyCancelledGame($game_id) {
	global $config;
	$noreplyemail = $config['noreply_email'];
	$game = getGame($game_id);
	$game_title = $game['g_title'];
	$cache_file = $config['basedir'] . '/temp/all_users.txt';
	if (!file_exists($cache_file)) { return; }
	$data = json_decode(file_get_contents($cache_file), TRUE);
	$users = array();
	foreach ($data as $d) {
		$notify = $d['user_notify'];
		if ($notify == 'all' OR $notify == 'cancelled') {
			//$users[$d['user_id']]['user_name'] = $d['user_name'];
			$users[] = $d['user_email'];
		}
	}
	
	$message = $game_title . 'has been cancelled';
    $headers   = array();
	$headers[] = "MIME-Version: 1.0";
	$headers[] = "Content-type: text/plain; charset=utf-8";
	$headers[] = "From: noreply <{$noreplyemail}>";
	$headers[] = "Reply-To: Recipient Name <{$noreplyemail}>";
	$headers[] = "Subject: {$subject}";
	$headers[] = 'BCC: '. implode(",", $users) . "\r\n";
	$headers[] = "X-Mailer: PHP/".phpversion();
    mail(null,$subject,$message,implode("\r\n", $headers));
    return true;
}
function notifyWonUsers($won_users, $game_id) {
	global $config;
	$game = getGame($game_id);
	$game_title = $game['g_title'];
	foreach ($won_users as $d) {
		$notify = $d['user_notify'];
		if ($notify == 'all' OR $notify == 'won') {
			$users[] = $d['user_email'];
		}
	}
	
	$message = 'Congratulations! You won the game "$game_title"';
    $headers   = array();
	$headers[] = "MIME-Version: 1.0";
	$headers[] = "Content-type: text/plain; charset=utf-8";
	$headers[] = "From: noreply <{$noreplyemail}>";
	$headers[] = "Reply-To: Recipient Name <{$noreplyemail}>";
	$headers[] = "Subject: {$subject}";
	$headers[] = 'BCC: '. implode(",", $users) . "\r\n";
	$headers[] = "X-Mailer: PHP/".phpversion();
    mail(null,$subject,$message,implode("\r\n", $headers));
    return true;
}
// /NOTIFY
?>