<?php
class Users
{
	public function UsersList()
	{
		require_once('login/auth.php');
		include('mysql_connect.php');

		$by = strip_tags(mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_GET["by"]));
		$order_q = strip_tags(mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_GET["order"]));

		if($order_q == 'desc' or $order_q == 'asc')
		{
			$order = $order_q;
		}
		else
		{
			$order = 'asc';
		}


		$qry = "select * from (select m.firstname, m.lastname, m.login, m.mail, m.admin, m.reg_date, mt.members_stats_time  from members m, members_stats mt where mt.members_stats_member = m.member_id order by members_stats_time desc) as xx group by login order by ";

		if($by == 'firstname' or $by == 'lastname' or $by == 'login' )
		{
			$qry .= $by." ".$order;
		}
		elseif($by == 'email')
		{
			$by = 'mail';
			$qry .= $by." ".$order;
		}
		elseif($by == 'admin')
		{
			$by = "admin +0";
			$qry .= $by." ".$order;
		}
		elseif($by == 'dreg')
		{
			$by = 'reg_date';
			$qry .= $by." ".$order;
		}
		elseif($by == 'dllogin')
		{
			$by = 'members_stats_time';
			$qry .= $by." ".$order;
		}
		else
		{
			$by = "lastname";
			$qry .= $by." ".$order;
		}

		$sql_exec = mysqli_query($GLOBALS["___mysqli_ston"], $qry);

		while($showDetails = mysqli_fetch_array($sql_exec))
		{
			echo "<tr>";

			echo "<td class='componentCol'>";
			echo $showDetails['firstname'];
			echo "</td>";

			echo "<td class='componentCol'>";
			echo $showDetails['lastname'];
			echo "</td>";

			echo "<td>";
			echo $showDetails['login'];
			echo "</td>";

			echo "<td>";
			echo $showDetails['mail'];
			echo "</td>";

			echo "<td>";
			$admin = $showDetails['admin'];
			if ($admin == "0"){
				echo '<span class="icon medium checkboxUnchecked"></span>';
			}
			else{
				echo '<span class="icon medium checkboxChecked"></span>';
			}
			echo "</td>";

			echo "<td>";
			echo $showDetails['reg_date'];
			echo "</td>";

			echo "<td>";
			echo $showDetails['members_stats_time'];
			echo "</td>";

			echo "</tr>";
		}
	}
}
?>
