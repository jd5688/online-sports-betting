<form name="bet-now-form" action="details.php?game=<?php echo base64_encode($game_id);?>#betnow" method="POST">
	<div class="betbox">
	<h3 class="title">
		<?php echo $lang[232]; // BET NOW?><span><?php echo $lang[529]?></span>
	</h3>
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
			<label class="cbxbd"><input type="radio" name="item_radio" id="item_radio<?php echo $c;?>" value="<?php echo $bi['bi_id']?>" disabled><?php echo $bi['bi_description']?></label>
		<?php
			} // foreach
		} // if $bet_items
		?>
		</div>
	
		<h4><?php echo $lang[233]?></h4>
		<div class="bet_radio row">
			<label class="cbxbd">
				<?php echo $betarr[0];?><span>COIN</span>
			</label>

			<label class="cbxbd">
				<?php echo $betarr[1];?><span>COIN</span>
			</label>

			<label class="cbxbd">						
				<?php echo $betarr[2];?><span>COIN</span>
			</label>

			<label class="cbxbd">
				<?php echo $betarr[3];?><span>COIN</span>
			</label>

			<label class="cbxbd">
				<?php echo $betarr[4];?><span>COIN</span>
			</label>

			<label class="cbxbd">
				<?php echo $betarr[5];?><span>COIN</span>
			</label>
		</div>

		<div class="bet_confirm">
			<a href="" id="bet-now-button" class="bet btn disabled"><?php echo $lang['232']; // BET NOW?></a>
		</div><!-- .bet_confirm END -->
		
	</div><!-- .inner END -->
</div><!-- .betbox END -->
	
<?php /*
<div class="notify">
	<h6><?php echo $lang[22] // notification ?></h6>
	<label class="cbxbd"><?php echo $lang['218']?></label>
</div><!-- .notify END -->
*/?>
</form>