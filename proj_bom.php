<?php
	require_once('include/login/auth.php');
	require_once('include/debug.php');
	include('include/mysql_connect.php');

	if (!isset($_GET["proj_id"]))
	{
		header("Location: error.php?id=3");
	}

	//if(isset($_SESSION['SESS_MEMBER_ID']) == true)
	{
		$project_id =  mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_GET["proj_id"]);

		$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT project_name, project_desc, project_url FROM projects WHERE project_id = ".$project_id);
		$row = mysqli_fetch_array($result);
		$proj_name = $row['project_name'];

		$proj_name = str_replace(" ", "_", $proj_name);
		$proj_name = str_replace('"', "", $proj_name);
		$proj_name = str_replace("'", "", $proj_name);
		$proj_name = str_replace('.', "", $proj_name);
		$proj_name = str_replace('/', "", $proj_name);
		$proj_name = str_replace('\\', "", $proj_name);
		$proj_name = str_replace(':', "", $proj_name);
		$proj_name = str_replace('$', "", $proj_name);
		$proj_name = str_replace('%', "", $proj_name);
		$proj_name = str_replace('&', "", $proj_name);

		$now = gmdate("D, d M Y H:i:s");
		header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
		header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
		header("Last-Modified: {$now} GMT");
		header("Content-Type: application/force-download");
		header("Content-Type: application/octet-stream");
		header("Content-Type: application/download");
		header("Content-Disposition: attachment;filename=project_bom_".$proj_name.".csv");
		header("Content-Transfer-Encoding: binary");

		$out = fopen('php://output', 'w');

		include('include/include_proj_show.php');

		fwrite($out, '"NAME","CATEGORY","MANUFACTURER","PACKAGE","QTY","BIN#"');
		fwrite($out, "\r\n");

		$ProjectShowComponents = new ProjectShow;
		$ProjectShowComponents->ProjectShowComponentsBOM($out, $project_id);

		fclose($out);
	}
?>
