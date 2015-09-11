<?php 
require_once('../include/config.php');
require_once($basedir . "/include/functions.php");
require_once($basedir . '/include/user_functions.php');
ini_set('display_errors', 1);
error_reporting(~0);
if (!$user_id) {
	// go to login page
	header('Location: '. $baseurl . '#login');
	exit;
}
$imgfilename = $user_id;
$destination_path = $basedir . '/images/user_pics/';
$destination_url = $baseurl . '/images/user_pics/';
$img_url = '';
$fin = 0;
$result = 0;

$gphoto = $_FILES['picture']['tmp_name'];
//$target_path = $destination_path . basename( $_FILES['picture']['name']);

if ($gphoto) {
	$imageinfo = getimagesize($gphoto);
	
	if($imageinfo[2] == 1) {
		$imgfilename .= ".gif";
	} elseif($imageinfo[2] == 2) {
		$imgfilename .= ".jpg";
	} elseif($imageinfo[2] == 3) {
		$imgfilename .= ".png";
	} else {
		$imgfilename = false;
	}
	
	if ($imgfilename) {
		$img_loc = $destination_path . $imgfilename;
		$img_url = $destination_url . $imgfilename;
		if(file_exists($img_loc)) {
			unlink($img_loc);
		}
		move_uploaded_file($gphoto, $img_loc);
		if (do_resize_profimage($img_loc, "200", "200", false, 'file')) {
			$bool = updateUserImageFile($user_id, $imgfilename);
			if ($bool) {
				$fin = 1;
				$_SESSION['user_pic'] = $imgfilename;
			}
		}
	}
} else {
	$imgfilename = '';
}
?>
<script src="<?php echo $baseurl?>/js/jquery-1.11.0.min.js"></script>
<script>
$(document).ready(function() {
	var uploaded_file = '';
	var fin = 0;
	var loop = setInterval(function() {
			fin = <?php echo $fin;?>;
			uploaded_file = "<?php echo $img_url?>";
			if (fin === 1) {
				clearInterval(loop);
				//$('span.avatar').attr('style', 'background-image:url("' + file + '")');
				window.top.window.uploaded_file = uploaded_file;
			}
		}, 1000);
})
</script>