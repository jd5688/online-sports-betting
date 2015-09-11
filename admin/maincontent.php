<div class="row">
    <div class="col-xs-12">
		<h4 class="page-header"><?php echo $lang[46] ?> - <?php echo date('m/d/Y')?><small><?php echo $lang[47] ?></small></h4>
	</div><!-- ./col -->
	<div class="col-lg-3 col-xs-6">
	    <!-- small box -->
	    <div class="small-box bg-aqua">
	        <div class="inner">
	            <h3><span id="live-games"></span></h3>
	            <p><?php echo $lang[48]; //on Live Games?></p>
	        </div>
	        <div class="icon"><i class="ion ion-game-controller-a"></i></div>
	        <a href="<?php echo $baseurl ?>/admin/games?lang=<?php echo $LANGUAGE ?>" class="small-box-footer"><?php echo $lang[50] ?> <i class="fa fa-arrow-circle-right"></i></a>
	    </div>
	</div><!-- ./col -->

	<div class="col-lg-3 col-xs-6">
	    <!-- small box -->
	    <div class="small-box bg-green">
	        <div class="inner">
	            <h3><?php echo number_format($sales_today, 2)?><sup style="font-size: 20px"> <?php echo $config['currency']?></sup></h3>
	            <p><?php echo $lang[4]; //Sales?></p>
	        </div>
	        <div class="icon"><i class="ion ion-stats-bars"></i></div>
	        <a href="<?php echo $baseurl ?>/admin/sales?lang=<?php echo $LANGUAGE ?>" class="small-box-footer"><?php echo $lang[50] ?> <i class="fa fa-arrow-circle-right"></i></a>
	    </div>
	</div><!-- ./col -->

	<div class="col-lg-3 col-xs-6">
	    <!-- small box -->
	    <div class="small-box bg-red">
	        <div class="inner">
	            <h3><?php echo number_format($total_house_commission, 2)?><sup style="font-size: 20px"> <?php echo $config['currency']?></sup></h3>
	            <p>House Commission</p>
	        </div>
	        <div class="icon"><i class="ion ion-pie-graph"></i></div>
	        <a href="<?php echo $baseurl ?>/admin/sales?lang=<?php echo $LANGUAGE ?>" class="small-box-footer"><?php echo $lang[50] ?> <i class="fa fa-arrow-circle-right"></i></a>
	    </div>
	</div><!-- ./col -->

	<div class="col-lg-3 col-xs-6">
	    <!-- small box -->
	    <div class="small-box bg-yellow">
	        <div class="inner">
	            <h3><?php echo $total_registrations?></h3>
	            <p>User Registrations</p>
	        </div>
	        <div class="icon"><i class="ion ion-person-add"></i></div>
	        <a href="<?php echo $baseurl ?>/admin/users?lang=<?php echo $LANGUAGE ?>" class="small-box-footer"><?php echo $lang[50] ?> <i class="fa fa-arrow-circle-right"></i></a>
	    </div>
	</div><!-- ./col -->

</div>


<div class="row">
    <div class="col-xs-12">
		<br>
		<h4 class="page-header"><span id="display-header"><?php echo $lang[48] ?></span><small><?php echo $lang[49] ?></small></h4>
		<div class="btn-group">
			<button id="ball" type="button" class="btn btn-default <?php echo ($filter == 'all') ? 'active' : ''?>"><?php echo $lang[52] ?> <span id="sall"></span></button>
			<button id="bju" type="button" class="btn btn-default <?php echo ($filter == 'judgement') ? 'active' : ''?>"><?php echo $lang[53] ?> <span id="sju"></span></button>
			<button id="bli" type="button" class="btn btn-default <?php echo ($filter == 'live') ? 'active' : ''?>"><?php echo $lang[55] ?> <span id="sli"></span></button>
			<button id="bco" type="button" class="btn btn-default <?php echo ($filter == 'coming') ? 'active' : ''?>"><?php echo $lang[56] ?> <span id="sco"></span></button>
			<button id="bca" type="button" class="btn btn-default <?php echo ($filter == 'cancelled') ? 'active' : ''?>"><?php echo $lang[62] ?> <span id="sca"></span></button>
			<button id="bcl" type="button" class="btn btn-default <?php echo ($filter == 'closed') ? 'active' : ''?>"><?php echo $lang[54] ?> <span id="scl"></span></button>
		</div>
		<br><br>
    </div>
