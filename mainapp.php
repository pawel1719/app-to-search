<?php
	session_start();
	
	if (!isset($_SESSION['auth']) && !isset($_SESSION['login']))
	{
		header('Location: index.php');
		exit();
	}
	
	include "function.php";
	database();
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
	<link href="https://fonts.googleapis.com/css?family=EB+Garamond|Merienda|Merriweather|Montserrat|Noto+Serif|Playfair+Display|Slabo+27px" rel="stylesheet" /> 
</head>

<body onselectstart="return false" onselect="return false" oncopy="return false" oncontextmenu="return false" onbeforeprint="document.body.style.visibility = 'hidden'; alert('Wydruk jest niedostępny!')" onafterprint="document.body.style.visibility = 'visible'">
	<div id="main_content">
		<div id="main_bar">
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
		<div id="main_body">
			<table class="mainapp_table">
				  <tr>
					<th>Nr</th>
					<th>Pesel</th>
					<th>Nazwisko</th>
					<th>Imię</th>
					<th>Nazwa PN</th>
					<th>Emial PN</th>
					<!-- <th>Emial</th> -->
					<!-- <th>Emial dradcy</th> -->
					<th>Data PN</th>
					<th>Adres</th>
					<th>Adres korespondencyjny</th>
					<th>Nr dowód</th>
					<th>Telefon</th>
					<th>Bank</th>
					<th>Rachunek bankowy</th>
					<!-- <th>Rachunek maklerski bank</th> -->
					<!-- <th>Rachunek maklerski</th> -->
					<th>Beneficjient</th>
					<!-- <th>Liczba</th> -->
					<!-- <th>Kwota</th> -->
					<th>Data zapisu</th>
					<!-- <th>Adres IP zapisu</th> -->
					<th>Przydzielono ilość</th>
					<th>Przydzielono kwota</th>
					<!-- <th>Wpłata</th> -->
					<th>Spółka</th>
					<th>Seria</th>
				  </tr>
			<?php
				$query = mysql_query("SELECT `pesel`, `imie`, `nazwisko`, `nazwa_pn`, `email_pn`, `email`, `email_doradcy`, `data_pn`, `adres`, `adres_kor`, `dowod`, `telefon`, `liczba`, `rachunek`, `rachunek_bank`, `rachunek_maklerski`, `rachunek_maklerski_bank`, `beneficjent`, `kwota`, `data_zapisu`, `przydzielono_ilosc`, `przydzielono_kwota`, `pisemne_potwierdzenie`, `wplata`, `spolka`, `seria_emisji` FROM `pryw_all`");
				
				$i = 1;
				while(($row = mysql_fetch_array( $query )) && $i <= 50)
				{
					echo "<tr>
							<th>".$i."</th>
							<th>".$row['pesel']."</th>
							<th>".$row['nazwisko']."</th>
							<th>".$row['imie']."</th>
							<th>".$row['nazwa_pn']."</th>
							<th>".$row['email_pn']."</th>
							<!-- <th>".$row['email']."</th> -->
							<!-- <th>".$row['email_doradcy']."</th> -->
							<th>".$row['data_pn']."</th>
							<th>".$row['adres']."</th>
							<th>".$row['adres_kor']."</th>
							<th>".$row['dowod']."</th>
							<th>".$row['telefon']."</th>
							<th>".$row['rachunek_bank']."</th>
							<th>".$row['rachunek']."</th>
							<!-- <th>".$row['rachunek_maklerski_bank']."</th> -->
							<!-- <th>".$row['rachunek_maklerski']."</th> -->
							<th>".$row['beneficjent']."</th>
							<!-- <th>".$row['liczba']."</th> -->
							<!-- <th>".$row['kwota']."</th> -->
							<th>".$row['data_zapisu']."</th>
							<th>".$row['przydzielono_ilosc']."</th>
							<th>".$row['przydzielono_kwota']."</th>
							<!-- <th>".$row['wplata']."</th> -->
							<th>".$row['spolka']."</th>
							<th>".$row['seria_emisji']."</th>";
					$i++;
							
				}
			?>
			</table>
		</div>
	</div>
<?php
	mysql_close();
?>
</body>
</html>
