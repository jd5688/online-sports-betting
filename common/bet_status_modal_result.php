<div id="betstatus-window" class="remodal" data-remodal-id="betstatus_result">
	<div class="modal-head">
		<div class="row">
			<div class="col span_12">
				<h2><?php echo $lang[297]; //BET STATUS?></h2>
			</div>
		</div><!-- /.row -->
	</div><!-- /.modal-head -->
	<div class="modal-body">
		<div class="row">
			<div class="col span_6 graphbox">
				<div class="grapharea">
					<div id="coindonut" style="height: 150px;"></div>
					<div class="totalbox" id="m-totalbox-coin"><p><?php echo number_format($game_placed_coins);?><span class="count">COIN</span></p></div>
				</div>
				<h6 class="label"><?php echo $lang[298]; //BETTING COIN DATA?></h6>
				<ul data-pie-id="coindonut" data-options='{"donut":"true", "donut_inner_ratio":"0.5"}'>
				<?php
				$morris_pie_coins = array();
				$i = 0;
				if ($info_per_bet_item) {
					foreach ($info_per_bet_item as $bi) {
						if ($bi['is_winner']) {
							$classwinitem = 'winitem';
						} else {
							$classwinitem = '';
						}
						$bi_placed_coins = ($bi['placed_coins']) ? $bi['placed_coins'] : 0;
						if ($bi_placed_coins) {
							$morris_pie_coins[$i]['label'] = $bet_items2[$bi['bi_id']];
							$morris_pie_coins[$i]['value'] = $bi_placed_coins;
						}
				?>
					<li class="row <?php echo $classwinitem?>" data-value="<?php echo $bi_placed_coins?>" data-text="<?php echo $bet_items2[$bi['bi_id']];?> {{percent}}">
						<div class="col span_9" id="m-div-c-<?php echo $bi['bi_id']?>"><?php echo $bet_items2[$bi['bi_id']];?></div>
						<div class="col span_3 txt-r" id="m-li-c-<?php echo $bi['bi_id']?>"><?php echo $bi_placed_coins?><span class="count">COIN</span></div>
					</li>
				<?php 
						$i++;
					} // foreach
				} else {
				?>
					<li class="row" data-value="0" data-text="-- {{percent}}">
						<div class="col span_9">--</div>
						<div class="col span_3 txt-r">--<span class="count">COIN</span></div>
					</li>
				<?php } ?>	
				</ul>
				

			</div>

			<div class="col span_6 betuserbox">

				<div class="grapharea">
					<div id="userdonut" style="height: 150px;"></div>
					<div class="totalbox" id="m-totalbox-users"><p><?php echo $total_joined;?><span class="count">USERS</span></p></div>
				</div>

				<h6 class="label"><?php echo $lang[550]; //BETTING USERS DATA?></h6>
				<ul data-pie-id="userdonut" data-options='{"donut":"true", "donut_inner_ratio":"0.5"}'>
				<?php
				$morris_pie_users = array();
				$i = 0;
				if ($info_per_bet_item) {
					foreach ($info_per_bet_item as $bi) {
						if ($bi['is_winner']) {
							$classwinitem = 'winitem';
						} else {
							$classwinitem = '';
						}
						$bi_bet_users_total = ($bi['bet_users_total']) ? $bi['bet_users_total'] : 0;
						if ($bi_bet_users_total) {
							$morris_pie_users[$i]['label'] = $bet_items2[$bi['bi_id']];
							$morris_pie_users[$i]['value'] = $bi_bet_users_total;
						}
				?>
					<li class="row <?php echo $classwinitem?>" data-value="<?php echo $bi_bet_users_total?>" data-text="<?php echo $bet_items2[$bi['bi_id']];?> {{percent}}">
						<div class="col span_9" id="m-div-u-<?php echo $bi['bi_id']?>"><?php echo $bet_items2[$bi['bi_id']];?></div>
						<div class="col span_3 txt-r" id="m-li-u-<?php echo $bi['bi_id']?>"><?php echo $bi_bet_users_total?><span class="count">USERS</span></div>
					</li>
				<?php 
						$i++;
					} // foreach
				} else {
				?>
					<li class="row" data-value="0" data-text="-- {{percent}}">
						<div class="col span_9">--</div>
						<div class="col span_3 txt-r">0<span class="count">USERS</span></div>
					</li>
				<?php } ?>	
				</ul>



			</div>
		</div><!-- /.row -->
	</div><!-- /.modal-body -->
	<div class="modal-foot">
		<div class="row">
			<div class="col span_12 txt-r">
				<a href="" class="btn cancel"><?php echo $lang[276]; //Close?></a>
			</div>
		</div><!-- /.row -->
	</div><!-- /.modal-foot -->
</div><!-- /#betconfirm-window -->