<?php if ($all_games) { ?>
	<span id="page1">
<?php
	// initialize counters
	$nall = $nju = $ncl = $nli = $nco = $nca = 0;
	$i = 0;
	$page = 1;
	$rec_per_page = $config['list_area_recs_per_page'];
	foreach ($all_games as $ag) {
		if ($ag['g_isDeleted']) { continue; }
		if ($i == $rec_per_page) {
			$page++;
			$i = 0;
			echo '</span>';
			echo '<span id="page' . $page . '" style="display:none">';
		}

		//$info_per_bet_item = $ag['info_per_bet_item'];
		$suff = getSuffix($ag);
		$show_this = false;
		$label = '';
		$label_class = '';
		$button_label = $lang[57]; // see details
		$button_color = 'btn-primary';
		$nall++;
		if ($ag['g_schedTo'] < time() AND !$ag['g_isClosed'] AND !$ag['g_isCancelled']) {
			$label = $lang[53]; // judgement
			$label_class = 'bg-red';
			$button_label = ucwords($lang[51]); // input result
			$button_color = 'btn-danger';
			$nju++;
		} elseif ($ag['g_schedFrom'] < time() AND $ag['g_schedTo'] > time() AND !$ag['g_isClosed'] AND !$ag['g_isCancelled']) {
			$label = $lang[55]; // live
			$label_class = 'bg-yellow';
			$nli++;
		} elseif ($ag['g_schedFrom'] > time() AND !$ag['g_isClosed'] AND !$ag['g_isCancelled']) {
			$label = $lang[56]; // coming
			$label_class = 'bg-gray';
			$nco++;
		} elseif ($ag['g_isCancelled'] AND !$ag['g_isClosed']) {
			$label = $lang[62]; // cancelled
			$label_class = 'label-warning';
			$nca++;
		} else {
			$label = $lang[54]; // closed
			$label_class = 'label-default';
			$ncl++;
		}

		switch ($filter) {
			case 'all':
				$all_bets = getAllBets($ag['g_id']);
				$info_per_bet_item = getInfoPerBetItem($all_bets);
				$display_header = $lang[52];
				$show_this = true;
				$i++;
				break;
			case 'judgement':
				$display_header = $lang[53];
				if ($label == $lang[53]) {
					$all_bets = getAllBets($ag['g_id']);
					$info_per_bet_item = getInfoPerBetItem($all_bets);
					$show_this = true;
					$i++;
				}
				break;
			case 'closed':
				$display_header = $lang[54];
				if ($label == $lang[54]) {
					$all_bets = getAllBets($ag['g_id']);
					$info_per_bet_item = getInfoPerBetItem($all_bets);
					$show_this = true;
					$i++;
				}
				break;
			case 'live':
				$display_header = $lang[55];
				if ($label == $lang[55]) {
					$all_bets = getAllBets($ag['g_id']);
					$info_per_bet_item = getInfoPerBetItem($all_bets);
					$show_this = true;
					$i++;
				}
				break;
			case 'coming':
				$display_header = $lang[56];
				if ($label == $lang[56]) {
					$all_bets = getAllBets($ag['g_id']);
					$info_per_bet_item = getInfoPerBetItem($all_bets);
					$show_this = true;
					$i++;
				}
				break;
			case 'cancelled':
				$display_header = $lang[62];
				if ($label == $lang[62]) {
					$all_bets = getAllBets($ag['g_id']);
					$info_per_bet_item = getInfoPerBetItem($all_bets);
					$show_this = true;
					$i++;
				}
				break;
		}
		if ($show_this) {
?>
	<div class="col-xs-4">
		<div class="box gametable box-danger">
			<div class="status">
			    <p>Game ID :<?php echo $ag['g_id']?></p>
			    <div class="box-tools pull-right">
			        <div class="label <?php echo $label_class?>"><?php echo $label ?></div>
			    </div>
			</div>
			<div class="box-header">
				<h3 class="box-title"><?php echo $ag['g_title' . $suff]?></h3>
			</div>
		
			<div class="box-body">
			<?php
			$total_bet = 0;
			foreach ($info_per_bet_item as $ipbi) {
				$bet_name = getBetItemName($ipbi['bi_id'], $suff);
				$total_bet += $ipbi['placed_coins'];
				$coins_ratio = number_format($ipbi['coins_ratio'], 2);
				if ($coins_ratio > 0) {
					$progress_color = 'progress-bar-red';
				}
				if ($coins_ratio > 24) {
					$progress_color = 'progress-bar-yello';
				}
				if ($coins_ratio > 49) {
					$progress_color = 'progress-bar-aqua';
				}
				if ($coins_ratio > 75) {
					$progress_color = 'progress-bar-green';
				}
			?>

				<b><?php echo $bet_name?></b>
				<div class="progress xs">
					<div class="progress-bar <?php echo $progress_color?>" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $coins_ratio?>%">
						<span class="sr-only"><?php echo $coins_ratio?>% vote</span>
					</div>
				</div>
			<?php } // foreach ?>
				<div class="row">
				    <div class="col-xs-6">
					    <b><?php echo $lang[58] ?></b>
					    <p><?php echo date('m/d/Y H:i', $ag['g_schedFrom'])?></p>
					    <b><?php echo $lang[59] ?></b>
					    <p><?php echo date('m/d/Y H:i', $ag['g_schedTo'])?></p>
				    </div>
				    <div class="col-xs-6">
					    <b><?php echo $lang[60] ?></b>
					    <p><?php echo number_format($total_bet)?> COIN</p>
						<a href="<?php echo $baseurl ?>/admin/games/details/?lang=<?php echo $LANGUAGE ?>&game_id=<?php echo $ag['g_id']?>" class="btn <?php echo $button_color?> btn-block pull-right"><?php echo $button_label ?></a>
				    </div>
				</div>

			</div><!-- /.box-body -->
		</div><!-- /.box -->

    </div>
<?php
		} // if $show_this
	} // foreach
?>
	</span>
<?php } // if $all_games; ?>
</div>

