<div class="highlights row">
	<div class="col span_4">
		<div class="title_box_s clr">
			<h5><?php echo $lang[415]; //Earning?> (<?php echo $lang[145]?>)</h5>
			<a href="<?php echo $baseurl ?>/balance.php" class="viewall"><?php echo $lang[414]; //View all?></a>
		</div>

		<div id="myfirstchart" style="height: 150px;"></div>

	</div><!-- .col.span_4 END  -->

	<div class="col span_4 winningbox">
		<div class="title_box_s clr">
			<h5><?php echo $lang[416]; //Winning percentage?> (<?php echo $lang[145]?>)</h5>
			<a href="<?php echo $baseurl ?>/joinedgame.php" class="viewall"><?php echo $lang[414]; //View all?></a>
		</div>

		<div id="donutchart" style="height: 150px;"></div>

		<ul data-options='{"donut":"true", "donut_inner_ratio":"0.5"}'>
			<li class="row" data-value="29" data-text="Win Game {{percent}}">
				<div class="col span_9"><?php echo $lang[411];//Win Game?></div>
				<div class="col span_3 txt-r"><?php echo number_format($win_lose['wonpie'])?></div>
			</li>
			<li class="row" data-value="6" data-text="Lose Game {{percent}}">
				<div class="col span_9"><?php echo $lang[412];//Lose Game?></div>
				<div class="col span_3 txt-r"><?php echo number_format($win_lose['losepie'])?></div>
			</li>
			<li class="row" data-value="0" data-text="Canceled Game {{percent}}">
				<div class="col span_9"><?php echo $lang[413]; //Cancelled Game?></div>
				<div class="col span_3 txt-r"><?php echo number_format($win_lose['cancelpie'])?></div>
			</li>
		</ul>
	</div><!-- .col.span_4 END  -->

	<div class="col span_4 coinbox">
		<div class="title_box_s clr">
			<h5><?php echo $lang[394]; //Current COIN?></h5>
			<a href="<?php echo $baseurl ?>/balance.php" class="viewall"><?php echo $lang[414]; //View all?></a>
		</div>

		<p class="coin"><?php echo number_format($user['user_coins'], 2)?><span>COIN</span></p>
		<p class="desc"><?php echo $lang[393]?></p>
	</div><!-- .col.span_4 END  -->
</div><!-- .highlights END  -->
