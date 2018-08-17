<?php

function secure_access()
{
	if($_SERVER['REMOTE_ADDR'] != "188.65.44.17")
	{
		header('Location: https://www.polskidm.com.pl/');
		exit();
	}
}

function database()
{
	$connect = mysql_connect("localhost","root","") or die(mysql_error());
	if($connect)  
	{ 
		$choice = mysql_select_db("test_zap");
		if ($choice) 
		{
			$s = mysql_query("SET NAMES utf8");
			return true;
		}
		else 
		{
			return false;
		}
	}
	else 
	{
		echo "BRAK POLACZENIA";
		return false;
	}
}
function data_from_table( $query )
{
	$i = 1;
		while($row = mysql_fetch_array( $query ))
		{
			echo "<tr>
					<th>".$i."</th>
					<th>".$row['pesel']."</th>
					<th>".$row['nazwisko']."</th>
					<th>".$row['imie']."</th>
					<th>".$row['nazwa_pn']."</th>
					<th>".$row['email_pn']."</th>
					<th>".$row['email']."</th>
					<th>".$row['email_doradcy']."</th>
					<th>".$row['data_pn']."</th>
					<th>".$row['adres']."</th>
					<th>".$row['adres_kor']."</th>
					<th>".$row['dowod']."</th>
					<th>".$row['telefon']."</th>
					<th>".$row['rachunek_bank']."</th>
					<th>".$row['rachunek']."</th>
					<th>".$row['rachunek_maklerski_bank']."</th>
					<th>".$row['rachunek_maklerski']."</th>
					<th>".$row['beneficjent']."</th>
					<th>".$row['liczba']."</th>
					<th>".$row['kwota']."</th>
					<th>".$row['data_zapisu']."</th>
					<th>".$row['remote_addres_zapis']."</th>
					<th>".$row['przydzielono_ilosc']."</th>
					<th>".$row['przydzielono_kwota']."</th>
					<th>".$row['wplata']."</th>
					<th>".$row['spolka']."</th>
					<th>".$row['seria_emisji']."</th>";
			$i++;
					
		}
}

