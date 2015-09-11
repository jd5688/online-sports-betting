<?php if ($user_won AND $user_bettings) { ?>
	<div class="mybetstatus won">
		<h3 class="title"><?php echo $lang[256]?><span><?php echo $user_congratulations_text?></span></h3>
		<div class="inner">
		
			<h4><?php echo $lang[258] // Your bet per item?></h4>
			<?php
			$total_bet_amount = 0;
			if ($bet_items) {
				foreach ($bet_items as $bi) {
					$total_bet_amount += $user_bettings[$bi['bi_id']]['tot_coins'];
					$user_bet_coins = ($user_bettings[$bi['bi_id']]['tot_coins']) ? $user_bettings[$bi['bi_id']]['tot_coins'] : 0;
					if ($bi['bi_winner']) {
						$classwinitem = 'winitem';
					} else {
						$classwinitem = '';
					}
			?>
			    <div class="row <?php echo $classwinitem;?>">
			        <div class="col span_8"><?php echo $bi['bi_description' . $suffix]?></div>
			        <div class="col span_4 txt-r"><?php echo $user_bet_coins?> <span>COIN</span></div>
			        <div class="col span_12 mayearn"></div>
			    </div>
			<?php
				} // foreach
			} else {
			?>
			    <div class="row winitem">
			        <div class="col span_8">No Bet Items</div>
			        <div class="col span_4 txt-r"></div>
			        <div class="col span_12 mayearn"></div>
			    </div>
			<?php } // else ?>

		    <div class="row totalbet">
		        <div class="col span_12">
		        <p>You won <strong><?php echo $user_won;?> </strong><span>COIN</span></p>
		        </div>
		    </div>

		    <div class="row result-box">
				<h4><?php echo $lang[259]?></h4>
		        <div class="col span_12">

				<ul class="row">
					<li class="row">
						<div class="col span_8">
							<?php echo $lang[260]?>
						</div>
						<div class="col span_4 txt-r">
							<?php echo number_format($game_placed_coins)?><span>COIN</span>
						</div>
					</li>
					<li class="row">
						<div class="col span_8">
							<?php echo $lang[261]?>
						</div>
						<div class="col span_4 txt-r">
							<?php echo number_format($win_item_placed_coins)?> <span>COIN</span>
						</div>
					</li>
					<li class="row">
						<div class="col span_8">
							<?php echo $lang[262]?>
						</div>
						<div class="col span_4 txt-r">
							<?php echo $user_may_earn[$bi_id_of_winner][$user_id]['his_coins'];?> <span>COIN</span>
						</div>
					</li>
					<li class="row">
						<div class="col span_8">
							<?php echo $lang[100]?>
						</div>
						<div class="col span_4 txt-r">
							<?php echo $game['g_houseCom']?><span>%</span>
						</div>
					</li>
					<li class="row">
						<div class="col span_8">
							<?php echo $lang[263]?>
						</div>
						<div class="col span_4 txt-r">
							<?php echo number_format($user_won, 2)?> <span>COIN</span>
						</div>
					</li>
				</ul>

			        </div>
		    </div>

		</div><!-- .inner END -->
	</div><!-- .mybetstatus END -->
<?php } elseif (!$user_won AND $user_bettings) { // if $user_won ?>
	<div class="mybetstatus lose">
		<h3 class="title"><?php echo $lang[265]; //So sorry!!!?><span><?php echo $lang[266]; //Unfortunately, you lost this game. ?> </span></h3>
		<div class="inner">
			<h4><?php echo $lang[553]; //Your betted item?></h4>
			<?php
			$total_bet_amount = 0;
			if ($bet_items) {
				foreach ($bet_items as $bi) {
					$total_bet_amount += $user_bettings[$bi['bi_id']]['tot_coins'];
					$user_bet_coins = ($user_bettings[$bi['bi_id']]['tot_coins']) ? $user_bettings[$bi['bi_id']]['tot_coins'] : 0;
					if ($bi['bi_winner']) {
						$classwinitem = 'winitem';
					} else {
						$classwinitem = '';
					}
			?>
		    <div class="row">
		        <div class="col span_8"><?php echo $bi['bi_description' . $suffix]?></div>
		        <div class="col span_4 txt-r"><?php echo $user_bet_coins?> <span>COIN</span></div>
		        <div class="col span_12 mayearn"></div>
		    </div>
		    <?php
		    	} // foreach
		    } // else
		    ?>

		    <div class="row result-box">
				<h4><?php echo $lang[259]; //Result?></h4>
		        <div class="col span_12">

				<ul class="row">
					<li class="row">
						<div class="col span_8">
							<?php echo $lang[264]; //Your Placed COIN?>
						</div>
						<div class="col span_4 txt-r">
							<?php echo $total_bet_amount;?><span>COIN</span>
						</div>
					</li>
					<li class="row">
						<div class="col span_8">
							<?php echo $lang[263]; //Your Earned COIN?>
						</div>
						<div class="col span_4 txt-r">
							0<span>COIN</span>
						</div>
					</li>
				</ul>

			        </div>
		    </div>

		</div><!-- .inner END -->
	</div><!-- .mybetstatus END -->
<?php } // else ?>

<?php if ($top_winners) { ?>
<div class="winnerbox">
	<div class="inner">

	<h4><?php echo $lang[267]; // top 10 winners ?></h4>
		<ul class="user-list-box row">
		<?php
		$i = 0;
		foreach ($top_winners as $tw) {
			if ($i == 10) {
				// show only 10
				break;
			}
			$this_user_id = $tw['user_id'];
			$total_win_coins = ($user_may_earn['at_stake'] / $user_may_earn[$bi_id_of_winner]['total_item_bet_share']) * $user_may_earn[$bi_id_of_winner][$this_user_id]['his_share'];
			$user_pic = $baseurl . "/images/user_pics/" . $tw['user_pic'];
			if (!file_exists($user_pic)) {
				$user_pic = $baseurl . "/images/avatar3.png";
			}
		?>
			<li class="row">
				<a href="#">
				<div class="user-panel col span_8">
					<div class="pull-left image">
						<img src="<?php echo $user_pic?>" class="img-circle" alt="<?php echo $tw['user_name']?>">
					</div>
					<div class="pull-left info">
						<h6><?php echo $tw['user_name']?></h6>
						<p><?php echo $tw['bet_name']?></p>
					</div>
				</div>
				<div class="col span_4">
					<?php echo number_format($total_win_coins, 2)?><span>COIN</span>
				</div>
				</a>
			</li>
		<?php
			$i++;
		} // foreach
		?>
		</ul>
		<?php if (count($top_winners) > $config['modal_users_recs_per_page']) { ?>
			<div class="seemore"><a id="see_more" href="#winnerusers"><?php echo $lang[285]; //See more?></a></div>
		<?php } ?>
</div><!-- .inner END -->
</div><!-- .winnerbox END -->
<?php } // if top winners ?>