<?php if ($high_bet_users) { ?>
<div id="betusers-window" class="remodal" data-remodal-id="betusers">
	<div class="modal-head">
		<div class="row">
			<div class="col span_12">
				<h2><?php echo $lang[547]; //CURRENT BETTING USERS?></h2>
			</div>
		</div><!-- /.row -->
	</div><!-- /.modal-head -->
	<div class="modal-body">
		<div class="row">

			<div class="col span_6 graphbox">

				<div class="grapharea">
					<div id="userdonut2" style="height: 150px;"></div>
					<div class="totalbox" id="m2-totalbox-users"><p><?php echo $total_joined;?><span class="count">USERS</span></p></div>
				</div>

				<h6 class="label"><?php echo $lang[548]; //Betting item users?></h6>
				<ul data-pie-id="userdonut" data-options='{"donut":"true", "donut_inner_ratio":"0.5"}'>
				<?php
				if ($info_per_bet_item) {
					foreach ($info_per_bet_item as $bi) {
						if ($bi['is_winner']) {
							$classwinitem = 'winitem';
						} else {
							$classwinitem = '';
						}
						$bi_bet_users_total = ($bi['bet_users_total']) ? $bi['bet_users_total'] : 0;
				?>
					<li class="row <?php echo $classwinitem?>" data-value="<?php echo $bi_bet_users_total?>" data-text="<?php echo $bet_items2[$bi['bi_id']];?> {{percent}}">
						<div class="col span_9" id="m2-div-u-<?php echo $bi['bi_id']?>"><?php echo $bet_items2[$bi['bi_id']];?></div>
						<div class="col span_3 txt-r" id="m2-li-u-<?php echo $bi['bi_id']?>"><?php echo $bi_bet_users_total?><span class="count">USERS</span></div>
					</li>
				<?php 
					} // foreach
				} else {
				?>
					<li class="row" data-value="0" data-text="-- {{percent}}">
						<div class="col span_9">--</div>
						<div class="col span_3 txt-r">0<span class="count">USERS</span></div>
					</li>
				<?php } ?>	
				</ul>



			</div>

			<div class="col span_6 betuserbox">

				<h6 class="label"><?php echo count($high_bet_users);?> <?php echo $lang[549]; //Betting users?></h6>
				<ul class="user-list-box row">
				<span>
				<?php
				$i = 0;
				$hb_rec_per_page = $config['modal_users_recs_per_page'];
				$hb_curpage = 1;
				$hb_total_pages = ceil(count($high_bet_users) / $hb_rec_per_page);
				foreach ($high_bet_users as $hb) {
					if ($i == $hb_rec_per_page) { 
						$hb_curpage++;
						echo '</span>';
						echo '<span id="hb'.$hb_curpage.'" style="display:none">';
						$i = 0;
					}
					$user_pic = $baseurl . "/images/user_pics/" . $hb['user_pic'];
					if (!file_exists($user_pic)) {
						$user_pic = $baseurl . "/images/avatar3.png";
					}
				?>
					<li class="row">
						<a href="#">
						<div class="user-panel col span_9">
							<div class="pull-left image">
								<img src="<?php echo $user_pic?>" class="img-circle" alt="<?php echo $hb['user_name']?>">
							</div>
							<div class="pull-left info">
								<h6><?php echo $hb['user_name']?></h6>
								<p><?php echo $hb['bet_name']?></p>
							</div>
						</div>
						<div class="col span_3">
							<?php echo $hb['total_coins']?><span>COIN</span>
						</div>
						</a>
					</li>
				<?php
					$i++;
				} // foreach
				?>
				</span>
				<li class="row">
					<div class="seemore" id="hb_seemore">
						<a id="hb_next_page" name="2" href=""><?php echo $lang[285]; //SEE MORE?></a>
					</div>
				</li>
				</ul>


			</div>
		</div><!-- /.row -->
	</div><!-- /.modal-body -->
	<div class="modal-foot">
		<div class="row">
			<div class="col span_12 txt-r">
				<a href="" class="btn cancel"><?php echo $lang[276]; //Close?></a>
			</div>
		</div><!-- /.row -->
	</div><!-- /.modal-foot -->
</div><!-- /#betconfirm-window -->
<?php } // if high_bet_users ?>