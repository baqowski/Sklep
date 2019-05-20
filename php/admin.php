<?php
	include ("connect.php");
	$login 	  = $_SESSION['login'];
	$haslo    = $_SESSION['haslo'];
		if (!isset($_SESSION['zalogowany_admin']))		
	{
		echo '<div id=red_komunikat>';
            echo'Musisz się zalogować!'; 
            echo '</div>';
		header('Location: logowanie.php');
		exit();
	}
?>
<!DOCTYPE html>
<html>
  <head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
      <title>Administrator</title>
    <link href="../css/style.css" rel="stylesheet" > </link>
  </head>      

<body>

  <div class='container'>
    <div id="header">
    <ol>
        <li><a><?php echo 'Witaj '.$_SESSION['login'];?></a>
            <ul>
                <li><a href="wyloguj.php">Wyloguj</a></li>
            </ul>
        </li>
        <li><a href="#">Sklepy</a>
            <ul>
                <li><a href="../php/sklep_dodaj.php">Dodaj</a></li>
                <li><a href="#">Wyswietl</a></li>
                <li><a href="../php/sklep_usun.php">Usun</a></li>
            </ul>
        </li>    
        <li><a href="#">Pracownicy</a>
            <ul>
                <li><a href="../php/pracownik_dodaj.php">Dodaj</a></li>
                <li><a href="../php/pracownik_usun.php">Usuń</a></li>
                <li><a href="../php/pracownik_wyswietl.php">Wyświetl</a></li>
            </ul>
        </li>
        <li><a href="../index.php">Strona główna</a></li>		
     </ol>
    </div>    
	</div>
</body>
</html>