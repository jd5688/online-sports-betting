<?php
function changepass($op, $np1, $np2, $uid) {
	global $config;
	$basedir = $config['basedir'];
	$pass_enc = md5($config['private_key'] . $np1); // encrypt the password
	if (!_checkoldpass($op, $uid)) {
		return 'invalid old password';
	}
	
	if ($np1 != $np2) {
		return 'no match';
	}
	
	$q = "UPDATE users SET user_password = '$pass_enc' WHERE user_id = '$uid'";
	mysql_query($q);
	$user_id = $uid;
	$file = $basedir . '/temp/all_users.txt';
	if (file_exists($file)) {
		$data = json_decode(file_get_contents($file), true);
		$data[$user_id]['user_password'] = $np1;
		unlink($file);
		file_put_contents($file, json_encode($data));
	}
	
	$activity = 'changepass';
	$seen = 1;
	$fieldname = 'user_id';
	$fieldvalue = $uid;
	addActivity($uid, $activity, $seen, $fieldname, $fieldvalue);
	return $pass_enc;
}
function _checkoldpass($op, $uid) {
	global $config;
	$pass_enc = md5($config['private_key'] . $op); // encrypt the password
	$q = "SELECT user_id FROM users WHERE user_password = '$pass_enc' AND user_id = '$uid'";
	$result = mysql_query($q);
	$numrows = mysql_num_rows($result);
	
	if ($numrows) {
		return true; // valid
	} else {
		return false; // invalid
	}
} 
function changeLangAndTz($lang, $tz, $user_id) {
	global $config;
	$basedir = $config['basedir'];
	$q = "UPDATE users SET user_lang = '$lang', user_timezone = '$tz' WHERE user_id = '$user_id'";
	mysql_query($q);
	
	$file = $basedir . '/temp/all_users.txt';
	if (file_exists($file)) {
		$data = json_decode(file_get_contents($file), true);
		$data[$user_id]['user_lang'] = $lang;
		$data[$user_id]['user_timezone'] = $tz;
		unlink($file);
		file_put_contents($file, json_encode($data));
	}
	
	return $tz;
}
function do_resize_profimage($file, $width = 0, $height = 0, $proportional = false, $output = 'file')
{
	if($height <= 0 && $width <= 0)
	{
	  return 1;
	}
	
	$info = getimagesize($file);
	$image = '';

	$final_width = 0;
	$final_height = 0;
	list($width_old, $height_old) = $info;
	
	if ($width_old < $width AND $height_old < $height) {
		return 1;
	}

	if($proportional) 
	{
	  if ($width == 0) $factor = $height/$height_old;
	  elseif ($height == 0) $factor = $width/$width_old;
	  else $factor = min ( $width / $width_old, $height / $height_old);   
	  
	  $final_width = round ($width_old * $factor);
	  $final_height = round ($height_old * $factor);
		  
	  if($final_width > $width_old && $final_height > $height_old)
	  {
	  	  $final_width = $width_old;
		  $final_height = $height_old;

	  }
	}
	else 
	{
	  $final_width = ( $width <= 0 ) ? $width_old : $width;
	  $final_height = ( $height <= 0 ) ? $height_old : $height;
	}
	
	switch($info[2]) 
	{
	  case IMAGETYPE_GIF:
		$image = imagecreatefromgif($file);
	  break;
	  case IMAGETYPE_JPEG:
		$image = imagecreatefromjpeg($file);
	  break;
	  case IMAGETYPE_PNG:
		$image = imagecreatefrompng($file);
	  break;
	  default:
		return 1;
	}
	
	$original_aspect = $width / $height;
	$thumb_aspect = $final_width / $final_height;
	
	if ( $original_aspect >= $thumb_aspect )
	{
	   // If image is wider than thumbnail (in aspect ratio sense)
	   $new_height = $final_height;
	   $new_width = $width / ($height / $final_height);
	}
	else
	{
	   // If the thumbnail is wider than the image
	   $new_width = $final_width;
	   $new_height = $height / ($width / $final_width);
	}

	$image_resized = imagecreatetruecolor( $final_width, $final_height );

	if(($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG))
	{
	  $trnprt_indx = imagecolortransparent($image);
	
	  if($trnprt_indx >= 0)
	  {
		$trnprt_color    = imagecolorsforindex($image, $trnprt_indx);
		$trnprt_indx    = imagecolorallocate($image_resized, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
		imagefill($image_resized, 0, 0, $trnprt_indx);
		imagecolortransparent($image_resized, $trnprt_indx);	
	  } 
	  elseif($info[2] == IMAGETYPE_PNG) 
	  {
		imagealphablending($image_resized, false);
		$color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);
		imagefill($image_resized, 0, 0, $color);
		imagesavealpha($image_resized, true);
	  }
	}
	//imagecopyresampled($image_resized, $image, 0, 0, 0, 0, $final_width, $final_height, $width_old, $height_old);

	imagecopyresampled($image_resized,$image,
                   0 - ($new_width - $width) / 2, // Center the image horizontally
                   0 - ($new_height - $height) / 2, // Center the image vertically
                   0, 0,
                   $new_width, $new_height,
                   $width_old, $height_old);

	switch( strtolower($output))
	{
	  case 'browser':
		$mime = image_type_to_mime_type($info[2]);
		header("Content-type: $mime");
		$output = NULL;
	  break;
	  case 'file':
		$output = $file;
	  break;
	  case 'return':
		return $image_resized;
	  break;
	  default:
	  break;
	}
	
	if(file_exists($output))
	{
		@unlink($output);
	}

	switch($info[2])
	{
	  case IMAGETYPE_GIF:
		imagegif($image_resized, $output);
	  break;
	  case IMAGETYPE_JPEG:
		imagejpeg($image_resized, $output, 100);
	  break;
	  case IMAGETYPE_PNG:
		imagepng($image_resized, $output);
	  break;
	  default:
		return 1;
	}
	return 1;
}
function updateUserImageFile($user_id, $imgfilename) {
	global $config;
	$basedir = $config['basedir'];
	$q = "UPDATE users SET user_pic = '$imgfilename' WHERE user_id = '$user_id'";
	mysql_query($q);
	
	$file = $basedir . '/temp/all_users.txt';
	if (file_exists($file)) {
		$data = json_decode(file_get_contents($file), true);
		$data[$user_id]['user_pic'] = $imgfilename;
		unlink($file);
		file_put_contents($file, json_encode($data));
	}
	return true;
}
function updateUserNotifications($user_id, $ms, $gr, $gd, $mr, $sn) {
	global $config;
	$basedir = $config['basedir'];
	$q = "UPDATE users SET user_notify = '$gr', user_sendmail = '$ms', user_remind = '$mr', user_gamedigest = '$gd', user_sitenews = '$sn' WHERE user_id = '$user_id'";
	mysql_query($q);
	
	$file = $basedir . '/temp/all_users.txt';
	if (file_exists($file)) {
		$data = json_decode(file_get_contents($file), true);
		$data[$user_id]['user_notify'] = $gr;
		$data[$user_id]['user_sendmail'] = $ms;
		$data[$user_id]['user_remind'] = $mr;
		$data[$user_id]['user_gamedigest'] = $gd;
		$data[$user_id]['user_sitenews'] = $sn;
		unlink($file);
		file_put_contents($file, json_encode($data));
	}
	
	return 'success';
}
function updateUserPrivacy($user_id, $priv_page, $priv_result) {
	global $config;
	$basedir = $config['basedir'];
	$q = "UPDATE users SET user_privacy_page = '$priv_page', user_privacy_result = '$priv_result' WHERE user_id = '$user_id'";
	mysql_query($q);
	
	$file = $basedir . '/temp/all_users.txt';
	if (file_exists($file)) {
		$data = json_decode(file_get_contents($file), true);
		$data[$user_id]['user_privacy_page'] = $priv_page;
		$data[$user_id]['user_privacy_result'] = $priv_result;
		unlink($file);
		file_put_contents($file, json_encode($data));
	}
	
	return 'success';
}
function updateActivities($user_id) {
	$q = "UPDATE user_activities SET ua_seen = 1 WHERE user_id = '$user_id'";
	mysql_query($q);
	return true;
}
function editUserProfile($user_id, $bio, $fullname, $sex, $web, $ra) {
	global $config;
	$basedir = $config['basedir'];
	$file = $basedir . '/temp/all_users.txt';
	if ($ra) {
		// remove avatar
		$q = "UPDATE users SET user_pic = '', user_bio = '$bio', user_fullname = '$fullname', user_sex = '$sex', user_website = '$web' WHERE user_id = '$user_id'";
	} else {
		$q = "UPDATE users SET user_bio = '$bio', user_fullname = '$fullname', user_sex = '$sex', user_website = '$web' WHERE user_id = '$user_id'";
	}
	mysql_query($q);
	
	$file = $basedir . '/temp/all_users.txt';
	if (file_exists($file)) {
		$data = json_decode(file_get_contents($file), true);
		if ($ra) {
			$data[$user_id]['user_pic'] = '';
		}
		$data[$user_id]['user_bio'] = $bio;
		$data[$user_id]['user_fullname'] = $fullname;
		$data[$user_id]['user_sex'] = $sex;
		$data[$user_id]['user_website'] = $web;
		unlink($file);
		file_put_contents($file, json_encode($data));
	}
	return 'success';
}

