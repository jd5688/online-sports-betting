<?php if (!$game['g_isTrial']) { ?>
<div class="mybetstatus">
	<h3 class="title"></h3>
	<div class="inner">
	
		<h4><?php echo $lang[435]; //Your betted item?></h4>
		<?php
		$game_comm = $game['g_houseCom'];
		$total_bet_amount = 0;
		if ($bet_items) {
			foreach ($bet_items as $bi) {
				$total_bet_amount += $user_bettings[$bi['bi_id']]['tot_coins'];
				$user_bet_coins = ($user_bettings[$bi['bi_id']]['tot_coins']) ? $user_bettings[$bi['bi_id']]['tot_coins'] : 0;
				
				if (!$user_bet_coins) { continue; }
				$you_may_win = $user_may_earn['at_stake'] / $user_may_earn[$bi['bi_id']]['total_item_bet_share'] * $user_may_earn[$bi['bi_id']][$user_id]['his_share'];			
		?>
	    <div class="row">
	        <div class="col span_8"><?php echo $bi['bi_description' . $suffix]?></div>
	        <div class="col span_4 txt-r"><?php echo $user_bet_coins?><span>COIN</span></div>
	        <div class="col span_12 mayearn"><?php echo $lang[461]; //You may earn?> <strong id="<?php echo $bi['bi_id']?>"><?php echo number_format($you_may_win,2)?></strong><span>COIN</span></div>
	    </div>
	    <?php 
	    	} // foreach
	    } // if $bet_items
	    ?>
	    <?php /*
	    <div class="row">
	        <div class="col span_8">FC Barcelona</div>
	        <div class="col span_4 txt-r">40<span>COIN</span></div>
	        <div class="col span_12 mayearn">You may earn <strong>57</strong><span>COIN</span></div>
	    </div>

	    <div class="row">
	        <div class="col span_8">Both teams scoreless</div>
	        <div class="col span_4 txt-r">4<span>COIN</span></div>
	        <div class="col span_12 mayearn">You may earn <strong>20</strong><span>COIN</span></div>
	    </div>
		*/ ?>
	    <div class="row totalbet">
	        <div class="col span_8"><?php echo $lang[156]; //Total bet COIN?></div>
	        <div class="col span_4 txt-r"><?php echo $total_bet_amount?><span>COIN</span></div>
	    </div>
	</div><!-- .inner END -->
</div><!-- .mybetstatus END -->
<?php } else { ?>
<div class="mybetstatus">
	<h3 class="title"></h3>
	<div class="inner">
	
		<h4><?php echo $lang[435]; //Your betted item?></h4>
		<?php
		$game_comm = $game['g_houseCom'];
		$total_bet_amount = 0;
		if ($bet_items) {
			foreach ($bet_items as $bi) {
				$total_bet_amount += $user_bettings[$bi['bi_id']]['tot_coins'];
				if (isset($user_bettings[$bi['bi_id']]['tot_coins'])) {
					$user_bet_coins =  $user_bettings[$bi['bi_id']]['tot_coins'];
				} else {
					continue;
				}
		?>
	    <div class="row">
	        <div class="col span_8"><?php echo $bi['bi_description' . $suffix]?></div>
	        <div class="col span_4 txt-r"><?php echo $user_bet_coins?><span>COIN</span></div>
	    </div>
	    <?php 
	    	} // foreach
	    } // if $bet_items
	    ?>
	    <div class="row totalbet">
	        <div class="col span_8"><?php echo $lang[156]; //Total bet COIN?></div>
	        <div class="col span_4 txt-r"><?php echo $total_bet_amount?><span>COIN</span></div>
	    </div>
	</div><!-- .inner END -->
</div><!-- .mybetstatus END -->
<?php } ?>