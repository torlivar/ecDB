<?php
class ProjAdd {
	public function AddProj	() {

		require_once('include/login/auth.php');
		include('include/mysql_connect.php');

		if(isset($_POST['submit'])) {
			$owner			=	$_SESSION['SESS_MEMBER_ID'];
			$name 			= 	mysql_real_escape_string($_POST['name']);
			$project_public = 	mysql_real_escape_string($_POST['project_public']);
			$project_url 	= 	mysql_real_escape_string($_POST['project_url']);
			$project_desc 	= 	mysql_real_escape_string($_POST['project_desc']);

			$id 			= 	intval($_GET['proj_id']);

			if ($name == '') {
				echo 'You have to specify a name!';
			}
			else {
				$sql = "UPDATE projects SET project_name = '".$name."', project_public=".$project_public.", project_url = '".$project_url."', project_desc = '".$project_desc."' WHERE project_id = ".$id." ";
				$sql_exec = mysql_query($sql);

				header("location: ".$_SERVER['REQUEST_URI']);

				echo '<div class="message green center">';
				echo 'Project updated!';
				echo '</div>';
			}
		}
	}
}
?>
