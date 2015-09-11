<?php 
if ($is_future_game) {
?>

<div class="gmstatus row">
	<label><?php echo $lang[241]; //Current Game Status?></label>
	<div class="status row">
		<div class="col span_12">
			<span class="title time"><?php echo $lang[239]?></span>
			<div class="timer_cd"><?php echo date('Y/m/d G:i', $game['g_schedFrom'])?><span class="count"><?php echo $lang[552]; //JPN time?></span></div>
		</div>
	</div><!-- .status END -->


</div>

<?php 
} else { // if $is_future_game 
?>
<div class="gmstatus row">

	<label><?php if (!$disable_betting) {?><?php echo $lang[234]?><?php } else { ?><?php echo $lang[90]?><?php } ?></label>

	<ul class="main_bet <?php if ($disable_betting) {?>disabled<?php } ?>">
		<li class="row gutters label">
			<div class="col span_6 item"><?php echo $lang[457]; //Items?></div>
			<div class="col span_6">
				<?php if (!$disable_betting) {?>
				<p class="bbtn"><span><?php echo $lang[476];?></span></p>
				<?php } ?>
				<p class="bratio"><?php echo $lang[459]; //Ratio?></p>
				<p class="buser"><?php echo $lang[458]; //BET Users?></p>
				<p class="bcoin"><?php echo $lang[551]; //Placed COIN?></p>
			</div>
		</li>

		<?php
		if ($info_per_bet_item) {
			$c = 0;
			foreach ($info_per_bet_item as $bi) {
				$c++;
				if ($bi['is_winner']) {
					$classwinitem = 'class="winitem"';
					$win_item_placed_coins += $bi['placed_coins'];
				} else {
					$classwinitem = '';
				}
		?>

			<li <?php echo $classwinitem?>>
				<label id="bi-label-radio" for="item_radio<?php echo $c?>" class="row gutters">
					<div class="col span_6 item"><?php echo $bet_items2[$bi['bi_id']];?></div>
					<div class="col span_6 data">
						<?php if (!$disable_betting) {?>
							<p class="bbtn"><span><?php echo $lang[476];?></span></p>
						<?php } ?>
						<p id="m-td-r-<?php echo $bi['bi_id']?>" class="bratio"><?php echo number_format($bi['ratio'],2)?><span>%</span></p>
						<p id="m-td-u-<?php echo $bi['bi_id']?>" class="buser"><?php echo $bi['bet_users_total']?></p>
						<p id="m-td-c-<?php echo $bi['bi_id']?>" class="bcoin"><?php echo $bi['placed_coins']?></p>
					</div>
				</label>
			</li>

		<?php
			} // foreach
		} else { // if $bet_items
		?>
		<li>
			<label class="row gutters">
				<div class="col span_6 item"></div>
				<div class="col span_6 data">
					<p class="bcoin">--</p>
					<p class="buser">--</p>
					<p class="bratio">--<span>%</span></p>
					<p class=""></p>
				</div>
			</label>
		</li>
		<?php } // else ?>
	</ul>

	<div class="seemore graph"><a id="see_more" href="#betstatus_result"><?php echo $lang[460]; //See Graph Data?></a></div>


	<label><?php echo strtoupper($lang[241]); //Current Game Status?></label>
	<div class="status row">
		<div class="col span_4">
			<span class="title time"><?php echo $lang[527]?></span>
			<div class="timer_cd" id="<?php echo $game_timer_id?>">--</div>
		</div>
		<div class="col span_4">
			<span class="title coin"><?php echo $lang[455]; //Placed?></span>
			<span id="m-total-coin"><?php echo number_format($game_placed_coins);?></span><span class="count">COIN</span>
		</div>
		<div class="col span_4">
			<span class="title coin"><?php echo $lang[456]; //Join?></span>
			<span id="m-total-users"><?php echo $total_joined;?></span><span class="count">USERS</span>
		</div>
	</div><!-- .status END -->


</div>
<?php } // else ?>