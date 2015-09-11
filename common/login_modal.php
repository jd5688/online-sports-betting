<?php
$ksi = (isset($_COOKIE['keep_signed_in'])) ? intval($_COOKIE['keep_signed_in']) : 0;
if ($ksi) {
	$ksi_checked = "checked=''";
	$useremail = $_COOKIE['email'];
	$userpassword = $_COOKIE['password'];
} else {
	$ksi_checked = '';
	$useremail = '';
	$userpassword = '';
}
?>
<div id="login-window" class="remodal" data-remodal-id="login">	
	<div class="modal-head">
		<div class="row">
			<div class="col span_12">
				<h2>SIGN IN</h2>
			</div>
		</div><!-- /.row -->
	</div><!-- /.modal-head -->
	<div class="modal-body">
		<div class="row">

			<div class="col span_12">

				<form id="login_form" role="form">
					<div class="form-group">
						<label for="signinInputEmail1">Email</label>
						<input type="email" class="form-control" id="useremail" placeholder="Enter Email address" value="<?php echo $useremail?>" required>
					</div>
					<div class="form-group">
						<label for="signinInputPassword1">Password <a href="#">forgot password</a></label>
						<input type="password" class="form-control" id="userpassword" placeholder="Enter Password" value="<?php echo $userpassword?>" required>
					</div>
					<div class="checkbox keeplogin">
						<label class="cbxbd"><input type="checkbox" id="keep-signed-in" value="1" <?php echo $ksi_checked;?>>Keep me logged in</label>
					</div>

					<button type="submit" id="signin_user" class="btn">Login</button>
					<span id='login-message-area'></span>
				</form>

			</div>

		</div><!-- /.row -->
	</div><!-- /.modal-body -->
</div><!-- /#login-window -->
<script>
$(document).ready(function() {
	var ksi = "<?php echo $ksi?>";
	if (ksi === '1') {
		$('#keep-signed-in').parent().addClass("c_on");
	}
	$("#login_form").bind("submit", loginUser);
	function loginUser(e) {
		e.preventDefault();
		e.target.checkValidity();
		var came_from = "http://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>";
		var useremail = $('#useremail').val();
		var password = $('#userpassword').val();
		var keep_signed_in = $('#keep-signed-in').is(":checked");
		var t = "<?php echo $time;?>";
		var url = "<?php echo $baseurl ?>";
		var key = "<?php echo $public_key?>";
		var hash = "<?php echo $hash?>";
		url = url + "/ajax/login.php";
		var uri = 'hash=' + hash + '&public=' + key + '&t=' + t;
		uri += '&email=' + useremail + '&p=' + password + '&ksi=' + keep_signed_in;
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
					window.location.replace(came_from);
				} else {
					$('#login-message-area').html(data.status);
					$('#useremail').val('');
					$('#userpassword').val('');
					setTimeout(function() {
						$('#login-message-area').html('');
					}, 2000);
				}
			}
			
		});
	}
})
</script>