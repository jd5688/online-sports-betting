<?php
require_once("include/config.php");
require_once($basedir . "/include/functions.php");
unset($_SESSION['user_id']);
unset($_SESSION['user_name']);
unset($_SESSION['user_email']);
unset($_SESSION['user_fullname']);
unset($_SESSION['user_coins']);
unset($_SESSION['user_password']);

header('Location: ' . $baseurl);
?>