<?php
	include ("connect.php");
	$login 	  = $_SESSION['login'];
	$haslo    = $_SESSION['haslo'];
	
		if (!isset($_SESSION['zalogowany_admin']))		
	{
		
		header('Location: logowanie.php');
		exit();
	}
   
    $sql=mysqli_query($conn, "SELECT *  FROM sklep ");
    
    if (isset($_POST['usun']) && isset($_POST['id']))
{
    $id = $_POST['id'];
    $delete = mysqli_query($conn ,"DELETE FROM sklep WHERE id='$id'");
        
    if ($conn->query($delete) == FALSE)
{

			 echo "<div id='green_komunikat'>Sklep został usunięty</div>";
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
      <title>Usuń</title>
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
   
    h1 {
    font-size: 18px;
    text-align: left;
    font-family: "Trebuchet MS", Times: monospace;
    text-align: center;
}

#wybierz > form > input[type=submit] {
	width: 20%;
    background-color: #333;
    color: white;
    padding: 8px 8px;
    margin: 4px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    left: 280px;
    bottom: 55px;
    

    select {
        right: 80px;
        padding: 10px 10px;
        width: 220px;
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
 <form method="POST" action="sklep_usun.php">
     <h1> Wybierz sklep z listy </h1><br>
 <select name="id"> 
<?php
//     $id = ($_POST['id']);
    
      while ($row = $sql->fetch_assoc()) 
      {
          
        echo '<option value="'.$row['id'].'"> '.$row['nazwa'].' '.$row['miasto'].' '.$row['ulica'].' </option>'; 
         
      }
     
        
    ?>
</select>
     <br><br>
	<input type="submit" value="Usun" name="usun">	
</form> 
</div>
     
</div>
</body>
</html>