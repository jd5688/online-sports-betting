<?php 
require_once('include/config.php');
require_once($basedir . "/include/functions.php");
require_once($basedir . "/include/user_functions.php");

if (!$user_id) { 
	header('Location: ' . $baseurl . '#login');
	exit;
}

$joinedgamemenu='active';
$categories = getCategories();
// get all data for pie graph
if (checkCacheExists('all_coin_deals.txt')) {
	$all_coin_deals = getCoinDealsFromCache();
} else {
	$all_coin_deals = getCoinDeals();
}

$coin_deals = getUserCoinDeals($user_id, $all_coin_deals);
$fromto = getAllRange($coin_deals);
$from = $fromto['from'];
$to = $fromto['to'];
$ret = winLoseRatio($user_id, $from, $to, $coin_deals);

$pie = $ret['pie'];
$win_lose = $ret['data'];

$filter = (isset($_GET['f'])) ? $_GET['f'] : 'all'; // default to all
$cat = (isset($_GET['c'])) ? $_GET['c'] : 'all'; // default to all
$sort = (isset($_GET['s'])) ? $_GET['s'] : 'latest'; // default to newest

$temp = allMyGameItems($user_id, $filter, $cat, $sort);

$my_bets = $temp['data'];
$bets_per_category = $temp['bets_per_category'];
$total_bets = count($my_bets);

//echo '<pre>';
//print_r($bet_per_category);
//exit;

if ($filter == 'all') {
	$filter_label = $lang[438];
} elseif ($filter == 'won') {
	$filter_label = $lang[439];
} elseif ($filter == 'lose') {
	$filter_label = $lang[440];
} elseif ($filter == 'judgement') {
	$filter_label = $lang[441];
} elseif ($filter == 'cancelled') {
	$filter_label = $lang[442];
} else {
	$filter_label = $lang[438]; // all
}

$cat_label = ($cat == 'all') ? $lang[280] : $cat;

