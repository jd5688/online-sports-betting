<div class="alert <?php echo $alert_type;?> alert-dismissable" style="display:<?php echo $display?>">
    <i class="fa fa-warning"></i>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <span id="message"><?php echo $alert_message?></span>
</div>
<form action="<?php echo $baseurl;?>/admin/games/edit/editgame.php?lang=<?php echo $LANGUAGE?>" method="POST" enctype="multipart/form-data">
<input type="hidden" name="location" value="<?php echo $location?>"/>
<input type="hidden" name="game_id" value="<?php echo $game_id?>"/>
<input type="hidden" name="image" value="<?php echo $game['g_image']?>"/>
<div class="row">
    <!-- JP -->
    <span id="jp-form">
    <div class="col-xs-8">
        <!-- general form elements disabled -->
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?php echo $lang[82] ?> : <?php echo $game_id?> <small><?php echo $lang[83] ?></small></h3>
            </div>
            <div class="box-body">
                    <!-- text input -->
                    <div class="form-group">
                        <label><?php echo $lang[84] ?> JP</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter ..." value="<?php echo $game['g_title_jp']?>"/>
                    </div>
					
					<br>
					
                    <!-- textarea -->
                    <div class="form-group">
                        <label><?php echo $lang[85] ?> JP</label>
                        <textarea class="form-control" rows="4" name="description" placeholder="Enter ..."><?php echo $game['g_description_jp']?></textarea>
                    </div>
					
					<br>
					
                    <!-- image file -->
                    <div class="form-group">
                        <label for="exampleInputFile"><?php echo $lang[86] ?></label>
                        <input type="file" id="imgFile" name="imgFile">
                    </div>
                    <?php if ($game['g_image']) { ?>
						<img src="<?php echo $baseurl . '/game_pics/' . $game['g_image'];?>" />
                        <input type="hidden" name="curimage" value="<?php echo $game['g_image']?>"/>
					<?php } ?>
					<br><br>
					
                    <!-- select -->
                    <div class="form-group">
                        <label><?php echo $lang[87] ?> JP</label>
                        <select id="select-category" name="selectCategory" class="form-control">
                        <?php
                        if ($cats) {
                            foreach ($cats as $cat) {
                                $selected = '';
                                if ($cat['sc_name_jp'] == $game['g_categories_jp']) {
                                    $selected = 'selected="selected"';
                                }
                        ?>
                            <option value="<?php echo $cat['sc_name_jp']?>" <?php echo $selected; ?>><?php echo $cat['sc_name_jp']?></option>
                        <?php
                            } // foreach 
                        } else {
                        ?>
                            <option>&nbsp;</option>
                        <?php } // else ?>
                        </select>
                    </div>					
					<br>
					

                    <!-- tag input -->
                    <div class="form-group">
                        <label><?php echo $lang[89] ?> JP</label>
                        <input type="text" name="tags" class="form-control" placeholder="Enter ..." value="<?php echo $game['g_tags_jp']?>"/>
                    </div>





            </div><!-- /.box-body -->
        </div><!-- /.box -->

        <div class="box box-solid">
            <div class="box-header">
                <h3 class="box-title"><?php echo $lang[90] ?> JP <small><?php echo $lang[91] ?></small></h3>
            </div>
            <?php if ($total_placed_coins) { ?>
                <div class="alert alert-danger" role="alert">Cannot edit bet items. COINs already placed on this game</div>
            <?php } ?>
            <div class="box-body">
                <span id="bet_items">
                <?php
                if ($bet_items) {
                    $i = 0;
                    $dis = ($total_placed_coins) ? 'disabled' : '';
                    foreach ($bet_items as $bi) {
                        $required = '';
                        //if ($i < 2) { $required = "required"; }
                        $bet_item_id = 'bet_item' . $i;
                ?>
                <small id="jp_bet_item_en<?php echo $i?>"><?php echo $bi['bi_description']?></small>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-bullseye"></i></span>
                    <input <?php echo $dis?> onkeyup="popkey(this)" id="<?php echo $bet_item_id?>" name="<?php echo $bet_item_id?>" type="text" class="form-control" value="<?php echo $bi['bi_description_jp']?>" placeholder="Input Item" <?php echo $required?>>
                </div>
                <br>

                <?php
                        $i++;
                    } // foreach
                } else { // if
                ?>
                <small id="jp_bet_item_en0"></small>
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-bullseye"></i></span>
					<input onkeyup="popkey(this)" id="bet_item0" name="bet_item0" type="text" class="form-control" placeholder="Input Item">
				</div>
				<br>
                <small id="jp_bet_item_en1"></small>
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-bullseye"></i></span>
					<input onkeyup="popkey(this)" id="bet_item1" name="bet_item1" type="text" class="form-control" placeholder="Input Item">
				</div>
				<br>
                <small id="jp_bet_item_en2"></small>
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-bullseye"></i></span>
					<input onkeyup="popkey(this)" id="bet_item2" name="bet_item2" type="text" class="form-control" placeholder="Input Item">
				</div>
                <?php } ?>
                </span><!-- /.bet_items -->

                <?php if (!$total_placed_coins) { ?>
                <div id="item-adder" class="">
                	<h4>
                		<a id="item-add-toggle" href="#item-add" class="btn btn-default btn-sm">+ <?php echo $lang[88] ?></a>
                	</h4>

					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-bullseye"></i></span>
						<input id="new_bet_item" type="text" class="form-control" placeholder="Input Item">
					</div>

                </div>
                <?php } ?>
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
                    <textarea id="betinfo" name="betInfo" class="form-control textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                        <?php echo $game['g_betInfo_jp']; ?>
                    </textarea>                      
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
                    <textarea id="conditions" name="betCondition" class="form-control textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                        <?php echo $game['g_addInfo_jp']; ?>
                    </textarea>                      
            </div>

        </div><!-- /.box -->
	
    </div>
    </span>
    <!-- / JP -->

    <!-- EN -->
    <span id="en-form" style="display:none">
    <div class="col-xs-8">
        <!-- general form elements disabled -->
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?php echo $lang[82] ?> : <?php echo $game_id?> <small><?php echo $lang[83] ?></small></h3>
            </div>
            <div class="box-body">
                    <!-- text input -->
                    <div class="form-group">
                        <label><?php echo $lang[84] ?> EN</label>
                        <input type="text" class="form-control" name="title_en" placeholder="Enter ..." value="<?php echo $game['g_title']?>"/>
                    </div>
                    
                    <br>
                    
                    <!-- textarea -->
                    <div class="form-group">
                        <label><?php echo $lang[85] ?> EN</label>
                        <textarea class="form-control" rows="4" name="description_en" placeholder="Enter ..."><?php echo $game['g_description']?></textarea>
                    </div>
                    
                    <br>
                                        
                    <!-- select -->
                    <div class="form-group">
                        <label><?php echo $lang[87] ?> EN</label>
                        <select id="select-category" name="selectCategory_en" class="form-control">
                        <?php
                        if ($cats) {
                            foreach ($cats as $cat) {
                                $selected = '';
                                if ($cat['sc_name'] == $game['g_categories']) {
                                    $selected = 'selected="selected"';
                                }
                        ?>
                            <option value="<?php echo $cat['sc_name']?>" <?php echo $selected; ?>><?php echo $cat['sc_name']?></option>
                        <?php
                            } // foreach 
                        } else {
                        ?>
                            <option>&nbsp;</option>
                        <?php } // else ?>
                        </select>
                    </div>                    
                    <br>
                    

                    <!-- tag input -->
                    <div class="form-group">
                        <label><?php echo $lang[89] ?> EN</label>
                        <input type="text" name="tags_en" class="form-control" placeholder="Enter ..." value="<?php echo $game['g_tags']?>"/>
                    </div>





            </div><!-- /.box-body -->
        </div><!-- /.box -->

        <div class="box box-solid">
            <div class="box-header">
                <h3 class="box-title"><?php echo $lang[90] ?> <small><?php echo $lang[91] ?></small> EN</h3>
            </div>
            <?php if ($total_placed_coins) { ?>
                <div class="alert alert-danger" role="alert">Cannot edit bet items. COINs already placed on this game</div>
            <?php } ?>
            <div class="box-body">
                <span id="bet_items2">
                <?php
                if ($bet_items) {
                    $i = 0;
                    $dis = ($total_placed_coins) ? 'disabled' : '';
                    foreach ($bet_items as $bi) {
                        $required = '';
                        //if ($i < 2) { $required = "required"; }
                        $bet_item_id = 'bet_item_en' . $i;
                ?>
                <small id="en_bet_item<?php echo $i?>"><?php echo $bi['bi_description_jp']?></small>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-bullseye"></i></span>
                    <input <?php echo $dis?> onkeyup="popKeyJp(this)" id="<?php echo $bet_item_id?>" name="<?php echo $bet_item_id?>" type="text" class="form-control" value="<?php echo $bi['bi_description']?>" placeholder="Input Item" <?php echo $required?>>
                </div>
                <br>

                <?php
                        $i++;
                    } // foreach
                } else { // if
                ?>
                <small id="en_bet_item0"></small>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-bullseye"></i></span>
                    <input onkeyup="popKeyJp(this)" id="bet_item_en0" name="bet_item_en0" type="text" class="form-control" placeholder="Input Item">
                </div>
                <br>
                <small id="en_bet_item1"></small>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-bullseye"></i></span>
                    <input onkeyup="popKeyJp(this)" id="bet_item_en1" name="bet_item_en1" type="text" class="form-control" placeholder="Input Item">
                </div>
                <br>
                <small id="en_bet_item2"></small>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-bullseye"></i></span>
                    <input onkeyup="popKeyJp(this)" id="bet_item_en2" name="bet_item_en2" type="text" class="form-control" placeholder="Input Item">
                </div>
                <?php } ?>
                </span><!-- /.bet_items -->
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    
        <?php if (!$total_placed_coins) { ?>
        <div class="box box-solid">
            <div class="box-header">
                <h3 class="box-title"><?php echo $lang[92] ?> EN <small><?php echo $lang[93] ?></small></h3>
                <!-- tools box -->
                <div class="pull-right box-tools">
                </div><!-- /. tools -->
            </div><!-- /.box-header -->
            <div class="box-body pad">
                    <textarea id="betinfo" name="betInfo_en" class="form-control textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                        <?php echo $game['g_betInfo']; ?>
                    </textarea>                      
            </div>

        </div><!-- /.box -->
        <?php } ?>

        <div class="box box-solid">
            <div class="box-header">
                <h3 class="box-title"><?php echo $lang[94] ?> EN <small><?php echo $lang[95] ?></small></h3>
                <!-- tools box -->
                <div class="pull-right box-tools">
                </div><!-- /. tools -->
            </div><!-- /.box-header -->
            <div class="box-body pad">
                    <textarea id="conditions" name="betCondition_en" class="form-control textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                        <?php echo $game['g_addInfo']; ?>
                    </textarea>                      
            </div>

        </div><!-- /.box -->
    
    </div>
    </span>
    <!-- / EN -->

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
                        <input type="text" class="form-control pull-right" id="reservationtime" name="reservationTime" value="<?php echo $reserve_time?>"/>
                    </div><!-- /.input group -->
                </div><!-- /.form group -->

                <!-- Price per Bet -->
                <div class="form-group">
                <label><?php echo $lang[99] ?></label>
                <div class="input-group">
                    <input type="number" name="coinPerBet" value="<?php echo $game['g_coinPerBet']?>" class="form-control" value="1">
                    <span class="input-group-addon">COIN</span>
                </div>
                </div><!-- /.form group -->

                <!-- House Commission -->
                <div class="form-group">
                <label><?php echo $lang[100] ?></label>
                <div class="input-group">
                    <input type="number" name="houseComm" value="<?php echo $game['g_houseCom']?>" class="form-control" value="15">
                    <span class="input-group-addon">%</span>
                </div>
                </div><!-- /.form group -->

				<!-- radio -->
				<div class="form-group"> 
	                <label><?php echo $lang[101] ?></label>
					<div class="radio">
						<label><input type="radio" name="publishType" id="optionsRadios1" value="draft" <?php echo ($game['g_publishType'] == 'draft') ? "checked" : ""?>> <?php echo $lang[102] ?></label>
						<small class="text-muted" style="margin-left:.5em;"><?php echo $lang[103] ?></small>
					</div>
					<div class="radio">
						<label><input type="radio" name="publishType" id="optionsRadios2" value="private" <?php echo ($game['g_publishType'] == 'private') ? "checked" : ""?>> <?php echo $lang[104] ?></label>
						<small class="text-muted" style="margin-left:.5em;"><?php echo $lang[105] ?></small>
					</div>
		
					<div class="radio">
						<label><input type="radio" name="publishType" id="optionsRadios3" value="public" <?php echo ($game['g_publishType'] == 'public') ? "checked" : ""?>> <?php echo $lang[106] ?></label>
					</div>
				</div>
				
				<input type="submit" class="btn btn-primary" id="submit" value="<?php echo $lang[107] ?>">
				<a href="#" class="pull-right" id="deleteGame"><?php echo $lang[108] ?></a>
			
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
                            <input type="checkbox" name="isRecommend" value="1" <?php echo ($game['g_isRecommend']) ? "checked" : "" ?>/>
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
                            <input type="checkbox" name="isTrial" value="1" <?php echo ($game['g_isTrial']) ? "checked" : "" ?>/>
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
                            <input type="checkbox" name="japPage" value="1" <?php echo ($game['g_japPage']) ? "checked" : "" ?>/>
                            <?php echo $lang[117] ?>
                        </label>                                                
                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="engPage" value="1" <?php echo ($game['g_engPage']) ? "checked" : "" ?>/>
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
                    <input type="number" name="betMinimum" class="form-control" <?php echo ($game['g_betMinimum']) ? "checked" : "" ?> value="<?php echo ($game['g_betMinimum']) ? $game['g_betMinimum'] : 0; ?>">
                    <span class="input-group-addon">BET</span>
                </div>
                <small class="text-muted"><?php echo $lang[121] ?></small>                                                

                </div><!-- /.form group -->



				<button id="anotherButton" class="btn btn-primary"><?php echo $lang[122] ?></button>
				<button id="duplicate-game" class="btn btn-primary"><?php echo $lang[472]; //Duplicate?></button>
			
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
    popkey = function(e) {
        var id = e.id;
        var val = $('input#' + id).val();
        $('#en_' + id).html(val);
        return;
    }

    popKeyJp = function(e) {
        var id = e.id;
        var val = $('input#' + id).val();
        console.log(id + ' ' + val);
        $('#jp_' + id).html(val);
        return;
    }

    $('button[name=choose-lang]').click(function(e) {
        var clicked_id = $(e.currentTarget).attr('id');
        $('button#jp-form').removeClass('btn-info').addClass('btn-default');
        $('button#en-form').removeClass('btn-info').addClass('btn-default');
        $('button#' + clicked_id).addClass('btn-info');
        
        $('span#jp-form').hide();
        $('span#en-form').hide();
        $('span#' + clicked_id).show();
    })

    $('#duplicate-game').click(function(e) {
    	e.preventDefault();
	    window.location.replace("<?php echo $baseurl . '/admin/games/edit/duplicategame.php?g_id=' . $game_id . '&lang=' . $LANGUAGE;?>");
    })
    /*
    $('#anotherButton').click(function () {
        $('#submit').click();
    }); */
    /*
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
                    $('#bet_items').append(el);
                    return;
                }
            }
        }
    });
    */
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

    $('#anotherButton2').click(function(e) {
        e.preventDefault();
    })

    $('#deleteGame').click(function(e) {
        e.preventDefault();
        var bool = confirm("Delete this game?");
        if (!bool) { return; }
        var game_id = $('input[name="game_id"]').val();

        var t = "<?php echo $time;?>";
        var url = "<?php echo $baseurl ?>";
        var key = "<?php echo $public_key?>";
        var hash = "<?php echo $hash?>";
        url = url + "/admin/games/edit/deletegame.php";
        var uri = 'hash=' + hash + '&public=' + key + '&t=' + t;
        uri += '&game_id=' + game_id;

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
                   window.location.replace("<?php echo $baseurl . '/admin/games?lang=' . $LANGUAGE;?>");
                } else {
                    $('#message').html(data.status);
                    setTimeout(function() {
                        $('#message').html('');
                    }, 2000);
                }
            }
            
        });
    });
})
</script>
