<div id="identity-window" class="remodal" data-remodal-id="identity">
	<div class="modal-head">
		<div class="row">
			<div class="col span_12">
				<h2>Identity Verification</h2>
			</div>
		</div><!-- /.row -->
	</div><!-- /.modal-head -->
	<div class="modal-body">

		<p class="desc">本人認証のため、必要な書類をアップロードしてください。この認証作業は一度のみです。</p>
		<div class="row gutters">

			<div class="col span_7">

				<form class="identity_form">
					<div class="form-group">
						<label for="signinInputEmail1">Choose ID Type</label>
						<select name="language" id="language">
							<option>Select ID Type...</option>
							<option value="en" selected="">Passport</option>
							<option value="fil">Drivers Licence</option>
							<option value="ja">顔写真付き住基カード(政府発行のIDカード)</option>
						</select>
					</div>
					<div class="form-group">
						<label for="signinInputPassword1">ID Number</label>
						<input type="number" class="form-control" id="userpassword" placeholder="Enter ID Number" value="" required="">
					</div>

					<div class="form-group expire">
						<label for="expireYear">Expire Date</label>

							<select name="expireYear" title="年" id="expireYear">
							    <option value="2014" selected="selected">2014</option>
							    <option value="2015">2015</option>
							    <option value="2016">2016</option>
							    <option value="2017">2017</option>
							    <option value="2018">2018</option>
							    <option value="2019">2019</option>
							    <option value="2020">2020</option>
							    <option value="2021">2021</option>
							    <option value="2022">2022</option>
							    <option value="2023">2023</option>
							    <option value="2024">2024</option>
							    <option value="2025">2025</option>
							    <option value="2026">2026</option>
							    <option value="2027">2027</option>
							    <option value="2028">2028</option>
							    <option value="2029">2029</option>
							    <option value="2030">2030</option>
							    <option value="2031">2031</option>
							    <option value="2032">2032</option>
							    <option value="2033">2033</option>
							    <option value="2034">2034</option>
							    <option value="2035">2035</option>
							    <option value="2036">2036</option>
							    <option value="2037">2037</option>
							</select>

							<select name="expireMonth" title="月" id="expireMonth">
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

							<select name="expireDate" title="日" id="expireDate">
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
							    <option value="13">13</option>
							    <option value="14">14</option>
							    <option value="15">15</option>
							    <option value="16">16</option>
							    <option value="17">17</option>
							    <option value="18">18</option>
							    <option value="19">19</option>
							    <option value="20">20</option>
							    <option value="21">21</option>
							    <option value="22">22</option>
							    <option value="23">23</option>
							    <option value="24">24</option>
							    <option value="25">25</option>
							    <option value="26">26</option>
							    <option value="27">27</option>
							    <option value="28">28</option>
							    <option value="29">29</option>
							    <option value="30">30</option>
							    <option value="31">31</option>
							</select>

					</div>

					<div class="checkbox" style="margin-top:0;">
						<label class="cbxbd"><input type="checkbox" id="keep-signed-in" value="1">There's no expire date</label>
					</div>

					<div class="form-group">
						<label for="picture1">Upload File 1 表面</label>
                        <input name="picture1" type="file">

						<label for="picture1">Upload File 2 裏面</label>
                        <input name="picture2" type="file">
					</div>

					
				</form>


			</div>

			<div class="col span_5">

				<div class="attention">
					<h6>本人認証について</h6>
					<p>マネーロンダリングなどの犯罪防止、他人のなりすましによる不正使用などを防ぐため、本人かどうかを確認する手続きです。</p>

					<p>詳しくは<a href="#">ガイドページ</a>をご覧ください。</p>
				</div>


				<div class="attention">
					<h6>認証作業は48時間以内</h6>
					<p>書類をアップロード後、48時間以内に認証されます。認証結果はお客様のメールアドレスへ通知メールが届きます。</p>

					<p>認証が確認され次第、各種引き出しが行えるようになります。</p>
				</div>


			</div>
		</div><!-- /.row -->
	</div><!-- /.modal-body -->
	<div class="modal-foot">
		<div class="row">
			<div class="col span_12">
				<a href="#identity-success" class="btn confirm">Submit</a>
				<a href="" class="btn cancel">cancel</a>
			</div>
		</div><!-- /.row -->
	</div><!-- /.modal-foot -->
</div><!-- /#betconfirm-window -->

