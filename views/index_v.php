<!DOCTYPE HTML>
<html>
<?php include $basedir . '/common/header.php'; ?>
<body>

	<?php include $basedir . '/common/head.php'; ?>

	<?php if (!$user_id) { ?>
<!--
		<div class="intro">
			<div class="container row">
			MAIN BANNER AREA
			</div>
		</div>
--><!-- .intro END -->
	<?php } ?>
	<?php 
	//if (!$user_id) {
		//include $basedir . '/common/regisit_area.php'; 
	//}
	?>

	<div class="listmenu">
		<div class="container row">
			<ul class="row">
				<li id="li-live" <?php echo ($q == 'live') ? 'class="selected"' : '';?>><a name="a-query" href="<?php echo $baseurl;?>?q=live&cat=<?php echo $cat;?>&sort=<?php echo $sort;?>"><?php echo $lang[402];//Live In-Play?></a></li>
				<li id="li-results" <?php echo ($q == 'results') ? 'class="selected"' : '';?>><a name="a-query" href="<?php echo $baseurl;?>?q=results&cat=<?php echo $cat;?>&sort=<?php echo $sort;?>"><?php echo $lang[400];//Results?></a></li>
				<li id="li-upcoming" <?php echo ($q == 'upcoming') ? 'class="selected"' : '';?>><a name="a-query" href="<?php echo $baseurl;?>?q=upcoming&cat=<?php echo $cat;?>&sort=<?php echo $sort;?>"><?php echo $lang[401];//Upcoming?></a></li>
			<?php if ($user_id) { ?>
				<li <?php echo ($q == 'yourgame') ? 'class="selected"' : '';?>><a name="a-query" href="<?php echo $baseurl;?>?q=yourgame&cat=<?php echo $cat;?>&sort=<?php echo $sort;?>"><?php echo $lang[403];//Your Game?></a></li>
			<?php } ?>
			</ul>
		</div>
	</div><!-- .listmenu END -->
	
	<div class="container row">
		<input type="hidden" name="cur-user-id" value="<?php echo $user_id;?>"/>
		<input type="hidden" name="cur-time" value="<?php echo $time;?>"/>
		<input type="hidden" name="cur-url" value="<?php echo $baseurl;?>"/>
		<input type="hidden" name="cur-pubkey" value="<?php echo $public_key;?>"/>
		<input type="hidden" name="cur-hash" value="<?php echo $hash;?>"/>
		<span id="main-loop"><?php include $basedir . '/views/index_v_main.php';?></span>
	</div>
	<script src="<?php echo $baseurl?>/js/jquery-1.11.0.min.js"></script>
	<script src='<?php echo $baseurl?>/js/jquery.base64.js'></script>
    <?php include $basedir . '/common/foot.php'; ?>
    <?php include $basedir . '/common/share_modal.php'; ?>
    <?php include $basedir . '/common/quick_bet_modal.php'; ?>

    <script src="<?php echo $baseurl?>/js/jquery.remodal.js"></script>
	<script type="text/javascript" src="<?php echo $baseurl?>/js/main_frontend.js"></script>

	<script src="<?php echo $baseurl?>/js/countUp.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			var total_pages = <?php echo $total_pages?>;
			var page = <?php echo $page?>;
	    	if (total_pages <= page) {
	    		$('div.seemore').hide();
	    	}
	    	$('a#see-more-button').click(function(e) {
	    		e.preventDefault();
	    		var id = parseInt($(e.currentTarget).attr("name"));
	    		var url = $(e.currentTarget).attr("href") + id;
	    		$('ul#l' + id + '.row.gmlist').fadeIn();
	    		if (id === total_pages) {
	    			$('div.seemore').hide();
	    		} else {
	    			$(e.currentTarget).attr("name", id + 1);
	    		}
	    		window.history.pushState("", "", url);
	    	});

			// create instance
			var demo = new countUp("myTargetElement", 0, <?php echo $total_data?>, 0, 2);
			window.onload = function() {
				// fire animation
				demo.start();
			}

			$("#quick-register-form").bind("submit", quickRegisterUser);
			function quickRegisterUser(e) {
				e.preventDefault();
				e.target.checkValidity();
				var useremail = $('#qr-email').val();
				var username = $('#qr-username').val();
				var t = "<?php echo $time;?>";
				var url = "<?php echo $baseurl ?>";
				var key = "<?php echo $public_key?>";
				var hash = "<?php echo $hash?>";
				url = url + "/ajax/register.php";
				var uri = 'hash=' + hash + '&public=' + key + '&t=' + t;
				uri += '&email=' + useremail + '&uname=' + username;

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
						if (data.status === 'success') {
							$('#qr-form-cont').hide();
							$('#qr-success-message').show();
							//window.location.replace(came_from);
						} else {
							$('#qr-email').val('');
							$('#qr-username').val('');
							$('#qrwelcome').hide();
							$('#qrmessage').html(data.status);
							$('#qrmessage').show();
							setTimeout(function() {
								$('#qrmessage').hide();
								$('#qrmessage').html('');
								$('#qrwelcome').show();
							}, 2000);
						}
					}
					
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
				// populate quick_bet_modal with values based on the clicked element
				$('#bm-gid').html(data.g_id); // game id
				$('#bm-title').html(data.g_title); // game title
				
				if (is_trial) {
					$('#pre-set-bets').hide(); // this is a trial game
					$('#this-is-a-trial-game').attr('value', '1'); // this is a trial game
				}
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
		                	window.location.replace("<?php echo $baseurl . '?q=' . $q . '&cat=' . $cat . '&sort=' . $sort . '&page=' . $page;?>");
		                }
		            }
		            
		        });
				return false;
			})
			/*
			$('a[name=a-cat], a[name=a-sort], a[name=a-query], #see-more').click(function(e) {
				e.preventDefault();

				var clicked = $(e.currentTarget);
				var url = clicked.attr('href');
				var uri = '';
				var clicked_id = clicked.parent().attr('id');
				if (clicked_id === 'li-live' || clicked_id === 'li-results' || clicked_id === 'li-upcoming') {
					$('#li-live').removeClass("selected");
					$('#li-results').removeClass("selected");
					$('#li-upcoming').removeClass("selected");
					clicked.parent().addClass("selected");
				}
				url = url.replace("?", "/ajax/listpage.php?");
				urlx = url.split("?");
				url = urlx[0];
				uri = urlx[1];

		        var t = "<?php echo $time;?>";
		        var key = "<?php echo $public_key?>";
		        var hash = "<?php echo $hash?>";
		        uri += '&hash=' + hash + '&public=' + key + '&t=' + t;

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
		                $('#main-loop').html(data.html);
		                var demo = new countUp("myTargetElement", 0, data.total_data, 0, 2);
		                $('#main-loop').ready(function() {
		                	demo.start();
		                })

		                var over_flg;
						$('#filter_menu p').click(function() { 
							if ($(this).attr('class') == 'selected') {
							  // メニュー非表示
							  $(this).removeClass('selected').next('ul').removeClass('open');
							} else {
							  // 表示しているメニューを閉じる
							  $('#filter_menu p').removeClass('selected');
							  $('#filter_menu ul').removeClass('open');
							
							  // メニュー表示
							  $(this).addClass('selected').next('ul').addClass('open');
							}    
							});
							
							// マウスカーソルがメニュー上/メニュー外
							$('#filter_menu p,#filter_menu ul').hover(function(){
							over_flg = true;
							}, function(){
							over_flg = false;
							});  
							
							// メニュー領域外をクリックしたらメニューを閉じる
							$('body').click(function() {
							if (over_flg == false) {
							  $('#filter_menu p').removeClass('selected');
							  $('#filter_menu ul').removeClass('open');
							}
						});
		            }
		            
		        });
			})
			*/
		});
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
	        if($(this).is(":checked")){
	            $('.item_radio .cbxbd').removeClass("c_on");
	            $(this).parent().addClass("c_on");
	        }else{
	            $(this).parent().removeClass("c_on");
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

	    $(".notify input[type='checkbox']").change(function(){
	        if($(this).is(":checked")){
	            $('.notify .cbxbd').removeClass("c_on");
	            $(this).parent().addClass("c_on");
	        }else{
	            $(this).parent().removeClass("c_on");
	        }
	    });

	    $(".keeplogin input[type='checkbox']").change(function(){
	        if($(this).is(":checked")){
	            $('.keeplogin .cbxbd').removeClass("c_on");
	            $(this).parent().addClass("c_on");
	        }else{
	            $(this).parent().removeClass("c_on");
	        }
	    });

	
	});
	</script>
	

	<!-- Dropdown MENU *** Need a Fix *** -->
	<script>
	    $(document).ready(function() {
	    	var over_flg;
			$('#filter_menu p').click(function() { 
				if ($(this).attr('class') == 'selected') {
				  // メニュー非表示
				  $(this).removeClass('selected').next('ul').removeClass('open');
				} else {
				  // 表示しているメニューを閉じる
				  $('#filter_menu p').removeClass('selected');
				  $('#filter_menu ul').removeClass('open');
				
				  // メニュー表示
				  $(this).addClass('selected').next('ul').addClass('open');
				}    
				});
				
				// マウスカーソルがメニュー上/メニュー外
				$('#filter_menu p,#filter_menu ul').hover(function(){
				over_flg = true;
				}, function(){
				over_flg = false;
				});  
				
				// メニュー領域外をクリックしたらメニューを閉じる
				$('body').click(function() {
				if (over_flg == false) {
				  $('#filter_menu p').removeClass('selected');
				  $('#filter_menu ul').removeClass('open');
				}
			});

	    });
	</script>

</body>

</html>