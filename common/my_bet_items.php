<ul class="row gmlist list">
<?php
if ($my_bets) {
	$i = 0;
	$rec_per_page = $config['user_area_recs_per_page'];
	$curpage = 1;
	$total_pages = ceil(count($my_bets) / $rec_per_page);
	foreach ($my_bets as $mb) {
		if ($i == $rec_per_page) { 
			$curpage++;
			echo '</ul>';
			echo '<ul class="row gmlist list" id="'.$curpage.'" style="display:none">';
			$i = 0;
		}
		$game_pic = $mb['image'];
		if ($game_pic == '') {
			$game_pic = $baseurl . '/images/blur-background04.jpg';
		} else {
			$game_pic = $baseurl . '/game_pics/' . $game_pic;
		}
?>
	<?php if ($mb['won'] == "current") { ?>
	<li>
		<a href="<?php echo $baseurl?>/details.php?game=<?php echo base64_encode($mb['game_id'])?>" class="gametbl">
			<span class="icon"><i class="soccer">icon</i></span>
			<div class="gmimg" style="background-image:url('<?php echo $game_pic ?>');"></div>
			<div class="gmtxt">
				<p class="gid">Game ID : <?php echo $mb['game_id']?></p>
				<h3><?php echo $mb['title' . $suffix]?></h3>
				<div class="status row">
					<div class="col span_4">
						<span class="title time"><?php echo $lang[527];//BET end time?></span>
						<div class="timer_cd" id="<?php echo $mb['game_id']?>"><?php echo $lang[462] //Time Up?></div>
						<script language="JavaScript" type="text/javascript">
							cdTimer1();
							function cdTimer1()	{
								var	elemID = '<?php echo $mb['game_id']?>';
								var	year = <?php echo date('Y', $mb['to'])?>;
								var	month =	<?php echo date('m', $mb['to'])?>;
								var	day	= <?php echo date('d', $mb['to'])?>;
								var	hour = <?php echo date('h', $mb['to'])?>;
								var	minutes	= <?php echo date('i', $mb['to'])?>;
								var	timeLimit = new Date( year, month - 1, day, hour, minutes );
								var	timer = new CountdownTimer( elemID, timeLimit );
								timer.countDown();
							}
						</script>
					</div>
					<div class="col span_4">
						<span class="title coin"><?php echo $lang[455]; //Placed?></span>
						<?php echo number_format($mb['total_placed'])?><span class="count">COIN</span>
					</div>
					<div class="col span_4">
						<span class="title coin"><?php echo $lang[532]; //Your Placed?></span>
						<?php echo number_format($mb['your_placed'])?><span class="count">COIN</span>
					</div>
				</div><!-- .status END -->
	
				<label><?php echo $lang[533]; //Your Item?></label>
				<ul class="betitem row betted">
				<?php
				foreach ($mb['your_items'] as $yi) {
				?>
					<li class="row">
						<div class="col span_9"><?php echo $yi['name']?></div>
						<div class="col span_3 txt-r"><?php echo number_format($yi['placed_coins'])?><span class="count">COIN</span></div>
					</li>
				<?php } // foreach ?>
				</ul><!-- .betted END -->
	
			</div><!-- .gmtxt END -->
		</a>				
	</li><!-- gameitem END -->
	<?php 
	} else { 
		if ($mb['won'] == 1) {
			// you win
			$message = $lang[417]; 
			foreach ($mb['your_items'] as $yi) {
				if ($yi['winner']) {
					$myshare = ($yi['placed_coins'] / $mb['total_placed']); // percent of share
					$total_placed_after_commission = $mb['total_placed'] - ($mb['total_placed'] * ($mb['housecom'] / 100)); // total bet after commission has been deducted
					$my_earned = $total_placed_after_commission * $myshare; // the amount won
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
				<h3><?php echo $mb['title' . $suffix]?></h3>
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
					$myshare = ($yi['placed_coins'] / $mb['total_placed']);
					$total_placed_after_commission = ($mb['total_placed'] * ($mb['housecom'] / 100)) - $mb['total_placed'];
					$my_earned = $total_placed_after_commission * $myshare;
					$winitem = 'winitem';
				} else {
					$winitem = '';
					$my_earned = 0;
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
	<?php } // else if mb[won] ?>
<?php 
		$i++;
	} // foreach
} // if 
?>
</ul>
