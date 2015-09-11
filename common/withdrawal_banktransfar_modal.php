<div id="identity-window" class="remodal" data-remodal-id="withdrawal_bank">
	<div class="modal-head">
		<div class="row">
			<div class="col span_12">
				<h2>銀行口座への引き出し</h2>
			</div>
		</div><!-- /.row -->
	</div><!-- /.modal-head -->
	<div class="modal-body">

		<form class="identity_form">

		<div class="row">

			<div class="col span_12">

				<div class="atm_confirm">


					<h6 class="title">Withdraw Amount</h6>


					<div class="form-group">
						<label for="signinInputPassword1">Amount</label>
						<input type="text" name="" id="" class="form-control" maxlength="10" size="10" placeholder="USD">
					</div>


					<h6 class="title">Withdraw Funds To</h6>

					<div class="form-group registered_bank">
						<label for="signinInputEmail1">Registered Bank Account</label>
							<select id="enterAddressStateOrRegion" name="enterAddressStateOrRegion" class="enterAddressFormField">
								<option value="">--</option>
								<option value="bank1">Tokyo Mitsubishi UFJ</option>
								<option value="bank2">Rakuten Bank</option>
							</select>
							<span class="or">OR</span>
							<span id="addcardbtn" class="addnew">Add new bank</span>
					</div>


					<div id="newbankinfo_box" class="newbankinfo_box">
	
						<ul class="methodtab tabs row">
							<li class="active" data-tab="#domestic_bank"><span>Domestic</span></li>
							<li data-tab="#international_bank"><span>Internatonal</span></li>
						</ul>
					
						<div class="tabs-content">
		
							<div id="domestic_bank" class="tabs-pane active">
	
								<div class="form-group">
									<label for="">Bank Name</label>
									<input type="text" name="" id="" class=" form-control" size="50" maxlength="60" placeholder="">
								</div>
								<div class="form-group">
									<label for="">Brunch Name</label>
									<input type="text" name="" id="" class=" form-control" size="50" maxlength="60" placeholder="">
								</div>
								<div class="form-group">
									<label for="">Account type</label>
										<select id="" name="" class="">
											<option value="">--</option>
											<option value="bank1">Checking</option>
											<option value="bank2">Saving</option>
										</select>
								</div>
								<div class="form-group">
									<label for="">Beneficiary Name</label>
									<input type="text" name="" id="" class=" form-control" size="50" maxlength="60" placeholder="">
								</div>
		
	
							</div><!-- /#domestic_bank END -->
		
							<div id="international_bank" class="tabs-pane">
								<div class="form-group">
									<label for="">Bank Name</label>
									<input type="text" name="" id="" class=" form-control" size="50" maxlength="60" placeholder="">
								</div>
								<div class="form-group">
									<label for="">Brunch Name</label>
									<input type="text" name="" id="" class=" form-control" size="50" maxlength="60" placeholder="">
								</div>
								<div class="form-group">
									<label for="">Brunch Address</label>
									<input type="text" name="" id="" class=" form-control" size="50" maxlength="60" placeholder="">
								</div>
								<div class="form-group">
									<label for="">Brunch Number</label>
									<input type="number" name="" id="" class=" form-control" size="15" maxlength="20" placeholder="">
								</div>
								<div class="form-group">
									<label for="">Brunch Phone Number</label>
									<input type="tel" name="" id="enterAddressPhoneNumber" class=" form-control" size="15" maxlength="20" placeholder="">
								</div>
								<div class="form-group">
									<label for="">Account type</label>
										<select id="" name="" class="">
											<option value="">--</option>
											<option value="bank1">Checking</option>
											<option value="bank2">Saving</option>
										</select>
								</div>
								<div class="form-group">
									<label for="">ABA/Routing Number</label>
									<input type="number" name="" id="" class=" form-control" size="15" maxlength="20" placeholder="">
								</div>
								<div class="form-group">
									<label for="">SWIFT Code</label>
									<input type="text" name="" id="" class=" form-control" size="15" maxlength="20" placeholder="">
								</div>
								<div class="form-group">
									<label for="">Beneficiary Name</label>
									<input type="text" name="" id="" class=" form-control" size="50" maxlength="60" placeholder="">
								</div>
		
							</div><!-- /#international_bank END -->
		
						</div><!-- .tabs-content END -->
					</div><!-- .newbankinfo_box END -->


				</div><!-- /.atm_confirm -->

			</div><!-- /.col.span_12 -->
		</div><!-- /.row -->

		</form>


	</div><!-- /.modal-body -->
	<div class="modal-foot">
		<div class="row">
			<div class="col span_12">
				<a href="#withdrawal_bank_confirm" class="btn confirm">Confirm</a>
				<a href="" class="btn cancel">cancel</a>
			</div>
		</div><!-- /.row -->
	</div><!-- /.modal-foot -->
</div><!-- /#betconfirm-window -->

