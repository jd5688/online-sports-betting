<div class="row" style="margin-bottom: 15px;">
    <div class="col-xs-6">

		<div class="btn-group">
			<button type="button" name="filter" id="all" class="btn btn-sm btn-default active" <?php echo ($filter == 'all') ? 'active': '' ;?>><?php echo $lang[52] ?> <span id="allc"></span></button>
			<button type="button" name="filter" id="approved" class="btn btn-sm btn-default" <?php echo ($filter == 'approved') ? 'active': '' ;?>><?php echo $lang[171] ?> <span id="ac"></span></button>
			<button type="button" name="filter" id="high-roller" class="btn btn-sm btn-default" <?php echo ($filter == 'high-roller') ? 'active': '' ;?>><?php echo $lang[172] ?> <span id="hc"></span></button>
			<button type="button" name="filter" id="pending" class="btn btn-sm btn-default" <?php echo ($filter == 'pending') ? 'active': '' ;?>><?php echo $lang[173] ?> <span id="pc"></span></button>
			<button type="button" name="filter" id="denied" class="btn btn-sm btn-default" <?php echo ($filter == 'denied') ? 'active': '' ;?>><?php echo $lang[174] ?> <span id="dc"></span></button>
		</div>

    </div>
    <div class="col-xs-6">
    </div>
</div>

