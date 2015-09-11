<!-- Regist area -->
<div id="signUp" class="quick-signup">

	<div class="container" id="qr-form-cont">
		<div class="row">
			<div class="col span_12">
				<p id="qrwelcome"><?php echo $lang[278]?></p>
				<p id="qrmessage" style="display:none"></p>
			</div>
		</div>

		<form accept-charset="UTF-8" action="" id="quick-register-form" method="post" class="signform row">
			<div class="col span_5">
				<input type="text" id="qr-username" placeholder="<?php echo $lang[269]?>" name="name" required>
			</div>
			<div class="col span_5">
				<input type="email" id="qr-email" placeholder="<?php echo $lang[270]?>" name="email" required>
			</div>
			<div class="col span_2">
				<button type="submit" class="btn signup"><?php echo $lang[268]; //SIGN UP?></button>
			</div>
		</form>

	</div>

	<div class="signup-success" id="qr-success-message">
		<div class="row">
			<div class="col span_12">
				<p><?php echo $lang[279]?></p>
			</div>
		</div>
	</div>

</div>
<!-- / Regist area -->