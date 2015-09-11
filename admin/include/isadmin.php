<?php
if ($user_id) {
	$USER = getUserFromCache($user_id);
} else {
	header('Location: '. $baseurl . '#login');
	exit;
}

if (!isset($USER)) {
	header('Location: '. $baseurl);
	exit;
}

$is_admin = $USER['user_isadmin'];
if (!$is_admin) {
	header('Location: '. $baseurl);
	exit;
}

$PROFILE_PIC = ($USER['user_pic']) ? $baseurl . '/images/user_pics/' . $USER['user_pic'] : $baseurl . "/images/avatar3.png";
$USERNAME = $USER['user_name'];
?>