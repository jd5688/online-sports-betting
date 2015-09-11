<div class="alart row">
	<div class="col span_6">
		<h4 class="title"><?php echo $lang[520];?></h4>
		<p class="desc"><?php echo $lang[521];?></p>
	</div><!-- .col.span_6 END  -->
	<div class="col span_6">
		<ul>
		<?php if (!$profile_is_complete) { ?>
			<li><a href="<?php echo $baseurl ?>/settings/profile.php"><span></span><?php echo $lang[522];?></a></li>
		<?php } ?>
		<?php if (!$payinfo_is_complete) { ?>
			<li><a href="<?php echo $baseurl ?>/settings/payment.php"><span></span><?php echo $lang[523];?></a></li>
		<?php } ?>
			<li><a href="<?php echo $baseurl ?>/settings/withdrawal.php"><span></span><?php echo $lang[524];?></a></li>
		</ul>
	</div><!-- .col.span_6 END  -->
</div><!-- .alart END  -->