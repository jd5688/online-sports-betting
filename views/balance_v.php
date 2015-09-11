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
						<h4 class="title"><?php echo $lang[296]; //Balance?></h4>
						<p class="desc"><?php echo $lang[390];?></p>
					</div>

					<div class="inner">
	
						<div class="activity row">
		
							<div class="col span_8">

								<form class="date_range row" action="<?php echo $baseurl?>/balance.php" method="get">
									<div class="form-group col span_5">
										<label for="expireYear"><?php echo $lang[70]; //Start Date?></label>
				
											<select name="fy" title="年">
											<?php
											$std = 2013;
											$ed = date('Y') + 1;
											for ($i = $std; $i < $ed; $i++) {
													if ($i == $from_y) {
														$sel = 'selected="selected"';
													} else {
														$sel = '';
													}
											?>
											    <option value="<?php echo $i?>" <?php echo $sel?>><?php echo $i ?></option>
											<?php } ?>
											</select>
				
											<select name="fm" title="月">
											    <option value="01" <?php echo ($from_m == '01') ? 'selected="selected"': ''?>>01</option>
											    <option value="02" <?php echo ($from_m == '02') ? 'selected="selected"' : ''?>>02</option>
											    <option value="03" <?php echo ($from_m == '03') ? 'selected="selected"' : ''?>>03</option>
											    <option value="04" <?php echo ($from_m == '04') ? 'selected="selected"' : ''?>>04</option>
											    <option value="05" <?php echo ($from_m == '05') ? 'selected="selected"' : ''?>>05</option>
											    <option value="06" <?php echo ($from_m == '06') ? 'selected="selected"' : ''?>>06</option>
											    <option value="07" <?php echo ($from_m == '07') ? 'selected="selected"' : ''?>>07</option>
											    <option value="08" <?php echo ($from_m == '08') ? 'selected="selected"' : ''?>>08</option>
											    <option value="09" <?php echo ($from_m == '09') ? 'selected="selected"' : ''?>>09</option>
											    <option value="10" <?php echo ($from_m == '10') ? 'selected="selected"' : ''?>>10</option>
											    <option value="11" <?php echo ($from_m == '11') ? 'selected="selected"' : ''?>>11</option>
											    <option value="12" <?php echo ($from_m == '12') ? 'selected="selected"' : ''?>>12</option>
											</select>
				
											<select name="fd" title="日">
											    <option value="01" <?php echo ($from_d == '01') ? 'selected="selected"': ''?>>01</option>
											    <option value="02" <?php echo ($from_d == '02') ? 'selected="selected"': ''?>>02</option>
											    <option value="03" <?php echo ($from_d == '03') ? 'selected="selected"': ''?>>03</option>
											    <option value="04" <?php echo ($from_d == '04') ? 'selected="selected"': ''?>>04</option>
											    <option value="05" <?php echo ($from_d == '05') ? 'selected="selected"': ''?>>05</option>
											    <option value="06" <?php echo ($from_d == '06') ? 'selected="selected"': ''?>>06</option>
											    <option value="07" <?php echo ($from_d == '07') ? 'selected="selected"': ''?>>07</option>
											    <option value="08" <?php echo ($from_d == '08') ? 'selected="selected"': ''?>>08</option>
											    <option value="09" <?php echo ($from_d == '09') ? 'selected="selected"': ''?>>09</option>
											    <option value="10" <?php echo ($from_d == '10') ? 'selected="selected"': ''?>>10</option>
											    <option value="11" <?php echo ($from_d == '11') ? 'selected="selected"': ''?>>11</option>
											    <option value="12" <?php echo ($from_d == '12') ? 'selected="selected"': ''?>>12</option>
											    <option value="13" <?php echo ($from_d == '13') ? 'selected="selected"': ''?>>13</option>
											    <option value="14" <?php echo ($from_d == '14') ? 'selected="selected"': ''?>>14</option>
											    <option value="15" <?php echo ($from_d == '15') ? 'selected="selected"': ''?>>15</option>
											    <option value="16" <?php echo ($from_d == '16') ? 'selected="selected"': ''?>>16</option>
											    <option value="17" <?php echo ($from_d == '17') ? 'selected="selected"': ''?>>17</option>
											    <option value="18" <?php echo ($from_d == '18') ? 'selected="selected"': ''?>>18</option>
											    <option value="19" <?php echo ($from_d == '19') ? 'selected="selected"': ''?>>19</option>
											    <option value="20" <?php echo ($from_d == '20') ? 'selected="selected"': ''?>>20</option>
											    <option value="21" <?php echo ($from_d == '21') ? 'selected="selected"': ''?>>21</option>
											    <option value="22" <?php echo ($from_d == '22') ? 'selected="selected"': ''?>>22</option>
											    <option value="23" <?php echo ($from_d == '23') ? 'selected="selected"': ''?>>23</option>
											    <option value="24" <?php echo ($from_d == '24') ? 'selected="selected"': ''?>>24</option>
											    <option value="25" <?php echo ($from_d == '25') ? 'selected="selected"': ''?>>25</option>
											    <option value="26" <?php echo ($from_d == '26') ? 'selected="selected"': ''?>>26</option>
											    <option value="27" <?php echo ($from_d == '27') ? 'selected="selected"': ''?>>27</option>
											    <option value="28" <?php echo ($from_d == '28') ? 'selected="selected"': ''?>>28</option>
											    <option value="29" <?php echo ($from_d == '29') ? 'selected="selected"': ''?>>29</option>
											    <option value="30" <?php echo ($from_d == '30') ? 'selected="selected"': ''?>>30</option>
											    <option value="31" <?php echo ($from_d == '31') ? 'selected="selected"': ''?>>31</option>
											</select>
				
									</div>
									<div class="form-group col span_5">
										<label for="expireYear"><?php echo $lang[71]; //End Date?></label>
				
											<select name="ty" title="年">
											<?php
											$std = 2013;
											$ed = date('Y') + 1;
											for ($i = $std; $i < $ed; $i++) {
													if ($i == $to_y) {
														$sel = 'selected="selected"';
													} else {
														$sel = '';
													}
											?>
											    <option value="<?php echo $i?>" <?php echo $sel?>><?php echo $i ?></option>
											<?php } ?>
											</select>
				
											<select name="tm" title="月">
											    <option value="01" <?php echo ($to_m == '01') ? 'selected="selected"': ''?>>01</option>
											    <option value="02" <?php echo ($to_m == '02') ? 'selected="selected"' : ''?>>02</option>
											    <option value="03" <?php echo ($to_m == '03') ? 'selected="selected"' : ''?>>03</option>
											    <option value="04" <?php echo ($to_m == '04') ? 'selected="selected"' : ''?>>04</option>
											    <option value="05" <?php echo ($to_m == '05') ? 'selected="selected"' : ''?>>05</option>
											    <option value="06" <?php echo ($to_m == '06') ? 'selected="selected"' : ''?>>06</option>
											    <option value="07" <?php echo ($to_m == '07') ? 'selected="selected"' : ''?>>07</option>
											    <option value="08" <?php echo ($to_m == '08') ? 'selected="selected"' : ''?>>08</option>
											    <option value="09" <?php echo ($to_m == '09') ? 'selected="selected"' : ''?>>09</option>
											    <option value="10" <?php echo ($to_m == '10') ? 'selected="selected"' : ''?>>10</option>
											    <option value="11" <?php echo ($to_m == '11') ? 'selected="selected"' : ''?>>11</option>
											    <option value="12" <?php echo ($to_m == '12') ? 'selected="selected"' : ''?>>12</option>
											</select>
				
											<select name="td" title="日">
											    <option value="01" <?php echo ($to_d == '01') ? 'selected="selected"': ''?>>01</option>
											    <option value="02" <?php echo ($to_d == '02') ? 'selected="selected"': ''?>>02</option>
											    <option value="03" <?php echo ($to_d == '03') ? 'selected="selected"': ''?>>03</option>
											    <option value="04" <?php echo ($to_d == '04') ? 'selected="selected"': ''?>>04</option>
											    <option value="05" <?php echo ($to_d == '05') ? 'selected="selected"': ''?>>05</option>
											    <option value="06" <?php echo ($to_d == '06') ? 'selected="selected"': ''?>>06</option>
											    <option value="07" <?php echo ($to_d == '07') ? 'selected="selected"': ''?>>07</option>
											    <option value="08" <?php echo ($to_d == '08') ? 'selected="selected"': ''?>>08</option>
											    <option value="09" <?php echo ($to_d == '09') ? 'selected="selected"': ''?>>09</option>
											    <option value="10" <?php echo ($to_d == '10') ? 'selected="selected"': ''?>>10</option>
											    <option value="11" <?php echo ($to_d == '11') ? 'selected="selected"': ''?>>11</option>
											    <option value="12" <?php echo ($to_d == '12') ? 'selected="selected"': ''?>>12</option>
											    <option value="13" <?php echo ($to_d == '13') ? 'selected="selected"': ''?>>13</option>
											    <option value="14" <?php echo ($to_d == '14') ? 'selected="selected"': ''?>>14</option>
											    <option value="15" <?php echo ($to_d == '15') ? 'selected="selected"': ''?>>15</option>
											    <option value="16" <?php echo ($to_d == '16') ? 'selected="selected"': ''?>>16</option>
											    <option value="17" <?php echo ($to_d == '17') ? 'selected="selected"': ''?>>17</option>
											    <option value="18" <?php echo ($to_d == '18') ? 'selected="selected"': ''?>>18</option>
											    <option value="19" <?php echo ($to_d == '19') ? 'selected="selected"': ''?>>19</option>
											    <option value="20" <?php echo ($to_d == '20') ? 'selected="selected"': ''?>>20</option>
											    <option value="21" <?php echo ($to_d == '21') ? 'selected="selected"': ''?>>21</option>
											    <option value="22" <?php echo ($to_d == '22') ? 'selected="selected"': ''?>>22</option>
											    <option value="23" <?php echo ($to_d == '23') ? 'selected="selected"': ''?>>23</option>
											    <option value="24" <?php echo ($to_d == '24') ? 'selected="selected"': ''?>>24</option>
											    <option value="25" <?php echo ($to_d == '25') ? 'selected="selected"': ''?>>25</option>
											    <option value="26" <?php echo ($to_d == '26') ? 'selected="selected"': ''?>>26</option>
											    <option value="27" <?php echo ($to_d == '27') ? 'selected="selected"': ''?>>27</option>
											    <option value="28" <?php echo ($to_d == '28') ? 'selected="selected"': ''?>>28</option>
											    <option value="29" <?php echo ($to_d == '29') ? 'selected="selected"': ''?>>29</option>
											    <option value="30" <?php echo ($to_d == '30') ? 'selected="selected"': ''?>>30</option>
											    <option value="31" <?php echo ($to_d == '31') ? 'selected="selected"': ''?>>31</option>
											</select>
				
									</div>
									<div class="col span_2 txt-r">
										<button type="submit" class="btn gnup"><?php echo $lang[530]; //Show?></button>
									</div>
								</form>
								
								<ul class="date_range_pick">
									<li><label><?php echo $lang[531]; //Show for?></label></li>
									<li><a href="<?php echo $baseurl?>/balance.php?range=today"><?php echo $lang[143]; //Today?></a></li>
									<li><a href="<?php echo $baseurl?>/balance.php?range=yesterday"><?php echo $lang[144]; //Yesterday?></a></li>
									<li><a href="<?php echo $baseurl?>/balance.php?range=month"><?php echo $lang[146]; //This month?></a></li>
									<li><a href="<?php echo $baseurl?>/balance.php?range=7"><?php echo $lang[367]; //Last 7 days?></a></li>
									<li><a href="<?php echo $baseurl?>/balance.php?range=30"><?php echo $lang[365]; //Last 30 days?></a></li>
									<li><a href="<?php echo $baseurl?>/balance.php?range=all"><?php echo $lang[370]; //All time?></a></li>
								</ul>

								<div class="title_box_s clr">
									<h5><?php echo $graph_label?></h5>
								</div>

								<div id="coinbalancechart" style="height: 200px;"></div>

							</div><!-- .col.span_8 END  -->
							<div class="col span_4 sidebar_data">
							
								<div class="coinbalance">
									<div class="coinbox clr">
										<div class="title_box_s clr">
											<h5><?php echo $lang[394]; //Current COIN?></h5>
										</div>
										<p class="coin"><?php echo number_format($user['user_coins'],2)?><span class="count">COIN</span></p>
										<p class="desc"><?php echo $lang[393]; //is your current balance?></p>
									</div>
									<div class="title_box_s clr">
										<h5><?php echo $graph_label2?></h5>
									</div>
									<ul>
										<li class="row">
											<div class="col span_9"><?php echo $lang[377]; //Start Balance?></div>
											<div class="col span_3 txt-r">
												<p><?php echo floor($transactions['startbalance']);?><span class="count">COIN</span></p>
											</div>
										</li>
										<li class="row">
											<div class="col span_9"><?php echo $lang[372]; //Won Game?></div>
											<div class="col span_3 txt-r">
												<p class="plus"><?php echo floor($transactions['won']);?><span class="count">COIN</span></p>
											</div>
										</li>
										<li class="row">
											<div class="col span_9"><?php echo $lang[373]; //Lost Game?></div>
											<div class="col span_3 txt-r">
												<p class="minus"><?php echo floor($transactions['lose']);?><span class="count">COIN</span></p>
											</div>
										</li>
										<li class="row">
											<div class="col span_9"><?php echo $lang[378]; //Pending (live game)?></div>
											<div class="col span_3 txt-r">
												<p class="minus"><?php echo floor($transactions['pending']);?><span class="count">COIN</span></p>
											</div>
										</li>
										<li class="row">
											<div class="col span_9"><?php echo $lang[379]; //Purchases?></div>
											<div class="col span_3 txt-r">
												<p class="plus"><?php echo floor($transactions['purchases']);?><span class="count">COIN</span></p>
											</div>
										</li>
										<li class="row">
											<div class="col span_9"><?php echo $lang[536]; //Withdrawals?></div>
											<div class="col span_3 txt-r">
												<p class="minus"><?php echo floor($transactions['withdrawal']);?><span class="count">COIN</span></p>
											</div>
										</li>
										<li class="row last">
											<div class="col span_9"><?php echo $lang[296]; //Balance?></div>
											<div class="col span_3 txt-r">
												<p><?php echo floor($transactions['balance'])?><span class="count">COIN</span></p>
											</div>
										</li>
									</ul>
								</div><!-- .chartarea END  -->

							</div><!-- .col.span_4 END  -->
						</div><!-- .activity.row END  -->


						<div class="historytable row">
							<div class="col span_12">

								<div class="title_box_s clr">
									<h5><?php echo $graph_label3?></h5>
								</div>
								<table class="table balance">
									<thead>
									    <tr>
									        <th class="date"><?php echo $lang[150]; //date?></th>
									        <th><?php echo $lang[457]; //Description?></th>
									        <th class="txt-r"><?php echo $lang[387]; //in COIN?></th>
									        <th class="txt-r"><?php echo $lang[388]; //out COIN?></th>
									        <th class="txt-r"><?php echo $lang[539]; //Balance?></th>
									    </tr>
									</thead>
									<tbody>
									<?php
									if ($details) {
										foreach ($details as $d) {
									?>
									    <tr>
									        <td class="date"><?php echo $d['date']?></td>
									        <td>
									        	<?php echo $d['description1']?>
										        <p><?php echo $d['description2']?></p>
									        </td>
									        <td class="txt-r"><?php echo $d['in']?></td>
									        <td class="txt-r"><?php echo $d['out']?></td>
									        <td class="txt-r"><?php echo $d['balance']?><span>COIN</span></td>
									
									    </tr>
									<?php
										} // foreach
									}  else { // if $details
									?>
										<tr>
									        <td class="date">--</td>
									        <td>
										        --
									        </td>
									        <td class="txt-r">--</td>
									        <td class="txt-r">--</td>
									        <td class="txt-r">--</td>
									
									    </tr>
									<?php } // else ?>
									</tbody>
								</table><!-- .table END -->
							</div><!-- .col.span_12 END  -->
						</div><!-- .row END  -->

					</div><!-- .inner END -->
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
			//console.log(data);

			new Morris.Line({
			  // ID of the element in which to draw the chart.
			  element: 'coinbalancechart',
			  // Chart data records -- each entry in this array corresponds to a point on
			  // the chart.
			  /*
			  data: [
			    { month: '2014-5-25', value: 20 },
			    { month: '2014-5-28', value: 40 },
			    { month: '2014-6-6', value: 35 },
			    { month: '2014-6-19', value: 15 },
			    { month: '2014-6-24', value: 40 },
			    { month: '2014-7-7', value: 10 },
			    { month: '2014-7-8', value: 140 }
			  ],
			  */
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

		});
	</script>

	<script src="<?php echo $baseurl ?>/js/jquery.minimalect.min.js"></script>
	<script type="text/javascript">
	  $(document).ready(function(){
	    $("form.date_range select").minimalect();
	  });
	</script>



</body>

</html>