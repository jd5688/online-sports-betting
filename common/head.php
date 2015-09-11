<?php
$activities = false;
$unseen = 0;
if ($user_id) {
	$user = (isset($user)) ? $user : getUserFromCache($user_id);
	$activities_array = getActivities($user_id);
	if ($activities_array) {
		$activities = $activities_array['ret'];
		$unseen = $activities_array['unseen'];
	}
}
$notifications = str_replace('$VAR', $unseen, $lang['433']);
?>
<header role="banner" class="row">
	<div class="container row">

		<div class="col span_12">

			<div class="site-title-group">
				<h1 class="site-title"><a href="<?php echo $baseurl?>" title="<?php echo $config['site name']?>" rel="home"><?php echo $config['site name']?></a></h1>
			</div><!-- .site-title-group -->

			<div class="loginmenu">
			<?php
			if (!$user_id) {
			?>

				<div class="inner">
					<a class="btn login" href="#login"><?php echo $lang[340]; //Sign In?></a>
					<a class="btn signup" href="#signup"><?php echo ucfirst($lang[268]); //Sign Up?></a>
				</div>

			<?php } else { ?>

				<!-- Logged MENU  -->
				<div class="inner logged">

                    <ul id="usrmenu" class="nav navbar-nav">

                        <!-- Buy Coin -->
                        <li class="">
                        	<a class="btn buycoin" href="<?php echo $baseurl?>/buycoin.php"><?php echo $lang[341]; //buy coin?></a>
                        </li>

                        <li class="dropdown notifications-menu">
                            <a href="" class="dropdown-toggle" onclick="return false;">
                                <span id="user-activities" class="icon notification"></span>
                                <?php if ($unseen) { ?>
                                	<span id="unseen" class="label"><?php echo $unseen; ?></span>
                                <?php } ?>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header"><?php echo $notifications?></li>
                                <?php
                                // javascript is in footer
	                            if ($activities) {
	                            	$i = 0;
                                ?>
                                <li>
                                    <!-- inner scroll menu -->
                                    <ul class="menu">
                                    <?php
	                                foreach ($activities as $act) {
	                                	if ($i == 5) { break; }
	                                	$i++;
                                    ?>
                                        <li>
                                            <a href="<?php echo $act['href']?>">
                                            	<div class="pull-left gmimg" style="background-image:url('<?php echo $act['image']?>');"></div>
                                            	<p class="desc"><?php echo $act['message']?></strong></p>
                                            	<small class="time"><?php echo $act['time']?></small>
                                            </a>
                                        </li>
                                    <?php } // foreach ?>
                                    </ul>
                                </li>
                                <?php
	                            } // if $activities
                                ?>
                                <li class="footer"><a href="<?php echo $baseurl?>/dashboard.php"><?php echo $lang[397]; //See All Your Timeline?></a></li>
                            </ul>
                        </li>

                        <?php
	                    $my_avatar = (($_SESSION['user_pic'])) ? $baseurl . '/images/user_pics/' . $user['user_pic'] . '?t=' . time() : $baseurl . '/images/avatar3.png';
                        ?>
                        <!-- User Account -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle">
								<div class="pull-left image" id="my_avatar"><img src="<?php echo $my_avatar?>" class="img-circle" alt="Username"></div>
                                <span class="name"><?php echo $user['user_name'];?></span>
                                <span class="coin"><?php echo number_format(floor($user['user_coins']))?><small>COIN</small><i class="icon"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header"></li>
                                <li>
									<ul class="menu">
										<li><a href="<?php echo $baseurl?>/dashboard.php"><?php echo $lang[2];//Dashboard?></a></li>
										<li><a href="<?php echo $baseurl?>/joinedgame.php"><?php echo $lang[396];//Joined Game?></a></li>
										<li><a href="<?php echo $baseurl?>/balance.php"><?php echo $lang[296];//Balance?></a></li>
										<li><a href="<?php echo $baseurl?>/withdrawal.php"><?php echo $lang[380];//Withdrawal?></a></li>
										<li><a href="<?php echo $baseurl?>/settings/account.php"><?php echo $lang[405]; //my account?></a></li>
										<li class="dropdown-divider"></li>
										<li><a href="#"><?php echo $lang[398];//Help?></a></li>
										<li><a href="#"><?php echo $lang[399];//Game Guide?></a></li>
										<li class="dropdown-divider"></li>
										<li><a href="<?php echo $baseurl?>/logout.php"><?php echo $lang[25]; //Sign out?></a></li>
									</ul>
                                </li>
                            </ul><!-- .dropdown-menu END -->
                        </li><!-- .dropdown.user.user-menu END -->

                    </ul><!-- #usrmenu.nav.navbar-nav END -->

				</div>

			<?php } // else ?>
			</div><!-- .loginmenu -->

			<div class="search-content">
				<form action="<?php echo $baseurl?>/search.php" id="masthead-search" class="search-form">
					<button class="search-button" type="submit" id="search-btn" dir="ltr" tabindex="2"><span><?php echo $lang[343]; //Search?></span>
					</button>
					<div id="masthead-search-terms" dir="ltr">
						<label>
							<input id="masthead-search-term" autocomplete="off" name="q" value="" type="text" tabindex="1" placeholder="<?php echo $lang[540]; //Search?>" title="<?php echo $lang[343]; //Search?>" dir="ltr">
						</label>
					</div>
                    <input type="hidden" name="prev_page" value="<?php echo getCurrentPage(); ?>">
				</form>
			</div><!-- .search-content -->

		</div><!-- .col.span_12 -->

	</div><!-- .container -->
</header>