<?php 
require_once('../include/config.php');
require_once($basedir . "/include/functions.php");
require_once($basedir . '/include/user_functions.php');
if (!$user_id) {
	// go to login page
	header('Location: '. $baseurl . '#login');
	exit;
}

$settingsmenu = 'active';
$paymentmenu = 'active';

if (isset($_POST['cc_type'])) {
	addCreditInfo($_POST);
	header('Location: '. $baseurl . '/settings/payment.php');
	exit;
}
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
						<h4 class="title">Payment</h4>
						<p class="desc">Add or edit your registered payment information.</p>
					</div>
	
					<form method="POST" action="<?php echo $baseurl?>/settings/payment_add.php" accept-charset="utf-8" class="inputform">
					

						<div class="addressinputarea">
	
							<h6 class="title"><?php echo $lang[308]; //Input Credit Card Info?></h6>
							<div class="ccinputarea">

							<p><label for="creditCardIssuer"><?php echo $lang[312]; //Card Type?></label>
							<select name="cc_type" required>
						        <option value="Visa" selected="selected">Visa</option>
						        <option value="Master">MasterCard</option>
							</select>
							</p>

							<p><label for="addCreditCardNumber"><?php echo $lang[309]; //Card Number?></label>
							<input type="tel" name="cc_number" size="25" autocomplete="off" class="form-control" placeholder="<?php echo $lang[310];?>" required>
							</p>

							<p><label for="card-name"><?php echo $lang[314]; //Cardholder Name?></label>
							<input type="text" name="cc_holder_name" size="25" maxlength="40" value="" autocomplete="off" class="form-control" placeholder="<?php echo $lang[314]; //Cardholder Name?>" required>
							</p>

							<div class="expiredate">
									<p><label for="newCreditCardMonth"><?php echo $lang[313]; //Expiry Date?></label>
									<select name="cc_exp_mo" title="月" required>
									    <option value="01" selected="selected">01</option>
									    <option value="02">02</option>
									    <option value="03">03</option>
									    <option value="04">04</option>
									    <option value="05">05</option>
									    <option value="06">06</option>
									    <option value="07">07</option>
									    <option value="08">08</option>
									    <option value="09">09</option>
									    <option value="10">10</option>
									    <option value="11">11</option>
									    <option value="12">12</option>
									</select>
									<select name="cc_exp_yr" title="年" required>
									    <option value="<?php echo date('Y');?>" selected="selected"><?php echo date('Y');?></option>
									<?php
									$fdate = date('Y'); 
									for ($i = 0; $i < 5; $i++) { 
										$fdate++;
									?>
									    <option value="<?php echo $fdate;?>"><?php echo $fdate;?></option>
									<?php } // for?>
									</select>
									</p>
								</div><!-- .expiredate END -->

						</div><!-- .ccinputarea END -->
	
							<h6 class="title"><?php echo $lang[317]; //Input Billing Address info?></h6>
	
							<div class="ccinputarea inputadd">

							<p><label for="enterAddressFullName"><?php echo $lang[322]; //Your Name?></label>
							<input type="text" name="bill_fullname" class="enterAddressFormField form-control" size="50" maxlength="50" placeholder="<?php echo $lang[324];?>" >
							</p>


							<p><label for="enterAddressFullName"><?php echo $lang[323]; //Postal Code?></label>
							<input type="text" name="bill_postal" class="enterAddressFormField form-control" maxlength="10" size="10" placeholder="<?php echo $lang[323];?>" >
							</p>

							<p><label for="enterAddressStateOrRegion"><?php echo $lang[325]; //都道府県?></label>
								<select name="bill_prefecture" class="enterAddressFormField">
									<option value="na">n/a</option>
									<option value="北海道">北海道</option>
									<option value="青森県">青森県</option>
									<option value="岩手県">岩手県</option>
									<option value="宮城県">宮城県</option>
									<option value="秋田県">秋田県</option>
								</select>
							</p>

							<p><label for="enterAddressAddressLine1"><?php echo $lang[326]; //Address1?></label>
							<input type="text" name="bill_address1" class="enterAddressFormField form-control" size="50" maxlength="60" placeholder="<?php echo $lang[326];?>" >
							</p>

							<p><label for="enterAddressAddressLine2"><?php echo $lang[327]; //Address2?></label>
							<input type="text" name="bill_address2" class="enterAddressFormField form-control" size="50" maxlength="60" placeholder="<?php echo $lang[327];?>">
							</p>

							<p><label for="enterAddressPhoneNumber"><?php echo $lang[316]; //Phone Number?></label>
							<input type="tel" name="bill_phone" class="enterAddressFormField form-control" size="15" maxlength="20" placeholder="<?php echo $lang[316];?>">
							</p>

						</div><!-- .inputadd END -->
	
						</div><!-- .addressinputarea END -->

						<p class="form-actions">
							<input type="submit" class="btn" value="Submit">
							<input type="submit" class="btn cancel" value="Cancel">
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

	<script src="<?php echo $baseurl?>/js/jquery.minimalect.min.js"></script>
	<script type="text/javascript">
	  $(document).ready(function(){
	    $("#myaccount form.inputform select").minimalect();
	  });
	</script>


</body>

</html>
<script>
$(document).ready(function () {
	$('input.btn.cancel').click(function (e) {
		e.preventDefault();
		window.location.replace("<?php echo $baseurl?>/settings/payment.php");
	})
})
</script>