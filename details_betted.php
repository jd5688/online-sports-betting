<?php 
	$baseurl='.';
	$homemenu='active';
?>
<!DOCTYPE HTML>
<html>
<?php include ''.$baseurl.'/common/header.php'; ?>
<body>

	<?php include ''.$baseurl.'/common/head.php'; ?>

	<p class="notice">You are joining this game. Good luck;)</p>

	<div class="container row">
	
		<main role="main" class="row details">

			<article class="col span_8">

				<div class="box">

					<div class="row">

						<div class="gmlabel">
							<label class="new">NEW</label>
							<label class="free">FREE BET</label>
							<label class="rec">Recommend</label>
						</div>

						<h1>Real Madrid vs FC Barcelona Which team will get a first goal?</h1>
						<ul class="taglist row">
							<li class="cat"><a href="/">SOCCER</a></li>
							<li class="tags"><a href="/">LEGA13/14</a><a href="/">BARCA</a><a href="/">CLASICO</a></li>
						</ul>
	
						<div class="gmimg" style="background-image:url('/images/blur-background08.jpg');"></div>
						<div class="desc">
							<p>Monday, Sep 20th Liga BBVA Match 20, Which team will get a first goal?</p>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent quis facilisis arcu. Aenean sollicitudin ligula vel imperdiet accumsan. Pellentesque vitae lectus nec nisl commodo mollis.</p>
						</div>

						<div class="ftshare row">
							<div class="col span_12"><a class="like">9 Like</a><a class="bookmark">Bookmark</a><a href="#share" class="share">Share</a></div>
						</div><!-- .ftshare END -->

					</div>




					<div class="gmstatus row">
						<label>Current Game Status</label>
						<div class="status row">
							<div class="col span_4">
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
							<div class="col span_4">
								<span class="title coin">Placed</span>
								35,760<span class="count">COIN</span>
							</div>
							<div class="col span_4">
								<span class="title coin">Join</span>
								824<span class="count">USERS</span>
							</div>
						</div><!-- .status END -->
	
						<table class="table">
							<thead>
							    <tr>
							        <th>#</th>
							        <th>Items</th>
							        <th>Placed COIN</th>
							        <th>BET Users</th>
							        <th>Ratio</th>
							    </tr>
							</thead>
							<tbody>
							    <tr data-href="#share">
							        <td>1</td>
							        <td>Real Madrid</td>
							        <td>239</td>
							        <td>209</td>
							        <td>49.8<span>%</span></td>
							
							    </tr>
							    <tr data-href="#share">
							        <td>2</td>
							        <td>FC Barcelona</td>
							        <td>131</td>
							        <td>58</td>
							        <td>27.3<span>%</span></td>
							    </tr>
							    <tr data-href="#share">
							        <td>3</td>
							        <td>Both teams scoreless</td>
							        <td>109</td>
							        <td>46</td>
							        <td>22.7<span>%</span></td>
							    </tr>
							</tbody>
						</table><!-- .table END -->

					</div>

					<div class="gmstatus bd row">
						<div class="col span_6">
							<label>Game Info</label>

							<ul class="gminfo-box row">
								<li class="row">
									<div class="col span_6">
										Game ID
									</div>
									<div class="col span_6 txt-r">
										000001
									</div>
								</li>
								<li class="row">
									<div class="col span_6">
										BET Start time
									</div>
									<div class="col span_6 txt-r">
										05/11/2014 12:00 AM
									</div>
								</li>
								<li class="row">
									<div class="col span_6">
										BET End time
									</div>
									<div class="col span_6 txt-r">
										05/11/2014 12:00 AM
									</div>
								</li>
								<li class="row">
									<div class="col span_6">
										COIN / 1BET
									</div>
									<div class="col span_6 txt-r">
										10<span>COIN</span>
									</div>
								</li>
								<li class="row">
									<div class="col span_6">
										House Commission
									</div>
									<div class="col span_6 txt-r">
										10<span>%</span>
									</div>
								</li>
							</ul>

							<p class="req-txt">This Game require atleast more<span class="odds">500<span>COIN</span></span> on table. It will be canceled automatically if coin until the close time.</p>


						</div><!-- .span_6 END -->

						<div class="col span_6">
							<label>High Betting Users</label>


							<ul class="user-list-box row">
								<li class="row">
									<a href="#">
									<div class="user-panel col span_9">
										<div class="pull-left image">
											<img src="/images/avatar3.png" class="img-circle" alt="Username">
										</div>
										<div class="pull-left info">
											<h6>Username001</h6>
											<p>Real Madrid</p>
										</div>
									</div>
									<div class="col span_3">
										239<span>COIN</span>
									</div>
									</a>
								</li>
								<li class="row">
									<a href="#">
									<div class="user-panel col span_9">
										<div class="pull-left image">
											<img src="/images/avatar3.png" class="img-circle" alt="Username">
										</div>
										<div class="pull-left info">
											<h6>Username001</h6>
											<p>Real Madrid</p>
										</div>
									</div>
									<div class="col span_3">
										239<span>COIN</span>
									</div>
									</a>
								</li>
								<li class="row">
									<a href="#">
									<div class="user-panel col span_9">
										<div class="pull-left image">
											<img src="/images/avatar3.png" class="img-circle" alt="Username">
										</div>
										<div class="pull-left info">
											<h6>Username001</h6>
											<p>Real Madrid</p>
										</div>
									</div>
									<div class="col span_3">
										239<span>COIN</span>
									</div>
									</a>
								</li>
							</ul>
							<div class="seemore"><a id="see_more" href="#share">See more</a></div>



						</div><!-- .span_6 END -->
					</div><!-- .status END -->


				</div>
				<div class="box">

					<h4>Match Betting</h4>
					<ul>
						<li>Mon, Sep 20th Liga BBVA 2013-14 Match 20</li>
						<li>Real Madrid vs FC Barcelona</li>
						<li>Mon, Sep 20th 19:00 Kick Off (GMT+8)</li>
					</ul>
				
					<h4>Game Condition</h4>
					<ul>
						<li>Book closes Mon, Sep 20th 18:00 (GMT+8)</li>
						<li>An unplayed or postponed match will be treated as a non-runner for settling purposes unless it is played within the same week (ending on Sunday) in which case the bet will stand unless cancelled by mutual consent.</li>
					</ul>

				</div><!-- .box END -->
				
			</article>

			<aside id="sidebar" role="betform" class="col span_4">
				<div class="floating-widget">

					<div class="mybetstatus">
						<h3 class="title"></h3>
						<div class="inner">
						
							<h4>Your betted item</h4>
						    <div class="row">
						        <div class="col span_8">Real Madrid</div>
						        <div class="col span_4 txt-r">50<span>COIN</span></div>
						        <div class="col span_12 mayearn">You may earn <strong>58</strong><span>COIN</span></div>
						    </div>
	
						    <div class="row">
						        <div class="col span_8">FC Barcelona</div>
						        <div class="col span_4 txt-r">40<span>COIN</span></div>
						        <div class="col span_12 mayearn">You may earn <strong>57</strong><span>COIN</span></div>
						    </div>
	
						    <div class="row">
						        <div class="col span_8">Both teams scoreless</div>
						        <div class="col span_4 txt-r">4<span>COIN</span></div>
						        <div class="col span_12 mayearn">You may earn <strong>20</strong><span>COIN</span></div>
						    </div>
	
						    <div class="row totalbet">
						        <div class="col span_8">Total bet COIN</div>
						        <div class="col span_4 txt-r">94<span>COIN</span></div>
						    </div>
	
						</div><!-- .inner END -->
					</div><!-- .mybetstatus END -->

					<div class="betbox">
					<h3 class="title">BET NOW!<span>Choose Item and BET this below</span></h3>
					<div class="inner">
	
						<h4>BET Item</h4>
						<div class="item_radio">
							<label class="cbxbd"><input type="radio" name="item_radio" id="item_radio1" value="item1">Real Madrid</label>

							<label class="cbxbd"><input type="radio" name="item_radio" id="item_radio2" value="item2">FC Barcelona</label>

							<label class="cbxbd"><input type="radio" name="item_radio" id="item_radio3" value="item3">Both teams scoreless</label>
						</div>
	
					
						<h4>How Many COIN You want place?</h4>
						<div class="bet_radio row">
							<label class="cbxbd"><input type="radio" name="bet_radio" id="bet_radio" value="bet1">10<span>COIN</span></label>

							<label class="cbxbd"><input type="radio" name="bet_radio" id="bet_radio" value="bet2">20<span>COIN</span></label>

							<label class="cbxbd"><input type="radio" name="bet_radio" id="bet_radio" value="bet3">30<span>COIN</span></label>

							<label class="cbxbd"><input type="radio" name="bet_radio" id="bet_radio" value="bet4">40<span>COIN</span></label>

							<label class="cbxbd"><input type="radio" name="bet_radio" id="bet_radio" value="bet5">50<span>COIN</span></label>

							<label class="cbxbd"><input type="radio" name="bet_radio" id="bet_radio" value="bet10">100<span>COIN</span></label>
						</div>

						<div class="notify">
							<label class="cbxbd"><input type="checkbox" name="notify_radio" id="notify_radio" value="notify_result">Notify me when found the game result</label>
						</div><!-- .notify END -->
		
						<p class="rate">このゲームは1BETあたり<span class="odds">500<span>COIN</span></span>必要です。<br>うち100 COIN（25%）はテラ銭となります。</p>


						
					</div><!-- .inner END -->
				</div><!-- .betbox END -->
				
					<a href="#share" class="bet btn">BET NOW</a>

					<a href="./details.php">on Live</a>
					<a href="./details_betted.php">After Betted / Judging</a>
					<a href="./details_coming.php">future game</a>
					<a href="./details_result.php">result game</a>

				</div><!-- .floating-widget END -->
			</aside>
			
		
		</main>

		<div class="related">
			<h4>Related Game</h4>
			<ul class="row gmlist">

					<li>
						<a href="./details.php" class="gametbl">
							<div class="bet-overlay"><span class="btn animated fadeInUp">BET NOW</span></div>
							<span class="icon"><i class="soccer">icon</i></span>
							<div class="gmimg" style="background-image:url('/images/blur-background08.jpg');"></div>
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
							<div class="gmimg" style="background-image:url('/images/blur-background09.jpg');"></div>
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
							<div class="gmimg" style="background-image:url('/images/blur-background04.jpg');"></div>
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
							<div class="gmimg" style="background-image:url('/images/blur-background08.jpg');"></div>
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

				</ul>
		</div>
	
	</div>

    <?php include ''.$baseurl.'/common/foot.php'; ?>
    <?php include ''.$baseurl.'/common/share_modal.php'; ?>

	<script src="/js/jquery-1.11.0.min.js"></script>
    <script src="/js/jquery.remodal.js"></script>
	<script type="text/javascript" src="/js/main_frontend.js"></script>

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
	
	});
	</script>
	
	<script type='text/javascript'>
		jQuery(function($) {
		  //data-hrefの属性を持つtrを選択しclassにclickableを付加
		  $('tr[data-href]').addClass('clickable')
		    //クリックイベント
		    .click(function(e) {
		      //e.targetはクリックした要素自体、それがa要素以外であれば
		      if(!$(e.target).is('a')){
		        //その要素の先祖要素で一番近いtrの
		        //data-href属性の値に書かれているURLに遷移する
		        window.location = $(e.target).closest('tr').data('href');}
		  });
		});
	</script>



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