if ($sort == 'latest') {
	$sort_label = $lang[443];
} elseif ($sort == 'oldest') {
	$sort_label = $lang[444];
} elseif ($sort == 'mostearned') {
	$sort_label = $lang[445];
} elseif ($sort == 'mostbet') {
	$sort_label = $lang[446];
} else {
	$sort_label = $lang[443];
}
?>
<!DOCTYPE HTML>
<html>
<?php include $basedir . '/common/header.php'; ?>
<body>

	<?php include $basedir . '/common/head.php'; ?>


	<div class="container row">
	
		<?php include $basedir . '/common/myheadmenu.php'; ?>

		<main role="main" class="row gutters mypage">

			<article id="dashboard" class="col span_12">

				<div class="box">
					<div class="title_box">
						<h4 class="title"><?php echo $lang[437]; //Game Stats?></h4>
						<p class="desc"><?php echo $lang[436]?></p>
					</div>

					<div class="inner">

						<div class="filter row">
							<div id="filter_menu" class="col span_10">
			
								<div class="fil_game">
									<label><?php echo $lang[448]; //Filter?></label>
									<p><?php echo $filter_label?></p>
									<ul>
										<li class="header"><?php echo $lang[449];//Filter by?></li>
										<li><a href="<?php echo $baseurl?>/joinedgame.php?f=all&c=<?php echo $cat?>&s=<?php echo $sort?>"><?php echo $lang[438]; // All Games?></a></li>
										<li><a href="<?php echo $baseurl?>/joinedgame.php?f=won&c=<?php echo $cat?>&s=<?php echo $sort?>"><?php echo $lang[439]; // Won Games?></a></li>
										<li><a href="<?php echo $baseurl?>/joinedgame.php?f=lose&c=<?php echo $cat?>&s=<?php echo $sort?>"><?php echo $lang[440]; // Lose Games?></a></li>
										<li><a href="<?php echo $baseurl?>/joinedgame.php?f=judgement&c=<?php echo $cat?>&s=<?php echo $sort?>"><?php echo $lang[441]; // Judgment Games?></a></li>
										<li><a href="<?php echo $baseurl?>/joinedgame.php?f=cancelled&c=<?php echo $cat?>&s=<?php echo $sort?>"><?php echo $lang[442]; // Cancelled Games?></a></li>
									</ul>
								</div><!-- .fil_game END -->

								<div class="fil_category">
									<label><?php echo $lang[66]; //Category?></label>
									<p><?php echo $cat_label?></p>
									<ul>
										<li class="header"><?php echo $lang[289]; //Choose a Sports?></li>
										<li><a href="<?php echo $baseurl?>/joinedgame.php?f=<?php echo $filter?>&c=all&s=<?php echo $sort?>"><?php echo $lang[280]; //All Sports?></a></li>
										<?php foreach ($categories as $categ) { ?>
										<li><a href="<?php echo $baseurl?>/joinedgame.php?f=<?php echo $filter?>&c=<?php echo $categ['sc_name']?>&s=<?php echo $sort?>"><?php echo $categ['sc_name' . $suffix]?></a></li>
										<?php } ?>
									</ul>
			
								</div><!-- .fil_category END -->

								<div class="fil_sort">
									<label><?php echo $lang[450]; //Sorting?></label>
									<p><?php echo $sort_label?></p>
									<ul>
										<li class="header"><?php echo $lang[451]; //by sorting?></li>
										<li><a href="<?php echo $baseurl?>/joinedgame.php?f=<?php echo $filter?>&c=<?php echo $cat?>&s=latest"><?php echo $lang[443]; // latest games ?></a></li>
										<li><a href="<?php echo $baseurl?>/joinedgame.php?f=<?php echo $filter?>&c=<?php echo $cat?>&s=oldest"><?php echo $lang[444]; // Oldest games?></a></li>
										<li><a href="<?php echo $baseurl?>/joinedgame.php?f=<?php echo $filter?>&c=<?php echo $cat?>&s=mostearned"><?php echo $lang[445]; // Most you earned?></a></li>
										<li><a href="<?php echo $baseurl?>/joinedgame.php?f=<?php echo $filter?>&c=<?php echo $cat?>&s=mostbet"><?php echo $lang[446]; // Most you betted?></a></li>
									</ul>
			
								</div><!-- .fil_sort END -->
			
							</div>
							<div class="col span_2">
								<h6 class="resultCount"><span id="myTargetElement" class="num"></span> <?php echo $lang[76]; //games?></h6>
							</div>
						</div><!-- .filter END -->


						<div class="activity row">

							<div class="col span_8 joinedgame">

								<?php include $basedir . '/common/my_bet_items.php'; ?>
								<?php //include $basedir . '/common/join_won_game_item.php'; ?>
								<?php //include $basedir . '/common/join_lose_game_item.php'; ?>

								<div class="seemore"><a name="seemore" id="2" href=""><?php echo $lang[285]; //See more?></a></div>

							</div><!-- .col.span_8 END  -->

							<div class="col span_4 sidebar_data">

								<div class="title_box_s clr">
									<h5><?php echo $lang[452]; //Your winning percentage?></h5>
								</div>

								<div class="chartarea">
									<div id="donutchart"></div>
									<ul>
									<li class="row">
											<div class="col span_9"><?php echo $lang[411];//Win Game?></div>
											<div class="col span_3 txt-r"><?php echo $win_lose['wonpie']?></div>
										</li>
									<li class="row">
											<div class="col span_9"><?php echo $lang[412];//Lose Game?></div>
											<div class="col span_3 txt-r"><?php echo $win_lose['losepie']?></div>
										</li>
									<li class="row">
											<div class="col span_9"><?php echo $lang[413]; //Cancelled Game?></div>
											<div class="col span_3 txt-r"><?php echo $win_lose['cancelpie']?></div>
										</li>
									</ul>
								</div><!-- .chartarea END  -->


								<div class="title_box_s clr">
									<h5><?php echo $lang[447]; //Most Bet Categories?></h5>
								</div>
								
								<?php if ($bets_per_category) { ?>
								<ul class="timeline cat">
									<?php foreach ($bets_per_category as $key => $value) { ?>
									<li>
									    <a href="#">
									        <div class="pull-left">
									            <img src="<?php echo $baseurl ?>/images/blur-background04.jpg" class="img-circle" alt="Spots icon image">
									        </div>
									        <h6><?php echo $key?></h6>
									        <span class="num"><?php echo $value?><span class="count"><?php echo $lang[76]; //games?></span>
									    </a>
									</li>
									<?php } // foreach?>
								</ul>
								<?php } // if $bet_per_category?>


							</div><!-- .col.span_4 END  -->
						</div><!-- .activity END  -->


					</div><!-- .inner END  -->
				</div><!-- .box END  -->

			</article>

		</main>

	</div>

	<script src="<?php echo $baseurl ?>/js/jquery-1.11.0.min.js"></script>
    <?php include $basedir . '/common/foot.php'; ?>

    <script src="<?php echo $baseurl ?>/js/jquery.remodal.js"></script>
	<script type="text/javascript" src="<?php echo $baseurl ?>/js/main_frontend.js"></script>


	<!-- Slimscroll for Header popup menu -->
	<script type="text/javascript" src="<?php echo $baseurl ?>/js/jquery.slimscroll.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.notifications-menu > .dropdown-menu > li .menu').slimScroll({height: '200px'});
		});
	</script>


	<script src="<?php echo $baseurl ?>/js/countUp.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			var total_bets = <?php echo $total_bets;?>;
			// create instance
			var demo = new countUp("myTargetElement", 0, total_bets, 0, 2);
			window.onload = function() {
			// fire animation
			demo.start();
			}
		});
	</script>

	<!-- Dropdown MENU *** Need a Fix *** -->
	<script>
	    $(document).ready(function() {
	    	// pagination
	    	var total_pages = <?php echo $total_pages?>;
	    	if (total_pages === 1) {
	    		$('div.seemore').hide();
	    	}
	    	$('a[name=seemore]').click(function(e) {
	    		e.preventDefault();
	    		var id = parseInt($(e.currentTarget).attr("id"));
	    		$('ul#' + id).fadeIn();
	    		if (id === total_pages) {
	    			$('div.seemore').hide();
	    		} else {
	    			$(e.currentTarget).attr("id", id + 1);
	    		}
	    	})

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

    <!-- Morris.js charts -->
	<script src="<?php echo $baseurl ?>/js/raphael-min.js"></script>       
	<script src="<?php echo $baseurl ?>/js/morris.min.js" type="text/javascript"></script>
	<script type='text/javascript'>
		$(document).ready(function() {
			var pie = '<?php echo json_encode($pie);?>';
			var data = [];
			i = 0;
			pie = $.parseJSON(pie);
			for (prop in pie) {
			    if (!pie.hasOwnProperty(prop)) {
			        //The current property is not a direct property of p
			        continue;
			    }
			    data[i] = pie[prop];
				i += 1;
			}
			new Morris.Donut({
				element: 'donutchart',
				data: data,
				labelColor: '#2B9AF3',
				colors: [
				'rgba(104, 147, 234, 1)',
				'rgba(104, 147, 234, .5)',
				'rgba(104, 147, 234, .75)'
				],
				resize: 'true',
				formatter: function (x) { return x + "%"}
			});

		});
	</script>



</body>

</html>