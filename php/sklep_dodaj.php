<?php
	include ("connect.php");
	$login 	  = $_SESSION['login'];
	$haslo    = $_SESSION['haslo'];
	
		if (!isset($_SESSION['zalogowany_admin']))		
	{
		
		header('Location: logowanie.php');
		exit();
	}

    if (isset($_POST['dodaj']))
    {
        $nazwa = ($_POST['nazwa']);
        $miasto = ($_POST['miasto']);
        $ulica = ($_POST['ulica']);
        
        $status = true;
        
        if(empty($_POST['nazwa']) || empty($_POST['miasto']) || empty($_POST['ulica'])) 
		{
			 $status=false;
			 echo 
			'<h3> Musisz wypełnić wszystkie pola</h3>';
		}
        if ($status == true){
            $sql = ("INSERT INTO `sklep` VALUES ('NULL','$nazwa', '$miasto','$ulica')")
        or die("Błąd w dodaniu do bazy");
	if ($conn->query($sql) == TRUE)
{
    echo 
	'<h4> Dodano pomyslnie !</h4>';
} 
else 
{
    echo "Error: " . $sql . "<br>" . $conn->error;
}
        }
        $conn->close();
    }
?>
<!DOCTYPE html>
<html>
  <head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
      <title>Dodaj Sklep</title>
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
        left: 190px;
        font-family: 'Jokerman'; Helvetica: monospace;
        position: relative;
      } 
    #dodawanie {
    display: block;
    position:absolute;
    width: 300px;
	left: 5px;
    top: 2px;
    padding: 0px 0px;
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
    bottom: 15px;
    padding: 200px 35px;
   
} 
h4 {
    position: absolute;
	color: green;
	font-size: 16px;
	font-family: "Trebuchet MS", Times: monospace;
    left: 8px;
    bottom: 45px;
    padding: 200px 35px;
</style>
<body>

  <div class='container'>
    <div id="header">
    <ol>
        <li><a><?php echo 'Witaj '.$_SESSION['login'];?></a>
            <ul>
                <li><a href="#">Edytuj dane</a></li>
                <li><a href="#">Zmień hasło</a></li>
                <li><a href="wyloguj.php">Wyloguj</a></li>
            </ul>
        </li>
        <li><a href="#">Sklepy</a>
            <ul>
                <li><a href="../php/sklep_dodaj.php">Dodaj</a></li>
                <li><a href="../php/sklep_usun.php">Usuń</a></li>
                <li><a href="../php/sklep_wyswietl.php">Wyświetl</a></li>
                
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
      
 <form method="POST" action="sklep_dodaj.php">
 <div id="dodawanie">      
    <h1>Proszę wypełnić wszystkie dane</h1><br>
	<h1>Nazwa sklepu</h1> <input type="text" name="nazwa"/><br>
	<h1>Miasto</h1><input type="text" name="miasto">
	<h1>Ulica</h1><input type="text" name="ulica"><br><br><br>	
	<h1><input type="submit" value="Dodaj" name="dodaj"></h1>
 </div>
</form> 
      
    </div>
</body>
</html>