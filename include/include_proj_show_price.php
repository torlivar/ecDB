<?php
class ProjectShowPrice
{
	public function ProjectSumTotal()
	{

		include('mysql_connect.php');

		$project_id = (int)$_GET["proj_id"];

		$GetDataPrice = "SELECT sum(total) as total, m.currency FROM (SELECT cast(price as decimal(14, 2)) * projects_data_quantity AS total FROM projects_data JOIN `data` WHERE data.id = projects_data_component_id AND projects_data_project_id = ".$project_id.") AS project_total, projects p, members m where m.member_id = p.project_owner and p.project_id = ".$project_id." group by m.currency";
		$sql_exec_price = mysqli_query($GLOBALS["___mysqli_ston"], $GetDataPrice) or die(((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));

		while($showPrice = mysqli_fetch_array($sql_exec_price))
		{
			if ($showPrice['total'] == 0){
				echo "0 ";
				echo ' ';
				echo $showPrice['currency'];
			}
			else{
				echo $showPrice['total'];
				echo ' ';
				echo $showPrice['currency'];
			}
		}
	}
}
?>
