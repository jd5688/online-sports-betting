<div class="betbox coming">
	<h3 class="title">
		<span class="title time"><?php echo $lang[240]?></span>
		<div class="timer_cd" id="gameTimer"><?php echo $lang[462]; //Time Up?></div>
	</h3>
	<div class="inner">

		<h4><?php echo $lang[90]?></h4>
		<p class="rate"><?php echo $lang['554']; // Please wait until time has comes?></p>
		<div class="item_radio">
		<?php
		if ($bet_items) {
			$c = 0;
			foreach ($bet_items as $bi) {
				$c++;
				//$bet_items2[$bi['bi_id']] = $bi['bi_description']; // to be used by javascript
		?>
			<label class="cbxbd"><input type="radio" name="item_radio" id="item_radio<?php echo $c;?>" value="<?php echo $bi['bi_id']?>" disabled><?php echo $bi['bi_description' . $suffix]?></label>
		<?php
			} // foreach
		} // if $bet_items
		?>
		</div>
		<div class="bet_confirm">
			<a href="" class="bet btn disabled"><?php echo $lang['238']; // BET NOW?></a>
		</div>
	</div><!-- .inner END -->
</div><!-- .betbox END -->
