<?php 
require_once('../include/config.php');
require_once($basedir . "/include/functions.php");
require_once($basedir . '/include/user_functions.php');

if (!$user_id) {
	// go to login page
	header('Location: '. $baseurl . '#login');
	exit;
}
$public_key = $config['public_key'];
$time = time();
$hash = md5($public_key . $config['private_key'] . $time);

$udata = getUser($user_id);
$usex = $udata['user_sex'];
$ufullname = $udata['user_fullname'];
$ubio = $udata['user_bio'];
$uweb = $udata['user_website'];
$uweb = ($uweb) ? $uweb : 'http://';
$profile_pic = $basedir . '/images/user_pics/' . $udata['user_pic'];
if (file_exists($profile_pic)) {
	$profile_pic = $baseurl . '/images/user_pics/' . $udata['user_pic'] . '?t=' . time();
} else {
	$profile_pic = '';
}

$settingsmenu='active';
$profilemenu='active';
?>
<!DOCTYPE HTML>
<html>
<?php include $basedir . '/common/header.php'; ?>
<body>

	<?php include $basedir . '/common/head.php'; ?>


	<div class="container row">
	
		<?php include $basedir . '/common/myheadmenu.php'; ?>

		<main role="main" class="row gutters mypage">

			<article id="myaccount" class="col span_9">

				<div class="box">
					<div class="title_box">
						<h4 class="title"><?php echo $lang[407];?></h4>
						<p class="desc"><?php echo $lang[477];?></p>
					</div>
	

					<form id="upload_form" action="<?php echo $baseurl?>/settings/profile-submit.php" method="POST" accept-charset="utf-8" enctype="multipart/form-data" class="inputform" target="upload_target">
					
						<div class="controls">
							<label for="picture"><?php echo $lang[478];?></label>
							<div class="wrapper">
								<span class="avatar" style="background-image:url('<?php echo $profile_pic?>');"></span>
								<div id="removephoto" class="profimg">
		                            <input name="picture" type="file">
									<div class="checkbox"><input type="checkbox" value="1" name="remove_avatar" id="remove_avatar"><label for="remove_avatar"><?php echo $lang[479];?></label></div>
	                        	</div>
                        	</div>
						</div>
					</form>
					
					<form method="POST" accept-charset="utf-8" class="inputform">
						<p>
							<label for="full_name"><?php echo $lang[480];?></label>
							<input name="full_name" autocorrect="off" value="<?php echo $ufullname;?>" maxlength="30" type="text" class="form-control">
						</p>
						
						<p>
							<label for="gender"><?php echo $lang[481];?></label>
							<select name="gender" id="gender">
								<option value="0" <?php echo ($usex == '') ? 'selected = "selected"' : ''?>>--------</option>
								<option value="male" <?php echo ($usex == 'male') ? 'selected = "selected"' : ''?>><?php echo $lang[482];?></option>
								<option value="female" <?php echo ($usex == 'female') ? 'selected = "selected"' : ''?>><?php echo $lang[483];?></option>
							</select>
						</p>
						
						<p>
							<label for="biography"><?php echo $lang[484];?></label>
							<textarea id="biography" rows="10" cols="40" name="biography" class="form-control" value=""><?php echo $ubio?></textarea>
						</p>
						
						<p>
							<label for="external_url"><?php echo $lang[485];?></label>
							<input autocapitalize="off" autocorrect="off" rel="http://" type="url" name="external_url" id="external_url" value="<?php echo $uweb?>" class="form-control">
						</p>
						
						<p class="form-actions">
							<input type="submit" class="btn" value="<?php echo $lang[336];?>">
							<span id="message"></span>
						</p>
					</form>
					<iframe id="upload_target" name="upload_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe> 
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

	<!-- JS for Item Input area -->
	<script type='text/javascript'>
	$(function () {
			
	    $("#removephoto input[type='checkbox']").change(function(){
	        if($(this).is(":checked")){
	            $('#removephoto .cbxbd').removeClass("c_on");
	            $(this).parent().addClass("c_on");
	        }else{
	            $(this).parent().removeClass("c_on");
	        }
	    });

	});
	</script>

	<script src="<?php echo $baseurl?>/js/jquery.minimalect.min.js"></script>
	<script type="text/javascript">
	  $(document).ready(function(){
	  	uploaded_file = '';
	    $("#myaccount form.inputform select").minimalect();
	    $('input[type=file]').change(function(e){
	    	$('span.avatar').attr('style', 'background-image:url("<?php echo $baseurl?>/images/ajax-loader.gif")');
		  	$('form#upload_form').submit();
		  	var loop = setInterval(function() {
				if (uploaded_file !== "") {
					clearInterval(loop);
					var rand = Math.floor((Math.random() * 10000000000) + 1);
			    	setTimeout(function () {
						$('span.avatar').attr('style', 'background-image:url("' + uploaded_file + '?t=' + rand + '")');
						$('#my_avatar').html('<img src="' + uploaded_file + '?t=' + rand + '" class="img-circle" alt="<?php echo $udata['user_name']?>">');
					}, 1000);
				}
		}, 1000);
		});
	  });
	  
	  $('input[type=submit]').click(function (e) {
	    e.preventDefault();
	    var website = $('input[name=external_url]').val();
	    var bio = $('textarea[name=biography]').val();
	    var sex = $('select[name=gender]').val();
	    var fname = $('input[name=full_name]').val();
	    var remove_avatar = ($('input[name=remove_avatar]').is(':checked')) ? 1 : 0;
		var t = "<?php echo $time;?>";
		var url = "<?php echo $baseurl ?>";
		var key = "<?php echo $public_key?>";
		var hash = "<?php echo $hash?>";
		url = url + "/ajax/user-profile.php";
		var uri = 'hash=' + hash + '&public=' + key + '&t=' + t;
		uri += '&web=' + website + '&bio=' + bio + '&sex=' + sex + '&fn=' + fname + '&ra=' + remove_avatar;
		
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
		    	if (remove_avatar === 1) {
			    	$('span.avatar').attr('style', 'background-image:url("")');
			    	$('input[name=remove_avatar]').parent().removeClass('c_on');
			    	$('#my_avatar').html('<img src="<?php echo $baseurl?>/images/avatar3.png" class="img-circle" alt="<?php echo $udata['user_name']?>">');
		    	}
		        $('#message').html(data.message);
		        setTimeout(function() {
		            $('#message').html('');
		        }, 3000)
		    }
		    
	    });

	  })
	</script>


</body>

</html>