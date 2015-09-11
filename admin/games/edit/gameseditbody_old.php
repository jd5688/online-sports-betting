	    <div class="alert alert-warning alert-dismissable">
	        <i class="fa fa-warning"></i>
	        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	        <?php echo $lang[123] ?>
	    </div>
	
	
<div class="row">
    <div class="col-xs-8">


                <form role="form">

        <!-- general form elements disabled -->
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?php echo $lang[82] ?> : 0005 <small><?php echo $lang[83] ?></small></h3>
            </div>
            <div class="box-body">
                    <!-- text input -->
                    <div class="form-group">
                        <label><?php echo $lang[84] ?></label>
                        <input type="text" class="form-control" placeholder="Enter ..." value="Real Madrid vs FC Barcelona Which team will get a first goal??"/>
                    </div>
					
					<br>
					
                    <!-- textarea -->
                    <div class="form-group">
                        <label><?php echo $lang[85] ?></label>
                        <textarea class="form-control" rows="4" placeholder="Enter ...">Monday, Sep 20th Liga BBVA Match 20, Which team will get a first goal?Monday, Sep 20th Liga BBVA Match 20, Which team will get a first goal?Monday, Sep 20th Liga BBVA Match 20, Which team will get a first goal?Monday, Sep 20th Liga BBVA Match 20, Which team will get a first goal?</textarea>
                    </div>
					
					<br>
					
                    <!-- image file -->
                    <div class="form-group">
                        <label for="exampleInputFile"><?php echo $lang[86] ?></label>
                        <input type="file" id="exampleInputFile">
                    </div>

					
					<br>
					
                    <!-- select -->
                    <div class="form-group">
                        <label><?php echo $lang[87] ?></label>
                        <select multiple class="form-control">
                            <option selected="">Soccer</option>
                            <option>Boxing</option>
                            <option>Golf</option>
                            <option>Baseball</option>
                            <option>Sumo</option>
                            <option>Tennis</option>
                            <option>F1</option>
                        </select>
                    </div>

					<div id="category-adder" class="">
						<h4>
							<a id="category-add-toggle" href="#category-add" class="btn btn-default btn-sm">+ <?php echo $lang[88] ?></a>
					
						</h4>
					
					
						<div id="category-add" class="row">
							<div class="col-xs-8">
							    <input type="text" name="newcategory" id="newcategory" class="form-control pull-left" placeholder="Enter ..."/>
							</div>
							<div class="col-xs-4">
							    <input type="button" id="category-add-submit" class="btn btn-success" value="<?php echo $lang[78] ?>">
									<input type="hidden" id="_ajax_nonce-add-category" name="_ajax_nonce-add-category" value="">
							</div>
						</div>
					
					</div>
					
					<br>
					

                    <!-- tag input -->
                    <div class="form-group">
                        <label><?php echo $lang[89] ?></label>
                        <input type="text" class="form-control" placeholder="Enter ..."/>
                    </div>





            </div><!-- /.box-body -->
        </div><!-- /.box -->

        <div class="box box-solid">
            <div class="box-header">
                <h3 class="box-title"><?php echo $lang[90] ?> <small><?php echo $lang[91] ?></small></h3>
            </div>
            <div class="box-body">

					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-bullseye"></i></span>
						<input type="text" class="form-control" placeholder="Input Item" value="Real Madrid">
					</div>
					<br>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-bullseye"></i></span>
						<input type="text" class="form-control" placeholder="Input Item" value="FC Barcelona">
					</div>
					<br>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-bullseye"></i></span>
						<input type="text" class="form-control" placeholder="Input Item" value="Both teams scoreless">
					</div>

<div id="item-adder" class="">
	<h4>
		<a id="item-add-toggle" href="#item-add" class="btn btn-default btn-sm">+ <?php echo $lang[88] ?></a>
	</h4>

					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-bullseye"></i></span>
						<input type="text" class="form-control" placeholder="Input Item">
					</div>

