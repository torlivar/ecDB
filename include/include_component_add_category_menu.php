<?php
class AddMenuCat {
	public function MenuCat() {

		require_once('include/login/auth.php');
		include('include/mysql_connect.php');

		$HeadCategoryNameQuery = "SELECT id, name FROM category ORDER by name ASC";
		$sql_exec_headcat = mysql_Query($HeadCategoryNameQuery);

		echo '<option class="main_category" value="">';
		echo ' - Category - ';
		echo '</option>';

		while ($HeadCategory = mysql_fetch_array($sql_exec_headcat)) {
			echo '<option class="main_category" value="';
			echo $HeadCategory['id'];
			echo '" disabled="disabled">';
			echo $HeadCategory['name'];
			echo '</option>';


			$SubCategoryNameQuery = "SELECT id, subcategory FROM category_sub WHERE category_id=".$HeadCategory['id']." ORDER by subcategory ASC";
			$sql_exec_subcat = mysql_Query($SubCategoryNameQuery);

			while ($SubCategory = mysql_fetch_array($sql_exec_subcat)) {
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
