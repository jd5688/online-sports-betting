<?php
$config['baseurl'] = 'http://YOUR-DOMAIN.COM';
$config['basedir'] = '/path/to/public/html';

$config['private_key'] = 'your-private-key';
$config['public_key'] = rand(10000, 50000);
$config['noreply_email'] = 'noreply@sportsbet.com';

// connect to database
$DBhost="localhost";
$DBuser="localhost";
$DBpass="password";

//$DBuser="dbmanager";
//$DBpass="smarttech";
mysql_connect($DBhost,$DBuser,$DBpass);
mysql_select_db('database-name');
mysql_query("SET NAMES 'utf8'");
?>
