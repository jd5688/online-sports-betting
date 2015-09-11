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

$dollarvalue = (isset($_POST['dollar'])) ? $_POST['dollar'] : 0;
$coinvalue = (isset($_POST['coin'])) ? $_POST['coin'] : 0;

if (!$coinvalue OR !$dollarvalue) { 
	echo json_encode(array('error' => 'Some fields are blank'));
	exit;
};

$bool = addPackage($coinvalue, $dollarvalue);
if ($bool) {
	echo json_encode(array('error' => '', 'status' => $bool));
	exit;
} else {
	echo json_encode(array('error' => '', 'status' => 'fail'));
	exit;
}

?>