<div id="identity-window" class="remodal" data-remodal-id="createatm">
	<div class="modal-head">
		<div class="row">
			<div class="col span_12">
				<h2>Create ATM Card</h2>
			</div>
		</div><!-- /.row -->
	</div><!-- /.modal-head -->
	<div class="modal-body">

		<p class="desc">ATMカードを郵送します。郵送先の住所を入力してください。</p>

		<h6 class="title">Input Shipping Address</h6>

		<form class="identity_form">

		<div class="row gutters">

			<div class="col span_6">

					<div class="form-group">
						<label for="signinInputPassword1">Recipient Name</label>
						<input type="text" class="form-control" id="userpassword" placeholder="Firstname Lastname" value="">
					</div>

					<div class="form-group">
						<label for="signinInputPassword1">Postal Code</label>
						<input type="text" name="enterAddressPostalCode" id="enterAddressPostalCode" class="form-control" maxlength="10" size="10" placeholder="enterAddressPostalCode">
					</div>

					<div class="form-group">
						<label for="signinInputEmail1">State/Region</label>
							<select id="enterAddressStateOrRegion" name="enterAddressStateOrRegion" class="enterAddressFormField">
								<option value="">--</option>
								<option value="北海道">北海道</option>
								<option value="青森県">青森県</option>
								<option value="岩手県">岩手県</option>
								<option value="宮城県">宮城県</option>
								<option value="秋田県">秋田県</option>
							</select>
					</div>

			</div>

			<div class="col span_6">

					<div class="form-group">
						<label for="signinInputPassword1">Address1</label>
						<input type="text" name="enterAddressAddressLine1" id="enterAddressAddressLine1" class="enterAddressFormField form-control" size="50" maxlength="60" placeholder="enterAddressAddressLine1">
					</div>
					<div class="form-group">
						<label for="signinInputPassword1">Address2</label>
						<input type="text" name="enterAddressAddressLine2" id="enterAddressAddressLine2" class="enterAddressFormField form-control" size="50" maxlength="60" placeholder="Optional aprtment number">
					</div>
					<div class="form-group">
						<label for="signinInputPassword1">Phone Number</label>
						<input type="tel" name="enterAddressPhoneNumber" id="enterAddressPhoneNumber" class="enterAddressFormField form-control" size="15" maxlength="20" placeholder="enterAddressPhoneNumber">
					</div>


			</div>
		</div><!-- /.row -->

		</form>


	</div><!-- /.modal-body -->
	<div class="modal-foot">
		<div class="row">
			<div class="col span_12">
				<a href="#createatm-confirm" class="btn confirm">Confirm</a>
				<a href="" class="btn cancel">cancel</a>
			</div>
		</div><!-- /.row -->
	</div><!-- /.modal-foot -->
</div><!-- /#betconfirm-window -->

