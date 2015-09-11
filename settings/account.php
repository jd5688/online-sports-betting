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
$accountmenu='active';

$def_tz = ($_SESSION['user_timezone']) ? $_SESSION['user_timezone'] : 'Asia/Tokyo';
$languages = getLanguages();

$file = $basedir . '/temp/all_users.txt';
$data = json_decode(file_get_contents($file), true);
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
						<h4 class="title"><?php echo $lang[406];?></h4>
						<p class="desc"><?php echo $lang[486];?></p>
					</div>
	

					<form method="POST" accept-charset="utf-8" class="inputform">
					
						<p>
							<label for="username"><?php echo $lang[487];?></label>
							<input name="username" maxlength="30" autocapitalize="off" autocorrect="off" type="text" id="username" value="<?php echo $_SESSION['user_name']?>" class="form-control" readonly="">
						</p>
						
						<p>
							<label for="email"><?php echo $lang[488];?></label>
							<input type="email" name="email" value="<?php echo $_SESSION['user_email']?>" id="email" class="form-control" readonly="">
						</p>
						
						<p>
							<label for="language"><?php echo $lang[489];?></label>
							<select name="language" id="language">
								<option value=""><?php echo $lang[490];?></option>
								<?php
								if ($languages) {
									foreach ($languages as $l) {
										if ($_SESSION['user_lang'] == $l['lvalue']) {
											$selected = 'selected=""';
										} else {
											$selected = '';
										}
								?>
									<option <?php echo $selected;?> value="<?php echo $l['lvalue']?>"><?php echo $l['lname']?></option>
								<?php
									} // foreach
								} else { // if languages
								?>
									<option value="en" selected="">English</option>
									<option value="ja">Japanese - 日本語</option>
								<?php } ?>
							</select>
						</p>
						<?php
						$utc = new DateTimeZone('UTC');
						$dt = new DateTime('now', $utc);
						?>
						<p>
							<label for="timezone"><?php echo $lang[491];?></label>
							<select name="timezone" id="timezone">
							<?php
							foreach(DateTimeZone::listIdentifiers() as $tz) {
							    $current_tz = new DateTimeZone($tz);
							    $offset =  $current_tz->getOffset($dt);
							    $transition =  $current_tz->getTransitions($dt->getTimestamp(), $dt->getTimestamp());
							    $abbr = $transition[0]['abbr'];
							    $selected = ($def_tz == $tz) ? $selected = 'selected=""' : '';
								echo '<option '.$selected.' value="' .$tz. '">' .$tz. ' [' .$abbr. ' '. formatOffset($offset). ']</option>';
							} // foreach
							?>
							<?php /*
								<option data-offset="-36000" value="Hawaii">(GMT-10:00) Hawaii</option>
								<option data-offset="-32400" value="Alaska">(GMT-09:00) Alaska</option>
								<option data-offset="-28800" value="Pacific Time (US &amp; Canada)">(GMT-08:00) Pacific Time (US &amp; Canada)</option>
								<option data-offset="-25200" value="Arizona">(GMT-07:00) Arizona</option>
								<option data-offset="-25200" value="Mountain Time (US &amp; Canada)">(GMT-07:00) Mountain Time (US &amp; Canada)</option>
								<option data-offset="-21600" value="Central Time (US &amp; Canada)">(GMT-06:00) Central Time (US &amp; Canada)</option>
								<option data-offset="-18000" value="Eastern Time (US &amp; Canada)" selected="">(GMT-05:00) Eastern Time (US &amp; Canada)</option>
								<option data-offset="-18000" value="Indiana (East)">(GMT-05:00) Indiana (East)</option>
								<option data-offset="" value="">-------------</option>
								<option data-offset="-39600" value="International Date Line West">(GMT-11:00) International Date Line West</option>
								<option data-offset="-39600" value="Midway Island">(GMT-11:00) Midway Island</option>
								<option data-offset="-39600" value="Samoa">(GMT-11:00) Samoa</option>
								<option data-offset="-28800" value="Tijuana">(GMT-08:00) Tijuana</option>
								<option data-offset="-25200" value="Chihuahua">(GMT-07:00) Chihuahua</option>
								<option data-offset="-25200" value="Mazatlan">(GMT-07:00) Mazatlan</option>
								<option data-offset="-21600" value="Central America">(GMT-06:00) Central America</option>
								<option data-offset="-21600" value="Guadalajara">(GMT-06:00) Guadalajara</option>
								<option data-offset="-21600" value="Mexico City">(GMT-06:00) Mexico City</option>
								<option data-offset="-21600" value="Monterrey">(GMT-06:00) Monterrey</option>
								<option data-offset="-21600" value="Saskatchewan">(GMT-06:00) Saskatchewan</option>
								<option data-offset="-18000" value="Bogota">(GMT-05:00) Bogota</option>
								<option data-offset="-18000" value="Lima">(GMT-05:00) Lima</option>
								<option data-offset="-18000" value="Quito">(GMT-05:00) Quito</option>
								<option data-offset="-16200" value="Caracas">(GMT-04:30) Caracas</option>
								<option data-offset="-14400" value="Atlantic Time (Canada)">(GMT-04:00) Atlantic Time (Canada)</option>
								<option data-offset="-14400" value="La Paz">(GMT-04:00) La Paz</option>
								<option data-offset="-14400" value="Santiago">(GMT-04:00) Santiago</option>
								<option data-offset="-12600" value="Newfoundland">(GMT-03:30) Newfoundland</option>
								<option data-offset="-10800" value="Brasilia">(GMT-03:00) Brasilia</option>
								<option data-offset="-10800" value="Buenos Aires">(GMT-03:00) Buenos Aires</option>
								<option data-offset="-10800" value="Georgetown">(GMT-03:00) Georgetown</option>
								<option data-offset="-10800" value="Greenland">(GMT-03:00) Greenland</option>
								<option data-offset="-7200" value="Mid-Atlantic">(GMT-02:00) Mid-Atlantic</option>
								<option data-offset="-3600" value="Azores">(GMT-01:00) Azores</option>
								<option data-offset="-3600" value="Cape Verde Is.">(GMT-01:00) Cape Verde Is.</option>
								<option data-offset="0" value="Casablanca">(GMT) Casablanca</option>
								<option data-offset="0" value="Dublin">(GMT) Dublin</option>
								<option data-offset="0" value="Edinburgh">(GMT) Edinburgh</option>
								<option data-offset="0" value="Lisbon">(GMT) Lisbon</option>
								<option data-offset="0" value="London">(GMT) London</option>
								<option data-offset="0" value="Monrovia">(GMT) Monrovia</option>
								<option data-offset="3600" value="Amsterdam">(GMT+01:00) Amsterdam</option>
								<option data-offset="3600" value="Belgrade">(GMT+01:00) Belgrade</option>
								<option data-offset="3600" value="Berlin">(GMT+01:00) Berlin</option>
								<option data-offset="3600" value="Bern">(GMT+01:00) Bern</option>
								<option data-offset="3600" value="Bratislava">(GMT+01:00) Bratislava</option>
								<option data-offset="3600" value="Brussels">(GMT+01:00) Brussels</option>
								<option data-offset="3600" value="Budapest">(GMT+01:00) Budapest</option>
								<option data-offset="3600" value="Copenhagen">(GMT+01:00) Copenhagen</option>
								<option data-offset="3600" value="Ljubljana">(GMT+01:00) Ljubljana</option>
								<option data-offset="3600" value="Madrid">(GMT+01:00) Madrid</option>
								<option data-offset="3600" value="Paris">(GMT+01:00) Paris</option>
								<option data-offset="3600" value="Prague">(GMT+01:00) Prague</option>
								<option data-offset="3600" value="Rome">(GMT+01:00) Rome</option>
								<option data-offset="3600" value="Sarajevo">(GMT+01:00) Sarajevo</option>
								<option data-offset="3600" value="Skopje">(GMT+01:00) Skopje</option>
								<option data-offset="3600" value="Stockholm">(GMT+01:00) Stockholm</option>
								<option data-offset="3600" value="Vienna">(GMT+01:00) Vienna</option>
								<option data-offset="3600" value="Warsaw">(GMT+01:00) Warsaw</option>
								<option data-offset="3600" value="West Central Africa">(GMT+01:00) West Central Africa</option>
								<option data-offset="3600" value="Zagreb">(GMT+01:00) Zagreb</option>
								<option data-offset="7200" value="Athens">(GMT+02:00) Athens</option>
								<option data-offset="7200" value="Bucharest">(GMT+02:00) Bucharest</option>
								<option data-offset="7200" value="Cairo">(GMT+02:00) Cairo</option>
								<option data-offset="7200" value="Harare">(GMT+02:00) Harare</option>
								<option data-offset="7200" value="Helsinki">(GMT+02:00) Helsinki</option>
								<option data-offset="7200" value="Istanbul">(GMT+02:00) Istanbul</option>
								<option data-offset="7200" value="Jerusalem">(GMT+02:00) Jerusalem</option>
								<option data-offset="7200" value="Kyiv">(GMT+02:00) Kyiv</option>
								<option data-offset="7200" value="Pretoria">(GMT+02:00) Pretoria</option>
								<option data-offset="7200" value="Riga">(GMT+02:00) Riga</option>
								<option data-offset="7200" value="Sofia">(GMT+02:00) Sofia</option>
								<option data-offset="7200" value="Tallinn">(GMT+02:00) Tallinn</option>
								<option data-offset="7200" value="Vilnius">(GMT+02:00) Vilnius</option>
								<option data-offset="10800" value="Baghdad">(GMT+03:00) Baghdad</option>
								<option data-offset="10800" value="Kuwait">(GMT+03:00) Kuwait</option>
								<option data-offset="10800" value="Minsk">(GMT+03:00) Minsk</option>
								<option data-offset="10800" value="Nairobi">(GMT+03:00) Nairobi</option>
								<option data-offset="10800" value="Riyadh">(GMT+03:00) Riyadh</option>
								<option data-offset="12600" value="Tehran">(GMT+03:30) Tehran</option>
								<option data-offset="14400" value="Abu Dhabi">(GMT+04:00) Abu Dhabi</option>
								<option data-offset="14400" value="Baku">(GMT+04:00) Baku</option>
								<option data-offset="14400" value="Moscow">(GMT+04:00) Moscow</option>
								<option data-offset="14400" value="Muscat">(GMT+04:00) Muscat</option>
								<option data-offset="14400" value="St. Petersburg">(GMT+04:00) St. Petersburg</option>
								<option data-offset="14400" value="Tbilisi">(GMT+04:00) Tbilisi</option>
								<option data-offset="14400" value="Volgograd">(GMT+04:00) Volgograd</option>
								<option data-offset="14400" value="Yerevan">(GMT+04:00) Yerevan</option>
								<option data-offset="16200" value="Kabul">(GMT+04:30) Kabul</option>
								<option data-offset="18000" value="Islamabad">(GMT+05:00) Islamabad</option>
								<option data-offset="18000" value="Karachi">(GMT+05:00) Karachi</option>
								<option data-offset="18000" value="Tashkent">(GMT+05:00) Tashkent</option>
								<option data-offset="19800" value="Chennai">(GMT+05:30) Chennai</option>
								<option data-offset="19800" value="Kolkata">(GMT+05:30) Kolkata</option>
								<option data-offset="19800" value="Mumbai">(GMT+05:30) Mumbai</option>
								<option data-offset="19800" value="New Delhi">(GMT+05:30) New Delhi</option>
								<option data-offset="20700" value="Kathmandu">(GMT+05:45) Kathmandu</option>
								<option data-offset="21600" value="Almaty">(GMT+06:00) Almaty</option>
								<option data-offset="21600" value="Astana">(GMT+06:00) Astana</option>
								<option data-offset="21600" value="Dhaka">(GMT+06:00) Dhaka</option>
								<option data-offset="21600" value="Ekaterinburg">(GMT+06:00) Ekaterinburg</option>
								<option data-offset="21600" value="Sri Jayawardenepura">(GMT+06:00) Sri Jayawardenepura</option>
								<option data-offset="23400" value="Rangoon">(GMT+06:30) Rangoon</option>
								<option data-offset="25200" value="Bangkok">(GMT+07:00) Bangkok</option>
								<option data-offset="25200" value="Hanoi">(GMT+07:00) Hanoi</option>
								<option data-offset="25200" value="Jakarta">(GMT+07:00) Jakarta</option>
								<option data-offset="25200" value="Novosibirsk">(GMT+07:00) Novosibirsk</option>
								<option data-offset="28800" value="Beijing">(GMT+08:00) Beijing</option>
								<option data-offset="28800" value="Chongqing">(GMT+08:00) Chongqing</option>
								<option data-offset="28800" value="Hong Kong">(GMT+08:00) Hong Kong</option>
								<option data-offset="28800" value="Krasnoyarsk">(GMT+08:00) Krasnoyarsk</option>
								<option data-offset="28800" value="Kuala Lumpur">(GMT+08:00) Kuala Lumpur</option>
								<option data-offset="28800" value="Perth">(GMT+08:00) Perth</option>
								<option data-offset="28800" value="Singapore">(GMT+08:00) Singapore</option>
								<option data-offset="28800" value="Taipei">(GMT+08:00) Taipei</option>
								<option data-offset="28800" value="Ulaan Bataar">(GMT+08:00) Ulaan Bataar</option>
								<option data-offset="28800" value="Urumqi">(GMT+08:00) Urumqi</option>
								<option data-offset="32400" value="Irkutsk">(GMT+09:00) Irkutsk</option>
								<option data-offset="32400" value="Osaka">(GMT+09:00) Osaka</option>
								<option data-offset="32400" value="Sapporo">(GMT+09:00) Sapporo</option>
								<option data-offset="32400" value="Seoul">(GMT+09:00) Seoul</option>
								<option data-offset="32400" value="Tokyo">(GMT+09:00) Tokyo</option>
								<option data-offset="34200" value="Adelaide">(GMT+09:30) Adelaide</option>
								<option data-offset="34200" value="Darwin">(GMT+09:30) Darwin</option>
								<option data-offset="36000" value="Brisbane">(GMT+10:00) Brisbane</option>
								<option data-offset="36000" value="Canberra">(GMT+10:00) Canberra</option>
								<option data-offset="36000" value="Guam">(GMT+10:00) Guam</option>
								<option data-offset="36000" value="Hobart">(GMT+10:00) Hobart</option>
								<option data-offset="36000" value="Melbourne">(GMT+10:00) Melbourne</option>
								<option data-offset="36000" value="Port Moresby">(GMT+10:00) Port Moresby</option>
								<option data-offset="36000" value="Sydney">(GMT+10:00) Sydney</option>
								<option data-offset="36000" value="Yakutsk">(GMT+10:00) Yakutsk</option>
								<option data-offset="39600" value="New Caledonia">(GMT+11:00) New Caledonia</option>
								<option data-offset="39600" value="Solomon Is.">(GMT+11:00) Solomon Is.</option>
								<option data-offset="39600" value="Vladivostok">(GMT+11:00) Vladivostok</option>
								<option data-offset="43200" value="Auckland">(GMT+12:00) Auckland</option>
								<option data-offset="43200" value="Fiji">(GMT+12:00) Fiji</option>
								<option data-offset="43200" value="Kamchatka">(GMT+12:00) Kamchatka</option>
								<option data-offset="43200" value="Magadan">(GMT+12:00) Magadan</option>
								<option data-offset="43200" value="Marshall Is.">(GMT+12:00) Marshall Is.</option>
								<option data-offset="43200" value="Wellington">(GMT+12:00) Wellington</option>
								<option data-offset="46800" value="Nuku'alofa">(GMT+13:00) Nuku'alofa</option>
								*/ ?>
							</select>
						</p>
						
						<p class="form-actions">
							<input type="submit" class="btn" value="<?php echo $lang[336];?>">
							<input type="hidden" name="old_lang" value="<?php echo $_SESSION['user_lang']; ?>"/>
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
	$("form").bind("submit", submitForm);
	function submitForm(e) {
	    e.preventDefault();
	    e.target.checkValidity();
	    var lang = $('select[name="language"]').val();
	    var old_lang = $('input[name="old_lang"]').val();
	    var tz = $('select[name="timezone"]').val();
	    var t = "<?php echo $time;?>";
	    var url = "<?php echo $baseurl ?>";
	    var key = "<?php echo $public_key?>";
	    var hash = "<?php echo $hash?>";
	    url = url + "/ajax/changelangtz.php";
	    var uri = 'hash=' + hash + '&public=' + key + '&t=' + t;
	    uri += '&lang=' + lang + '&tz=' + tz;
	
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
	        	if (lang && lang !== old_lang) {
		        	window.location.reload(true);
	        	}
                $('#message').html(data.message);
                setTimeout(function() {
	                $('#message').html('');
                }, 3000)
	        }
	        
	    });
	}
})
</script>