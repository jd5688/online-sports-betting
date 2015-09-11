<?php
require_once("../../../include/config.php");
require_once($basedir . "/admin/include/functions.php");
$private_key = $config['private_key'];

$hash = (isset($_POST['hash'])) ? $_POST['hash'] : 0;
$public_key = (isset($_POST['public'])) ? $_POST['public'] : 0;
$time = (isset($_POST['t'])) ? $_POST['t'] : 0;
$myhash = md5($public_key . $private_key . $time);
if ($hash != $myhash) {
	echo json_encode(array('error' => '1', 'status' => 'Hash is invalid'));
	exit;
}

$is_welcome = (isset($_POST['isWelcome'])) ? $_POST['isWelcome'] : 0;
$keyword = (isset($_POST['keyword'])) ? $_POST['keyword'] : 0;
$coins = (isset($_POST['coins'])) ? $_POST['coins'] : 0;

if (!$keyword OR !$coins) {
	echo json_encode(array('error' => '1', 'status' => 'blank field'));
	exit;

}

$bool = addCouponCode($keyword, $coins, $is_welcome);
if ($bool) {
	echo json_encode(array('error' => '', 'status' => $bool));
	exit;
} else {
	echo json_encode(array('error' => '1', 'status' => 'fail'));
	exit;
}

?>