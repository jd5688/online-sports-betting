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

if (isset($_POST['cc_id'])) {
	editCreditInfo($_POST);
	header('Location: '. $baseurl . '/settings/payment.php');
	exit;
}

$private_key = $config['private_key'];
$hash = (isset($_REQUEST['h'])) ? $_REQUEST['h'] : 0;
$public_key = (isset($_REQUEST['k'])) ? $_REQUEST['k'] : 0;
$time = (isset($_REQUEST['t'])) ? $_REQUEST['t'] : 0;
$cc_id = (isset($_REQUEST['id']) AND $_REQUEST['id']) ? $_REQUEST['id'] : 0;

$myhash = md5($public_key . $private_key . $time);

if ($hash != $myhash) {
	echo json_encode(array('error' => '1', 'status' => $lang[215]));
	exit;
}
if (!$cc_id) { exit; }

$cc = getPaymentInfo(0, $cc_id);
if (!$cc) {
	header('Location: '. $baseurl . '/settings/payment.php');
	exit;
}

$bill = $cc['ba'];
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
	
					<form method="POST" action="<?php echo $baseurl?>/settings/payment_edit.php" accept-charset="utf-8" class="inputform">
					
						<div class="addressinputarea">
	
							<h6 class="title">Edit Credit Card Info</h6>
							<div class="ccinputarea">

							<p><label for="creditCardIssuer"><?php echo $lang[312]; //Card Type?></label>
							<?php echo strtoupper($cc['cc_type'])?>
							</p>

							<p><label for="addCreditCardNumber"><?php echo $lang[309]; //Card Number?></label>
							************<?php echo substr($cc['cc_number'], -4);?>
							</p>

							<p><label for="card-name"><?php echo $lang[314]; //Cardholder Name?></label>
							<input type="text" name="cc_holder_name" size="25" maxlength="40" value="<?php echo $cc['cc_holder_name']?>" autocomplete="off" class="form-control" placeholder="<?php echo $lang[314]; //Cardholder Name?>" required>
							</p>

							<div class="expiredate">
									<p><label for="newCreditCardMonth"><?php echo $lang[313]; //Expiry Date?></label>
									<select name="cc_exp_mo" title="月" required>
									    <option value="01" <?php echo ($cc['cc_exp_mo'] == '01') ? 'selected="selected"' : '';?>>01</option>
									    <option value="02" <?php echo ($cc['cc_exp_mo'] == '02') ? 'selected="selected"' : '';?>>02</option>
									    <option value="03" <?php echo ($cc['cc_exp_mo'] == '03') ? 'selected="selected"' : '';?>>03</option>
									    <option value="04" <?php echo ($cc['cc_exp_mo'] == '04') ? 'selected="selected"' : '';?>>04</option>
									    <option value="05" <?php echo ($cc['cc_exp_mo'] == '05') ? 'selected="selected"' : '';?>>05</option>
									    <option value="06" <?php echo ($cc['cc_exp_mo'] == '06') ? 'selected="selected"' : '';?>>06</option>
									    <option value="07" <?php echo ($cc['cc_exp_mo'] == '07') ? 'selected="selected"' : '';?>>07</option>
									    <option value="08" <?php echo ($cc['cc_exp_mo'] == '08') ? 'selected="selected"' : '';?>>08</option>
									    <option value="09" <?php echo ($cc['cc_exp_mo'] == '09') ? 'selected="selected"' : '';?>>09</option>
									    <option value="10" <?php echo ($cc['cc_exp_mo'] == '10') ? 'selected="selected"' : '';?>>10</option>
									    <option value="11" <?php echo ($cc['cc_exp_mo'] == '11') ? 'selected="selected"' : '';?>>11</option>
									    <option value="12" <?php echo ($cc['cc_exp_mo'] == '12') ? 'selected="selected"' : '';?>>12</option>
									</select>
									<select name="cc_exp_yr" title="年" required>
									<?php
									$fdate = date('Y') - 1; 
									for ($i = 0; $i < 5; $i++) { 
										$fdate++;
										$selected = ($cc['cc_exp_yr'] == $fdate) ? 'selected="selected"' : '';
									?>
									    <option value="<?php echo $fdate;?>" <?php echo $selected?>><?php echo $fdate;?></option>
									<?php } // for?>
									</select>
									</p>
								</div><!-- .expiredate END -->

						</div><!-- .ccinputarea END -->
	
							<h6 class="title">Edit Billing Address info</h6>
	
							<div class="ccinputarea inputadd">

							<p><label for="enterAddressFullName"><?php echo $lang[322]; //Your Name?></label>
							<input type="text" name="bill_fullname" class="enterAddressFormField form-control" size="50" maxlength="50" value="<?php echo $bill['bill_fullname']?>" placeholder="<?php echo $lang[324];?>" >
							</p>


							<p><label for="enterAddressFullName"><?php echo $lang[323]; //Postal Code?></label>
							<input type="text" name="bill_postal" class="enterAddressFormField form-control" maxlength="10" size="10" value="<?php echo $bill['bill_postal']?>" placeholder="<?php echo $lang[323];?>" >
							</p>

							<p><label for="enterAddressStateOrRegion"><?php echo $lang[325]; //都道府県?></label>
								<select name="bill_prefecture" class="enterAddressFormField">
									<option value="na" <?php echo ($bill['bill_prefecture'] == '') ? 'selected="selected"' : '';?>>n/a</option>
									<option value="北海道" <?php echo ($bill['bill_prefecture'] == '北海道') ? 'selected="selected"' : '';?>>北海道</option>
									<option value="青森県" <?php echo ($bill['bill_prefecture'] == '青森県') ? 'selected="selected"' : '';?>>青森県</option>
									<option value="岩手県" <?php echo ($bill['bill_prefecture'] == '岩手県') ? 'selected="selected"' : '';?>>岩手県</option>
									<option value="宮城県" <?php echo ($bill['bill_prefecture'] == '宮城県') ? 'selected="selected"' : '';?>>宮城県</option>
									<option value="秋田県" <?php echo ($bill['bill_prefecture'] == '秋田県') ? 'selected="selected"' : '';?>>秋田県</option>
								</select>
							</p>

							<p><label for="enterAddressAddressLine1"><?php echo $lang[326]; //Address1?></label>
							<input type="text" name="bill_address1" class="enterAddressFormField form-control" size="50" maxlength="60" value="<?php echo $bill['bill_address1']?>" placeholder="<?php echo $lang[326];?>" >
							</p>

							<p><label for="enterAddressAddressLine2"><?php echo $lang[327]; //Address2?></label>
							<input type="text" name="bill_address2" class="enterAddressFormField form-control" size="50" maxlength="60" value="<?php echo $bill['bill_address2']?>" placeholder="<?php echo $lang[327];?>">
							</p>

							<p><label for="enterAddressPhoneNumber"><?php echo $lang[316]; //Phone Number?></label>
							<input type="tel" name="bill_phone" class="enterAddressFormField form-control" size="15" maxlength="20" value="<?php echo $bill['bill_phone']?>" placeholder="<?php echo $lang[316];?>">
							</p>

						</div><!-- .inputadd END -->
	
						</div><!-- .addressinputarea END -->

						<p class="form-actions">
							<input type="submit" class="btn" value="Submit">
							<input type="submit" class="btn cancel" value="Cancel">
							<input type="hidden" name="cc_id" value="<?php echo $cc_id; ?>"/>
							<input type="hidden" name="bill_id" value="<?php echo $bill['bill_id']; ?>"/>
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
	/*
	$("form").bind("submit", submitForm);
	function submitForm(e) {
	    e.preventDefault();
	    e.target.checkValidity();
	    return true;
	} */
})
</script>