<?php
	include ("connect.php");

	$login 	  = $_SESSION['login'];
	$haslo    = $_SESSION['haslo'];
	
		if (!isset($_SESSION['zalogowany_admin']))		
	{
		
		header('Location: logowanie.php');
		exit();
	}
   
    $sql=mysqli_query($conn, "SELECT *  FROM users WHERE perm=2 ");
    
    if (isset($_POST['edytuj']) && isset($_POST['id']))
{
    $id = $_POST['id'];
    $delete = mysqli_query($conn ,"DELETE FROM users WHERE id='$id' AND perm=2");
        
    if ($conn->query($delete) == FALSE)
{
    echo 
	'<h4> Usunieto</h4>';
} 
else 
{
    echo "Error: " . $delete . "<br>" . $conn->error;
//    '<h3> Usunieto</h3>';
}
        
        
    $conn->close();
}
?>
<!DOCTYPE html>
<html>
  <head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
      <title>Edycja</title>
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
    width: 400px;
	left: 7px;
    top: 185px;
    padding: 20px 0px;
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
	width: 30%;
    background-color: #333;
    color: white;
    padding: 8px 8px;
    margin: 4px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    left: 120px;
    bottom: 55px;
    
}
    h3 {
    position: absolute;
	color: red;
	font-size: 16px;
	font-family: "Trebuchet MS", Times: monospace;
    left: 240px;
    bottom: 300px;
    padding: 20px 35px;
   
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
        right: 80px;
        padding: 10px 10px;
    }
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
                <li><a href="../php/sklep_dodaj.php">Dodaj</a></li>       <li><a href="../php/sklep_usun.php" >Usuń</a></li>
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
      
 <div id="wybierz">
 <form method="POST" action="pracownik_usun.php">
     <h1> Wybierz pracownika z listy </h1><br>
 <select name="id"> 
<?php   
      while ($row = $sql->fetch_assoc()) 
      {
          
        echo '<option value="'.$row['id'].'"> '.$row['imie'].' '.$row['nazwisko'].' </option>';       
      }
     
    ?>
</select>
     <br><br>
	<input type="submit" value="Usun" name="edytuj">	
</form> 
</div>
     
</div>
</body>
</html>