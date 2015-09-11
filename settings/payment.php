<?php 
require_once('../include/config.php');
require_once($basedir . "/include/functions.php");
require_once($basedir . '/include/user_functions.php');
//ini_set('display_errors', 1);
//error_reporting(~0);
if (!$user_id) {
	// go to login page
	header('Location: '. $baseurl . '#login');
	exit;
}

$settingsmenu = 'active';
$paymentmenu = 'active';
$pay_info = getPaymentInfo($user_id);
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
						<h4 class="title"><?php echo $lang[492];?></h4>
						<p class="desc"><?php echo $lang[519];?></p>
					</div>
	
					<form method="POST" accept-charset="utf-8" class="inputform">
					
						<h6 class="title"><?php echo $lang[305]; //Registered Credit Card?></h6>

						<!-- DISPLAY REGISTERED CARDS -->
						<div id="currentcc">
						<?php 
						if ($pay_info) { 
							foreach ($pay_info as $cc) {	
								$bill = $cc['ba'];
						?>
							<div class="inner row">
								<div class="col span_10">
									<ul class="payinfo-box row">
										<li class="row">
											<div class="col span_6 label">
												<?php echo $lang[312]; //Card Type?> :
											</div>
											<div class="col span_6">
												<?php echo strtoupper($cc['cc_type'])?>
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
												<?php echo $lang[314]; ?> :
											</div>
											<div class="col span_6">
												<?php echo $cc['cc_holder_name']?>
											</div>
										</li>
										<li class="row">
											<div class="col span_6 label">
												<?php echo $lang[315]; //Billing Address?> :
											</div>
											<div class="col span_6">
												<ul class="AddressUL">
												<li class="AddressFullName"><?php echo $bill['bill_fullname']?></li>
												<li class="AddressPostalCode"><?php echo $bill['bill_postal']?></li>
												<li class="AddressStateOrRegionAddressLine1"><?php echo $bill['bill_address1'] . $bill['bill_address2'];?></li>
												<li class="AddressPhoneNumber"><?php echo $lang[316]; //Phone Number?> : <?php echo $bill['bill_phone']?></li>
												</ul>
											</div>
										</li>
									</ul>
								</div>
								<div class="col span_2">
									<a href="<?php echo $baseurl?>/settings/payment_edit.php?id=<?php echo $cc['cc_id']?>&h=<?php echo $hash?>&k=<?php echo $public_key?>&t=<?php echo $time?>"><?php echo strtoupper($lang[37])?></a>
									<button name="delete-button" id="<?php echo $cc['cc_id']?>"><?php echo strtoupper($lang[558]) //DELETE?></button>
									<input type="hidden" id="bill_id_<?php echo $cc['cc_id']?>" value="<?php echo $bill['bill_id']?>" >
								</div>
							</div>
						<?php
							} // foreach
						} // if
						?>
	
							<a id="addcardbtn" class="addnew" href="<?php echo $baseurl?>/settings/payment_add.php"><?php echo $lang[307]; //ADD A NEW CARD?></a>
						</div><!-- #currentcc END -->

					
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
	$('button[name=delete-button]').click(function (e) {
		e.preventDefault();
		if (!confirm('Are you sure?')) { return; }
		
		var cc_id = $(e.currentTarget).attr('id');
		var bill_id = $('#bill_id_' + cc_id).val();
		var t = "<?php echo $time;?>";
        var url = "<?php echo $baseurl ?>";
        var key = "<?php echo $public_key?>";
        var hash = "<?php echo $hash?>";
        url = url + "/ajax/delete-creditcard.php";
        var uri = 'hash=' + hash + '&public=' + key + '&t=' + t;
        uri += '&cc_id=' + cc_id + '&bill_id=' + bill_id;

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
                if (data.error === '0') {
                	window.location.replace("<?php echo $baseurl?>/settings/payment.php");
                }
            }
            
        });
	});
})
</script>