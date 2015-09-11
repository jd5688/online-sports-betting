<?php
// ADD
function addBet($uid, $g_id, $bi_id, $amount, $notify = 0) {
	global $config;
	$basedir = $config['basedir'];
	$now = time();
	// insert to coin_deals
	$q = "INSERT INTO coin_deals (user_id, cd_amount, cd_inout, tx_id, cd_type, cd_tx_date) VALUES ('$uid', '$amount', 'out', '', 'bet', '$now')";
	mysql_query($q);
	$id = mysql_insert_id();

	if ($id) {
		// append all_coin_deals.txt cache
	    $coindeal['cd_id'] = $id;
	    $coindeal['user_id'] = $uid;
	    $coindeal['g_id'] = 0;
	    $coindeal['cd_amount'] = $amount;
	    $coindeal['cd_inout'] = 'out';
	    $coindeal['tx_id'] = '';
	    $coindeal['cd_type'] = 'bet';
	    $coindeal['cd_tx_date'] = $now;

		$file = $basedir . '/temp/all_coin_deals.txt';
		if (file_exists($file)) {
			$data = json_decode(file_get_contents($file), true);
			$data[] = $coindeal;
			unlink($file);
			file_put_contents($file, json_encode($data));
		}

		//recompute user's coins
		$user_coins = getUserCoins($uid);
		updateUserCoins($uid, $user_coins);
		
		$activity = 'joinedgame';
		$seen = 1;
		$fieldname = 'g_id';
		$fieldvalue = $g_id;
		addActivity($uid, $activity, $seen, $fieldname, $fieldvalue);

		// insert to user_bets
		$q = "INSERT INTO user_bets (user_id, g_id, bi_id, ub_coins, ub_notify, cd_id) VALUES ('$uid', '$g_id', '$bi_id', '$amount', '$notify', '$id')";
		mysql_query($q);
		$insert_id = mysql_insert_id();

		// insert data to the cache file
		$newrec = array
        (
            'ub_id' => $insert_id,
            'user_id' => $uid,
            'g_id' => $g_id,
            'bi_id' => $bi_id,
            'ub_coins' => $amount,
            'ub_notify' => $notify,
            'cd_id' => $id,
            'ub_iswinner' => 0
        );
        $cachefile = $config['basedir'] . '/temp/user_bets_active.php';
        if (file_exists($cachefile)) {
        	// get the file
			$uba = json_decode(file_get_contents($cachefile), true);
			$uba[] = $newrec;
			file_put_contents($cachefile, json_encode($uba)); // write
		}
	}

	return true;
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
function addLike($g_id, $u_id) {
	global $config;
	$basedir = $config['basedir'];
	$file = $basedir . '/temp/all_games.txt';
	$cache = array();
	$temp = array();
	if (file_exists($file)) {
		$temp = json_decode(file_get_contents($file), true);
	}
	foreach ($temp as $d) {
		$cache[$d['g_id']] = $d;
	}

	$q = "SELECT ul_id FROM user_likes WHERE user_id = '$u_id' AND g_id = '$g_id'";
	$result = mysql_query($q);
	$numrows = mysql_num_rows($result);
	$ret = '';

	if ($numrows) {
		// delete it
		$q = "DELETE FROM user_likes WHERE user_id = '$u_id' AND g_id = '$g_id'";
		mysql_query($q);

		$q = "UPDATE games SET g_likes = g_likes - 1 WHERE g_id = '$g_id'";
		mysql_query($q);
		
		$activity = 'unlike';
		$seen = 1;
		$fieldname = 'g_id';
		$fieldvalue = $g_id;
		addActivity($u_id, $activity, $seen, $fieldname, $fieldvalue);

		$clikes = $cache[$g_id]['g_likes'];
		$cache[$g_id]['g_likes'] = $clikes - 1;

		$ret = 'deleted';
	} else {
		// insert it
		$q = "INSERT INTO user_likes (user_id, g_id) VALUES ('$u_id', '$g_id')";
		mysql_query($q);

		$q = "UPDATE games SET g_likes = g_likes + 1 WHERE g_id = '$g_id'";
		mysql_query($q);
		
		$activity = 'like';
		$seen = 1;
		$fieldname = 'g_id';
		$fieldvalue = $g_id;
		addActivity($u_id, $activity, $seen, $fieldname, $fieldvalue);
		
		$clikes = $cache[$g_id]['g_likes'];
		$cache[$g_id]['g_likes'] = $clikes + 1;

		$ret = 'success';
	}
	$temp = array();
	foreach ($cache as $d) {
		$temp[] = $d;
	}

	if (file_exists($file)) {
		unlink($file);
		file_put_contents($file, json_encode($temp));
	}

	return $ret;
}
function addBookmark($g_id, $u_id) {
	global $config;
	$basedir = $config['basedir'];
	$file = $basedir . '/temp/all_games.txt';
	$cache = array();
	$temp = array();
	if (file_exists($file)) {
		$temp = json_decode(file_get_contents($file), true);
	}
	foreach ($temp as $d) {
		$cache[$d['g_id']] = $d;
	}

	$q = "SELECT ub_id FROM user_bookmarks WHERE user_id = '$u_id' AND g_id = '$g_id'";
	$result = mysql_query($q);
	$numrows = mysql_num_rows($result);

	if ($numrows) {
		// delete it
		$q = "DELETE FROM user_bookmarks WHERE user_id = '$u_id' AND g_id = '$g_id'";
		mysql_query($q);

		$q = "UPDATE games SET g_bookmarks = g_bookmarks - 1 WHERE g_id = '$g_id'";
		mysql_query($q);
		
		$activity = 'unbookmark';
		$seen = 1;
		$fieldname = 'g_id';
		$fieldvalue = $g_id;
		addActivity($u_id, $activity, $seen, $fieldname, $fieldvalue);

		$cbook = $cache[$g_id]['g_bookmarks'];
		$cache[$g_id]['g_bookmarks'] = $cbook - 1;
		
		$ret = 'deleted';
	} else {
		// insert it
		$q = "INSERT INTO user_bookmarks (user_id, g_id) VALUES ('$u_id', '$g_id')";
		mysql_query($q);

		$q = "UPDATE games SET g_bookmarks = g_bookmarks + 1 WHERE g_id = '$g_id'";
		mysql_query($q);
		
		$activity = 'bookmark';
		$seen = 1;
		$fieldname = 'g_id';
		$fieldvalue = $g_id;
		addActivity($u_id, $activity, $seen, $fieldname, $fieldvalue);

		$cbook = $cache[$g_id]['g_bookmarks'];
		$cache[$g_id]['g_bookmarks'] = $cbook + 1;

		$ret = 'success';
	}

	$temp = array();
	foreach ($cache as $d) {
		$temp[] = $d;
	}

	if (file_exists($file)) {
		unlink($file);
		file_put_contents($file, json_encode($temp));
	}

	return $ret;
}
// /ADD

// GET
function getActivities($user_id) {
	global $config, $lang, $suffix;
	$basedir = $config['basedir'];
	$baseurl = $config['baseurl'];
	$data = array();
	$games = array();
	$users = array();
	$ret = array();
	$max_rec = 10;
	$limit = 1;
	$q = "SELECT * FROM user_activities WHERE user_id = '$user_id' AND ua_seen = 0 ORDER BY ua_id DESC limit 0, $max_rec";
	$result = mysql_query($q);
	$numrows = mysql_num_rows($result);

	if ($numrows) {
		while ($row = mysql_fetch_array($result)) {
			$data[] = $row;
		}
		if ($numrows < $max_rec) {
			$limit = $max_rec - $numrows;
		}
	} else {
		$limit = $max_rec;
	}
	
	$q = "SELECT * FROM user_activities WHERE user_id = '$user_id' AND ua_seen = 1 ORDER BY ua_id DESC limit 0, $limit";
	$result = mysql_query($q);
	$numrows = mysql_num_rows($result);

	if ($numrows) {
		while ($row = mysql_fetch_array($result)) {
			$data[] = $row;
		}
	}
	$i = 0;
	$unseen = 0;
	foreach ($data as $d) {
		// 'like','unlike','withdraw','deposit','userfollow','bookmark','unbookmark','won','joinedgame','gamecancelled','changepass'
		$activity = $d['ua_activity'];
		switch ($activity) {
			case 'like':
				$g_id = $d['ua_fieldvalue'];
				$games[$g_id] = (!isset($games[$g_id])) ? getGameFromCache($g_id) : $games[$g_id];
				$game_title = $games[$g_id]['g_title' . $suffix];
				if (strlen($game_title) > 30) {
					$game_title = substr($game_title, 0, 30) . '...';
				}
				$ret[$i]['message'] = str_replace('$GAME_TITLE', $game_title, $lang[419]);
				$ret[$i]['time'] = _timeSince($d['ua_date']);
				$ret[$i]['image'] = $baseurl . '/game_pics/' . $games[$g_id]['g_image'];
				$ret[$i]['href'] = $baseurl . '/details.php?game=' . base64_encode($g_id);
				break;
			case 'unlike':
				$g_id = $d['ua_fieldvalue'];
				$games[$g_id] = (!isset($games[$g_id])) ? getGameFromCache($g_id) : $games[$g_id];
				$game_title = $games[$g_id]['g_title' . $suffix];
				if (strlen($game_title) > 30) {
					$game_title = substr($game_title, 0, 30) . '...';
				}
				$ret[$i]['message'] = str_replace('$GAME_TITLE', $game_title, $lang[427]);
				$ret[$i]['time'] = _timeSince($d['ua_date']);
				$ret[$i]['image'] = $baseurl . '/game_pics/' . $games[$g_id]['g_image'];
				$ret[$i]['href'] = $baseurl . '/details.php?game=' . base64_encode($g_id);
				break;
			case 'deposit':
				break;
			case 'userfollow':
				if ($d['ua_seen'] == 0) {
					$unseen++;
				}
				break;
			case 'bookmark':
				$g_id = $d['ua_fieldvalue'];
				$games[$g_id] = (!isset($games[$g_id])) ? getGameFromCache($g_id) : $games[$g_id];
				$game_title = $games[$g_id]['g_title' . $suffix];
				if (strlen($game_title) > 30) {
					$game_title = substr($game_title, 0, 30) . '...';
				}
				$ret[$i]['message'] = str_replace('$GAME_TITLE', $game_title, $lang[428]);
				$ret[$i]['time'] = _timeSince($d['ua_date']);
				$ret[$i]['image'] = $baseurl . '/game_pics/' . $games[$g_id]['g_image'];
				$ret[$i]['href'] = $baseurl . '/details.php?game=' . base64_encode($g_id);
				break;
			case 'unbookmark':
				$g_id = $d['ua_fieldvalue'];
				$games[$g_id] = (!isset($games[$g_id])) ? getGameFromCache($g_id) : $games[$g_id];
				$game_title = $games[$g_id]['g_title' . $suffix];
				if (strlen($game_title) > 30) {
					$game_title = substr($game_title, 0, 30) . '...';
				}
				$ret[$i]['message'] = str_replace('$GAME_TITLE', $game_title, $lang[429]);
				$ret[$i]['time'] = _timeSince($d['ua_date']);
				$ret[$i]['image'] = $baseurl . '/game_pics/' . $games[$g_id]['g_image'];
				$ret[$i]['href'] = $baseurl . '/details.php?game=' . base64_encode($g_id);
				break;
			case 'won':
				if ($d['ua_seen'] == 0) {
					$unseen++;
				}
				$g_id = $d['ua_fieldvalue'];
				$games[$g_id] = (!isset($games[$g_id])) ? getGameFromCache($g_id) : $games[$g_id];
				$game_title = $games[$g_id]['g_title' . $suffix];
				if (strlen($game_title) > 30) {
					$game_title = substr($game_title, 0, 30) . '...';
				}
				$ret[$i]['message'] = str_replace('$GAME_TITLE', $game_title, $lang[430]);
				$ret[$i]['time'] = _timeSince($d['ua_date']);
				$ret[$i]['image'] = $baseurl . '/game_pics/' . $games[$g_id]['g_image'];
				$ret[$i]['href'] = $baseurl . '/details.php?game=' . base64_encode($g_id);
				break;
			case 'joinedgame':
				$g_id = $d['ua_fieldvalue'];
				$games[$g_id] = (!isset($games[$g_id])) ? getGameFromCache($g_id) : $games[$g_id];
				$game_title = $games[$g_id]['g_title' . $suffix];
				if (strlen($game_title) > 30) {
					$game_title = substr($game_title, 0, 30) . '...';
				}
				$ret[$i]['message'] = str_replace('$GAME_TITLE', $game_title, $lang[431]);
				$ret[$i]['time'] = _timeSince($d['ua_date']);
				$ret[$i]['image'] = $baseurl . '/game_pics/' . $games[$g_id]['g_image'];
				$ret[$i]['href'] = $baseurl . '/details.php?game=' . base64_encode($g_id);
				break;
			case 'gamecancelled':
				if ($d['ua_seen'] == 0) {
					$unseen++;
				}
				$g_id = $d['ua_fieldvalue'];
				$games[$g_id] = (!isset($games[$g_id])) ? getGameFromCache($g_id) : $games[$g_id];
				$game_title = $games[$g_id]['g_title' . $suffix];
				if (strlen($game_title) > 30) {
					$game_title = substr($game_title, 0, 30) . '...';
				}
				$ret[$i]['message'] = str_replace('$GAME_TITLE', $game_title, $lang[432]);
				$ret[$i]['time'] = _timeSince($d['ua_date']);
				$ret[$i]['image'] = $baseurl . '/game_pics/' . $games[$g_id]['g_image'];
				$ret[$i]['href'] = $baseurl . '/details.php?game=' . base64_encode($g_id);
				break;
			case 'changepass':
				$user_id = $d['user_id'];
				$users[$user_id] = (!isset($users[$user_id])) ? getUserFromCache($user_id) : $users[$user_id];
				$ret[$i]['message'] = $lang[434];
				$ret[$i]['time'] = _timeSince($d['ua_date']);
				$ret[$i]['image'] = $baseurl . '/images/user_pics/' . $users[$user_id]['user_pic'];
				$ret[$i]['href'] = $baseurl . '/settings/password.php';
				break;
		}
		$i++;
	}
	if ($ret) {
		return array('ret' => $ret, 'unseen' => $unseen);
	} else {
		return false;
	}
	//return $ret;
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
function getLikes($uid) {
	$data = array();
	$q = "SELECT * FROM user_likes WHERE user_id = '$uid'";
	$result = mysql_query($q);
	$numrows = mysql_num_rows($result);

	if ($numrows) {
		while ($row = mysql_fetch_array($result)) {
			$data[$row['g_id']] = $row;
		}
	}

	return $data;
}
function getBookmarks($uid) {
	$data = array();
	$q = "SELECT * FROM user_bookmarks WHERE user_id = '$uid'";
	$result = mysql_query($q);
	$numrows = mysql_num_rows($result);

	if ($numrows) {
		while ($row = mysql_fetch_array($result)) {
			$data[$row['g_id']] = $row;
		}
	}

	return $data;
}
function getBetId($bet_name, $game_id) {
	$bi_id = false;
	$q = "SELECT bi_id FROM bet_item WHERE bi_description = '$bet_name' AND bi_game_id = '$game_id' LIMIT 0, 1";
	$result = mysql_query($q);
	$numrows = mysql_num_rows($result);

	if ($numrows) {
		while ($row = mysql_fetch_array($result)) {
			$bi_id = $row['bi_id'];
		}
	}

	return $bi_id;
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
function getCategoryId($name) {
	$id = 0;
	$q = "SELECT sc_id FROM sports_category WHERE sc_name = '$name'";
	$result = mysql_query($q);

	$numrows = mysql_num_rows($result);

	if ($numrows) {
		while ($row = mysql_fetch_array($result)) {
			$id = $row['sc_id'];
		}
	}

	return $id;
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
function getUserCoins($uid) {
	$in = 0;
	$out = 0;
	//recompute user's coins
	$result = mysql_query("SELECT sum( cd_amount ) AS sum, cd_inout
							FROM coin_deals
							WHERE user_id = '$uid'
							GROUP BY cd_inout");

	$numrows = mysql_num_rows($result);

	if ($numrows) {
		while ($row = mysql_fetch_array($result)) {
			if ($row['cd_inout'] == 'in') {
				$in = $in + $row['sum'];
			} else {
				$out = $out + $row['sum'];
			}
		}
	}
	return $in - $out;
}
function getUserCoins2($uid) {
	$in = 0;
	$out = 0;
	$result = mysql_query("SELECT user_coins FROM users WHERE user_id = '$uid'");

	$numrows = mysql_num_rows($result);

	if ($numrows) {
		while ($row = mysql_fetch_array($result)) {
			return $row['user_coins'];
		}
	}
	return 0;
}
function getGame($game_id, $lang = false) {
	$data = array();

	if ($lang == 'en') {
		$lfield = 'g_engPage';
	} elseif ($lang == 'jp') {
		$lfield = 'g_japPage';
	} else {
		$lfield = false;
	}

	if ($lfield) {
		$q = "SELECT * FROM games WHERE g_id = '$game_id' AND $lfield = '1' AND g_isCancelled = 0 AND g_isDeleted = 0";
	} else {
		$q = "SELECT * FROM games WHERE g_id = '$game_id' AND g_isCancelled = 0 AND g_isDeleted = 0";
	}
	$result = mysql_query($q);

	$numrows = mysql_num_rows($result);

	if ($numrows) {
		while ($row = mysql_fetch_array($result)) {
			$data = $row;
		}
	}

	return $data;
}
function getGameFromCache($game_id) {
	global $config;
	$data = array();
	$file = $config['basedir'] . '/temp/all_games.txt';
	if (file_exists($file)) {
		$all_games = json_decode(file_get_contents($file), true);
	} else {
		$all_games = getAllGames();
		file_put_contents($file, json_encode($all_games));
	}

	foreach ($all_games as $g) {
		$g_id = $g['g_id'];
		if ($g_id == $game_id) {
			$data = $g;
			break;
		}
	}
	return $data;
}
// get total placed coins for the game
function getGameCoins($data) {
	$total = 0;
	if ($data) {
		foreach ($data as $d) {
			$total += $d['ub_coins'];
		}
	}

	return $total;
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
function getBetItemsFromCache($cache, $game_id) {
	$data = array();
	foreach ($cache as $c) {
		$g_id = $c['bi_game_id'];
		if ($g_id == $game_id) {
			$data[] = $c;
		}
	}

	return $data;
}
function getAllBetItems() {
	$data = array();
	$q = "SELECT * FROM bet_item ORDER BY bi_id ASC";
	$result = mysql_query($q);

	$numrows = mysql_num_rows($result);

	if ($numrows) {
		while ($row = mysql_fetch_array($result)) {
			$data[] = $row;
		}
	}

	return $data;
}
function getCurrentPage($to_insert_uri = '') {
	$page = $_SERVER['PHP_SELF'];
	if ($to_insert_uri != '') {
		$uri = '?';
		$do_trim = false;
	} else {
		$uri = '';
		$do_trim = true;
	}
	if ($_GET) {
		$uri = '?';
		foreach ($_GET as $key => $val) {
			if (strtoupper($key) != 'LANG') { 
				$uri .= $key . '=' . $val . '&';
			}
		}
		if ($do_trim) {
			$uri = substr($uri, 0, -1);
		}
	}

	return $page . $uri . $to_insert_uri;
}
// get all bet items that are still LIVE and write to cache
function getAllBetItemsNoWinnerAndWriteToCache() {
	global $config;
	$bet_items = array();
	$win_gids = array();
	$all_bet_items = getAllBetItems();
	if ($all_bet_items) {
		// reject g_ids that have bi_winner = 1
		foreach ($all_bet_items as $abi) {
			// first get all g_ids that have bi_winner = 1
			if ($abi['bi_winner']) {
				$win_gids[$abi['bi_game_id']] = true;
			}
		}
		
		// another loop to get the bet items that have no winner yet
		foreach ($all_bet_items as $bbi) {
			if (!isset($win_gids[$bbi['bi_game_id']])) {
				$bet_items[] = $bbi;
			}	
		}
		
		$cachefile = $config['basedir'] . '/temp/bet_items_active.php';
		if (file_exists($cachefile)) {
			unlink($cachefile);
		}
		file_put_contents($cachefile, json_encode($bet_items));
	}
	return $bet_items;
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
function getTotalUsersJoined($data) {
	$total = 0;
	if ($data) {
		$temp = array();
		foreach ($data as $d) {
			if ($d['user_id']) {
				$temp[$d['user_id']] = 1;
			}
		}
	}

	return count($temp);
}
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
function getHighBetUsers($data, $bet_item) {
	$temp = array();
	$temp2 = array();
	$temp3 = array();
	if ($data) {
		$i = 0;
		foreach ($data as $d) {
			foreach ($d['bet_users'] as $k => $v) {
				$uinfo = getUserInfo($k);
				$temp[$i]['bet_id'] = $d['bi_id'];
				$temp[$i]['bet_name'] = $bet_item[$d['bi_id']];
				$temp[$i]['user_id'] = $k;
				$temp[$i]['user_name'] = $uinfo['user_name'];
				$temp[$i]['user_pic'] = $uinfo['user_pic'];
				$temp[$i]['total_coins'] = $v;
				$i++;
			}
		}

		// populate array based on total coins
		foreach ($temp as $t) {
			$temp2[$t['total_coins']] = $t['total_coins'];
		}
		sort($temp2, SORT_NUMERIC); // sort numerically

		// recreate array and sorted by total_coins, descending
		$c = count($temp2) - 1;
		for($i = $c; $i >= 0; $i -= 1) {
			$val = $temp2[$i];
			foreach ($temp as $t) {
				if ($t['total_coins'] == $val) {
					$temp3[] = $t;
				}
			}
		}
	}
	return $temp3;
}
function getTopWinners($data, $bet_item, $bi_id_of_winner) {
	$temp = array();
	$temp2 = array();
	$temp3 = array();
	if ($data) {
		$i = 0;
		foreach ($data as $d) {
			if ($d['bi_id'] == $bi_id_of_winner) {
				foreach ($d['bet_users'] as $k => $v) {
					$uinfo = getUserInfo($k);
					$temp[$i]['bet_id'] = $d['bi_id'];
					$temp[$i]['bet_name'] = $bet_item[$d['bi_id']];
					$temp[$i]['user_id'] = $k;
					$temp[$i]['user_name'] = $uinfo['user_name'];
					$temp[$i]['user_pic'] = $uinfo['user_pic'];
					$temp[$i]['total_coins'] = $v;
					$i++;
				}
			}
		}

		// populate array based on total coins
		foreach ($temp as $t) {
			$temp2[$t['total_coins']] = $t['total_coins'];
		}
		sort($temp2, SORT_NUMERIC); // sort numerically

		// recreate array and sorted by total_coins, descending
		$c = count($temp2) - 1;
		for($i = $c; $i >= 0; $i -= 1) {
			$val = $temp2[$i];
			foreach ($temp as $t) {
				if ($t['total_coins'] == $val) {
					$temp3[] = $t;
				}
			}
		}
	}
	return $temp3;
}
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
function getUser($user_id) {
	$data = array();
	$q = "SELECT * FROM users WHERE user_id = '$user_id' LIMIT 0, 1";
	$result = mysql_query($q);

	$numrows = mysql_num_rows($result);

	if ($numrows) {
		while ($row = mysql_fetch_array($result)) {
			$data = $row;
		}
	}

	return $data;
}
function getAllGames($where = false) {
	$data = array();
	$now = time();
	if ($where) {
		$is_where = $where;
	} else {
		$is_where = '';
	}

	if ($is_where) {
		$q = "SELECT * FROM games WHERE $is_where AND g_isDeleted = 0 ORDER BY g_id DESC";
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
function filterAllGames($all_games, $sort, $cat) {
	global $suffix;
	if (!$all_games) { return false; }
	$data = array();
	$bet_items = array();
	$bet_items2 = array();
	$now = time();
	$i = 0;
	$all_bets_from_db = false;
	$all_bet_items = false;
	foreach ($all_games as $a) {
		$all_bets = false;
		$g_id = $a['g_id'];
		if (!$all_bets_from_db) {
			$all_bets_from_db = getAllBets(); // query the DB
		}
		if (!$all_bet_items) {
			$all_bet_items = getAllBetItems(); // query the DB
		}
		$all_bets = getAllBetsFromCache($all_bets_from_db, $g_id);
		$bet_items = getBetItemsFromCache($all_bet_items, $g_id);
		if ($bet_items) {
			foreach($bet_items as $bi) {
				$bet_items2[$bi['bi_id']] = $bi['bi_description' . $suffix]; // assign bi_id as key and bi_description as value
			}
		}

		// by category
		if ($cat == 'all') {
			$data[$i] = $a;
			foreach($bet_items as $bi) {
				$data[$i]['bet_items'][] = $bet_items2[$bi['bi_id']];
			}
			$data[$i]['total_bets'] = getGameCoins($all_bets);
		} else {
			$hit = false;
			$xs = explode(",", $a['g_categories']);
			foreach ($xs as $x) {
				if (strtolower($x) == strtolower($cat)) {
					$hit = true;
					break;
				}
			}
			if ($hit) {
				$data[$i] = $a;
				foreach($bet_items as $bi) {
					$data[$i]['bet_items'][] = $bet_items2[$bi['bi_id']];
				}
				$data[$i]['total_bets'] = getGameCoins($all_bets);
			}
		}
		$i++;
	}
	return $data;
}
function getAllResultGames($all_games, $sort, $cat) {

}
function getUserBets($game_id, $uid) {
	$data = array();
	$q = "SELECT user_id, g_id, bi_id, sum(ub_coins) as tot_coins FROM user_bets WHERE user_id = '$uid' AND g_id = '$game_id' GROUP BY bi_id";
	$result = mysql_query($q);
	$numrows = mysql_num_rows($result);

	if ($numrows) {
		while ($row = mysql_fetch_array($result)) {
			$data[$row['bi_id']] = $row;
		}
	}

	return $data;
}
function getUserBetsTotal($game_id, $uid) {
	$data = 'nobet';
	$q = "SELECT sum(ub_coins) as tot_coins FROM user_bets WHERE user_id = '$uid' AND g_id = '$game_id' GROUP BY bi_id";
	$result = mysql_query($q);
	$numrows = mysql_num_rows($result);

	if ($numrows) {
		$data = 0;
		while ($row = mysql_fetch_array($result)) {
			$data += $row['tot_coins'];
		}
	}

	return $data;
}
function getUserMayEarn($info_per_bet_item, $house_comm) {
	$data = array();
	$total_placed_coins = 0;
	foreach ($info_per_bet_item as $ipbi) {
		$total_placed_coins += $ipbi['placed_coins']; // total coins at stake before commission;
	}
	
	$total_placed_coins_after_comm = $total_placed_coins - ($total_placed_coins * ($house_comm / 100));
	$data['house_commission'] = $house_comm;
	$data['at_stake_no_comm'] = $total_placed_coins;
	$data['at_stake'] = $total_placed_coins_after_comm;
	
	foreach ($info_per_bet_item as $ipbi) {
		$total_item_bet_share = 0;
		$bi_id = $ipbi['bi_id'];
		$data[$bi_id]['total_item_coins'] = 0;
		if (is_array($ipbi['bet_users'])) {
			foreach ($ipbi['bet_users'] as $key => $val) {
				$his_bet = $val;
				$data[$bi_id][$key]['his_coins'] = $val;
				$data[$bi_id][$key]['his_share'] = number_format(($his_bet / $total_placed_coins * 100), 2);
				$total_item_bet_share += $data[$bi_id][$key]['his_share'];
				$data[$bi_id]['total_item_coins'] += $his_bet;
			}
		}
		$data[$bi_id]['total_item_bet_share'] = $total_item_bet_share;
	}
	/*
	his share = (his_coins / at_stake_no_com) * 100
	at_stake = at_stake_no_com - (at_stake_no_com * (house_commission / 100))
	user won coins = (at_stake / total_item_bet_share) * his_share
	TEST DATA
		Array
		(
		    [house_commission] => 10
		    [at_stake_no_comm] => 630
		    [at_stake] => 567
		    [27] => Array
		        (
		            [total_item_coins] => 100
		            [6] => Array
		                (
		                    [his_coins] => 100
		                    [his_share] => 15.87
		                )
		
		            [total_item_bet_share] => 15.87
		        )
		
		    [28] => Array
		        (
		            [total_item_coins] => 500
		            [5] => Array
		                (
		                    [his_coins] => 400
		                    [his_share] => 63.49
		                )
		
		            [6] => Array
		                (
		                    [his_coins] => 100
		                    [his_share] => 15.87
		                )
		
		            [total_item_bet_share] => 79.36
		        )
		
		    [29] => Array
		        (
		            [total_item_coins] => 30
		            [6] => Array
		                (
		                    [his_coins] => 30
		                    [his_share] => 4.76
		                )
		
		            [total_item_bet_share] => 4.76
		        )
		
		)

	*/
	return $data;
}
function getUserBetsGroupByGameId($uid) {
	$data = array();
	$q = "SELECT * FROM user_bets WHERE user_id = '$uid' GROUP BY g_id";
	$result = mysql_query($q);
	$numrows = mysql_num_rows($result);

	if ($numrows) {
		while ($row = mysql_fetch_array($result)) {
			$data[$row['g_id']] = $row;
		}
	}

	return $data;
}
function getAllBetsFromCache($all_bets, $g_id) {
	$data = array();
	foreach ($all_bets as $a) {
		if ($a['g_id'] == $g_id) {
			$data[] = $a;
		}
	}
	return $data;
}
// this function is mostly being used by /ajax/betstatus-realtime.php
// this function works similarly with getAllBets(). 
// But this function relies on given cached data instead of querying the DB.
function getAllBetsFromCache2($bet_items, $user_bets, $g_id) {
	$data = array();
	$bi_ids = array();
	foreach ($bet_items as $bi) {
		if ($bi['bi_game_id'] == $g_id) {
			$bi_ids[$bi['bi_id']] = false;
		}
	}
	foreach ($user_bets as $ub) {
		if ($ub['g_id'] == $g_id) {
			$bi_ids[$ub['bi_id']] = true;
			$data[] = $ub;
		}
	}
	foreach ($bi_ids as $key => $val) {
		$row = false;

		// if $val is false, then there were no bets for this bet item
		// so populate with 0 values so this bet item will still be displayed
		// we need to show the users that this item has 0 bets
		if (!$val) {
			$row = array(
					'ub_id' => 0,
					'user_id' => 0,
					'g_id' => $g_id,
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
// get all the bets. If no game_id was given, then get everything
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
// get all coin_deals
function getCoinDeals() {
	$data = array();
	$q = "SELECT * FROM coin_deals";
	$result = mysql_query($q);
	$numrows = mysql_num_rows($result);

	if ($numrows) {
		while ($row = mysql_fetch_array($result)) {
			$data[] = $row;
		}
	}

	// check if no cache already exists
	if (!checkCacheExists('all_coin_deals.txt')) {
		recreateCache('all_coin_deals.txt', $data);
	}
	return $data;
}
// get all user's coin deals from cache
function getUserCoinDeals($uid, $cache) {
	$data = array();
	foreach ($cache as $c) {
		if ($c['user_id'] == $uid) {
			$data[] = $c;
		}
	}
	return $data;
}
function getCoinDealsFromCache() {
	global $config;
	$data = array();
	$file = $config['basedir'] . '/temp/all_coin_deals.txt';
	if (file_exists($file)) {
		$data = json_decode(file_get_contents($file), true);
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
// /GET

// UPDATE
function updateUserCoins($uid, $coins) {
	global $config;
	$basedir = $config['basedir'];
	$q = "UPDATE users SET user_coins = '$coins' WHERE user_id = '$uid'";
	mysql_query($q);
	
	$file = $basedir . '/temp/all_users.txt';
	if (file_exists($file)) {
		$data = json_decode(file_get_contents($file), true);
		$data[$uid]['user_coins'] = $coins;
		unlink($file);
		file_put_contents($file, json_encode($data));
	}
	$_SESSION['user_coins'] = $coins;
	
	return true;
}
// /UPDATE

// CHECK
function checkUserWon($user_id, $game_id) {
	//$q = "SELECT sum(ub_coins) as total_coins FROM user_bets WHERE user_id = '$user_id' AND g_id = '$game_id' AND bi_id = '$bi_id' AND ub_iswinner = 1 GROUP BY bi_id";
	$q = "SELECT cd_amount FROM coin_deals WHERE user_id = '$user_id' AND g_id = '$game_id' AND cd_inout = 'in' AND cd_type = 'bet winning'";
	$result = mysql_query($q);
	$numrows = mysql_num_rows($result);

	if ($numrows) {
		while ($row = mysql_fetch_array($result)) {
			return $row['cd_amount'];
		}
	}

	return 'nowin';
}
function checkUserExists($email) {
	$q = "SELECT user_id FROM users WHERE user_email = '$email' LIMIT 0, 1";
		$result = mysql_query($q);
		$numrows = mysql_num_rows($result);

		if ($numrows) {
			return true;
		}

		return false;
}
function checkCacheExists($filename) {
	global $config;
	$cache = $filename;
	$cachefile = $config['basedir'] . '/temp/' . $cache;

	if (file_exists($cachefile)) {
		return true;
	} else {
		return false;
	}
}
function checkGameisClosed($g_id) {
	$data = array();
	$q = "SELECT g_id FROM games WHERE g_id = '$g_id' AND g_isClosed = 1 LIMIT 0, 1";
	$result = mysql_query($q);
	$numrows = mysql_num_rows($result);

	if ($numrows) {
		return true; // game is closed
	}

	return false; // game is still live
}
// /CHECK

// OTHER
function login($email, $pass) {
	global $config;
	$pass = md5($config['private_key'] . $pass);
	$data = array();
	$q = "SELECT * FROM users WHERE user_email = '$email' AND user_password = '$pass' AND (user_status = '1' OR user_status = '3') LIMIT 0, 1";
	$result = mysql_query($q);
	$numrows = mysql_num_rows($result);

	if ($numrows) {
		while ($row = mysql_fetch_array($result)) {
			$data = $row;
			$uid = $row['user_id'];
			$now = time();
			$q = "UPDATE users SET user_lastlogin = '$now' WHERE user_id = '$uid'";
			mysql_query($q);
		}
	}

	return $data;
}
function register($email, $username) {
	global $config;
	$data = array();
	$ranpass = 'atl' . rand(1, 999);
	$pass_enc = md5($config['private_key'] . $ranpass); // encrypt the password
	if ($email AND $username) {
		if (checkUserExists($email)) {
			return 'User exists!';
		}

		$q = "INSERT INTO users (user_name, user_email, user_password, user_status) VALUES ('$username', '$email', '$pass_enc', 1)";
		mysql_query($q);
		/*
		// append cache
		$data['user_id'] = mysql_insert_id();
        $data['user_name'] = $username;
        $data['user_fullname'] = '';
        $data['user_pic'] = '';
        $data['user_password'] = $pass_enc;
        $data['user_coins'] = 0;
        $data['user_betting'] = 0;
        $data['user_email'] = $email;
        $data['user_lastlogin'] = '';
        $data['user_registered'] = date('Y-m-d h:i:s');
        $data['user_isadmin'] => 0
        $data['user_status'] => 1
        $data['user_lang'] => 
        $data['user_timezone'] = $config['time zone'];
        $data['user_sex'] = '';
        $data['user_bio'] = '';
        $data['user_website'] = '';
        $data['user_notify'] = '';
        $data['user_sendmail'] = 0;
        $data['user_remind'] = 0;
        $data['user_gamedigest'] = 0;
        $data['user_sitenews'] = 0;
        $cachefile = $config['basedir'] . '/temp/all_users.txt';
        if (file_exists($cachefile)) {
	       $cache = json_decode(file_get_contents($filename), true);
	       $cache[mysql_insert_id()] = $data;
	       
	       unlink($cachefile);
	       file_put_contents($cachefile, json_encode($cache));
        }
		*/
		sendUserEmail($email, $username, $ranpass);
		return 'success';
	}
}
// send the password to the user
function sendUserEmail($email, $username, $password) {
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

// sort by: time [g_schedTo]; coin [total_bets]; new [g_schedFrom]; likes [g_likes]
function sortGames($games, $sortby) {
	if (!$games) { return array(); }
	$data = array();
	$new_param = array();
	$new_data = array();

	if ($sortby == 'time') {
		$sort = 'g_schedTo';
		$smethod = 'asc';
	} elseif ($sortby == 'coin') {
		$sort = 'total_bets';
		$smethod = 'desc';
	} elseif ($sortby == 'like') {
		$sort = 'g_likes';
		$smethod = 'desc';
	} else {
		// new
		$sort = 'g_schedFrom';
		$smethod = 'asc';
	}

	foreach ($games as $p) {
		$data[$p['g_id']] = $p[$sort];
		$new_param[$p['g_id']] = $p;
	}
	if ($smethod == 'asc') {
		asort($data);
	} else {
		arsort($data);
	}

	foreach ($data as $key => $val) {
		$new_data[] = $new_param[$key];
	}

	return $new_data;
}
function checkIsLiked($uid, $gid) {
	$q = "SELECT ul_id FROM user_likes WHERE user_id = '$uid' AND g_id = '$gid'";
	$result = mysql_query($q);
	$numrows = mysql_num_rows($result);

	if ($numrows) {
		return true;
	} else {
		return false;
	}
}
function checkIsBookmarked($uid, $gid) {
	$q = "SELECT ub_id FROM user_bookmarks WHERE user_id = '$uid' AND g_id = '$gid'";
	$result = mysql_query($q);
	$numrows = mysql_num_rows($result);

	if ($numrows) {
		return true;
	} else {
		return false;
	}
}
function cancelGame($g_id) {
	$q = "UPDATE games SET g_isCancelled = 1 WHERE g_id = '$g_id'";
	mysql_query($q);
	return true;
}
function formatOffset($offset) {
    $hours = $offset / 3600;
    $remainder = $offset % 3600;
    $sign = $hours > 0 ? '+' : '-';
    $hour = (int) abs($hours);
    $minutes = (int) abs($remainder / 60);

    if ($hour == 0 AND $minutes == 0) {
        $sign = ' ';
    }
    return $sign . str_pad($hour, 2, '0', STR_PAD_LEFT) .':'. str_pad($minutes,2, '0');
}
function _timeSince($dateAdded) {
	global $lang;
	
	$curDate = time();
	$ux = $curDate - $dateAdded;
	// seconds = 60
	// hour = 3600
	// day = 86400
	// week = 604800
	// month = 2592000
	// year = 31104000
	if ($ux < 60) {
		$aGo = $lang[420];
		$aGo = str_replace('$VAR', $ux, $aGo);
		return $aGo;
	} elseif ($ux > 60 AND $ux < 3600) {
		// less than 1 hour
		$elaps = (int) ($ux / 60);
		$aGo = $lang[421];
		$aGo = str_replace('$VAR', $elaps, $aGo);
		return $aGo;
	} elseif ($ux > 3600 AND $ux < 86400) {
		// less than 1 day
		$elaps = (int) ($ux / 3600);
		$aGo = $lang[422];
		$aGo = str_replace('$VAR', $elaps, $aGo);
		return $aGo;
	} elseif ($ux > 86400 AND $ux < 604800) {
		// less than 1 week
		$elaps = (int) ($ux / 86400);
		$aGo = $lang[423];
		$aGo = str_replace('$VAR', $elaps, $aGo);
		return $aGo;
	} elseif ($ux > 604800 AND $ux < 2592000) {
		// less than 1 month
		$elaps = (int) ($ux / 604800);
		$aGo = $lang[424];
		$aGo = str_replace('$VAR', $elaps, $aGo);
		return $aGo;
	} elseif ($ux > 2592000 AND $ux < 31104000) {
		// less than 1 year
		$elaps = (int) ($ux / 2592000);
		$aGo = $lang[425];
		$aGo = str_replace('$VAR', $elaps, $aGo);
		return $aGo;
	} elseif ($ux > 31104000) {
		$elaps = (int) ($ux / 31104000);
		$aGo = $lang[426];
		$aGo = str_replace('$VAR', $elaps, $aGo);
		return $aGo;
	}
}
function compareTags($tag1, $tag2) {
	$xtags1 = explode(",", $tag1);
	$xtags2 = explode(",", $tag2);
	$found = false;
	foreach ($xtags1 as $xt) {
		if (in_array($xt, $xtags2)) {
			$found = true;
		}
	}

	return $found;
}
// only get public games from cache
function filterPublicGames($cache) {
	global $LANGUAGE;
	if ($LANGUAGE == 'en') {
		$lang_field = 'g_engPage';
	} else {
		$lang_field = 'g_japPage';
	}
	$data = array();
	foreach ($cache as $c) {
		if ($c['g_publishType'] == 'public' AND $c[$lang_field] == 1) {
			$data[] = $c;
		}
	}
	return $data;
}
// /OTHER
?>