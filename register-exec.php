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
		return (mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $str)) ;
	}

	//Sanitize the POST values
	$fname = clean($_POST['fname']);
	$lname = clean($_POST['lname']);
	$login = clean($_POST['login']);
	$mail = clean($_POST['mail']);
	$password = clean($_POST['password']);
	$cpassword = clean($_POST['cpassword']);

	//Input Validations
	if($fname == '') {
		$errmsg_arr[] = 'First name missing';
		$errflag = true;
	}
	if (strlen($fname) < 2){
		$errmsg_arr[] = 'Minimum of 2 chars in first name.';
		$errflag = true;
	}
	if($mail == '') {
		$errmsg_arr[] = 'Mail missing';
		$errflag = true;
	}
	if(!filter_var($mail, FILTER_VALIDATE_EMAIL)){
		$errmsg_arr[] = 'Invalid e-mail address';
		$errflag = true;
	}
	if($lname == '') {
		$errmsg_arr[] = 'Last name missing';
		$errflag = true;
	}
	if (strlen($lname) < 2){
		$errmsg_arr[] = 'Minimum of 2 chars in last name.';
		$errflag = true;
	}
	if($login == '') {
		$errmsg_arr[] = 'Username missing';
		$errflag = true;
	}
	if (strlen($login) < 2){
		$errmsg_arr[] = 'Minimum of 2 chars in username.';
		$errflag = true;
	}
	if($password == '') {
		$errmsg_arr[] = 'Password missing';
		$errflag = true;
	}
	if($cpassword == '') {
		$errmsg_arr[] = 'Confirm password missing';
		$errflag = true;
	}
	if (strlen($password) < 5){
		$errmsg_arr[] = 'Minimum of 5 chars in password.';
		$errflag = true;
	}
	if( strcmp($password, $cpassword) != 0 ) {
		$errmsg_arr[] = 'Passwords do not match';
		$errflag = true;
	}

	//Check for duplicate login ID
	if($login != '') {
		$qry = "SELECT * FROM members WHERE login='$login'";
		$result = mysqli_query($GLOBALS["___mysqli_ston"], $qry);
		if($result) {
			if(mysqli_num_rows($result) > 0) {
				$errmsg_arr[] = 'Username already in use';
				$errflag = true;
			}
			@((mysqli_free_result($result) || (is_object($result) && (get_class($result) == "mysqli_result"))) ? true : false);
		}
		else {
			die("Query failed");
		}
	}

	//If there are input validations, redirect back to the registration form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: register.php");
		exit();
	}

	//Create INSERT query
	$qry = "INSERT INTO members(firstname, lastname, login, mail, passwd) VALUES('$fname','$lname','$login','$mail','".md5($_POST['password'])."')";
	$result = @mysqli_query($GLOBALS["___mysqli_ston"], $qry);

	//Check whether the query was successful or not
	if($result)
	{
		if(isset($_SESSION['SESS_IS_ADMIN'])==true && intval($_SESSION['SESS_IS_ADMIN']) == 1)
		{
			header("location: admin.php?user_add=1");
			exit();
		}
		else
		{
			header("location: register-success.php");
			exit();
		}
	}
	else
	{
		die("Query failed");
	}
?>
