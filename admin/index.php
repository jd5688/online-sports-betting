<?php
require_once('../include/config.php');
require_once($basedir . "/admin/include/functions.php");
include $basedir . '/admin/include/isadmin.php';
$games_file = $basedir . '/temp/all_games.txt';
$temp = array();
$all_games = array();
$sales_today = 0;
$total_house_commission = 0;
if (file_exists($games_file)) {
	$temp = json_decode(file_get_contents($games_file), true);
} else {
	$temp = getAllGames();
}

$filter = (isset($_GET['filter']) AND $_GET['filter']) ? $_GET['filter'] : 'all';

$today = time();
$day_start = date('Y-m-d ') . '00:00:00';
$day_end = date('Y-m-d ') . "23:59:59";

foreach ($temp as $ag) {
	$sched_from = $ag['g_schedFrom'];
	$sched_to = $ag['g_schedTo'];
	if ((!$ag['g_isClosed'] AND !$ag['g_isCancelled'] AND !$ag['g_isDeleted']) // judgement and upcoming
		OR ($today >= $sched_from AND $today <= $sched_to) // live
		OR ($ag['g_isClosed'] AND $ag['g_lastUpdated'] >= $day_start AND $ag['g_lastUpdated'] <= $day_end) // closed today
		OR ($ag['g_isCancelled'] AND $ag['g_lastUpdated'] >= $day_start AND $ag['g_lastUpdated'] <= $day_end)) { // cancelled today
			$all_games[$ag['g_id']] = $ag;
			//$all_bets = getAllBets($ag['g_id']);
			//$info_per_bet_item = getInfoPerBetItem($all_bets);
			//$all_games[$ag['g_id']]['info_per_bet_item'] = $info_per_bet_item;
		}
}

$transactions_today = getTransactions(strtotime($day_start), strtotime($day_end));
// get today's sales
foreach ($transactions_today as $td) {
	$sales_today += $td['tr_amount'];
}

$user_registrations = getUserRegistrations($day_start, $day_end);
$total_registrations = count($user_registrations);

// get today's house commission
$house_commissions = getHouseCommissions(strtotime($day_start), strtotime($day_end));
foreach ($house_commissions as $hc) {
	$total_house_commission += $hc['cd_amount']; // coins 
}
$total_house_commission = ($total_house_commission) ? $total_house_commission / $config['currency_unit'] : 0;
?>
<!DOCTYPE html>
<html>
	<head>
		<?php include $basedir . '/admin/include/header.php'; ?>
	</head>
	<body class="skin-blue">
	<!-- header logo: style can be found in header.less -->
	<header class="header">
		<?php include $basedir . '/admin/include/header_menu.php'; ?>
	</header><!-- ./header -->
	
	<div class="wrapper row-offcanvas row-offcanvas-left">

		<!-- Left side column. -->
		<aside class="left-side sidebar-offcanvas">                

			<!-- sidebar: style can be found in sidebar.less -->
			<section class="sidebar">
				<?php include  $basedir . '/admin/include/sidebar.php'; ?>
			</section><!-- /.sidebar -->

		</aside><!-- /.left-side -->

		<!-- Right side column -->
		<aside class="right-side">

			<!-- Header Nav (breadcrumb) -->
			<section class="content-header">
				<?php include  $basedir . '/admin/navbar.php'; ?>
			</section><!-- /.content-header -->

			<!-- Main content -->
			<section class="content">
				<?php include  $basedir . '/admin/maincontent.php'; ?>
			</section><!-- /.content -->

		</aside><!-- /.right-side -->

	</div><!-- ./wrapper -->
	
	<?php include  $basedir . '/include/javascript.php'; ?>
	</body>
</html>