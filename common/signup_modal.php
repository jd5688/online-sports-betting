<div id="signup-window" class="remodal" data-remodal-id="signup">
	<div class="modal-head">
		<div class="row">
			<div class="col span_12">
				<h2><?php echo $lang[268]; // SIGN UP ?></h2>
			</div>
		</div><!-- /.row -->
	</div><!-- /.modal-head -->
	<div class="modal-body">
		<div class="row">

			<div class="col span_12">

				<span id="registration-form-cont">
				<form id="registration-form" role="form">
				<div class="form-group">
					<label for="signupInputUsername1"><?php echo $lang[175]; // Username ?></label>
					<input type="text" class="form-control" id="rusername" placeholder="<?php echo $lang[269]; // Enter username?>" required="">
				</div>
				
				<div class="form-group">
					<label for="signupInputEmail1">Email</label>
					<input type="email" class="form-control" id="remail-address" placeholder="<?php echo $lang[270]; //Enter email address?>" required="">
					<span class="help-block"><?php echo $lang[271];?></span>
				</div>
				<?php
				$tos_link = '<a href="#" target="_blank">'.$lang[273].'</a>';
				$privacy_link = '<a href="#" target="_blank">'.$lang[274].'</a>';
				$agree_to_terms = str_replace('$TOS_VARIABLE', $tos_link, $lang[272]);
				$agree_to_terms = str_replace('$PRIVACY_VARIABLE', $privacy_link, $agree_to_terms);
				?>
				<p class="tos-info"><?php echo $agree_to_terms;?>.</p>

				<button type="submit" id="register_user" class="btn"><?php echo $lang[275]; //Create an account?></button>
				<span id="rmessage"></span>
				</form>
				</span>
				<span id="registration-message-cont" style="display:none">
					<p><?php echo $lang[277];?></p>
					<button id="register-user-close" class="btn"><?php echo $lang[276]; //Close?></button>
				</span>
				
				
		</div><!-- /.row -->
	</div><!-- /.modal-body -->

</div><!-- /#signup-window -->
<script>
$(document).ready(function() {
	$("#registration-form").bind("submit", registerUser);
	function registerUser(e) {
		e.preventDefault();
		e.target.checkValidity();
		var useremail = $('#remail-address').val();
		var username = $('#rusername').val();
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
					$('#registration-form-cont').hide();
					$('#registration-message-cont').show();
					//window.location.replace(came_from);
				} else {
					$('#remail-address').val('');
					$('#rusername').val('');
					$('#rmessage').html(data.status);
					setTimeout(function() {
						$('#rmessage').html('');
					}, 2000);
				}
			}
			
		});
	}
	$('#register-user-close').click(function() {
		var came_from = "http://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>";
		window.location.replace(came_from);
	})
})
</script>
