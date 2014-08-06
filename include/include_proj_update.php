<?php
class ProjAdd {
	public function AddProj	() {

		require_once('include/login/auth.php');
		include('include/mysql_connect.php');

		if(isset($_POST['submit'])) {
			$owner			=	$_SESSION['SESS_MEMBER_ID'];
			$name 			= 	mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['name']);
			$project_public = 	mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['project_public']);
			$project_url 	= 	mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['project_url']);
			$project_desc 	= 	mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['project_desc']);

			$id 			= 	intval($_GET['proj_id']);

			if ($name == '') {
				echo 'You have to specify a name!';
			}
			else {
				$sql = "UPDATE projects SET project_name = '".$name."', project_public=".$project_public.", project_url = '".$project_url."', project_desc = '".$project_desc."' WHERE project_id = ".$id." ";
				$sql_exec = mysqli_query($GLOBALS["___mysqli_ston"], $sql);

				//header("location: ".$_SERVER['REQUEST_URI']);

				echo '<div class="message green center">';
				echo 'Project updated!';
				echo '</div>';
			}
		}
	}
}
?>
