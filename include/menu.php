<div id="menu">
	<ul>
		<li><a href="." class="<?php if ($_SERVER["REQUEST_URI"] == '/' or $script_name == 'index.php'or isset($_GET['view']) or isset($_GET['cat'])or isset($_GET['subcat']) or isset($_GET['edit']) or isset($_GET['based'])){echo 'selected';}?>"><span class="icon medium inbox"></span> My components</a></li>
		<li><a href="add.php" class="<?php if ($script_name == 'add.php'){echo 'selected';}?>"><span class="icon medium sqPlus"></span> Add component</a></li>
		<li><a href="shoplist.php" class="<?php if ($script_name ==  'shoplist.php'){echo 'selected';}?>"><span class="icon medium shopCart"></span> Shopping list</a></li>
		<li><a href="proj_list.php" class="<?php if ($script_name == 'proj_list.php'){echo 'selected';}?>"><span class="icon medium cube"></span> Projects</a></li>
		<li><a href="my.php" class="<?php if ($script_name == 'my.php'){echo 'selected';}?>"><span class="icon medium user"></span> My account</a></li>
<?php
		if($opt_pubcomponent_tab_show == 1)
		{?>
			<li class="public"><a href="public.php" class="<?php if ($script_name == 'public.php'){echo 'selected';}?>"><span class="icon medium shre"></span> Public components</a></li>
<?php
		}?>
<?php
		if($opt_blog_tab_show == 1)
		{?>
			<li><a href="<?php echo $opt_blog_tab_url; ?>"><span class="icon medium docLinesStright"></span> <?php echo $opt_blog_tab_title; ?></a></li>
<?php
		}?>
<?php
		if($opt_donate_tab_show == 1)
		{?>
			<li class="donate"><a href="donate.php" class="<?php if ($script_name == 'donate.php'){echo 'selected';}?>"><span class="icon medium curDollar"></span> Donate</a></li>
<?php
		}?>
<?php
		if($_SESSION['SESS_IS_ADMIN'] == 1)
		{?>
			<li class="admin"><a href="admin.php" class="<?php if ($script_name == 'admin.php'){echo 'selected';}?>"><span class="icon medium user"></span> Administration</a></li>
<?php
		}?>
	</ul>
</div>
