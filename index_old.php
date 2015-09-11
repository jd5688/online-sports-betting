<?php 
require_once('include/config.php');
require_once($basedir . "/admin/include/functions.php");
$homemenu='active';
?>
<!DOCTYPE HTML>
<html>
<?php include $basedir . '/common/header.php'; ?>
<body>

	<?php include $basedir . '/common/head.php'; ?>

	<div class="intro">
		<div class="container row">
		MAIN BANNER AREA
		</div>
	</div><!-- .intro END -->

	<div class="listmenu">
		<div class="container row">
			<ul class="row">
				<li class="selected"><a href="">Live In-Play</a></li>
				<li><a href="">Results</a></li>
				<li><a href="">Upcoming</a></li>
			</ul>
		</div>
	</div><!-- .listmenu END -->
	
	<div class="container row">
	
		<main role="main" class="row">
		
			<div class="filter col span_12">
				<div id="filter_menu" class="col span_10">

					<div class="fil_category">
						<label>Category</label>
						<p>All Sports</p>
						<ul>
							<li class="header">Choose a Sports</li>
							<li><a href="">All Sports</a></li>
							<li><a href="">Soccer</a></li>
							<li><a href="">Baseball</a></li>
							<li><a href="">Basketball</a></li>
						</ul>

					</div><!-- .fil_category END -->
					<div class="fil_sort">
						<label>Sorting</label>
						<p>End Time</p>
						<ul>
							<li class="header">by sorting</li>
							<li><a href="">End Time</a></li>
							<li><a href="">Placed COIN</a></li>
							<li><a href="">New Game</a></li>
							<li><a href="">Like</a></li>
						</ul>

					</div><!-- .fil_sort END -->

				</div>
				<div class="col span_2">
					<h6 class="resultCount"><span id="myTargetElement" class="num"></span> games</h6>
				</div>
			</div><!-- .filter END -->

			<article class="col span_12">

				<ul class="row gmlist">
					<li>
						<a href="./details.php?game=Ng==" class="gametbl">
							<div class="bet-overlay"><span class="btn animated fadeInUp">BET NOW</span></div>
							<span class="icon"><i class="soccer">icon</i></span>
							<span class="pickup">Recommend</span>
							<div class="gmimg" style="background-image:url('<?php echo $baseurl?>/images/blur-background04.jpg');"></div>
							<div class="gmtxt">
								<h3>Real Madrid vs FC Barcelona Which team will get a first goal?</h3>
								<p class="gid">Game ID : 001</p>
								<p class="desc">Monday, Sep 20th Liga BBVA Match 20, Which team will get a first goal?</p>
								<ul class="betitem row">
									<li>Real Madrid</li>
									<li>FC Barcelona</li>
									<li>Both teams scoreless</li>
								</ul>
							</div><!-- .gmtxt END -->
	
							<div class="status row">
								<div class="col span_6">
									<span class="title time">BET end time</span>
									<div class="timer_cd" id="game001">Time Up</div>
									<script language="JavaScript" type="text/javascript">
										cdTimer1();
										function cdTimer1()	{
											var	elemID = 'game001';
											var	year = 2014;
											var	month =	6;
											var	day	= 19;
											var	hour = 19;
											var	minutes	= 0;
											var	timeLimit = new Date( year, month - 1, day, hour, minutes );
											var	timer = new CountdownTimer( elemID, timeLimit );
											timer.countDown();
										}
									</script>
								</div>
								<div class="col span_6">
									<span class="title coin">Placed</span>
									35,760<span class="count">COIN</span>
								</div>
							</div><!-- .status END -->
	
							<div class="barbase row">
								<div class="betvol itm-1" style="width: 30%"></div>
								<div class="betvol itm-2" style="width: 55%"></div>
								<div class="betvol itm-3" style="width: 15%"></div>
							</div><!-- .barbase END -->
						</a>

						<div class="ftshare row">
							<div class="col span_8"><a class="like">9 Like</a><a class="bookmark">Bookmark</a></div>
							<div class="col span_4"><a href="#share" class="share">Share</a></div>
						</div><!-- .ftshare END -->

					</li><!-- gameitem END -->

					<li>
						<a href="./details.php?game=Ng==" class="gametbl">
							<div class="bet-overlay"><span class="btn animated fadeInUp">BET NOW</span></div>
							<span class="icon"><i class="soccer">icon</i></span>
							<div class="gmimg" style="background-image:url('<?php echo $baseurl?>/images/blur-background08.jpg');"></div>
							<div class="gmtxt">
								<h3>ダルビッシュ投手は次の登板試合でいくつ奪三振を獲得できる？</h3>
								<p class="gid">Game ID : 002</p>
								<p class="desc">2013/9/18 登板予定のMLB アスレチックス戦でダルビッシュ選手はいくつの奪三振を奪えるでしょうか？</p>
								<ul class="betitem row">
									<li>Real Madrid</li>
									<li>FC Barcelona</li>
									<li>Both teams scoreless</li>
									<li>Real Madrid</li>
									<li>FC Barcelona</li>
									<li>Both teams scoreless</li>
								</ul>
							</div><!-- .gmtxt END -->
	
							<div class="status row">
								<div class="col span_6">
									<span class="title time">BET end time</span>
									<div class="timer_cd" id="game002">Time Up</div>
									<script language="JavaScript" type="text/javascript">
										cdTimer1();
										function cdTimer1()	{
											var	elemID = 'game002';
											var	year = 2014;
											var	month =	6;
											var	day	= 19;
											var	hour = 20;
											var	minutes	= 30;
											var	timeLimit = new Date( year, month - 1, day, hour, minutes );
											var	timer = new CountdownTimer( elemID, timeLimit );
											timer.countDown();
										}
									</script>
								</div>
								<div class="col span_6">
									<span class="title coin">Placed</span>
									8,800<span class="count">COIN</span>
								</div>
							</div><!-- .status END -->
	
							<div class="barbase row">
								<div class="betvol itm-1" style="width: 30%"></div>
								<div class="betvol itm-2" style="width: 55%"></div>
								<div class="betvol itm-3" style="width: 15%"></div>
							</div><!-- .barbase END -->
						</a>

						<div class="ftshare row">
							<div class="col span_8"><a class="like">9 Like</a><a class="bookmark">Bookmark</a></div>
							<div class="col span_4"><a href="#share" class="share">Share</a></div>
						</div><!-- .ftshare END -->

					</li><!-- gameitem END -->

					<li>
						<a href="./details.php?game=Ng==" class="gametbl">
							<div class="bet-overlay"><span class="btn animated fadeInUp">BET NOW</span></div>
							<span class="icon"><i class="soccer">icon</i></span>
							<div class="gmimg" style="background-image:url('<?php echo $baseurl?>/images/blur-background09.jpg');"></div>
							<div class="gmtxt">
								<h3>セレッソ大阪 vs 鹿島アントラーズで両チームのイエローカード枚数は全部で何枚出るでしょうか？</h3>
								<p class="gid">Game ID : 003</p>
								<p class="desc">Monday, Sep 20th Liga BBVA Match 20, Which team will get a first goal?</p>
								<ul class="betitem row">
									<li>Real Madrid</li>
									<li>FC Barcelona</li>
									<li>Both teams scoreless</li>
								</ul>
							</div><!-- .gmtxt END -->
	
							<div class="status row">
								<div class="col span_6">
									<span class="title time">BET end time</span>
									<div class="timer_cd" id="game003">Time Up</div>
									<script language="JavaScript" type="text/javascript">
										cdTimer1();
										function cdTimer1()	{
											var	elemID = 'game003';
											var	year = 2014;
											var	month =	6;
											var	day	= 20;
											var	hour = 12;
											var	minutes	= 0;
											var	timeLimit = new Date( year, month - 1, day, hour, minutes );
											var	timer = new CountdownTimer( elemID, timeLimit );
											timer.countDown();
										}
									</script>
								</div>
								<div class="col span_6">
									<span class="title coin">Placed</span>
									420<span class="count">COIN</span>
								</div>
							</div><!-- .status END -->
	
							<div class="barbase row">
								<div class="betvol itm-1" style="width: 30%"></div>
								<div class="betvol itm-2" style="width: 55%"></div>
								<div class="betvol itm-3" style="width: 15%"></div>
							</div><!-- .barbase END -->
						</a>

						<div class="ftshare row">
							<div class="col span_8"><a class="like">9 Like</a><a class="bookmark">Bookmark</a></div>
							<div class="col span_4"><a href="#share" class="share">Share</a></div>
						</div><!-- .ftshare END -->

					</li><!-- gameitem END -->

					<li>
						<a href="./details.php?game=Ng==" class="gametbl">
							<div class="bet-overlay"><span class="btn animated fadeInUp">BET NOW</span></div>
							<span class="icon"><i class="soccer">icon</i></span>
							<div class="gmimg" style="background-image:url('<?php echo $baseurl?>/images/blur-background04.jpg');"></div>
							<div class="gmtxt">
								<h3>亀田興毅は次の試合で何ラウンドKOさせる事ができるでしょうか？</h3>
								<p class="gid">Game ID : 004</p>
								<p class="desc">Monday, Sep 20th Liga BBVA Match 20, Which team will get a first goal?</p>
								<ul class="betitem row">
									<li>Real Madrid</li>
									<li>FC Barcelona</li>
									<li>Both teams scoreless</li>
									<li>Real Madrid</li>
									<li>FC Barcelona</li>
									<li>Both teams scoreless</li>
								</ul>
							</div><!-- .gmtxt END -->
	
							<div class="status row">
								<div class="col span_6">
									<span class="title time">BET end time</span>
									<div class="timer_cd" id="game004">Time Up</div>
									<script language="JavaScript" type="text/javascript">
										cdTimer1();
										function cdTimer1()	{
											var	elemID = 'game004';
											var	year = 2014;
											var	month =	6;
											var	day	= 20;
											var	hour = 21;
											var	minutes	= 30;
											var	timeLimit = new Date( year, month - 1, day, hour, minutes );
											var	timer = new CountdownTimer( elemID, timeLimit );
											timer.countDown();
										}
									</script>
								</div>
								<div class="col span_6">
									<span class="title coin">Placed</span>
									765<span class="count">COIN</span>
								</div>
							</div><!-- .status END -->
	
							<div class="barbase row">
								<div class="betvol itm-1" style="width: 30%"></div>
								<div class="betvol itm-2" style="width: 55%"></div>
								<div class="betvol itm-3" style="width: 15%"></div>
							</div><!-- .barbase END -->
						</a>

						<div class="ftshare row">
							<div class="col span_8"><a class="like">9 Like</a><a class="bookmark">Bookmark</a></div>
							<div class="col span_4"><a href="#share" class="share">Share</a></div>
						</div><!-- .ftshare END -->

					</li><!-- gameitem END -->

					<li>
						<a href="./details.php" class="gametbl">
							<div class="bet-overlay"><span class="btn animated fadeInUp">BET NOW</span></div>
							<span class="icon"><i class="soccer">icon</i></span>
							<div class="gmimg" style="background-image:url('<?php echo $baseurl?>/images/blur-background08.jpg');"></div>
							<div class="gmtxt">
								<h3>Real Madrid vs FC Barcelona Which team will get a first goal?</h3>
								<p class="gid">Game ID : 005</p>
								<p class="desc">Monday, Sep 20th Liga BBVA Match 20, Which team will get a first goal?</p>
								<ul class="betitem row">
									<li>Real Madrid</li>
									<li>FC Barcelona</li>
									<li>Both teams scoreless</li>
								</ul>
							</div><!-- .gmtxt END -->
	
							<div class="status row">
								<div class="col span_6">
									<span class="title time">BET end time</span>
									<div class="timer_cd" id="game005">Time Up</div>
									<script language="JavaScript" type="text/javascript">
										cdTimer1();
										function cdTimer1()	{
											var	elemID = 'game005';
											var	year = 2014;
											var	month =	6;
											var	day	= 20;
											var	hour = 14;
											var	minutes	= 30;
											var	timeLimit = new Date( year, month - 1, day, hour, minutes );
											var	timer = new CountdownTimer( elemID, timeLimit );
											timer.countDown();
										}
									</script>
								</div>
								<div class="col span_6">
									<span class="title coin">Placed</span>
									5,567<span class="count">COIN</span>
								</div>
							</div><!-- .status END -->
	
							<div class="barbase row">
								<div class="betvol itm-1" style="width: 30%"></div>
								<div class="betvol itm-2" style="width: 55%"></div>
								<div class="betvol itm-3" style="width: 15%"></div>
							</div><!-- .barbase END -->
						</a>

						<div class="ftshare row">
							<div class="col span_8"><a class="like">9 Like</a><a class="bookmark">Bookmark</a></div>
							<div class="col span_4"><a href="#share" class="share">Share</a></div>
						</div><!-- .ftshare END -->

					</li><!-- gameitem END -->

					<li>
						<a href="./details.php" class="gametbl">
							<div class="bet-overlay"><span class="btn animated fadeInUp">BET NOW</span></div>
							<span class="icon"><i class="soccer">icon</i></span>
							<div class="gmimg" style="background-image:url('<?php echo $baseurl?>/images/blur-background09.jpg');"></div>
							<div class="gmtxt">
								<h3>ダルビッシュ投手は次の登板試合でいくつ奪三振を獲得できる？</h3>
								<p class="gid">Game ID : 006</p>
								<p class="desc">2013/9/18 登板予定のMLB アスレチックス戦でダルビッシュ選手はいくつの奪三振を奪えるでしょうか？</p>
								<ul class="betitem row">
									<li>Real Madrid</li>
									<li>FC Barcelona</li>
									<li>Both teams scoreless</li>
								</ul>
							</div><!-- .gmtxt END -->
	
							<div class="status row">
								<div class="col span_6">
									<span class="title time">BET end time</span>
									<div class="timer_cd" id="game006">Time Up</div>
									<script language="JavaScript" type="text/javascript">
										cdTimer1();
										function cdTimer1()	{
											var	elemID = 'game006';
											var	year = 2014;
											var	month =	6;
											var	day	= 18;
											var	hour = 10;
											var	minutes	= 30;
											var	timeLimit = new Date( year, month - 1, day, hour, minutes );
											var	timer = new CountdownTimer( elemID, timeLimit );
											timer.countDown();
										}
									</script>
								</div>
								<div class="col span_6">
									<span class="title coin">Placed</span>
									35,700<span class="count">COIN</span>
								</div>
							</div><!-- .status END -->
	
							<div class="barbase row">
								<div class="betvol itm-1" style="width: 30%"></div>
								<div class="betvol itm-2" style="width: 55%"></div>
								<div class="betvol itm-3" style="width: 15%"></div>
							</div><!-- .barbase END -->
						</a>

						<div class="ftshare row">
							<div class="col span_8"><a class="like">9 Like</a><a class="bookmark">Bookmark</a></div>
							<div class="col span_4"><a href="#share" class="share">Share</a></div>
						</div><!-- .ftshare END -->

					</li><!-- gameitem END -->

					<li>
						<a href="./details.php" class="gametbl">
							<div class="bet-overlay"><span class="btn animated fadeInUp">BET NOW</span></div>
							<span class="icon"><i class="soccer">icon</i></span>
							<div class="gmimg" style="background-image:url('<?php echo $baseurl?>/images/blur-background04.jpg');"></div>
							<div class="gmtxt">
								<h3>セレッソ大阪 vs 鹿島アントラーズで両チームのイエローカード枚数は全部で何枚出るでしょうか？</h3>
								<p class="gid">Game ID : 007</p>
								<p class="desc">Monday, Sep 20th Liga BBVA Match 20, Which team will get a first goal?</p>
								<ul class="betitem row">
									<li>Real Madrid</li>
									<li>FC Barcelona</li>
									<li>Both teams scoreless</li>
								</ul>
							</div><!-- .gmtxt END -->
	
							<div class="status row">
								<div class="col span_6">
									<span class="title time">BET end time</span>
									<div class="timer_cd" id="game007">Time Up</div>
									<script language="JavaScript" type="text/javascript">
										cdTimer1();
										function cdTimer1()	{
											var	elemID = 'game007';
											var	year = 2014;
											var	month =	6;
											var	day	= 18;
											var	hour = 12;
											var	minutes	= 30;
											var	timeLimit = new Date( year, month - 1, day, hour, minutes );
											var	timer = new CountdownTimer( elemID, timeLimit );
											timer.countDown();
										}
									</script>
								</div>
								<div class="col span_6">
									<span class="title coin">Placed</span>
									3,634<span class="count">COIN</span>
								</div>
							</div><!-- .status END -->
	
							<div class="barbase row">
								<div class="betvol itm-1" style="width: 30%"></div>
								<div class="betvol itm-2" style="width: 55%"></div>
								<div class="betvol itm-3" style="width: 15%"></div>
							</div><!-- .barbase END -->
						</a>

						<div class="ftshare row">
							<div class="col span_8"><a class="like">9 Like</a><a class="bookmark">Bookmark</a></div>
							<div class="col span_4"><a href="#share" class="share">Share</a></div>
						</div><!-- .ftshare END -->

					</li><!-- gameitem END -->

					<li>
						<a href="./details.php" class="gametbl">
							<div class="bet-overlay"><span class="btn animated fadeInUp">BET NOW</span></div>
							<span class="icon"><i class="soccer">icon</i></span>
							<div class="gmimg" style="background-image:url('<?php echo $baseurl?>/images/blur-background08.jpg');"></div>
							<div class="gmtxt">
								<h3>亀田興毅は次の試合で何ラウンドKOさせる事ができるでしょうか？</h3>
								<p class="gid">Game ID : 008</p>
								<p class="desc">Monday, Sep 20th Liga BBVA Match 20, Which team will get a first goal?</p>
								<ul class="betitem row">
									<li>Real Madrid</li>
									<li>FC Barcelona</li>
									<li>Both teams scoreless</li>
								</ul>
							</div><!-- .gmtxt END -->
	
							<div class="status row">
								<div class="col span_6">
									<span class="title time">BET end time</span>
									<div class="timer_cd" id="game008">Time Up</div>
									<script language="JavaScript" type="text/javascript">
										cdTimer1();
										function cdTimer1()	{
											var	elemID = 'game008';
											var	year = 2014;
											var	month =	6;
											var	day	= 20;
											var	hour = 9;
											var	minutes	= 0;
											var	timeLimit = new Date( year, month - 1, day, hour, minutes );
											var	timer = new CountdownTimer( elemID, timeLimit );
											timer.countDown();
										}
									</script>
								</div>
								<div class="col span_6">
									<span class="title coin">Placed</span>
									14,080<span class="count">COIN</span>
								</div>
							</div><!-- .status END -->
	
							<div class="barbase row">
								<div class="betvol itm-1" style="width: 30%"></div>
								<div class="betvol itm-2" style="width: 55%"></div>
								<div class="betvol itm-3" style="width: 15%"></div>
							</div><!-- .barbase END -->
						</a>

						<div class="ftshare row">
							<div class="col span_8"><a class="like">9 Like</a><a class="bookmark">Bookmark</a></div>
							<div class="col span_4"><a href="#share" class="share">Share</a></div>
						</div><!-- .ftshare END -->

					</li><!-- gameitem END -->

					<li>
						<a href="./details.php" class="gametbl">
							<div class="bet-overlay"><span class="btn animated fadeInUp">BET NOW</span></div>
							<span class="icon"><i class="soccer">icon</i></span>
							<div class="gmimg" style="background-image:url('<?php echo $baseurl?>/images/blur-background09.jpg');"></div>
							<div class="gmtxt">
								<h3>Real Madrid vs FC Barcelona Which team will get a first goal?</h3>
								<p class="gid">Game ID : 009</p>
								<p class="desc">Monday, Sep 20th Liga BBVA Match 20, Which team will get a first goal?</p>
								<ul class="betitem row">
									<li>Real Madrid</li>
									<li>FC Barcelona</li>
									<li>Both teams scoreless</li>
								</ul>
							</div><!-- .gmtxt END -->
	
							<div class="status row">
								<div class="col span_6">
									<span class="title time">BET end time</span>
									<div class="timer_cd" id="game009">Time Up</div>
									<script language="JavaScript" type="text/javascript">
										cdTimer1();
										function cdTimer1()	{
											var	elemID = 'game009';
											var	year = 2014;
											var	month =	6;
											var	day	= 20;
											var	hour = 10;
											var	minutes	= 30;
											var	timeLimit = new Date( year, month - 1, day, hour, minutes );
											var	timer = new CountdownTimer( elemID, timeLimit );
											timer.countDown();
										}
									</script>
								</div>
								<div class="col span_6">
									<span class="title coin">Placed</span>
									5,750<span class="count">COIN</span>
								</div>
							</div><!-- .status END -->
	
							<div class="barbase row">
								<div class="betvol itm-1" style="width: 30%"></div>
								<div class="betvol itm-2" style="width: 55%"></div>
								<div class="betvol itm-3" style="width: 15%"></div>
							</div><!-- .barbase END -->
						</a>

						<div class="ftshare row">
							<div class="col span_8"><a class="like">9 Like</a><a class="bookmark">Bookmark</a></div>
							<div class="col span_4"><a href="#share" class="share">Share</a></div>
						</div><!-- .ftshare END -->

					</li><!-- gameitem END -->

					<li>
						<a href="./details.php" class="gametbl">
							<div class="bet-overlay"><span class="btn animated fadeInUp">BET NOW</span></div>
							<span class="icon"><i class="soccer">icon</i></span>
							<div class="gmimg" style="background-image:url('<?php echo $baseurl?>/images/blur-background04.jpg');"></div>
							<div class="gmtxt">
								<h3>ダルビッシュ投手は次の登板試合でいくつ奪三振を獲得できる？</h3>
								<p class="gid">Game ID : 010</p>
								<p class="desc">2013/9/18 登板予定のMLB アスレチックス戦でダルビッシュ選手はいくつの奪三振を奪えるでしょうか？</p>
								<ul class="betitem row">
									<li>Real Madrid</li>
									<li>FC Barcelona</li>
									<li>Both teams scoreless</li>
								</ul>
							</div><!-- .gmtxt END -->
	
							<div class="status row">
								<div class="col span_6">
									<span class="title time">BET end time</span>
									<div class="timer_cd" id="game010">Time Up</div>
									<script language="JavaScript" type="text/javascript">
										cdTimer1();
										function cdTimer1()	{
											var	elemID = 'game010';
											var	year = 2014;
											var	month =	6;
											var	day	= 20;
											var	hour = 11;
											var	minutes	= 30;
											var	timeLimit = new Date( year, month - 1, day, hour, minutes );
											var	timer = new CountdownTimer( elemID, timeLimit );
											timer.countDown();
										}
									</script>
								</div>
								<div class="col span_6">
									<span class="title coin">Placed</span>
									6,350<span class="count">COIN</span>
								</div>
							</div><!-- .status END -->
	
							<div class="barbase row">
								<div class="betvol itm-1" style="width: 30%"></div>
								<div class="betvol itm-2" style="width: 55%"></div>
								<div class="betvol itm-3" style="width: 15%"></div>
							</div><!-- .barbase END -->
						</a>

						<div class="ftshare row">
							<div class="col span_8"><a class="like">9 Like</a><a class="bookmark">Bookmark</a></div>
							<div class="col span_4"><a href="#share" class="share">Share</a></div>
						</div><!-- .ftshare END -->

					</li><!-- gameitem END -->

					<li>
						<a href="./details.php" class="gametbl">
							<div class="bet-overlay"><span class="btn animated fadeInUp">BET NOW</span></div>
							<span class="icon"><i class="soccer">icon</i></span>
							<div class="gmimg" style="background-image:url('<?php echo $baseurl?>/images/blur-background08.jpg');"></div>
							<div class="gmtxt">
								<h3>セレッソ大阪 vs 鹿島アントラーズで両チームのイエローカード枚数は全部で何枚出るでしょうか？</h3>
								<p class="gid">Game ID : 011</p>
								<p class="desc">Monday, Sep 20th Liga BBVA Match 20, Which team will get a first goal?</p>
								<ul class="betitem row">
									<li>Real Madrid</li>
									<li>FC Barcelona</li>
									<li>Both teams scoreless</li>
								</ul>
							</div><!-- .gmtxt END -->
	
							<div class="status row">
								<div class="col span_6">
									<span class="title time">BET end time</span>
									<div class="timer_cd" id="game011">Time Up</div>
									<script language="JavaScript" type="text/javascript">
										cdTimer1();
										function cdTimer1()	{
											var	elemID = 'game011';
											var	year = 2014;
											var	month =	6;
											var	day	= 18;
											var	hour = 17;
											var	minutes	= 0;
											var	timeLimit = new Date( year, month - 1, day, hour, minutes );
											var	timer = new CountdownTimer( elemID, timeLimit );
											timer.countDown();
										}
									</script>
								</div>
								<div class="col span_6">
									<span class="title coin">Placed</span>
									16,000<span class="count">COIN</span>
								</div>
							</div><!-- .status END -->
	
							<div class="barbase row">
								<div class="betvol itm-1" style="width: 30%"></div>
								<div class="betvol itm-2" style="width: 55%"></div>
								<div class="betvol itm-3" style="width: 15%"></div>
							</div><!-- .barbase END -->
						</a>

						<div class="ftshare row">
							<div class="col span_8"><a class="like">9 Like</a><a class="bookmark">Bookmark</a></div>
							<div class="col span_4"><a href="#share" class="share">Share</a></div>
						</div><!-- .ftshare END -->

					</li><!-- gameitem END -->

					<li>
						<a href="./details.php" class="gametbl">
							<div class="bet-overlay"><span class="btn animated fadeInUp">BET NOW</span></div>
							<span class="icon"><i class="soccer">icon</i></span>
							<div class="gmimg" style="background-image:url('<?php echo $baseurl?>/images/blur-background09.jpg');"></div>
							<div class="gmtxt">
								<h3>亀田興毅は次の試合で何ラウンドKOさせる事ができるでしょうか？</h3>
								<p class="gid">Game ID : 012</p>
								<p class="desc">Monday, Sep 20th Liga BBVA Match 20, Which team will get a first goal?</p>
								<ul class="betitem row">
									<li>Real Madrid</li>
									<li>FC Barcelona</li>
									<li>Both teams scoreless</li>
								</ul>
							</div><!-- .gmtxt END -->
	
							<div class="status row">
								<div class="col span_6">
									<span class="title time">BET end time</span>
									<div class="timer_cd" id="game012">Time Up</div>
									<script language="JavaScript" type="text/javascript">
										cdTimer1();
										function cdTimer1()	{
											var	elemID = 'game012';
											var	year = 2014;
											var	month =	6;
											var	day	= 17;
											var	hour = 9;
											var	minutes	= 0;
											var	timeLimit = new Date( year, month - 1, day, hour, minutes );
											var	timer = new CountdownTimer( elemID, timeLimit );
											timer.countDown();
										}
									</script>
								</div>
								<div class="col span_6">
									<span class="title coin">Placed</span>
									1,500<span class="count">COIN</span>
								</div>
							</div><!-- .status END -->
	
							<div class="barbase row">
								<div class="betvol itm-1" style="width: 30%"></div>
								<div class="betvol itm-2" style="width: 55%"></div>
								<div class="betvol itm-3" style="width: 15%"></div>
							</div><!-- .barbase END -->
						</a>

						<div class="ftshare row">
							<div class="col span_8"><a class="like">9 Like</a><a class="bookmark">Bookmark</a></div>
							<div class="col span_4"><a href="#share" class="share">Share</a></div>
						</div><!-- .ftshare END -->

					</li><!-- gameitem END -->

				</ul>
				
				<div class="seemore"><a id="see_more" href="">See more</a></div>

			</article>
		
		</main>
	
	</div>

    <?php include $basedir . '/common/foot.php'; ?>
    <?php include $basedir . '/common/share_modal.php'; ?>

	<script src="<?php echo $baseurl?>/js/jquery-1.11.0.min.js"></script>
    <script src="<?php echo $baseurl?>/js/jquery.remodal.js"></script>
	<script type="text/javascript" src="<?php echo $baseurl?>/js/main_frontend.js"></script>

	<script src="<?php echo $baseurl?>/js/countUp.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			// create instance
			var demo = new countUp("myTargetElement", 0, 59, 0, 2);
			window.onload = function() {
			// fire animation
			demo.start();
			}
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

	<!-- Dropdown MENU *** Need a Fix *** -->
	<script>
	    $(document).ready(function() {

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