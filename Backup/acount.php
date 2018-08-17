<?php
	session_start();
	
	if (!isset($_SESSION['auth']) && !isset($_SESSION['login']))
	{
		header('Location: index.php');
		exit();
	}
	
	include "function.php";
	database();
	
	if( isset($_POST['new_password']) && isset($_POST['new_password2']))
	{
		if($_POST['new_password'] != $_POST['new_password2']){
			$_SESSION['blad'] = "Wprowadzone hasła są różne!";
		}else{
			if(strlen( $_POST['new_password'] ) > 6){
				if(preg_match("/^([A-Z]+[a-z]+[0-9])|[!@$%^&*()+=]/", $_POST['new_password']))
				{
					$pass = addslashes(md5($_POST["new_password"]));
					$date = date('Y-m-d G:i:s');
					$query = mysql_query("UPDATE panel SET haslo='$pass', data = '$date' WHERE login = '$login'") or die($_SESSION['blad'] = "Niepoprawne dane!");
					
					$_SESSION['blad'] = "Hasło zostało zmienione!";
				}else{
					$_SESSION['blad'] = "Hasło musi zawierać małe i duże litery oraz cyfrę!";
				}
			}else{
				$_SESSION['blad'] = "Hasło musi być dłuższe niż 6 znaków!";
			}
		}
	}
?>

<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="pl" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<title>Obsługa Danych Klientów - konto</title>
	<link rel="Stylesheet" type="text/css" href="style.css" />
	<link href="https://fonts.googleapis.com/css?family=EB+Garamond|Merienda|Merriweather|Montserrat|Noto+Serif|Playfair+Display|Slabo+27px" rel="stylesheet" /> 
</head>

<body>
	<div id="account_content">
		<div id="account_bar">
			<div class="bar_center">
				<ol id="list_menu">
				  <li><a href="mainapp.php">Strona główna</a></li>
				  <li><a href="#">Tabela</a></li>
				  <li><a href="search.php">Szukaj</a></li>
				</ol>
			</div>
			<div class="bar_side">
				<span class="bar_text">Użytkownik: 
				<b><a href="acount.php"><?php echo $_SESSION['login']; ?></a></span></b>
				<a href="logout.php"><button>Wyloguj</button></a>
			</div>
			<div style="clear:both;"></div>
		</div>
		<div id="account_body">
			<p>
				Zmiana hasła:
			<form method="post">
				Nowe hasło:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="password" name="new_password" class="input_form"/><br />
				Potwierdź hasło: <input type="password" name="new_password2" class="input_form"/>	
				<?php
					if(isset($_SESSION['blad']))
					{	
						echo '<b style="color: black;"><br/><br/>'.$_SESSION['blad'].'</b>';
						unset($_SESSION['blad']);
					}
				?>
					<br /><br />
				<input type="reset" value="Wyczyść" class="account_button" />
				<input type="submit" value="Zmień hasło" class="account_button"/>	
			</form>
			</p>
		</div>
	</div>
<?php
	mysql_close();
?>
</body>
</html>