/*
PARAM:
Array
(
    [cc_holder_name] => Rudem Labial
    [cc_exp_mo] => 01
    [cc_exp_yr] => 2016
    [bill_fullname] => Sugar Roll
    [bill_postal] => 100-0014
    [bill_prefecture] => 
    [bill_address1] => B4, L9 UBB
    [bill_address2] => Marikina City
    [bill_phone] => 12345678
    [cc_id] => 4
    [bill_id] => 4
)
*/
function editCreditInfo($param) {
	$user_id = $_SESSION['user_id'];
	$cc_holder_name = $param['cc_holder_name'];
	$cc_exp_mo = $param['cc_exp_mo'];
	$cc_exp_yr = $param['cc_exp_yr'];
	$bf = $param['bill_fullname'];
	$bpost = $param['bill_postal'];
	$bpref = ($param['bill_prefecture'] == 'na') ? '' : $param['bill_prefecture'];
	$bad1 = $param['bill_address1'];
	$bad2 = $param['bill_address2'];
	$bpho = $param['bill_phone'];
	$cc_id = $param['cc_id'];
	$bill_id = $param['bill_id'];
	
	if (!$bill_id) {
		$action = 'insert';
	} else {
		$bool = checkBillingDuplicate($param);
		if ($bool) {
			$bill_id = $bool;
			$action = false;
		} else {
			$action = checkBillingAction($param);
		}
	}
	
	if ($action == 'update') {
		$q = "UPDATE users_billing_address SET bill_fullname = '$bf', bill_postal = '$bpost', bill_prefecture = '$bpref', bill_address1 = '$bad1', bill_address2 = '$bad2', bill_phone = '$bpho' WHERE bill_id = '$bill_id'";
		mysql_query($q);
	} elseif ($action == 'insert') {
		$q = "INSERT INTO users_billing_address ";
		$q .= "(user_id, bill_fullname, bill_postal, bill_prefecture, bill_address1, bill_address2, bill_phone) VALUES ";
		$q .= "('$user_id', '$bf', '$bpost', '$bpref', '$bad1', '$bad2', '$bpho')";
		mysql_query($q);
		$bill_id = mysql_insert_id();
	} else {
		// do nothing
	}
	
	$q = "UPDATE users_cc SET cc_holder_name = '$cc_holder_name', cc_exp_mo = '$cc_exp_mo', cc_exp_yr = '$cc_exp_yr', bill_id = '$bill_id' WHERE cc_id = '$cc_id'";
	mysql_query($q);
	return true;
}
/*
param:
Array
(
    [cc_type] => Visa
    [cc_number] => 1111111111111111
    [cc_holder_name] => Rudem Labial
    [cc_exp_mo] => 01
    [cc_exp_yr] => 2015
    [bill_fullname] => Mang Kepweng
    [bill_postal] => 1800
    [bill_prefecture] => 北海道
    [bill_address1] => address 1
    [bill_address2] => address 2
    [bill_phone] => 234567
)
*/
function addCreditInfo($param) {
	$user_id = $_SESSION['user_id'];
	$cc_type = $param['cc_type'];
	$cc_number = $param['cc_number'];
	$cc_holder_name = $param['cc_holder_name'];
	$cc_exp_mo = $param['cc_exp_mo'];
	$cc_exp_yr = $param['cc_exp_yr'];
	$bf = $param['bill_fullname'];
	$bpost = $param['bill_postal'];
	$bpref = ($param['bill_prefecture'] == 'na') ? '' : $param['bill_prefecture'];
	$bad1 = $param['bill_address1'];
	$bad2 = $param['bill_address2'];
	$bpho = $param['bill_phone'];
	
	$bill_id = checkBillingDuplicate($param);
	
	if (!$bill_id) {
		$q = "INSERT INTO users_billing_address ";
		$q .= "(user_id, bill_fullname, bill_postal, bill_prefecture, bill_address1, bill_address2, bill_phone) VALUES ";
		$q .= "('$user_id', '$bf', '$bpost', '$bpref', '$bad1', '$bad2', '$bpho')";
		mysql_query($q);
		$bill_id = mysql_insert_id();
	}
	
	$q = "INSERT INTO users_cc (cc_select, cc_type, cc_number, cc_holder_name, cc_exp_mo, cc_exp_yr, user_id, bill_id) VALUES ";
	$q .= "('cc', '$cc_type', '$cc_number', '$cc_holder_name', '$cc_exp_mo', '$cc_exp_yr', '$user_id', '$bill_id')";
	mysql_query($q);
	return true;
}

