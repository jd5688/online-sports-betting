<?php
require_once("../../../include/config.php");

$private_key = $config['private_key'];

$hash = (isset($_POST['hash'])) ? $_POST['hash'] : 0;
$public_key = (isset($_POST['public'])) ? $_POST['public'] : 0;
$time = (isset($_POST['t'])) ? $_POST['t'] : 0;


$myhash = md5($public_key . $private_key . $time);

if ($hash != $myhash) {
	echo json_encode(array('error' => 1, 'status' => 'Hash is invalid'));
	exit;
}

$cat_name = (isset($_POST['catName'])) ? trim($_POST['catName']) : '';
$cat_name_jp = (isset($_POST['catName_jp'])) ? trim($_POST['catName_jp']) : '';
$cat_desc = (isset($_POST['catDesc'])) ? trim($_POST['catDesc']) : '';

if ($cat_name) {
	$cat_name = trim(ucfirst($cat_name));
	$cat_name_jp = trim($cat_name_jp);
	$q = "SELECT * FROM sports_category WHERE sc_name = '$cat_name'";
	$result = mysql_query($q);
	$numrows = @mysql_num_rows($result);


	if ($numrows) {
		$q = "UPDATE sports_category SET sc_name_jp = '$cat_name_jp', sc_description = '$cat_desc' WHERE sc_name = '$cat_name'";
		$result = mysql_query($q);
		echo json_encode(array('error' => '', 'status' => 'success'));
	} else {
		$q = "INSERT INTO sports_category (sc_name, sc_name_jp, sc_description) VALUES ('$cat_name', '$cat_name_jp', '$cat_desc')";
		mysql_query($q);
		//return mysql_insert_id();
		echo json_encode(array('error' => '', 'status' => 'success'));
	}
}
?>