<!-- Sidebar user panel -->
<div class="user-panel">
	<div class="pull-left image">
		<img src="<?php echo $PROFILE_PIC; ?>" class="img-circle" alt="User Image" />
	</div>
	<div class="pull-left info">
		<p><?php echo $lang[1] ?><?php echo $USERNAME?></p>
	</div>
</div>

<?php /*
<!-- search form -->
	<?php  include ''.$baseurl.'/include/sidebar_search.php'; ?>
<!-- /.search form -->
*/
?>

<!-- sidebar menu -->
<ul class="sidebar-menu">
	<!-- Dashboard -->
	<li>
		<a href="<?php echo $baseurl ?>/admin/?lang=<?php echo $LANGUAGE ?>">
			<i class="fa fa-dashboard"></i><span><?php echo $lang[2] ?></span>
		</a>
	</li>
	
	<!-- Game tables -->
	<li class="treeview <?php echo $gamemenu ?>">
		<a href="#">
			<i class="fa fa-list-alt"></i><span><?php echo $lang[18] ?></span>
			<i class="fa fa-angle-right pull-right"></i>
		</a>
		<ul class="treeview-menu">
			<li><a href="<?php echo $baseurl ?>/admin/games?lang=<?php echo $LANGUAGE ?>"><i class="fa fa-angle-double-right"></i><?php echo $lang[19] ?></a></li>
			<li><a href="<?php echo $baseurl ?>/admin/games/post?lang=<?php echo $LANGUAGE ?>"><i class="fa fa-angle-double-right"></i><?php echo $lang[20] ?></a></li>
			<li><a href="<?php echo $baseurl ?>/admin/games/category?lang=<?php echo $LANGUAGE ?>"><i class="fa fa-angle-double-right"></i><?php echo $lang[23] ?></a></li>
			<li><a href="<?php echo $baseurl ?>/admin/games/tag?lang=<?php echo $LANGUAGE ?>"><i class="fa fa-angle-double-right"></i><?php echo $lang[24] ?></a></li>
		</ul>
	</li>
	
	<!-- Game Schedules -->
<!--
	<li>
		<a href="<?php echo $baseurl ?>/calendar?lang=<?php echo $LANGUAGE ?>">
			<i class="fa fa-calendar"></i><span><?php echo $lang[21] ?></span>
		</a>
	</li>
-->
	
	<!-- Sales Management -->	
	<li class="treeview <?php echo $salesmenu ?>">
		<a href="#">
			<i class="fa fa-bar-chart-o"></i><span><?php echo $lang[4] ?></span>
			<i class="fa fa-angle-right pull-right"></i>
		</a>
		<ul class="treeview-menu">
			<li><a href="<?php echo $baseurl ?>/admin/sales?lang=<?php echo $LANGUAGE ?>"><i class="fa fa-angle-double-right"></i><?php echo $lang[5] ?></a></li>
		</ul>
	</li>

	<!-- Users -->	
	<li class="treeview <?php echo $usermenu ?>">
		<a href="#">
			<i class="fa fa-group"></i><span><?php echo $lang[14] ?></span>
			<i class="fa fa-angle-right pull-right"></i>
		</a>
		<ul class="treeview-menu">
			<li><a href="<?php echo $baseurl ?>/admin/users?lang=<?php echo $LANGUAGE ?>"><i class="fa fa-angle-double-right"></i><?php echo $lang[15] ?></a></li>
			<li><a href="<?php echo $baseurl ?>/admin/users/adminlist?lang=<?php echo $LANGUAGE ?>"><i class="fa fa-angle-double-right"></i><?php echo $lang[17] ?></a></li>                                

		</ul>
	</li>
	
	<!-- Settings -->	
	<li class="treeview <?php echo $settingsmenu ?>">
		<a href="#">
			<i class="fa fa-gear"></i><span><?php echo $lang[8] ?></span>
			<i class="fa fa-angle-right pull-right"></i>
		</a>
		<ul class="treeview-menu">
			<li><a href="<?php echo $baseurl ?>/admin/settings?lang=<?php echo $LANGUAGE ?>"><i class="fa fa-angle-double-right"></i><?php echo $lang[9] ?></a></li>
			<li><a href="<?php echo $baseurl ?>/admin/settings/advanced?lang=<?php echo $LANGUAGE ?>"><i class="fa fa-angle-double-right"></i><?php echo $lang[10] ?></a></li>

		</ul>
	</li>

	<!-- Marchant -->	
	<li class="treeview <?php echo $walletmenu ?>">
		<a href="#">
			<i class="fa fa-credit-card"></i><span><?php echo $lang[34] ?></span>
			<i class="fa fa-angle-right pull-right"></i>
		</a>
		<ul class="treeview-menu">
			<li><a href="<?php echo $baseurl ?>/admin/wallet?lang=<?php echo $LANGUAGE ?>"><i class="fa fa-angle-double-right"></i><?php echo $lang[6] ?></a></li>
			<li><a href="<?php echo $baseurl ?>/admin/wallet?lang=<?php echo $LANGUAGE ?>"><i class="fa fa-angle-double-right"></i><?php echo $lang[7] ?></a></li>
		</ul>
	</li>



	<!-- Notification -->	
<!--
	<li>
		<a href="#">
			<i class="fa fa-bullhorn"></i><span><?php echo $lang[22] ?></span>
			<small class="badge pull-right bg-yellow">12</small>
		</a>
	</li>
-->
</ul><!-- /.sidebar-menu -->
