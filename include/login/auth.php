<?php
	//Start session
	session_start();

	if (!isset($_SERVER['REQUEST_URI']))
	{
		   $_SERVER['REQUEST_URI'] = substr($_SERVER['PHP_SELF'],1 );
		   if (isset($_SERVER['QUERY_STRING'])) { $_SERVER['REQUEST_URI'].='?'.$_SERVER['QUERY_STRING']; }
	}

	$script_name = "";
	$arrlp = explode("/", parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));
	if(count($arrlp) > 0)
	{
		$script_name = $arrlp[count($arrlp)-1];
	}
	else
	{
		$script_name = $_SERVER["REQUEST_URI"];
	}



	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(!isset($_SESSION['SESS_MEMBER_ID']) || (trim($_SESSION['SESS_MEMBER_ID']) == ''))
	{
		if ($script_name == 'contact.php' or $script_name == 'terms.php' or $script_name == 'proj_list.php' or $script_name == 'proj_show.php')
		{

		}
		else
		{
			header("location: login.php");
			exit();
		}
	}
?>
