<?php 
require_once('../include/config.php');
require_once($basedir . "/include/functions.php");
require_once($basedir . '/include/user_functions.php');

if (!$user_id) {
	// go to login page
	header('Location: '. $baseurl . '#login');
	exit;
}

$categories = getCategories();
$user = getUser($user_id);
$user_sendmail = ($user['user_sendmail']) ? explode(",", $user['user_sendmail']) : 0;
$user_notify = ($user['user_notify']) ? $user['user_notify'] : 0;
$user_remind = ($user['user_remind']) ? $user['user_remind'] : 0;
$user_gamedigest = ($user['user_gamedigest']) ? $user['user_gamedigest'] : 0;
$user_sitenews = ($user['user_sitenews']) ? $user['user_sitenews'] : 0;
$settingsmenu='active';
$notificationsmenu='active';
?>
<!DOCTYPE HTML>
<html>
<?php include $basedir . '/common/header.php'; ?>
<body>

	<?php include $basedir . '/common/head.php'; ?>


	<div class="container row">
	
		<?php include $basedir . '/common/myheadmenu.php'; ?>

		<main role="main" class="row gutters mypage">

			<article id="myaccount" class="col span_9">

				<div class="box">
					<div class="title_box">
						<h4 class="title"><?php echo $lang[408];?></h4>
						<p class="desc"><?php echo $lang[493];?></p>
					</div>

					<form method="POST" accept-charset="utf-8" class="inputform noticfication">
					
						<h5><?php echo $lang[494];?></h5>
						<div class="controls">
							<label for="mail_sports_on"><?php echo $lang[495];?></label>

							<div class="check_area">
								<label class="cbxbd"><input type="checkbox" name="mail_sports_on" id="mail_sports_on" value="" <?php echo ($user_sendmail) ? 'checked=""' : ''?>><?php echo $lang[496];?></label>

								<div id="mail_sports_cat" class="mail_sports_cat <?php echo ($user_sendmail) ? 'active' : ''?>">
									<div class="favsports"><label class="cbxbd"><input type="checkbox" name="mail_sports[]" value="all" <?php echo (in_array('all', $user_sendmail)) ? 'checked=""' : ''?>><?php echo $lang[497];?></label></div>
								<?php
								if ($categories) {
									foreach ($categories as $c) {
								?>
									<div class="favsports"><label class="cbxbd"><input type="checkbox" name="mail_sports[]" value="<?php echo $c['sc_id']?>" <?php echo (in_array($c['sc_id'], $user_sendmail)) ? 'checked=""' : ''?>><?php echo $c['sc_name']?></label></div>
								<?php
									} // foreach
								} // if
								?>
								</div><!-- .mail_sports_cat END -->
							</div><!-- .check_area END -->

						</div><!-- .controls END -->


						<h5><?php echo $lang[498];?></h5>
						<div class="controls">
							<label for="mail_result_on"><?php echo $lang[495];?></label>
							<div class="check_area">
								<label class="cbxbd"><input type="checkbox" name="mail_result_on" id="mail_result_on" value="" <?php echo ($user_notify) ? 'checked=""' : ''?>><?php echo $lang[499];?></label>

								<div id="mail_result_opt" class="mail_result_opt <?php echo ($user_notify) ? '' : 'disabled'?>">
									<label class="cbxbd c_on"><input type="radio" name="game_result" value="all" <?php echo ($user_notify == 'all') ? 'checked=""' : ''?>><?php echo $lang[500];?></label>
									<label class="cbxbd"><input type="radio" name="game_result" value="won" <?php echo ($user_notify == 'won') ? 'checked=""' : ''?>><?php echo $lang[501];?></label>
									<label class="cbxbd"><input type="radio" name="game_result" value="cancelled" <?php echo ($user_notify == 'cancelled') ? 'checked=""' : ''?>><?php echo $lang[502];?></label>
								</div><!-- .mail_sports_cat END -->

							</div><!-- .check_area END -->

						</div><!-- .controls END -->

						<div class="controls">
							<label for="mail_remind_on"><?php echo $lang[503];?></label>

							<div class="check_area">
								<label class="cbxbd"><input type="checkbox" name="mail_remind_on" id="mail_remind_on" value="1" <?php echo ($user_remind) ? 'checked=""' : ''?>><?php echo $lang[504];?></label>

							</div><!-- .check_area END -->

						</div><!-- .controls END -->



						<h5><?php echo $lang[505];?></h5>
						<div class="controls">
							<label for="mail_update_on"><?php echo $lang[495];?></label>

							<div class="check_area digest">
								<label class="cbxbd"><input type="checkbox" name="mail_update_on" id="mail_update_1" value="" <?php echo ($user_gamedigest) ? 'checked=""' : ''?>><?php echo $lang[506];?></label>

								<select name="game_digest" class="" data-attribute="digest_schedule">
									<option value="1" <?php echo ($user_gamedigest == 1) ? 'selected="selected"' : ''?>><?php echo $lang[507];?></option>
									<option value="2" <?php echo ($user_gamedigest == 2) ? 'selected="selected"' : ''?>><?php echo $lang[508];?></option>
								</select>


								<label class="cbxbd"><input type="checkbox" name="site_news" value="" <?php echo ($user_sitenews) ? 'checked=""' : ''?>><?php echo $lang[509];?></label>
							</div><!-- .check_area END -->

						</div><!-- .controls END -->

						
						<p class="form-actions">
							<input type="submit" class="btn" value="<?php echo $lang[336];?>">
							<span id="message"></span>
						</p>
					
					</form>

				</div>

			</article>
			<aside id="mymenu" role="mymenu" class="col span_3">
				<?php include $basedir . '/common/mymenu.php'; ?>
			</aside>

		</main>

	</div>

	<script src="<?php echo $baseurl?>/js/jquery-1.11.0.min.js"></script>
    <?php include $basedir . '/common/foot.php'; ?>

    <script src="<?php echo $baseurl?>/js/jquery.remodal.js"></script>
	<script type="text/javascript" src="<?php echo $baseurl?>/js/main_frontend.js"></script>

	<!-- JS for Item Input area -->
	<script type='text/javascript'>
	$(document).ready(function() {
	
	    $("input[type='checkbox']#mail_sports_on").change(function(){
            var items = $('#mail_sports_cat .favsports').find('input');
	        if($(this).is(":checked")){
	            $('.mail_sports_cat').addClass("active");
	        }else{
	            $('.mail_sports_cat').removeClass("active");
	            $(items).prop('checked', false);
	        }
	    });



	
	    $("input[type='checkbox']#mail_result_on").change(function(){
	        if($(this).is(":checked")){
	            $('#mail_result_opt').removeClass("disabled");
	        }else{
	            $('#mail_result_opt').addClass("disabled");
	        }
	    });



	});
	</script>


	<script src="<?php echo $baseurl?>/js/jquery.minimalect.min.js"></script>
	<script type="text/javascript">
	  $(document).ready(function(){
	    $("#myaccount form.inputform select").minimalect();
	    $('input[type=submit]').click(function (e) {
		    e.preventDefault();
		    var checkboxes = document.getElementsByName('mail_sports[]');
			var mail_sports = "";
			for (var i = 0, n = checkboxes.length; i < n; i += 1) {
			  if (checkboxes[i].checked) {
			  	mail_sports += ","+checkboxes[i].value;
			  }
			}
			if (mail_sports) {
				mail_sports = mail_sports.substring(1);
			}
		    var game_result = ($('input[name=mail_result_on]').is(':checked')) ? $('input[name=game_result]:checked').val() : 0;
		    var game_digest = 0;
		    if ($('input[name=mail_update_on]').is(':checked')) {
		    	game_digest = $('select[name=game_digest]').val();
		    }
		    var mail_remind = ($('input[name=mail_remind_on]').is(':checked')) ? 1 : 0;
		    var site_news = ($('input[name=site_news]').is(':checked')) ? 1 : 0;
			var t = "<?php echo $time;?>";
			var url = "<?php echo $baseurl ?>";
			var key = "<?php echo $public_key?>";
			var hash = "<?php echo $hash?>";
			url = url + "/ajax/user-notifications.php";
			var uri = 'hash=' + hash + '&public=' + key + '&t=' + t;
			uri += '&ms=' + mail_sports + '&gr=' + game_result + '&gd=' + game_digest + '&mr=' + mail_remind + '&sn=' + site_news;
			
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
			        $('#message').html(data.message);
			        setTimeout(function() {
			            $('#message').html('');
			        }, 3000)
			    }
			    
		    });
	
		  })
	    
	  });
	</script>


</body>

</html>