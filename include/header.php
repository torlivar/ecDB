<?php
	include_once("include/version.php");
	include_once("include/include_parse_admin_options.php");
?>
<div id="header">

	<?php require_once("include/logo_wrapper.php"); ?>


	<span class="userInfo">
		Logged in as <a href="my.php">
		<?php
			require_once('include/login/auth.php');
			include('include/mysql_connect.php');

			$owner = $_SESSION['SESS_MEMBER_ID'];
			$GetName = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT firstname, lastname FROM members WHERE member_id = ".$owner."");
			$headername = mysqli_fetch_assoc($GetName);

			if(isset($_POST['submit']) && $script_name == 'my.php') { echo $_POST['firstname']; } else { echo $headername['firstname']; }
			echo ' ';
			if(isset($_POST['submit']) && $script_name == 'my.php') { echo $_POST['lastname']; } else { echo $headername['lastname']; }


			if($_SESSION['SESS_IS_ADMIN'] == 1)
			{
				echo " (Administrator)";
			}
		?>
		</a> - <a href="logout.php"> Sign out</a>
	</span>

	<div class="searchContent">
		<form class="search" action="search.php" method="get">
			<input type="text" name="q" autofocus/>
		</form>
	</div>
</div>

