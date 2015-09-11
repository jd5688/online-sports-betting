<a href="<?php echo $baseurl ?>/admin?lang=<?php echo $LANGUAGE ?>" class="logo">Sports9g Admin</a>

<!-- Header Navbar -->
<nav class="navbar navbar-static-top" role="navigation">

	<!-- Sidebar toggle button-->
	<a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
		<span class="sr-only">Toggle</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</a>

	<div class="navbar-right">
		<ul class="nav navbar-nav">

			<!-- User Account: style can be found in dropdown.less -->
			<li class="dropdown user user-menu">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<i class="glyphicon glyphicon-user"></i>
					<span><?php echo $USERNAME?> <i class="caret"></i></span>
				</a>
				<ul class="dropdown-menu">
					<!-- User image -->
					<li class="user-header">
						<img src="<?php echo $PROFILE_PIC; ?>" class="img-circle" alt="User Image" />
						<p><?php echo $USERNAME?> - Administrator<small><?php echo $lang[26] ?> : <?php echo date('M d H:i Y')?></small></p>
					</li>

					<!-- Menu Body -->
<!--
					<li class="user-body">
						<div class="col-xs-4 text-center"><a href="#">Followers</a></div>
						<div class="col-xs-4 text-center"><a href="#">Sales</a></div>
						<div class="col-xs-4 text-center"><a href="#">Friends</a></div>
					</li>
-->
					<!-- Menu Footer-->
					<li class="user-footer">
						<div class="pull-left">
						</div>
						<div class="pull-right">
							<a href="<?php echo $baseurl?>/logout.php" class="btn btn-danger btn-flat"><?php echo $lang[25] ?></a>
						</div>
					</li>
				</ul><!-- /.dropdown-menu -->
			</li><!-- /.dropdown -->

		</ul><!-- /.navbar-nav -->
	</div><!-- /.navbar-right -->

</nav>