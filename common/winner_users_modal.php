<?php if ($top_winners) { ?>
<div id="winnerusers-window" class="remodal" data-remodal-id="winnerusers">
	<div class="modal-head">
		<div class="row">
			<div class="col span_12">
				<h2><?php echo count($top_winners);?> <?php echo $lang[555]; //WINNERS?></h2>
			</div>
		</div><!-- /.row -->
	</div><!-- /.modal-head -->
	<div class="modal-body">
		<div class="row">

			<div class="col span_12">

				<h6 class="label"><?php echo $lang[175]; //Username?></h6>
				<ul class="user-list-box row">
				<span>
				<?php
				$i = 0;
				$wm_rec_per_page = $config['modal_users_recs_per_page'];
				$wm_curpage = 1;
				$wm_total_pages = ceil(count($top_winners) / $wm_rec_per_page);
				foreach ($top_winners as $tw) {
					if ($i == $wm_rec_per_page) { 
						$wm_curpage++;
						echo '</span>';
						echo '<span id="win'.$wm_curpage.'" style="display:none">';
						$i = 0;
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
						<div class="user-panel col span_9">
							<div class="pull-left image">
								<img src="<?php echo $user_pic?>" class="img-circle" alt="Username">
							</div>
							<div class="pull-left info">
								<h6><?php echo $tw['user_name']?></h6>
								<p><?php echo $tw['bet_name']?></p>
							</div>
						</div>
						<div class="col span_3">
							<?php echo number_format($total_win_coins, 2)?><span>COIN</span>
						</div>
						</a>
					</li>
				<?php
					$i++;
				} // foreach
				?>
				</span>
					<li class="row">
						<div class="seemore" id="win_seemore">
							<a id="win_next_page" name="2" href=""><?php echo $lang[285]; //See more?></a></a>
						</div>
					</li>

				</ul>


			</div>
		</div><!-- /.row -->
	</div><!-- /.modal-body -->
	<div class="modal-foot">
		<div class="row">
			<div class="col span_12 txt-r">
				<a href="" class="btn cancel"><?php echo $lang[276]; //Close?></a></a>
			</div>
		</div><!-- /.row -->
	</div><!-- /.modal-foot -->
</div><!-- /#betconfirm-window -->
<?php } ?>