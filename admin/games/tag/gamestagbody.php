<div class="row">
    <div class="col-xs-8">

        <div class="box">
            <div class="box-body table-responsive no-padding">
                <table id="datatable" class="table table-hover">
                    <thead>
                        <tr>
                            <th><?php echo $lang[79] ?></th>
                            <th><?php echo $lang[489] ?></th>
                            <th><?php echo $lang[75] ?></th>
                            <th><?php echo $lang[76] ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if ($tags) {
                        foreach ($tags as $tag) {
                    ?>
                        <tr>
                            <td><a href="<?php echo $baseurl ?>/games/category/edit?lang=<?php echo $LANGUAGE ?>"><?php echo $tag['st_name']?></a></td>
                            <td><?php echo $tag['st_lang']?></td>
                            <td><?php echo $tag['st_description']?></td>
                            <td><a href="<?php echo $baseurl ?>/games?lang=<?php echo $language ?>">5</a></td>
                        </tr>
                    <?php
                        } // foreach
                    } else {// if $tags
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
                            <th><?php echo $lang[79] ?></th>
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
				<h3 class="box-title"><?php echo $lang[80] ?></h3>
				<div class="box-tools">
				</div>
			</div>
		
			<div class="box-body">
		      <form id="form">
                    <!-- text input -->
                    <div class="form-group">
                        <label><?php echo $lang[489] ?>: </label>
                        <input type="radio" name="lang" value="jp" checked="">JP
                        &nbsp;<input type="radio" name="lang" value="en">EN
                    </div>

                    <div class="form-group">
                        <label><?php echo $lang[79] ?></label>
                        <input id="tagName" type="text" class="form-control" placeholder="Enter ..." required/>
                    </div>
					
					<br>
					
                    <!-- textarea -->
                    <div class="form-group">
                        <label><?php echo $lang[75] ?></label>
                        <textarea id="tagDesc" class="form-control" rows="4" placeholder="Enter ..." required></textarea>
                    </div>
					
					<br>

				
				<button class="btn btn-primary"><?php echo $lang[81] ?></button>
                <div align="center" id="message"></div>
			 </form>
			</div><!-- /.box-body -->
		</div><!-- /.box -->


    </div>
</div>
<script>
$(document).ready(function() {
    $("#form").bind("submit", addTags);
    function addTags(e) {
        e.preventDefault();
        e.target.checkValidity();
        var name = $('#tagName').val();
        var lang = $('input[name=lang]:checked').val();
        var desc = $('#tagDesc').val();
        var t = "<?php echo $time;?>";
        var url = "<?php echo $baseurl ?>";
        var key = "<?php echo $public_key?>";
        var hash = "<?php echo $hash?>";
        url = url + "/admin/games/tag/addtag.php";
        var uri = 'hash=' + hash + '&public=' + key + '&t=' + t;
        uri += '&tagName=' + name +  '&lang=' + lang + '&tagDesc=' + desc;

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
