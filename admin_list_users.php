<?php
	require_once('include/login/auth.php');
	require_once('include/debug.php');

	require_once('include/mysql_connect.php');

	if($_SESSION['SESS_IS_ADMIN'] == 0)
	{
		header("location: index.php");
		exit();
	}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="include/style.css" media="screen"/>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
		<meta name="description" content="Viwe all your added components."/>
		<meta name="keywords" content="electronics, components, database, project, inventory"/>
		<link rel="shortcut icon" href="favicon.ico" />
		<link rel="apple-touch-icon" href="img/apple.png" />
		<title>Home - ecDB</title>
		<?php include_once("include/analytics.php") ?>
	</head>
	<body>
		<div id="wrapper">
			<!-- Header -->
			<?php include 'include/header.php'; ?>
			<!-- END -->
			<!-- Main menu -->
			<?php include 'include/menu.php'; ?>
			<!-- END -->
			<!-- Main content -->
			<div id="content">

				<table class="globalTables" cellpadding="0" cellspacing="0">
					<thead>
						<tr>
							<th><a href="?by=firstname&order=<?php if(isset($_GET['order'])){$order = $_GET['order'];if ($order == 'asc'){echo 'desc';}else{echo'asc';}}else {echo 'asc';}?>">First Name</a></th>
							<th><a href="?by=lastname&order=<?php if(isset($_GET['order'])){$order = $_GET['order'];if ($order == 'asc'){echo 'desc';}else{echo'asc';}}else {echo 'asc';}?>">Last Name</a></th>
							<th><a href="?by=login&order=<?php if(isset($_GET['order'])){$order = $_GET['order'];if ($order == 'asc'){echo 'desc';}else{echo'asc';}}else {echo 'asc';}?>">Login</a></th>
							<th><a href="?by=email&order=<?php if(isset($_GET['order'])){$order = $_GET['order'];if ($order == 'asc'){echo 'desc';}else{echo'asc';}}else {echo 'asc';}?>">E-Mail</a></th>
							<th><a href="?by=admin&order=<?php if(isset($_GET['order'])){$order = $_GET['order'];if ($order == 'asc'){echo 'desc';}else{echo'asc';}}else {echo 'asc';}?>">Admin</a></th>
							<th><a href="?by=dreg&order=<?php if(isset($_GET['order'])){$order = $_GET['order'];if ($order == 'asc'){echo 'desc';}else{echo'asc';}}else {echo 'asc';}?>">Date Registered</a></th>
							<th><a href="?by=dllogin&order=<?php if(isset($_GET['order'])){$order = $_GET['order'];if ($order == 'asc'){echo 'desc';}else{echo'asc';}}else {echo 'asc';}?>">Date of Last Login</a></th>
						</tr>
					</thead>
					<tbody>
						<?php
						include('include/include_admin_list_users.php');
						$ListUsers = new Users;
						$ListUsers->UsersList();
						?>
					</tbody>
				</table>
			</div>
			<!-- END -->
			<!-- Text outside the main content -->
				<?php include 'include/footer.php'; ?>
			<!-- END -->
		</div>
	</body>
</html>
