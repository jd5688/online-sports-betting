<?php
session_start();
require_once("../../../include/config.php");
require_once($basedir . "/admin/include/functions.php");

$insert_id = false;
$bet_items = array();
$bet_items_en = array();
$title = (isset($_POST['title'])) ? $_POST['title'] : '';
$title_en = (isset($_POST['title_en'])) ? $_POST['title_en'] : '';
$description = (isset($_POST['description'])) ? $_POST['description'] : '';
$description_en = (isset($_POST['description_en'])) ? $_POST['description_en'] : '';
$category = (isset($_POST['selectCategory'])) ? $_POST['selectCategory'] : '';
$category_en = (isset($_POST['selectCategory_en'])) ? $_POST['selectCategory_en'] : '';
$tags = (isset($_POST['tags'])) ? $_POST['tags'] : '';
$image = (isset($_POST['curimage'])) ? $_POST['curimage'] : '';
$tags_en = (isset($_POST['tags_en'])) ? $_POST['tags_en'] : '';
$game_id = (isset($_POST['game_id'])) ? $_POST['game_id'] : '';

$total_placed_coins = getGameTotalPlacedCoins($game_id);
if (!$game_id) {
	$_SESSION['error'] = array('error' => '1', 'status' => $lang[213]);
	header('Location: '. $_POST['location']);
	exit;
}

if (isset($_POST['bet_item0']) AND isset($_POST['bet_item1'])) {
	for ($i = 0; $i < 50; $i++) {
		if (isset($_POST['bet_item' . $i]) AND $_POST['bet_item' . $i] != '') {
			$bet_items[] = $_POST['bet_item' . $i];
		}
	}
} else {
	//$_SESSION['error'] = array('error' => '1', 'status' => $lang[213]);
	//header('Location: '. $_POST['location']);
	//exit;
}
if (isset($_POST['bet_item_en0']) AND isset($_POST['bet_item_en1'])) {
	for ($i = 0; $i < 50; $i++) {
		if (isset($_POST['bet_item_en' . $i]) AND $_POST['bet_item_en' . $i] != '') {
			$bet_items_en[] = $_POST['bet_item_en' . $i];
		} else {
			break;
		}
	}
} else {
	//$_SESSION['error'] = array('error' => '1', 'status' => $lang[213]);
	//header('Location: '. $_POST['location']);
	//exit;
}

$bet_info = (isset($_POST['betInfo'])) ? $_POST['betInfo'] : '';
$bet_info_en = (isset($_POST['betInfo_en'])) ? $_POST['betInfo_en'] : '';
$bet_condition = (isset($_POST['betCondition'])) ? $_POST['betCondition'] : '';
$bet_condition_en = (isset($_POST['betCondition_en'])) ? $_POST['betCondition_en'] : '';
$reserve_time = (isset($_POST['reservationTime'])) ? $_POST['reservationTime'] : '';

if ($reserve_time) {
	$x = explode("-", $reserve_time);
	// format 06/14/2014 12:00 AM converted to unix time
	$reserve_time1 = strtotime(trim($x[0]));
	$reserve_time2 = strtotime(trim($x[1]));
} else {
	$reserve_time1 = '';
	$reserve_time2 = '';
	//$_SESSION['error'] = array('error' => '1', 'status' => $lang[213]);
	//header('Location: '. $_POST['location']);
	//exit;
}

$coin_per_bet = (isset($_POST['coinPerBet'])) ? $_POST['coinPerBet'] : '';
$house_comm = (isset($_POST['houseComm'])) ? $_POST['houseComm'] : '';
$publish_type = (isset($_POST['publishType'])) ? $_POST['publishType'] : '';
$is_recommend = (isset($_POST['isRecommend'])) ? $_POST['isRecommend'] : 0;
$jap_page = (isset($_POST['japPage'])) ? $_POST['japPage'] : 0;
$eng_page = (isset($_POST['engPage'])) ? $_POST['engPage'] : 0;
$bet_minimum = (isset($_POST['betMinimum'])) ? $_POST['betMinimum'] : 0;

/*
if (!$title OR !$description OR !$category OR !$category OR !$bet_info OR !$bet_condition OR !$reserve_time OR !$coin_per_bet OR !$house_comm) {
	$_SESSION['error'] = array('error' => '1', 'status' => $lang[213]);
	header('Location: '. $_POST['location']);
	exit;
}
*/
if (!$title AND $jap_page) {
	$_SESSION['error'] = array('error' => '1', 'status' => $lang[213]);
	header('Location: '. $_POST['location']);
	exit;
}

