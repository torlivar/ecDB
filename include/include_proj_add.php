<?php
class ProjAdd {
	public function AddProj	() {

		require_once('include/login/auth.php');
		include('include/mysql_connect.php');

		if(isset($_POST['submit'])) {
			$owner			=	$_SESSION['SESS_MEMBER_ID'];
			$name 			= 	mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['name']);

			if ($name == '') {
				echo '<div class="message red">';
				echo 'You have to specify a name!';
				echo '</div>';
			}
			else {
				$sql="INSERT into projects (project_owner, project_name) VALUES ('$owner', '$name')";
				$sql_exec = mysqli_query($GLOBALS["___mysqli_ston"], $sql);

				$proj_id = ((is_null($___mysqli_res = mysqli_insert_id($GLOBALS["___mysqli_ston"]))) ? false : $___mysqli_res);

				echo '<div class="message green center">';
				echo 'Project added!';
				echo '</div>';
			}
		}
	}
}
?>
