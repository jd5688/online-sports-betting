<?php 
require_once('include/config.php');
require_once($basedir . "/include/functions.php");
require_once($basedir . "/include/tx_functions.php");

if (!$user_id) { 
	header('Location: ' . $baseurl . '#login');
	exit;
}

$homemenu='active';

$curpackage_selected = 0;
if (isset($_POST['cc_number'])) {
	$curpackage_selected = addCreditCardAndBilling($_POST, $user_id);
}


$coin_packages = getCoinPackages();
$creditcards = getCreditCards($user_id);
$billaddresses = getBillAddresses($user_id);
?>
<!DOCTYPE HTML>
<html>
<?php include $basedir .'/common/header.php'; ?>
<body>

	<?php include $basedir .'/common/head.php'; ?>


	<div class="container row">
	
		<main role="main" class="row buycoin">

			<h3><?php echo strtoupper($lang[341]); //BUY COIN?></h3>
			
			<article id="packagearea" class="col span_12 active">

				<div class="title_box">
					<span class="stepnum">1</span>
					<h4 class="title"><?php echo $lang[299]; //Choose COIN Package?></h4>
					<p class="desc"><?php echo $lang[300]; //Choose from the COIN packages below?></p>
				</div>
				<?php include $basedir .'/common/package_select.php'; ?>

			</article><!-- #packagearea END -->

			<article id="paymentarea" class="col span_12">

				<div class="title_box">
					<span class="stepnum">2</span>
					<h4 class="title"><?php echo $lang[301]; //Choose Payment method; ?></h4>
					<p class="desc"><?php echo $lang[302]; //Choose your desired payment method;?></p>
				</div>
				<?php include $basedir .'/common/payment_select.php'; ?>

			</article><!-- #paymentarea END -->

			<article id="coinconfirmarea" class="col span_12">

				<div class="title_box">
					<span class="stepnum">3</span>
					<h4 class="title"><?php echo ucfirst($lang[221]); //Confirm; ?></h4>
					<p class="desc"><?php echo $lang[302]; ?></p>
				</div>

				<div class="coinconfirm_box">

					<?php include $basedir .'/common/coinconfirm_area.php'; ?>
					
					<form name="confirm-purchase" action="<?php echo $baseurl?>/buycoin_success.php" method="POST">
					<div class="foot-btnarea">

						<div id="cvc_input" style="display:none">
								<label for="addCreditCardCVCNumber"><?php echo $lang[311]; //CVC Number?></label>
								<input type="tel" name="cc_cvc" size="25" autocomplete="off" class="form-control" placeholder="<?php echo $lang[311];?>" required>
						</div><!-- /#cvc_input END -->

						<button id="buy-complete" class="btn buycoinbtn"><?php echo $lang[354]; //BUY COIN & COMPLETE?></button>
						<input type="hidden" name="cpid" value=""/>
						<input type="hidden" name="cc_id" value=""/>
						<input type="hidden" name="bill_id" value=""/>
					</div><!-- .foot-btnarea END -->
					</form>
				</div><!-- .coinconfirm_box END -->


			</article><!-- #coinconfirmarea END -->

		</main>

	</div>

	<script src="<?php echo $baseurl;?>/js/jquery-1.11.0.min.js"></script>
	<script src="<?php echo $baseurl;?>/js/jquery.remodal.js"></script>
    <?php include $basedir .'/common/foot.php'; ?>

	<script type="text/javascript" src="<?php echo $baseurl;?>/js/main_frontend.js"></script>
	<script type="text/javascript" src="<?php echo $baseurl;?>/js/buycoin.js"></script>
	
	<!-- JS for Payment Method Tabs -->
	<script type="text/javascript" src="<?php echo $baseurl;?>/js/classList.js"></script>
	<script type="text/javascript" src="<?php echo $baseurl;?>/js/tabby.js"></script>
	<script>
	    tabby.init();
	</script>

	<script src="<?php echo $baseurl;?>/js/jquery.minimalect.min.js"></script>
	<script type="text/javascript">
	  $(document).ready(function(){
	    $("#newccinput select").minimalect();
	  });
	</script>


