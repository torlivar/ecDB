<?php
	require_once('include/login/auth.php');
	require_once('include/debug.php');
	require_once('include/mysql_connect.php');
    
    if (isset($_POST['showall'])) {
        $_SESSION['SEE_FROM_ALL'] = true;
    }
    else if (isset($_POST['showmine'])){
        $_SESSION['SEE_FROM_ALL'] = false;
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
				<div class="subMenu">
					<ul>
						<?php
							include('include/include_category_head.php');

							$Head = new NameHead;
							$Head->Head();
						?>
					</ul>
				</div>

				<table class="globalTables" cellpadding="0" cellspacing="0">
					<thead>
						<tr>
							<th>
							</th>
							<th>
								<a href="?by=name&order=<?php
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
                            <?php if ($_SESSION['SEE_FROM_ALL']) { ?>
                            <th>
								<a href="?by=owner&order=<?php
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
								?>">Owner</a>
							</th>
                            <?php } ?>
							<th>
								<a href="?by=category&order=<?php
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
								<a href="?by=package&order=<?php
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
								<a href="?by=pins&order=<?php
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
								?>">Pins</a>
							</th>
							<th>
								Image
							</th>
							<th>
								Datasheet
							</th>
							<th>
								<a href="?by=smd&order=<?php
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
								<a href="?by=price&order=<?php
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
								<a href="?by=quantity&order=<?php
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
								?>">Quantity</a>
							</th>
							<th>
								Bin#
							</th>
							<th>
								Comment
							</th>
						</tr>
					</thead>
					<tbody>
					<?php
						include('include/include.php');

						$Index = new ShowComponents;
						$Index->Index();
					?>
					</tbody>
				</table>
                <form action="" method="POST">
                <?php
                    if (!$_SESSION['SEE_FROM_ALL']) {
                ?>
                    <button class="button" name="showall" type="submit"><span class="icon medium user"></span> Show all components</button>
                <?php
                    } else {
                ?>
                    <button class="button" name="showmine" type="submit"><span class="icon medium user"></span> Show only mine</button>
                <?php
                    }
                ?>
                
                </FORM>
			</div>
			<!-- END -->
			<!-- Text outside the main content -->
				<?php include 'include/footer.php'; ?>
			<!-- END -->
		</div>
	</body>
</html>
