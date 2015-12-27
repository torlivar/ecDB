<?php
	require_once('include/debug.php');
	require_once('include/login/auth.php');
	require_once('include/mysql_connect.php');
	include_once("include/include_parse_admin_options.php");
?>
<!DOCTYPE HTML>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="include/style.css" media="screen"/>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
		<link rel="shortcut icon" href="favicon.ico" />
		<link rel="apple-touch-icon" href="img/apple.png" />
		<title>About - ecDB</title>
		<?php include_once("include/analytics.php") ?>

	</head>
	<body>
		<div id="wrapper">
<?php
if(isset($_SESSION['SESS_MEMBER_ID'])==true)
{
?>
			<!-- Header -->
			<?php include 'include/header.php'; ?>
			<!-- END -->
			<!-- Main menu -->
			<?php include 'include/menu.php'; ?>
			<!-- END -->
<?php
}
else
{

			include_once("include/include_parse_admin_options.php");
			require_once("include/logo_wrapper.php");
			?>

			<!-- Main menu -->
			<?php $selected_menu = "About"; include_once('include/include_main_menu.php'); ?>
			<!-- END -->
<?php
}
?>
			<div id="content">
				<div class="loginWrapper">
					<div class="left">
						<div class="message blue">
							Check out <a href="http://github.com/stu/ecDB">ecDB on Github</a> for the latest updates!
						</div>
						<h1>What is ecDB?</h1>

							ecDB is basically a place where you, as an electronics hobbyist (or professional) can add your own components to your personal database to keep track of what components you own, where they are, how many you own and so on.

						<br />
						<br />
						<a href="img/about/index.png"><img src="img/about/index_thumbnail.png"></a>
						<br />
						<a href="img/about/add.png"><img src="img/about/add_thumbnail.png"></a>

				</div>
			</div>
			<!-- END -->

			<!-- Text outside the main content -->
			<?php include 'include/footer.php'; ?>
			<!-- END -->
		</div>
	</body>
</html>
