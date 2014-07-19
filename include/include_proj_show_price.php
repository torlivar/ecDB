<?php
class ProjectShowPrice
{
	public function ProjectSumTotal()
	{

		include('mysql_connect.php');

		$project_id = (int)$_GET["proj_id"];

		$GetDataPrice = "SELECT total, m.currency, m.login FROM (SELECT projects_data_quantity * price AS total FROM projects_data JOIN `data` WHERE data.id = projects_data_component_id AND projects_data_project_id = ".$project_id.") AS project_total, projects p, members m where m.member_id = p.project_owner group by total, m.currency, m.login";
		$sql_exec_price = mysql_Query($GetDataPrice) or die(mysql_error());

		while($showPrice = mysql_fetch_array($sql_exec_price))
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
