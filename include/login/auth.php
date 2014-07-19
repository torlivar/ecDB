<?php
	//Start session
	session_start();

	$arrlp = explode("/", $_SERVER["REQUEST_URI"]);
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
		if ($script_name == 'contact.php' or $script_name == 'terms.php')
		{

		}
		else
		{
			header("location: login.php");
			exit();
		}
	}
?>
