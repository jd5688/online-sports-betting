<?php
// ADD
/*
  add a credit card info
  $param:
  Array
	(
	    [cc_type] => Visa
	    [cc_number] => 4054600011209560
	    [cc_cvc] => 123
	    [cc_holder_name] => Rudem Labial
	    [cc_exp_mo] => 01
	    [cc_exp_yr] => 2016
	    [billadd_radio] => billadd_new
	    [bill_fullname] => Rudem Labial
	    [bill_postal] => 1800
	    [bill_prefecture] => é’æ£®çœŒ
	    [bill_address1] => B4, L9, UBB Marikina City
	    [bill_address2] => Philippines
	    [bill_phone] => 12345678
	    [checked_package] => 8
	)
*/
function addCreditCardAndBilling($param, $uid) {
	if ($param['billadd_radio'] == 'billadd_new') {
		$bill_id = addBillingAddress($param, $uid);
	} else {
		$bill_id = $param['billadd_radio'];
	}
	$ty = $param['cc_type'];
	$nu = $param['cc_number'];
	//$cv = $param['cc_cvc'];
	$hn = $param['cc_holder_name'];
	$em = $param['cc_exp_mo'];
	$ey = $param['cc_exp_yr'];
	$package = $param['checked_package'];

	$q = "INSERT INTO users_cc (cc_select, cc_type, cc_number, cc_holder_name, cc_exp_mo, cc_exp_yr, user_id, bill_id) VALUES ('cc','$ty','$nu','$hn','$em','$ey','$uid',$bill_id)";
	mysql_query($q);
	return $package;
}
/*
  add a billing address
  $param:
  Array
	(
	    [bill_fullname] => Rudem Labial
	    [bill_postal] => 1800
	    [bill_prefecture] => é’æ£®çœŒ
	    [bill_address1] => B4, L9, UBB Marikina City
	    [bill_address2] => Philippines
	    [bill_phone] => 12345678
	)
*/
function addBillingAddress($param, $uid) {
	$bf = $param['bill_fullname'];
	$bp = $param['bill_postal'];
	$bpr = $param['bill_prefecture'];
	$ba1 = $param['bill_address1'];
	$ba2 = $param['bill_address2'];
	$bph = $param['bill_phone'];
	$q = "INSERT INTO users_billing_address (user_id, bill_fullname, bill_postal, bill_prefecture, bill_address1, bill_address2, bill_phone) VALUES ('$uid','$bf','$bp','$bpr','$ba1','$ba2','$bph')";
	mysql_query($q);
	return mysql_insert_id(); 
}
// /ADD

// GET
function getCreditCards($user_id) {
	$data = array();
	$q = "SELECT * FROM users_cc WHERE user_id = '$user_id'";
	$result = mysql_query($q);

	$numrows = mysql_num_rows($result);

	if ($numrows) {
		while ($row = mysql_fetch_array($result)) {
			$data[] = $row;
		}
	}

	return $data;
}
function getBillAddresses($user_id) {
	$data = array();
	$q = "SELECT * FROM users_billing_address WHERE user_id = '$user_id'";
	$result = mysql_query($q);

	$numrows = mysql_num_rows($result);

	if ($numrows) {
		while ($row = mysql_fetch_array($result)) {
			$data[$row['bill_id']] = $row;
		}
	}

	return $data;
}
function getCoinPackages() {
	$data = array();
	$q = "SELECT * FROM coinpackage WHERE cpenabled = 1 ORDER BY cpid DESC";
	$result = mysql_query($q);

	$numrows = mysql_num_rows($result);

	if ($numrows) {
		while ($row = mysql_fetch_array($result)) {
			$data[$row['cpid']] = $row;
		}
	}

	return $data;
}
function getCoinPackage($cpid) {
	$data = array();
	$q = "SELECT * FROM coinpackage WHERE cpid = '$cpid' AND cpenabled = 1 LIMIT 0, 1";
	$result = mysql_query($q);

	$numrows = mysql_num_rows($result);

	if ($numrows) {
		while ($row = mysql_fetch_array($result)) {
			$data = $row;
		}
	}

	return $data;
}
function getCreditCard($cc_id) {
	$data = array();
	$q = "SELECT * FROM users_cc WHERE cc_id = '$cc_id' LIMIT 0, 1";
	$result = mysql_query($q);

	$numrows = mysql_num_rows($result);

	if ($numrows) {
		while ($row = mysql_fetch_array($result)) {
			$data = $row;
		}
	}

	return $data;
}
function getBillAddress($bill_id) {
	$data = array();
	$q = "SELECT * FROM users_billing_address WHERE bill_id = '$bill_id'";
	$result = mysql_query($q);

	$numrows = mysql_num_rows($result);

	if ($numrows) {
		while ($row = mysql_fetch_array($result)) {
			$data = $row;
		}
	}

	return $data;
}
// /GET

// PAY
function _payByCc() {
	// contact payment gateway
	$tx_id = 'CC' . time(); // temporary transaction id
	return $tx_id;
}
function _payByNeteller() {
	// contact neteller
	$tx_id = 'NT' . time(); // temporary transaction id
	return $tx_id;
}
// /PAY

// OTHER
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
function buyCoin($user_id, $cc_id, $bill_id, $cpid, $tx_method, $order_total, $coins, $cc_id) {
	$data = array();
	$bool = false;
	if ($tx_method == 'cc') {
		$tx_id = _payByCc();
	} else {
		// neteller
		$tx_id = _payByNeteller();
	}

	if ($tx_id != 'error') {
		$now = time();
		$q = "INSERT INTO transactions ";
		$q .= "(tr_tx_id, tr_method, user_id, tr_cc_nt_id, bill_id, cpid, tr_gw_tx_id, tr_amount, tr_coins, tr_date, tr_status) ";
		$q .= "VALUES";
		$q .= "('$tx_id', '$tx_method', '$user_id', '$cc_id', '$bill_id', '$cpid', '', '$order_total', '$coins', '$now', 1)";
		mysql_query($q);

		increaseUserCoins($user_id, $coins);
		insertUserCoins($user_id, $coins, $tx_id);

		$data['status'] = 'success';
		$data['message'] = '';
		$data['tx_id'] = $tx_id;
		$data['tx_date'] = $now;
	} else {
		$data['status'] = 'error';
		$data['message'] = 'error message here';
		$data['tx_id'] = false;
		$data['tx_date'] = false;
	}
	return $data;
}

function insertUserCoins($user_id, $coins, $tx_id) {
	global $config;
	$basedir = $config['basedir'];
	$coindeal = array();
	$now = time();
	$q = "INSERT INTO coin_deals (user_id, cd_amount, cd_inout, tx_id, cd_type, cd_tx_date) VALUES ('$user_id', '$coins', 'in', '$tx_id', 'transfer', '$now')";
	mysql_query($q);

	// append all_coin_deals.txt cache
    $coindeal['cd_id'] = mysql_insert_id();
    $coindeal['user_id'] = $user_id;
    $coindeal['g_id'] = 0;
    $coindeal['cd_amount'] = $coins;
    $coindeal['cd_inout'] = 'in';
    $coindeal['tx_id'] = $tx_id;
    $coindeal['cd_type'] = 'transfer';
    $coindeal['cd_tx_date'] = $now;

	$file = $basedir . '/temp/all_coin_deals.txt';
	if (file_exists($file)) {
		$data = json_decode(file_get_contents($file), true);
		$data[] = $coindeal;
		unlink($file);
		file_put_contents($file, json_encode($data));
	}

	return true;
}
// /OTHER
?>