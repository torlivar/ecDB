<?php
	//Start session
	session_start();
	//Include database connection details
	require_once('include/mysql_connect.php');

	//Array to store validation errors
	$errmsg_arr = array();

	//Validation error flag
	$errflag = false;

	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return (mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $str));
	}

	//Sanitize the POST values
	$login = clean($_POST['login']);
	$password = clean($_POST['password']);

	//Input Validations
	if($login == '') {
		$errmsg_arr[] = 'Login ID missing';
		$errflag = true;
	}
	if($password == '') {
		$errmsg_arr[] = 'Password missing';
		$errflag = true;
	}

	//If there are input validations, redirect back to the login form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: login.php");
		exit();
	}

	//Create query
	$qry="SELECT * FROM members WHERE login='$login' AND passwd='".md5($_POST['password'])."'";

	$result=mysqli_query($GLOBALS["___mysqli_ston"], $qry);

	//Check whether the query was successful or not
	if($result)
	{
		if(mysqli_num_rows($result) == 1)
		{
			//Login Successful
			session_regenerate_id();

			$member = mysqli_fetch_assoc($result);
			$_SESSION['SESS_MEMBER_ID'] = $member['member_id'];
			$_SESSION['SESS_FIRST_NAME'] = $member['firstname'];
			$_SESSION['SESS_LAST_NAME'] = $member['lastname'];
			$_SESSION['SESS_IS_ADMIN'] = intval($member['admin']);

			session_write_close();
			$member_id = $_SESSION['SESS_MEMBER_ID'];
			mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO members_stats (members_stats_member) VALUES ('$member_id')");
			header("location: index.php");
			exit();
		}
		else
		{
			//Login failed
			header("location: login-failed.php");
			exit();
		}
	}else {
		die("Query failed");
	}
?>
