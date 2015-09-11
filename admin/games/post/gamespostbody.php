<div class="alert alert-danger alert-dismissable" style="display:<?php echo $display?>">
    <i class="fa fa-warning"></i>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <span id="message"><?php echo $alert_message?></span>
</div>
<form action="<?php echo $baseurl;?>/admin/games/post/addgame.php?lang=<?php echo $LANGUAGE?>" method="POST" enctype="multipart/form-data">
<input type="hidden" name="location" value="<?php echo $location?>"/>
<div class="row">
	<!-- JP -->
	<span id="jp-form">
    <div class="col-xs-8">
        <!-- general form elements disabled -->
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?php echo $lang[82] ?> : n/a <small><?php echo $lang[83] ?></small></h3>
            </div>
            <div class="box-body">
                    <!-- text input -->
                    <div class="form-group">
                        <label><?php echo $lang[84] ?> JP</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter ..."/>
                    </div>
					
					<br>
					
                    <!-- textarea -->
                    <div class="form-group">
                        <label><?php echo $lang[85] ?> JP</label>
                        <textarea class="form-control" rows="4" name="description" placeholder="Enter ..."></textarea>
                    </div>
					
					<br>
					
                    <!-- image file -->
                    <div class="form-group">
                        <label for="exampleInputFile"><?php echo $lang[86] ?></label>
                        <input type="file" id="imgFile" name="imgFile">
                    </div>

					
					<br>
					
                    <!-- select -->
                    <div class="form-group">
                        <label><?php echo $lang[87] ?> JP</label>
                        <select id="select-category" name="selectCategory" class="form-control">
                        <?php
                        if ($cats) {
                            foreach ($cats as $cat) {
                        ?>
                            <option value="<?php echo $cat['sc_name_jp']?>"><?php echo $cat['sc_name_jp']?></option>
                        <?php
                            } // foreach 
                        } else {
                        ?>
                            <option>&nbsp;</option>
                        <?php } // else ?>
                        </select>
                    </div>
					

                    <!-- tag input -->
                    <div class="form-group">
                        <label><?php echo $lang[89] ?> JP</label>
                        <input type="text" name="tags" class="form-control" placeholder="Enter ..."/>
                    </div>





            </div><!-- /.box-body -->
        </div><!-- /.box -->

        <div class="box box-solid">
            <div class="box-header">
                <h3 class="box-title"><?php echo $lang[90] ?> <small><?php echo $lang[91] ?></small> JP</h3>
            </div>
            <div class="box-body">
                <span id="bet_items">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-bullseye"></i></span>
					<input id="bet_item0" name="bet_item0" type="text" class="form-control" onkeyup="popkey(this)" placeholder="Input Item">
				</div>
				<br>
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-bullseye"></i></span>
					<input id="bet_item1" name="bet_item1" type="text" class="form-control" onkeyup="popkey(this)" placeholder="Input Item">
				</div>
				<br>
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-bullseye"></i></span>
					<input id="bet_item2" name="bet_item2" type="text" class="form-control" onkeyup="popkey(this)" placeholder="Input Item">
				</div>
                </span>
                <div id="item-adder" class="">
                	<h4>
                		<a id="item-add-toggle" href="#item-add" class="btn btn-default btn-sm">+ <?php echo $lang[88] ?></a>
                	</h4>

					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-bullseye"></i></span>
						<input id="new_bet_item" type="text" class="form-control" placeholder="Input Item">
					</div>

                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
	
        <div class="box box-solid">
            <div class="box-header">
                <h3 class="box-title"><?php echo $lang[92] ?> JP <small><?php echo $lang[93] ?></small></h3>
                <!-- tools box -->
                <div class="pull-right box-tools">
                </div><!-- /. tools -->
            </div><!-- /.box-header -->
            <div class="box-body pad">
                    <textarea id="betinfo" name="betInfo" class="form-control textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>                      
            </div>

        </div><!-- /.box -->
	


        <div class="box box-solid">
            <div class="box-header">
                <h3 class="box-title"><?php echo $lang[94] ?> JP <small><?php echo $lang[95] ?></small></h3>
                <!-- tools box -->
                <div class="pull-right box-tools">
                </div><!-- /. tools -->
            </div><!-- /.box-header -->
            <div class="box-body pad">
                    <textarea id="conditions" name="betCondition" class="form-control textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>                      
            </div>

        </div><!-- /.box -->
	
    </div>
	</span>
    <!-- /.JP -->
    
    
    <!-- EN -->
	<span id="en-form" style="display:none">
    <div class="col-xs-8">
        <!-- general form elements disabled -->
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?php echo $lang[82] ?> : n/a <small><?php echo $lang[83] ?></small></h3>
            </div>
            <div class="box-body">
                    <!-- text input -->
                    <div class="form-group">
                        <label><?php echo $lang[84] ?> EN</label>
                        <input type="text" class="form-control" name="title_en" placeholder="Enter ..."/>
                    </div>
					
					<br>
					
                    <!-- textarea -->
                    <div class="form-group">
                        <label><?php echo $lang[85] ?> EN</label>
                        <textarea class="form-control" rows="4" name="description_en" placeholder="Enter ..."></textarea>
                    </div>
					
                    <!-- select -->
                    <div class="form-group">
                        <label><?php echo $lang[87] ?> EN</label>
                        <select id="select-category_en" name="selectCategory_en" class="form-control">
                        <?php
                        if ($cats) {
                            foreach ($cats as $cat) {
                        ?>
                            <option value="<?php echo $cat['sc_name']?>"><?php echo $cat['sc_name']?></option>
                        <?php
                            } // foreach 
                        } else {
                        ?>
                            <option>&nbsp;</option>
                        <?php } // else ?>
                        </select>
                    </div>

                    <!-- tag input -->
                    <div class="form-group">
                        <label><?php echo $lang[89] ?> EN</label>
                        <input type="text" name="tags_en" class="form-control" placeholder="Enter ..."/>
                    </div>





            </div><!-- /.box-body -->
        </div><!-- /.box -->

        <div class="box box-solid">
            <div class="box-header">
                <h3 class="box-title"><?php echo $lang[90] ?> EN <small><?php echo $lang[91] ?></small></h3>
            </div>
            <div class="box-body">
                <span id="bet_items2">
                <small id="en_bet_item0"></small>
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-bullseye"></i></span>
					<input id="bet_item_en0" name="bet_item_en0" type="text" class="form-control" placeholder="Input Item">
				</div>
				<br>
                <small id="en_bet_item1"></small>
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-bullseye"></i></span>
					<input id="bet_item_en1" name="bet_item_en1" type="text" class="form-control" placeholder="Input Item">
				</div>
				<br>
                <small id="en_bet_item2"></small>
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-bullseye"></i></span>
					<input id="bet_item_en2" name="bet_item_en2" type="text" class="form-control" placeholder="Input Item">
				</div>
                </span>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
	
        <div class="box box-solid">
            <div class="box-header">
                <h3 class="box-title"><?php echo $lang[92] ?> EN <small><?php echo $lang[93] ?></small></h3>
                <!-- tools box -->
                <div class="pull-right box-tools">
                </div><!-- /. tools -->
            </div><!-- /.box-header -->
            <div class="box-body pad">
                    <textarea id="betinfo" name="betInfo_en" class="form-control textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>                      
            </div>

        </div><!-- /.box -->
	


        <div class="box box-solid">
            <div class="box-header">
                <h3 class="box-title"><?php echo $lang[94] ?> EN <small><?php echo $lang[95] ?></small></h3>
                <!-- tools box -->
                <div class="pull-right box-tools">
                </div><!-- /. tools -->
            </div><!-- /.box-header -->
            <div class="box-body pad">
                    <textarea id="conditions" name="betCondition_en" class="form-control textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>                      
            </div>

        </div><!-- /.box -->
	
    </div>
	</span>
    <!-- /.EN -->
    
    <div class="col-xs-4">

		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php echo $lang[96] ?></h3>
				<div class="box-tools">
					<button type="button" class="btn btn-sm btn-default pull-right"><?php echo $lang[97] ?></button>
				</div>
			</div>
		
			<div class="box-body">
				
                <!-- Date and time range -->
                <div class="form-group">
                    <label><?php echo $lang[98] ?></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="reservationtime" name="reservationTime"/>
                    </div><!-- /.input group -->
                </div><!-- /.form group -->

                <!-- Price per Bet -->
                <div class="form-group">
                <label><?php echo $lang[99] ?></label>
                <div class="input-group">
                    <input type="number" name="coinPerBet" class="form-control" value="1">
                    <span class="input-group-addon">COIN</span>
                </div>
                </div><!-- /.form group -->

                <!-- House Commission -->
                <div class="form-group">
                <label><?php echo $lang[100] ?></label>
                <div class="input-group">
                    <input type="number" name="houseComm" class="form-control" value="15">
                    <span class="input-group-addon">%</span>
                </div>
                </div><!-- /.form group -->

				<!-- radio -->
				<div class="form-group"> 
	                <label><?php echo $lang[101] ?></label>
					<div class="radio">
						<label><input type="radio" name="publishType" id="optionsRadios1" value="draft" checked> <?php echo $lang[102] ?></label>
						<small class="text-muted" style="margin-left:.5em;"><?php echo $lang[103] ?></small>
					</div>
					<div class="radio">
						<label><input type="radio" name="publishType" id="optionsRadios2" value="private"> <?php echo $lang[104] ?></label>
						<small class="text-muted" style="margin-left:.5em;"><?php echo $lang[105] ?></small>
					</div>
		
					<div class="radio">
						<label><input type="radio" name="publishType" id="optionsRadios3" value="public"> <?php echo $lang[106] ?></label>
					</div>
				</div>
				
				<input type="submit" class="btn btn-primary" id="submit" value="<?php echo $lang[107] ?>">
				<?php /*<a href="#" class="pull-right"><?php echo $lang[108] ?></a> */ ?>
			
			</div><!-- /.box-body -->
		</div><!-- /.box -->


		<div class="box">
			<div class="box-header">
                <!-- tools box -->
                <div class="pull-right box-tools">                                        
                    <button class="btn btn-default btn-xs pull-right" data-widget='collapse' data-toggle="tooltip" title="Collapse" id="anotherButton2"><i class="fa fa-minus"></i></button>
                </div><!-- /. tools -->

				<h3 class="box-title"><?php echo $lang[109] ?></h3>
				<div class="box-tools">
				</div>
			</div>
			<div class="box-body">
				
               <!-- checkbox -->
                <div class="form-group"> 
                <label><?php echo $lang[110] ?></label>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="isRecommend" value="1"/>
                            <?php echo $lang[111] ?>
                        </label>                                                
						<small class="text-muted"><br><?php echo $lang[112] ?></small>
                    </div>
                </div>

               <!-- checkbox -->
                <div class="form-group"> 
                <label><?php echo $lang[113] ?></label>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="isTrial" value="1"/>
                            <?php echo $lang[114] ?>
                        </label>
                        <small class="text-muted"><br><?php echo $lang[115] ?></small>                                                
                    </div>
                    
                </div>

               <!-- checkbox -->
                <div class="form-group"> 
                <label><?php echo $lang[116] ?></label>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="japPage" value="1" checked="" />
                            <?php echo $lang[117] ?>
                        </label>                                                
                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="engPage" value="1" checked="" />
                            <?php echo $lang[118] ?>
                        </label>                                                
                    </div>
                    <small class="text-muted"><?php echo $lang[119] ?></small>                                                

                </div>

                 <!-- Price per Bet -->
                <div class="form-group">
                <label><?php echo $lang[120] ?></label>
                <div class="input-group" style="margin-bottom:10px;">
                    <span class="input-group-addon"><i class="fa fa-legal"></i></span>
                    <input type="number" name="betMinimum" class="form-control">
                    <span class="input-group-addon">BET</span>
                </div>
                <small class="text-muted"><?php echo $lang[121] ?></small>                                                

                </div><!-- /.form group -->



				<button id="anotherButton" class="btn btn-primary"><?php echo $lang[122] ?></button>
			
			</div><!-- /.box-body -->
		</div><!-- /.box -->
    </div>
