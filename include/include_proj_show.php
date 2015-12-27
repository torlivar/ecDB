<?php
class ProjectShow {
	public function ProjectShowComponents()
	{
		require_once('login/auth.php');
		include('mysql_connect.php');

		$project_id = (int)mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_GET["proj_id"]);

		$project_owner_idRow = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT project_owner FROM projects WHERE project_id = ".$project_id."");
		$project_owner_id = mysqli_fetch_assoc($project_owner_idRow);
		$project_owner_id = $project_owner_id['project_owner'];

		$qry = "SELECT pd.*, d.*, sc.subcategory, c.name as nx FROM projects_data pd, data d, category_sub sc, category c WHERE d.category = sc.id and c.id = sc.category_id and pd.projects_data_component_id = d.id AND pd.projects_data_project_id = ".$project_id." ORDER by ";

		if(isset($_GET['by']))
		{
			$by			=	strip_tags(mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_GET["by"]));
			$order_q	=	strip_tags(mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_GET["order"]));

			if($order_q == 'desc' or $order_q == 'asc'){
				$order = $order_q;
			}
			else{
				$order = 'asc';
			}

			if($by == 'price' or $by == 'order_quantity')
			{
				$GetDataComponentsAll = $qry." ".$by." +0 ".$order."";
			}
			elseif($by == 'quantity')
			{
				$GetDataComponentsAll = $qry." projects_data_quantity +0 ".$order."";
			}
			elseif($by == 'stock_quantity')
			{
				$GetDataComponentsAll = $qry." quantity +0 ".$order."";
			}
			elseif($by == 'category')
			{
				$GetDataComponentsAll = $qry." c.name ".$order.", sc.subcategory ".$order."";
			}
			elseif($by == 'name')
			{
				$GetDataComponentsAll = $qry." d.name ".$order."";
			}
			elseif($by == 'manufacturer' or $by =='package' or $by =='smd')
			{
				$GetDataComponentsAll = $qry." ".$by." ".$order."";
			}
			else
			{
				$GetDataComponentsAll = $qry." d.name ASC";
			}
		}
		else
		{
			$GetDataComponentsAll = $qry." d.name ASC";
		}

		$sql_exec = mysqli_query($GLOBALS["___mysqli_ston"], $GetDataComponentsAll);
		while($showDetails = mysqli_fetch_array($sql_exec))
		{
			echo "<tr>";

			if(isset($_SESSION['SESS_MEMBER_ID']) == true)
			{
				echo '<td class="edit"><a href="edit_component.php?edit=';
				echo $showDetails['id'];
				echo '"><span class="icon medium pencil"></span></a></td>';

				echo '<td><a href="component.php?view=';
				echo $showDetails['id'];
				echo '">';

				echo $showDetails['name'];
				echo "</a></td>";
			}
			else
			{
				echo '<td></td>';
				echo '<td>'.$showDetails['name'].'</td>';
			}

			echo "<td class='componentCol'>";
			echo $showDetails['nx']." / ".$showDetails['subcategory'];
			echo "</td>";

			echo "<td>";
			$manufacturer = $showDetails['manufacturer'];
			if ($manufacturer == ""){
				echo "-";
			}
			else{
				echo $manufacturer;
			}
			echo "</td>";

			echo "<td>";
			$package = $showDetails['package'];
			if ($package == ""){
				echo "-";
			}
			else{
				echo $package;
			}
			echo "</td>";

			echo "<td>";
			$smd = $showDetails['smd'];
			if ($smd == "No"){
				echo '<span class="icon medium checkboxUnchecked"></span>';
			}
			else{
				echo '<span class="icon medium checkboxChecked"></span>';
			}
			echo "</td>";

			echo "<td class='priceCol'>";
			$price = $showDetails['price'];
			if ($price == ""){
				echo "-";
			}
			else{
				echo $price;
			}
			echo "</td>";

			echo "<td>";
			$quantity = $showDetails['quantity'];
			if ($quantity == ""){
				echo "-";
			}
			else{
				echo $quantity;
			}
			echo "</td>";

			echo "<td>";
			$quantity = $showDetails['order_quantity'];
			if ($quantity == "")
			{
				echo "-";
			}
			else
			{
				echo $quantity;
			}
			echo "</td>";


			echo "<td>";

			$quantity = $showDetails['projects_data_quantity'];
			if ($quantity == "")
			{
				echo "-";
			}
			else
			{
				echo $quantity;
			}
			echo "</td>";

			if(isset($_SESSION['SESS_MEMBER_ID']) && trim($_SESSION['SESS_MEMBER_ID']) == $project_owner_id )
			{
				echo "<td>";
					$bin_location = $showDetails['bin_location'];
					if ($bin_location == ""){
						echo "-";
					}
					else{
						echo $bin_location;
					}
				echo "</td>";
			}

			echo "</tr>";
		}
	}



	public function ProjectShowComponentsBOM($out, $project_id)
	{
		//require_once('login/auth.php');
		//include('mysql_connect.php');
		$GetDataComponentsAll = "SELECT * FROM projects_data, data WHERE projects_data.projects_data_component_id = data.id AND projects_data.projects_data_project_id = ".$project_id." ORDER by name ASC";

		$sql_exec = mysqli_query($GLOBALS["___mysqli_ston"], $GetDataComponentsAll);
		while($showDetails = mysqli_fetch_array($sql_exec))
		{
			$arr = array();

			$arr[] = $showDetails['name'];

			$sql_exec_catname = mysqli_query($GLOBALS["___mysqli_ston"], "select c.name h, c.id cid, cs.subcategory s, cs.id csid from category c, category_sub cs where c.id = cs.category_id and cs.id = ".$showDetails['category']."");
			$showDetailsCat = mysqli_fetch_array($sql_exec_catname);
			$catname = $showDetailsCat['h'];

			$arr[] = $showDetailsCat['h']." / ".$showDetailsCat['s'];
			$arr[] = $showDetails['manufacturer'];
			$arr[] = $showDetails['package'];
			$arr[] = $showDetails['projects_data_quantity'];
			$arr[] = $showDetails['bin_location'];

			//fputcsv($out, $arr, ",", "\"");
			$first = 0;

			foreach ($arr as $fields)
			{
				if($first > 0)
					fwrite($out, ",");

				$first += 1;

				fwrite($out, '"'.str_replace('"', '""', $fields).'"');
			}
			fwrite($out, "\r\n");

		}
	}
}
?>
