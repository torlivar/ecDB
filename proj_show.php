<?php
	require_once('include/login/auth.php');
	require_once('include/debug.php');

	if (!isset($_GET["proj_id"]))
	{
		header("Location: error.php?id=3");
	}

	require_once('include/Parsedown.php');
	$Parsedown = new Parsedown();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="sv" lang="sv">
	<head>
		<link rel="stylesheet" type="text/css" href="include/style.css" media="screen"/>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
		<meta name="description" content="BOM-list for project <?php
							// Visar projektets namn.
							include('include/mysql_connect.php');
							$project_id = mysql_real_escape_string($_GET["proj_id"]);
							$result = mysql_query("SELECT project_name FROM projects WHERE project_id = ".$project_id."");

							while($row = mysql_fetch_array($result))
							{
								echo $row['project_name'];
							}
						?>"/>
		<meta name="keywords" content="electronics, components, database, project, inventory"/>
		<link rel="shortcut icon" href="favicon.ico" />
		<link rel="apple-touch-icon" href="img/apple.png" />
		<title>Viewing project - <?php
							// Visar projektets namn.
							include('include/mysql_connect.php');
							$project_id = mysql_real_escape_string($_GET["proj_id"]);
							$result = mysql_query("SELECT project_name FROM projects WHERE project_id = ".$project_id."");

							while($row = mysql_fetch_array($result))
							{
								echo $row['project_name'];
							}
						?> - ecDB</title>
		<?php include_once("include/analytics.php") ?>

	</head>
	<body>
		<div id="wrapper">
<?php

if(isset($_SESSION['SESS_MEMBER_ID'])==true)
{
			$pub_proj = "";
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
			$pub_proj = " and project_public=1 ";

			require_once("include/logo_wrapper.php");
			?>

			<!-- Main menu -->
			<?php $selected_menu = "PublicProject"; include_once('include/include_main_menu.php'); ?>
			<!-- END -->
<?php
}
?>
				<div id="content">
					<?php
							// Get project name/url and description
							include('include/mysql_connect.php');
							$project_id = mysql_real_escape_string($_GET["proj_id"]);

							$result = mysql_query("SELECT project_name, project_desc, project_url FROM projects WHERE project_id = ".$project_id." ".$pub_proj);

							while($row = mysql_fetch_array($result))
							{
								echo "<h1>Viewing project <strong>";
								if(is_null($row['project_url']) == false)
								{
									echo "<a href=".$row['project_url'].">".$row['project_name']."</a>";
								}
								else
								{
									echo $row['project_name'];
								}
								echo "</strong></h1>";

								if(is_null($row['project_desc']) == false)
								{
									echo "<div id='projDesc'>";
									echo $Parsedown->setBreaksEnabled(true)
											->text($row['project_desc']);
									echo "</div>";
								}
							}
						?>

					<table class="globalTables" cellpadding="0" cellspacing="0">
						<thead>
							<tr>
								<th></th>
								<th>
									<a href="?proj_id=<?php echo $project_id; ?>&by=name&order=<?php
										if(isset($_GET['order'])){
											$order = $_GET['order'];
											if ($order == 'asc'){
												echo 'desc';
											}
											else {
												echo 'asc';
											}
										}
										else {
											echo 'desc';
										}
									?>">Name</a>
								</th>
								<th>
									<a href="?proj_id=<?php echo $project_id; ?>&by=category&order=<?php
										if(isset($_GET['order'])){
											$order = $_GET['order'];
											if ($order == 'asc'){
												echo 'desc';
											}
											else {
												echo 'asc';
											}
										}
										else {
											echo 'asc';
										}
									?>">Category</a>
								</th>
								<th>
									<a href="?proj_id=<?php echo $project_id; ?>&by=manufacturer&order=<?php
										if(isset($_GET['order'])){
											$order = $_GET['order'];
											if ($order == 'asc'){
												echo 'desc';
											}
											else {
												echo 'asc';
											}
										}
										else {
											echo 'asc';
										}
									?>">Manufacturer</a>
								</th>
								<th>
									<a href="?proj_id=<?php echo $project_id; ?>&by=package&order=<?php
										if(isset($_GET['order'])){
											$order = $_GET['order'];
											if ($order == 'asc'){
												echo 'desc';
											}
											else {
												echo 'asc';
											}
										}
										else {
											echo 'asc';
										}
									?>">Package</a>
								</th>
								<th>
									<a href="?proj_id=<?php echo $project_id; ?>&by=smd&order=<?php
										if(isset($_GET['order'])){
											if ($order == 'asc'){
												echo 'desc';
											}
											else {
												echo 'asc';
											}
										}
										else {
											echo 'asc';
										}
									?>">SMD</a>
								</th>
								<th>
									<a href="?proj_id=<?php echo $project_id; ?>&by=price&order=<?php
										if(isset($_GET['order'])){
											$order = $_GET['order'];
											if ($order == 'asc'){
												echo 'desc';
											}
											else {
												echo 'asc';
											}
										}
										else {
											echo 'asc';
										}
									?>">Price</a>
								</th>
								<th>
									<a href="?proj_id=<?php echo $project_id; ?>&by=quantity&order=<?php
										if(isset($_GET['order'])){
											$order = $_GET['order'];
											if ($order == 'asc'){
												echo 'desc';
											}
											else {
												echo 'asc';
											}
										}
										else {
											echo 'asc';
										}
									?>">Quantity in stock</a>
								</th>
								<th>
									<a href="?proj_id=<?php echo $project_id; ?>&by=order_quantity&order=<?php
										if(isset($_GET['order'])){
											$order = $_GET['order'];
											if ($order == 'asc'){
												echo 'desc';
											}
											else {
												echo 'asc';
											}
										}
										else {
											echo 'asc';
										}
									?>">Quantity on order</a>
								</th>

								<th>
									<a href="?proj_id=<?php echo $project_id; ?>&by=quantity&order=<?php
										if(isset($_GET['order'])){
											$order = $_GET['order'];
											if ($order == 'asc'){
												echo 'desc';
											}
											else {
												echo 'asc';
											}
										}
										else {
											echo 'asc';
										}
									?>">Quantity in project</a>
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
								include('include/include_proj_show.php');

								$ProjectShowComponents = new ProjectShow;
								$ProjectShowComponents->ProjectShowComponents();
							?>
						</tbody>
					</table>

					<div class="totalSumWrapper">
						<?php
							include('include/include_proj_show_price.php');

							$ProjectSumTotal = new ProjectShowPrice;
							$ProjectSumTotal->ProjectSumTotal();
						?>
					</div>
				</div>
			<!-- END -->
			<!-- Text outside the main content -->
				<?php include 'include/footer.php'; ?>
			<!-- END -->
		</div>
	</body>
</html>
