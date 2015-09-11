<?php 
require_once('include/config.php');
require_once($basedir . "/include/functions.php");
require_once($basedir . "/include/tx_functions.php");
$user_id = $_SESSION['user_id'];
if (!$user_id) { 
	header('Location: ' . $baseurl . '#login');
	exit;
}

$cpid = (isset($_POST['cpid'])) ? $_POST['cpid'] : 0;
$cc_id = (isset($_POST['cc_id'])) ? $_POST['cc_id'] : 0;
$bill_id = (isset($_POST['bill_id'])) ? $_POST['bill_id'] : 0;
$cc_cvc = (isset($_POST['cc_cvc'])) ? $_POST['cc_cvc'] : 0;
$ret = false;

if (!$cc_id OR !$cc_id OR !$bill_id) { 
	header('Location: ' . $baseurl . '/balance.php');
	exit; 
}

$cp = getCoinPackage($cpid);
$cc = getCreditCard($cc_id);
$bi = getBillAddress($bill_id);
$tax = $cp['cpamount'] * ($config['sale_tax'] / 100);
$order_total = $cp['cpamount'] - $tax;
$coin_amount = $cp['cpcoin'];
$tx_method = 'cc';

$ret = buyCoin($user_id, $cc_id, $bill_id, $cpid, $tx_method, $order_total, $coin_amount, $cc_cvc);

if ($ret['status'] == 'error') {
	// redirect to error page
	exit;
}

$homemenu='active';
?>
<!DOCTYPE HTML>
<html>
<?php include $basedir . '/common/header.php'; ?>
<body>

	<?php include $basedir . '/common/head.php'; ?>


	<div class="container row">
	
		<main role="main" class="row buycoin">

			<h3><?php echo strtoupper($lang[341]); //BUY COIN?></h3>
			<article id="successarea" class="col span_12">

				<div class="title_box">
					<h4 class="title"><?php echo $lang[355]; //Complete!?></h4>
					<p class="desc"><?php echo $lang[356]; //Added COIN to your wallet successfully.?></p>
				</div>

				<div class="purchased-box row">
					<div class="col span_12">

						<ul class="purchased-item row">
							<li class="col span_8 item"><?php echo ucfirst($lang[151]); //Purchased Package?></li>
							<li class="col span_4 coin txt-r"><?php echo $cp['cpamount']?><span class="count">COIN</span></li>
						</ul>

					</div>
				</div><!-- .confirm_area END -->
				

				<div class="coinconfirm_box">

					<div class="confirm-area row">
						<div class="col span_6">
					
							<label><?php echo $lang[345]; //Payment Information?></label>
							<ul class="payinfo-box row">
								<li class="row">
									<div class="col span_6 label">
										<?php echo $lang[346]; //Payment Method?> :
									</div>
									<div class="col span_6">
										<?php echo $lang[303]; //Credit Card?>
									</div>
								</li>
								<li class="row">
									<div class="col span_6 label">
										<?php echo $lang[312]; //Card Type?> :
									</div>
									<div class="col span_6">
										<?php echo $cc['cc_type']?>
									</div>
								</li>
								<li class="row">
									<div class="col span_6 label">
										<?php echo $lang[309]; //Card Number?> :
									</div>
									<div class="col span_6">
										************<?php echo substr($cc['cc_number'], -4);?>
									</div>
								</li>
								<li class="row">
									<div class="col span_6 label">
										<?php echo $lang[313]; //Expiry Date?> :
									</div>
									<div class="col span_6">
										<?php echo $cc['cc_exp_mo']?>/<?php echo $cc['cc_exp_yr']?>
									</div>
								</li>
								<li class="row">
									<div class="col span_6 label">
										<?php echo $lang[314]; //Cardholder Name?> :
									</div>
									<div class="col span_6">
										<?php echo $cc['cc_holder_name']?>
									</div>
								</li>
								<li class="row">
									<div class="col span_6 label">
										<?php echo $lang[347]; //Payment Address?> :
									</div>
									<div class="col span_6">
										<ul class="AddressUL">
											<li class="AddressFullName"><?php echo $bi['bill_fullname']?></li>
											<li class="AddressPostalCode"><?php echo $bi['bill_postal']?></li>
											<li class="AddressStateOrRegionAddressLine1"><?php echo $bi['bill_address1']?> <?php echo $bi['bill_address2']?></li>
											<li class="AddressPhoneNumber"><?php echo $lang[316]; //Phone Number?> : <?php echo $bi['bill_phone']?></li>
										</ul>
					
									</div>
								</li>
							</ul>
				
						</div>
						<div class="col span_6">
				
							<label><?php echo $lang[353]; //Order Summary?></label>
							<table class="order-summary">
							<tbody>
								<tr>
									<th class="label"><?php echo $lang[165]; //Transaction ID?></th>
									<td class=""><?php echo $ret['tx_id'];?></td>
								</tr>
								<tr>
									<th class="label"><?php echo $lang[349]; //Transaction Date?></th>
									<td class=""><?php echo $ret['tx_date'];?></td>
								</tr>
								<tr>
									<th class="label"><?php echo $lang[350]; //Selected Item?></th>
									<td class="" id="order-coin"><h6><?php echo $cp['cpcoin']?><span>COIN</span></h6></td>
								</tr>
								<tr>
									<th class="label"><?php echo $lang[134]; //Subtotal?></th>
									<td class="">$ <?php echo $cp['cpamount']?></td>
								</tr>
								<tr>
									<th class="label"><?php echo $lang[351]; //Tax?></th>
									<td class="text-alert">$ <?php echo $tax?><span id="order-tax"></span></td>
								</tr>
				
								<tr class="line-total h3 strong">
									<th class="label"><?php echo $lang[352]; //Order Total?></th>
									<td><span id="order-total">$ <?php echo $order_total?></span></td>
								</tr>
							</tbody>
						</table>
					
						</div>
					</div><!-- .confirm_area END -->


					<div class="foot-btnarea">
						<button class="btn nml" onClick="location.href='<?php echo $baseurl?>/balance.php'"><?php echo $lang[537]; //Purchase History?></button>
						<button class="btn" onClick="location.href='<?php echo $baseurl?>'"><?php echo $lang[538]; //TOP PAGE?></button>
					</div><!-- .foot-btnarea END -->
				
				</div><!-- .coinconfirm_box END -->

			</article>


		</main>

	</div>

	<script src="<?php echo $baseurl?>/js/jquery-1.11.0.min.js"></script>
    <?php include $basedir . '/common/foot.php'; ?>
    <?php include $basedir . '/common/share_modal.php'; ?>

    <script src="<?php echo $baseurl?>/js/jquery.remodal.js"></script>
	<script type="text/javascript" src="<?php echo $baseurl?>/js/main_frontend.js"></script>

</body>

</html>