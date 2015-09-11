<div class="buycoin_box row">

	<h5 class="title"><?php echo $lang[299]; //Choose COIN Package ?></h5>

	<div class="buycoin_radio row">
	<?php
	if ($coin_packages) {
		foreach ($coin_packages as $cp) {
	?>
		<label class="cbxbd">
			<div class="inner"><input type="radio" name="item_radio" value="<?php echo $cp['cpid']?>"><img src="<?php echo $baseurl;?>/images/coin_image.png"><h6><?php echo $cp['cpcoin']?><span>COIN</span></h6><p class="price"><?php echo number_format($cp['cpamount']);?><span><?php echo $config['currency']?></span></p></div>
		</label>
	<?php
		} // foreach
	} else {// if coin_packages
	?>	
		<label class="cbxbd">
			<div class="inner"><input type="radio" name="item_radio" value="">--</div>
		</label>
	<?php
	} // else
	?>
	<?php /*
		<label class="cbxbd">
			<div class="inner"><input type="radio" name="item_radio" id="buycoin_radio3" value="buycoin3"><img src="./images/coin_image.png"><h6>10000<span>COIN</span></h6><p class="price">10,000<span>円</span></p></div>
		</label>

		<label class="cbxbd">
			<div class="inner"><input type="radio" name="item_radio" id="buycoin_radio4" value="buycoin4"><img src="./images/coin_image.png"><h6>5000<span>COIN</span></h6><p class="price">5,000<span>円</span></p></div>
		</label>

		<label class="cbxbd">
			<div class="inner"><input type="radio" name="item_radio" id="buycoin_radio5" value="buycoin5"><img src="./images/coin_image.png"><h6>3000<span>COIN</span></h6><p class="price">3,000<span>円</span></p></div>					
		</label>

		<label class="cbxbd">
			<div class="inner"><input type="radio" name="item_radio" id="buycoin_radio6" value="buycoin5"><img src="./images/coin_image.png"><h6>2000<span>COIN</span></h6><p class="price">2,000<span>円</span></p></div>					
		</label>

		<label class="cbxbd">
			<div class="inner"><input type="radio" name="item_radio" id="buycoin_radio7" value="buycoin5"><img src="./images/coin_image.png"><h6>1000<span>COIN</span></h6><p class="price">1,000<span>円</span></p></div>					
		</label>

		<label class="cbxbd">
			<div class="inner"><input type="radio" name="item_radio" id="buycoin_radio8" value="buycoin5"><img src="./images/coin_image.png"><h6>500<span>COIN</span></h6><p class="price">500<span>円</span></p></div>					
		</label>
	 */ ?>
	</div><!-- .buycoin_radio END -->
</div><!-- .buycoin_box END -->
