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

$title = (isset($_POST['title'])) ? trim($_POST['title']) : '';
$reserve_time = (isset($_POST['reservationTime'])) ? trim($_POST['reservationTime']) : '';

if ($title AND $reserve_time) {
	$x = explode("-", $reserve_time);
	// format 06/14/2014 12:00 AM converted to unix time
	$reserve_time1 = strtotime(trim($x[0]));
	$reserve_time2 = strtotime(trim($x[1]));

	$q = "SELECT g_id FROM games WHERE g_title = '$title' AND g_schedFrom = '$reserve_time1' AND g_schedTo = '$reserve_time2'";
	$result = mysql_query($q);
	$numrows = @mysql_num_rows($result);

	if ($numrows) {
		//Duplicate Record
		echo json_encode(array('error' => '1', 'status' => $lang[211]));
	} else {
		// success
		echo json_encode(array('error' => '', 'status' => $lang[212]));
	}
}
?>