function save_data_to_excel( $query )
{
	require_once 'library/PHPExcel.php';
	require_once 'library/PHPExcel/Writer/Excel2007.php';
	database();
	
	$PHPExcel = new PHPExcel();
	
	$PHPExcel->setActiveSheetIndex(0)
				->setCellValueByColumnAndRow(0, 1, 'Nr')
				->setCellValueByColumnAndRow(1, 1, 'Pesel')
				->setCellValueByColumnAndRow(2, 1, 'Nazwisko')
				->setCellValueByColumnAndRow(3, 1, 'Imię')
				->setCellValueByColumnAndRow(4, 1, 'Nazwa PN')
				->setCellValueByColumnAndRow(5, 1, 'Email PN')
				->setCellValueByColumnAndRow(6, 1, 'Email')
				->setCellValueByColumnAndRow(7, 1, 'Email dradcy')
				->setCellValueByColumnAndRow(8, 1, 'Data PN')
				->setCellValueByColumnAndRow(9, 1, 'Adres')
				->setCellValueByColumnAndRow(10, 1, 'Adres korespondencyjny')
				->setCellValueByColumnAndRow(11, 1, 'Nr dowódu')
				->setCellValueByColumnAndRow(12, 1, 'Telefon')
				->setCellValueByColumnAndRow(13, 1, 'Bank')
				->setCellValueByColumnAndRow(14, 1, 'Rachunek bankowy')
				->setCellValueByColumnAndRow(15, 1, 'Rachunek maklerski bank')
				->setCellValueByColumnAndRow(16, 1, 'Rachunek maklerski')
				->setCellValueByColumnAndRow(17, 1, 'Beneficjient')
				->setCellValueByColumnAndRow(18, 1, 'Liczba')
				->setCellValueByColumnAndRow(19, 1, 'Kwota')
				->setCellValueByColumnAndRow(20, 1, 'Data zapisu')
				->setCellValueByColumnAndRow(21, 1, 'Adres IP zapisu')
				->setCellValueByColumnAndRow(22, 1, 'Przydzielono ilość')
				->setCellValueByColumnAndRow(23, 1, 'Przydzielono kwota')
				->setCellValueByColumnAndRow(24, 1, 'Wpłata')
				->setCellValueByColumnAndRow(25, 1, 'Spółka')
				->setCellValueByColumnAndRow(26, 1, 'Seria');
				
				$i = 1;                      
				while($row = mysql_fetch_array( $query ) or die(mysql_error()))
				{
					$PHPExcel->setActiveSheetIndex(0)
								->setCellValueByColumnAndRow($i, 1, $row['pesel'] )
								->setCellValueByColumnAndRow($i, 1, $row['nazwisko'] )
								->setCellValueByColumnAndRow($i, 1, $row['imie'] )
								->setCellValueByColumnAndRow($i, 1, $row['nazwa_pn'] )
								->setCellValueByColumnAndRow($i, 1, $row['email_pn'] )
								->setCellValueByColumnAndRow($i, 1, $row['email'] )
								->setCellValueByColumnAndRow($i, 1, $row['email_doradcy'] )
								->setCellValueByColumnAndRow($i, 1, $row['data_pn'] )
								->setCellValueByColumnAndRow($i, 1, $row['adres'] )
								->setCellValueByColumnAndRow($i, 1, $row['adres_kor'] )
								->setCellValueByColumnAndRow($i, 1, $row['dowod'] )
								->setCellValueByColumnAndRow($i, 1, $row['telefon'] )
								->setCellValueByColumnAndRow($i, 1, $row['rachunek_bank'] )
								->setCellValueByColumnAndRow($i, 1, $row['rachunek'] )
								->setCellValueByColumnAndRow($i, 1, $row['rachunek_maklerski_bank'] )
								->setCellValueByColumnAndRow($i, 1, $row['rachunek_maklerski'] )
								->setCellValueByColumnAndRow($i, 1, $row['beneficjent'] )
								->setCellValueByColumnAndRow($i, 1, $row['liczba'] )
								->setCellValueByColumnAndRow($i, 1, $row['kwota'] )
								->setCellValueByColumnAndRow($i, 1, $row['data_zapisu'] )
								->setCellValueByColumnAndRow($i, 1, $row['remote_addres_zapis'] )
								->setCellValueByColumnAndRow($i, 1, $row['przydzielono_ilosc'] )
								->setCellValueByColumnAndRow($i, 1, $row['przydzielono_kwota'] )
								->setCellValueByColumnAndRow($i, 1, $row['wplata'] )
								->setCellValueByColumnAndRow($i, 1, $row['spolka'] )
								->setCellValueByColumnAndRow($i, 1, $row['seria_emisji'] );
					$i++;
				}
	
	$PHPExcel->getProperties()
				->setCreator('Aplikacja WWW')
				->setTitle('Dane z systemu');
	$PHPExcel->getActiveSheet()->getStyle('A1:AA1')->getFont()
													->setBold()
													->getColor()->setRGB('006100');
	$PHPExcel->getActiveSheet()->getStyle('A1:AA1')->getFill()
													->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
													->getStartColor()->setRGB('C6EFCE');
	$PHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
	$PHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
	$PHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
	$PHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
	$PHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
	$PHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
	
	$Write = PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel2007');
	$today = date('Y-m-d H;i;s');
	$name = "search_file/dane_$today.xlsx";
	$Write->save('search_file/tmp_dane.xlsx');
	
	if( file_exists('search_file/tmp_dane.xlsx') ) {
		rename("search_file/tmp_dane.xlsx", "$name");
		echo '<meta http-equiv="refresh" content="1; url='.$name.'">';
	}
	exit;
	mysql_close();
}
?>