</body>

</html>
<script>
$(document).ready(function() {
	var item_radio = 0;
	var creditcards = "<?php echo count($creditcards);?>";
	var billaddresses = "<?php echo count($billaddresses);?>";
	var curpackage_selected = "<?php echo $curpackage_selected;?>";
	// check if there's no credit cards on the record
	// automatically open up the form for adding credit card
	if (creditcards === "0") {
		$('span#addcardbtn').click();
	}

	// if there's no bill address on record
	// automatically select add new billing address radio

	if (billaddresses === "0") {
		$('input[name=billadd_radio][value=billadd_new]').click();
	}

	// check if user already selected a coin package
	// if yes, click it
	if (curpackage_selected !== "0") {
		$('input[name=item_radio][value=' + curpackage_selected +']').click();
	}

	$('input[name=item_radio]').click(function(e) {
		item_radio = $(e.currentTarget).attr('value');
		$('input[name=checked_package]').val(item_radio);
	})
	
	$('#buy-complete').click(function() {
		$('form[name=confirm-purchase]').submit();
	})

	$('li[data-tab=#creditbox], li[data-tab=#nettelerbox]').click(function() {
		$('#coinconfirmarea').removeClass("active");
        $('#cvc_input').hide();
        $('button#buy-complete').removeClass("active");
	})
	
	// after payment method has been selected this function is called
	// by buycoin.js
	confirmationArea = function(e) {
		var cc_id = $(e.currentTarget).val();
		var billing = $('input[name=billing_' + cc_id + ']').val();
		var cc = $('input[name=creditcard_' + cc_id + ']').val();
		var coin_packages = '<?php echo json_encode($coin_packages);?>';
		var coinpackage = $('input[name=checked_package]').val(); // this is the cpid
		var tax = <?php echo $config['sale_tax'];?>;
		var cp_amount = 0;
		billing = $.parseJSON(decodeURIComponent(billing));
		cc = $.parseJSON(decodeURIComponent(cc));
		coin_packages = $.parseJSON(coin_packages);
		cp_amount = Number(coin_packages[coinpackage].cpamount);
		tax = Number(cp_amount) * (tax / 100);
		
		// initialize always.
		// user may be changing coin package
		$('#card-type').html('');
		$('#card-number').html('');
		$('#card-expiry').html('');
		$('#card-fullname').html('');
		$('#bill-fullname').html('');
		$('#bill-postal').html('');
		$('#bill-address').html('');
		$('#bill-phone').html('');
		$('#order-coin h6').html("<span>COIN</span>");
		$('#order-amount').html('');
		$('#order-tax').html('');
		$('#order-total').html('$ ');
		
		$('#card-type').html(cc.cc_type);
		$('#card-number').html(cc.cc_number.toString().substr(-4));
		$('#card-expiry').html(cc.cc_exp_mo + '/' + cc.cc_exp_yr);
		$('#card-fullname').html(cc.cc_holder_name.replace("+", " "));
		$('#bill-fullname').html(billing.bill_fullname.replace("+", " "));
		$('#bill-postal').html(billing.bill_postal.replace("+", " "));
		$('#bill-address').html(billing.bill_address1.replace(/\+/g, " ") + ' ' + billing.bill_address2.replace(/\+/g, " "));
		$('#bill-phone').html(billing.bill_phone.replace("+", " "));
		$('#order-coin h6').prepend(coin_packages[coinpackage].cpcoin);
		$('#order-amount').html(cp_amount);
		$('#order-tax').html(tax);
		$('#order-total').append(cp_amount - tax);
		$('input[name=cpid]').val(coinpackage);
		$('input[name=cc_id]').val(cc_id);
		$('input[name=bill_id]').val(billing.bill_id);
		return;
	}
})
</script>