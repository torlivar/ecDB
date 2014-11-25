<?php
class EditProj {
	public function MenuProj() {

		require_once('include/login/auth.php');
		include('include/mysql_connect.php');

		$id		= 	(int)$_GET['edit'];

		$query = "SELECT projects_data.projects_data_project_id, projects_data.projects_data_quantity, projects_data.projects_data_project_id, projects_data.projects_data_component_id, projects.project_id, projects.project_name FROM projects_data, projects WHERE projects_data.projects_data_project_id = projects.project_id AND projects_data.projects_data_component_id = '$id' LIMIT 1";

		$result = mysqli_query($GLOBALS["___mysqli_ston"], $query) or die(((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));

		while($row = mysqli_fetch_array($result))
		{
				echo $row['project_name'];
				echo '</td>';
				echo '<td><input name="projquantedit[';
					echo $row['project_id'];
				echo ']" type="text" class="small" value="';
					echo $row['projects_data_quantity'];
				echo '" /></td>';
				echo '<td>';
				//echo '<button class="button white small" name="orderquant_increase" type="submit"><span class="icon medium roundPlus"></span></button>';
				//echo '<button class="button white small" name="orderquant_decrease" type="submit"><span class="icon medium roundMinus"></span></button>';
			echo '</td>';
			echo '</tr>';
		}


		if (mysqli_num_rows($result) == 0) {
			echo '</td>';
			echo '<td></td>';
			echo '<td></td>';
			echo '</tr>';
		}
	}


	public function ComponentProj($id)
	{
		require_once('include/login/auth.php');
		include('include/mysql_connect.php');

		$query = "SELECT projects_data.projects_data_project_id, projects_data.projects_data_quantity, projects_data.projects_data_project_id, projects_data.projects_data_component_id, projects.project_id, projects.project_name FROM projects_data, projects WHERE projects_data.projects_data_project_id = projects.project_id AND projects_data.projects_data_component_id = '$id' LIMIT 1";
		$result = mysqli_query($GLOBALS["___mysqli_ston"], $query) or die(((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));

		while($row = mysqli_fetch_array($result))
		{
			echo '<td>'.$row['project_name'].'</td>';
			echo '<td>'.$row['projects_data_quantity'].'</td>';
		}

		if (mysqli_num_rows($result) == 0)
		{
			echo '<td></td>';
			echo '<td></td>';
		}
	}
}
?>