<div class="seemore">
	<a id="see-more-button" href="" name="2"><?php echo $lang[285]; //See more?></a>
</div>
<script>
$(document).ready(function() {
	var label = "<?php echo $display_header?>";

	$('#display-header').html(label);

	$('#sall').html('(<?php echo $nall?>)');
	$('#sju').html('(<?php echo $nju?>)');
	$('#sli').html('(<?php echo $nli?>)');
	$('#sco').html('(<?php echo $nco?>)');
	$('#sca').html('(<?php echo $nca?>)');
	$('#scl').html('(<?php echo $ncl?>)');

	$('#live-games').html('(<?php echo $nli?>)');

	$('button[type=button]').click(function(e) {
		e.preventDefault();
		var url = "<?php echo $baseurl?>/admin/?lang=<?php echo $LANGUAGE?>";
		var id = $(e.currentTarget).attr('id');

		if (id === 'ball') {
			url = url + '&filter=all';
		} else if (id === 'bju') {
			url = url + '&filter=judgement';
		} else if (id === 'bli') {
			url = url + '&filter=live';
		} else if (id === 'bco') {
			url = url + '&filter=coming';
		} else if (id === 'bca') {
			url = url + '&filter=cancelled';
		} else {
			url = url + '&filter=closed';
		}

		window.location.replace(url);

	})

	var total_pages = <?php echo $page?>;
	var page = 1;
	var spane = '';

	if (total_pages === 1) {
		$('div.seemore').hide();
	}

	$('#see-more-button').click(function(e) {
		e.preventDefault();
		spane = $(e.currentTarget).attr('name');
		if (total_pages > page) {
			page += 1;
		} 

		if (total_pages === page) {
			$('div.seemore').hide();
		}

		$('span#page' + spane).show();
		$(e.currentTarget).attr("name", page + 1);
	})
})
</script>

