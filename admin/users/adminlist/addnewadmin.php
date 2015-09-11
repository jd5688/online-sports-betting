<?php
require_once("../../../include/config.php");
require_once($basedir . "/admin/include/functions.php");
$private_key = $config['private_key'];

$hash = (isset($_POST['hash'])) ? $_POST['hash'] : 0;
$public_key = (isset($_POST['public'])) ? $_POST['public'] : 0;
$time = (isset($_POST['t'])) ? $_POST['t'] : 0;


$myhash = md5($public_key . $private_key . $time);

if ($hash != $myhash) {
	echo json_encode(array('error' => 1, 'status' => 'Hash is invalid'));
	exit;
}

/*
uri += '&sn=' + site_name + '&sd=' + site_desc + '&sk=' + site_keywords;
uri += '&sl=' + select_lang + '&tz=' = timezone + '&cu=' + currency;
uri += '&co=' + commission + '&rgr=' + recgameresult + '&rds=' + recdaisal + '&rud=' recuserdeposit;
*/
$data = array(
		'name' => $_POST['name'],
		'email' => $_POST['email'],
		'nick' => $_POST['nick'],
		'password1' => $_POST['p1'],
		'password2' => $_POST['p2']
	);

if ($data['password1'] != $data['password2']) {
	echo json_encode(array('error' => 'Password did not match'));
	exit;
}

$bool = addNewAdmin($data);

if ($bool) {
	echo json_encode(array('error' => '', 'status' => 'success'));
	exit;
} else {
	echo json_encode(array('error' => 1, 'status' => 'fail'));
	exit;
}

?>