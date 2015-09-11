<div class="row">
    <div class="col-xs-4">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title"><?php echo $lang[194] ?></h3>
				<div class="box-tools">
				</div>
			</div>
		
			<div class="box-body">
			<?php 
			if ($coin_packages) { 
				$c = 0;
			?>
				<!-- checkbox -->
                <div class="form-group" id="formCheckbox"> 
			<?php 
				foreach ($coin_packages as $cp) { 
					$checked = ($cp['cpenabled'] == 1) ? "checked" : "";
			?>	

                    <div class="checkbox">
                        <label>
                            <input id="cb<?php echo $c?>" value="<?php echo $cp['cpid']?>" type="checkbox" <?php echo $checked?>/>
                            <?php echo $cp['cpcoin'];?> COIN / $<?php echo $cp['cpamount'];?>
                        </label>                                                
                    </div>
            <?php 
            	$c++;
            } // foreach 
            ?>
                </div>
				<button class="btn btn-primary" id="save_package"><?php echo $lang[122] ?></button>
				<span id="saved_alert"></span>
				<input type="hidden" id="numpackage" value="<?php echo count($coin_packages)?>"/>
			<?php } // if $coin_packages ?>

				<br>
				<br>
				

				<label for="exampleInputEmail1"><?php echo $lang[195] ?></label>
				<div class="row">
					<div class="col-xs-6">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-dollar"></i></span>
							<input type="number" id="dollarvalue" class="form-control">
						</div>
					</div>
					<div class="col-xs-6">
						<div class="input-group">
							<input type="number" id="coinvalue" class="form-control">
							<span class="input-group-addon">COIN</span>
						</div>
					</div>
				</div>

				<br>
				
				<button class="btn btn-primary" id="create_package"><?php echo $lang[196] ?></button>
				<span id="created_alert"></span>
			</div><!-- /.box-body -->
		</div><!-- /.box -->


    </div>

    <div class="col-xs-4">

		<div class="box">
			<div class="box-header">
				<h3 class="box-title"><?php echo $lang[197] ?></h3>
				<div class="box-tools">
				</div>
			</div>
		
			<div class="box-body">
				
                <!-- checkbox -->
                <div class="form-group"> 
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" id="coup-isWelcome"/>
                            <?php echo $lang[198] ?>
                        </label>                                            
                    </div>

                </div>

				<div class="form-group">
					<label for="exampleInputEmail1"><?php echo $lang[199] ?></label>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-dollar"></i></span>
						<input type="text" id="coup-keyword" class="form-control" required>
					</div>
				</div>

				<div class="form-group">
					<label for="exampleInputEmail1">COIN</label>
					<div class="input-group">
						<input type="text" id="coup-coins" class="form-control" required>
						<span class="input-group-addon">COIN</span>
					</div>
				</div>

				<button class="btn btn-primary" id="coup-button"><?php echo $lang[122] ?></button>
				<span id="message-coup"></span>
			</div><!-- /.box-body -->
		</div><!-- /.box -->


		<div class="box">
			<div class="box-header">
				<h3 class="box-title"><?php echo $lang[200] ?></h3>
				
				<div class="box-tools">
				</div>
			</div>
			<div class="box-body">
				<?php echo $lang[201] ?>
				<p class="text-red"><?php echo $lang[202] ?></p>
                <!-- radio -->
                <div class="form-group"> 
                    <div class="radio">
                        <label>
                            <input type="radio" name="botoptions" value="1" id="botoption1" <?php echo ($config['bot system'] == "1") ? "checked" : "";?>/> ON
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="botoptions" value="0" id="botoption2" <?php echo ($config['bot system'] == "0") ? "checked" : "";?>/> OFF
                        </label>
                    </div>
                </div>

				<div class="form-group">
				<label for="exampleInputEmail1"><?php echo $lang[203] ?></label>
				<div class="input-group">
					<span class="input-group-addon">@</span>
					<input type="text" class="form-control" id="botUsername" placeholder="Username" value="<?php echo $config['bot username']?>"/>
				</div>
				</div>

				<button class="btn btn-primary" id="bot-button"><?php echo $lang[122] ?></button>
				<span id="message-bot"></span>
			</div><!-- /.box-body -->
		</div><!-- /.box -->


    </div>

    <div class="col-xs-4">

		<div class="box">
			<div class="box-header">
				<h3 class="box-title"><?php echo $lang[204] ?></h3>
				<div class="box-tools">
				</div>
			</div>
		
			<div class="box-body">
				
                <!-- checkbox -->
                <div class="form-group"> 
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" id="tweet-when-game-live" <?php echo ($config['tweet when game live']) ? "checked" : ""?>/>
                            <?php echo $lang[205] ?>
                        </label>                                                
                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" id="tweet-when-game-ends" <?php echo ($config['tweet when game ends']) ? "checked" : ""?>/>
                            <?php echo $lang[206] ?>
                        </label>                                                
                    </div>

                </div>

				<div class="form-group">
				<label for="exampleInputEmail1">Twitter ID</label>
				<div class="input-group">
					<span class="input-group-addon">@</span>
					<input type="text" class="form-control" id="twitter-id" placeholder="Username" value="<?php echo $config['twitter id']?>">
				</div>
				</div>

				<button class="btn btn-primary" id="tweet-button"><?php echo $lang[122] ?></button>
				<span id="message-tweet"></span>
			</div><!-- /.box-body -->
		</div><!-- /.box -->

		<div class="box">
			<div class="box-header">
				<h3 class="box-title"><?php echo $lang[207] ?></h3>
				<div class="box-tools">
				</div>
			</div>
		
			<div class="box-body">
				
				<div class="form-group">
					<label for="exampleInputEmail1"><?php echo $lang[208] ?></label>
					<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter Language Code">
				</div>
				<div class="form-group">
					<label for="exampleInputEmail2"><?php echo $lang[209] ?></label>
					<input type="email" class="form-control" id="exampleInputEmail2" placeholder="Enter Language Name">
				</div>

				<button class="btn btn-primary"><?php echo $lang[196] ?></button>
			
			</div><!-- /.box-body -->
		</div><!-- /.box -->

		<div class="box">
			<div class="box-header">
				<h3 class="box-title"><?php echo $lang[210] ?></h3>
				<div class="box-tools">
				</div>
			</div>
			<div class="box-body">
				
                <!-- radio -->
                <div class="form-group"> 
                    <div class="radio">
                        <label>
                            <input type="radio" name="maintenanceMode" id="maintenanceOn" value="1" <?php echo ($config['maintenance_mode'] == 1) ? "checked" : ''?>> ON
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="maintenanceMode" id="maintenanceOff" value="1" <?php echo ($config['maintenance_mode'] == 0) ? "checked" : ''?>> OFF
                        </label>
                    </div>
                </div>


				<button class="btn btn-primary" id="maintenance_button"><?php echo $lang[122] ?></button>
				<span id="message-mb"></span>
			</div><!-- /.box-body -->
		</div><!-- /.box -->

    </div>
