<?php
	include ("connect.php");
	$login 	  = $_SESSION['login'];
	$haslo    = $_SESSION['haslo'];	
		if (!isset($_SESSION['zalogowany_worker']))		
	{
		
		header('Location: logowanie.php');
		exit();
	}
?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title>Witaj pracowniku</title>
<link href="../css/style.css" rel="stylesheet" > </link>
</head>  

<body>
    
	<div class='container'>
    <div id="header">
       
    
    <ol>
        <li><a><?php echo 'Witaj '.$_SESSION['login'];?></a>	
            <ul>
                <li><a href="#">Edytuj dane</a></li>
                <li><a href="#">Zmien haslo</a></li>
                 <li><a href="wyloguj.php">Wyloguj</a></li>
            </ul>
         <li><a href="#">Produkty</a>
            <ul>
                <li><a href="../php/produkt_dodaj.php">Dodaj</a></li>       
                <li><a href="../php/produkty_usun.php" >Usuń</a></li>
            </ul>
        </li>    
       <li><a href="../php/zamowienia_przeglad.php">Zamówienia</a></li>
        <li><a href="../index.php">Strona główna</a></li>
	
		
       
     </ol>
    </div>
	</div>
	


</body>

</html>