if (!$title_en AND $eng_page) {
	$_SESSION['error'] = array('error' => '1', 'status' => $lang[213]);
	header('Location: '. $_POST['location']);
	exit;
}

//$category = implode(",", $category);
$is_trial = (isset($_POST['isTrial'])) ? $_POST['isTrial'] : '';

	$imgfilename = time();
	$gphoto = $_FILES['imgFile']['tmp_name'];
	if ($gphoto) {
		$imageinfo = getimagesize($gphoto);
		
		if($imageinfo[2] == 1) {
			$imgfilename .= ".gif";
		} elseif($imageinfo[2] == 2) {
			$imgfilename .= ".jpg";
		} elseif($imageinfo[2] == 3) {
			$imgfilename .= ".png";
		} else {
			$imgfilename = false;
		}
		
		if ($imgfilename) {
			$img_loc = $basedir . "/game_pics/" . $imgfilename;
			if(file_exists($img_loc)) {
				unlink($img_loc);
			}
			// delete old image if exists
			$old_img = $basedir . "/game_pics/" . $image;
			if(file_exists($old_img)) {
				unlink($old_img);
			}
			move_uploaded_file($gphoto, $img_loc);
		}
	} else {
		$imgfilename = $image;
	}

	$timezone = $config['time zone'];
	$q = "UPDATE games SET ";
	$q .= "g_timezone = '$timezone', ";
	$q .= "g_title = '$title_en', g_title_jp = '$title', g_description = '$description_en', g_description_jp = '$description', g_image = '$imgfilename', g_categories = '$category_en', g_categories_jp = '$category', ";
	$q .= "g_tags = '$tags_en', g_tags_jp = '$tags', g_betInfo = '$bet_info_en', g_betInfo_jp = '$bet_info', g_addInfo = '$bet_condition_en', g_addInfo_jp = '$bet_condition', g_schedFrom = '$reserve_time1', ";
	$q .= "g_schedTo = '$reserve_time2', g_coinPerBet = '$coin_per_bet', g_houseCom = '$house_comm', g_publishType = '$publish_type', ";
	$q .= "g_isRecommend = '$is_recommend', g_isTrial = '$is_trial', g_japPage = '$jap_page', g_engPage = '$eng_page', g_betMinimum = '$bet_minimum', ";
	$q .= "g_isCancelled = 0, g_isClosed = 0, g_isDeleted = 0 WHERE g_id = '$game_id'";
	mysql_query($q);

	$tags = explode(",", $tags);
	foreach ($tags as $tag) {
		if ($tag) {
			$bool = getTag($tag);
		} else {
			$bool = true;
		}
		if (!$bool) {
			addTag($tag);
		} 
	}
	$tags_en = explode(",", $tags_en);
	foreach ($tags_en as $tag) {
		if ($tag) {
			$bool = getTag($tag, 'en');
		} else {
			$bool = true;
		}
		if (!$bool) {
			addTag($tag, '', 'en');
		} 
	}

	// bet items must not be overwritten if coins have already been betted on the game
	// so we need to prevent it by checking if total_placed_coin is 0
	if (!$total_placed_coins) {
		$cachefile = $basedir . '/temp/bet_items_active.php';
		$cachedata = false;
		if (file_exists($cachefile)) {
			$temp = json_decode(file_get_contents($cachefile), true);
			
			// remove all bet items from this game
			foreach ($temp as $c) {
				if ($c['bi_game_id'] != $game_id) {
					$cachedata[] = $c;
				}
			}
		}
		
		deleteBetItem($game_id);
		$count_bi = count($bet_items);
		for ($i = 0; $i < $count_bi; $i++) {
			$bet_id = addBetItem($game_id, $bet_items[$i], $bet_items_en[$i]);
			if ($bet_id AND $cachedata) {
				$cachedata[] = array
							(
								'bi_id' => $bet_id,
								'bi_game_id' => $insert_id,
								'bi_description' => $bet_items_en[$i],
								'bi_description_jp' => $bet_items[$i],
								'bi_winner' => 0
							);
			}
		}

		if ($cachedata) {
			file_put_contents($cachefile, json_encode($cachedata));
		}
	} // !if $total_placed_coins
	
	// renew the cache
	$filename = $basedir . '/temp/all_games.txt';
	$games = getAllGames();
	if (file_exists($filename)) {
		unlink($filename);
	}
	file_put_contents($filename, json_encode($games));
	
	$_SESSION['error'] = array('error' => '0', 'status' => $lang[214]);
	header('Location: '. $_POST['location']);
	exit;
?>