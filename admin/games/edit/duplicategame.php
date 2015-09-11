<?php
//ini_set('display_errors', 1);
//error_reporting(~0);
require_once("../../../include/config.php");
require_once($basedir . "/admin/include/functions.php");

$game_id = (isset($_GET['g_id'])) ? $_GET['g_id'] : false;

if (!$game_id) { exit; }

duplicateGame($game_id);
header('Location: '. $baseurl . '/admin/games?lang=' . $LANGUAGE);
?>