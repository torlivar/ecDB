<?php
	require_once('include/login/auth.php');
	include('include/mysql_connect.php');
	require_once('include/debug.php');

	$owner 	= 	$_SESSION['SESS_MEMBER_ID'];
	$id 	= 	(int)$_GET['based'];

	// Get data from the old component to inherit.
	$GetDataComponent = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM data WHERE id = ".$id);
	$executesql = mysqli_fetch_assoc($GetDataComponent);

	// Get some personal data. ID, currency, measurement unit
	$GetPersonal = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT currency, measurement FROM members WHERE member_id = ".$owner."");
	$personal = mysqli_fetch_assoc($GetPersonal);

	$head_cat_id = $executesql['category'];

	// Get the head category name, based of the head category ID.
	$GetHeadCatName = mysqli_query($GLOBALS["___mysqli_ston"], "select c.name h, c.id cid, cs.subcategory s, cs.id csid from category c, category_sub cs where c.id = cs.category_id and cs.id = ".$head_cat_id."");
	$executesql_head_catname = mysqli_fetch_assoc($GetHeadCatName);

	// Sub category == $sub_cat_id
	$sub_cat_id = $executesql_head_catname['cid'];

	// Get ALL the sub categories.
	$GetDataComponentsAll = "SELECT * FROM category_sub";
	$sql_exec = mysqli_query($GLOBALS["___mysqli_ston"], $GetDataComponentsAll);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="sv" lang="sv">
	<head>
		<link rel="stylesheet" type="text/css" href="include/style.css" media="screen"/>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
		<meta name="description" content="Add a new component based on <?php echo $executesql['name']; ?>."/>
		<meta name="keywords" content="electronics, components, database, project, inventory"/>
		<link rel="shortcut icon" href="favicon.ico" />
		<link rel="apple-touch-icon" href="img/apple.png" />
		<title>Add component - ecDB</title>
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

				<h1>Add new component based on <a href="component.php?view=<?php echo $executesql['id']; ?>"><?php echo $executesql['name']; ?></a></h1>

				<?php
					include('include/include.php');
					$Add = new ShowComponents;
					$Add->Add();
				?>

				<form class="globalForms noPadding" action="" method="post">
					<div class="textBoxInput">
						<label class="keyWord boldText">Comment</label>
						<div class="text">
							<textarea name="comment" rows="4"><?php echo $executesql['comment']; ?></textarea>
						</div>
					</div>
					<table class="globalTables leftAlign noHover" cellpadding="0" cellspacing="0">
						<tbody>
							<tr>
								<td class="boldText">
									Name
								</td>
								<td>
									<input name="name" class="medium" type="text" value="<?php echo $executesql['name']; ?>" id="name" />
								</td>
								<td class="boldText">
									Category
								</td>
								<td>
									<select name="category">
										<?php
											$HeadCategoryNameQuery = "SELECT id, name  FROM category ORDER by name ASC";
											$sql_exec_headcat = mysqli_query($GLOBALS["___mysqli_ston"], $HeadCategoryNameQuery);

											while ($HeadCategory = mysqli_fetch_array($sql_exec_headcat)) {

												echo '<option class="main_category" value="';
												echo $HeadCategory['id'];
												echo '" disabled>';
												echo $HeadCategory['name'];
												echo '</option>';

												$SubCategoryNameQuery = "SELECT id, subcategory FROM category_sub WHERE category_id=".$HeadCategory['id']." ORDER by subcategory ASC";
												$sql_exec_subcat = mysqli_query($GLOBALS["___mysqli_ston"], $SubCategoryNameQuery);

												while ($SubCategory = mysqli_fetch_array($sql_exec_subcat)) {
													echo '<option value="';
													echo $SubCategory['id'];
													echo '"';
														if ($head_cat_id == $SubCategory['id']) {
															echo ' selected';
														}
													echo '>';
													echo $SubCategory['subcategory'];
													echo '</option>';
												}

											}
										?>
									</select>
								</td>
								<td class="boldText">
									Quantity
								</td>
								<td>
									<input name="quantity" type="text" class="small" value="<?php echo $executesql['quantity']; ?>" id="quantity" />
								</td>
							</tr>
							<tr>
								<td class="boldText">
									Manufacturer
								</td>
								<td>
									<input name="manufacturer" class="medium" type="text" value="<?php echo $executesql['manufacturer']; ?>" />
								</td>
								<td class="boldText">
									Package
								</td>
								<td>
									<input name="package" class="medium" type="text" value="<?php echo $executesql['package']; ?>" />
								</td>
								<td class="boldText">
									Pins
								</td>
								<td>
									<input name="pins" type="text" class="small" value="<?php echo $executesql['pins']; ?>" />
								</td>
							</tr>
							<tr>
								<td class="boldText">
									Location
								</td>
								<td>
									<input name="location" type="text" class="medium" value="<?php echo $executesql['location']; ?>" id="location" />
								</td>
								<td class="boldText">
									Price
								</td>
								<td>
									<input name="price" type="text" class="small" value="<?php echo $executesql['price']; ?>" id="price" /> <?php echo $personal['currency']; ?>
								</td>
								<td class="boldText">
									To order
								</td>
								<td>
									<input name="orderquant" type="text" class="small" value="<?php echo $executesql['order_quantity']; ?>" id="orderquant" />
								</td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td class="boldText">
									SMD
								</td>
								<td>
									<?php
										if($executesql['smd'] == 'Yes'){
											echo '<input type="radio" name="smd" value="Yes" checked="checked" /> Yes ';
											echo '<input type="radio" name="smd" value="No" /> No';
										}
										else{
											echo '<input type="radio" name="smd" value="Yes" /> Yes ';
											echo '<input type="radio" name="smd" value="No" checked="checked" /> No';
										}
									?>
								</td>
								<td class="boldText">
									Scrap
								</td>
								<td>
									<?php
										if($executesql['scrap'] == 'Yes'){
											echo '<input type="radio" name="scrap" value="Yes" checked="checked" /> Yes ';
											echo '<input type="radio" name="scrap" value="No" /> No';
										}
										else{
											echo '<input type="radio" name="scrap" value="Yes" /> Yes ';
											echo '<input type="radio" name="scrap" value="No" checked="checked" /> No';
										}
									?>
								</td>
								<td>
								</td>
								<td>
								</td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td class="boldText">
									Weight
								</td>
								<td>
									<input name="weight" type="text" class="small" value="<?php echo $executesql['weight']; ?>" /> <?php if($personal['measurement'] == 1){echo 'g';} else {echo 'g'; } ?>
								</td>
								<td class="boldText">
									Width
								</td>
								<td>
									<input name="width" type="text" class="small" value="<?php echo $executesql['width']; ?>" /> <?php if($personal['measurement'] == 1){echo 'mm';} else {echo 'in'; } ?>
								</td>
								<td></td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td class="boldText">
									Depth
								</td>
								<td>
									<input name="depth" type="text" class="small" value="<?php echo $executesql['depth']; ?>" /> <?php if($personal['measurement'] == 1){echo 'mm';} else {echo 'in'; } ?>
								</td>
								<td><img class="packageImage" border="0" src="img/boxSize.png"/></td>
								<td></td>
							</tr>

							<tr>
								<td class="boldText">
									Bin Location
								</td>
								<td>
									<input name="bin_location" type="text" class="medium" value="<?php echo $executesql['bin_location']; ?>" />
								</td>

								<td>
								</td>

								<td>
								</td>

								<td>
								</td>
							</tr>

							<tr>
								<td class="boldText">
									Datasheet URL
								</td>
								<td>
									<input name="datasheet" type="text" class="medium" value="<?php echo $executesql['datasheet']; ?>" />
								</td>
								<td class="boldText">
									Height
								</td>
								<td>
									<input name="height" type="text" class="small" value="<?php echo $executesql['height']; ?>" /> <?php if($personal['measurement'] == 1){echo 'mm';} else {echo 'in'; } ?>
								</td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td class="boldText">
									Image URL 1
								</td>
								<td>
									<input name="url1" type="text" class="medium" value="<?php echo $executesql['url1']; ?>" />
								</td>
								<td class="boldText">
									Image URL 2
								</td>
								<td>
									<input name="url2" type="text" class="medium" value="<?php echo $executesql['url2']; ?>"  />
								</td>
								<td>
								</td>
								<td>
								</td>
							</tr>
							<tr>
								<td class="boldText">
									Image URL 3
								</td>
								<td>
									<input name="url3" type="text" class="medium" value="<?php echo $executesql['url3']; ?>" />
								</td>
								<td class="boldText">
									Image URL 4
								</td>
								<td>
									<input name="url4" type="text" class="medium" value="<?php echo $executesql['url4']; ?>" />
								</td>
								<td>
								</td>
								<td>
								</td>
							</tr>
							<tr>
								<td></td>
								<td  class="boldText">
									Add component to project
								</td>
								<td  class="boldText">
									Quantity
								</td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td></td>
								<td>
									<select name="project">
										<?php
											include('include/include_component_add_project.php');
											$MenuProj = new AddMenuProj;
											$MenuProj->MenuProj();
										?>
									</select>
								</td>
								<td>
									<input name="projquant" type="text" class="small" value="<?php if(isset($_POST['submit'])) { echo $_POST['projquant']; } ?>" />
								</td>
								<td></td>
								<td></td>
								<td></td>
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