function deleteCreditCard($cc_id, $bill_id) {
	if (!checkBillingMultiple($bill_id)) {
		mysql_query("DELETE FROM users_billing_address WHERE bill_id = '$bill_id'");
	}
	
	mysql_query("DELETE FROM users_cc WHERE cc_id = '$cc_id'");
	return true;
}

function checkBillingMultiple($bill_id) {
	$q = "SELECT bill_id FROM users_cc WHERE bill_id = '$bill_id'";
		$result = mysql_query($q);
	
		$numrows = mysql_num_rows($result);
		if ($numrows > 1) {
			return true;
		} else {
			return false;
		}
}
/*
check if billing address is being used by other cc 
if used by other cc, then do not overwrite, create another one
*/
function checkBillingAction($param) {
	$data = array();
	
	$bf = $param['bill_fullname'];
	$bpost = $param['bill_postal'];
	$bpref = ($param['bill_prefecture'] == 'na') ? '' : $param['bill_prefecture'];
	$bad1 = $param['bill_address1'];
	$bad2 = $param['bill_address2'];
	$bpho = $param['bill_phone'];
	$bill_id = $param['bill_id'];
	
	$q = "SELECT * FROM users_cc WHERE bill_id = '$bill_id'";
	$result = mysql_query($q);

	$numrows = mysql_num_rows($result);

	if ($numrows > 1) {
		$q = "SELECT * FROM users_billing_address WHERE bill_id = '$bill_id' LIMIT 0, 1";
		$result = mysql_query($q);
	
		$numrows2 = mysql_num_rows($result);
	
		if ($numrows2) {
			while ($row = mysql_fetch_array($result)) {
				if ($bpos == $row['bill_postal'] 
					AND $bpref == $row['bill_prefecture'] 
					AND $bad1 == $row['bill_address1'] 
					AND $bad2 == $row['bill_address2'] 
					AND $bpho == $row['bill_phone'] 
					AND $bf == $row['bill_fullname']) {
						return false;	
					} else {
						return 'insert';
					}
			}
		}
	}
	
	return 'update';
}

