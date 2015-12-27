<?php
	include_once("include/version.php");
?>
<div id="copyText">
    <div class="leftBox">
        <div><?php echo "version ".$ECDB_VERSION; ?> - <a href="contact.php">Contact us</a> - <a href="terms.php">Terms & Privacy</a> - <a href="about.php">About</a></div>
<?php if(isset($_SESSION['SESS_IS_ADMIN']) && $_SESSION['SESS_IS_ADMIN'] == 1 ) { ?>
        <div class="stats">
            <?php include_once('include/mysql_connect.php'); ?>

        	<?php $members = mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT member_id FROM members")); echo $members; ?>
			<span class="boldText">members</span>,

			<?php $components = mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT id FROM data")); echo $components; ?>
			<span class="boldText">components </span>and

			<?php $projects = mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT project_id FROM projects")); echo $projects; ?>
			<span class="boldText">projects</span>.
        </div>
<?php } ?>
    </div>
    <div class="rightBox">
        Under Creative Commons License - Attribution, NonCommercial, ShareAlike 3.0 Unported License
    </div>
</div>
