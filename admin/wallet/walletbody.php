<div class="row">
    <div class="col-xs-12">

	    <div class="box box-solid">
	        <div class="box-header">
				<h3 class="box-title"><?php echo $lang[6] ?></h3>
				<div class="box-tools"></div>
	        </div><!-- /.box-header -->
	        <div class="box-body table-responsive no-padding">
	            <table id="" class="table table-hover">
	                <thead>
	                    <tr>
	                        <th><?php echo $lang[150] ?></th>
	                        <th><?php echo $lang[165] ?></th>
	                        <th><?php echo $lang[166] ?></th>
	                        <th><?php echo $lang[64] ?></th>
	                        <th><?php echo $lang[167] ?></th>
	                         <th><?php echo $lang[175] ?></th>
	                        <th><?php echo $lang[168] ?></th>
	                    </tr>
	                </thead>
	                <tbody>
	                <?php
	                if ($transactions) {
	                	foreach ($transactions as $t) {
	                		$label = ($t['tr_method'] == 'withdraw') ? 'label-danger' : 'label-success';
	                		if ($t['tr_status'] == 0) {
	                			$status = $lang[464];
	                		} elseif ($t['tr_status'] == 1) {
	                			$status = $lang[465];
	                		} elseif ($t['tr_status'] == 2) {
	                			$status = $lang[173];
	                		}
	                ?>
	                	<tr>
	                        <td><?php echo date('m/d/Y h:i A', $t['tr_date'])?></td>
	                        <td><?php echo $t['tr_tx_id']?></td>
	                        <td><span class="label <?php echo $label?>"><?php echo $lang[169] ?></span></td>
	                        <td><?php echo $status?></td>
	                        <td><a href="<?php echo $baseurl ?>/users/userdetails?lang=<?php echo $language ?>"><?php echo $t['user_id']?></a></td>
	                        <td><a href="<?php echo $baseurl ?>/users/userdetails?lang=<?php echo $language ?>"><?php echo $all_users[$t['user_id']]['user_name'];?></a></td>
	                        <td><?php echo number_format($t['tr_coins']);?> <?php echo $t['tr_currency']?></td>
	                    </tr>
	                <?php
	                	} // foreach
	                } else { // if $transactions
	                ?>
	                    <tr>
	                        <td colspan="7"><?php echo $lang[463]; // there's no record found?></td>
	                    </tr>
	                <?php } ?>

	                <?php /*
	                    <tr>
	                        <td>5/11/2014 12:00</td>
	                        <td>XXYYZZXXYYZZ</td>
	                        <td><span class="label label-danger"><?php echo $lang[170] ?></span></td>
	                        <td>Complete</td>
	                        <td><a href="<?php echo $baseurl ?>/users/userdetails?lang=<?php echo $language ?>">Username 1</a></td>
	                        <td>$500</td>
	                    </tr>
	                    <tr>
	                        <td>5/11/2014 12:00</td>
	                        <td>XXYYZZXXYYZZ</td>
	                        <td><span class="label label-danger"><?php echo $lang[170] ?></span></td>
	                        <td>Complete</td>
	                        <td><a href="<?php echo $baseurl ?>/users/userdetails?lang=<?php echo $language ?>">Username 1</a></td>
	                        <td>$500</td>
	                    </tr>
	                    <tr>
	                        <td>5/11/2014 12:00</td>
	                        <td>XXYYZZXXYYZZ</td>
	                        <td><span class="label label-success"><?php echo $lang[169] ?></span></td>
	                        <td>Complete</td>
	                        <td><a href="<?php echo $baseurl ?>/users/userdetails?lang=<?php echo $language ?>">Username 1</a></td>
	                        <td>$500</td>
	                    </tr>
	                    <tr>
	                        <td>5/11/2014 12:00</td>
	                        <td>XXYYZZXXYYZZ</td>
	                        <td><span class="label label-success"><?php echo $lang[169] ?></span></td>
	                        <td>Complete</td>
	                        <td><a href="<?php echo $baseurl ?>/users/userdetails?lang=<?php echo $language ?>">Username 1</a></td>
	                        <td>$500</td>
	                    </tr>
	                    <tr>
	                        <td>5/11/2014 12:00</td>
	                        <td>XXYYZZXXYYZZ</td>
	                        <td><span class="label label-danger"><?php echo $lang[170] ?></span></td>
	                        <td>Complete</td>
	                        <td><a href="<?php echo $baseurl ?>/users/userdetails?lang=<?php echo $language ?>">Username 1</a></td>
	                        <td>$500</td>
	                    </tr>
	                <?php */ ?>
	                </tbody>
	            </table>
	        </div><!-- /.box-body -->
	        <div class="box-footer">
	        </div><!-- /.box-header -->
	    </div><!-- /.box -->

	
    </div>
</div>
