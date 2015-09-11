<?php
require_once('include/config.php');
require_once($basedir . "/admin/include/functions.php");
//require_once($basedir . "/include/user_functions.php");
ini_set('display_errors', 1);
error_reporting(~0);

//$winners = getUserBetWinners(20, 291);
//$cache_file = $config['basedir'] . '/temp/all_users.txt';
//$all_users = json_decode(file_get_contents($cache_file), TRUE);

$time = time()
md5($public_key . $private_key . $time);
?>
