<?php
	include ("connect.php");

	$login 	  = $_SESSION['login'];
	$haslo    = $_SESSION['haslo'];
	
		if (!isset($_SESSION['zalogowany_worker']))		
	{
		
		header('Location: logowanie.php');
		exit();
	}
    $sql=mysqli_query($conn, "SELECT * FROM sklep ");


    if (isset($_POST['dodaj']) && isset($_POST['id']))
    {   
        echo 'test';
        $id = ($_POST['id']);
        $nazwa = ($_POST['nazwa']);
        $rozmiar = ($_POST['rozmiar']);
        $cena = ($_POST['cena']);
        $zdjecie = ($_POST['zdjecie']);
        $status = true;
        echo $id;
        if(empty($_POST['nazwa']) || empty($_POST['rozmiar']) || empty($_POST['cena'])|| empty($_POST['zdjecie'])) 
		{
			 $status=false;
			 echo 
			'<h3> Musisz wypełnić wszystkie pola</h3>';
		}
        if ($status == true){
            $sql_add = ("INSERT INTO `produkt` VALUES ('NULL','$nazwa', '$rozmiar', '$cena', '$zdjecie','$id')")
        or die("Błąd w dodaniu do bazy");
	if ($conn->query($sql_add) == TRUE)
{
    echo 
	'<h4> Dodano pomyslnie !</h4>';
} 
else 
{
    echo "Error: " . $sql_add . "<br>" . $conn->error;
}
        } 
        $conn->close(); 
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
              
      #dodawanie {
    display: block;
    position:absolute;
    width: 300px;
	left: 5px;
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
    bottom: 20px;
    
}
    h3 {
    position: absolute;
	color: red;
	font-size: 16px;
	font-family: "Trebuchet MS", Times: monospace;
    left: 140px;
    bottom: 200px;
    padding: 200px 85px;
   
}
    h4 {
    position: absolute;
	color: green;
	font-size: 16px;
	font-family: "Trebuchet MS", Times: monospace;
    left: 240px;
    bottom: 250px;
    padding: 60px 35px;  
}        
    
    select {
        right: 0px;
        padding: 10px 10px;
    
    }
<body>
</style>
    
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
                <li><a href="../php/produkt_wyswietl.php">Wyświetl</a></li>
            </ul>
        </li>    
       <li><a href="#">Zamówienia</a>
            <ul>
                <li><a href="../php/zamowienia_dodaj.php">Dodaj </a></li>
                <li><a href="../php/zamowienia_usun.php">Usuń</a></li>
                <li><a href="../php/zamowienia_wyswietl.php">Wyświetl</a></li>
            </ul>
        </li>
        <li><a href="../index.php">Strona główna</a></li>
	
		
       
     </ol>
    </div>
 
<form method="POST" action="produkt_dodaj.php">
<div id="dodawanie">      
    <h1>Proszę wypełnić wszystkie dane</h1><br>
	<h1>Nazwa</h1> <input type="text" name="nazwa"/><br>
	<h1>Rozmiar</h1><input type="text" name="rozmiar"><br>
    <h1>Cena</h1><input type="text" name="cena"><br>    
	<h1>Zdjecie</h1><input type="file" name="zdjecie"><br><br>
    <h1> Wybierz sklep do którego chcesz dodać produkt </h1><br>
<select name="id">
<?php
      while ($row = $sql->fetch_assoc()) 
      {       
        echo '<option value="'.$row['id'].'"> '.$row['nazwa'].' '.$row['miasto'].' '.$row['ulica'].' </option>'; 
          $id = ($_POST['id']);
      }        
    ?>
</select>     
    <br><br> 
    <br>    
	<h1><input type="submit" value="Dodaj" name="dodaj"></h1>
</div>
</form> 
        
	</div>

</body>

</html>