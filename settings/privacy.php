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
$user = getUserFromCache($user_id);
$ppage = $user['user_privacy_page'];
$presult = $user['user_privacy_result'];
	
$settingsmenu='active';
$privacymenu='active';
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
						<h4 class="title"><?php echo $lang[409];?></h4>
						<p class="desc"><?php echo $lang[510];?></p>
					</div>

					<form method="POST" accept-charset="utf-8" class="inputform noticfication">
					
						<div class="controls">
							<label for="public_page_setting"><?php echo $lang[511];?></label>
							<div class="check_area">
								<label class="cbxbd c_on"><input type="radio" name="public_page_setting" id="item_radio1" value="all" <?php echo ($ppage == 'all') ? 'checked=""' : ''?>><?php echo $lang[512];?></label>
								<label class="cbxbd"><input type="radio" name="public_page_setting" id="item_radio2" value="following" <?php echo ($ppage == 'following') ? 'checked=""' : ''?>><?php echo $lang[513];?></label>
								<label class="cbxbd"><input type="radio" name="public_page_setting" id="item_radio3" value="none" <?php echo ($ppage == 'none') ? 'checked=""' : ''?>><?php echo $lang[514];?></label>
							</div><!-- .check_area END -->
						</div><!-- .controls END -->

						<div class="controls">
							<label for="game_result_setting"><?php echo $lang[515];?></label>
							<div class="check_area">
								<label class="cbxbd c_on"><input type="radio" name="game_result_setting" id="item_radio1" value="all" checked="" <?php echo ($presult == 'all') ? 'checked=""' : ''?>><?php echo $lang[516];?></label>
								<label class="cbxbd"><input type="radio" name="game_result_setting" id="item_radio2" value="following" <?php echo ($presult == 'following') ? 'checked=""' : ''?>><?php echo $lang[517];?></label>
								<label class="cbxbd"><input type="radio" name="game_result_setting" id="item_radio3" value="none" <?php echo ($presult == 'none') ? 'checked=""' : ''?>><?php echo $lang[518];?></label>
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
	<script>
	$(document).ready(function() {
		$('input[type=submit]').click(function (e) {
		    e.preventDefault();
		    var priv_page = $('input[name=public_page_setting]:checked').val();
		    var priv_result = $('input[name=game_result_setting]:checked').val();
			var t = "<?php echo $time;?>";
			var url = "<?php echo $baseurl ?>";
			var key = "<?php echo $public_key?>";
			var hash = "<?php echo $hash?>";
			url = url + "/ajax/user-privacy.php";
			var uri = 'hash=' + hash + '&public=' + key + '&t=' + t;
			uri += '&pp=' + priv_page + '&pr=' + priv_result;
			
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