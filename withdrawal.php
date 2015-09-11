<?php 
require_once('include/config.php');
require_once($basedir . "/include/functions.php");
require_once($basedir . "/include/user_functions.php");

if (!$user_id) { 
	header('Location: ' . $baseurl . '#login');
	exit;
}

$withdrawalmenu='active';
?>
<!DOCTYPE HTML>
<html>
<?php include $basedir . '/common/header.php'; ?>
<body>

	<?php include $basedir . '/common/head.php'; ?>


	<div class="container row">
	
		<?php include $basedir . '/common/myheadmenu.php'; ?>

		<main role="main" class="row mypage">

			<article id="dashboard" class="col span_12">

				<div class="box">
					<div class="title_box">
						<h4 class="title">Withdrawal</h4>
						<p class="desc">There are 4 ways to withdrawal. </p>
					</div>

					<div class="inner row gutters">

						<div class="col span_8">
						
							<?php include $basedir . '/common/withdrawal_netteler.php'; ?>
							<?php include $basedir . '/common/withdrawal_banktransfar.php'; ?>
							<?php include $basedir . '/common/withdrawal_bankcheck.php'; ?>
							<?php include $basedir . '/common/withdrawal_atm.php'; ?>

						</div><!-- .col.span_8 END  -->

						<div class="col span_4">

							<div class="attention">
								<h6>出金について</h6>
								<p>原則として、最初に入金が行われた方法で出金処理を行いますのでご了承ください。各入金方法において、最も古い入金に対して最初に払い戻しが行われ、直近の入金に対しては最後に払い戻しが行われます。入金時に利用した支払方法に関しては、明細書にてご確認ください。</p>
								<p>注：出金は、直近の入金時から48時間が経過しませんとご依頼できません。</p>
							</div><!-- .attention END  -->

							<div class="attention">
								<h6>本人認証について</h6>
								<p>マネーロンダリングなどの犯罪防止、他人のなりすましによる不正使用などを防ぐため、本人かどうかを確認する手続きです。認証は一度のみ。下記のいずれか1点をアップロードしていただきます。</p>

								<ul>
									<li>パスポート</li>
									<li>運転免許証</li>
									<li>顔写真付き住基カード(政府発行のIDカード)</li>
								</ul>

								<p>詳しくは<a href="#">ガイドページ</a>をご覧ください。</p>
							</div><!-- .attention END  -->

						</div><!-- .col.span_4 END  -->

					</div><!-- .inner END  -->
				</div><!-- .box END  -->


			</article>

		</main>

	</div>

    <?php include $basedir . '/common/foot.php'; ?>
    <?php include $basedir . '/common/identity_verification_modal.php'; ?>
    <?php include $basedir . '/common/identity_success_modal.php'; ?>
    <?php include $basedir . '/common/create_atm_modal.php'; ?>
    <?php include $basedir . '/common/create_atm_confirm_modal.php'; ?>
	<?php include $basedir . '/common/withdrawal_banktransfar_modal.php'; ?>
	<?php include $basedir . '/common/withdrawal_banktransfar_confirm_modal.php'; ?>
	<?php include $basedir . '/common/withdrawal_netteler_modal.php'; ?>
	<?php include $basedir . '/common/withdrawal_bankcheck_modal.php'; ?>


	<script src="<?php echo $baseurl ?>/js/jquery-1.11.0.min.js"></script>
    <script src="<?php echo $baseurl ?>/js/jquery.remodal.js"></script>
	<script type="text/javascript" src="<?php echo $baseurl ?>/js/main_frontend.js"></script>

	<!-- Slimscroll for Header popup menu -->
	<script type="text/javascript" src="<?php echo $baseurl ?>/js/jquery.slimscroll.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.notifications-menu > .dropdown-menu > li .menu').slimScroll({height: '200px'});
		});
	</script>

	<script type="text/javascript">
	  $(document).ready(function(){

		$('#addcardbtn').click(function() {
	        $('#newbankinfo_box').addClass('active');
	    });

	  });
	</script>

	<!-- JS for Payment Method Tabs -->
	<script type="text/javascript" src="<?php echo $baseurl ?>/js/classList.js"></script>
	<script type="text/javascript" src="<?php echo $baseurl ?>/js/tabby.js"></script>
	<script>
	    tabby.init();
	</script>


	<script src="<?php echo $baseurl ?>/js/jquery.minimalect.min.js"></script>
	<script type="text/javascript">
	  $(document).ready(function(){
	    $("#identity-window form select").minimalect();
	  });
	</script>

</body>

</html>