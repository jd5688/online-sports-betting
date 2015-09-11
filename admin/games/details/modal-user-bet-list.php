<?php
$c = 0;
$betdetailnumber = 0;
$span_highroller = '';
if ($info_per_bet_item_by_username) {
    foreach ($info_per_bet_item_by_username as $ibu) {
        $betdetailnumber = $ibu['bi_id'];
?>

<!-- Modal -->
<div class="modal fade" id="betdetails-<?php echo $betdetailnumber?>" tabindex="-1" role="dialog" aria-labelledby="betdetails" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="betdetails">Betting "<?php echo $ibu['bet_item']?>"</h4>
      </div>
      <div class="modal-body">

        <div class="table-responsive">
            <!-- .table - Uses sparkline charts-->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>COIN</th>
                        <th>BET %</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                if ($ibu['users']) { 
                    foreach ($ibu['users'] as $ibu_user) {
                        $c++;
                        $span_highroller = ($ibu_user['is_highroller']) ? '<span class="label bg-yellow">' . $lang[172] . '</span>' : '';
                ?>
                    <tr>
                        <td><?php echo $c?></td>
                        <td><a href="<?php echo $baseurl ?>/admin/users/userdetails?user_id=<?php echo $ibu_user['user_id']?>&lang=<?php echo $LANGUAGE ?>"><?php echo $ibu_user['user_name']?></a> <?php echo $span_highroller?></td>
                        <td><?php echo $ibu_user['user_bet']?></td>
                        <td><?php echo number_format($ibu_user['user_ratio'],2);?>%</td>
                    </tr>
                <?php
                    } // foreach
                } // if
                ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th><?php echo $ibu['total_bets']?></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table><!-- /.table -->
        </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php 
    } // foreach
} // if 
?>