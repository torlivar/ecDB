<?php
require_once "../mysql_connect.php";

$q = strtolower($_GET["q"]);
if (!$q) return;
$owner = $_GET['memberID'];
if(!$owner) return;

$sql = "select DISTINCT name as name from data where name LIKE '%$q%' and owner='".$owner."' ORDER by name ASC";
$rsd = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
while($rs = mysqli_fetch_array($rsd))
{
	$cname = $rs['name'];
	echo "$cname\n";
}
?>
