<div id="quickbet-window" class="remodal quickbet" data-remodal-id="quickbet">
	<div class="modal-head">
		<div class="row">
			<div class="col span_12">
				<p class="gmdesc"><?php echo $lang[82]; //Game ID?> : <span id="bm-gid"></span></p>
				<h2 class="gmtitle"><span id="bm-title"></span></h2>
			</div>
		</div><!-- /.row -->
	</div><!-- /.modal-head -->
	<div class="modal-body">
		<div class="row">


			<div class="col span_6">

				<div class="betbox">
					<h3 class="title"><?php echo $lang[220]?><span><?php echo $lang[219]?></span></h3>
					<h6 class="label"><?php echo $lang[234]?></h6>
					<div class="item_radio">
						<span id="bm-select-item"></span>
						<?php /*
						<label class="cbxbd"><input type="radio" name="item_radio" id="item_radio1" value="">Real Madrid</label>
	
						<label class="cbxbd"><input type="radio" name="item_radio" id="item_radio2" value="">FC Barcelona</label>
	
						<label class="cbxbd"><input type="radio" name="item_radio" id="item_radio3" value="">Both teams scoreless</label>
						*/ ?>
					</div>
					
					<span id="pre-set-bets">
					<h6 class="label"><?php echo $lang[233]?></h6>
					<div class="bet_radio row">
						<label class="cbxbd"><input type="radio" name="bet_radio" id="bet_radio1" value="10"><span id="bet_radio1_v" class="coinamount">10</span><span>COIN</span></label>
	
						<label class="cbxbd"><input type="radio" name="bet_radio" id="bet_radio2" value="20"><span id="bet_radio2_v" class="coinamount">20</span><span>COIN</span></label>
	
						<label class="cbxbd"><input type="radio" name="bet_radio" id="bet_radio3" value="30"><span id="bet_radio3_v" class="coinamount">30</span><span>COIN</span></label>
	
						<label class="cbxbd"><input type="radio" name="bet_radio" id="bet_radio4" value="40"><span id="bet_radio4_v" class="coinamount">40</span><span>COIN</span></label>
	
						<label class="cbxbd"><input type="radio" name="bet_radio" id="bet_radio5" value="50"><span id="bet_radio5_v" class="coinamount">50</span><span>COIN</span></label>
	
						<label class="cbxbd"><input type="radio" name="bet_radio" id="bet_radio6" value="100"><span id="bet_radio6_v" class="coinamount">100</span><span>COIN</span></label>
					</div>
					</span>
	
				</div><!-- /.betbox -->

			</div>

			<div class="col span_6 confirmbox">

				<h6 class="label"><?php echo $lang[541]?></h6>
				<ul class="betitem row">
					<li class="col span_8 item"><span id="bm-bet-item"></span></li>
					<li class="col span_4 coin txt-r"><span id="bm-bet-coins">0</span><span class="count">COIN</span></li>
				</ul>

				<h6 class="label"><?php echo $lang[542]?></h6>
				<ul class="subtotal-box row">
					<li class="row">
						<div class="col span_6">
							<?php echo $lang[543]?>
						</div>
						<div class="col span_6 txt-r" id="bm-user-coins">
							0<span>COIN</span>
						</div>
					</li>
					<li class="row">
						<div class="col span_6">
							<?php echo $lang[544]?>
						</div>
						<div class="col span_6 txt-r" id='bm-bet-coin-info'>
							0<span>COIN</span>
						</div>
					</li>
					<li class="row">
						<div class="col span_6">
							<?php echo $lang[545]?>
						</div>
						<div class="col span_6 txt-r" id="bm-coin-balance">
							0<span>COIN</span>
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
				<a href="" class="btn confirm" id="submit-quick-bet-button"><?php echo $lang[546]?></a>
				<input type="hidden" id="this-is-a-trial-game" value="0"/>
			</div>
		</div><!-- /.row -->
	</div><!-- /.modal-foot -->
</div><!-- /#betconfirm-window -->

