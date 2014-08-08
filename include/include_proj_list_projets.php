<?php
class Proj {
	public function ProjList() {

		require_once('login/auth.php');
		include('mysql_connect.php');


		$owner_sql = "";
		$public_only = " and project_public = 1 ";
		$owner = null;

		if(isset($_SESSION['SESS_MEMBER_ID']) == true)
		{
			$public_only = "";
			$owner = $_SESSION['SESS_MEMBER_ID'];
			$owner_sql = "project_owner = ".$owner." and";
		}

		if(isset($_GET['by'])) {

			$by			=	strip_tags(mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_GET["by"]));
			$order_q	=	strip_tags(mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_GET["order"]));

			if($order_q == 'desc' or $order_q == 'asc')
			{
				$order = $order_q;
			}
			else
			{
				$order = 'asc';
			}

			if($by == 'name')
			{
				$GetDataComponentsAll = "SELECT projects.*, members.login login, members.currency currency FROM projects, members WHERE ".$owner_sql." project_owner = member_id ".$public_only." ORDER by project_name ".$order."";
			}
			else
			{
				$GetDataComponentsAll = "SELECT projects.*, members.login login, members.currency currency FROM projects, members WHERE ".$owner_sql." project_owner = member_id ".$public_only." ORDER by project_name ASC";
			}
		}
		else
		{
			$GetDataComponentsAll = "SELECT projects.*, members.login login, members.currency currency FROM projects, members WHERE ".$owner_sql." project_owner = member_id ".$public_only." ORDER by project_name ASC";
		}

		$sql_exec = mysqli_query($GLOBALS["___mysqli_ston"],$GetDataComponentsAll);

		while($showDetails = mysqli_fetch_array($sql_exec)) {
			echo "<tr>";

				if(isset($_SESSION['SESS_MEMBER_ID']) == true)
				{
					echo '<td class="edit"><a href="proj_edit.php?proj_id=';
					echo $showDetails['project_id'];
					echo '"><span class="icon medium pencil"></span></a></td>';
				}
				else
				{
					echo '<td></td>';
				}

				echo '<td>';
					echo '<a href="proj_show.php?proj_id=';
					echo $showDetails['project_id'];
					echo '">';
					echo $showDetails['project_name'];
					echo '</a>';
				echo '</td>';

				echo "<td>";
					$components = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT (SELECT count(*) FROM projects_data p WHERE p.projects_data_project_id = ".$showDetails['project_id'].") count, (SELECT sum(projects_data_quantity) FROM projects_data p WHERE p.projects_data_project_id = ".$showDetails['project_id'].") qty, min(d.quantity div p.projects_data_quantity) as kits FROM projects_data p, data d WHERE p.projects_data_project_id = ".$showDetails['project_id']." and d.id = p.projects_data_component_id");
					$compDetails = mysqli_fetch_array($components);
					if($compDetails['count'] == 0)
					{
						echo '-';
					}
					else
					{
						echo $compDetails['count'];
					}
				echo "</td>";

				echo "<td>";
					if($compDetails['qty'] == 0)
					{
						echo '-';
					}
					else
					{
						echo $compDetails['qty'];
					}
				echo "</td>";

				echo "<td>";
					if($compDetails['kits'] == 0)
					{
						echo '-';
					}
					else
					{
						echo $compDetails['kits'];
					}
				echo "</td>";


				echo '<td>';
					//$GetDataPrice = "SELECT SUM(total) FROM (SELECT projects_data_quantity * price AS total FROM projects_data JOIN `data` WHERE data.id = projects_data_component_id AND projects_data_project_id = ".$showDetails['project_id'].") AS project_total";
					$GetDataPrice = "SELECT sum(total) as total, m.currency FROM (SELECT cast(price as decimal(14, 2)) * projects_data_quantity AS total FROM projects_data JOIN `data` WHERE data.id = projects_data_component_id AND projects_data_project_id = ".$showDetails['project_id'].") AS project_total, projects p, members m where m.member_id = p.project_owner and p.project_id = ".$showDetails['project_id']." group by m.currency";
					$sql_exec_price = mysqli_query($GLOBALS["___mysqli_ston"], $GetDataPrice);

					while($showPrice = mysqli_fetch_array($sql_exec_price))
					{
						if ($showPrice['total'] == 0)
						{
							echo "-";
						}
						else
						{
							echo $showPrice['total'];
							echo ' ';
							echo $showDetails['currency'];
						}
					}
				echo '</td>';

				echo '<td>';
				echo $showDetails['project_public'] == 0 ? 'No' : 'Yes';
				echo '</td>';

				echo '<td>'.$showDetails['login'].'</td>';

			echo "</tr>";
		}
	}
}
?>