</div>

            </div><!-- /.box-body -->
        </div><!-- /.box -->
	
        <div class="box box-solid">
            <div class="box-header">
                <h3 class="box-title"><?php echo $lang[92] ?> <small><?php echo $lang[93] ?></small></h3>
                <!-- tools box -->
                <div class="pull-right box-tools">
                </div><!-- /. tools -->
            </div><!-- /.box-header -->
            <div class="box-body pad">
                <form>
                    <textarea id="betgames" class="form-control textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><h4>Match Betting</h4><ul><li>Mon, Sep 20th Liga BBVA 2013-14 Match 20</li><li>Real Madrid vs FC Barcelona</li><li>Mon, Sep 20th 19:00 Kick Off (GMT+8)</li></ul></textarea>                      
                </form>
            </div>

        </div><!-- /.box -->
	


        <div class="box box-solid">
            <div class="box-header">
                <h3 class="box-title"><?php echo $lang[94] ?> <small><?php echo $lang[95] ?></small></h3>
                <!-- tools box -->
                <div class="pull-right box-tools">
                </div><!-- /. tools -->
            </div><!-- /.box-header -->
            <div class="box-body pad">
                <form>
                    <textarea id="conditions" class="form-control textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><h4>Game Condition</h4><ul><li>Book closes Mon, Sep 20th 18:00 (GMT+8)</li><li>An unplayed or postponed match will be treated as a non-runner for settling purposes unless it is played within the same week (ending on Sunday) in which case the bet will stand unless cancelled by mutual consent.</li></ul></textarea>                      
                </form>
            </div>

        </div><!-- /.box -->
	
    </div>
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
                        <input type="text" class="form-control pull-right" id="reservationtime" value="05/11/2014 12:00 AM - 05/11/2014 12:00 AM"/>
                    </div><!-- /.input group -->
                </div><!-- /.form group -->

                <!-- Price per Bet -->
                <div class="form-group">
                <label><?php echo $lang[99] ?></label>
                <div class="input-group">
                    <input type="number" class="form-control" value="1">
                    <span class="input-group-addon">COIN</span>
                </div>
                </div><!-- /.form group -->

                <!-- House Commission -->
                <div class="form-group">
                <label><?php echo $lang[100] ?></label>
                <div class="input-group">
                    <input type="number" class="form-control" value="25">
                    <span class="input-group-addon">%</span>
                </div>
                </div><!-- /.form group -->

				<!-- radio -->
				<div class="form-group"> 
	                <label><?php echo $lang[101] ?></label>
					<div class="radio">
						<label><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1"> <?php echo $lang[102] ?></label>
						<small class="text-muted" style="margin-left:.5em;"><?php echo $lang[103] ?></small>
					</div>
					<div class="radio">
						<label><input type="radio" name="optionsRadios" id="optionsRadios2" value="option2"> <?php echo $lang[104] ?></label>
						<small class="text-muted" style="margin-left:.5em;"><?php echo $lang[105] ?></small>
					</div>
		
					<div class="radio">
						<label><input type="radio" name="optionsRadios" id="optionsRadios3" value="option3" checked> <?php echo $lang[106] ?></label>
					</div>
				</div>
				
				<button class="btn btn-primary"><?php echo $lang[107] ?></button>
				<a href="#" class="pull-right"><?php echo $lang[108] ?></a>
			
			</div><!-- /.box-body -->
		</div><!-- /.box -->

		<div class="box">
			<div class="box-header">
                <!-- tools box -->
                <div class="pull-right box-tools">                                        
                    <button class="btn btn-default btn-xs pull-right" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
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
                            <input type="checkbox" checked=""/>
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
                            <input type="checkbox" disabled/>
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
                            <input type="checkbox"/>
                            <?php echo $lang[117] ?>
                        </label>                                                
                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox"/>
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
                    <input type="number" class="form-control" disabled>
                    <span class="input-group-addon">BET</span>
                </div>
                <small class="text-muted"><?php echo $lang[121] ?></small>                                                

                </div><!-- /.form group -->



				<button class="btn btn-primary"><?php echo $lang[122] ?></button>
			
			</div><!-- /.box-body -->
		</div><!-- /.box -->

                </form>

    </div>
</div>
