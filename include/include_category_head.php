<?php
class NameHead {

	public function Head() {

		require_once('include/login/auth.php');
		include('include/mysql_connect.php');
		$owner = $_SESSION['SESS_MEMBER_ID'];

		if(isset($_GET['cat']))
		{
			$headcat = intval($_GET['cat']);
		}

		if(isset($_GET['subcat']))
		{
			$subcat = intval($_GET['subcat']);
			$CategoryName = "SELECT category_id FROM category_sub where id=".$subcat."";
			$sql_exec_catname = mysqli_query($GLOBALS["___mysqli_ston"], $CategoryName);
			$ShowDetailsCatname = mysqli_fetch_array($sql_exec_catname);
			$headcat = $ShowDetailsCatname['category_id'];
		}

		$CategoryName = "SELECT id, name FROM category ORDER by name ASC";
		$sql_exec_catname = mysqli_query($GLOBALS["___mysqli_ston"], $CategoryName);

		echo '<li>';

		//echo '<a href="."';

		//encrypt94 change - set owner in ALL link
		echo '<a href="/';
		if(isset($_GET['owner']))
		{
			echo '?owner='.htmlentities($_GET['owner']);
		}
		echo '"';

		if(empty($_GET['cat']) && empty($_GET['subcat'])) // && empty($headcat))
		{
			echo ' class="selected"';
		}
		else
		{
			echo ' class="isComponents"';
		}

		echo '>';
		echo "All";
		echo '</a></li> ';

		while ($ShowDetailsCatname = mysqli_fetch_array($sql_exec_catname))
		{
			echo '<li>';
			echo '<a href="category.php?cat=';
			echo $ShowDetailsCatname['id'];
			echo '" ';

			// Makes the head category "selected" when that category is viewed.
			if(isset($headcat))
			{
				if ($ShowDetailsCatname['id'] == $headcat)
				{
					echo 'class="selected"';
				}
			}

			// Shows if component exists in category.
			$sql_exec_component_catname = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT category FROM data WHERE owner = ".$owner.""); // Get the category ID from all components.
			while($showDetailsComponentCatname = mysqli_fetch_array($sql_exec_component_catname))
			{
				// Converts components sub category id to it's head category id.
				$component_cat = $showDetailsComponentCatname['category'];
				$comp_cat = $component_cat;

				if($ShowDetailsCatname['id'] == $comp_cat)
				{
					// Compare current category ID with components category ID.
					echo 'class="isComponents"'; // What should be echoed if components exists in category?
					break; // We only need one component to be in this category for this to be true.
				}
			}

			echo '>';
				echo $ShowDetailsCatname['name'];
			echo '</a></li> ';
		}
	}
}
?>


