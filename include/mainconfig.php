<?php
$config['baseurl'] = 'http://www.htmlfivegames.org/sportsbet';
$config['basedir'] = '/home/htmlfivegames/public_html/sportsbet';
//$config['baseurl'] = 'http://www.sportsbet.com';
//$config['basedir'] = '/www/sportsbet';
$config['private_key'] = 'babyaaric';
$config['public_key'] = rand(10000, 50000);
$config['noreply_email'] = 'noreply@sportsbet.com';

// connect to database
$DBhost="localhost";
$DBuser="htmlfive_sports";
$DBpass="smarttech";

//$DBuser="dbmanager";
//$DBpass="smarttech";
mysql_connect($DBhost,$DBuser,$DBpass);
mysql_select_db('htmlfive_sportsbet');
mysql_query("SET NAMES 'utf8'");
?>
