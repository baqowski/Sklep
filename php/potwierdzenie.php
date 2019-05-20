<?php

include ("connect.php");
//include ("rejestracja.php");
echo $_POST['imie'];
echo $_POST['nazwisko'];

if (isset($_POST['login']) && (isset($_POST['haslo1'])) && 
    (isset($_POST['email'])) && (isset($_POST['imie']))&& 
    (isset($_POST['nazwisko'])))  
{

$imie = $_POST['imie'];
$nazwisko = $_POST['nazwisko'];
$login = $_POST['login'];
$haslo1  = $_POST['haslo1'];
$email = $_POST['email'];
 $sql = ("INSERT INTO `users` VALUES ('NULL','$imie', '$nazwisko','$login','$haslo1','$email', 1 )")
 or die("Błąd w dodaniu do bazy");
	if ($conn->query($sql) == TRUE)
{
    echo "<div id='green_komunikat'>Weryfikacja zakonczona 
    sukcesem, możesz się zalogować </div>";    
    session_destroy(); 
} 
else 
{
    echo "Error: " . $sql . "<br>" . $conn->error;
}

}
else {
echo '<h3>Konto zostało już aktywowane!</h3>';
}
$conn->close();
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

    

 h3 {
    position: static;
	color: red;
	font-size: 16px;
	font-family: "Trebuchet MS", Times: monospace;
    left: 8px;
    bottom: 260px;
    padding: 0px ;   
}
h4 {
    position: static;
	color: green;
	font-size: 16px;
	font-family: "Trebuchet MS", Times: monospace;
    left: 8px;
    bottom: 2600px;
    padding: 0px;  
}     
</style>

<body> 
 <div class='container'>
  	<div id="header">
            <ol>
              <li><img src="../img/logo4.png"></img></li>
		      <li><a href="../php/rejestracja.php">Rejestracja</a></li>
		      <li><a href="../php/logowanie.php">Logowanie</a></li>
		      <li><a href="../php/produkty.php">Produkty</a></li>
		      <li><a href="../index.php">Strona główna</a></li>
            </ol>
        </div>
 </div>

</body>

</html>
