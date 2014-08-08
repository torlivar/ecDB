<?php
class AddMenuCat {
	public function MenuCat() {

		require_once('include/login/auth.php');
		include('include/mysql_connect.php');

		$HeadCategoryNameQuery = "SELECT id, name FROM category ORDER by name ASC";
		$sql_exec_headcat = mysqli_query($GLOBALS["___mysqli_ston"], $HeadCategoryNameQuery);

		echo '<option class="main_category" value="">';
		echo ' - Category - ';
		echo '</option>';

		while ($HeadCategory = mysqli_fetch_array($sql_exec_headcat)) {
			echo '<option class="main_category" value="';
			echo $HeadCategory['id'];
			echo '" disabled="disabled">';
			echo $HeadCategory['name'];
			echo '</option>';


			$SubCategoryNameQuery = "SELECT id, subcategory FROM category_sub WHERE category_id=".$HeadCategory['id']." ORDER by subcategory ASC";
			$sql_exec_subcat = mysqli_query($GLOBALS["___mysqli_ston"], $SubCategoryNameQuery);

			while ($SubCategory = mysqli_fetch_array($sql_exec_subcat)) {
				echo '<option value="';
				echo $SubCategory['id'];
				echo '"';
				if(isset($_POST['submit'])) {
					if(isset($_POST['category'])) {
						if($SubCategory['id'] == $_POST['category']) {
							echo ' selected ';
						}
					}
				}
				echo '>';
				echo $SubCategory['subcategory'];
				echo '</option>';
			}
		}
	}
}
?>
