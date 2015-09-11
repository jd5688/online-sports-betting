<div class="row" style="margin-bottom: 15px;">
    <div class="col-xs-6">

		<div class="btn-group">
			<button type="button" class="btn btn-sm btn-default active"><?php echo $lang[52] ?> (4)</button>
			<button type="button" class="btn btn-sm btn-default"><?php echo $lang[171] ?> (2)</button>
			<button type="button" class="btn btn-sm btn-default"><?php echo $lang[173] ?> (1)</button>
			<button type="button" class="btn btn-sm btn-default"><?php echo $lang[174] ?> (1)</button>
		</div>

    </div>
    <div class="col-xs-6">
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
	    <div class="box">
	        <div class="box-header">
				<h3 class="box-title"><?php echo $lang[17] ?><a href="#adminregist" class="btn btn-default btn-flat" data-toggle="modal" data-target="#adminregist"><?php echo $lang[29] ?></a></h3>
				<div class="box-tools"></div>
	        </div><!-- /.box-header -->
	        <div class="box-body table-responsive no-padding">
	            <table id="datatable" class="table table-hover">
	                <thead>
	                    <tr>
	                        <th><?php echo $lang[63] ?></th>
	                        <th><?php echo $lang[175] ?></th>
	                        <th><?php echo $lang[176] ?></th>
	                        <th><?php echo $lang[179] ?></th>
	                        <th><?php echo $lang[180] ?></th>
	                        <th><?php echo $lang[181] ?></th>
	                    </tr>
	                </thead>
	                <tbody>
	                <?php 
	                if ($admins) {
	                	foreach ($admins as $admin) {
	                ?>
	                    <tr>
	                        <td><?php echo $admin['user_id']?></td>
	                        <td><a href="<?php echo $baseurl ?>/admin/users/userdetails?user_id=<?php echo $admin['user_id']?>&lang=<?php echo $LANGUAGE ?>"><?php echo $admin['user_name']?></a></td>
	                        <td><?php echo $admin['user_fullname']?></td>
	                        <td><a href="mailto:" title="E-mail: <?php echo $admin['user_email']?>"><?php echo $admin['user_email']?></a></td>
	                        <td><?php echo date('m-d-Y', $admin['user_lastlogin'])?></td>
	                        <td><?php echo date('m-d-Y', strtotime($admin['user_registered']))?></td>
	                    </tr>
	                <?php 
	                	} // foreach
	                } else { // if 
	                ?>
	                    <tr>
	                        <td>&nbsp;</td>
	                        <td>&nbsp;</td>
	                        <td>&nbsp;</td>
	                        <td>&nbsp;</td>
	                        <td>&nbsp;</td>
	                        <td>&nbsp;</td>
	                    </tr>
	                <?php } // else ?>
	                </tbody>
	                <tfoot>
	                    <tr>
	                        <th><?php echo $lang[63] ?></th>
	                        <th><?php echo $lang[175] ?></th>
	                        <th><?php echo $lang[176] ?></th>
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





<!-- Modal -->
<div class="modal fade" id="adminregist" tabindex="-1" role="dialog" aria-labelledby="adminregist" aria-hidden="true">

  <div class="modal-dialog">
    <div class="modal-content">

		<div class="form-box" id="login-box">
			<div class="header">Register New Administrator</div>
			<form id="form">
		    <div class="body bg-gray">
		        <div class="form-group">
		            <input type="text" id="name" class="form-control" placeholder="Full name" required>
		        </div>
		        <div class="form-group">
		            <input type="email" id="email" class="form-control" placeholder="E-mail" required>
		        </div>
		        <div class="form-group">
		            <input type="text" id="nick" class="form-control" placeholder="Nickname">
		        </div>
		        <div class="form-group">
		            <input type="password" id="password1" class="form-control" placeholder="Password" required>
		        </div>
		        <div class="form-group">
		            <input type="password" id="password2" class="form-control" placeholder="Retype password" required>
		        </div>
		    </div>
		    <div class="footer">                    
		        <button type="submit" id="signupadmin" class="btn bg-olive btn-block">Sign up</button>
		    </div>
		    <div align="center" id="message"></div>
		    </form>
		</div>

    </div>
  </div>

</div>
<script>
$(document).ready(function() {
	$("#form").bind("submit", manualValidate);
	function manualValidate(e) {
		e.preventDefault();
		e.target.checkValidity();
		var name = $('#name').val();
		var email = $('#email').val();
		var nick = $('#nick').val();
		var t = "<?php echo $time;?>";
		var p1 = $('#password1').val();
		var p2 = $('#password2').val();
		var url = "<?php echo $baseurl ?>";
		var key = "<?php echo $public_key?>";
		var hash = "<?php echo $hash?>";
		url = url + "/admin/users/adminlist/addnewadmin.php";
		var uri = 'hash=' + hash + '&public=' + key + '&t=' + t;
		uri += '&name=' + name + '&email=' + email + '&p1=' + p1 + '&p2=' + p2 + '&nick=' + nick;

		if (p1 !== p2) {
			$('#message').html('Password not matched');
			setTimeout(function() {
				$('#message').html('');
			}, 2000);
		}
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
					location.reload();
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