<?php
require_once("../../../include/config.php");
require_once($basedir . "/admin/include/functions.php");
include $basedir . '/admin/include/isadmin.php';

$cats = getCategories();
$cats = getGames($cats, 'categories'); // get how many games are active for this category
$gamemenu='active';
$datatables='active';
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
				<h1><?php echo $lang[23] ?><small><?php echo $lang[39] ?></small></h1>
				<ol class="breadcrumb">
					<li><a href="<?php echo $baseurl ?>/"><i class="fa fa-dashboard"></i><?php echo $lang[27] ?></a></li>
					<li><a href="<?php echo $baseurl ?>/games"><?php echo $lang[18] ?></a></li>
					<li class="active"><?php echo $lang[23] ?></li>
				</ol>
			</section><!-- /.content-header -->

			<!-- Main content -->
			<section class="content">
				<?php include $basedir . '/admin/games/category/gamescategorybody.php'; ?>
			</section><!-- /.content -->

		</aside><!-- /.right-side -->

	</div><!-- ./wrapper -->
	
	<?php include $basedir . '/include/javascript.php'; ?>
	
	</body>
</html>