<?php
	require_once('include/login/auth.php');
	require_once('include/debug.php');

	require_once('include/mysql_connect.php');
	include_once("include/include_parse_admin_options.php");

	if($_SESSION['SESS_IS_ADMIN'] == 0)
	{
		header("location: index.php");
		exit();
	}

	$executesql = array();
	$executesql['opt_show_blog_tab'] = $opt_show_blog_tab;
	$executesql['opt_blog_tab_title'] = $opt_blog_tab_title;
	$executesql['opt_blog_tab_url'] = $opt_blog_tab_url;
	$executesql['opt_register_tab_show'] = $opt_register_tab_show;
	$executesql['opt_pubcomponent_tab_show'] = $opt_pubcomponent_tab_show;
	$executesql['opt_donate_tab_show'] = $opt_donate_tab_show;

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
				<div class="subMenu">
					<ul>

						<?php if(isset($_GET['user_add']) && intval($_GET['user_add']) == 1)
						{
						?>
						<div class="message blue">
							User added succesfully.
						</div>
						<?php } ?>

						<div class="buttons">
							<div class="input">
								<form action="register.php" method="get">
									<button class="button green" type="submit"><span class="icon medium pencil"></span> Add New User</button>
								</form>
							</div>
						</div>
					</ul>
				</div>

				<?php
					include('include/include_admin_settings.php');
					$AdminSettings = new Admin;
					$AdminSettings->Settings();
				?>

				<form class="globalForms noPadding" action="" method="post">
					<table class="globalTables leftAlign noHover" cellpadding="0" cellspacing="0">
						<thead>
							<tr>
								<th></th>
								<th>Option</th>
								<th>Value</th>
							</tr>
						</thead>
						<tbody>
						<tr><td colspan='2' class='boldText'>The public Menu</td></tr>
						<tr>
							<td>&nbsp;&nbsp;</td>
							<td class="boldText">
								Show Blog Tab
							</td>
							<td>
								<select name="opt_show_blog_tab">
									<option value="0"
									<?php
										if(!isset($_POST['submit']) && $executesql['opt_show_blog_tab'] == '0') {
											echo 'selected';
										}
										if(isset($_POST['submit']) && $_POST['opt_show_blog_tab'] == '0') {
											echo 'selected';
										}
									?>
									>No</option>
									<option value="1"
									<?php
										if(!isset($_POST['submit']) && $executesql['opt_show_blog_tab'] == '1') {
											echo 'selected';
										}
										if(isset($_POST['submit']) && $_POST['opt_show_blog_tab'] == '1') {
											echo 'selected';
										}
									?>
									>Yes</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>&nbsp;&nbsp;</td>
							<td class="boldText">
								Blog Tab Title
							</td>
							<td>
								<input name="opt_blog_tab_title" class="medium" type="text" value="<?php if(isset($_POST['submit'])) { echo $_POST['opt_blog_tab_title']; } else { echo $executesql['opt_blog_tab_title']; } ?>" />
							</td>
						</tr>
						<tr>
							<td>&nbsp;&nbsp;</td>
							<td class="boldText">
								Blog URL
							</td>
							<td>
								<input name="opt_blog_tab_url" class="medium" type="text" value="<?php if(isset($_POST['submit'])) { echo $_POST['opt_blog_tab_url']; } else { echo $executesql['opt_blog_tab_url']; } ?>" />
							</td>
						</tr>

						<tr><td colspan=2 class='boldText'>Registration</td></tr>
						<tr>
							<td>&nbsp;&nbsp;</td>
							<td class="boldText">
								Enable Registration tab
							</td>
							<td>
								<select name="opt_register_tab_show">
									<option value="0"
									<?php
										if(!isset($_POST['submit']) && $executesql['opt_register_tab_show'] == '0') {
											echo 'selected';
										}
										if(isset($_POST['submit']) && $_POST['opt_register_tab_show'] == '0') {
											echo 'selected';
										}
									?>
									>No</option>
									<option value="1"
									<?php
										if(!isset($_POST['submit']) && $executesql['opt_register_tab_show'] == '1') {
											echo 'selected';
										}
										if(isset($_POST['submit']) && $_POST['opt_register_tab_show'] == '1') {
											echo 'selected';
										}
									?>
									>Yes</option>
								</select>
							</td>
						</tr>

						<tr><td colspan=2 class='boldText'>Public Components</td></tr>
						<tr>
							<td>&nbsp;&nbsp;</td>
							<td class="boldText">
								Enable Public Components tab
							</td>
							<td>
								<select name="opt_pubcomponent_tab_show">
									<option value="0"
									<?php
										if(!isset($_POST['submit']) && $executesql['opt_pubcomponent_tab_show'] == '0') {
											echo 'selected';
										}
										if(isset($_POST['submit']) && $_POST['opt_pubcomponent_tab_show'] == '0') {
											echo 'selected';
										}
									?>
									>No</option>
									<option value="1"
									<?php
										if(!isset($_POST['submit']) && $executesql['opt_pubcomponent_tab_show'] == '1') {
											echo 'selected';
										}
										if(isset($_POST['submit']) && $_POST['opt_pubcomponent_tab_show'] == '1') {
											echo 'selected';
										}
									?>
									>Yes</option>
								</select>
							</td>
						</tr>

						<tr><td colspan=2 class='boldText'>Donate Tab</td></tr>
						<tr>
							<td>&nbsp;&nbsp;</td>
							<td class="boldText">
								Enable Donation tab
							</td>
							<td>
								<select name="opt_donate_tab_show">
									<option value="0"
									<?php
										if(!isset($_POST['submit']) && $executesql['opt_donate_tab_show'] == '0') {
											echo 'selected';
										}
										if(isset($_POST['submit']) && $_POST['opt_donate_tab_show'] == '0') {
											echo 'selected';
										}
									?>
									>No</option>
									<option value="1"
									<?php
										if(!isset($_POST['submit']) && $executesql['opt_donate_tab_show'] == '1') {
											echo 'selected';
										}
										if(isset($_POST['submit']) && $_POST['opt_donate_tab_show'] == '1') {
											echo 'selected';
										}
									?>
									>Yes</option>
								</select>
							</td>
						</tr>

						</tbody>
					</table>
					<div class="buttons">
						<div class="input">
							<button class="button green" name="submit" type="submit"><span class="icon medium save"></span> Save</button>
						</div>
					</div>
				</form>
			</div>
			<!-- END -->
			<!-- Text outside the main content -->
				<?php include 'include/footer.php'; ?>
			<!-- END -->
		</div>
	</body>
</html>
