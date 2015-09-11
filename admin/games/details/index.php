<?php
require_once("../../../include/config.php");
require_once($basedir . "/admin/include/functions.php");
include $basedir . '/admin/include/isadmin.php';

$gamemenu='active';
$bet_items2 = false;
$game_id = (isset($_GET['game_id'])) ? $_GET['game_id'] : false;

if (!$game_id) {
	header('Location: '. $baseurl . '/admin/games?lang=' . $LANGUAGE);
	exit;
}
$game = getGame($game_id);
$is_closed = $game['g_isClosed'];
$is_cancelled = $game['g_isCancelled'];
$disable_el = ($is_closed OR $is_cancelled) ? "disabled" : '';
$all_bets = getAllBets($game_id);
if (!$game) {
	header('Location: '. $baseurl . '/admin/games?lang=' . $LANGUAGE);
	exit;
}

$info_per_bet_item = getInfoPerBetItem($all_bets); // get placed coins, bet users, and ratio
$game_status = getGameStatus($game, $lang);
$bet_items = getBetItems($game_id);
if ($game_status == $lang[53]) {
	// judgement
	$alert_disp = 'block';
} else {
	$alert_disp = 'none';
}
foreach($bet_items as $bi) {
	$bet_items2[$bi['bi_id']] = $bi['bi_description']; // assign bi_id as key and bi_description as value
}
$info_per_bet_item_by_username = getInfoPerBetItemByUsername($all_bets, $bet_items2);
?>
<!DOCTYPE html>
<html>
	<head>
		<?php include $basedir . '/admin/include/header.php'; ?>
	</head>

	<body class="skin-blue">
	<!-- header logo: style can be found in header.less -->
	<header class="header">
		<?php include $basedir . '/admin/include/header_menu.php'; ?>
	</header><!-- ./header -->
	
	<div class="wrapper row-offcanvas row-offcanvas-left">

		<!-- Left side column. -->
		<aside class="left-side sidebar-offcanvas">                

			<!-- sidebar: style can be found in sidebar.less -->
			<section class="sidebar">
				<?php include $basedir . '/admin/include/sidebar.php'; ?>
			</section><!-- /.sidebar -->

		</aside><!-- /.left-side -->

		<!-- Right side column -->
		<aside class="right-side">

			<!-- Header Nav (breadcrumb) -->
			<section class="content-header">
				<h1><?php echo $lang[43] ?><small><?php echo $lang[44] ?></small></h1>
				<ol class="breadcrumb">
					<li><a href="<?php echo $baseurl ?>/"><i class="fa fa-dashboard"></i><?php echo $lang[27] ?></a></li>
					<li><a href="<?php echo $baseurl ?>/games"><?php echo $lang[18] ?></a></li>
					<li class="active"><?php echo $lang[43] ?></li>
				</ol>
			</section><!-- /.content-header -->

			<!-- Main content -->
			<section class="content">
				<?php include $basedir . '/admin/games/details/gamesdetails_result_body.php'; ?>
			</section><!-- /.content -->

		</aside><!-- /.right-side -->

	</div><!-- ./wrapper -->
	
	<?php include $basedir . '/include/javascript.php'; ?>
	
	</body>
