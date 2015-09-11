<?php
require_once("../include/config.php");
require_once($basedir . "/admin/include/functions.php");
$private_key = $config['private_key'];

$hash = (isset($_POST['hash'])) ? $_POST['hash'] : 0;
$public_key = (isset($_POST['public'])) ? $_POST['public'] : 0;

$myhash = md5($public_key . $private_key);

if ($hash != $myhash) {
	echo json_encode(array('error' => 'Hash is invalid'));
	exit;
}

/*
uri += '&sn=' + site_name + '&sd=' + site_desc + '&sk=' + site_keywords;
uri += '&sl=' + select_lang + '&tz=' = timezone + '&cu=' + currency;
uri += '&co=' + commission + '&rgr=' + recgameresult + '&rds=' + recdaisal + '&rud=' recuserdeposit;
*/
$data = array(
		'site name' => $_POST['sn'],
		'site description' => $_POST['sd'],
		'site meta keywords' => $_POST['sk'],
		'default language' => $_POST['sl'],
		'time zone' => $_POST['tz'],
		'currency' => $_POST['cu'],
		'default house commission' => $_POST['co'],
		'mail receive game result' => $_POST['rgr'],
		'mail receive daily sales' => $_POST['rds'],
		'mail receive when user deposited money' => $_POST['rud'],
	);

$bool = saveGeneralSettings($data);

if ($bool) {
	echo json_encode(array('error' => '', 'status' => 'success'));
	exit;
} else {
	echo json_encode(array('error' => '', 'status' => 'fail'));
	exit;
}

?>