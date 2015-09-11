<!-- Account Menu  -->
<ul class="mymenu-links">
	<li class="dividers"><?php echo $lang[405];//Your Account?></li>
	<li class="<?php echo $accountmenu ?>"><a class="" href="<?php echo $baseurl?>/settings/account.php" data-nav="account"><?php echo $lang[406];//Account?> <span class="icon"></span></a></li>
	<li class="<?php echo $passwordmenu ?>"><a class="" href="<?php echo $baseurl?>/settings/password.php" data-nav="password"><?php echo $lang[331];//Password?><span class="icon"></span></a></li>
	<li class="<?php echo $profilemenu ?>"><a class="" href="<?php echo $baseurl?>/settings/profile.php" data-nav="profile"><?php echo $lang[407];//Profile?> <span class="icon"></span></a></li>
	<li class="<?php echo $notificationsmenu ?>"><a class="" href="<?php echo $baseurl?>/settings/notifications.php" data-nav="notifications"><?php echo $lang[408];//Email notifications?> <span class="icon"></span></a></li>
	<li class="<?php echo $privacymenu ?>"><a class="" href="<?php echo $baseurl?>/settings/privacy.php" data-nav="privacy"><?php echo $lang[409];//Privacy Setting?> <span class="icon"></span></a></li>
	<li class="<?php echo $paymentmenu ?>"><a class="" href="<?php echo $baseurl?>/settings/payment.php" data-nav="notifications"><?php echo $lang[492];//Payment Info?> <span class="icon"></span></a></li>


	<li class="dividers"></li>
	<li class=""><a class="list-link" href="/index.php" data-nav="widgets"><?php echo $lang[410];//Delete my account?></a></li>

</ul>