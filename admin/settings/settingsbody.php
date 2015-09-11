<div class="row">
    <div class="col-xs-4">

		<div class="box">
			<div class="box-header">
				<h3 class="box-title"><?php echo $lang[182] ?></h3>
				<div class="box-tools">
				</div>
			</div>
		
			<div class="box-body">
				
                <!-- text input -->
                <div class="form-group">
                    <label><?php echo $lang[183] ?></label>
                    <input id="siteName" type="text" class="form-control" placeholder="Enter ..." value="<?php echo $config['site name']?>"/>
                </div>
                <!-- textarea -->
                <div class="form-group">
                    <label><?php echo $lang[184] ?></label>
                    <textarea id="siteDesc" class="form-control" rows="3" placeholder="Enter ..."><?php echo $config['site description']?></textarea>
                </div>

                <!-- text input -->
                <div class="form-group">
                    <label><?php echo $lang[185] ?></label>
                    <input id="siteKeywords" type="text" class="form-control" placeholder="Enter ..." value="<?php echo $config['site meta keywords']?>"/>
                </div>

				<button class="btn btn-primary" id="button1"><?php echo $lang[122] ?></button>
                <span id="sbutton1"></span>
			
			</div><!-- /.box-body -->
		</div><!-- /.box -->

    </div>

    <div class="col-xs-4">

		<div class="box">
			<div class="box-header">
				<h3 class="box-title"><?php echo $lang[186] ?></h3>
				<div class="box-tools">
				</div>
			</div>
			<div class="box-body">
				
                <!-- select -->
                <div class="form-group">
                    <select class="form-control" id="selectLang">
                    <?php 
                    foreach ($lang_list as $ll) { 
                        $selected = ($config['default language'] == $ll['lvalue']) ? 'selected="selected"' : '';
                    ?>
                        <option value="<?php echo $ll['lvalue']?>" <?php echo $selected?>><?php echo $ll['lname']?></option>
                    <?php } ?>
                    </select>
                </div>

				<button class="btn btn-primary" id="button2"><?php echo $lang[122] ?></button>
                <span id="sbutton2"></span>
			
			</div><!-- /.box-body -->
		</div><!-- /.box -->

        <?php // time zone ?>
		<div class="box">
			<div class="box-header">
				<h3 class="box-title"><?php echo $lang[187] ?></h3>
				<div class="box-tools">
				</div>
			</div>
			<div class="box-body">
				
                <!-- select -->
                <div class="form-group">
                    <select class="form-control" id="timeZone">
                        <option value="Asia/Tokyo" <?php echo ($config['time zone'] === 'Asia/Tokyo') ? "selected='selected'" : ''?>>Tokyo</option>
                        <option value="Europe/Amsterdam" <?php echo ($config['time zone'] === 'Europe/Amsterdam') ? "selected='selected'" : ''?>>Netherlands</option>
                        <option value="America/Los_Angeles" <?php echo ($config['time zone'] === 'America/Los_Angeles') ? "selected='selected'" : ''?>>PST</option>
                        <option value="America/New_York" <?php echo ($config['time zone'] === 'America/New_York') ? "selected='selected'" : ''?>>EST</option>
                    </select>
                </div>

				<button class="btn btn-primary" id="button3"><?php echo $lang[122] ?></button>
                <span id="sbutton3"></span>
			
			</div><!-- /.box-body -->
		</div><!-- /.box -->

        <?php // currency ?>
		<div class="box">
			<div class="box-header">
				<h3 class="box-title"><?php echo $lang[188] ?></h3>
				<div class="box-tools">
				</div>
			</div>
			<div class="box-body">
				
                <!-- select -->
                <div class="form-group">
                    <select class="form-control" id="currency">
                        <option "JPY" <?php echo ($config['currency'] == 'JPY') ? "selected='selected'" : ''?>>JPY</option>
                        <option "USD" <?php echo ($config['currency'] == 'USD') ? "selected='selected'" : ''?>>USD</option>
                        <option "EUR" <?php echo ($config['currency'] == 'EUR') ? "selected='selected'" : ''?>>EURO</option>
                    </select>
                </div>

				<button class="btn btn-primary" id="button4"><?php echo $lang[122] ?></button>
                <span id="sbutton4"></span>
			
			</div><!-- /.box-body -->
		</div><!-- /.box -->

    </div>

    <div class="col-xs-4">

		<div class="box">
			<div class="box-header">
				<h3 class="box-title"><?php echo $lang[189] ?></h3>
				<div class="box-tools">
				</div>
			</div>
			<div class="box-body">
				
                <!-- House Commission -->
                <div class="form-group">
                <label><?php echo $lang[140] ?></label>
                <div class="input-group">
                    <input id="commission" type="number" class="form-control" value="<?php echo $config['default house commission']?>")>
                    <span class="input-group-addon">%</span>
                </div>
                </div><!-- /.form group -->

				<button class="btn btn-primary" id="button5"><?php echo $lang[122] ?></button>
			    <span id="sbutton5"></span>
			</div><!-- /.box-body -->
		</div><!-- /.box -->


		<div class="box">
			<div class="box-header">
				<h3 class="box-title"><?php echo $lang[190] ?></h3>
				<div class="box-tools">
				</div>
			</div>
			<div class="box-body">
				
                <!-- checkbox -->
                <div class="form-group"> 
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" id="recGameResult" value="1" <?php echo ($config['mail receive game result'] == 1) ? "checked='checked'" : ''?>/>
                            <?php echo $lang[191] ?>
                        </label>                                                
                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" id="recDaiSal" value="1" <?php echo ($config['mail receive daily sales'] == 1) ? "checked" : ''?>/>
                            <?php echo $lang[192] ?>
                        </label>                                                
                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" id="recUserDeposit" value="1" <?php echo ($config['mail receive when user deposited money'] == 1) ? "checked" : ''?>/>
                            <?php echo $lang[193] ?>
                        </label>                                                
                    </div>

                </div>

				<button class="btn btn-primary" id="button6"><?php echo $lang[122] ?></button>
			    <span id="sbutton6"></span>
			</div><!-- /.box-body -->
		</div><!-- /.box -->

    </div>
