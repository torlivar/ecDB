<?php
class Admin {
	public function Settings() {

		require_once('include/login/auth.php');
		include('include/mysql_connect.php');

		if(isset($_POST['submit']))
		{
			$GetDataComponent = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT admin_key, admin_value FROM admin_options");

			while ($row = mysqli_fetch_assoc($GetDataComponent))
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
				if($row['admin_key'] == 'donate_tab_show')
				{
					$opt_donate_tab_show = intval($row['admin_value']);
				}
			}

			$opt_blog_tab_show = intval(strip_tags( mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['opt_blog_tab_show'])));
			$opt_blog_tab_title = strip_tags( mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['opt_blog_tab_title']));
			$opt_blog_tab_url = strip_tags( mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['opt_blog_tab_url']));

			$opt_register_tab_show = intval(strip_tags( mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['opt_register_tab_show'])));
			$opt_donate_tab_show = intval(strip_tags( mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['opt_donate_tab_show'])));

			$executesql = array();
			$executesql['opt_blog_tab_show'] = $opt_blog_tab_show;
			$executesql['opt_blog_tab_title'] = $opt_blog_tab_title;
			$executesql['opt_blog_tab_url'] = $opt_blog_tab_url;
			$executesql['opt_register_tab_show'] = $opt_register_tab_show;
			$executesql['opt_donate_tab_show'] = $opt_donate_tab_show;

			if ($opt_blog_tab_title == '')
			{
				echo '<div class="message red">';
				echo 'Blog Title is missing';
				echo '</div>';
			}
			elseif ($opt_blog_tab_url == '')
			{
				echo '<div class="message red">';
				echo 'Blog URL is missing';
				echo '</div>';
			}
			else
			{
				$sql="UPDATE admin_options SET admin_value = '".$opt_blog_tab_show."' WHERE admin_key = 'blog_tab_show'"; $sql_exec = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
				$sql="UPDATE admin_options SET admin_value = '".$opt_blog_tab_title."' WHERE admin_key = 'blog_tab_title'"; $sql_exec = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
				$sql="UPDATE admin_options SET admin_value = '".$opt_blog_tab_url."' WHERE admin_key = 'blog_tab_url'"; $sql_exec = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
				$sql="UPDATE admin_options SET admin_value = '".$opt_register_tab_show."' WHERE admin_key = 'register_tab_show'"; $sql_exec = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
				$sql="UPDATE admin_options SET admin_value = '".$opt_donate_tab_show."' WHERE admin_key = 'donate_tab_show'"; $sql_exec = mysqli_query($GLOBALS["___mysqli_ston"], $sql);

				echo '<div class="message green center">';
				echo 'Settings updated!';
				echo '</div>';
			}
		}
	}
}
?>
