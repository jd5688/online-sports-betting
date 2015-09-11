<?php 
$basedir = (isset($basedir)) ? $basedir : '../';
require_once($basedir . '/include/config.php');
require_once($basedir . "/include/functions.php");
require_once($basedir . '/include/user_functions.php');

if (!$user_id) {
	// go to login page
	header('Location: '. $baseurl . '#login');
	exit;
}

$settingsmenu = 'active';
$passwordmenu='active';
?>
<!DOCTYPE HTML>
<html>
<?php include $basedir . '/common/header.php'; ?>
<body>

	<?php include $basedir . '/common/head.php'; ?>


	<div class="container row">
		<?php include $basedir . '/common/myheadmenu.php';?>
		<main role="main" class="row gutters mypage">
			<article id="myaccount" class="col span_9">
				<div class="box">
					<div class="title_box">
						<h4 class="title"><?php echo $lang[331]; //Password?></h4>
						<p class="desc"><?php echo $lang[332]; //Change your password?></p>
					</div>
	
					<form method="POST" accept-charset="utf-8" class="inputform">
						<p><label for="id_old_password"><?php echo $lang[333]; //Old password?></label> 
						<input type="password" name="old_password" id="id_old_password" class="form-control" required></p>
						<p><label for="id_new_password1"><?php echo $lang[334]; //New password?></label> 
						<input type="password" name="new_password1" id="id_new_password1" class="form-control" required></p>
						<p><label for="id_new_password2"><?php echo $lang[335]; //New password confirm?></label> 
						<input type="password" name="new_password2" id="id_new_password2" class="form-control" required></p>
	
						<p class="form-actions">
							<input type="submit" class="btn" value="<?php echo $lang[336]; //Change Password?>">
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
	<script src="<?php echo $baseurl;?>/js/jquery-1.11.0.min.js"></script>
    <?php include $basedir . '/common/foot.php'; ?>

    <script src="<?php echo $baseurl;?>/js/jquery.remodal.js"></script>
	<script type="text/javascript" src="<?php echo $baseurl;?>/js/main_frontend.js"></script>

</body>

</html>
<script>
$(document).ready(function () {
	$("form").bind("submit", submitForm);
	function submitForm(e) {
	    e.preventDefault();
	    e.target.checkValidity();
	    var oldpass = $('input[name="old_password"]').val();
	    var newpass1 = $('input[name="new_password1"]').val();
	    var newpass2 = $('input[name="new_password2"]').val();
	    var t = "<?php echo $time;?>";
	    var url = "<?php echo $baseurl ?>";
	    var key = "<?php echo $public_key?>";
	    var hash = "<?php echo $hash?>";
	    url = url + "/ajax/changepass.php";
	    var uri = 'hash=' + hash + '&public=' + key + '&t=' + t;
	    uri += '&op=' + oldpass + '&np1=' + newpass1 + '&np2=' + newpass2;
	
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
	                 $('input[name="old_password"]').val('');
	                 $('input[name="new_password1"]').val('');
	                 $('input[name="new_password2"]').val('');
	            }
                $('#message').html(data.message);
                setTimeout(function() {
	                $('#message').html('');
                }, 3000)
	        }
	        
	    });
	}
})
</script>