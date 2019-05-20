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
    

        
    $conn->close();

?>
<!DOCTYPE html>
<html>
  <head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
      <title>Lista sklepów</title>
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
     #show {
    display: block;
    position:absolute;
	left: 7px;
    top: 285px;
    padding: 20px 0px;
    border-radius: 5px;
    text-align: center;
    
}
    #naglowek {
    position: absolute;
	color: darkblue;
	font-size: 25px;
	font-family: "Trebuchet MS", Times: monospace;
    left: 8px;
    bottom: 210px;
    width: 100
    padding: 20px 35px;
   
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
    left: 8px;
    bottom: 15px;
    padding: 20px 35px;
   
} 
       tr > td {
           
         background-color: chartreuse;
         padding: 5px 5px;
         font-size: 20px;
         color: darkblue;
            width: 150px;
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
                <li><a href="../php/sklep_dodaj.php">Dodaj</a></li>       
                <li><a href="../php/sklep_usun.php" >Usuń</a></li>
                <li><a href="../php/sklep_wyswietl.php">Wyświetl</a></li>
            </ul>
        </li>    
        <li><a href="#">Pracownicy</a>
            <ul>
                <li><a href="../php/pracownik_dodaj.php">Dodaj </a></li>
                <li><a href="../php/pracownik_usun.php">Usuń</a></li>
                <li><a href="../php/pracownik_wyswietl.php">Wyświetl</a></li>
            </ul>
        </li>
        <li><a href="../index.php">Strona główna</a></li>
        </ol>
        </div> 
    <div id="show">
    <table border="1">
     <h3 id='naglowek'>Lista sklepów w systemie <br><br>
      <?php  
        
         echo "<tr>";
           echo "<td>"; 
                echo 'Id';
                     echo "<td>"; 
                         echo 'Nazwa';
                            echo "<td>"; 
                                echo 'Ulica';
                                    echo "<td>"; 
                                        echo 'Miejscowość';
                                    echo "</td>";
                            echo "</td>";
                      echo "</td>";
            echo "</td>";
    echo "</tr>";
        
     while ($row = $sql->fetch_assoc())    
      {          
        echo "<tr><td>" . $row['id'] . "</td><td>" . $row['nazwa'] . "</td><td>" . $row['miasto'] . "</td><td>" . $row['ulica'] . "</td></tr>";    
      }   
      ?>   
                       
     </table>
     </div>  
 </div>
     

</body>
</html>