</div>
</form>
<script>
$(document).ready(function() {
	/*
    setInterval(function(){
        var o1 = $('div.iradio_minimal input[id="optionsRadios1"]');
        var o2 = $('div.iradio_minimal input[id="optionsRadios2"]');
        var o3 = $('div.iradio_minimal input[id="optionsRadios3"]');
        if (o1.is(':checked')) {
            if ($('input[name=isTrial]').attr('disabled')) {
                $('input[name=isTrial]').attr('disabled', false);
            }
        }

        if (o2.is(':checked') || o3.is(':checked')) {
            if ($('input[name=isTrial]').attr('disabled') === undefined) {
                $('input[name="isTrial"]').parent().removeClass("checked");
                $('input[name=isTrial]').attr('disabled', true);
            }
        }
    }, 1000)
    */
    /*
    $('#anotherButton').click(function () {
        $('#submit').click();
    }); */
    
    $('button[name=choose-lang]').click(function(e) {
	    var clicked_id = $(e.currentTarget).attr('id');
	    $('button#jp-form').removeClass('btn-info').addClass('btn-default');
	    $('button#en-form').removeClass('btn-info').addClass('btn-default');
	    $('button#' + clicked_id).addClass('btn-info');
	    
	    $('span#jp-form').hide();
	    $('span#en-form').hide();
	    $('span#' + clicked_id).show();
    })
    
    $('#item-add-toggle').click(function (e) {
        e.preventDefault();
        var new_bet_item = $('#new_bet_item').val();
        if (new_bet_item) {
            for (var i = 0; i < 20; i += 1) {
                if ($('#bet_item' + i).val() === '') { 
                    $('#bet_item' + i).val(new_bet_item);
                    $('#en_bet_item' + i).html(new_bet_item);
                    $('#new_bet_item').val('');
                    return; 
                }
                if ($('#bet_item' + i).val() === undefined) {
                    $('#new_bet_item').val('');
                    var el = '<br><div class="input-group"><span class="input-group-addon"><i class="fa fa-bullseye"></i></span><input name="bet_item' + i + '" id="bet_item' + i + '" type="text" class="form-control" placeholder="Input Item" value="' + new_bet_item + '"></div>';
                    var el2 = '<br><small id="en_bet_item' + i + '">'+ new_bet_item +'</small>';
                    el2 += '<div class="input-group"><span class="input-group-addon"><i class="fa fa-bullseye"></i></span><input name="bet_item_en' + i + '" id="bet_item_en' + i + '" type="text" class="form-control" placeholder="Input Item"></div>';
                    $('#bet_items').append(el);
                    $('#bet_items2').append(el2);
                    return;
                }
            }
        }
    });

    popkey = function(e) {
        var id = e.id;
        var val = $('input#' + id).val();
        $('#en_' + id).html(val);
        return;
    }
    $('#anotherButton2').click(function(e) {
        e.preventDefault();
    })
    
    $("form").bind("submit", checkDuplicate);
    function checkDuplicate(e) {
        if (typeof isdefault !== 'undefined') {
            return;
        } else {
            e.preventDefault();
        }
        e.target.checkValidity();
        var title = $('input[name="title"]').val();
        var reservationtime = $('#reservationtime').val();
        var t = "<?php echo $time;?>";
        var url = "<?php echo $baseurl ?>";
        var key = "<?php echo $public_key?>";
        var hash = "<?php echo $hash?>";
        url = url + "/admin/games/post/checkduplicate.php";
        var uri = 'hash=' + hash + '&public=' + key + '&t=' + t;
        uri += '&title=' + title + '&reservationTime=' + reservationtime;

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
                    isdefault = true;
                     $('#submit').click();
                    //location.reload(true);
                } else {
                    $('div.alert').show();
                    $('#message').html(data.status);
                }
            }
            
        });
    }
})
</script>
