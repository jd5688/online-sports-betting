		<div class="alert alert-danger alert-dismissable" style="display:<?php echo $alert_disp?>">
	        <i class="fa fa-check"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	        <?php echo $lang[124] ?>
		</div>
		
	
<div class="row">
    <div class="col-xs-8">

                            <!-- Map box -->
                            <div class="box box-primary gamedetails">
								<div class="status">
								    <p><?php echo $lang[82] ?> : <?php echo $game['g_id']?></p>
								    <div class="box-tools pull-right">
								        <div class="label bg-red"><?php echo $game_status ?></div>
								    </div>
								</div>
								<br>
                                <div class="box-header">
                                    <h3 class="box-title"><?php echo $game['g_title']?></h3>
                                    <!-- tools box -->
                                    <div class="pull-right box-tools">                                        
                                    </div><!-- /. tools -->

                                </div>
                                <div class="box-body no-padding">
                                
                                <div class="descbox">

                                	<p><?php echo $game['g_description']?></p>
									<br>
									<dl class="dl-horizontal">
										<dt><?php echo $lang[98] ?></dt>
										<dd><?php echo date('d/m/Y h:i A', $game['g_schedFrom'])?> - <?php echo $lang[216]?></dd>
										<dd><?php echo date('d/m/Y h:i A', $game['g_schedTo'])?> - <?php echo $lang[217]?></dd>
										<dt><?php echo $lang[99] ?></dt>
										<dd><?php echo $game['g_coinPerBet']?></dd>
										<dt><?php echo $lang[100] ?></dt>
										<dd><?php echo $game['g_houseCom']?>%</dd>
									</dl>
									<br>
                                </div>
								
								


                                    <div class="table-responsive">
                                        <!-- .table - Uses sparkline charts-->
                                        <table class="table table-striped">
							                <thead>
							                    <tr>
	                                                <th>#</th>
	                                                <th><?php echo $lang[90] ?></th>
	                                                <th><?php echo $lang[125] ?></th>
	                                                <th><?php echo $lang[126] ?></th>
	                                                <th><?php echo $lang[127] ?></th>
	                                                <th><?php echo $lang[128] ?></th>
	                                                <th></th>
							                    </tr>
							                </thead>
		                	                <tbody>
			                	            <?php
				                	        if ($info_per_bet_item) {
					                	    	$c = 0;
                                                $total_coins = 0;
                                                $total_user = 0;
					                	    	foreach ($info_per_bet_item as $bi) {
					                	    		$c = $bi['bi_id'];
                                                    $total_coins += $bi['placed_coins'];
                                                    $total_users += $bi['bet_users_total'];
			                	            ?>
	                                            <tr>
	                                                <td><?php echo $c?></td>
	                                                <td><?php echo $bet_items2[$bi['bi_id']]?></td>
	                                                <td><?php echo $bi['placed_coins']?></td>
	                                                <td><?php echo $bi['bet_users_total']?></td>
	                                                <td><?php echo number_format($bi['coins_ratio'], 2)?>%</td>
	                                                <td><?php echo number_format($bi['ratio'], 2)?>%</td>
	                                                <td><a href="" class="btn btn-default btn-xs"  data-toggle="modal" data-target="#betdetails-<?php echo $c?>"><?php echo $lang[73] ?></a></td>

	                                            </tr>
                                            <?php
                                            	} // foreach 
                                            } else { // if $bet_items 
                                            ?>
	                                            <tr>
	                                                <td>&nbsp;</td>
	                                                <td>&nbsp;</td>
	                                                <td>&nbsp;</td>
	                                                <td>&nbsp;</td>
	                                                <td>&nbsp;</td>
	                                                <td>&nbsp;</td>
	                                                <td>&nbsp;</td>
	                                            </tr>
                                            <?php } // else ?>
							                </tbody>
							                <tfoot>
							                    <tr>
							                        <th></th>
							                        <th></th>
							                        <th><?php echo $total_coins?></th>
							                        <th><?php echo $total_users?></th>
							                        <th></th>
							                        <th></th>
							                        <th></th>
							                    </tr>
							                </tfoot>
                                        </table><!-- /.table -->
                                    </div>
                                </div><!-- /.box-body-->
                                <div class="box-footer">

                                </div>
                            </div>
                            <!-- /.box -->



		<div class="box box-solid">
			<div class="box-body">
				
				<h4>Match Betting</h4>
				<?php echo $game['g_betInfo']?>

				<h4>Game Condition</h4>
				<?php echo $game['g_addInfo']?>
			</div><!-- /.box-body -->
		</div><!-- /.box -->



    </div>
    <?php include 'sidebar-game-result.php';?>
</div>



<!-- Modal -->
<div class="modal fade" id="gameresult" tabindex="-1" role="dialog" aria-labelledby="gameresult" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="gameresult">Confirm</h4>
      </div>
      <div class="modal-body">
		  <p class="lead">一度送信すると変更は出来ません。内容を確認して問題なければボタンをクリックして下さい。</p>

			<blockquote>
                <span id="is-not-cancelled">
				<p>Win Item : <span id="modal-win-item"></span></p>
				<p>Winner : <span id="modal-total-winners"></span></p>
				<p>配当COIN : <span id="modal-coin-div"></span></p>
                </span>
                <span id="is-cancelled"></span>
                <input type="hidden" id="win-bi-id" value=""/>
                <input type="hidden" id="win-coin-div" value=""/>
                <input type="hidden" id="win-game-id" value=""/>
                <input type="hidden" id="win-house-com" value=""/>
                <input type="hidden" id="win-all-coins" value=""/>
			</blockquote>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="confirm-cancel-button" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="confirm-submit-button" href="#gameresult_success" data-toggle="modal" data-target="#gameresult_success">Complete to Submit</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="gameresult_success" tabindex="-1" role="dialog" aria-labelledby="gameresult_success" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" id="close-modal-button2" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="gameresult">Complete</h4>
      </div>
      <div class="modal-body">
		  <p class="lead">結果を反映させました。勝者ユーザーへCOINを配当しました。</p>

			<blockquote>
                <span id="is-not-cancelled2">
				<p>Win Item : <span id="modal-win-item2"></span></p>
				<p>Winner : <span id="modal-total-winners2"></span></p>
				<p>配当COIN : <span id="modal-coin-div2"></span></p>
                </span>
                <span id="is-cancelled2"></span>
			</blockquote>


      </div>
      <div class="modal-footer">
        <button type="button" id="close-modal-button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php include 'modal-user-bet-list.php';