	<footer role="contentinfo">

		<div class="container row">

			<p>&copy 2014 All Rights Reserved. <a href="<?php echo getCurrentPage('lang=en');?>">EN</a> / <a href="<?php echo getCurrentPage('lang=jp');?>">JP</a></p>
		</div>

	</footer>

	<a id="pagetop" style="display:none">Page Top</a>

	<!-- Action Window -->
	<div id="success-area" class="success-area">
		<div id="success_animate"><p class="taCenter"><?php echo $lang[428]; //Bookmarked?></p></div>
	</div>
	<div id="success-area2" class="success-area">
		<div id="success_animate"><p class="taCenter"><?php echo $lang[419]; //Liked?></p></div>
	</div>
	<div id="success-area3" class="success-area">
		<div id="success_animate"><p class="taCenter">Followed!</p></div>
	</div>
	<!-- / Action Window -->
	
	<?php if (!$user_id) { ?>

		<?php
		// load login and signup modals
		include $basedir . '/common/login_modal.php';
		include $basedir . '/common/signup_modal.php';
		?>

	<?php } ?>
<script>
$('span#user-activities').click(function () {
	var unseen = <?php echo $unseen;?>;

	if (unseen !== 0) {
		var t = "<?php echo $time;?>";
        var url = "<?php echo $baseurl ?>";
        var key = "<?php echo $public_key?>";
        var hash = "<?php echo $hash?>";
        url = url + "/ajax/update-notifications.php";
        var uri = 'hash=' + hash + '&public=' + key + '&t=' + t;

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
                	$('span#unseen').html('');
                	$('span#unseen').hide();
                }
            }
            
        });
	}
})
</script>