function checkBillingDuplicate($param) {
	$user_id = $_SESSION['user_id'];
	$bf = $param['bill_fullname'];
	$bpost = $param['bill_postal'];
	$bpref = ($param['bill_prefecture'] == 'na') ? '' : $param['bill_prefecture'];
	$bad1 = $param['bill_address1'];
	$bad2 = $param['bill_address2'];
	$bpho = $param['bill_phone'];
	
	$q = "SELECT bill_id FROM users_billing_address WHERE ";
	$q .= "user_id = '$user_id' AND bill_fullname = '$bf' AND bill_postal = '$bpost' AND ";
	$q .= "bill_prefecture = '$bpref' AND bill_address1 = '$bad1' AND bill_address2 = '$bad2' AND bill_phone = '$bpho'";
	$result = mysql_query($q);

	$numrows = mysql_num_rows($result);
	if ($numrows) {
		while ($row = mysql_fetch_array($result)) {
			return $row['bill_id'];			
		}
	} else {
		return false;
	}
}
function createGraphData($from, $to, $coin_deals) {
	$graph = array();
	$mord = array();
	$mo = 60 * 60 * 24 * 30; // 1 month
	$diff = $to - $from;
	$i = 0;

	if ($diff > $mo) {
		// difference between from date and to date is more than 1 month.
		// Set up the graph in months format
		$curmoux = $from;
		$loop = true;
		while ($loop) {
			// get monthly data
			$curmo = date('Y-m', $curmoux) . '-1';
			$curmoux = strtotime($curmo);
			$nxmo = date('Y-m', strtotime("+1 month", $curmoux)) . '-1';
			$nxmoux = strtotime($nxmo);

			//$months[$i]['from'] = date('Y-m',$curmoux);
			//$months[$i]['to'] = date('Y-m',$nxmoux);
			$mord[$i]['from'] =$curmoux;
			$mord[$i]['to'] = $nxmoux;
			$curmoux = $nxmoux;
			if ($nxmoux > $to) {
				$loop = false;
			}
			$i++;
		}
	} else {
		// the date range is just days apart or less than a month
		// set up the graph in days format
		$curdayux = $from;
		$loop = true;
		while ($loop) {
			// get daily data
			$nxday = date('Y-m-d', strtotime("+1 day", $curdayux));
			$nxdayux = strtotime($nxday);

			$mord[$i]['from'] =$curdayux;
			$mord[$i]['to'] = $nxdayux;
			$curdayux = $nxdayux;
			if ($nxdayux > $to) {
				$loop = false;
			}
			$i++;
		}
	}

	$i = 0; // re-initialize
	$starting_date = $from;
	$starting_balance = 0;
	$new_starting_balance = 0;
	foreach ($mord as $mo) {
		$curmo = $mo['from'];
		$endmo = $mo['to'];
		//{ month: '2014-5-25', value: 20 }
		$graph[$i]['month'] = date('Y-m-d', $curmo);
		$graph[$i]['value'] = $new_starting_balance;
		foreach ($coin_deals as $cd) {
			$tx_date = $cd['cd_tx_date'];
			$inout = $cd['cd_inout'];
			$coins = $cd['cd_amount'];
			if ($curmo <= $tx_date AND $endmo > $tx_date) {
				if ($inout == 'in') {
					$graph[$i]['value'] += $coins;
				}
				if ($inout == 'out') {
					$graph[$i]['value'] -= $coins;
				}
				 
			} 

			// any date that is less than the From date
			if ($tx_date < $starting_date) {
				// get the starting balance
				if ($inout == 'in') {
					$starting_balance += $coins;
				}
				if ($inout == 'out') {
					$starting_balance -= $coins;
				}
			}
		}

		// if $new_starting_balance = 0, this is the first loop
		if (!$new_starting_balance) {
			// add the $starting_balance from the first graph data
			$graph[$i]['value'] += $starting_balance;
		}

		// succeeding graph data will contain the $new_starting_balance
		$new_starting_balance = $graph[$i]['value'];
		$i++;
	}
	/*
	echo $starting_balance;
	echo '<pre>';
	print_r($graph);
	*/
	return $graph;
}
// get all user's transaction based on date range
// broken down into wins, losses, etc
function breakdownTransactions($user_id, $from, $to, $coin_deals) {
	global $config, $lang;
	// add 23 hours and 59 minutes
	$to = $to + (60 * 60 * 24) - 1;
	$data = array();
	$details = array();
	$user_bets = array();
	$all_games = array();
	$starting_balance = 0;
	$prev_balance = 0;
	$no_increment = false;
	$i = 0;
	$coin_packages = getCoinPackages();

	$bets = getAllUserBets($user_id);
	// assign cd_id to the key
	foreach ($bets as $b) {
		$user_bets[$b['cd_id']] = $b;
	}



	$file = $config['basedir'] . '/temp/all_games.txt';
	$games = json_decode(file_get_contents($file), true);
	foreach ($games as $g) {
		$all_games[$g['g_id']] = $g;
	}

	if ($coin_deals) {
		$data = array(
			'startbalance' => 0,
			'won' => 0,
			'lose' => 0,
			'pending' => 0,
			'purchases' => 0,
			'withdrawal' => 0,
			'balance' => 0
		);
		foreach($coin_deals as $cd) {
			$no_increment = false;
			$tx_date = $cd['cd_tx_date'];
			$inout = $cd['cd_inout'];
			$coins = $cd['cd_amount'];
			$cd_id = $cd['cd_id'];
			$cd_type = $cd['cd_type'];
			if (isset($user_bets[$cd_id])) {
				$bet = $user_bets[$cd_id];
				$game = $all_games[$bet['g_id']];
				$game_title = $game['g_title'];
				if (strlen($game_title) > 30) {
					$game_title = substr($game_title, 0, 30) . '...';
				}
				$is_closed = $game['g_isClosed'];
			} else {
				$game = (isset($all_games[$cd['g_id']])) ? $all_games[$cd['g_id']] : array();
				if ($game) {
					$game_title = $game['g_title'];
					if (strlen($game_title) > 30) {
						$game_title = substr($game_title, 0, 30) . '...';
					}
					$is_closed = $game['g_isClosed'];
				} else {
					$game_title = '';
					$is_closed = 0;
				}
			}

			if ($tx_date >= $from AND $tx_date <= $to) {
				$details[$i]['date'] = date('Y/m/d', $tx_date);
				$details[$i]['balance'] = $prev_balance;
				if ($cd_type == 'bet') {
					if ($is_closed) {
						if ($bet['ub_iswinner'] == 0) {
							$data['lose'] += $coins; 
							$details[$i]['description1'] = $lang[373]; // lost game
							$details[$i]['description2'] = $lang[82] . ': ' . $game['g_id'] . ' ' . $game_title;
							$details[$i]['in'] = '';
							$details[$i]['out'] = $coins;
							$prev_balance -=  $coins;
						} else {
							$no_increment = true;
						}				
					} else {
						$data['pending'] += $coins;
						$details[$i]['description1'] = $lang[374]; // betted game
						$details[$i]['description2'] = $lang[82] . ': ' . $game['g_id'] . ' ' . $game_title;
						$details[$i]['in'] = '';
						$details[$i]['out'] = $coins;
						$prev_balance -=  $coins;
					}
					$data['balance'] -= $coins;
				} elseif ($cd_type == 'bet return') {
					//$data['lose'] -= $coins;
					$data['balance'] += $coins;
					$no_increment = true;
				} elseif ($cd_type == 'bet winning') {
					$data['won'] += $coins;
					$data['balance'] += $coins;

					$details[$i]['description1'] = $lang[372]; // won game
					$details[$i]['description2'] = $lang[82] . ': ' . $game['g_id'] . ' ' . $game_title;
					$details[$i]['in'] = $coins;
					$details[$i]['out'] = '';
					$prev_balance +=  $coins;
				} elseif ($cd_type == 'transfer') {
					if ($inout == 'in') {
						$data['purchases'] += $coins;
						$data['balance'] += $coins;

						$details[$i]['description1'] = $lang[376]; // purchase coin
						$details[$i]['description2'] = number_format($coin_packages[$coins]['cpcoin']) . ' COIN / ' . number_format($coin_packages[$coins]['cpamount']) . ' ' . $config['currency'];
						$details[$i]['in'] = $coins;
						$details[$i]['out'] = '';
						$prev_balance +=  $coins;
					}
					if ($inout == 'out') {
						$data['withdrawal'] += $coins;
						$data['balance'] -= $coins;

						$details[$i]['description1'] = $lang[376]; // withdraw coin
						$details[$i]['description2'] = '';
						$details[$i]['in'] = '';
						$details[$i]['out'] = $coins;
						$prev_balance -=  $coins;
					} 
				} else {
					// do nothing
					$no_increment = true;
				}
			} else {
				$no_increment = true;
			}
			if ($tx_date < $from) {
				if ($inout == 'in') {
					$starting_balance += $coins;
				}
				if ($inout == 'out') {
					$starting_balance -= $coins;
				}
			}
			if ($no_increment == false) {
				$details[$i]['balance'] = $prev_balance;
				$i++;	
			} else {
				unset($details[$i]);
			}
		} // foreach
		$data['startbalance'] = $starting_balance;
		$data['balance'] += $starting_balance;
	} // if $coin_deals
	return array('transactions' => $data, 'details' => $details);
}
// get the win and lose ratio between specified date
function winLoseRatio($user_id, $from, $to, $coin_deals) {
	global $config, $lang;
	// add 23 hours and 59 minutes
	$to = $to + (60 * 60 * 24) - 1;
	$data = array();
	$user_bets = array();
	$all_games = array();
	$coin_packages = getCoinPackages();

	$bets = getAllUserBets($user_id);
	// assign cd_id to the key
	foreach ($bets as $b) {
		$user_bets[$b['cd_id']] = $b;
	}



	$file = $config['basedir'] . '/temp/all_games.txt';
	$games = json_decode(file_get_contents($file), true);
	foreach ($games as $g) {
		$all_games[$g['g_id']] = $g;
	}

	if ($coin_deals) {
		//{label: "Win Game", value: 0},
		$data = array(
			'won' => 0,
			'wonpie' => 0,
			'lose' => 0,
			'losepie' => 0,
			'cancelled' => 0,
			'cancelpie' => 0,
			'total' => 0
		);
		foreach($coin_deals as $cd) {
			$tx_date = $cd['cd_tx_date'];
			$coins = $cd['cd_amount'];
			$cd_id = $cd['cd_id'];
			$cd_type = $cd['cd_type'];
			if (isset($user_bets[$cd_id])) {
				$bet = $user_bets[$cd_id];
				$game = $all_games[$bet['g_id']];
				$is_closed = $game['g_isClosed'];
			} else {
				$game = (isset($all_games[$cd['g_id']])) ? $all_games[$cd['g_id']] : array();
				if ($game) {
					$is_closed = $game['g_isClosed'];
					$is_cancelled = $game['g_isCancelled'];
				} else {
					$is_closed = 0;
					$is_cancelled = 0;
				}
			}

			if ($tx_date >= $from AND $tx_date <= $to) {
				if ($cd_type == 'bet') {
					if ($is_closed) {
						if ($bet['ub_iswinner'] == 0) {
							$data['lose'] += $coins; 
							$data['total'] += $coins; 
						}				
					} elseif ($is_cancelled) {
						$data['cancelled'] += $coins; 
						$data['total'] += $coins; 
					}
				} elseif ($cd_type == 'bet winning') {
					$data['won'] += $coins;
					$data['total'] += $coins; 

				}
			} 
		} // foreach
	} // if $coin_deals

	if ($data['total']) {
		$data['wonpie'] = ($data['won']) ? number_format(($data['won'] / $data['total']) * 100) : 0;
		$data['losepie'] = ($data['lose']) ? number_format(($data['lose'] / $data['total']) * 100) : 0;
		$data['cancelpie'] = ($data['cancelled']) ? number_format(($data['cancelled'] / $data['total']) * 100) : 0;
	} else {
		$data['wonpie'] = 0;
		$data['losepie'] = 0;
		$data['cancelpie'] = 0;
	}

	//{label: "Win Game", value: 0},
	$ret = array();
	$i = 0;
	if ($data['wonpie']) {
		$ret[$i]['label'] = $lang[411]; // Win Game
		$ret[$i]['value'] = $data['wonpie'];
		$i++;
	}
	if ($data['losepie']) {
		$ret[$i]['label'] = $lang[412]; // Lose Game
		$ret[$i]['value'] = $data['losepie'];
		$i++;
	}
	if ($data['cancelpie']) {
		$ret[$i]['label'] = $lang[62]; // cancelled
		$ret[$i]['value'] = $data['cancelpie'];
	}

	return array('data' => $data, 'pie' => $ret);
}
// get the From and To date ranges based from all user's coin_deals
function getAllRange($coin_deals) {
	$data = array();
	if (is_array($coin_deals)) {
		$last = count($coin_deals) - 1;
		$data['from'] = $coin_deals[0]['cd_tx_date'];
		$data['to'] = $coin_deals[$last]['cd_tx_date'];
	}
	return $data;
}
function getAllUserBets($user_id) {
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
function getCoinPackages() {
	$data = array();
	$q = "SELECT * FROM coinpackage";
	$result = mysql_query($q);

	$numrows = mysql_num_rows($result);

	if ($numrows) {
		while ($row = mysql_fetch_array($result)) {
			$data[$row['cpcoin']] = $row;
		}
	}

	return $data;
}
function getAllBetsByUserId($user_id, $limit = false) {
	if ($limit) {
		$limit = "LIMIT 0, $limit";
	} else {
		$limit = '';
	}
	$q = "SELECT * FROM user_bets WHERE user_id = '$user_id' ORDER BY ub_id DESC $limit";
	$result = mysql_query($q);
	$numrows = mysql_num_rows($result);

	if ($numrows) {
		while ($row = mysql_fetch_array($result)) {
			$data[] = $row;
		}
	}
	return $data;
}
function getPaymentInfo($user_id = 0, $cc_id = 0) {
	$data = array();
	if ($user_id) {
		$q = "SELECT * FROM users_cc WHERE user_id = '$user_id'";
		$result = mysql_query($q);
		$numrows = mysql_num_rows($result);
	
		if ($numrows) {
			$i = 0;
			while ($row = mysql_fetch_array($result)) {
				$bill_id = $row['bill_id'];
				$data[$i] = $row;
				$data[$i]['ba'] = getBillAddress($bill_id);
				$i++;
			}
		}
	}
	if ($cc_id) {
		$q = "SELECT * FROM users_cc WHERE cc_id = '$cc_id' LIMIT 0, 1";
		$result = mysql_query($q);
		$numrows = mysql_num_rows($result);
	
		if ($numrows) {
			while ($row = mysql_fetch_array($result)) {
				$bill_id = $row['bill_id'];
				$data = $row;
				$data['ba'] = getBillAddress($bill_id);
			}
		}
	}
	return $data;
}
function getBillAddress($bill_id) {
	$data = array();
	$q = "SELECT * FROM users_billing_address WHERE bill_id = '$bill_id' LIMIT 0, 1";
	$result = mysql_query($q);
	$numrows = mysql_num_rows($result);

	if ($numrows) {
		while ($row = mysql_fetch_array($result)) {
			$data = $row;
		}
	}
	return $data;
}

function currentBettingAndResultsGame($user_id) {
	global $config;
	$data = array();
	$temp = array();

	$file = $config['basedir'] . '/temp/all_games.txt';
	if (file_exists($file)) {
		$temp = json_decode(file_get_contents($file), true);
	} else {
		$temp = getAllGames();
	}
	foreach ($temp as $t) {
		$all_games[$t['g_id']] = $t;
	}

	$all_bets = getAllBetsByUserId($user_id);
	$temp = array();
	foreach ($all_bets as $ab) {
		$g_id = $ab['g_id'];
		$game = $all_games[$g_id];
		$suffix = getSuffix($game);
		if (!isset($temp[$g_id])) {
			$temp[$g_id] = getBetItems($g_id);
			foreach($temp[$g_id] as $t) {
				$bet_items[$t['bi_id']] = $t; 
			}

			if ($game['g_isClosed'] AND !$game['g_isCancelled']) {
				$key = 'results';
			} else {
				$key = 'current';
			}
			$data[$key][$g_id]['won'] = false;
			$data[$key][$g_id]['earned'] = 0;
			$data[$key][$g_id]['game_id'] = $g_id;
			$data[$key][$g_id]['title'] = $game['g_title' . $suffix];
			$data[$key][$g_id]['image'] = $game['g_image'];
			$data[$key][$g_id]['from'] = $game['g_schedFrom'];
			$data[$key][$g_id]['to'] = $game['g_schedTo'];
			$data[$key][$g_id]['your_placed'] = 0;
			$data[$key][$g_id]['housecom'] = $game['g_houseCom'];
			$data[$key][$g_id]['total_placed'] = getGameTotalPlacedCoins($g_id);
		} 

		if ($ab['ub_iswinner']) {
			$data[$key][$g_id]['won'] = true;
			$data[$key][$g_id]['earned'] = checkUserWon($user_id, $g_id);
		}

		if (!isset($data[$key][$g_id]['your_items'][$ab['bi_id']]['placed_coins'])) {
			$data[$key][$g_id]['your_items'][$ab['bi_id']]['placed_coins'] = 0;
		}

		$data[$key][$g_id]['your_placed'] += $ab['ub_coins'];
		$data[$key][$g_id]['your_items'][$ab['bi_id']]['placed_coins'] += $ab['ub_coins'];
		$data[$key][$g_id]['your_items'][$ab['bi_id']]['name'] = $bet_items[$ab['bi_id']]['bi_description' . $suffix];
		$data[$key][$g_id]['your_items'][$ab['bi_id']]['winner'] = $ab['ub_iswinner'];
	}
	return $data;
}

function allMyGameItems($user_id, $filter, $cat, $sort) {
	global $config, $LANGUAGE;
	$data = array();
	$temp = array();

	$file = $config['basedir'] . '/temp/all_games.txt';
	if (file_exists($file)) {
		$temp = json_decode(file_get_contents($file), true);
	} else {
		$temp = getAllGames();
	}
	foreach ($temp as $t) {
		$all_games[$t['g_id']] = $t;
	}

	$all_bets = getAllBetsByUserId($user_id);
	$haswon = array();
	$temp = array();
	$bets_per_category = array();
	foreach ($all_bets as $ab) {
		if ($ab['ub_iswinner']) {
			$haswon[$ab['g_id']] = true;
		}
	}
	foreach ($all_bets as $ab) {
		$do_skip = false;
		$g_id = $ab['g_id'];
		$game = $all_games[$g_id];

		$suffix = getSuffix($game);

		// make sure category is equal to $cat
		$category = $game['g_categories'];

		$bets_per_category[$game['g_categories' . $suffix]] += 1;
		if ($category != $cat AND $cat != 'all') {
			continue;
		}

		switch ($filter) {
			case 'all':
				break;
			case 'won':
				if (!$ab['ub_iswinner'] AND !isset($haswon[$g_id])) {
					$do_skip = true;
				}
				break;
			case 'lose':
				if (isset($haswon[$g_id])) {
					$do_skip = true;
				} else {
					if (!$game['g_isClosed']) {
						$do_skip = true;
					}
				}
				break;
			case 'judgement':
				$now = time();
				$do_skip = true;
				if ($game['g_schedTo'] < $now AND !$game['g_isClosed'] AND !$game['g_isCancelled']) {
					$do_skip = false;
				}
				break;
			case 'cancelled':
				if (!$game['g_isCancelled']) {
					$do_skip = true;
				}
				break;
			default:
				$do_skip = true;
				break;
		}

		if ($do_skip) { continue; }

		if (!isset($temp[$g_id])) {
			$temp[$g_id] = getBetItems($g_id);
			foreach($temp[$g_id] as $t) {
				$bet_items[$t['bi_id']] = $t; 
			}

			if ($game['g_isClosed'] AND !$game['g_isCancelled']) {
				$key = 0;
			} else {
				$key = 'current';
			}

			$data[$g_id]['won'] = $key;
			$data[$g_id]['game_id'] = $g_id;
			$data[$g_id]['title'] = $game['g_title' . $suffix];
			$data[$g_id]['image'] = $game['g_image'];
			$data[$g_id]['from'] = $game['g_schedFrom'];
			$data[$g_id]['to'] = $game['g_schedTo'];
			$data[$g_id]['your_placed'] = 0;
			$data[$g_id]['housecom'] = $game['g_houseCom'];
			$data[$g_id]['total_placed'] = getGameTotalPlacedCoins($g_id);
		} 

		if ($ab['ub_iswinner']) {
			$data[$g_id]['won'] = 1;
		}

		if (!isset($data[$g_id]['your_items'][$ab['bi_id']]['placed_coins'])) {
			$data[$g_id]['your_items'][$ab['bi_id']]['placed_coins'] = 0;
		}

		$data[$g_id]['your_placed'] += $ab['ub_coins'];
		$data[$g_id]['your_items'][$ab['bi_id']]['placed_coins'] += $ab['ub_coins'];
		$data[$g_id]['your_items'][$ab['bi_id']]['name'] = $bet_items[$ab['bi_id']]['bi_description' . $suffix];
		$data[$g_id]['your_items'][$ab['bi_id']]['winner'] = $ab['ub_iswinner'];
	}

	if ($bets_per_category) {
		arsort($bets_per_category);
	}

	$data = sortMyBets($data, $sort);

	return array('data' => $data, 'bets_per_category' => $bets_per_category);
}
function sortMyBets($bets, $sort) {
	$temp1 = array();
	$temp2 = array();
	$temp3 = array();
	if ($sort == 'mostearned') {
		foreach ($bets as $b) {
			if ($b['won']) {
				foreach ($b['your_items'] as $key => $val) {
					if ($val['winner']) {
						$temp1[$b['game_id']] = $val['placed_coins'];
					}
				}
			} else {
				$temp3[$b['game_id']] = $b;
			}
		}
		arsort($temp1);
		foreach ($temp1 as $key => $val) {
			$temp2[$key] = $bets[$key];
		}

		$data = array_merge($temp2, $temp3);
	}
	if ($sort == 'mostbet') {
		foreach ($bets as $b) {
			foreach ($b['your_items'] as $key => $val) {
				$temp1[$b['game_id']] += $val['placed_coins'];
			}
		}
		arsort($temp1);
		foreach ($temp1 as $key => $val) {
			$temp2[$key] = $bets[$key];
		}

		$data = $temp2;
	}

	if ($sort == 'latest') {
		foreach ($bets as $b) {
			$temp1[$b['game_id']] = $b['game_id'];
		}
		arsort($temp1);
		foreach ($temp1 as $key => $val) {
			$temp2[$key] = $bets[$key];
		}

		$data = $temp2;
	}

	if ($sort == 'oldest') {
		foreach ($bets as $b) {
			$temp1[$b['game_id']] = $b['game_id'];
		}
		asort($temp1);
		foreach ($temp1 as $key => $val) {
			$temp2[$key] = $bets[$key];
		}

		$data = $temp2;
	}

	return $data;
}
function paymentInfoExists($user_id) {
	$q = "SELECT cc_id FROM users_cc WHERE user_id = '$user_id' LIMIT 0, 1";
	$result = mysql_query($q);
	$numrows = mysql_num_rows($result);

	if ($numrows) {
		return true;
	}

	return false;
}
?>