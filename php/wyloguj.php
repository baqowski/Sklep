<?php 
	session_start();
	session_destroy();
	echo '<div id=green_komunikat>';
    echo'Zostałeś pomyślnie wylogowany'; 
    echo '</div>';
	//echo '<a href="index.html">Strona Głowna</a>';

?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<title>Sklep internetowy</title>
		<link href="../css/style.css" rel="stylesheet" > </link>
</head>
<style>
body {
	background-image: url('tlo.jpg');
}


</style>
<body>
	<div class='container'>
     <div id="header">   
		<ol>
			 <li><a href="php/koszyk.php"><img src="../img/logo4.png"></img></a></li>
			<li><a href="../php/rejestracja.php">Rejestracja</a></li>
			<li><a href="../php/logowanie.php">Logowanie</a></li>
			<li><a href="produkty.html">Produkty</a></li>
			<li><a href="../index.php">Strona główna</a></li>
			
		</ol>
     </div>
	</div>

	


</br>
</body>

</html>