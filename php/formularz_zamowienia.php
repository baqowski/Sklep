<?php
	include ("connect.php");
	$login 	  = $_SESSION['login'];
	$haslo    = $_SESSION['haslo'];
	
		if (!isset($_SESSION['zalogowany']))		
	{
		
		header('Location: logowanie.php');
		exit();
	}

$show_sklep = mysqli_query($conn, "SELECT * FROM sklep");


?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title>Zaologowano</title>
<link href="../css/style.css" rel="stylesheet" > </link>
</head>  
<style>
ol {
        list-style-type:none;
        padding:40px 120px;
        margin:0;       
        font-size:17px;
        height:2em;
        line-height:4em;
        text-align:center;
        height: 100px;
        left: 290px;
        font-family: 'Jokerman'; Helvetica: monospace;
        position: relative;
}    
    
    #zamowienie {
    display: block;
    position: relative;
    width: 300px;
	left: 5px;
    bottom:0px;
    padding: 5px 2px;
    border: 1px solid #ccc;
    border-radius: 5px;
    text-align: center;
    
}
    
h1 {
    font-size: 18px;
    text-align: left;
    font-family: "Trebuchet MS", Times: monospace;
    text-align: center;
}

input[type=submit] {
	width: 60%;
    background-color: #333;
    color: white;
    padding: 8px 8px;
    margin: 4px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    
}
h3 {
    position: absolute;
	color: red;
	font-size: 16px;
	font-family: "Trebuchet MS", Times: monospace;
    left: 8px;
    bottom: -10px;
    padding: 60px 35px;   
}
h4 {
    position: absolute;
	color: green;
	font-size: 16px;
	font-family: "Trebuchet MS", Times: monospace;
    left: 8px;
    bottom: -20px;
    padding: 60px 35px;  
}     
</style>
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
        </li>
        <li><a href="../php/koszyk.php"><img src="../img/logo4.png"> </img></a></li>
        <li><a href="../php/produkty.php">Produkty</a></li>
        
     </ol>
    </div>


<div id="zamowienie">       
<form method="POST" action="zamowienie_dodaj.php">
 
    <h1>Proszę wypełnić wszystkie dane wysyłki</h1><br>
	<h1>Imię</h1> <input type="text" name="imie"/><br>
	<h1>Nazwisko</h1><input type="text" name="nazwisko">
	<h1>Ulica</h1><input type="text" name="ul"><br>
	<h1>Nr lokalu/domu</h1><input type="text" name="nr"><br>
	<h1>Kod pocztowy</h1><input type="text" name="kod"><br>
	<h1>Miasto</h1><input type="text" name="miasto"><br><br><br>    
  
	<input type="submit" value="Kupuję" name="zamowienie_dodaj">
    
 
</form> 
</div>
	
		
       
    
	</div>
	


</body>

</html>