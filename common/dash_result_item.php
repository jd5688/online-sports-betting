<ul class="row gmlist list">
<?php
if ($my_bets['results']) {
	$i = 0;
	foreach ($my_bets['results'] as $mb) {
		if ($i > 4) { break; }
		$game_pic = $mb['image'];
		if ($game_pic == '') {
			$game_pic = $baseurl . '/images/blur-background04.jpg';
		} else {
			$game_pic = $baseurl . '/game_pics/' . $game_pic;
		}	

		if ($mb['won']) {
			// you win
			$message = $lang[417]; 
			foreach ($mb['your_items'] as $yi) {
				if ($yi['winner']) {
					//$myshare = ($yi['placed_coins'] / $mb['total_placed']); // percent of share
					//$total_placed_after_commission = $mb['total_placed'] - ($mb['total_placed'] * ($mb['housecom'] / 100)); // total bet after commission has been deducted
					$my_earned = $mb['earned'];
					break;
				}
			}
		} else {
			// you lose
			$message = $lang[418]; 
			$my_earned = 0;	
		}
?>
	<li>
		<a href="<?php echo $baseurl?>/details.php?game=<?php echo base64_encode($mb['game_id'])?>" class="gametbl">
			<span class="icon"><i class="soccer">icon</i></span>
			<div class="gmimg" style="background-image:url('<?php echo $game_pic ?>');"></div>
			<div class="gmtxt">
				<p class="gid">Game ID : <?php echo $mb['game_id']?></p>
				<h3><?php echo $mb['title']?></h3>
			<div class="status row">
				<div class="col span_4">
					<span class="title coin"><?php echo $lang[259]; //Result?></span>
					<p class="result win"><?php echo $message?></p>
				</div>
				<div class="col span_4">
					<span class="title coin"><?php echo $lang[532]; //Your Placed?></span>
					<?php echo number_format($mb['your_placed'])?><span class="count">COIN</span>
				</div>
				<div class="col span_4">
					<span class="title coin"><?php echo $lang[534]; //Earned?></span>
					<?php echo $my_earned?><span class="count">COIN</span>
				</div>
			</div><!-- .status END -->

			<label><?php echo $lang[533]; //Your Item?></label>
			<ul class="betitem row betted">
			<?php
			foreach ($mb['your_items'] as $yi) {
				if ($yi['winner']) {
					//$myshare = ($yi['placed_coins'] / $mb['total_placed']);
					//$total_placed_after_commission = ($mb['total_placed'] * ($mb['housecom'] / 100)) - $mb['total_placed'];
					//$my_earned = $total_placed_after_commission * $myshare;
					$winitem = 'winitem';
				} else {
					$winitem = '';
					//$my_earned = 0;
				}
			?>
				<li class="row <?php echo $winitem?>">
					<div class="col span_9"><?php echo $yi['name']?></div>
					<div class="col span_3 txt-r"><?php echo number_format($yi['placed_coins'])?><span class="count">COIN</span></div>
				</li>
			<?php } // foreach ?>
				</li>
			</ul><!-- .betted END -->

			</div><!-- .gmtxt END -->
		</a>				
	</li><!-- gameitem END -->
<?php 
		$i++;
	} // foreach
} // if 
?>
</ul>
