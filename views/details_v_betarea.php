<?php if (!$game['g_isTrial']) { ?>

<form name="bet-now-form" action="details.php?lang=<?php echo $LANGUAGE?>&game=<?php echo base64_encode($game_id);?>#betnow" method="POST">
	<div class="betbox">
	<h3 class="title"><?php echo $lang[220]; // BET NOW?><span><?php echo $lang[219]?></span></h3>
	<div class="inner">

		<h4><?php echo $lang[234]?></h4>
		<div class="item_radio">
		<?php
		if ($bet_items) {
			$c = 0;
			foreach ($bet_items as $bi) {
				$c++;
				//$bet_items2[$bi['bi_id']] = $bi['bi_description']; // to be used by javascript
		?>
			<label class="cbxbd"><input type="radio" name="item_radio" id="item_radio<?php echo $c;?>" value="<?php echo $bi['bi_id']?>"><?php echo $bi['bi_description' . $suffix]?></label>
		<?php
			} // foreach
		} // if $bet_items
		?>
		</div>
		
		<h4><?php echo $lang[233]?></h4>
		<div class="bet_radio row">
			<label class="cbxbd">
			<?php if ($user_coins >= $betarr[0]) { ?>
				<input type="radio" name="bet_radio" id="bet_radio1" value="<?php echo $betarr[0]?>"><?php echo $betarr[0]?><span>COIN</span>
			<?php } else { ?>
				<?php echo $betarr[0]?><span>COIN</span>
			<?php } ?>
			</label>

			<label class="cbxbd">
			<?php if ($user_coins >= $betarr[1]) { ?>
				<input type="radio" name="bet_radio" id="bet_radio2" value="<?php echo $betarr[1]?>"><?php echo $betarr[1]?><span>COIN</span>
			<?php } else { ?>
				<?php echo $betarr[1]?><span>COIN</span>
			<?php } ?>
			</label>

			<label class="cbxbd">						
			<?php if ($user_coins >= $betarr[2]) { ?>
				<input type="radio" name="bet_radio" id="bet_radio3" value="<?php echo $betarr[2]?>"><?php echo $betarr[2]?><span>COIN</span>
			<?php } else { ?>
				<?php echo $betarr[2]?><span>COIN</span>
			<?php } ?>
			</label>

			<label class="cbxbd">
			<?php if ($user_coins >= $betarr[3]) { ?>
				<input type="radio" name="bet_radio" id="bet_radio4" value="<?php echo $betarr[3]?>"><?php echo $betarr[3]?><span>COIN</span>
			<?php } else { ?>
				<?php echo $betarr[3]?><span>COIN</span>
			<?php } ?>					
			</label>

			<label class="cbxbd">
			<?php if ($user_coins >= $betarr[4]) { ?>
				<input type="radio" name="bet_radio" id="bet_radio5" value="<?php echo $betarr[4]?>"><?php echo $betarr[4]?><span>COIN</span>
			<?php } else { ?>
				<?php echo $betarr[4]?><span>COIN</span>
			<?php } ?>								
			</label>

			<label class="cbxbd">
			<?php if ($user_coins >= $betarr[5]) { ?>
				<input type="radio" name="bet_radio" id="bet_radio6" value="<?php echo $betarr[5]?>"><?php echo $betarr[5]?><span>COIN</span>
			<?php } else { ?>
				<?php echo $betarr[5]?><span>COIN</span>
			<?php } ?>							
			</label>

			<div id="custombet">
				<p class="txt"><?php echo $lang[473]?></p>
				<label class="cbxbd custom">
					<input type="radio" name="bet_radio" id="bet_radio7" value=0><input type="number" min="<?php echo $betarr[0]?>" max="<?php echo $betarr[0] * 100?>" name="custom-bet" onkeyup="YouMayEarn(this)"/><span>COIN</span>
				</label>
			</div>


		</div>

		<div class="bet_culc">
			<?php echo $lang[474]?><span id="you_may_earn"></span><?php echo $lang[475]?>
		</div>

		<div class="bet_confirm">
			<a href="" id="bet-now-button" class="bet btn disabled"><?php echo $lang[525]; // BET NOW?></a>
		</div><!-- .bet_confirm END -->
	</div><!-- .inner END -->
</div><!-- .betbox END -->

</form>

<?php } else { ?>
<form name="bet-now-form" action="details.php?lang=<?php echo $LANGUAGE?>&game=<?php echo base64_encode($game_id);?>#betnow" method="POST">
	<div class="betbox">
	<h3 class="title"><?php echo $lang[220]; // BET NOW?>!<span><?php echo $lang[219]?></span></h3>
	<div class="inner">

		<h4><?php echo $lang[234]?></h4>
		<div class="item_radio">
		<?php
		if ($bet_items) {
			$c = 0;
			foreach ($bet_items as $bi) {
				$c++;
				//$bet_items2[$bi['bi_id']] = $bi['bi_description']; // to be used by javascript
		?>
			<label class="cbxbd"><input type="radio" name="item_radio" id="item_radio<?php echo $c;?>" value="<?php echo $bi['bi_id']?>"><?php echo $bi['bi_description']?></label>
		<?php
			} // foreach
		} // if $bet_items
		?>
		</div>			
		<input type="hidden" name="bet_radio" id="bet_radio1" value=0>

		<div class="bet_culc" style="display:none">
			<?php echo $lang[474]?><span id="you_may_earn"></span><?php echo $lang[475]?>
		</div>

		<div class="bet_confirm">
			<a href="" id="bet-now-button" class="bet btn"><?php echo $lang[525]; // BET NOW?></a>
		</div><!-- .bet_confirm END -->
	</div><!-- .inner END -->
</div><!-- .betbox END -->

</form>
<?php } ?>