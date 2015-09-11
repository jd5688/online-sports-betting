<div class="col-xs-4">

    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title"><?php echo $lang[129] ?></h3>
            <div class="box-tools">
            </div>
        </div>
        
        <div class="box-body">
            
            <div class="form-group">
                <label><?php echo $lang[130] ?>:</label>
                <select name="win_item" multiple class="form-control" <?php //echo $disable_el?>>
                <?php
                if ($bet_items) {
                    $c = 0;
                    foreach ($bet_items as $bi) {
                        $selected = ($bi['bi_winner']) ? 'selected="selected"' : '';
                        $c++;
                ?>
                    <option value="<?php echo $bi['bi_id']?>" <?php echo $selected?>><?php echo $c?>. <?php echo $bi['bi_description']?></option>
                <?php
                    } // foreach
                } else {// if $bet_items
                ?>
                    <option>none</option>
                <?php } ?>
                </select>
            </div>

           <!-- checkbox -->
            <div class="form-group"> 
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="cancel_game" value="1" <?php echo ($game['g_isCancelled']) ? "checked" : ""?>/>
                        <?php echo $lang[131] ?>
                    </label>                                                
                    <small class="text-muted"><br><?php echo $lang[132] ?></small>
                </div>
            </div>

            <span id="game_result_box" style="display:none">
            <br>
            
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th style="width:50%"><?php echo $lang[133] ?>:</th>
                        <td><span id="xt-coins"></span></td>
                    </tr>
                    <tr>
                        <th><?php echo $lang[140] ?>:</th>
                        <td><span id="xt-commission"></span> (<?php echo $game['g_houseCom']?>%)</td>
                    </tr>
                    <tr>
                        <th><?php echo $lang[134] ?>:</th>
                        <td><span id="xt-subtotal"></span></td>
                    </tr>
                </table>
                <br><br>
                <table class="table">
                    <tr>
                        <th style="width:50%"><?php echo $lang[135] ?>:</th>
                        <td><span id="xt-winners"></span></td>
                    </tr>
                    <tr>
                        <th><?php echo $lang[136] ?>:</th>
                        <td><b><span id="xt-coin-div"></span></b></td>
                    </tr>

                </table>
            </div>
            </span>
            <div id="loading-image" style="display:none"><img src="<?php echo $baseurl?>/images/ajax-loader.gif"/></div>         
        </div><!-- /.box-body -->
        <div class="box-footer">
            <button class="btn btn-success disabled" id="game-result-submit-button" href="#gameresult" data-toggle="modal" data-target="#gameresult"><i class="fa fa-check"></i> <?php echo $lang[137] ?></button>
            <span id="message"></span>
        </div>

    </div><!-- /.box -->

    <div class="box box-solid">

        <div class="box-body">
            
            <dl>
            <dt><?php echo $lang[138] ?></dt>
            <dd>
            <?php
                //100 users bookmarked this game
                echo str_replace('$BOOKMARK_VARIABLE', $game['g_bookmarks'], $lang[246]);
            ?>
            </dd>
            <dt><?php echo $lang[139] ?></dt>
            <dd>            
            <?php
                //75 users liked this game
                echo str_replace('$LIKE_VARIABLE', $game['g_likes'], $lang[247]);
            ?>
            </dd>
            </dl>

        </div><!-- /.box-body -->
    </div><!-- /.box -->

</div>