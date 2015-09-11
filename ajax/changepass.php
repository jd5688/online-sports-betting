<?php
require_once("../include/config.php");
require_once($basedir . "/include/functions.php");
require_once($basedir . "/include/user_functions.php");

if (!$user_id) { exit; }

$private_key = $config['private_key'];

$hash = (isset($_POST['hash'])) ? $_POST['hash'] : 0;
$public_key = (isset($_POST['public'])) ? $_POST['public'] : 0;
$time = (isset($_POST['t'])) ? $_POST['t'] : 0;


$myhash = md5($public_key . $private_key . $time);

if ($hash != $myhash) {
	echo json_encode(array('error' => '1', 'status' => $lang[215]));
	exit;
}

$bool = false;
$op = (isset($_POST['op'])) ? $_POST['op'] : '';
$np1 = (isset($_POST['np1'])) ? $_POST['np1'] : '';
$np2 = (isset($_POST['np2'])) ? $_POST['np2'] : '';

// make sure these have value
if (!$op AND !$np1 AND !$np2) { exit; }

$bool = changepass($op, $np1, $np2, $user_id);
if ($bool == 'invalid old password') {
	echo json_encode(array('error' => '1', 'status' => 'invalid', 'message' => $lang[338]));
	exit;
} elseif ($bool == 'no match') {
	echo json_encode(array('error' => '1', 'status' => 'invalid', 'message' => $lang[339])); // new password did not match
	exit;
} else {
	$_SESSION['user_password'] = $bool;
	echo json_encode(array('error' => '0', 'status' => 'success', 'message' => $lang[337]));
	exit;
}
?>