</div>
<script>
$(document).ready(function() {
    $('#button1, #button2, #button3, #button4, #button5, #button6').click(function() {
        var xspan = 's' + this.id;
        var site_name = $('#siteName').val();
        var site_desc = $('#siteDesc').val();
        var site_keywords = $('#siteKeywords').val();
        var select_lang = $('#selectLang').val();
        var timezone = $('#timeZone').val();
        var currency = $('#currency').val();
        var commission = $('#commission').val();
        var recgameresult = $('#recGameResult');
        var recdaisal = $('#recDaiSal');
        var recuserdeposit = $('#recUserDeposit');
        var url = "<?php echo $baseurl ?>";
        var key = "<?php echo $public_key?>";
        var hash = "<?php echo $hash?>";

        if (recgameresult.is(':checked')) { 
            recgameresult = 1;
        } else {
            recgameresult = 0;
        }
        if (recdaisal.is(':checked')) { 
            recdaisal = 1;
        } else {
            recdaisal = 0;
        }
        if (recuserdeposit.is(':checked')) { 
            recuserdeposit = 1;
        } else {
            recuserdeposit = 0;
        }

        url = url + "/ajax/generalsettings.php";
        var uri = 'hash=' + hash + '&public=' + key;
        uri += '&sn=' + site_name + '&sd=' + site_desc + '&sk=' + site_keywords;
        uri += '&sl=' + select_lang + '&tz=' + timezone + '&cu=' + currency;
        uri += '&co=' + commission + '&rgr=' + recgameresult + '&rds=' + recdaisal + '&rud=' + recuserdeposit;

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
                $('#' + xspan).html('saved');
                setTimeout(function() {
                    $('#' + xspan).html('');
                }, 2000);
            }
            
        });
    });
})
</script>
