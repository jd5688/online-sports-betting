<ul class="row gmlist list">
<?php
if ($my_bets['current']) {
	$i = 0;
	foreach ($my_bets['current'] as $mb) {
		if ($i > 4) { break; }
		$game_pic = $mb['image'];
		if ($game_pic == '') {
			$game_pic = $baseurl . '/images/blur-background04.jpg';
		} else {
			$game_pic = $baseurl . '/game_pics/' . $game_pic;
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
		$i++;
	} // foreach
} // if 
?>
</ul>
