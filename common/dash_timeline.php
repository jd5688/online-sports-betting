<?php
// javascript is in footer
if ($activities) {
	$i = 0;
?>
    <!-- inner scroll menu -->
    <ul class="timeline">
    <?php
    foreach ($activities as $act) {
    	if ($i == 15) { break; }
    	$i++;
    ?>
        <li>
            <a href="<?php echo $act['href']?>">
            	<div class="pull-left">
	            	<img src="<?php echo $act['image']?>" class="img-circle" alt="User Image">
		        </div>
		        <h6>
		            <?php echo $act['message']?>
		            <small class="time"><?php echo $act['time']?></small>
		        </h6>
            </a>
        </li>
    <?php } // foreach ?>
    </ul>
<?php
} // if $activities
?>

<?php /*
<ul class="timeline">
	<li><!-- start message -->
	    <a href="#">
	        <div class="pull-left">
	            <img src="<?php echo $baseurl ?>/images/avatar3.png" class="img-circle" alt="User Image">
	        </div>
	        <h6>
	            Support Team
	            <small class="time">5 mins</small>
	        </h6>
	        <p>Why not buy a new awesome theme?</p>
	    </a>
	</li><!-- end message -->
	<li>
	    <a href="#">
	        <div class="pull-left">
	            <img src="<?php echo $baseurl ?>/images/avatar2.png" class="img-circle" alt="user image">
	        </div>
	        <h6>
	            AdminLTE Design Team
	            <small class="time">2 hours</small>
	        </h6>
	        <p>Why not buy a new awesome theme?</p>
	    </a>
	</li>
	<li>
	    <a href="#">
	        <div class="pull-left">
	            <img src="<?php echo $baseurl ?>/images/avatar.png" class="img-circle" alt="user image">
	        </div>
	        <h6>
	            Developers
	            <small class="time">Today</small>
	        </h6>
	        <p>Why not buy a new awesome theme?</p>
	    </a>
	</li>
	<li>
	    <a href="#">
	        <div class="pull-left">
	            <img src="<?php echo $baseurl ?>/images/avatar2.png" class="img-circle" alt="user image">
	        </div>
	        <h6>
	            Sales Department
	            <small class="time">Yesterday</small>
	        </h6>
	        <p>Why not buy a new awesome theme?</p>
	    </a>
	</li>
	<li>
	    <a href="#">
	        <div class="pull-left">
	            <img src="<?php echo $baseurl ?>/images/avatar.png" class="img-circle" alt="user image">
	        </div>
	        <h6>
	            Reviewers
	            <small class="time">2 days</small>
	        </h6>
	        <p>Why not buy a new awesome theme?</p>
	    </a>
	</li>
</ul>
*/?>
