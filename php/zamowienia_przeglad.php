<?php
	include ("connect.php");
	$login 	  = $_SESSION['login'];
	$haslo    = $_SESSION['haslo'];
	
		if (!isset($_SESSION['zalogowany_worker']))		
	{
		
		header('Location: logowanie.php');
		exit();
	}
   
    $sql=mysqli_query($conn, "SELECT *  FROM sklep ");
    
    $show = mysqli_query($conn, "SELECT * FROM zamowienia ");

        
    $conn->close();

?>
<!DOCTYPE html>
<html>
  <head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
      <title>Przegląd zamówień</title>
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
    padding: 5px 0px;
    border-radius: 5px;
    text-align: center;
        background-color: aqua;
    
}
    #naglowek {
    position: absolute;
	color: darkblue;
	font-size: 30px;
	font-family: "Trebuchet MS", Times: monospace;
    left: 400px;
    bottom: 650px;
    width: 100;
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
        padding: 7px 5px;
        font-size: 16px;
        color: darkblue;
        width: 250px;
    }
 tr >  td  >   select  {
        margin: 0px;
        float: left;
        width: 250px;     
        padding: 7px 5px;
        position: static;
    
    }
     tr > td > #przycisk  {
       padding: 0;
         width: 100px;
         height: 25px;
         position: static;
        
         
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
         <li><a href="#">Produkty</a>
            <ul>
                <li><a href="../php/produkt_dodaj.php">Dodaj</a></li>       
                <li><a href="../php/produkt_usun.php" >Usuń</a></li>
                <li><a href="../php/produkt_wyswietl.php">Wyświetl</a></li>
            </ul>
        </li>    
       <li><a href="../php/zamowienia.php">Zamówienia</a>
        </li>
        <li><a href="../index.php">Strona główna</a></li>   
     </ol>
    </div>
           
    <div id="show">
    <table border="1">
     <h3 id='naglowek'>Lista zamówien w systemie <br><br>
      <?php  
        echo '<form method="POST" action="zamowienia_przeglad.php">';
         echo "<tr><td>Id zamówienia</td><td>Imię<td>Nazwisko</td><td> Ulica</td><td>Nr</td><td>Kod pocztowy</td><td>Miasto</td><td> Status </td><td> Ustaw status </td><td> Potwierdź </td><td> Produkty
          
         </td> </tr>";
          echo '</form>';
        
     while ($row = $show->fetch_assoc())    
      {          
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td><td>" . $row['imie'] . "</td><td>" . $row['nazwisko'] . "</td><td>" . $row['ulica'] . "</td><td>"  . $row['nr'] .  "</td><td>" . $row['kod'] . "</td><td>" . $row['miasto'] . "</td><td>" . $row['status'] . "</td><td><select name='id' >
        <option value='zapłacono'>Zapłacono </option> 
        <option value='wysłana'>Wysłano </option>  
        <option value='dostarczona'>Dostarczono </option>  
        </select></td>";
        echo  '<td><input id="przycisk" type="submit" value="Aktualizuj" name="update"> </td>';       
        echo  '<form method="POST" action="produkty_zamowienia.php"><td><input id="przycisk" type="submit" value="Produkty" name="show"> </form> </td>';
        echo "</tr>"  ;

      }   
      ?>   
                       
     </table>
     </div>  
 </div>
     

</body>
</html>