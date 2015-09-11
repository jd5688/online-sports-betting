<?php 
if ($is_future_game) {
?>

<div class="gmstatus row">
	<label><?php echo $lang[241]; //Current Game Status?></label>
	<div class="status row">
		<div class="col span_12">
			<span class="title time"><?php echo $lang[239]?></span>
			<div class="timer_cd"><?php echo date('Y/m/d G:i', $game['g_schedFrom'])?><span class="count">JPN time</span></div>
		</div>
	</div><!-- .status END -->


</div>

<?php 
} else { // if $is_future_game 
?>
<div class="gmstatus row">
	<label><?php echo strtoupper($lang[241]); //Current Game Status?></label>
	<div class="status row">
		<div class="col span_4">
			<span class="title time"><?php echo $lang[242]?></span>
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




						<div class="main_bet">
							<label for="item_radio1">Real Madrid</label>
							<label for="item_radio2">FC Barcelona</label>
							<label for="item_radio3">Both teams scoreless</label>
						</div>





	<table class="table">
		<thead>
		    <tr>
		        <th>#</th>
		        <th><?php echo $lang[457]; //Items?></th>
		        <th><?php echo $lang[282]; //Placed COIN?></th>
		        <th><?php echo $lang[458]; //BET Users?></th>
		        <th><?php echo $lang[459]; //Ratio?></th>
		    </tr>
		</thead>
		<tbody>
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
		    <tr data-href="#betstatus_result" <?php echo $classwinitem?>>
		        <td><?php echo $c?></td>
		        <td><?php echo $bet_items2[$bi['bi_id']];?></td>
		        <td id="m-td-c-<?php echo $bi['bi_id']?>"><?php echo $bi['placed_coins']?></td>
		        <td id="m-td-u-<?php echo $bi['bi_id']?>"><?php echo $bi['bet_users_total']?></td>
		        <td id="m-td-r-<?php echo $bi['bi_id']?>"><?php echo number_format($bi['ratio'],2)?><span>%</span></td>
		
		    </tr>
		<?php
			} // foreach
		} else { // if $bet_items
		?>
			<tr data-href="">
		        <td></td>
		        <td>0</td>
		        <td>0</td>
		        <td>0</td>
		        <td>0<span>%</span></td>
		    </tr>
		<?php } // else ?>
		</tbody>
	</table><!-- .table END -->
	<div class="seemore graph"><a id="see_more" href="#betstatus_result"><?php echo $lang[460]; //See Graph Data?></a></div>
</div>
<?php } // else ?>