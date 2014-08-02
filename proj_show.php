<?php
	require_once('include/login/auth.php');
	require_once('include/debug.php');
	include('include/mysql_connect.php');

	if (!isset($_GET["proj_id"]))
	{
		header("Location: error.php?id=3");
	}

	$outval = "";
	$outval_colour = "";

	if(isset($_SESSION['SESS_MEMBER_ID']) == true)
	{
		if(isset($_POST['submit']))
		{
			$project_id = mysql_real_escape_string($_GET["proj_id"]);
			$owner = $_SESSION['SESS_MEMBER_ID'];
			$n = strip_tags(mysql_real_escape_string($_POST["name"]));
			$qty = intval(strip_tags(mysql_real_escape_string($_POST["quantity"])));

			$qry = "SELECT projects_data_quantity, projects_data_id FROM `projects_data` where projects_data_owner_id = '".$owner."' and projects_data_component_id = (select id from data where owner = '".$owner."' and name ='".$n."')";
			$sql_exec = mysql_Query($qry);

			if(mysql_num_rows($sql_exec)  > 0)
			{
				if($qty == 0)
				{
					while($showDetails = mysql_fetch_array($sql_exec))
					{
						$id = $showDetails['projects_data_id'];
						$newqty = $showDetails['projects_data_quantity'];
					}

					$sql = "delete from projects_data where projects_data_id = ".$id."";
					mysql_Query($sql);
					if(mysql_affected_rows() > 0)
					{
						$outval = "Component removed from project.";
						$outval_colour = "blue";
					}
					else
					{
						$outval = "Component could not be removed from project.";
						$outval_colour = "red";
					}
				}
				else
				{
					if($qty > 0)
					{
						while($showDetails = mysql_fetch_array($sql_exec))
						{
							$id = $showDetails['projects_data_id'];
							$newqty = $showDetails['projects_data_quantity'];
						}

						if($newqty != $qty)
						{
							$sql = "update projects_data set projects_data_quantity = ".$qty." where projects_data_id=".$id."";
							mysql_Query($sql);
							if(mysql_affected_rows() > 0)
							{
								$outval = "Component quantity updated.";
								$outval_colour = "green";
							}
							else
							{
								$outval = "Component found but could not be updated.";
								$outval_colour = "red";
							}
						}
						else
						{
							$outval = "Quantity not changed, so no updated required.";
							$outval_colour = "blue";
						}
					}
					else
					{
						$outval = "Invalid quantity to update component.";
						$outval_colour = "red";
					}
				}
			}
			else
			{
				if($qty > 0)
				{
					$sql_exec = mysql_Query("select id from data where owner = '".$_SESSION['SESS_MEMBER_ID']."' and name ='".$n."'");
					if(mysql_num_rows($sql_exec)  > 0)
					{
						$showDetails = mysql_fetch_array($sql_exec);
						$comp_id = $showDetails['id'];

						$sql = "insert into projects_data (projects_data_owner_id, projects_data_project_id, projects_data_component_id, projects_data_quantity) values(".$owner.",".$project_id.",".$comp_id.",".$qty.")";
						mysql_Query($sql);
						if(mysql_affected_rows() > 0)
						{
							$outval = "Component added to project.";
							$outval_colour = "green";
						}
						else
						{
							$outval = "Failed to insert new component into project.";
							$outval_colour = "red";
						}
					}
					else
					{
						$outval = "Failed to find component ".$n;
						$outval_colour = "red";
					}
				}
				else
				{
					$outval = "Invalid quantity to add a new component.";
					$outval_colour = "red";
				}
			}
		}
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
		<?php

		include_once("include/analytics.php");

		if(isset($_SESSION['SESS_MEMBER_ID']) == true)
		{
?>
<script type="text/javascript" src="include/autocomplete/jquery.js"></script>
<script type="text/javascript" src="include/autocomplete/jquery.autocomplete.js"></script>
<link rel="stylesheet" type="text/css" href="include/autocomplete/jquery.autocomplete.css" />

<script type="text/javascript">
$().ready(function() {
	$("#name").autocomplete("include/autocomplete/autocomplete_name_owner.php?memberID=<?php echo $_SESSION['SESS_MEMBER_ID'] ?>", {
		width: 150,
		matchContains: true,
		minChars: 2,
		selectFirst: false,
	});
});
</script>
<?php
		}
		?>
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

<?php
	if(isset($outval) && strlen($outval) > 0)
	{
		echo '<div class="message '.$outval_colour.' center">'.$outval.'</div>';
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
									?>">Qty in stock</a>
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
									?>">Qty on order</a>
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
									?>">Qty in project</a>
								</th>

								<th>
									<a href="?proj_id=<?php echo $project_id; ?>&by=bin_location&order=<?php
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
									?>">Bin#</a>
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
<?php
if(isset($_SESSION['SESS_MEMBER_ID'])==true)
{
?>
					<form class="globalForms noPadding" action="" method="post" id="quickadd">
						<table class="globalTables leftAlign noHover" cellpadding="0" cellspacing="0">
							<tbody>
								<tr>
									<td>
										<div class="input">
											<button class="button green" name="submit" type="submit"><span class="icon medium save"></span> Quick Add Component</button>
										</div>
									</td>
									<td class="boldText">
										Component
									</td>
									<td>
										<input name="name" id="name" type="text" class="big" value="" autofocus tabindex="0"/>
									</td>

									<td class="boldText">
										Quantity
									</td>
									<td>
										<input name="quantity" type="text" class="small" value="" />
									</td>
								</tr>
							</tbody>
						</table>
					</form>
<?php
}
?>
				</div>
			<!-- END -->
			<!-- Text outside the main content -->
				<?php include 'include/footer.php'; ?>
			<!-- END -->
		</div>
	</body>
</html>
