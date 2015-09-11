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

$m_on = (isset($_POST['m_on'])) ? $_POST['m_on'] : 0;
$m_off = (isset($_POST['m_off'])) ? $_POST['m_off'] : 0;

$bool = setMaintenance($m_on, $m_off);
if ($bool) {
	echo json_encode(array('error' => '', 'status' => $bool));
	exit;
} else {
	echo json_encode(array('error' => '', 'status' => 'fail'));
	exit;
}

?>