<div id="menu">
	<ul>
		<li><a href="." class="<?php echo $selected_menu == "Login" ? "selected" : "" ?>"><span class="icon medium key"></span> Login</a></li>
<?php
	if($opt_register_tab_show == 1)
	{
?>
		<li><a href="register.php" class="<?php echo $selected_menu == "Register" ? "selected" : "" ?>"><span class="icon medium user"></span> Register</a></li>
<?php
	}
?>
		<li><a href="proj_list.php" class="<?php echo $selected_menu == "PublicProject" ? "selected" : "" ?>"><span class="icon medium document"></span> Public Projects</a></li>
		<li><a href="about.php" class="<?php echo $selected_menu == "About" ? "selected" : "" ?>"><span class="icon medium document"></span> About</a></li>
<?php
	if($opt_blog_tab_show == 1)
	{
?>
		<li><a href="<?php echo $opt_blog_tab_url; ?>"><span class="icon medium docLinesStright"></span> <?php echo $opt_blog_tab_title; ?></a></li>
<?php
	}
?>
	</ul>
</div>
