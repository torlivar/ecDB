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
		<title>Contact - ecDB</title>
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
			<?php $selected_menu = "Contact"; include_once('include/include_main_menu.php'); ?>
			<!-- END -->
<?php
}
?>
			<div id="content">
				<div class="loginWrapper">
					<div class="left">
						<h1>Contact us</h1>
						If you have any suggestions, questions or what not. Contact through the <a href="http://github.com/stu/ecDB">ecDB GitHub Project</a>.
					</div>
					<div class="right"></div>
				</div>
			</div>
			<!-- END -->
			<!-- Text outside the main content -->
			<?php include 'include/footer.php'; ?>
			<!-- END -->
		</div>
	</body>
</html>
