<div class="paymethod_box">
	<ul class="methodtab tabs row">
		<li class="active" data-tab="#creditbox"><span><?php echo $lang[303]; //Credit Card?></span></li>
		<li data-tab="#nettelerbox"><span><?php echo $lang[304]; //Neteller?></span></li>
	</ul>

	<div class="tabs-content">

		<div id="creditbox" class="tabs-pane active">

			<!-- DISPLAY REGISTERED CARDS -->
			<div id="currentcc" class="paymethod_radio row">

				<h5 class="title"><?php echo $lang[305]; //Registered Credit Card?></h5>
				<?php
				if ($creditcards) {
					foreach ($creditcards as $cc) {
						$bill = $billaddresses[$cc['bill_id']];
				?>
				<label class="cbxbd">		
					<div class="inner row">
						<input type="radio" name="card_radio" value="<?php echo $cc['cc_id']?>">
						<div class="col span_5">
					<?php echo $lang[306]; //USE THIS CARD?>
				</div>
						<div class="col span_7">
					<ul class="payinfo-box row">
						<li class="row">
							<div class="col span_4 label">
								<?php echo $lang[312]; //Card Type?> :
							</div>
							<div class="col span_8">
								<?php echo $cc['cc_type']?>
							</div>
						</li>
						<li class="row">
							<div class="col span_4 label">
								<?php echo $lang[309]; //Card Number?> :
							</div>
							<div class="col span_8">
								************<?php echo substr($cc['cc_number'], -4);?>
							</div>
						</li>
						<li class="row">
							<div class="col span_4 label">
								<?php echo $lang[313]; //Expiry Date?> :
							</div>
							<div class="col span_8">
								<?php echo $cc['cc_exp_mo']?>/<?php echo $cc['cc_exp_yr']?>
							</div>
						</li>
						<li class="row">
							<div class="col span_4 label">
								<?php echo $lang[314]; ?> :
							</div>
							<div class="col span_8">
								<?php echo $cc['cc_holder_name']?>
							</div>
						</li>
						<li class="row">
							<div class="col span_4 label">
								<?php echo $lang[315]; //Billing Address?> :
							</div>
							<div class="col span_8">
								<ul class="AddressUL">
								<li class="AddressFullName"><?php echo $bill['bill_fullname']?></li>
								<li class="AddressPostalCode"><?php echo $bill['bill_postal']?></li>
								<li class="AddressStateOrRegionAddressLine1"><?php echo $bill['bill_address1'] . $bill['bill_address2'];?></li>
								<li class="AddressPhoneNumber"><?php echo $lang[316]; //Phone Number?> : <?php echo $bill['bill_phone']?></li>
								</ul>
								<input type="hidden" name="billing_<?php echo $cc['cc_id']?>" value="<?php echo urlencode(json_encode($bill));?>"/>
								<input type="hidden" name="creditcard_<?php echo $cc['cc_id']?>" value="<?php echo urlencode(json_encode($cc));?>"/>
							</div>
						</li>
					</ul>
				</div>
					</div><!-- /.inner END -->
				</label><!-- /label.cbxbd registercard 1 END -->
				<?php
					} // foreach
				} // if creditcards
				?>

				<span id="addcardbtn" class="addnew"><?php echo $lang[307]; //ADD A NEW CARD?></span>

			</div><!-- #currentcc END -->


			<form action="<?php echo $baseurl?>/buycoin.php" method="POST">
			<!-- NEW CREDIT CARD INPUT AREA -->
			<div id="newccinput" class="newccinput">

				<div class="row gutters addressinputarea">
					<div class="col span_6">
					
						<h6 class="title"><?php echo $lang[308]; //Input Credit Card Info?></h6>

						<div class="ccinputarea">
							<div class="row">
								<div class="col span_12">
									<p><label for="creditCardIssuer"><?php echo $lang[312]; //Card Type?></label></p>
									<select name="cc_type" required>
								        <option value="Visa" selected="selected">Visa</option>
								        <option value="Master">MasterCard</option>
									</select>
								</div>
							</div><!-- /card type END -->

							<div class="row">
								<div class="col span_12">
									<label for="addCreditCardNumber"><?php echo $lang[309]; //Card Number?></label>
									<input type="tel" name="cc_number" size="25" autocomplete="off" class="form-control" placeholder="<?php echo $lang[310];?>" required>
								</div>
							</div><!-- /card number END -->

							<div class="row">
								<div class="col span_12">
									<label for="card-name"><?php echo $lang[314]; //Cardholder Name?></label>
									<input type="text" name="cc_holder_name" size="25" maxlength="40" value="" autocomplete="off" class="form-control" placeholder="<?php echo $lang[314]; //Cardholder Name?>" required>
								</div>
							</div><!-- /Cardholder END -->

							<div class="row">

								<div class="col span_12 expiredate">
									<p><label for="newCreditCardMonth"><?php echo $lang[313]; //Expiry Date?></label></p>
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
								</div><!-- .expiredate END -->
	
							</div><!-- /expire date input END -->
						</div><!-- .ccinputarea END -->

					</div>

					<div class="col span_6 inputadd">

						<h6 class="title"><?php $lang[317]; //Input Billing Address info?></h6>
						<?php
						if ($billaddresses) {
							foreach ($billaddresses as $ba) {
						?>
						<!-- DISPLAY IF THERE IS CURRENT ADDRESS -->
						<label class="cbxbd">
							<input type="radio" name="billadd_radio" value="<?php echo $ba['bill_id'];?>">
							<p><?php echo $lang[318]; //Use this billing address?></p>
							<ul class="AddressUL">
								<li class="AddressFullName"><?php echo $ba['bill_fullname'];?></li>
								<li class="AddressPostalCode"><?php echo $ba['bill_postal'];?></li>
								<li class="AddressStateOrRegionAddressLine1"><?php echo $ba['bill_address1'];?> <?php echo $ba['bill_address2'];?></li>
								<li class="AddressPhoneNumber"><?php echo $lang[316];?> : <?php echo $ba['bill_phone'];?></li>
							</ul>
						</label><!-- /CURRENT ADDRESS END -->
						<?php
							} // foreach
						} // if billaddresses
						?>

						<label class="cbxbd">
							<input type="radio" name="billadd_radio" value="billadd_new">
							<p>Add new billing address</p>
						</label><!-- / INPUT NEW ADDRESS END -->
							<table class="enterAddressFormTable">
								<tr>
									<td class="enterAddressFieldLabel">
										<label for="enterAddressFullName"><?php echo $lang[322]; //Your Name?></label>
									</td>
									<td>
										<input type="text" name="bill_fullname" class="enterAddressFormField form-control" size="50" maxlength="50" placeholder="<?php echo $lang[324];?>" >
									</td>
								</tr>
								<tr>
									<td class="enterAddressFieldLabel">
										<label for="enterAddressPostalCode"><?php echo $lang[323]; //Postal Code?></label>
									</td>
									<td>
										<input type="text" name="bill_postal" class="enterAddressFormField form-control" maxlength="10" size="10" placeholder="<?php echo $lang[323];?>" >
									</td>
								</tr>
								<tr>
									<td class="enterAddressFieldLabel">
										<label for="enterAddressStateOrRegion"><?php echo $lang[325]; //都道府県?></label>
									</td>
									<td>
										<select name="bill_prefecture" class="enterAddressFormField">
											<option value="">n/a</option>
											<option value=""></option>
											<option value="北海道">北海道</option>
											<option value="青森県">青森県</option>
											<option value="岩手県">岩手県</option>
											<option value="宮城県">宮城県</option>
											<option value="秋田県">秋田県</option>
										</select>
									</td>
								</tr>
								<tr>
									<td class="enterAddressFieldLabel">
										<label for="enterAddressAddressLine1"><?php echo $lang[326]; //Address1?></label>
									</td>
									<td>
										<input type="text" name="bill_address1" class="enterAddressFormField form-control" size="50" maxlength="60" placeholder="<?php echo $lang[326];?>" >
									</td>
								</tr>
								<tr>
									<td class="enterAddressFieldLabel">
										<label for="enterAddressAddressLine2"><?php echo $lang[327]; //Address2?></label>
									</td>
									<td>
										<input type="text" name="bill_address2" class="enterAddressFormField form-control" size="50" maxlength="60" placeholder="<?php echo $lang[327];?>">
									</td>
								</tr>
								<tr>
									<td class="enterAddressFieldLabel">
										<label for="enterAddressPhoneNumber"><?php echo $lang[316]; //Phone Number?></label>
									</td>
									<td>
										<input type="tel" name="bill_phone" class="enterAddressFormField form-control" size="15" maxlength="20" placeholder="<?php echo $lang[316];?>">
									</td>
								</tr>
							</table>

					</div><!-- .inputadd END -->
				</div><!-- .addressinputarea END -->

				<!-- SUBMIT BUTTON AREA -->
				<div class="row btn-area">
					<div class="col span_12">
						<input type="hidden" name="checked_package" value=""/>
						<button type="submit" id="ccsubimitbtn" class="btn"><?php echo $lang[107]; //Submit?></button><button type="submit" id="cccancelbtn" class="btn"><?php echo $lang[244]; //Cancel?></button>
					</div>
				</div><!-- SUBMIT BUTTON AREA END -->

			</div><!-- #newccinput.newccinput END -->
			</form>

		</div><!-- #creditbox END -->

		<div id="nettelerbox" class="tabs-pane">
			<div class="row">

				<h5 class="title">Netteler is a safe and efficient online payment method</h5>

				<div class="col span_6">
					<p>Add Netteler Image here</p>
					<ul>
						<li>Min Deposit : $10</li>
						<li>Max Deposit : $2,000</li>
						<li>Processing Fee : No Fee</li>
					</ul>
					<div class="noaccount">
						<p>To open an Netteler account</p>
						<a href="http://www.neteller.com/" class="addnew" target="_blank">Click here</a>
					</div>
				</div>
				<div class="col span_6">

					<table class="enternettelerTable">
						<tr>
							<td class="">
								<label for="netteler_amount">Amount</label>
							</td>
							<td>
								<input type="text" name="netteler_amount" class="form-control" size="50" maxlength="50" placeholder="" >
							</td>
						</tr>
						<tr>
							<td class="">
								<label for="netteler_accountid">Account ID</label>
							</td>
							<td>
								<input type="text" name="netteler_accountid" class="form-control" maxlength="10" size="10" placeholder="" >
							</td>
						</tr>
						<tr>
							<td class="">
								<label for="netteler_secureid">Secure ID</label>
							</td>
							<td>
								<input type="text" name="netteler_secureid" class="form-control" size="50" maxlength="60" placeholder="" >
							</td>
						</tr>
						<tr>
							<td class="">
								<label for="netteler_bonuscode">Bonus Code</label>
							</td>
							<td>
								<input type="text" name="netteler_bonuscode" class="form-control" size="50" maxlength="60" placeholder="">
							</td>
						</tr>
					</table>

					<!-- SUBMIT BUTTON AREA -->
					<div class="row btn-area">
						<div class="col span_12">
							<button type="submit" id="nettelersubimitbtn" class="btn"><?php echo $lang[107]; //Submit?></button>
						</div>
					</div><!-- SUBMIT BUTTON AREA END -->
	
				</div>

<!--

				<div class="col span_12 noaccount">
					<p><?php echo $lang[328]; //You need to connect with your Neteller account.?><br><?php echo $lang[329]; //Click Add button below?></p>
					<a href="http://www.neteller.com/" class="addnew" target="_blank"><?php echo $lang[330]; //ADD a Netteler Account?></a>
				</div>

-->


			</div><!-- .row END -->
		</div><!-- #nettelerbox END -->

	</div><!-- .tabs-content END -->
</div><!-- .paymethod_box END -->