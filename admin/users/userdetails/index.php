<?php
require_once("../../../include/config.php");
require_once($basedir . "/admin/include/functions.php");
include $basedir . '/admin/include/isadmin.php';
global $GAMES;


$cookiename = 'all_games.txt';
$cookiename = $basedir . '/temp/' . $cookiename; // this cache gets deleted when a new game is added
$create_new_cookie = false;

if (file_exists($cookiename)) {
	$xgames = json_decode(file_get_contents($cookiename), true);
	foreach ($xgames as $x) {
		$GAMES[$x['g_id']] = $x;
	}
}

$admins = getAdmins();
$now_betting = false;
$closed_bets = false;
$total_closed_bets = 0;
$usermenu='active';

$user_id = (isset($_GET['user_id'])) ? $_GET['user_id'] : '';
$activ = (isset($_GET['active'])) ? $_GET['active'] : 'bet';
if (!$user_id) {
	$redir = $baseurl . "/admin/users?lang={$LANGUAGE}";
	header('Location: ' . $redir);
	exit;
}
$user_likes = getUserLikes($user_id);
$user_bookmarks = getUserBookmarks($user_id);
$user_bets = getUserBetsByUserId($user_id);
$user_coin_deals = getUserCoinDeals($user_id);
$user_info = getUserInfo($user_id);
if ($user_bets) {
	$now_betting = getUserNowBetting($user_bets);
	$closed_bets = getUserClosedBetting($user_bets);
	$total_closed_bets = count($closed_bets['win']) + count($closed_bets['lose']);
}
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
				<?php include $basedir . '/admin/include/sidebar.php'; ?>
			</section><!-- /.sidebar -->

		</aside><!-- /.left-side -->

		<!-- Right side column -->
		<aside class="right-side">

			<!-- Header Nav (breadcrumb) -->
			<section class="content-header">
				<h1><?php echo $lang[32] ?><small><?php echo $lang[33] ?></small></h1>
				<ol class="breadcrumb">
					<li><a href="<?php echo $baseurl ?>/"><i class="fa fa-dashboard"></i><?php echo $lang[27] ?></a></li>
					<li><a href="<?php echo $baseurl ?>/users"><?php echo $lang[14] ?></a></li>
					<li class="active"><?php echo $lang[32] ?></li>
				</ol>
			</section><!-- /.content-header -->

			<!-- Main content -->
			<section class="content">
				<?php include $basedir . '/admin/users/userdetails/userdetailsbody.php'; ?>
			</section><!-- /.content -->

		</aside><!-- /.right-side -->

	</div><!-- ./wrapper -->
	
	<?php include $basedir . '/include/javascript.php'; ?>
	
	</body>
</html>
<script>
$(document).ready(function() {
	var activ = "<?php echo $activ; ?>";
	console.log(activ);
	if (activ === 'bet') {
		$('#href-bet').click();
	} else {
		$('#href-coin').click();
	}
	$('#all-closed-bets-button').click(function() {
		$('#all-closed-bets-button').addClass("active");
		$('#all-win-bets-button').removeClass("active");
		$('#all-lose-bets-button').removeClass("active");

		$('#all-closed-bets').show();
		$('#all-win-bets').hide();
		$('#all-lose-bets').hide();
	})

	$('#all-win-bets-button').click(function() {
		$('#all-closed-bets-button').removeClass("active");
		$('#all-win-bets-button').addClass("active");
		$('#all-lose-bets-button').removeClass("active");

		$('#all-closed-bets').hide();
		$('#all-win-bets').show();
		$('#all-lose-bets').hide();
	})

	$('#all-lose-bets-button').click(function() {
		$('#all-closed-bets-button').removeClass("active");
		$('#all-win-bets-button').removeClass("active");
		$('#all-lose-bets-button').addClass("active");

		$('#all-closed-bets').hide();
		$('#all-win-bets').hide();
		$('#all-lose-bets').show();
	})
})
</script>