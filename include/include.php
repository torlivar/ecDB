<?php
class ShowComponents {
	public function Index()
	{
		require_once('login/auth.php');
		include('mysql_connect.php');

		$owner = $_SESSION['SESS_MEMBER_ID'];
        $whereclause = "";
        if (!$_SESSION['SEE_FROM_ALL']) $whereclause = "WHERE owner = ".$owner;
		//$qry = "SELECT id, name, category, package, pins, datasheet, url1, smd, price, quantity, comment, bin_location FROM data WHERE owner = ".$owner." ORDER by ";
		$qry = "SELECT d.id, d.name, d.category, d.package, d.pins, d.datasheet, d.url1, d.smd, d.price, d.quantity, d.comment, d.bin_location, c.`name` as nx, sc.subcategory as snx, sc.category_id as scid, CONCAT(m.firstname, ' ', m.lastname) as ownername FROM data d left join category_sub sc on d.category = sc.id left join category c on c.id = sc.category_id left join members m on d.owner = m.member_id ".$whereclause." ORDER by ";

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

			if($by == 'price' or $by == 'pins' or $by == 'quantity')
			{
				$GetDataComponentsAll = $qry.$by." +0 ".$order."";
			}
			elseif($by == 'category')
			{
				$GetDataComponentsAll = $qry." nx ".$order.", snx ".$order;
			}
			elseif($by == 'name' or $by =='package' or $by =='smd')
			{
				$GetDataComponentsAll = $qry.$by." ".$order."";
			}
            elseif($by == 'owner')
            {
                $GetDataComponentsAll = $qry." ownername ".$order."";
            }
			else
			{
				$GetDataComponentsAll = $qry." name ASC";
			}
		}
		else
		{
			$GetDataComponentsAll = $qry." name ASC";
		}

