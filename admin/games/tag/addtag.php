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

$tag_name = (isset($_POST['tagName'])) ? trim($_POST['tagName']) : '';
$lang = (isset($_POST['lang'])) ? trim($_POST['lang']) : '';
$tag_desc = (isset($_POST['tagDesc'])) ? trim($_POST['tagDesc']) : '';

if ($tag_name) {
	$tag_name = trim($tag_name);
	$q = "SELECT * FROM sports_tags WHERE st_name = '$tag_name'";
	$result = mysql_query($q);
	$numrows = @mysql_num_rows($result);


	if ($numrows) {
		$q = "UPDATE sports_tags SET st_description = '$tag_desc', st_lang = '$lang' WHERE st_name = '$tag_name'";
		$result = mysql_query($q);
		echo json_encode(array('error' => '', 'status' => 'success'));
	} else {
		$q = "INSERT INTO sports_tags (st_name, st_lang, st_description) VALUES ('$tag_name', '$lang', '$tag_desc')";
		mysql_query($q);
		//return mysql_insert_id();
		echo json_encode(array('error' => '', 'status' => 'success'));
	}
}
?>