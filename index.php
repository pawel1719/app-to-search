<?php
session_start();
include "function.php";	
	//secure_access();
	
	if ((isset($_SESSION['auth'])) && ($_SESSION['auth']==1))
	{
		header('Location: mainapp.php');
		exit();
	}
	
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="pl" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<title>Obsługa Danych Klientów</title>
	<link rel="Stylesheet" type="text/css" href="style.css" />
</head>

<body>
	<div id="index_content">
		<div id="index_view_login">
			<h2>Dane klientów z systemu zapisów</h2>
				<hr/><br/>
			<form action="login.php" method="post">
				Login: <input type="text" name="login" class="input_form"/><br />
				Hasło: <input type="password" name="password_user" class="input_form"/>	
				<?php
					if(isset($_SESSION['auth']) && $_SESSION['auth'] != 1 && isset($_SESSION['login']))
					{	
						echo '<b style="color: black;"><br/><br/>Niepoprawny login lub hasło!</b>';
						unset($_SESSION['login']);
					}
				?>
					<br /><br />
				<input type="submit" value="Zaloguj" class="index_button"/>	
			</form>
		</div>
	</div>
</body>
</html>