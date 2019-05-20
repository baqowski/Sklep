<?php
	include ("connect.php");
	$login 	  = $_SESSION['login'];
	$haslo    = $_SESSION['haslo'];
	
		if (!isset($_SESSION['zalogowany']))		
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
<title>Zaologowano</title>
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
        <li><a href="../php/koszyk.php"><img src="../img/logo4.png"> </img></a></li>
        <li><a href="../php/produkty.php">Produkty</a></li>
        
       
	
		
       </li>	
     </ol>
    </div>
	</div>
	


</body>

</html>