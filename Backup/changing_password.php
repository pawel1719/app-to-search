<?php
@session_start();
include "function.php";
database();


$pass = addslashes(md5($_POST["password_user"]));

$_SESSION['auth'] = 0;

if ($_SESSION['auth'] != 1) {
	$login = mysql_real_escape_string($login);
	$pass = mysql_real_escape_string($pass);
	
	$sql = mysql_query("SELECT id, login, haslo FROM panel WHERE login='$login' AND haslo = '$pass' ") or die(mysql_error());
	if ( mysql_num_rows($sql) != 1 ) {
		$auth = 0;
		$_SESSION['login'] = $login;
	}
	else {
		$row = mysql_fetch_array($sql, MYSQL_ASSOC);
		
		$id_usera 	= $row['id']; 
		$user_login	= $row['login']; 
		$passowrd 	= $row['haslo']; 

		$auth = ($login == $user_login && $pass == $passowrd) ? 1 : 0;
	}

	if ($auth != 1) {
		header('Location: index.php');
		exit();
	}
	else {
		$_SESSION['auth'] = 1;
		$_SESSION['id_user'] = $id_usera;
		$_SESSION['login'] = $user_login;
		
		header('Location: mainapp.php');
		exit();
	} 
}
?>