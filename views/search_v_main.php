<main role="main" class="row">
		
	<div class="filter col span_12">
		<div id="filter_menu" class="col span_10">

			<div class="fil_category">
				<label><?php echo $lang[66]; //Category?></label>
				<p id="cat-label"><?php echo $cat_label;?></p>
				<ul>
					<li class="header"><?php echo $lang[289]; //Choose a Sports?></li>
					<li><a name="a-cat" href="<?php echo $baseurl;?>?q=<?php echo $q;?>&cat=all&sort=<?php echo $sort;?>&page=<?php echo $page?>"><?php echo $lang[280]; // All Sports?></a></li>
				<?php
				if ($categories) {
					foreach ($categories as $categ) {
				?>
					<li><a name="a-cat" href="<?php echo $baseurl;?>?q=<?php echo $q;?>&cat=<?php echo strtolower($categ['sc_name'])?>&sort=<?php echo $sort;?>&page=<?php echo $page?>"><?php echo $categ['sc_name']?></a></li>
				<?php
					} // foreach
				} // if
				?>
				</ul>

			</div><!-- .fil_category END -->
			<div class="fil_sort">
				<label><?php echo $lang[450]; //Sorting?></label>
				<p id="sort-label"><?php echo $sort_label;?></p>
				<ul>
					<li class="header"><?php echo $lang[291]; //sort by?></li>
					<li><a name="a-sort" href="<?php echo $baseurl;?>?q=<?php echo $q;?>&cat=<?php echo $cat;?>&sort=end&page=<?php echo $page?>"><?php echo $lang[281]; //End Time?></a></li>
					<li><a name="a-sort" href="<?php echo $baseurl;?>?q=<?php echo $q;?>&cat=<?php echo $cat;?>&sort=coin&page=<?php echo $page?>"><?php echo $lang[282]; //Placed COIN?></a></li>
					<li><a name="a-sort" href="<?php echo $baseurl;?>?q=<?php echo $q;?>&cat=<?php echo $cat;?>&sort=new&page=<?php echo $page?>"><?php echo $lang[283]; //New Game?></a></li>
					<li><a name="a-sort" href="<?php echo $baseurl;?>?q=<?php echo $q;?>&cat=<?php echo $cat;?>&sort=like&page=<?php echo $page?>"><?php echo $lang[535]; //Like?></a></li>
				</ul>

			</div><!-- .fil_sort END -->

		</div>
		<div class="col span_2">
			<h6 class="resultCount"><span id="myTargetElement" class="num"></span> <?php echo $lang[76]; //games?></h6>
		</div>
	</div><!-- .filter END -->

	<article class="col span_12">
	<?php
	$total_pages = 0;
	if ($data) {
	?>
		<ul class="row gmlist">
		<?php
		$i = 0;
		$rec_per_page = $config['list_area_recs_per_page'];
		$curpage = 1;
		$was_closed = 0;
		$total_pages = ceil(count($data) / $rec_per_page);
		foreach ($data as $d) {
			$is_live_data = false;
			$was_closed = $d['g_isClosed'];
			if ($i == $rec_per_page) { 
				if ($curpage >= $page) {
					$style = 'style="display:none"';
				} else {
					$style = '';
				}
				$curpage++;
				echo '</ul>';
				echo '<ul class="row gmlist" id="l'.$curpage.'" ' . $style . '>';
				$i = 0;
			}

			if (time() < $d['g_schedTo'] AND time() > $d['g_schedFrom'] AND !$d['g_isClosed']) {
				$is_live_data = true;
			}
			$bg_image = ($d['g_image']) ? $baseurl . '/game_pics/' . $d['g_image'] : $baseurl . '/images/blur-background04.jpg';
		?>
			<li>
				<a href="<?php echo $baseurl?>/details.php?game=<?php echo base64_encode($d['g_id']);?>" class="gametbl">
					<span class="icon"><i class="<?php echo $d['g_categories']?>">icon</i></span>
					<?php if ($d['g_isRecommend']) { ?>
						<span class="pickup"><?php echo $lang[290]; //Recommend?></span>
					<?php } ?>
					<?php if ($d['g_isTrial']) { ?>
						<span class="free"><?php echo $lang[230]; //Recommend?></span>
					<?php } ?>
					<div class="gmimg" style="background-image:url('<?php echo $bg_image?>');"></div>
					<div class="gmtxt">
						<h3><?php echo $d['g_title' . $suffix]?></h3>
						<p class="gid">Game ID : <?php echo $d['g_id']?></p>
						<p class="desc"><?php echo $d['g_description' . $suffix]?></p>
						<ul class="betitem row">
						<?php foreach ($d['bet_items'] as $bi) { ?>
							<li><?php echo $bi?></li>
						<?php } ?>
						</ul>
					</div><!-- .gmtxt END -->

					<div class="status row">
						<div class="col span_6">
							<span class="title time"><?php echo $lang[527] //BET end time?></span>
							<div class="timer_cd" id="<?php echo $d['g_id']?>"><?php echo $lang[462] //Time Up?></div>
							<?php if (!$was_closed) { ?>
							<script language="JavaScript" type="text/javascript">
								cdTimer1();
								function cdTimer1()	{
									var	elemID = '<?php echo $d['g_id']?>';
									var	year = <?php echo date('Y', $d['g_schedTo']);?>;
									var	month =	<?php echo date('m', $d['g_schedTo']);?>;
									var	day	= <?php echo date('d', $d['g_schedTo']);?>;
									var	hour = <?php echo date('H', $d['g_schedTo']);?>;
									var	minutes	= <?php echo date('i', $d['g_schedTo']);?>;
									var	timeLimit = new Date( year, month - 1, day, hour, minutes );
									var	timer = new CountdownTimer( elemID, timeLimit );
									timer.countDown();
								}
							</script>
							<?php } ?>
						</div>
						<div class="col span_6">
							<span class="title coin"><?php echo $lang[455]; //Placed?></span>
							<?php echo number_format($d['total_bets'])?><span class="count">COIN</span>
						</div>
					</div><!-- .status END -->

					<div class="barbase row">
						<div class="betvol itm-1" style="width: 30%"></div>
						<div class="betvol itm-2" style="width: 55%"></div>
						<div class="betvol itm-3" style="width: 15%"></div>
					</div><!-- .barbase END -->
				</a>

				<?php if ($is_live_data AND time() < $d['g_schedTo']) { ?>
					<div class="bet-overlay">
						<a href="<?php echo $baseurl?>/details.php?game=<?php echo base64_encode($d['g_id']);?>" class="btn animated fadeInUp"><?php echo $lang[528]; //BET NOW?></span>
						<a id="<?php echo $d['g_id']?>" href="#quickbet" class="btn qbet animated fadeInUp"><?php echo $lang[286]; //Quick BET?></a>
						<input type="hidden" id="data-<?php echo $d['g_id']?>" value="<?php echo base64_encode(json_encode($d))?>"/>
					</div>
				<?php } ?>
				
				<div class="ftshare row">
					<div class="col span_8">
						<a class="like <?php echo (isset($my_likes[$d['g_id']])) ? 'added' : ''?>" id="<?php echo $d['g_id']?>"><?php echo $d['g_likes'];?> <?php echo ucfirst($lang[284]); // Like?></a>
						<a class="bookmark <?php echo (isset($my_bookmarks[$d['g_id']])) ? 'added' : ''?>" id="<?php echo $d['g_id']?>"><?php echo $lang[288]; //Bookmark?></a>
						<input type="hidden" name="cur-likes-<?php echo $d['g_id']?>" value="<?php echo $d['g_likes'];?>"/>
						<input type="hidden" name="cur-bookmarks-<?php echo $d['g_id']?>" value="<?php echo $d['g_bookmarks'];?>"/>
					</div>
					<div class="col span_4"><a href="#share" class="share"><?php echo $lang[287]; //Share?></a></div>
				</div><!-- .ftshare END -->

			</li><!-- gameitem END -->
		<?php 
			$i++;
		} // foreach 
		?>
		</ul>
		<div class="seemore"><a id="see-more-button" name="<?php echo $page + 1; ?>" href="<?php echo $baseurl;?>/search.php?q=<?php echo urlencode($q);?>&cat=<?php echo $cat;?>&sort=<?php echo $sort;?>&page="><?php echo $lang[285]; //See more?></a></div>
	<?php } // if $data ?>
	</article>

</main>