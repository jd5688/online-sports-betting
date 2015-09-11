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
						<h4 class="title"><?php echo $lang[466];?></h4>
						<p class="desc"><?php echo $lang[467];?></p>
					</div>
					
					<div class="inner">

						<?php
						if (!$account_is_complete) { 
							include $basedir . '/common/dash_alart.php'; 
						};
						?>

						<?php include $basedir . '/common/dash_highlights.php'; ?>


						<div class="activity row">
							<div class="col span_6">

								<div id="bettinggame">
									<div class="title_box_s clr">
										<h5><?php echo $lang[468];?></h5>
										<a href="<?php echo $baseurl ?>/joinedgame.php" class="viewall"><?php echo $lang[414];?></a>
									</div>
									<?php include $basedir . '/common/dash_current_item.php'; ?>
								</div><!-- #bettinggame END  -->

								<div id="twitternews">
									<h5><?php echo $lang[471];?></h5>
									<!-- Twitter Widget  -->
<!--
									<a class="twitter-timeline" href="https://twitter.com/ikkoryuph" data-widget-id="409997429870559232">Tweets by @ikkoryuph</a>
	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
-->
									<!-- Twitter Widget END  -->

								</div><!-- #twitternews END  -->


							</div><!-- .col.span_6 END  -->

							<div class="col span_6">
								<div id="gameresult">
									<div class="title_box_s clr">
										<h5><?php echo $lang[469];?></h5>
										<a href="<?php echo $baseurl ?>/joinedgame.php" class="viewall"><?php echo $lang[414];?></a>
									</div>
									<?php include $basedir . '/common/dash_result_item.php'; ?>
								</div><!-- #gameresult END  -->


								<div id="timeline">
									<h5><?php echo $lang[470];?></h5>
									<?php include $basedir . '/common/dash_timeline.php'; ?>
								</div><!-- #timeline END  -->

							</div><!-- .col.span_6 END  -->
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

    <!-- Morris.js charts -->
	<script src="<?php echo $baseurl ?>/js/raphael-min.js"></script>       
	<script src="<?php echo $baseurl ?>/js/morris.min.js" type="text/javascript"></script>
	<script type='text/javascript'>
		$(document).ready(function() {
			var graph = '<?php echo json_encode($graph);?>';
			var data = [];
			var i = 0;
			graph = $.parseJSON(graph);
			for (prop in graph) {
			    if (!graph.hasOwnProperty(prop)) {
			        //The current property is not a direct property of p
			        continue;
			    }
			    data[i] = graph[prop];
				i += 1;
			}
			new Morris.Line({
			  // ID of the element in which to draw the chart.
			  element: 'myfirstchart',
			  // Chart data records -- each entry in this array corresponds to a point on
			  // the chart.
			  data: data,
			  // The name of the data record attribute that contains x-values.
			  xkey: 'month',
			  // A list of names of data record attributes that contain y-values.
			  ykeys: ['value'],
			  // Labels for the ykeys -- will be displayed when you hover over the
			  // chart.
			  resize: 'true',
			  labels: ['COIN']
			});

			var pie = '<?php echo json_encode($pie);?>';
			var data2 = [];
			i = 0;
			pie = $.parseJSON(pie);
			for (prop in pie) {
			    if (!pie.hasOwnProperty(prop)) {
			        //The current property is not a direct property of p
			        continue;
			    }
			    data2[i] = pie[prop];
				i += 1;
			}

			new Morris.Donut({
				element: 'donutchart',
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
				formatter: function (x) { return x + "%"}
			});

		});
	</script>


</body>

</html>