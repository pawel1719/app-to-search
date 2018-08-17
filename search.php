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

<!-- <body onselectstart="return false" onselect="return false" oncopy="return false" oncontextmenu="return false" onbeforeprint="document.body.style.visibility = 'hidden'; alert('Wydruk jest niedostępny!')" onafterprint="document.body.style.visibility = 'visible'"> -->
<body>
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
			<p>
			<form method="post">
				Pesel: <input type="text" name="search_pesel" class="input_form"/>
				Imię: <input type="text" name="search_name" class="input_form"/>
				Nazwisko: <input type="text" name="search_surname" class="input_form"/>			
				Adres e-mail: <input type="text" name="search_email" class="input_form"/>			
				<input type="submit" value="SZUKAJ" class="account_button" />	
			</form>
			</p>
				<?php 
					
					if(isset($_POST['search_pesel']))
					{
						$pesel = $_POST['search_pesel'];
						$name = $_POST['search_name'];
						$surname = $_POST['search_surname'];
						$email = $_POST['search_email'];
					
						if( strlen($pesel) >= 2 ){
							$num_row = mysql_query("SELECT COUNT(pesel) as row FROM pryw_all WHERE pesel LIKE '%$pesel%'");
							$num_row = mysql_fetch_assoc( $num_row );
						}
						if( strlen($name) >= 3 ){
							$num_row = mysql_query("SELECT COUNT(pesel) as row FROM pryw_all WHERE nazwa_pn LIKE '%$name%'");
							$num_row = mysql_fetch_assoc( $num_row );
						}
						if( strlen($surname) >= 3 ){
							$num_row = mysql_query("SELECT COUNT(pesel) as row FROM pryw_all WHERE nazwa_pn LIKE '%$surname%'");
							$num_row = mysql_fetch_assoc( $num_row );
						}
						if( strlen($email) >= 3 ){
							$num_row = mysql_query("SELECT COUNT(pesel) as row FROM pryw_all WHERE email_pn LIKE '%$email%'");
							$num_row = mysql_fetch_assoc( $num_row );
						}
						
						if( isset($num_row['row']) ){
							echo '<form method="post">Znaleziono: '.$num_row['row'].' wierszy      <input type="hidden" name="Excel"/><input type="submit" value="Zapisz" class="account_button" /></form>';
						}else{
							echo "Uzupełnij jedno z pól!!!";
						}
					}
					if( isset($_POST['Excel']) )
					{
						$query = $_SESSION['TMP_QUERY'];
						save_data_to_excel( $query );
						unset($_POST['Excel']);
						unset($_SESSION['TMP_QUERY']);
					}
					
				?>
				<hr />
				<table class="mainapp_table">
				  <tr>
					<th>Nr</th>
					<th>Pesel</th>
					<th>Nazwisko</th>
					<th>Imię</th>
					<th>Nazwa PN</th>
					<th>Emial PN</th>
					<th>Emial</th>
					<th>Emial dradcy</th>
					<th>Data PN</th>
					<th>Adres</th>
					<th>Adres korespondencyjny</th>
					<th>Nr dowód</th>
					<th>Telefon</th>
					<th>Bank</th>
					<th>Rachunek bankowy</th>
					<th>Rachunek maklerski bank</th>
					<th>Rachunek maklerski</th>
					<th>Beneficjient</th>
					<th>Liczba</th>
					<th>Kwota</th>
					<th>Data zapisu</th>
					<th>Adres IP zapisu</th>
					<th>Przydzielono ilość</th>
					<th>Przydzielono kwota</th>
					<th>Wpłata</th>
					<th>Spółka</th>
					<th>Seria</th>
				  </tr>
			<?php
					
				if(isset($_POST['search_pesel']))
				{
					$pesel = $_POST['search_pesel'];
					$name = $_POST['search_name'];
					$surname = $_POST['search_surname'];
					$email = $_POST['search_email'];
				
					if( strlen($pesel) >= 2 )
					{
						$_SESSION['TMP_QUERY'] = $query = mysql_query("SELECT `pesel`, `imie`, `nazwisko`, `nazwa_pn`, `email_pn`, `email`, `email_doradcy`, `zlozony_zapis`, `zlozona_pn`, `data_pn`, `adres`, `adres_kor`, `dowod`, `telefon`, `liczba`, `rachunek`, `rachunek_bank`, `rachunek_maklerski`, `rachunek_maklerski_bank`, `beneficjent`, `kwota`, `data_zapisu`, `przydzielono_ilosc`, `przydzielono_kwota`, `pisemne_potwierdzenie`, `wplata`, `automatyczny_przydzial`, `data_wplaty`, `komentarz`, `spolka`, `seria_emisji`, `remote_addres_zapis` FROM pryw_all WHERE pesel LIKE '%$pesel%' ORDER BY pesel ASC") or trigger_error(mysql_error());
						
						//FUNCTION WHICH RETURNS DATE FROM TABLE
						data_from_table($query);
					}					
					if( strlen($name) >= 3 )
					{
						$_SESSION['TMP_QUERY'] = $query = mysql_query("SELECT `pesel`, `imie`, `nazwisko`, `nazwa_pn`, `email_pn`, `email`, `email_doradcy`, `zlozony_zapis`, `zlozona_pn`, `data_pn`, `adres`, `adres_kor`, `dowod`, `telefon`, `liczba`, `rachunek`, `rachunek_bank`, `rachunek_maklerski`, `rachunek_maklerski_bank`, `beneficjent`, `kwota`, `data_zapisu`, `przydzielono_ilosc`, `przydzielono_kwota`, `pisemne_potwierdzenie`, `wplata`, `automatyczny_przydzial`, `data_wplaty`, `komentarz`, `spolka`, `seria_emisji`, `remote_addres_zapis` FROM pryw_all WHERE nazwa_pn LIKE '%$name%' ORDER BY nazwa_pn ASC");
						
						//FUNCTION WHICH RETURNS DATE FROM TABLE
						data_from_table($query);
					}
					if( strlen($surname) >= 3 )
					{
						$_SESSION['TMP_QUERY'] = $query = mysql_query("SELECT `pesel`, `imie`, `nazwisko`, `nazwa_pn`, `email_pn`, `email`, `email_doradcy`, `zlozony_zapis`, `zlozona_pn`, `data_pn`, `adres`, `adres_kor`, `dowod`, `telefon`, `liczba`, `rachunek`, `rachunek_bank`, `rachunek_maklerski`, `rachunek_maklerski_bank`, `beneficjent`, `kwota`, `data_zapisu`, `przydzielono_ilosc`, `przydzielono_kwota`, `pisemne_potwierdzenie`, `wplata`, `automatyczny_przydzial`, `data_wplaty`, `komentarz`, `spolka`, `seria_emisji`, `remote_addres_zapis` FROM pryw_all WHERE nazwa_pn LIKE '%$surname%' ORDER BY nazwa_pn ASC");

						//FUNCTION WHICH RETURNS DATE FROM TABLE
						data_from_table($query);
					}
					if( strlen($email) >= 3 )
					{
						$_SESSION['TMP_QUERY'] = $query = mysql_query("SELECT `pesel`, `imie`, `nazwisko`, `nazwa_pn`, `email_pn`, `email`, `email_doradcy`, `zlozony_zapis`, `zlozona_pn`, `data_pn`, `adres`, `adres_kor`, `dowod`, `telefon`, `liczba`, `rachunek`, `rachunek_bank`, `rachunek_maklerski`, `rachunek_maklerski_bank`, `beneficjent`, `kwota`, `data_zapisu`, `przydzielono_ilosc`, `przydzielono_kwota`, `pisemne_potwierdzenie`, `wplata`, `automatyczny_przydzial`, `data_wplaty`, `komentarz`, `spolka`, `seria_emisji`, `remote_addres_zapis` FROM pryw_all WHERE email_pn LIKE '%$email%' ORDER BY email_pn ASC");
	
						//FUNCTION WHICH RETURNS DATE FROM TABLE
						data_from_table($query);
					}
						
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
