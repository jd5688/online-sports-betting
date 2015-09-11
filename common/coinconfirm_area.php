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
						<span id="card-type"></span>
					</div>
				</li>
				<li class="row">
					<div class="col span_6 label">
						<?php echo $lang[309]; //Card Number?> :
					</div>
					<div class="col span_6">
						************<span id="card-number"></span>
					</div>
				</li>
				<li class="row">
					<div class="col span_6 label">
						<?php echo $lang[313]; //Expiry Date?> :
					</div>
					<div class="col span_6">
						<span id="card-expiry"></span>
					</div>
				</li>
				<li class="row">
					<div class="col span_6 label">
						<?php echo $lang[314]; //Cardholder Name?> :
					</div>
					<div class="col span_6">
						<span id="card-fullname"></span>
					</div>
				</li>
				<li class="row">
					<div class="col span_6 label">
						<?php echo $lang[347]; //Payment Address?> :
					</div>
					<div class="col span_6">
						<ul class="AddressUL">
							<li class="AddressFullName"><span id="bill-fullname"></span></li>
							<li class="AddressPostalCode"><span id="bill-postal"></span></li>
							<li class="AddressStateOrRegionAddressLine1"><span id="bill-address"></span></li>
							<li class="AddressPhoneNumber"><?php echo $lang[316]; //Phone Number?> : <span id="bill-phone"></span></li>
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
					<td class=""><?php echo $lang[348]; //on completion?></td>
				</tr>
				<tr>
					<th class="label"><?php echo $lang[349]; //Transaction Date?></th>
					<td class=""><?php echo $lang[348]; //on completion?></td>
				</tr>
				<tr>
					<th class="label"><?php echo $lang[350]; //Selected Item?></th>
					<td class="" id="order-coin"><h6><span>COIN</span></h6></td>
				</tr>
				<tr>
					<th class="label"><?php echo $lang[134]; //Subtotal?></th>
					<td class="">$ <span id="order-amount"></span></td>
				</tr>
				<tr>
					<th class="label"><?php echo $lang[351]; //Tax?></th>
					<td class="text-alert">$ <span id="order-tax"></span></td>
				</tr>

				<tr class="line-total h3 strong">
					<th class="label"><?php echo $lang[352]; //Order Total?></th>
					<td><span id="order-total">$ </span></td>
				</tr>
			</tbody>
		</table>
	
		</div>
	</div><!-- .confirm_area END -->