<div class="row">
    <div class="col-xs-12">

	    <div class="box">
	        <div class="box-header">
				<h3 class="box-title"><?php echo $lang[14] ?></h3>
				<div class="box-tools"></div>
	        </div><!-- /.box-header -->
	        <div class="box-body table-responsive no-padding">
	            <table id="searchtable" class="table table-hover">
	                <thead>
	                    <tr>
	                        <th><?php echo $lang[167] ?></th>
	                        <th><?php echo $lang[175] ?></th>
	                        <th><?php echo $lang[176] ?></th>
	                        <th><?php echo $lang[64] ?></th>
	                        <th><?php echo $lang[177] ?></th>
	                        <th><?php echo $lang[178] ?></th>
	                        <th><?php echo $lang[179] ?></th>
	                        <th><?php echo $lang[180] ?></th>
	                        <th><?php echo $lang[181] ?></th>
	                    </tr>
	                </thead>
	                <tbody>
	                <?php
	                $allc = 0;
	                $ac = 0;
	                $hc = 0;
	                $pc = 0;
	                $dc = 0;
	                if ($users) {
	                	$allc = count($users);
	                	foreach ($users as $u) {
	                		$no_skip = false;
	                		/*
	                		if (!$u['user_isadmin']) {
	                			$allc++;
	                		} else {
	                			// skip admin
	                			continue;
	                		}
							*/
	                		if ($filter == 'all') {
	                			$no_skip = true;
	                			if ($u['user_status'] == 3) { 
	                				$hc++;
	                				$label_text = $lang[172];
		                			$label_class = 'bg-yellow';
	                			} // high-roller
	                			if ($u['user_status'] == 1) {
	                				$ac++;
		                			$label_text = $lang[171];
		                			$label_class = 'label-success';
		                		} // approved
		                		if ($u['user_status'] == 2) {
		                			$pc++;
		                			$label_text = $lang[173];
		                			$label_class = 'bg-gray';
		                		} // pending
		                		if ($u['user_status'] == 0) {
		                			$dc++;
		                			$label_text = $lang[174];
		                			$label_class = 'label-danger';
		                		} // denied
	                		} elseif ($filter == 'high-roller') {
	                			if ($u['user_status'] == 3) {
	                				$hc++;
		                			$no_skip = true;
		                			$label_text = $lang[172];
		                			$label_class = 'bg-yellow';
		                		}
		                		if ($u['user_status'] == 1) {
	                				$ac++;
		                		} // approved
		                		if ($u['user_status'] == 2) {
		                			$pc++;
		                		} // pending
		                		if ($u['user_status'] == 0) {
		                			$dc++;
		                		} // denied
	                		} elseif ($filter == 'approved') {
	                			if ($u['user_status'] == 1) {
	                				$ac++;
		                			$no_skip = true;
		                			$label_text = $lang[171];
		                			$label_class = 'label-success';
		                		}
		                		if ($u['user_status'] == 3) {
	                				$hc++;
		                		}
		                		if ($u['user_status'] == 2) {
		                			$pc++;
		                		} // pending
		                		if ($u['user_status'] == 0) {
		                			$dc++;
		                		} // denied
	                		} elseif ($filter == 'pending') {
	                			if ($u['user_status'] == 2) {
	                				$pc++;
		                			$no_skip = true;
		                			$label_text = $lang[173];
		                			$label_class = 'bg-gray';
		                		}
		                		if ($u['user_status'] == 3) {
	                				$hc++;
		                		}
		                		if ($u['user_status'] == 1) {
	                				$ac++;
		                		} // approved
		                		if ($u['user_status'] == 0) {
		                			$dc++;
		                		} // denied
	                		} elseif ($filter == 'denied') {
	                			if ($u['user_status'] == 0) {
	                				$dc++;
		                			$no_skip = true;
		                			$label_text = $lang[174];
		                			$label_class = 'label-danger';
		                		}
		                		if ($u['user_status'] == 3) {
	                				$hc++;
		                		}
		                		if ($u['user_status'] == 1) {
	                				$ac++;
		                		} // approved
		                		if ($u['user_status'] == 2) {
		                			$pc++;
		                		} // pending
	                		}

	                		if (!$no_skip) { continue; }
	                ?>
	                    <tr>
	                        <td><?php echo $u['user_id']?></td>
	                        <td><a href="<?php echo $baseurl ?>/admin/users/userdetails?user_id=<?php echo $u['user_id']?>&lang=<?php echo $LANGUAGE ?>"><?php echo $u['user_name']?></a></td>
	                        <td><?php echo $u['user_fullname']?></td>
	                        <td><span class="label <?php echo $label_class?>"><?php echo $label_text; ?></span></td>
	                        <td><a href="<?php echo $baseurl ?>/admin/users/userdetails?user_id=<?php echo $u['user_id']?>&lang=<?php echo $LANGUAGE ?>&active=coin">100</a></td>
	                        <td><a href="<?php echo $baseurl ?>/admin/users/userdetails?user_id=<?php echo $u['user_id']?>&lang=<?php echo $LANGUAGE ?>&active=bet">2</a></td>
	                        <td><a href="mailto:" title="E-mail: user@gmail.com"><?php echo $u['user_email']?></a></td>
	                        <td><?php echo date('m-d-Y', $u['user_lastlogin'])?></td>
	                        <td><?php echo date('m-d-Y', strtotime($u['user_registered']))?></td>
	                    </tr>
	                <?php
	                	} // foreach
	                } else { // if $users
	                ?>
	                	<tr>
	                        <td>--</td>
	                        <td>--</td>
	                        <td>--</td>
	                        <td>--</td>
	                        <td>--</td>
	                        <td>--</td>
	                        <td>--</td>
	                        <td>--</td>
	                        <td>--</td>
	                    </tr>
	                <?php }  // else ?>
	                </tbody>
	                <tfoot>
	                    <tr>
	                        <th><?php echo $lang[167] ?></th>
	                        <th><?php echo $lang[175] ?></th>
	                        <th><?php echo $lang[176] ?></th>
	                        <th><?php echo $lang[64] ?></th>
	                        <th><?php echo $lang[177] ?></th>
	                        <th><?php echo $lang[178] ?></th>
	                        <th><?php echo $lang[179] ?></th>
	                        <th><?php echo $lang[180] ?></th>
	                        <th><?php echo $lang[181] ?></th>
	                    </tr>
	                </tfoot>
	            </table>
	        </div><!-- /.box-body -->
	    </div><!-- /.box -->
	
    </div>
</div>
<script>
$(document).ready(function () {
	var allc = "<?php echo $allc?>";
	var ac = "<?php echo $ac?>";
	var hc = "<?php echo $hc?>";
	var pc = "<?php echo $pc?>";
	var dc = "<?php echo $dc?>";
	var baseurl = "<?php echo $baseurl?>";
	var LANG = "<?php echo $LANGUAGE?>";
	var filter = "<?php echo $filter?>";
	(allc !== "0") ? $('#allc').html("(" + allc + ")") : '';
	(ac !== "0") ? $('#ac').html("(" + ac + ")") : '';
	(hc !== "0") ? $('#hc').html("(" + hc + ")") : '';
	(pc !== "0") ? $('#pc').html("(" + pc + ")") : '';
	(dc !== "0") ? $('#dc').html("(" + dc + ")") : '';
	
	$('button[name="filter"]').click(function(e) {
		var filter = $(e.currentTarget).attr("id");
		
		if (filter !== "") {
			window.location.replace(baseurl + "/admin/users?lang=" + LANG + '&filter=' + filter);
		}
	})
})
</script>
