<?php
	//Create query
	$qry="SELECT admin_key, admin_value FROM admin_options";
	$result=mysqli_query($GLOBALS["___mysqli_ston"], $qry);

	// sane defaults
	$opt_blog_tab_show = 0;
	$opt_blog_tab_title = "Blog Title";
	$opt_blog_tab_url = "/Blog";

	$opt_register_tab_show = 1;
	$opt_pubcomponent_tab_show = 0;
	$opt_donate_tab_show = 1;

	while ($row = mysqli_fetch_assoc($result))
	{
		if($row['admin_key'] == 'blog_tab_show')
		{
			$opt_blog_tab_show = intval($row['admin_value']);
		}
		if($row['admin_key'] == 'blog_tab_title')
		{
			$opt_blog_tab_title = $row['admin_value'];
		}
		if($row['admin_key'] == 'blog_tab_url')
		{
			$opt_blog_tab_url = $row['admin_value'];
		}
		if($row['admin_key'] == 'register_tab_show')
		{
			$opt_register_tab_show = intval($row['admin_value']);
		}
		if($row['admin_key'] == 'pubcomponents_tab_show')
		{
			$opt_pubcomponent_tab_show = intval($row['admin_value']);
		}
		if($row['admin_key'] == 'donate_tab_show')
		{
			$opt_donate_tab_show = intval($row['admin_value']);
		}
	}
?>
