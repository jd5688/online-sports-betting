<div class="row" style="margin-bottom: 15px;">
    <div class="col-xs-12">

		<div class="btn-group">
			<button type="button" name="filter" id="all" class="btn btn-sm btn-default <?php echo ($filter == 'all') ? 'active': '' ;?>"><?php echo $lang[52] ?> <span id="allc"></span></button>
			<button type="button" name="filter" id="judgement" class="btn btn-sm btn-default <?php echo ($filter == 'judgement') ? 'active': '' ;?>"><?php echo $lang[53] ?> <span id="juc"></span></button>
			<button type="button" name="filter" id="live" class="btn btn-sm btn-default" <?php echo ($filter == 'live') ? 'active': '' ;?>><?php echo $lang[55] ?> <span id="lic"></span></button>
			<button type="button" name="filter" id="coming" class="btn btn-sm btn-default" <?php echo ($filter == 'coming') ? 'active': '' ;?>><?php echo $lang[56] ?> <span id="coc"></span></button>
			<button type="button" name="filter" id="closed" class="btn btn-sm btn-default" <?php echo ($filter == 'closed') ? 'active': '' ;?>><?php echo $lang[54] ?> <span id="clc"></span></button>
			<button type="button" name="filter" id="cancelled" class="btn btn-sm btn-default" <?php echo ($filter == 'cancelled') ? 'active': '' ;?>><?php echo $lang[62] ?> <span id="cac"></span></button>
			<button type="button" name="filter" id="draft" class="btn btn-sm btn-default" <?php echo ($filter == 'draft') ? 'active': '' ;?>><?php echo $lang[61] ?> <span id="drc"></span></button>
		</div>

    </div>
</div>