</html>
<script>
$(document).ready(function () {
	var interv = '';
	// loop every 1 sec to check if cancel game button is checked
	interv = setInterval(function() {
		if ($('div.icheckbox_minimal').hasClass("checked")) {
			// if checked, enable the submit button
			$('#game-result-submit-button').removeClass('disabled');
			if ($('#is-not-cancelled').is(':visible')) {
				$('#is-not-cancelled').hide();
				$('#is-cancelled').html('<?php echo $lang["248"]?>');
				$('#is-not-cancelled2').hide();
				$('#is-cancelled2').html('<?php echo $lang["248"]?>');
			}
		} else {
			// if not checked or has been unchecked, check if winning item has not yet been selected
			if ($('select[name=win_item]').val() === null) {
				// if no winning item has been selected, disable the submit button
				$('#game-result-submit-button').addClass('disabled');
			}
			if (!$('#is-not-cancelled').is(':visible')) {
				$('#is-not-cancelled').show();
				$('#is-cancelled').html("");
				$('#is-not-cancelled2').show();
				$('#is-cancelled2').html('');
			}
		}
	}, 1000);

	var is_closed = "<?php echo $is_closed?>";
	var is_cancelled = "<?php echo $is_cancelled?>";
	$('#win-game-id').val("<?php echo $game['g_id']?>");

	if (is_closed === '1' || is_cancelled === '1') {
		clearInterval(interv);
		if (is_closed) {
			showMore();
		}
		$('#game-result-submit-button').addClass('disabled');
		$('select[name=win_item]').attr("disabled", true);
	};
	$('select[name=win_item]').click(showMore);

	function showMore() {
		//clearInterval(interv); // break the loop
		var win_item = $('select[name=win_item]').val();
		var game_id = "<?php echo $game['g_id']?>";
		var commission = "<?php echo $game['g_houseCom']?>";
		var total_coins = "<?php echo $total_coins?>";
		var cancel = $('div.icheckbox_minimal').hasClass("checked");
		$('#game_result_box').hide();
		$('#loading-image').show();
		//$('#game_result_box').show();

		$('#game-result-submit-button').removeClass('disabled');
		// let's compute the winning coins, commission, and dividend
		var t = "<?php echo $time;?>";
		var url = "<?php echo $baseurl ?>";
		var key = "<?php echo $public_key?>";
		var hash = "<?php echo $hash?>";
		url = url + "/admin/games/details/computegameresult.php";
		var uri = 'hash=' + hash + '&public=' + key + '&t=' + t;
		uri += '&tc=' + total_coins + '&wi=' + win_item + '&gi=' + game_id + '&comm=' + commission;

		if (!cancel) {
			$('#is-not-cancelled').show();
			$('#is-cancelled').html('');
			$('#is-not-cancelled2').show();
			$('#is-cancelled2').html('');
		}

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
				if (data.status === 'success') {
					$('#xt-coins').html(data.total_coins);
					$('#xt-commission').html(data.total_commission);
					$('#xt-subtotal').html(data.sub_total);
					$('#xt-winners').html(data.total_winners);
					$('#xt-coin-div').html(data.coin_dividend);
					$('#modal-win-item').html(data.winner_name);
					$('#modal-total-winners').html(data.total_winners);
					$('#modal-coin-div').html(data.coin_dividend);
					$('#modal-win-item2').html(data.winner_name);
					$('#modal-total-winners2').html(data.total_winners);
					$('#modal-coin-div2').html(data.coin_dividend);
					$('#win-bi-id').val(win_item);
					$('#win-coin-div').val(data.coin_dividend);
					$('#win-game-id').val(game_id);
					$('#win-house-com').val(data.total_commission);
					$('#win-all-coins').val(data.total_coins);
					$('#loading-image').hide();
					$('#game_result_box').show();
				} else {
					var message = data.status;
					message = 'hello';
					$('#message').html(message);
					setTimeout(function() {
						$('#message').html('');
					}, 2000);
				}
			}
			
		});
	};
	$('#confirm-submit-button').click(function() {
		$('#confirm-cancel-button').click();
		var win_item =	$('#win-bi-id').val();
		var coin_div = $('#win-coin-div').val();
		var game_id = $('#win-game-id').val();
		var house_com = $('#win-house-com').val();
		var total_coins = $('#win-all-coins').val();
		var cancel = $('div.icheckbox_minimal').hasClass("checked");
		var t = "<?php echo $time;?>";
		var url = "<?php echo $baseurl ?>";
		var key = "<?php echo $public_key?>";
		var hash = "<?php echo $hash?>";
		url = url + "/admin/games/details/submitgameresult.php";
		var uri = 'hash=' + hash + '&public=' + key + '&t=' + t;
		uri += '&tc=' + total_coins  + '&wi=' + win_item + '&gi=' + game_id + '&div=' + coin_div + '&hc=' + house_com +'&cancel=' + cancel;

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
				if (data.status === 'success') {
					return true;
				}
			}
			
		});
	})
	$('#close-modal-button, #close-modal-button2').click(function() {
		location.reload();
	})
});
</script>