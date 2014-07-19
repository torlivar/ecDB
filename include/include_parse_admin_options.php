<?php
	//Create query
	$qry="SELECT admin_key, admin_value FROM admin_options";
	$result=mysql_query($qry);

	// sane defaults
	$opt_blog_tab_show = 0;
	$opt_blog_tab_title = "Blog Title";
	$opt_blog_tab_url = "/Blog";

	$opt_register_tab_show = 0;

	//Check whether the query was successful or not
	if($result)
	{
		while ($row = mysql_fetch_assoc($result))
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
		}

		mysql_free_result($result);
	}
?>