</div>

<script>
$(document).ready(function() {
	$('#bot-button').click(function() {
		var bot_system = $('#botoption1').is(":checked") ? 1 : 0;
		var bot_username = $('#botUsername').val();
		var t = "<?php echo $time;?>";
        var url = "<?php echo $baseurl ?>";
        var key = "<?php echo $public_key?>";
        var hash = "<?php echo $hash?>";
        url = url + "/admin/settings/advanced/botsystem.php";
        var uri = 'hash=' + hash + '&public=' + key + '&t=' + t;
        uri += '&botSystem=' + bot_system + '&botUsername=' + bot_username;

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
            	if (data.error === '1') {
	            	$('#message-bot').html(data.status);
            	} else {
            		$('#message-bot').html('saved');
            	}
                setTimeout(function() {
					$('#message-bot').html('');
				}, 2000);
            }
            
        });
	})
	$('#tweet-button').click(function() {
		var tweet_live = $('#tweet-when-game-live').is(':checked') ? 1 : 0;
		var tweet_ends = $('#tweet-when-game-ends').is(':checked') ? 1 : 0;
		var twitter_id = $('#twitter-id').val();
		var t = "<?php echo $time;?>";
        var url = "<?php echo $baseurl ?>";
        var key = "<?php echo $public_key?>";
        var hash = "<?php echo $hash?>";
        url = url + "/admin/settings/advanced/tweet.php";
        var uri = 'hash=' + hash + '&public=' + key + '&t=' + t;
        uri += '&tweetLive=' + tweet_live + '&tweetEnds=' + tweet_ends + '&twitterId=' + twitter_id;

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
            	if (data.error === '1') {
	            	$('#message-tweet').html(data.status);
            	} else {
            		$('#message-tweet').html('saved');
            	}
                setTimeout(function() {
					$('#message-tweet').html('');
				}, 2000);
            }
            
        });
	})
	$('#coup-button').click(function() {
		var is_welcome = $('#coup-isWelcome').is(':checked') ? 1 : 0;
		var coup_keyword = $('#coup-keyword').val();
		var coup_coins = $('#coup-coins').val();
		var t = "<?php echo $time;?>";
        var url = "<?php echo $baseurl ?>";
        var key = "<?php echo $public_key?>";
        var hash = "<?php echo $hash?>";
        url = url + "/admin/settings/advanced/couponcode.php";
        var uri = 'hash=' + hash + '&public=' + key + '&t=' + t;
        uri += '&isWelcome=' + is_welcome + '&keyword=' + coup_keyword + '&coins=' + coup_coins;

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
            	if (data.error === '1') {
	            	$('#message-coup').html(data.status);
            	} else {
            		$('#coup-isWelcome').parent().removeClass("checked");
            		$('#coup-keyword').val('');
            		$('#coup-coins').val('');
            		$('#message-coup').html('saved');
            	}
                setTimeout(function() {
					$('#message-coup').html('');
				}, 2000);
            }
            
        });
	})
	$('#maintenance_button').click(function() {
		var m_on = $('#maintenanceOn').is(':checked') ? 1 : 0;
		var m_off = $('#maintenanceOff').is(':checked') ? 1 : 0;
		var t = "<?php echo $time;?>";
        var url = "<?php echo $baseurl ?>";
        var key = "<?php echo $public_key?>";
        var hash = "<?php echo $hash?>";
        url = url + "/admin/settings/advanced/maintenance.php";
        var uri = 'hash=' + hash + '&public=' + key + '&t=' + t;
        uri += '&m_on=' + m_on + '&m_off=' + m_off;

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
            	if (data.status === 'fail') {
	            	$('#message-mb').html(data.status);
            	} else {
                	$('#message-mb').html('saved');
                }
                
                setTimeout(function() {
					$('#message-mb').html('');
				}, 2000);
            }
            
        });
	})
	$('#create_package').click(function() {
		var dollarvalue = $('#dollarvalue').val();
		var coinvalue = $('#coinvalue').val();
		var t = "<?php echo $time;?>";
		var url = "<?php echo $baseurl ?>";
		var key = "<?php echo $public_key?>";
		var hash = "<?php echo $hash?>";
		var newdiv = '';
		var newlabel = '';
		var newinput = '';
		var numpackage = 0;
		if (dollarvalue === "") {
			$( "#dollarvalue" ).focus();
			return false;
		}
		if (coinvalue === "") {
			$( "#coinvalue" ).focus();
			return false;
		}

		url = url + "/admin/settings/advanced/coinpackage.php";
		var uri = 'dollar=' + dollarvalue + '&coin=' + coinvalue + '&hash=' + hash + '&public=' + key + '&t=' + t;
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
				if (data.error === "" && data.status !== 'fail') {
					location.reload();
				}
			}
			
		});
	})
	$('#save_package').click(function() {
		var numpackage = $('#numpackage').val();
		var isChecked = [];
		var isntChecked = [];
		var cb = '';
		var t = "<?php echo $time;?>";
		var url = "<?php echo $baseurl ?>";
		var key = "<?php echo $public_key?>";
		var hash = "<?php echo $hash?>";
		var j = 0;
		var k = 0;
		for (var i = 0; i < numpackage; i += 1) {
			cb = $('#cb' + i.toString());
			if (cb.is(':checked')) {
				isChecked[j] = cb.val();
				j++;
			} else {
				isntChecked[k] = cb.val();
				k++;
			}
		}
		url = url + "/admin/settings/advanced/savecoinpackage.php";
		var uri = 'isChecked=' + isChecked + '&isntChecked=' + isntChecked + '&hash=' + hash + '&public=' + key + '&t=' + t;
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
				$('#saved_alert').html('saved');
				setTimeout(function() {
					$('#saved_alert').html('');
				}, 2000);
			}
			
		});
	});
})
</script>
