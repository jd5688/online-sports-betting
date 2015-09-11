<?php
$baseurl='../../..';
$gamemenu='active';
?>
<?php if ($_GET['lang'] == en ) { ?>
	<?php
	$language='en';
	include ''.$baseurl.'/include/lang/en.php';
	?>
<?php }else{ ?>
	<?php
	$language='ja';
	include ''.$baseurl.'/include/lang/jp.php';
	?>
<?php } ?>


<!DOCTYPE html>
<html>
	<head>
		<?php include ''.$baseurl.'/include/header.php'; ?>
	</head>

	<body class="skin-blue">
	<!-- header logo: style can be found in header.less -->
	<header class="header">
		<?php include ''.$baseurl.'/include/header_menu.php'; ?>
	</header><!-- ./header -->
	
	<div class="wrapper row-offcanvas row-offcanvas-left">

		<!-- Left side column. -->
		<aside class="left-side sidebar-offcanvas">                

			<!-- sidebar: style can be found in sidebar.less -->
			<section class="sidebar">
				<?php include ''.$baseurl.'/include/sidebar.php'; ?>
			</section><!-- /.sidebar -->

		</aside><!-- /.left-side -->

		<!-- Right side column -->
		<aside class="right-side">

			<!-- Header Nav (breadcrumb) -->
			<section class="content-header">
				<h1><?php echo $lang[43] ?><small><?php echo $lang[44] ?></small></h1>
				<ol class="breadcrumb">
					<li><a href="<?php echo $baseurl ?>/"><i class="fa fa-dashboard"></i><?php echo $lang[27] ?></a></li>
					<li><a href="<?php echo $baseurl ?>/games"><?php echo $lang[18] ?></a></li>
					<li class="active"><?php echo $lang[43] ?></li>
				</ol>
			</section><!-- /.content-header -->

			<!-- Main content -->
			<section class="content">
				<?php include ''.$baseurl.'/include/gamesdetails_coming_body.php'; ?>
			</section><!-- /.content -->

		</aside><!-- /.right-side -->

	</div><!-- ./wrapper -->
	
	<?php include ''.$baseurl.'/include/javascript.php'; ?>
	
	</body>
</html>