<div class="row">
    <div class="col-xs-12">

	    <div class="box">
	        <div class="box-header">
				<h3 class="box-title"><?php echo $lang[19] ?><a href="<?php echo $baseurl ?>/admin/games/post?lang=<?php echo $LANGUAGE ?>" class="btn btn-default btn-flat"><?php echo $lang[29] ?></a></h3>
                <div class="box-tools">
                </div>
	        </div><!-- /.box-header -->
	        <div class="box-body table-responsive no-padding">
	            <table id="datatable" class="table table-hover">
	                <thead>
	                    <tr>
	                        <th><?php echo $lang[63] ?></th>
	                        <th><?php echo $lang[64] ?></th>
	                        <th><?php echo $lang[65] ?></th>
	                        <th><?php echo $lang[66] ?></th>
	                        <th><?php echo $lang[67] ?></th>
	                        <th><?php echo $lang[68] ?></th>
	                        <th><?php echo $lang[69] ?></th>
	                        <th><?php echo $lang[70] ?></th>
	                        <th><?php echo $lang[71] ?></th>
	                        <th><?php echo $lang[72] ?></th>
	                        <th><?php echo $lang[73] ?></th>
	                    </tr>
	                </thead>
	                <tbody>
	                <?php
	                // initialize counters
	                $allc = 0;
	                $drc = 0;
                	$clc = 0;
                	$cac = 0;
                	$coc = 0;
                	$lic = 0;
                	$juc = 0;
	                if ($games) {
	                	$now = time();
	                	$allc = count($games); 
	                	foreach ($games as $g) {
	                		$no_skip = false;
	                		$startdate = date('m/d/Y h:i A', $g['g_schedFrom']);
	                		$closedate = date('m/d/Y h:i A', $g['g_schedTo']);
	                		$title = $g['g_title'];
	                		if (strlen($title) > 30) {
		                		$title = substr($title, 0, 30) . '...';
	                		}
	                		$no_detail = false;
	                		$stat = getGameStatus($g, $lang);
	                		if ($stat == $lang[61]) {
	                			// draft
	                			$no_skip = ($filter == 'draft') ? true : false;
	                			$drc++;
	                			$bg = "bg-purple";
	                			$status = $lang[61];
	                			$no_detail = true;
	                		} elseif ($stat == $lang[54]) {
	                			// closed
	                			$no_skip = ($filter == 'closed') ? true : false;
	                			$clc++;
	                			$bg = "bg-gray";
	                			$status = $lang[54];
	                		} elseif ($stat == $lang[62]) {
	                			// cancelled
	                			$no_skip = ($filter == 'cancelled') ? true : false;
	                			$cac++;
	                			$bg = "bg-gray";
	                			$status = $lang[62];
	                		} elseif ($stat == $lang[56]) {
	                			// is coming
	                			$no_skip = ($filter == 'coming') ? true : false;
	                			$coc++;
	                			$bg = "label-success";
	                			$status = $lang[56];
	                		} elseif ($stat == $lang[55]) {
	                			// is live
	                			$no_skip = ($filter == 'live') ? true : false;
	                			$lic++;
	                			$bg = "label-danger";
	                			$status = $lang[55];
	                		} elseif ($stat == $lang[53]) {
	                			// needs judgement
	                			$no_skip = ($filter == 'judgement') ? true : false;
	                			$juc++;
	                			$bg = "bg-red";
	                			$status = $lang[53];
	                		}
	                		
	                		if ($filter == 'all') {
		                		$no_skip = true;
	                		}
	                		
	                		if (!$no_skip) { continue; }
	                ?>
	                	<tr>
	                        <td><?php echo $g['g_id']?></td>
	                        <td><span class="label <?php echo $bg?>"><?php echo $status ?></span></td>
	                        <td><a href="<?php echo $baseurl?>/admin/games/details?lang=<?php echo $LANGUAGE ?>&game_id=<?php echo $g['g_id']?>" target="_blank"><?php echo $title?></a></td>
	                        <td><?php echo $g['g_categories']?></td>
	                        <td>??</td>
	                        <td><?php echo $g['g_coinPerBet']?></td>
	                        <td><?php echo $g['g_houseCom']?></td>
	                        <td><?php echo $startdate?></td>
	                        <td><?php echo $closedate?></td>
	                        <td>
                        <?php if ($g['g_isClosed']) { ?>
	                        <a href="<?php echo $baseurl ?>/admin/games/edit/duplicategame.php?g_id=<?php echo $g['g_id']?>&lang=<?php echo $LANGUAGE ?>&game_id=<?php echo $g['g_id']?>" class="btn btn-default btn-sm"><?php echo $lang[472] ?></a>
	                    <?php } else { // if ?>
	                        <a href="<?php echo $baseurl ?>/admin/games/edit?lang=<?php echo $LANGUAGE ?>&game_id=<?php echo $g['g_id']?>" class="btn btn-default btn-sm"><?php echo $lang[72] ?></a>
	                    <?php } ?>
	                        </td>
	                        <td>
	                        <?php if (!$no_detail) {?>
	                        	<a href="<?php echo $baseurl ?>/admin/games/details?lang=<?php echo $LANGUAGE ?>&game_id=<?php echo $g['g_id']?>" class="btn btn-warning btn-sm"><?php echo $lang[73] ?></a>
	                        <?php } ?>
	                        </td>
	                    </tr>
	                <?php
	                	} // foreach
	                } else {// if games
	                ?>
	                	<tr>
	                        <td>&nbsp;</td>
	                        <td>&nbsp;</td>
	                        <td>&nbsp;</td>
	                        <td>&nbsp;</td>
	                        <td>&nbsp;</td>
	                        <td>&nbsp;</td>
	                        <td>&nbsp;</td>
	                        <td>&nbsp;</td>
	                        <td>&nbsp;</td>
	                        <td>&nbsp;</a></td>
	                        <td></td>
	                    </tr>
	                <?php
	                } // else
	                ?>
	                <?php /*
	                    <tr>
	                        <td>5</td>
	                        <td><span class="label bg-purple"><?php echo $lang[61] ?></span></td>
	                        <td><a href="http://204.63.8.52/sp9g/" target="_blank">Real Madrid vs FC Barcelona Which team will get a first goal??</a></td>
	                        <td>NFC</td>
	                        <td>0</td>
	                        <td>10</td>
	                        <td>15</td>
	                        <td>5/11/2014 12:00</td>
	                        <td>5/30/2014 22:59</td>
	                        <td><a href="<?php echo $baseurl ?>/admin/games/edit?lang=<?php echo $LANGUAGE ?>" class="btn btn-default btn-sm"><?php echo $lang[72] ?></a></td>
	                        <td></td>
	                    </tr>
	                    <tr>
	                        <td>6</td>
	                        <td><span class="label bg-gray"><?php echo $lang[54] ?></span></td>
	                        <td><a href="http://204.63.8.52/sp9g/" target="_blank">Real Madrid vs FC Barcelona Which team will get a first goal??</a></td>
	                        <td>BASKET</td>
	                        <td>50</td>
	                        <td>5</td>
	                        <td>15</td>
	                        <td>5/11/2014 12:00</td>
	                        <td>5/30/2014 22:59</td>
	                        <td><a href="<?php echo $baseurl ?>/admin/games/edit?lang=<?php echo $LANGUAGE ?>" class="btn btn-default btn-sm"><?php echo $lang[72] ?></a></td>
	                        <td><a href="<?php echo $baseurl ?>/admin/games/details/result?lang=<?php echo $LANGUAGE ?>" class="btn btn-warning btn-sm"><?php echo $lang[73] ?></a></td>
	                    </tr>
	                    <tr>
	                        <td>7</td>
	                        <td><span class="label label-success"><?php echo $lang[56] ?></span></td>
	                        <td><a href="http://204.63.8.52/sp9g/" target="_blank">Real Madrid vs FC Barcelona Which team will get a first goal??</a></td>
	                        <td>SOCCER</td>
	                        <td>0</td>
	                        <td>1</td>
	                        <td>15</td>
	                        <td>5/11/2014 12:00</td>
	                        <td>5/30/2014 22:59</td>
	                        <td><a href="<?php echo $baseurl ?>/admin/games/edit?lang=<?php echo $LANGUAGE ?>" class="btn btn-default btn-sm"><?php echo $lang[72] ?></a></td>
	                        <td><a href="<?php echo $baseurl ?>/games/details/coming?lang=<?php echo $language ?>" class="btn btn-warning btn-sm"><?php echo $lang[73] ?></a></td>
	                    </tr>
	                    <tr>
	                        <td>8</td>
	                        <td><span class="label label-danger"><?php echo $lang[55] ?></span></td>
	                        <td><a href="http://204.63.8.52/sp9g/" target="_blank">Real Madrid vs FC Barcelona Which team will get a first goal??</a></td>
	                        <td>BASEBALL</td>
	                        <td>40</td>
	                        <td>1</td>
	                        <td>25</td>
	                        <td>5/11/2014 12:00</td>
	                        <td>5/30/2014 22:59</td>
	                        <td><a href="<?php echo $baseurl ?>/admin/games/edit?lang=<?php echo $LANGUAGE ?>" class="btn btn-default btn-sm"><?php echo $lang[72] ?></a></td>
	                        <td><a href="<?php echo $baseurl ?>/games/details/live?lang=<?php echo $language ?>" class="btn btn-warning btn-sm"><?php echo $lang[73] ?></a></td>
	                    </tr>
	                    <tr>
	                        <td>9</td>
	                        <td><span class="label bg-gray"><?php echo $lang[62] ?></span></td>
	                        <td><a href="http://204.63.8.52/sp9g/" target="_blank">Real Madrid vs FC Barcelona Which team will get a first goal??</a></td>
	                        <td>BASEBALL</td>
	                        <td>8</td>
	                        <td>1</td>
	                        <td>25</td>
	                        <td>5/11/2014 12:00</td>
	                        <td>5/30/2014 22:59</td>
	                        <td><a href="<?php echo $baseurl ?>/admin/games/edit?lang=<?php echo $LANGUAGE ?>" class="btn btn-default btn-sm"><?php echo $lang[72] ?></a></td>
	                        <td><a href="<?php echo $baseurl ?>/admin/games/details/result?lang=<?php echo $LANGUAGE ?>" class="btn btn-warning btn-sm"><?php echo $lang[73] ?></a></td>
	                    </tr>
	                    <tr>
	                        <td>10</td>
	                        <td><span class="label label-danger"><?php echo $lang[55] ?></span></td>
	                        <td><a href="http://204.63.8.52/sp9g/" target="_blank">Real Madrid vs FC Barcelona Which team will get a first goal??</a></td>
	                        <td>BASEBALL</td>
	                        <td>85</td>
	                        <td>1</td>
	                        <td>25</td>
	                        <td>5/11/2014 12:00</td>
	                        <td>5/30/2014 22:59</td>
	                        <td><a href="<?php echo $baseurl ?>/admin/games/edit?lang=<?php echo $LANGUAGE ?>" class="btn btn-default btn-sm"><?php echo $lang[72] ?></a></td>
	                        <td><a href="<?php echo $baseurl ?>/games/details/live?lang=<?php echo $language ?>" class="btn btn-warning btn-sm"><?php echo $lang[73] ?></a></td>
	                    </tr>
	                <?php */ ?>
	                </tbody>
	                <tfoot>
	                    <tr>
	                        <th><?php echo $lang[63] ?></th>
	                        <th><?php echo $lang[64] ?></th>
	                        <th><?php echo $lang[65] ?></th>
	                        <th><?php echo $lang[66] ?></th>
	                        <th><?php echo $lang[67] ?></th>
	                        <th><?php echo $lang[68] ?></th>
	                        <th><?php echo $lang[69] ?></th>
	                        <th><?php echo $lang[70] ?></th>
	                        <th><?php echo $lang[71] ?></th>
	                        <th><?php echo $lang[72] ?></th>
	                        <th><?php echo $lang[73] ?></th>
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
	var juc = "<?php echo $juc?>";
	var lic = "<?php echo $lic?>";
	var coc = "<?php echo $coc?>";
	var clc = "<?php echo $clc?>";
	var cac = "<?php echo $cac?>";
	var drc = "<?php echo $drc?>";
	var baseurl = "<?php echo $baseurl?>";
	var LANG = "<?php echo $LANGUAGE?>";
	var filter = "<?php echo $filter?>";
	(allc !== "0") ? $('#allc').html("(" + allc + ")") : '';
	(juc !== "0") ? $('#juc').html("(" + juc + ")") : '';
	(lic !== "0") ? $('#lic').html("(" + lic + ")") : '';
	(coc !== "0") ? $('#coc').html("(" + coc + ")") : '';
	(clc !== "0") ? $('#clc').html("(" + clc + ")") : '';
	(cac !== "0") ? $('#cac').html("(" + cac + ")") : '';
	(drc !== "0") ? $('#drc').html("(" + drc + ")") : '';
	
	$('button[name="filter"]').click(function(e) {
		var filter = $(e.currentTarget).attr("id");
		
		if (filter !== "") {
			window.location.replace(baseurl + "/admin/games?lang=" + LANG + '&filter=' + filter);
		}
	})
})
</script>
