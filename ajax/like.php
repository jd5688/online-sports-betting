<?php
require_once("../include/config.php");
require_once($basedir . "/include/functions.php");

$private_key = $config['private_key'];

$hash = (isset($_POST['hash'])) ? $_POST['hash'] : 0;
$public_key = (isset($_POST['public'])) ? $_POST['public'] : 0;
$time = (isset($_POST['t'])) ? $_POST['t'] : 0;


$myhash = md5($public_key . $private_key . $time);

if ($hash != $myhash) {
	echo json_encode(array('error' => '1', 'status' => $lang[215]));
	exit;
}
$g_id = (isset($_POST['gid'])) ? $_POST['gid'] : 0;
$u_id = (isset($_POST['uid'])) ? $_POST['uid'] : 0;

$bool = addLike($g_id, $u_id);
if ($bool) {
	echo json_encode(array('error' => '0', 'status' => $bool));
	exit;
}
?>