<div class="row" style="margin-bottom: 15px;">
    <div class="col-xs-6">


    </div>
    <div class="col-xs-6">
    </div>
</div>

<div class="row">
    <div class="col-xs-12">


        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li id="li-bet" class=""><a id="href-bet" href="#bet" data-toggle="tab">Betting</a></li>
                <li id="li-coin" class=""><a id="href-coin" href="#coin" data-toggle="tab">Coin</a></li>                                        
                <!-- <li><a href="#profile" data-toggle="tab">Profile</a></li>    -->                                     
            </ul>
            <div class="tab-content">

                <!-- Betting Status -->
                <div class="tab-pane active" id="bet">
                    <section id="new">

                        <div class="row fontawesome-icon-list">

	                        <div class="col-md-6">
	                            <div class="box">
	                                <div class="box-header">
	                                    <h3 class="box-title"><?php echo $lang[249] // Now Betting?></h3>
	                                </div><!-- /.box-header -->
	                                <div class="box-body no-padding">
	                                    <table class="table table-striped">
	                                     	<tr>
	                                            <th>Game ID</th>
	                                            <th>Game Title</th>
	                                            <th style="width: 40px">COIN</th>
	                                        </tr>
	                                    <?php
	                                    if ($now_betting) {
	                                    	foreach ($now_betting as $nb) {
	                                    ?>
	                                        <tr>
	                                            <td><?php echo $nb['g_id']?></td>
	                                            <td><?php echo $nb['g_title']?></td>
	                                            <td><?php echo $nb['ub_coins']?></td>
	                                        </tr>
	                                    <?php
	                                    	} // foreach
	                                    }  else { // now betting
	                                    ?>
	                                    	<tr>
	                                            <td>--</td>
	                                            <td>--</td>
	                                            <td>--</td>
	                                        </tr>
	                                    <?php } // else ?>
	                                    </table>
	                                </div><!-- /.box-body -->
	                            </div><!-- /.box -->
	                        </div><!-- /.col -->
	
	                        <div class="col-md-6">
	                            <div class="box">
	                                <div class="box-header">
	                                    <h3 class="box-title"><?php echo $lang[155]; //Closed Games?></h3>
	                                    <div class="box-tools">
											<div class="btn-group pull-right">
												<button type="button" id="all-closed-bets-button" class="btn btn-sm btn-default active">All (<?php echo $total_closed_bets?>)</button>
												<button type="button" id="all-win-bets-button" class="btn btn-sm btn-default">Won (<?php echo count($closed_bets['win'])?>)</button>
												<button type="button" id="all-lose-bets-button" class="btn btn-sm btn-default">Lost (<?php echo count($closed_bets['lose'])?>)</button>
											</div>
	                                    </div>
	                                </div><!-- /.box-header -->
	                                <div class="box-body no-padding" id="all-closed-bets">
	                                    <table class="table table-striped">
	                                    	<tr>
	                                            <th>Game ID</th>
	                                            <th>Game Title</th>
	                                            <th>COIN</th>
	                                            <th style="width: 40px">Result</th>
	                                        </tr>
	                                    <?php
	                                    if ($closed_bets['all']) {
	                                    	foreach ($closed_bets['all'] as $cba) {
	                                	?>
	                                		<?php if (isset($cba['ub_coins_win'])) { ?>
	                                		<tr>
	                                            <td><?php echo $cba['g_id']?></td>
	                                            <td><?php echo $cba['g_title']?></td>
	                                            <td><?php echo $cba['ub_coins_win']?></td>
	                                            <td><span class="badge bg-light-blue"><?php echo $lang[250] // WON ?></span></td>
	                                        </tr>
	                                        <?php } // ub coins win ?>
	                                 		<?php if (isset($cba['ub_coins_lose'])) { ?>
	                                		<tr>
	                                            <td><?php echo $cba['g_id']?></td>
	                                            <td><?php echo $cba['g_title']?></td>
	                                            <td><?php echo $cba['ub_coins_lose']?></td>
	                                            <td><span class="badge"><?php echo $lang[251] // LOSE ?></span></td>
	                                        </tr>
	                                        <?php } // ub coins win ?>

	                                    <?php
	                                    	} // foreach
	                                    } else { // if closed bets all
	                                    ?>
	                                        <tr>
	                                            <td>--</td>
	                                            <td>--</td>
	                                            <td>--</td>
	                                            <td>--</td>
	                                        </tr>
	                                    <?php } ?>
	                                    </table>
	                                </div><!-- /.box-body -->

	                                <div class="box-body no-padding" id="all-win-bets" style="display:none">
	                                    <table class="table table-striped">
	                                    	<tr>
	                                            <th>Game ID</th>
	                                            <th>Game Title</th>
	                                            <th>COIN</th>
	                                            <th style="width: 40px">Result</th>
	                                        </tr>
	                                    <?php
	                                    if ($closed_bets['win']) {
	                                    	foreach ($closed_bets['win'] as $cbw) {
	                                	?>
.	                                		<tr>
	                                            <td><?php echo $cbw['g_id']?></td>
	                                            <td><?php echo $cbw['g_title']?></td>
	                                            <td><?php echo $cbw['ub_coins']?></td>
	                                            <td><span class="badge bg-light-blue"><?php echo $lang[250] // WON ?></span></td>
	                                        </tr>

	                                    <?php
	                                    	} // foreach
	                                    } else { // if closed bets all
	                                    ?>
	                                        <tr>
	                                            <td>--</td>
	                                            <td>--</td>
	                                            <td>--</td>
	                                            <td>--</td>
	                                        </tr>
	                                    <?php } ?>
	                                    </table>
	                                </div><!-- /.box-body -->

	                                <div class="box-body no-padding" id="all-lose-bets" style="display:none">
	                                    <table class="table table-striped">
	                                    	<tr>
	                                            <th>Game ID</th>
	                                            <th>Game Title</th>
	                                            <th>COIN</th>
	                                            <th style="width: 40px">Result</th>
	                                        </tr>
	                                    <?php
	                                    if ($closed_bets['win']) {
	                                    	foreach ($closed_bets['lose'] as $cbl) {
	                                	?>
.	                                		<tr>
	                                            <td><?php echo $cbl['g_id']?></td>
	                                            <td><?php echo $cbl['g_title']?></td>
	                                            <td><?php echo $cbl['ub_coins']?></td>
	                                            <td><span class="badge"><?php echo $lang[251] // LOSE ?></span></td>
	                                        </tr>

	                                    <?php
	                                    	} // foreach
	                                    } else { // if closed bets all
	                                    ?>
	                                        <tr>
	                                            <td>--</td>
	                                            <td>--</td>
	                                            <td>--</td>
	                                            <td>--</td>
	                                        </tr>
	                                    <?php } ?>
	                                    </table>
	                                </div><!-- /.box-body -->

	                            </div><!-- /.box -->
	                        </div><!-- /.col -->
	

                        </div>

                    </section>

                    <section id="new">

                        <div class="row fontawesome-icon-list">

	                        <div class="col-md-6">
	                            <div class="box">
	                                <div class="box-header">
	                                    <h3 class="box-title"><?php echo $lang[252] //Liked Games ?></h3>
	                                </div><!-- /.box-header -->
	                                <div class="box-body no-padding">
	                                    <table class="table table-striped">
	                                        <tr>
	                                            <th>Game ID</th>
	                                            <th>Game Title</th>
	                                        </tr>
	                                        <?php
	                                        if ($user_likes) {
	                                        	foreach ($user_likes as $ul) {
	                                        ?>
		                                        <tr>
		                                            <td><?php echo $ul['g_id']?></td>
		                                            <td><?php echo $ul['g_title']?></td>
		                                        </tr>
	                                        <?php
	                                        	} // foreach
	                                        } else { // if user_likes
	                                        ?>
		                                        <tr>
		                                            <td>--</td>
		                                            <td>--</td>
		                                        </tr>
	                                        <?php } // else ?>
	                                    </table>
	                                </div><!-- /.box-body -->
	                            </div><!-- /.box -->
	                        </div><!-- /.col -->
	
	                        <div class="col-md-6">
	                            <div class="box">
	                                <div class="box-header">
	                                    <h3 class="box-title"><?php echo $lang[253]; //Bookmarked Game?></h3>
	                                    <div class="box-tools">
											<div class="btn-group pull-right">
											</div>

	                                    </div>
	                                </div><!-- /.box-header -->
	                                <div class="box-body no-padding">
	                                    <table class="table table-striped">
	                                        <tr>
	                                            <th>Game ID</th>
	                                            <th>Game Title</th>
	                                        </tr>
	                                        <?php
	                                        if ($user_likes) {
	                                        	foreach ($user_bookmarks as $ub) {
	                                        ?>
		                                        <tr>
		                                            <td><?php echo $ub['g_id']?></td>
		                                            <td><?php echo $ub['g_title']?></td>
		                                        </tr>
	                                        <?php
	                                        	} // foreach
	                                        } else { // if user_likes
	                                        ?>
		                                        <tr>
		                                            <td>--</td>
		                                            <td>--</td>
		                                        </tr>
	                                        <?php } // else ?>
	                                    </table>
	                                </div><!-- /.box-body -->
	                            </div><!-- /.box -->
	                        </div><!-- /.col -->
	

                        </div>

                    </section>


                </div><!-- /#bet -->

                <!-- Coin Status -->
                <div class="tab-pane" id="coin">

	    <div class="box box-solid">

	        <div class="box-body table-responsive no-padding">
	            <table id="" class="table table-hover">
	                <thead>
	                    <tr>
	                        <th>Date</th>
	                        <th>Transaction ID</th>
	                        <th>IN / OUT</th>
	                        <th>Status</th>
	                        <th>User Name</th>
	                        <th>Amount</th>
	                    </tr>
	                </thead>
	                <tbody>
	                <?php
	                if ($user_coin_deals) {
	                	foreach ($user_coin_deals as $ucd) {
	                		$tx_id = ($ucd['tx_id']) ? $ucd['tx_id'] : 'n/a';
	                		if ($ucd['cd_type'] == 'transfer') {
	                			if ($ucd['cd_inout'] == 'in') {
	                				$cd_type = 'Deposit';
	                				$label_inout = "label-success";
	                			} else {
	                				$cd_type = 'Transfer';
	                				$label_inout = "label-danger";
	                			}
	                		} else {
	                			$cd_type = ucfirst($ucd['cd_type']);
	                			$label_inout = ($ucd['cd_inout'] == 'out') ? "label-success" : "label-danger";
	                		}
	                ?>
	                    <tr>
	                        <td><?php echo date('M d, Y H:i', $ucd['cd_tx_date'])?></td>
	                        <td><?php echo $tx_id?></td>
	                        <td><span class="label <?php echo $label_inout?>"><?php echo $cd_type?></span></td>
	                        <td>Complete</td>
	                        <td><a href="<?php echo $baseurl ?>/admin/users/userdetails?user_id=<?php echo $user_id?>&lang=<?php echo $LANGUAGE ?>"><?php echo $user_info['user_name']?></a></td>
	                        <td><?php echo $ucd['cd_amount']?> COINS</td>
	                    </tr>
	                <?php
	                	} // foreach
	                } else { // if $user_coin_deals
	                ?>
	                    <tr>
	                        <td>--</td>
	                        <td>--</td>
	                        <td>--</td>
	                        <td>--</td>
	                        <td>--</td>
	                        <td>--</td>
	                    </tr>
	               	<?php } // else ?>
	                </tbody>
	            </table>
	        </div><!-- /.box-body -->
	        <div class="box-footer">
	        </div><!-- /.box-header -->
	    </div><!-- /.box -->


                </div><!-- /#coin -->

                <!-- Profile Details -->
                <div class="tab-pane" id="profile">


                </div><!-- /#profile -->

            </div><!-- /.tab-content -->
        </div><!-- /.nav-tabs-custom -->


    </div>
</div>