		$sql_exec = mysqli_query($GLOBALS["___mysqli_ston"], $GetDataComponentsAll);
		while($showDetails = mysqli_fetch_array($sql_exec))
		{
			echo "<tr>";

			echo '<td class="edit">';
			if ($owner === $_SESSION['SESS_MEMBER_ID'])
			{
				echo '<a href="edit_component.php?edit='.$showDetails['id'].'"><span class="icon medium pencil"></span></a>';
			}
			else
			{
				echo '&nbsp;';
			}
			echo '</td>';

			echo '<td><a href="component.php?view=';
			echo $showDetails['id'];
			echo '">';

			echo $showDetails['name'];
			echo "</a></td>";
            if ($_SESSION['SEE_FROM_ALL']){
                echo '<td class="componentOwner">';
                echo $showDetails['ownername'];
                echo '</td>';
                
            }

			echo "<td class='componentCol'>";
			echo "<a href='category.php?cat=".$showDetails['scid']."'>".$showDetails['nx']." / ".$showDetails['snx']."</a>";
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
				$pins = $showDetails['pins'];
				if ($pins == ""){
					echo "-";
				}
				else{
					echo $pins;
				}
			echo "</td>";

			echo '<td>';
				$image = $showDetails['url1'];
				if ($image==""){
					echo "-";
				}
				else
				{
					echo '<a class="thumbnail" href="';
					echo $image;
					echo '"><span class="icon medium picture"></span><span class="imgB"><img src="';
					echo $image;
					echo '" /></span></a></td>';
				}

			echo '<td>';
				$datasheet = $showDetails['datasheet'];
				if ($datasheet==""){
					echo "-";
				}
				else{
					echo '<a href="';
					echo $datasheet;
					echo '"  target="_blank"><span class="icon medium document"></span></a></td>';
				}

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
				echo '<td>';
				$bin_location = $showDetails['bin_location'];
				if ($bin_location == "")
				{
					echo "-";
				}
				else
				{
					echo $bin_location;
				}
				echo '</td>';

				$comment = $showDetails['comment'];
				if ($comment==""){
					echo '<td class="comment"><div>';
					echo "-";
					echo '</span></div></td>';
				}
				else{
					echo '<td class="comment"><div><span class="icon medium spechBubbleSq"></span><span class="comment">';
					echo nl2br($showDetails['comment']);
					echo '</span></div></td>';
				}
			echo "</tr>";
		}
	}

	public function Category()
	{
		require_once('include/login/auth.php');
		include('include/mysql_connect.php');

		$owner = $_SESSION['SESS_MEMBER_ID'];

		if(isset($_GET['cat']))
		{
			$cat = (int)$_GET['cat'];

			$CategoryName = "SELECT * FROM category_sub WHERE category_id = ".$cat."";
			$sql_exec_catname = mysqli_query($GLOBALS["___mysqli_ston"], $CategoryName);

            $ownerclause = "";
			if (!$_SESSION['SEE_FROM_ALL']) $ownerclause = " AND owner = ".$owner;
            $ccquery = "SELECT d.id, d.name, d.category, d.package, d.pins, d.datasheet, d.url1, d.smd, d.price, d.quantity, d.comment, d.bin_location, CONCAT(m.firstname, ' ', m.lastname) as ownername FROM data d left join category_sub c on d.category = c.id left join members m on d.owner = m.member_id where c.category_id = ".$cat.$ownerclause;
                
            
            if(isset($_GET['by'])) {

				$by			=	strip_tags(mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_GET["by"]));
				$order_q	=	strip_tags(mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_GET["order"]));

				if($order_q == 'desc' or $order_q == 'asc') {
					$order = $order_q;
				}
				else {
					$order = 'asc';
				}
                
                if($by == 'price' or $by == 'pins' or $by == 'quantity')
				{
					$ComponentsCategory = "".$ccquery." ORDER by ".$by." +0 ".$order."";
				}
				elseif($by == 'name' or $by == 'category' or $by =='package' or $by =='smd')
				{
					$ComponentsCategory = "".$ccquery." ORDER by ".$by." ".$order."";
                }
                elseif($by == 'owner') {
                    $ComponentsCategory = "".$ccquery." ORDER by ownername ".$order."";
                }
				else
				{
					$ComponentsCategory = "".$ccquery." ORDER by name ASC";
				}
			}
			else
			{
				$ComponentsCategory = "".$ccquery." ORDER by name ASC";
			}

			$sql_exec_component = mysqli_query($GLOBALS["___mysqli_ston"], $ComponentsCategory);

			while ($showDetails = mysqli_fetch_array($sql_exec_component)) {
				echo "<tr>";

				echo '<td class="edit">';
				if ($owner === $_SESSION['SESS_MEMBER_ID'])
				{
					echo '<a href="edit_component.php?edit='.$showDetails['id'].'"><span class="icon medium pencil"></span></a>';
				}
				else
				{
					echo '&nbsp;';
				}
				echo '</td>';

				echo '<td><a href="component.php?view=';
				echo $showDetails['id'];
				echo '">';
				echo $showDetails['name'];
				echo "</a></td>";
                    
                if ($_SESSION['SEE_FROM_ALL']){
                    echo '<td class="componentOwner">';
                    echo $showDetails['ownername'];
                    echo '</td>';                
                }
                    
				echo "<td>";
				$subcatid = $showDetails['category'];

				$CategoryName = "SELECT * FROM category_sub WHERE id = ".$subcatid."";
				$sql_exec_catname = mysqli_query($GLOBALS["___mysqli_ston"], $CategoryName);

				while($showDetailsCat = mysqli_fetch_array($sql_exec_catname)) {
					$catname = $showDetailsCat['subcategory'];
				}

				echo "<a href='category.php?subcat=$subcatid'>$catname</a>";
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
				$pins = $showDetails['pins'];
					if ($pins == ""){
						echo "-";
					}
					else{
						echo $pins;
					}
				echo "</td>";

				echo '<td>';
				$image = $showDetails['url1'];
				if ($image==""){
					echo "-";
				}
				else{
					echo '<a class="thumbnail" href="';
					echo $image;
					echo '"><span class="icon medium picture"></span><span class="imgB"><img src="';
					echo $image;
					echo '" /></span></a></td>';
				}

				echo '<td>';
				$datasheet = $showDetails['datasheet'];
				if ($datasheet==""){
					echo "-";
				}
				else{
					echo '<a href="';
					echo $datasheet;
					echo '" target="_blank"><span class="icon medium document"></span></a></td>';
				}

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

				echo '<td>';
				$bin_location = $showDetails['bin_location'];
				if ($bin_location == "")
				{
					echo "-";
				}
				else
				{
					echo $bin_location;
				}
				echo '</td>';

				$comment = $showDetails['comment'];
				if ($comment == ""){
					echo '<td class="comment"><div>';
					echo "-";
					echo '</span></div></td>';
				}
				else{
					echo '<td class="comment"><div><span class="icon medium spechBubbleSq"></span><span class="comment">';
					echo $showDetails['comment'];
					echo '</span></div></td>';
				}
				echo "</tr>";
			}
		}


		if(isset($_GET['subcat']))
		{
			$subcat = (int)$_GET['subcat'];

			$CategoryName = "SELECT * FROM category_sub WHERE id = ".$subcat."";
			$sql_exec_catname = mysqli_query($GLOBALS["___mysqli_ston"], $CategoryName);

            $ownerclause = "";
			if (!$_SESSION['SEE_FROM_ALL']) $ownerclause = " AND owner = ".$owner;
            $scquery = "SELECT d.id, d.name, d.category, d.package, d.pins, d.datasheet, d.url1, d.smd, d.price, d.quantity, d.comment, d.bin_location, CONCAT(m.firstname, ' ', m.lastname) as ownername FROM data d left join category_sub c on d.category = c.id left join members m on d.owner = m.member_id WHERE c.id = ".$subcat.$ownerclause;
            
			if(isset($_GET['by'])) {

				$by			=	strip_tags(mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_GET["by"]));
				$order_q	=	strip_tags(mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_GET["order"]));

				if($order_q == 'desc' or $order_q == 'asc') {
					$order = $order_q;
				}
				else {
					$order = 'asc';
				}

				if($by == 'price' or $by == 'pins' or $by == 'quantity') {
					$ComponentsCategory = $scquery." ORDER by ".$by." +0 ".$order."";
				}
				elseif($by == 'name' or $by == 'category' or $by =='package' or $by =='smd') {
					$ComponentsCategory = $scquery." ORDER by ".$by." ".$order."";
				}
                elseif($by == 'owner') {
                    $ComponentsCategory = $scquery." ORDER by ownername ".$order."";
                }
				else {
					$ComponentsCategory = $scquery." ORDER by name ASC";
				}
			}
			else {
				$ComponentsCategory = $scquery." ORDER by name ASC";
			}

			$sql_exec_component = mysqli_query($GLOBALS["___mysqli_ston"], $ComponentsCategory);

			while ($showDetails = mysqli_fetch_array($sql_exec_component)) {
				echo "<tr>";

				echo '<td class="edit">';
				if ($owner === $_SESSION['SESS_MEMBER_ID'])
				{
					echo '<a href="edit_component.php?edit='.$showDetails['id'].'"><span class="icon medium pencil"></span></a>';
				}
				else
				{
					echo '&nbsp;';
				}
				echo '</td>';

				echo '<td><a href="component.php?view=';
				echo $showDetails['id'];
				echo '">';
				echo $showDetails['name'];
				echo "</a></td>";

                if ($_SESSION['SEE_FROM_ALL']){
                    echo '<td class="componentOwner">';
                    echo $showDetails['ownername'];
                    echo '</td>';                
                }

				echo "<td>";
					while($showDetailsCat = mysqli_fetch_array($sql_exec_catname)) {
						$catname = $showDetailsCat['subcategory'];
					}
					echo $catname;
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
				$pins = $showDetails['pins'];
					if ($pins == ""){
						echo "-";
					}
					else{
						echo $pins;
					}
				echo "</td>";

				echo '<td>';
				$image = $showDetails['url1'];
				if ($image==""){
					echo "-";
				}
				else{
					echo '<a class="thumbnail" href="';
					echo $image;
					echo '"><img src="img/picture.png" /><span class="imgB"><img src="';
					echo $image;
					echo '" /></span></a></td>';
				}

				echo '<td>';
				$datasheet = $showDetails['datasheet'];
				if ($datasheet==""){
					echo "-";
				}
				else{
					echo '<a href="';
					echo $datasheet;
					echo '" target="_blank"><img src="img/document.png" alt="Download PDF"/></a></td>';
				}

				echo "<td>";
				$smd = $showDetails['smd'];
					if ($smd == "No"){
						echo '<img src="img/checkbox_unchecked.png">';
					}
					else{
						echo '<img src="img/checkbox_checked.png">';
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

				echo '<td>';
				$bin_location = $showDetails['bin_location'];
				if ($bin_location == "")
				{
					echo "-";
				}
				else
				{
					echo $bin_location;
				}
				echo '</td>';

				$comment = $showDetails['comment'];
				if ($comment == ""){
					echo '<td class="comment"><div>';
					echo "-";
					echo '</span></div></td>';
				}
				else{
					echo '<td class="comment"><div><span class="icon medium spechBubbleSq"></span><span class="comment">';
					echo $showDetails['comment'];
					echo '</span></div></td>';
				}
				echo "</tr>";
			}
		}
	}

	public function Search()
	{

		if(isset($_GET['q']))
		{
			require_once('include/login/auth.php');
			include('include/mysql_connect.php');

			$owner = $_SESSION['SESS_MEMBER_ID'];

			$query = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_GET['q']);
			$query1 = strtoupper($query);
			$query2 = strip_tags($query1);
			$find = trim($query2);


			if ($find == "") {
				echo '<div class="message red">';
					echo "You forgot to enter a search term.";
				echo '</div>';
			}
			else {


				if (isset($_GET['by'])){
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

					if($by == 'price' or $by == 'pins' or $by == 'quantity')
					{
						$SearchQuery = "SELECT * FROM data WHERE (name LIKE'%$find%' OR package LIKE'%$find%' OR manufacturer LIKE'%$find%' OR pins LIKE'%$find%' OR location LIKE'%$find%' OR comment LIKE'%$find%') AND owner = $owner ORDER by $by +0 $order";
					}
					elseif($by == 'name' or $by == 'category' or $by =='package' or $by =='smd' or $by =='manufacturer') {
						$SearchQuery = "SELECT * FROM data WHERE (name LIKE'%$find%' OR package LIKE'%$find%' OR manufacturer LIKE'%$find%' OR pins LIKE'%$find%' OR location LIKE'%$find%' OR comment LIKE'%$find%') AND owner = $owner ORDER by $by $order";
					}
					else
					{
						$SearchQuery = "SELECT * FROM data WHERE (name LIKE'%$find%' OR package LIKE'%$find%' OR manufacturer LIKE'%$find%' OR pins LIKE'%$find%' OR location LIKE'%$find%' OR comment LIKE'%$find%') AND owner = $owner ORDER by name ASC";
					}
				}
				else
				{
					$SearchQuery = "SELECT * FROM data WHERE (name LIKE'%$find%' OR package LIKE'%$find%' OR manufacturer LIKE'%$find%' OR pins LIKE'%$find%' OR location LIKE'%$find%' OR comment LIKE'%$find%') AND owner = $owner ORDER by name ASC";
				}

				$sql_exec = mysqli_query($GLOBALS["___mysqli_ston"], $SearchQuery);
				$anymatches = mysqli_num_rows($sql_exec);
				if ($anymatches == 0) {
					echo '<div class="message red">';
						echo "Sorry, but we can not find an entry to match your query.";
					echo '</div>';
				}

				while($showDetails = mysqli_fetch_array($sql_exec)) {
					echo "<tr>";

					echo '<td class="edit">';
					if ($owner === $_SESSION['SESS_MEMBER_ID'])
					{
						echo '<a href="edit_component.php?edit='.$showDetails['id'].'"><span class="icon medium pencil"></span></a>';
					}
					else
					{
						echo '&nbsp;';
					}
					echo '</td>';

					echo '<td><a href="component.php?view=';
					echo $showDetails['id'];
					echo '">';

					echo $showDetails['name'];
					echo "</a></td>";

					echo "<td>";
						$head_cat_id = $showDetails['category'];

						$CategoryName = "select c.name h, c.id cid, cs.subcategory s, cs.id csid from category c, category_sub cs where c.id = cs.category_id and cs.id = ".$head_cat_id."";
						//$CategoryName = "SELECT * FROM category_head WHERE id = ".$head_cat_id."";
						$sql_exec_catname = mysqli_query($GLOBALS["___mysqli_ston"], $CategoryName);

						while($showDetailsCat = mysqli_fetch_array($sql_exec_catname))
						{
							$catname = $showDetailsCat['h'];
						}

					echo $catname;
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
					$pins = $showDetails['pins'];
						if ($pins == ""){
							echo "-";
						}
						else{
							echo $pins;
						}
					echo "</td>";

					echo '<td>';
					$image = $showDetails['url1'];
					if ($image==""){
						echo "-";
					}

					else{
						echo '<a class="thumbnail" href="';
						echo $image;
						echo '"><span class="icon medium picture"></span><span class="imgB"><img src="';
						echo $image;
						echo '" /></span></a></td>';
					}

					echo '<td>';
					$datasheet = $showDetails['datasheet'];
					if ($datasheet==""){
						echo "-";
					}
					else{
						echo '<a href="';
						echo $datasheet;
						echo ' target="_blank""><span class="icon medium document"></span></a></td>';
					}

					echo "<td>";
					$smd = $showDetails['smd'];
						if ($smd == "No"){
							echo '<img src="img/checkbox_unchecked.png">';
						}
						else{
							echo '<img src="img/checkbox_checked.png">';
						}
					echo "</td>";

					echo "<td  class='priceCol'>";
					$price = $showDetails['price'];
						if ($price == ""){
							echo "-";
						}
						else{
							echo $price;
						}
					echo "</td>";

					echo "<td>";
					echo $showDetails['quantity'];
					echo "</td>";

					$comment = $showDetails['comment'];
					if ($comment == ""){
						echo '<td class="comment"><div>';
						echo "-";
						echo '</span></div></td>';
					}
					else{
						echo '<td class="comment"><div><span class="icon medium spechBubbleSq"></span><span class="comment">';
						echo $showDetails['comment'];
						echo '</span></div></td>';
					}
					echo "</tr>";
				}
			}
		}
	}
	public function Add() {

		require_once('include/login/auth.php');
		include('include/mysql_connect.php');

		if(isset($_POST['submit']) or isset($_POST['update'])) {
			$owner				=	$_SESSION['SESS_MEMBER_ID'];

			if (empty($_GET['edit'])) {
				$id				=	'';
			}
			else{
				$id				= 	(int)$_GET['edit'];
			}

			if (empty($_POST['name'])) {
				$name = '';
			}
			else{
				$name			=	strip_tags( mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['name']));
			}

			if (empty($_POST['quantity'])) {
				$quantity = 0;
			}
			else{
				$quantity			=	str_replace(',', '.', strip_tags( mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['quantity'])));
			}

			if (empty($_POST['category'])) {
				$category = '';
			}
			else{
				$category		=	strip_tags( mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['category']));
			}

			if (empty($_POST['project'])) {
				$project = '';
			}
			else{
				$project		=	strip_tags(mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['project']));
			}

			$comment			=	strip_tags( mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['comment']));
			$order_quantity		=	str_replace(',', '.', strip_tags( mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['orderquant'])));
			$project_quantity	=	str_replace(',', '.', strip_tags( mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['projquant'])));
			$price				=	str_replace(',', '.', strip_tags( mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['price'])));
			$location			=	strip_tags( mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['bin_location']));
			$manufacturer		=	strip_tags( mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['manufacturer']));
			$package			=	strip_tags( mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['package']));
			$pins				=	str_replace(',', '.', strip_tags( mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['pins'])));
			$scrap				=	strip_tags( mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['scrap']));
			$smd				=	strip_tags( mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['smd']));
			$width				=	str_replace(',', '.', strip_tags( mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['width'])));
			$height				=	str_replace(',', '.', strip_tags( mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['height'])));
			$depth				=	str_replace(',', '.', strip_tags( mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['depth'])));
			$weight				=	str_replace(',', '.', strip_tags( mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['weight'])));
			$datasheet			=	strip_tags( mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['datasheet']));
			$url1				=	strip_tags( mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['url1']));
			$url2				=	strip_tags( mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['url2']));
			$url3				=	strip_tags( mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['url3']));
			$url4				=	strip_tags( mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['url4']));

			$bin_location		=	strip_tags( mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['bin_location']));



			if ($name == '') {
				echo '<div class="message red">';
				echo 'You have to specify a name!';
				echo '</div>';
			}
			elseif ($category == '') {
				echo '<div class="message red">';
				echo 'You have to choose a category!';
				echo '</div>';
			}
			elseif (!empty($project_quantity) && empty($project)) {
				echo '<div class="message red">';
				echo 'You have to choose a project!';
				echo '</div>';
			}
			elseif (!empty($project) && empty($project_quantity)) {
				echo '<div class="message red">';
				echo 'You have to specify a quantity for this component to add to the project!';
				echo '</div>';
			}
			elseif (strlen($comment) >= 2500) {
				echo '<div class="message red">';
				echo 'Max 2500 characters in the comment!';
				echo '</div>';
			}
			elseif (!empty($_POST['quantity']) && !is_numeric($quantity)) {
				echo '<div class="message red">';
				echo 'The quantity must only be a number!';
				echo '</div>';
			}
			elseif (!empty($_POST['pins']) && !is_numeric($pins)) {
				echo '<div class="message red">';
				echo 'The pin-count must only be a number!';
				echo '</div>';
			}
			elseif (!empty($_POST['price']) && !is_numeric($price)) {
				echo '<div class="message red">';
				echo 'The price must only be a number!';
				echo '</div>';
			}
			elseif (!empty($_POST['orderquant']) && !is_numeric($order_quantity)) {
				echo '<div class="message red">';
				echo 'The order quantity must only be a number!';
				echo '</div>';
			}
			elseif (!empty($_POST['weight']) && !is_numeric($weight)) {
				echo '<div class="message red">';
				echo 'The weight must only be a number!';
				echo '</div>';
			}
			elseif (!empty($_POST['width']) && !is_numeric($width)) {
				echo '<div class="message red">';
				echo 'The width must only be a number!';
				echo '</div>';
			}
			elseif (!empty($_POST['depth']) && !is_numeric($depth)) {
				echo '<div class="message red">';
				echo 'The depth must only be a number!';
				echo '</div>';
			}
			elseif (!empty($_POST['height']) && !is_numeric($height)) {
				echo '<div class="message red">';
				echo 'The height must only be a number!';
				echo '</div>';
			}
			else {
				if(isset($_POST['submit'])) {
					$sql="INSERT into data (owner, name, manufacturer, package, pins, smd, quantity, location, scrap, width, height, depth, weight, datasheet, comment, category, url1, url2, url3, url4, price, order_quantity, bin_location)
					VALUES
					('$owner', '$name', '$manufacturer', '$package', '$pins', '$smd', '$quantity', '$location', '$scrap', '$width', '$height', '$depth', '$weight', '$datasheet', '$comment', '$category', '$url1', '$url2', '$url3', '$url4', '$price', '$order_quantity', '$bin_location')";

					$sql_exec = mysqli_query($GLOBALS["___mysqli_ston"], $sql) or die(((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
					$component_id = ((is_null($___mysqli_res = mysqli_insert_id($GLOBALS["___mysqli_ston"]))) ? false : $___mysqli_res);

					if (!empty($project) && !empty($project_quantity)) {
						$proj_add="INSERT into projects_data (projects_data_owner_id, projects_data_project_id, projects_data_component_id, projects_data_quantity)
							VALUES
							('$owner', '$project', '$component_id', '$project_quantity')";

						$sql_exec = mysqli_query($GLOBALS["___mysqli_ston"], $proj_add);
					}

					/*------------------------------------------------------------------------------------------
					$proj =	$_POST['project'];

					foreach ($proj as $quantity){
						$project = array_search($quantity, $proj);
						//echo $quantity;	// Quantity
						//echo ' - ';
						//echo $project;	// Project ID.
						//echo ' <br />';
						if ($quantity == 0){
							echo 'None';
						}
						else{
							$proj_add="INSERT into projects_data (owner_id, project_id, component_id, quantity)
							VALUES
							('$owner', '$project', '$component_id', '$quantity')";

							$sql_exec = mysqli_query($GLOBALS["___mysqli_ston"], $proj_add);

							echo 'Inserted';
						}
					}
					------------------------------------------------------------------------------------------*/

					echo '<div class="message green center">';
					echo 'Component added! - <a href="component.php?view=';
					echo $component_id;
					echo '">View component (';
						$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT name FROM data WHERE id = '$component_id'");
						$name = mysqli_fetch_array($result);
						echo $name['name'];
					echo ')</a>';
					echo '</div>';
				}

				if(isset($_POST['update'])) {
					$sql = "UPDATE data SET
					name = '$name', manufacturer = '$manufacturer', package = '$package', pins = '$pins', smd = '$smd', quantity = '$quantity', location = '$location',	scrap = '$scrap', width = '$width', height = '$height', depth = '$depth', weight = '$weight', datasheet = '$datasheet', comment = '$comment', category = '$category', url1 = '$url1', url2 = '$url2',  url3 = '$url3', url4 = '$url4', price = '$price', order_quantity = '$order_quantity', bin_location = '$bin_location'	WHERE id = '$id'";

					$sql_exec = mysqli_query($GLOBALS["___mysqli_ston"], $sql);

					if (!empty($project) && !empty($project_quantity)) {
						$proj_add="INSERT into projects_data (projects_data_owner_id, projects_data_project_id, projects_data_component_id, projects_data_quantity)
							VALUES
							('$owner', '$project', '$id', '$project_quantity')";

						$sql_exec = mysqli_query($GLOBALS["___mysqli_ston"], $proj_add) or die(((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
						echo $project;
						echo ' Owner ';
						echo $owner;
						echo ' id ';
						echo $id;
						echo ' projquant ';
						echo $project_quantity;
					}

					if (isset($_POST['projquantedit'])) {
						$proj =	$_POST['projquantedit'];

						foreach ($proj as $quantity_proj_add){
							$projects = array_search($quantity_proj_add, $proj);
							$sqlDeleteProject = "DELETE FROM projects_data WHERE projects_data_component_id = '$id' AND projects_data_project_id = '$projects'";
							$sql_exec_project_delete = mysqli_query($GLOBALS["___mysqli_ston"], $sqlDeleteProject);

							if ($quantity_proj_add == 0){
								echo 'None';
							}
							else{
								$proj_edit="INSERT into projects_data (projects_data_owner_id, projects_data_project_id, projects_data_component_id, projects_data_quantity)
								VALUES
								('$owner', '$projects', '$id', '$quantity_proj_add')";

								$sql_exec = mysqli_query($GLOBALS["___mysqli_ston"], $proj_edit);

								/*
								echo 'Projid: ';
								echo $project;
								echo ' Quantity: ';
								echo $quantity;
								echo ' Id: ';
								echo $id;
								echo '<br>';
								*/
							}
						}
					}
					//header("location: " . $_SERVER['REQUEST_URI']);
				}
			}
		}
	}
}
?>
