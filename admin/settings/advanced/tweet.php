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

$tweet_live = (isset($_POST['tweetLive'])) ? $_POST['tweetLive'] : 0;
$tweet_ends = (isset($_POST['tweetEnds'])) ? $_POST['tweetEnds'] : 0;
$twitter_id = (isset($_POST['twitterId'])) ? $_POST['twitterId'] : 0;

$bool = setTwitter($twitter_id, $tweet_live, $tweet_ends);
if ($bool) {
	echo json_encode(array('error' => '', 'status' => $bool));
	exit;
} else {
	echo json_encode(array('error' => '1', 'status' => 'fail'));
	exit;
}

?>