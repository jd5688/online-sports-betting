<div class="row">
    <div class="col-xs-8">

        <div class="box">
            <div class="box-body table-responsive no-padding">
                <table id="datatable" class="table table-hover">
                    <thead>
                        <tr>
                            <th><?php echo $lang[74] ?></th>
                            <th><?php echo $lang[176] ?> JP</th>
                            <th><?php echo $lang[75] ?></th>
                            <th><?php echo $lang[76] ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if ($cats) {
                        foreach ($cats as $cat) {
                    ?>
                        <tr>
                            <td><a href="<?php echo $baseurl ?>/games/category/edit?lang=<?php echo $LANGUAGE ?>"><?php echo $cat['sc_name']?></a></td>
                            <td><?php echo $cat['sc_name_jp']?></td>
                            <td><?php echo $cat['sc_description']?></td>
                            <td><a href="<?php echo $baseurl ?>/games?lang=<?php echo $language ?>">5</a></td>
                        </tr>
                    <?php
                        } // foreach
                    } else {// if $cats
                    ?>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                    <?php } // else ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th><?php echo $lang[74] ?></th>
                            <th><?php echo $lang[75] ?></th>
                            <th><?php echo $lang[76] ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->


    </div>
    <div class="col-xs-4">

		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php echo $lang[77] ?></h3>
				<div class="box-tools">
				</div>
			</div>
		    <form id="form">
			<div class="box-body">
				
                    <!-- text input -->
                    <div class="form-group">
                        <label><?php echo $lang[74] ?> EN</label>
                        <input type="text" id="catName" class="form-control" placeholder="Enter ..." required/>
                    </div>
					
					<br>

                    <div class="form-group">
                        <label><?php echo $lang[74] ?> JP</label>
                        <input type="text" id="catName_jp" class="form-control" placeholder="Enter ..." required/>
                    </div>

                    <br>
					
                    <!-- textarea -->
                    <div class="form-group">
                        <label><?php echo $lang[75] ?></label>
                        <textarea class="form-control" id="catDesc" rows="4" placeholder="Enter ..."></textarea>
                    </div>
					
					<br>

				
				<button class="btn btn-primary"><?php echo $lang[78] ?></button>	
                 <div align="center" id="message"></div>
			</div><!-- /.box-body -->
            </form>
		</div><!-- /.box -->


    </div>
</div>
<script>
$(document).ready(function() {
    $("#form").bind("submit", addCategory);
    function addCategory(e) {
        e.preventDefault();
        e.target.checkValidity();
        var name = $('#catName').val();
        var name_jp = $('#catName_jp').val();
        var desc = $('#catDesc').val();
        var t = "<?php echo $time;?>";
        var url = "<?php echo $baseurl ?>";
        var key = "<?php echo $public_key?>";
        var hash = "<?php echo $hash?>";
        url = url + "/admin/games/category/addcategory.php";
        var uri = 'hash=' + hash + '&public=' + key + '&t=' + t;
        uri += '&catName=' + name + '&catName_jp=' + name_jp  + '&catDesc=' + desc;

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
                    location.reload(true);
                } else {
                    $('#message').html(data.status);
                    setTimeout(function() {
                        $('#message').html('');
                    }, 2000);
                }
            }
            
        });
    }
})
</script>
