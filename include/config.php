<?php
$lifetime=60*60*24*30; // 30 days
ini_set('session.cookie_lifetime', $lifetime);
ini_set('session.gc_maxlifetime', $lifetime);
session_start();
//ini_set('display_errors', 1);
//error_reporting(~0);
error_reporting(0);

require_once('mainconfig.php');
$config['realtime_refreshrate'] = 10000; // in milliseconds
$config['sale_tax'] = 0; // percent
$config['user_area_recs_per_page'] = 10; // records per page at the user area
$config['list_area_recs_per_page'] = 9; // records per page at the list pages
$config['modal_users_recs_per_page'] = 1;
$config['currency_unit'] = 10; // conversion from coin to currency

$user_id = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 0;

// get more config
$q = "SELECT * FROM config";
$result = mysql_query($q);
$numrows = mysql_num_rows($result);

if ($numrows) {
	while ($row = mysql_fetch_array($result)) {
		$config[$row['cf_name']] = $row['cf_value'];
	}
}

date_default_timezone_set($config['time zone']);
$baseurl = $config['baseurl'];
$basedir = $config['basedir'];


if (isset($_GET['lang']) AND $_GET['lang'] != "") {
	$LANGUAGE = $_GET['lang'];
} elseif (isset($_SESSION['language']) AND $_SESSION['language'] != '') {
	$LANGUAGE = $_SESSION['language'];
} else {
	$LANGUAGE = $config['default language'];
}
$_SESSION['language'] = $LANGUAGE;
$suffix = ($LANGUAGE != 'en') ? '_' . $LANGUAGE : '';

// include the language file
include_once($config['basedir'] . '/include/lang/' . $LANGUAGE . '.php');

if (isset($config['maintenance_mode']) AND $config['maintenance_mode']) {
	// display maintenance page
}

// check if admin page
$cwd = getcwd();
// ex: /www/sportsbet/admin/settings
$x = explode("/", $cwd);
if ($x[3] == 'admin') {
	// redirect to authentication page
	// or include admin file
}
// check if admin page

$public_key = $config['public_key'];
$time = time();
$hash = md5($public_key . $config['private_key'] . $time);

$gamemenu = '';
$usermenu='';
$datatables='';
$homemenu = '';
$settingsmenu='';
$notificationsmenu='';
$profilemenu='';
$privacymenu='';
$balancemenu='';
$dashboardmenu='';
$joinedgamemenu='';
$walletmenu='';
$datatables='';
$withdrawalmenu = '';
?>
