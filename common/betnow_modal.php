<div id="betconfirm-window" class="remodal" data-remodal-id="betnow">
	<div class="modal-head">
		<div class="row">
			<div class="col span_12">
				<h2><?php echo strtoupper($lang[221]) ?></h2>
			</div>
		</div><!-- /.row -->
	</div><!-- /.modal-head -->
	<div class="modal-body">
		<div class="row">
			<div class="col span_12 confirmbox">

				<h4 class="gmtitle"><?php echo $game['g_title'];?></h4>
				<p class="gmdesc">Game ID : <?php echo $game['g_id']?></p>

				<h6 class="label"><?php echo $lang[541]?></h6>
				<ul class="betitem row">
					<li class="col span_8 item"><?php echo $bet_items2[$item_radio];?></li>
					<li class="col span_4 coin txt-r"><?php echo $bet_radio?><span class="count">COIN</span></li>
				</ul>

				<h6 class="label"><?php echo $lang[542]?></h6>
				<ul class="subtotal-box row">
					<li class="row">
						<div class="col span_6">
							<?php echo $lang[543]?>
						</div>
						<div class="col span_6 txt-r">
							<?php echo $user_coins?><span>COIN</span>
						</div>
					</li>
					<li class="row">
						<div class="col span_6">
							<?php echo $lang[544]?>
						</div>
						<div class="col span_6 txt-r">
							<?php echo $bet_radio?><span>COIN</span>
						</div>
					</li>
					<li class="row">
						<div class="col span_6">
							<?php echo $lang[545]?>
						</div>
						<div class="col span_6 txt-r">
							<?php echo $user_coins - $bet_radio?><span>COIN</span>
						</div>
					</li>
				</ul>

				<p class="notice-txt"><?php echo $lang[245]?></p>

			</div>
		</div><!-- /.row -->
	</div><!-- /.modal-body -->
	<div class="modal-foot">
		<div class="row">
			<div class="col span_12 txt-r">
				<a href="" class="btn cancel"><?php echo $lang[244]?></a>
				<a href="" class="btn confirm" id="confirm-bet"><?php echo $lang[546]?></a>
			</div>
		</div><!-- /.row -->
	</div><!-- /.modal-foot -->
</div><!-- /#betconfirm-window -->

