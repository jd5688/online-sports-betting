<?php 
	$baseurl='.';
	$homemenu='active';
?>
<!DOCTYPE HTML>
<html>
<?php include ''.$baseurl.'/common/header.php'; ?>
<body>

	<?php include ''.$baseurl.'/common/head.php'; ?>


	<div class="container row">
	
		<?php include ''.$baseurl.'/common/myheadmenu.php'; ?>

		<main role="main" class="row gutters">

			<aside id="mymenu" role="mymenu" class="col span_3">

				<?php include ''.$baseurl.'/common/mymenu.php'; ?>

			</aside>


			<article id="myaccount" class="col span_9">

				<div class="box">
					<div class="title_box">
						<h4 class="title">Password</h4>
						<p class="desc">Change your password or recover your current one.</p>
					</div>
	
					<form method="POST" accept-charset="utf-8" class="inputform">
						<p><label for="id_old_password">Old password</label> <input type="password" name="old_password" id="id_old_password" class="form-control"></p>
						<p><label for="id_new_password1">New password</label> <input type="password" name="new_password1" id="id_new_password1" class="form-control"></p>
						<p><label for="id_new_password2">New password confirmation</label> <input type="password" name="new_password2" id="id_new_password2" class="form-control"></p>
	
						<p class="form-actions">
							<input type="submit" class="btn" value="Change Password">
						</p>
					</form>
				</div>

			</article>

		</main>

	</div>

    <?php include ''.$baseurl.'/common/foot.php'; ?>

	<script src="<?php echo $baseurl ?>/js/jquery-1.11.0.min.js"></script>
    <script src="<?php echo $baseurl ?>/js/jquery.remodal.js"></script>
	<script type="text/javascript" src="<?php echo $baseurl ?>/js/main_frontend.js"></script>

	<!-- Slimscroll for Header popup menu -->
	<script type="text/javascript" src="<?php echo $baseurl ?>/js/jquery.slimscroll.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.notifications-menu > .dropdown-menu > li .menu').slimScroll({height: '200px'});
		});
	</script>

</body>

</html>