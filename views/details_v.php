<!DOCTYPE HTML>
<html>
<?php include $basedir . '/common/header.php'; ?>
<body id="category_<?php echo $game_cat_id;?>"><div id="background"></div>

	<?php include $basedir . '/common/head.php'; ?>

	<p class="notice <?php echo $notice_class;?>" id="notice" style="display: <?php echo $notice_display?>"><?php echo $notice?></p>
	<div class="container row">
	
		<main role="main" class="row details">

			<article class="col span_8">

				<div class="box">

					<div class="row">

						<div class="gmlabel">
							<!-- <label class="new"><?php echo strtoupper($lang[255]) // NEW?></label> -->
							<?php if ($game['g_isTrial']) { ?>
							<label class="free">
								<?php echo $lang[230];?>
							</label>
							<?php }	?>
						</div>
						<?php if ($game['g_isRecommend']) { ?>
						<div class="gmlabel rec">	
							<label>
								<?php echo $lang[231];?>
							</label>						
						</div>
						<?php }	?>

						<h1><?php echo $game['g_title' . $suffix]?></h1>
						<ul class="taglist row">
							<li class="cat"><a href="<?php echo $baseurl . strtolower($display_uri);?>"><?php echo strtoupper($game['g_categories' . $suffix])?></a></li>
							<li class="tags">
							<?php
							// TAGS
							if ($tags) {
								foreach ($tags as $tag) {
									$thref = $baseurl . '/search.php?q=' . urlencode(trim($tag));
							?>
								<a href="<?php echo trim($thref)?>"><?php echo trim($tag);?></a>
							<?php
								} // foreach
							} // if $tags
							?>
							</li>
						</ul>
	
						<div class="gmimg" style="background-image:url('<?php echo $baseurl?>/game_pics/<?php echo $game['g_image']?>');"></div>
						<div class="desc">
							<p><?php echo $game['g_description'  . $suffix]?></p>
						</div>

						<div class="ftshare row">
							<div class="col span_12">
								<a class="like <?php echo ($is_liked) ? 'added' : ''?>" id="<?php echo $game['g_id']?>"><?php echo $game['g_likes']?> <?php echo $lang[284] //Like ?></a>
								<a class="bookmark <?php echo ($is_bookmarked) ? 'added' : ''?>" id="<?php echo $game['g_id']?>"><?php echo $lang[288] //Bookmark ?></a>
								<a href="#share" class="share"><?php echo $lang[287] //Share ?></a></div>
								<input type="hidden" name="cur-user-id" value="<?php echo $user_id;?>"/>
								<input type="hidden" name="cur-time" value="<?php echo $time;?>"/>
								<input type="hidden" name="cur-url" value="<?php echo $baseurl;?>"/>
								<input type="hidden" name="cur-pubkey" value="<?php echo $public_key;?>"/>
								<input type="hidden" name="cur-hash" value="<?php echo $hash;?>"/>
								<input type="hidden" name="cur-likes-<?php echo $game['g_id']?>" value="<?php echo $game['g_likes'];?>"/>
								<input type="hidden" name="cur-bookmarks-<?php echo $game['g_id']?>" value="<?php echo $game['g_bookmarks'];?>"/>
						</div><!-- .ftshare END -->

					</div>

					<?php
					// include CURRENT GAME STATUS 
					include 'details_v_gamestatus.php';
					?>

					<div class="gmstatus bd row">
						<div class="col span_6">
							<label><?php echo $lang[243] //Game Info ?></label>

							<ul class="gminfo-box row">
								<li class="row">
									<div class="col span_6">
										<?php echo strtoupper($lang[82]); //Game ID?>
									</div>
									<div class="col span_6 txt-r">
										<?php echo $game['g_id'];?>
									</div>
								</li>
								<li class="row">
									<div class="col span_6">
										<?php echo $lang[239]; // BET start time?>
									</div>
									<div class="col span_6 txt-r">
									<?php echo date('m/d/Y h:i A', $game['g_schedFrom']);?>
									</div>
								</li>
								<li class="row">
									<div class="col span_6">
										<?php echo $lang[242]; // BET end time?>
									</div>
									<div class="col span_6 txt-r">
										<?php echo date('m/d/Y h:i A', $game['g_schedTo']);?>
									</div>
								</li>
								<li class="row">
									<div class="col span_6">
										<?php echo $lang[526]; // COIN / 1BET ?>
									</div>
									<div class="col span_6 txt-r">
										<?php echo $game['g_coinPerBet'];?><span>COIN</span>
									</div>
								</li>
								<li class="row">
									<div class="col span_6">
										<?php echo $lang[100]; // House Commission ?>
									</div>
									<div class="col span_6 txt-r">
										<?php echo $game['g_houseCom'];?><span>%</span>
									</div>
								</li>
							</ul>

							<?php if (!$minimum_reached) { ?>
								<p class="req-txt">
									<?php echo str_replace('$BET_MINIMUM', $bet_minimum, $lang[228]); ?>
								</p>
							<?php }	?>

						</div><!-- .span_6 END -->

						<div class="col span_6">
							<label><?php echo $lang[229] // High Betting Users?></label>

							<?php 
							if ($high_bet_users) {
							?>
								<ul class="user-list-box row">
							<?php
								$c = 0;
								foreach($high_bet_users as $h) {
									if ($c == 3) { break; }
									if ($h['user_pic'] != '') {
										$profile_pic = $baseurl . "/images/user_pics/" . $h['user_pic'];
									} else {
										$profile_pic = $baseurl . "/images/avatar3.png";
									}
							?>
								<li class="row">
									<a href="#">
									<div class="user-panel col span_9">
										<div class="pull-left image">
											<img src="<?php echo $profile_pic?>" class="img-circle" alt="<?php echo $h['user_name']?>">
										</div>
										<div class="pull-left info">
											<h6><?php echo $h['user_name']?></h6>
											<p><?php echo $h['bet_name']?></p>
										</div>
									</div>
									<div class="col span_3">
										<?php echo $h['total_coins']?><span>COIN</span>
									</div>
									</a>
								</li>
							<?php
									$c++;
								} // foreach
							?>
								</ul>
								<div class="seemore"><a id="see_more" href="#betusers"><?php echo $lang[285]; //See more?></a></div>
							<?php
							} else { // if $high_bet_users
							?>
								<p class="nouser"><?php echo $lang[453]; //No Betting User yet?></p>
							<?php } // else ?>

						</div><!-- .span_6 END -->
					</div><!-- .status END -->


				</div>
				<div class="box">

					<h4><?php echo $lang[92]; //Match Betting?></h4>
					<div class="infobox">
						<?php echo $game['g_betInfo' . $suffix]?>
					</div>
				
					<h4><?php echo $lang[94]; //Game Condition?></h4>
					<div class="infobox">
						<?php echo $game['g_addInfo' . $suffix]?>
					</div>

				</div><!-- .box END -->
				
			</article>

			<aside id="sidebar" role="betform" class="col span_4">
				<div class="floating-widget">
				<?php 
				if ($is_closed) {
					include 'details_v_gameclosed.php';
			 	} else { // if $is_closed
			 	?>

					<?php
					if ($disable_betting OR !$user_id) {
						if (!$user_id) {
					?>
							<p><?php echo $lang[235]?></p>
							<a href="<?php echo $baseurl?>/details.php?lang=<?php echo $LANGUAGE?>&game=<?php echo base64_encode($game_id)?>#login"><?php echo $lang[236]?></a>
					<?php		
						} else {
							include 'details_v_betarea_disabled.php';
						}
					} elseif ($is_future_game) {
						include 'details_v_betarea_future.php';
					} else {
						include 'details_v_betarea.php';
					}
					?>

					<?php 
					if ($include_bet_status) {
						include 'details_v_betstatus.php';
					}
					?>

				<?php } // else ?>
				</div><!-- .floating-widget END -->
			</aside>
			
		
		</main>

		<?php if ($related_games) { ?>
		<div class="related">
			<h4><?php echo $lang[454]; //Related Game?></h4>
			<ul class="row gmlist">
			<?php
				foreach ($related_games as $d) {
				$was_closed = $d['g_isClosed'];
				$bg_image = ($d['g_image']) ? $baseurl . '/game_pics/' . $d['g_image'] : $baseurl . '/images/blur-background04.jpg';
			?>
				<li>
					<a href="<?php echo $baseurl?>/details.php?game=<?php echo base64_encode($d['g_id']);?>" class="gametbl">
						<span class="icon"><i class="<?php echo $d['g_categories']?>">icon</i></span>
						<?php if ($d['g_isRecommend' . $suffix]) { ?>
							<span class="pickup"><?php echo $lang[290]; //Recommend?></span>
						<?php } ?>
						<?php if ($d['g_isTrial']) { ?>
							<span class="free"><?php echo $lang[230]; //Recommend?></span>
						<?php } ?>
						<div class="gmimg" style="background-image:url('<?php echo $bg_image?>');"></div>
						<div class="gmtxt">
							<h3><?php echo $d['g_title' . $suffix]?></h3>
							<p class="gid"><?php echo $lang[82]; //Game ID?> : <?php echo $d['g_id']?></p>
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

					<?php if (time() < $d['g_schedTo'] AND !$d['g_isClosed']) { ?>
						<div class="bet-overlay">
							<div class="inner">
								<a href="<?php echo $baseurl?>/details.php?game=<?php echo base64_encode($d['g_id']);?>" class="btn animated fadeInUp"><?php echo $lang[528]; //Details?></span>
								<a id="<?php echo $d['g_id']?>" href="#quickbet" class="btn qbet animated fadeInUp"><?php echo $lang[286]; //Quick BET?></a>
								<input type="hidden" id="data-<?php echo $d['g_id']?>" value="<?php echo base64_encode(json_encode($d))?>"/>
							</div>
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
			} // foreach 
			?>
				</ul>
		</div>
		<?php } // if $related_games ?>
	</div>

	<script src="<?php echo $baseurl?>/js/jquery-1.11.0.min.js"></script>
    <?php 
    include $basedir . '/common/foot.php';
    include $basedir . '/common/share_modal.php';
    include $basedir . '/common/bet_status_modal_result.php';
    include $basedir . '/common/winner_users_modal.php';
    include $basedir . '/common/bet_users_modal.php';
    include $basedir . '/common/quick_bet_modal.php';

    if ($include_bet_modal) {
    	include $basedir . '/common/betnow_modal.php';
    }
    ?>

    <script src="<?php echo $baseurl?>/js/jquery.remodal.js"></script>
	<script type="text/javascript" src="<?php echo $baseurl?>/js/main_frontend.js"></script>
	
<?php /*
	<script src="<?php echo $baseurl?>/js/snap.svg-min.js"></script>
	<script src="<?php echo $baseurl?>/js/pizza.min.js"></script>
*/ ?>
	<script src='<?php echo $baseurl?>/js/jquery.base64.js'></script>
	<script src="<?php echo $baseurl ?>/js/raphael-min.js"></script>       
	<script src="<?php echo $baseurl ?>/js/morris.min.js" type="text/javascript"></script>
	<script>
		$(document).ready(function() {
			var uid = "<?php echo $user_id?>";
			var game_is_closed = "<?php echo $is_closed;?>";
			var user_may_earn = '<?php echo json_encode($user_may_earn)?>';
			user_may_earn = $.parseJSON(user_may_earn);
			var item_has_value = 0;
			var radio_has_value = 0;
			var refresh_rate = "<?php echo $config['realtime_refreshrate'];?>";
			var loop = false;
			var break_loop = false;
			var from_window = false;
			var ctr = 0;
			
			// REALTIME GAME STATS
			if (game_is_closed === "") {
					$(window).focus(function() {
						$(window).focus(); // forcing the browser to focus on window if active
						clearInterval(loop); // prevent two or more instances of loop
					    loop = setInterval(function() {
					    		ctr++;
								do_realtime();
							}, refresh_rate);
					});
					$(window).blur(function() {
						if ($(document.body).hasClass('remodal_lock')) {
				   			$(window).focus(); // if modal is active, force focus on parent window
			   			}
						break_loop = true;
						setTimeout(function(){
							if ($('div#betstatus-window.remodal').is(":visible")) {
								break_loop = false;
								from_window = true;
							} else {
						   		if (from_window) {
						   			// came from pizza remodal graph and other remodals
						   			from_window = false;
						   			break_loop = false;
						   		} else {

							   		if ($(document.body).hasClass('remodal_lock')) {
							   			// other remodal is opened
						   				from_window = true;
						   				break_loop = true;
						   			}
						   		}
						   	}
						}, 1500);	
					});

					do_realtime = function() {
						if (break_loop) {
							ctr = 0;
							break_loop = false;
					    	clearInterval(loop);
					    	return;
					    }

						var game_id = "<?php echo $game_id;?>";
						var comm = "<?php echo $game['g_houseCom']?>";
						var t = "<?php echo $time;?>";
				        var url = "<?php echo $baseurl ?>";
				        var key = "<?php echo $public_key?>";
				        var hash = "<?php echo $hash?>";
				        url = url + "/ajax/betstatus-realtime.php";
				        var uri = 'hash=' + hash + '&public=' + key + '&t=' + t;
				        uri += '&game_id=' + game_id + '&comm=' + comm;
		
				        $.ajax({
				            type: 'POST',
				            url: url,
				            beforeSend: function(x) {
				                if(x && x.overrideMimeType) {
				                    x.overrideMimeType("application/json;charset=UTF-8");
				                }
				            },
				            data: uri,
				            success: function(data){
				            	if (data.status === 'closed') {
					            	window.location.replace("<?php echo $baseurl . '/details.php?lang=' . $LANGUAGE;?>&game=<?php echo base64_encode($game_id);?>");
				            	}
				                if (data.status === 'success') {
				                	var info_per_bet_item = data.data[0];
				                	user_may_earn = data.data[1];
				                	var newobj = [];
				                	var newobj2 = [];
				                	var html = '';
				                	var gt_coins = 0;
				                	var el, el2, el3, el4;
				                	var tuwb = 0; // total users who bet
				                	var i = 0;
				                	var j = 0;
				                	var may_win = 0;
				                	if (info_per_bet_item[0].total_users_who_bet !== 0) {
										$.each( info_per_bet_item, function( ind, obj ) {
											var placed_coins = 0;
											var bi_id = false;
											var ratio = 0;
											var item_name = '';
											$.each( obj, function( key, val ) {
												placed_coins = 0;
												if (key === 'bi_id' && val) {
													bi_id = val;
													el = 'm-li-c-' + bi_id.toString();
													el2 = 'm-li-u-' + bi_id.toString();
													el2_2 = 'm2-li-u-' + bi_id.toString();
													el3 = 'm-td-c-' + bi_id.toString();
													el4 = 'm-td-u-' + bi_id.toString();
													el5 = 'm-td-r-' + bi_id.toString();
													if (typeof user_may_earn[bi_id] !== "undefined" && typeof user_may_earn[bi_id][uid] !== "undefined") {
														may_win = user_may_earn.at_stake / user_may_earn[bi_id].total_item_bet_share * user_may_earn[bi_id][uid].his_share;
														$('strong#' + bi_id).html(may_win.toFixed(2));
													};
												}
												if (key === 'placed_coins') {
													//val = Math.floor((Math.random() * 100) + 1); // random data for testing
													if (val) {
														item_name = $('#m-div-c-' + bi_id).html();
														newobj[i] = { 'label' : item_name, 'value' : val };
														i += 1;
													}
													placed_coins = val;
													gt_coins += val;
													html = placed_coins.toString() + '<span class="count">COIN</span>';
													$('#' + el).html(html);
													$('#' + el3).html(placed_coins);
												}
												if (key === 'bet_users_total') {
													//val = Math.floor((Math.random() * 100) + 1); // random data for testing
													if (val) {
														item_name = $('#m-div-u-' + bi_id).html();
														newobj2[j] = { 'label' : item_name, 'value' : val };
														j += 1;
													}
													html = val.toString() + '<span class="count">USERS</span>';
													$('#' + el2).html(html);
													$('#' + el2_2).html(html);
													$('#' + el4).html(val);
												}
												if (key === 'total_users_who_bet') {
													tuwb = val;
												}
												if (key === 'ratio') {
													ratio = val.toFixed(2);
													$('#' + el5).html(ratio + '<span>%</span>');
												}
	
											});
										});
										$('#m-totalbox-coin').html('<p>' + gt_coins.toString() + '<span class="count">COIN</span></p>');
										$('#m-total-coin').html(gt_coins.toString());
										$('#m-totalbox-users').html('<p>' + tuwb.toString() + '<span class="count">USERS</span></p>');
										$('#m2-totalbox-users').html('<p>' + tuwb.toString() + '<span class="count">USERS</span></p>');
										$('#m-total-users').html(tuwb.toString());
										
										//Pizza.init('ul[data-pie-id=coindonut]', { data: newobj });
										//Pizza.init('ul[data-pie-id=userdonut]', { data: newobj2 });
										// COIN donut
										$('#coindonut').html('');
										new Morris.Donut({
											element: 'coindonut',
											data: newobj,
											labelColor: '#2B9AF3',
											colors: [
											'rgba(104, 147, 234, 1)',
											'rgba(104, 147, 234, .5)',
											'rgba(104, 147, 234, .75)'
											],
											resize: 'true',
											formatter: function (x) { return x + " COIN"}
										});

										$('#userdonut').html('');
										// users donut
										new Morris.Donut({
											element: 'userdonut',
											/*
											data: [
											{label: "Win Game", value: 0},
											{label: "Lose Game", value: 0},
											{label: "Canceled", value: 0},

											], */
											data: newobj2,
											labelColor: '#2B9AF3',
											colors: [
											'rgba(104, 147, 234, 1)',
											'rgba(104, 147, 234, .5)',
											'rgba(104, 147, 234, .75)'
											],
											resize: 'true',
											formatter: function (x) { return x + " Users"}
										});
									}
									//Pizza.init(document.body);
									
				                }
				            }
				            
				        });
					} // do_realtime	
						
			} // if game is NOT closed
			// /REALTIME GAME STATS

			// game end time
			var	elemID = 'gameTimer';
			var	year = <?php echo date('Y', $game_timer)?>;
			var	month =	<?php echo date('m', $game_timer)?>;
			var	day	= <?php echo date('d', $game_timer)?>;;
			var	hour = <?php echo date('H', $game_timer)?>;
			var	minutes	= <?php echo date('i', $game_timer)?>;
			var	timeLimit = new Date( year, month - 1, day, hour, minutes );
			var	timer = new CountdownTimer( elemID, timeLimit );
			timer.countDown();

			// pagination for winner_users_modal.php
			var wm_total_pages = <?php echo (isset($wm_total_pages)) ? $wm_total_pages : 0?>;
			if (wm_total_pages !== 0) {
		    	if (wm_total_pages === 1) {
		    		//$('div#win_seemore').hide();
		    	}
		    	$('a#win_next_page').click(function(e) {
		    		e.preventDefault();
		    		var id = parseInt($(e.currentTarget).attr("name"));
		    		$('span#win' + id).fadeIn();
		    		if (id === wm_total_pages) {
		    			$('div#win_seemore').hide();
		    		} else {
		    			$(e.currentTarget).attr("name", id + 1);
		    		}
		    	})
		    }

		    //pagination for bet_users_modal.php
		    var hb_total_pages = <?php echo (isset($hb_total_pages)) ? $hb_total_pages : 0?>;
			if (hb_total_pages !== 0) {
		    	if (hb_total_pages === 1) {
		    		$('div#hb_seemore').hide();
		    	}
		    	$('a#hb_next_page').click(function(e) {
		    		e.preventDefault();
		    		var id = parseInt($(e.currentTarget).attr("name"));
		    		console.log(id);
		    		$('span#hb' + id).fadeIn();
		    		if (id === hb_total_pages) {
		    			$('div#hb_seemore').hide();
		    		} else {
		    			$(e.currentTarget).attr("name", id + 1);
		    		}
		    	})
		    }

			$('#bet-now-button').click(function (e) {
				e.preventDefault();
				if (!$('#bet-now-button').hasClass('disabled')) {
					$('form[name="bet-now-form"]').submit();
				}
			})

			$('input[name=custom-bet]').click(function() {
				$('input#bet_radio7').click();	
				$('input[name=custom-bet]').focus();
			})
			
			$('input[name="item_radio"], input[name="bet_radio"]').click(function(e) {
				YouMayEarn(e);
			});
			
			YouMayEarn = function(e) {
				var clicked = $(e.currentTarget).attr("name");
				var bet_radio_id = $(e.currentTarget).attr("id");
				var custom_coin = $.isNumeric($('input[name=custom-bet]').val()) ? $('input[name=custom-bet]').val() : 0;
				if (typeof bet_radio_id === "undefined") {
					if (e.validity.valid === false) { 
						if ($.isNumeric($('input[name=custom-bet]').val()) === false) {
							$('#bet-now-button').addClass('disabled');
							return;
						} else {
							custom_coin = $('input[name=custom-bet]').attr('max');
							$('input[name=custom-bet]').val($('input[name=custom-bet]').attr('max'));
							//$('#bet-now-button').addClass('disabled');
						}
					}
					$('input#bet_radio7').val(custom_coin);
				}

				if (clicked === 'item_radio') {
					radio_has_value = 1;
				}

				if (clicked === 'bet_radio') {
					$('input[name=custom-bet]').val('');
					item_has_value = 1;
				}

				if (item_has_value && radio_has_value) {
					var you_may_win = 0;
					var bi_id = $('input[name="item_radio"]:checked').val();
					var coins = parseInt($('input[name="bet_radio"]:checked').val());
					var new_asnc = 0;
					var new_as = 0;
					var new_tic = 0;
					var new_tis = 0;
					var new_hc = 0;
					var new_hs = 0;
					$('#bet-now-button').removeClass("disabled");
					if (user_may_earn.at_stake !== 0) {
						new_asnc = coins + user_may_earn.at_stake_no_comm; // new at_stake_no_com
						new_as = new_asnc - ((parseInt(user_may_earn.house_commission) / 100) * new_asnc); // new at_stake
						new_tic = user_may_earn[bi_id].total_item_coins + coins; // new Total_item_coins
						new_tis = (new_tic / new_asnc) * 100; // new total_item_bet_share;
						if (typeof user_may_earn[bi_id][uid] !== "undefined") {			
							new_hc = user_may_earn[bi_id][uid].his_coins + coins; // new his_coins
						} else {
							new_hc = coins; // new his_coins
						}
						new_hs = (new_hc / new_asnc) * 100;
						//you_may_win = user_may_earn.at_stake / user_may_earn[bi_id].total_item_bet_share * user_may_earn[bi_id][uid].his_share;
						you_may_win = (new_as / new_tis) * new_hs;
					} else {
						new_asnc = coins + user_may_earn.at_stake_no_comm; // new at_stake_no_com
						new_as = new_asnc - ((parseInt(user_may_earn.house_commission) / 100) * new_asnc); // new at_stake
						new_tic = coins; // new Total_item_coins
						new_tis = (new_tic / new_asnc) * 100; // new total_item_bet_share;
						new_hc = coins;
						new_hs = (new_hc / new_asnc) * 100;
						//you_may_win = user_may_earn.at_stake / user_may_earn[bi_id].total_item_bet_share * user_may_earn[bi_id][uid].his_share;
						you_may_win = (new_as / new_tis) * new_hs;
					}
					window.user_may_earn = user_may_earn;
					if (isNaN(you_may_win)) {
						you_may_win = 0;
					}
					
					$('span#you_may_earn').html(you_may_win.toFixed(2));
				}
				return;
			};
			

			// USER CONFIRMING THE BET
			$('#confirm-bet').click(function (e) {
				e.preventDefault();
				var item_radio = "<?php echo $item_radio?>";
				var bet_radio = "<?php echo $bet_radio?>";
				var notify_radio = "<?php echo $notify_radio?>";
				var game_id = "<?php echo $game_id?>";
				var is_trial = "<?php echo $game['g_isTrial']?>";

				var t = "<?php echo $time;?>";
		        var url = "<?php echo $baseurl ?>";
		        var key = "<?php echo $public_key?>";
		        var hash = "<?php echo $hash?>";
		        url = url + "/ajax/addbet.php";
		        var uri = 'hash=' + hash + '&public=' + key + '&t=' + t;
		        uri += '&game_id=' + game_id + '&item=' + item_radio + '&bet=' + bet_radio + '&notify=' + notify_radio + '&istrial=' + is_trial;

		        $.ajax({
		            type: 'POST',
		            url: url,
		            beforeSend: function(x) {
		                if(x && x.overrideMimeType) {
		                    x.overrideMimeType("application/json;charset=UTF-8");
		                }
		            },
		            data: uri,
		            success: function(data){
		                if (data.error === '0') {
		                	window.location.replace("<?php echo $baseurl . '/details.php?lang=' . $LANGUAGE;?>&game=<?php echo base64_encode($game_id);?>");
		                }
		            }
		            
		        });
			})	
			// /USER CONFIRMING THE BET
		})
	</script>

	<!-- JS for page top scroll -->
	<script>
	    $(document).ready(function() {
	        $(window).scroll(function() {
	            if ($(this).scrollTop() > 200) {
	                $('#pagetop').fadeIn(200);
	            } else {
	                $('#pagetop').fadeOut(200);
	            }
	        });
	        $('#pagetop').click(function(event) {
	            event.preventDefault();
	             
	            $('html, body').animate({scrollTop: 0}, 300);
	        })
	    });
	</script>


	<script type='text/javascript'>
	$(function () {
	
	    $(".item_radio input[type='radio']").change(function(){
	    	var id = $(this).attr('id');
	        if($(this).is(":checked")){
	            $('.item_radio .cbxbd').removeClass("c_on");
	            $(this).parent().addClass("c_on");

	            $('label#bi-label-radio').removeClass('c_on');
	            $('label[for="' + id + '"]').addClass("c_on");

	        }else{

	            $(this).parent().removeClass("c_on");


	            $('label[for="' + id + '"]').removeClass("c_on");

	        }
	    });
	
	    $(".bet_radio input[type='radio']").change(function(){
	        if($(this).is(":checked")){
	            $('.bet_radio .cbxbd').removeClass("c_on");
	            $(this).parent().addClass("c_on");
	        }else{
	            $(this).parent().removeClass("c_on");
	        }
	    });
	
	});
	</script>
	

	<!-- JS for Graph -->
	<script type='text/javascript'>
		$(document).ready(function() {
		  //Pizza.init('ul[data-pie-id=coindonut]');
		  //Pizza.init('ul[data-pie-id=userdonut]');
		  //Pizza.init(document.body);

		  	// COIN donut
		  	var piec = '<?php echo json_encode($morris_pie_coins);?>';
			var data = [];
			var i = 0;
			piec = $.parseJSON(piec);
			for (prop in piec) {
			    if (!piec.hasOwnProperty(prop)) {
			        //The current property is not a direct property of p
			        continue;
			    }
			    data[i] = piec[prop];
				i += 1;
			}

			new Morris.Donut({
				element: 'coindonut',
				/*
				data: [
				{label: "Win Game", value: 0},
				{label: "Lose Game", value: 0},
				{label: "Canceled", value: 0},

				], */
				data: data,
				labelColor: '#2B9AF3',
				colors: [
				'rgba(104, 147, 234, 1)',
				'rgba(104, 147, 234, .5)',
				'rgba(104, 147, 234, .75)'
				],
				resize: 'true',
				formatter: function (x) { return x + " COIN"}
			});

			// users donut
			var pieu = '<?php echo json_encode($morris_pie_users);?>';
			var data2 = [];
			i = 0;
			pieu = $.parseJSON(pieu);
			for (prop in pieu) {
			    if (!pieu.hasOwnProperty(prop)) {
			        //The current property is not a direct property of p
			        continue;
			    }
			    data2[i] = pieu[prop];
				i += 1;
			}

			new Morris.Donut({
				element: 'userdonut',
				/*
				data: [
				{label: "Win Game", value: 0},
				{label: "Lose Game", value: 0},
				{label: "Canceled", value: 0},

				], */
				data: data2,
				labelColor: '#2B9AF3',
				colors: [
				'rgba(104, 147, 234, 1)',
				'rgba(104, 147, 234, .5)',
				'rgba(104, 147, 234, .75)'
				],
				resize: 'true',
				formatter: function (x) { return x + " Users"}
			});

			if ($('#userdonut2').length === 1) {
				// users2 donut
				new Morris.Donut({
					element: 'userdonut2',
					/*
					data: [
					{label: "Win Game", value: 0},
					{label: "Lose Game", value: 0},
					{label: "Canceled", value: 0},
	
					], */
					data: data2,
					labelColor: '#2B9AF3',
					colors: [
					'rgba(104, 147, 234, 1)',
					'rgba(104, 147, 234, .5)',
					'rgba(104, 147, 234, .75)'
					],
					resize: 'true',
					formatter: function (x) { return x + " Users"}
				});
			}

			$('a[href=#quickbet]').click(function(e) {
				var g_id = $(e.currentTarget).attr('id'); // get the game id of the clicked element
				var u_id = "<?php echo $user_id?>";
				$('#bm-select-item').html('');
				$('#bm-bet-item').html('');
				// user needs to be logged in to bet
				if (u_id === "") {
					// user is not logged in
					// open the login modal
					window.location.replace('#login');
				}

				// function for adding comma to thousand digits
				$.fn.digits = function(){ 
				    return this.each(function(){ 
				        $(this).text( $(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") ); 
				    })
				}

				$.base64.utf8encode = true;
				var ft = 'data-' + g_id.toString();
				var data = $('#' + ft).val(); // this is the game data
				var user_coins = <?php echo $user_coins;?>;
				var bet_coin = 0;
				var bet_item = '';
				data = $.base64('decode', data);
				data = $.parseJSON(data); // convert to object readable by js
				var coin_per_bet = parseInt(data.g_coinPerBet);
				var is_trial = parseInt(data.g_isTrial);
				if (is_trial) {
					$('#pre-set-bets').hide(); // this is a trial game
					$('#this-is-a-trial-game').attr('value', '1'); // this is a trial game
				}
				
				// populate quick_bet_modal with values based on the clicked element
				$('#bm-gid').html(data.g_id); // game id
				$('#bm-title').html(data.g_title); // game title
				// populate prebet area
				$('input#bet_radio1').attr('value', coin_per_bet);
				$('#bet_radio1_v').html(coin_per_bet);
				$('input#bet_radio2').attr('value', coin_per_bet * 2);
				$('#bet_radio2_v').html(coin_per_bet * 2);
				$('input#bet_radio3').attr('value', coin_per_bet * 3);
				$('#bet_radio3_v').html(coin_per_bet * 3);
				$('input#bet_radio4').attr('value', coin_per_bet * 4);
				$('#bet_radio4_v').html(coin_per_bet * 4);
				$('input#bet_radio5').attr('value', coin_per_bet * 5);
				$('#bet_radio5_v').html(coin_per_bet * 5);
				$('input#bet_radio6').attr('value', coin_per_bet * 10);
				$('#bet_radio6_v').html(coin_per_bet * 10);

				// loop the bet items
				$.each( data.bet_items, function( key, value ) {
					$('#bm-select-item').append('<label class="cbxbd"><input type="radio" name="item_radio" id="item_radio1" value="' + value + '">' + value + '</label>');
				});

				// the function that will add 'checked' to the clicked bet item
				$(".item_radio input[type='radio']").change(function(){
			        if($(this).is(":checked")){
			            $('.item_radio .cbxbd').removeClass("c_on");
			            $(this).parent().addClass("c_on");
			        }else{
			            $(this).parent().removeClass("c_on");
			        }
			    });

			    $('#bm-user-coins').html(user_coins).digits();
			    $('#bm-user-coins').append('<span>COIN</span>');
			    $('#bm-coin-balance').html(user_coins).digits(); // convert ex: 1000 to 1,000
			    $('#bm-coin-balance').append('<span>COIN</span>');

			    $('input[name=item_radio]').click(function(e) {
			    	bet_item = $(e.currentTarget).val();
			    	$('#bm-bet-item').html(bet_item);
			    })

			    $('input[name=bet_radio]').click(function(e) {
			    	bet_coin = $(e.currentTarget).val();
			    	$('#bm-bet-coins').html(bet_coin);
			    	$('#bm-bet-coin-info').html(bet_coin).digits();
			    	$('#bm-bet-coin-info').append('<span>COIN</span>');

			    	var coin_balance = user_coins - bet_coin;
			    	$('#bm-coin-balance').html(coin_balance).digits();
			    	$('#bm-coin-balance').append('<span>COIN</span>');
			    })

				return true;
			})

			// when the quick bet was submitted
			$('#submit-quick-bet-button').click(function() {
				var bet_item = $('#bm-bet-item').html();
				var is_trial = parseInt($('#this-is-a-trial-game').val());
				var bet_coins = $('#bm-bet-coins').html();
				if (bet_item === "" || parseInt(bet_coins) === 0) {
					if (is_trial !== 1) {
						return false;
					}
				}
				var item_radio = "<?php echo $item_radio?>";
				var bet_radio = "<?php echo $bet_radio?>";
				var notify_radio = "<?php echo $notify_radio?>";
				var game_id = $('#bm-gid').html();

				var t = "<?php echo $time;?>";
		        var url = "<?php echo $baseurl ?>";
		        var key = "<?php echo $public_key?>";
		        var hash = "<?php echo $hash?>";
		        url = url + "/ajax/addbet-quick.php";
		        var uri = 'hash=' + hash + '&public=' + key + '&t=' + t;
		        uri += '&game_id=' + game_id + '&item=' + bet_item + '&bet=' + bet_coins + '&istrial=' + is_trial;

		        var redir = '<?php echo $baseurl ?>/details.php?game=' + $.base64('encode', game_id);

		        $.ajax({
		            type: 'POST',
		            url: url,
		            beforeSend: function(x) {
		                if(x && x.overrideMimeType) {
		                    x.overrideMimeType("application/json;charset=UTF-8");
		                }
		            },
		            data: uri,
		            success: function(data){
		                if (data.error === '0') {
		                	window.location.replace(redir);
		                }
		            }
		            
		        });
				return false;
			})

		});
	</script>
	<!-- JS for Sidebar floating -->
	<script type='text/javascript'>
		$(function () {
		    $('.floating-widget').floatingWidget();
		});
		
		(function ($) {
		    $.fn.floatingWidget = function () {
		        return this.each(function () {
		            var $this             = $(this),
		                $parent           = $this.offsetParent(),
		                $window           = $(window),
		                top               = $this.offset().top - parseFloat($this.css('marginTop').replace(/auto/, 0)),
		                bottom            = $parent.offset().top + $parent.height() - $this.outerHeight(true),
		                floatingClass     = 'floating',
		                pinnedBottomClass = 'pinned-bottom';
		            if ($parent.height() > $this.outerHeight(true)) {
		                $window.scroll(function () {
		                    var y = $window.scrollTop();
		                    if (y > top) {
		                        $this.addClass(floatingClass);
		                        if (y > bottom) {
		                            $this.removeClass(floatingClass).addClass(pinnedBottomClass);
		                        } else {
		                            $this.removeClass(pinnedBottomClass);
		                        }
		                    } else {
		                        $this.removeClass(floatingClass);
		                    }
		                });
		            }
		        });
		    };
		})(jQuery);
	</script>

</body>

</html>