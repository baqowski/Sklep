<?php
include ("connect.php");

	$login 	    = $_SESSION['login'];
	$haslo      = $_SESSION['haslo'];   
    $show_sklep = mysqli_query($conn, "SELECT * FROM sklep");

echo $_SESSION['id_user'];
function eliteEncrypt($string) 
{
    // Create a salt
    $salt = md5($string."%*4!#$;\.k~'(_@");

    // Hash the string
    $string = md5("$salt$string$salt");

    return $string;
}    
	

		if (!isset($_SESSION['zalogowany']))		
	{
		
		header('Location: logowanie.php');
		exit();
    }     
     
     $id_sklep = $_POST['id_sklep'];
     $id_produkt = $_POST['id_produkt'];    
     $login = $_SESSION['login'];
     $haslo= eliteEncrypt($_SESSION['haslo']); 
     $select_idUser = mysqli_query($conn, "SELECT id FROM users WHERE 
     (login = '$login') AND haslo = '$haslo' LIMIT 1"); 
     $row = mysqli_fetch_assoc($select_idUser);
     $id_user =  $row['id'];
     
    $sql = mysqli_query ($conn, "SELECT produkt.nazwa, produkt.rozmiar, 
    produkt.cena, 
    produkt.img, 
    koszykklientasklepu.id_k,
    koszykklientasklepu.id_sklep, 
    koszykklientasklepu.id_user,
    produkt.id FROM produkt,koszykklientasklepu WHERE 
    (koszykklientasklepu.id_sklep = '$id_sklep') AND
    (koszykklientasklepu.id_user = '$id_user') AND 
    (produkt.id = koszykklientasklepu.id_produkt)");  
   
    $cena = mysqli_query ($conn, "SELECT SUM(cena) FROM 
     produkt,koszykklientasklepu WHERE 
    (koszykklientasklepu.id_sklep = '$id_sklep') AND 
    (koszykklientasklepu.id_user = '$id_user') AND
    (produkt.id = koszykklientasklepu.id_produkt)");
    $wiersz = mysqli_fetch_assoc($cena);

    echo'fgffffffffffffffff';
   if (isset($_POST['usun']) && isset ($_POST['id_koszyk'])) {
       
    echo'asddfsdfsfsdfsdfsdfsd';
       
      $id_koszyk = $_POST['id_koszyk'];  
       
      $delete = "DELETE  FROM koszykklientasklepu WHERE  id_k = '$id_koszyk'";
    
       if (mysqli_query($conn, $delete)) {
            echo '<div id=green_komunikat>';
            echo'Usunięto z koszyka'; 
            echo '</div>';   
           
           
       } else {
        echo "Error deleting record: " . $conn->error;
       }
       
   } 
    

   

      
$conn->close();
?>
<!DOCTYPE html>
<html>
  <head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
      <title>Koszyk</title>
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
   
#del {
    float: left;
    top: 50px;
    left: 120px;
    }
    
#koszyk {
    bottom: 50px;
        
} 
#koszyk > form {       
    padding: 30px;
    float: left;    
} 
       
#zdj {  
   top: 25px;    
    }
     
           
#total 
    {
    
    width:380px;
    margin: 0;    
    bottom:120px;
    font-size: 20px;
    color: darkgreen;    
}

     h2{
            
    float: left;
    right: -143px;     
    }

    #buton {
        
        margin: -15.5;
        width: 30%;
        float: left;
        bottom: 120px;
      
    }  
    form > #buton {
        margin: -15.5;
        width: 200px;
        float: left;
        bottom: 20px;
      
    }  

    #koszyk > form > #button {
        left: 200px;
	
  	
}
    
    input[type=submit] {
	
    float: left;
    width: 40%;
    left: 40px;
    bottom: 8px;
    background-color: #333;
    color: white;
    padding: 8px 8px;
    margin: 4px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;	
}
    select {
        width: 50%;
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
 
<div id="wybierz">
 <form method="POST" action="koszyk.php">
 <h1> Wybierz sklep z listy </h1><br>
 <select name="id_sklep"> 

<?php      
      while ($row = $show_sklep->fetch_assoc()) 
      {
          
        echo '<option value="'.$row['id'].'"> '.$row['nazwa'].' '.$row['miasto'].' '.$row['ulica'].' </option>'; 
         
      }        
 ?>   
</select>     
     <br><br>
	<input type="submit" value="Wyswietl" name="wybierz_sklep">
</form>
</div>

 <div id="koszyk">
<!--    <form method="POST" action="koszyk.php>-->
<form method="POST" action="formularz_zamowienia.php">
    
<input id="buton" type="submit" value="Zamawiam" name="zamowienie">
</form>     
     <?php
     
echo "<div id='total'>Całkowity koszt:" .$wiersz['SUM(cena)']. " zl</div> ";
     
        while ($row = mysqli_fetch_assoc($sql)) 
        { 
             
            echo '<form method="POST" action="koszyk.php">';       
            echo "<h2>Rozmiar: " .$row['rozmiar']. "</h2>";
            echo "<img id='zdj' src=../img/".$row['img']." height='150' width='150'>";
            echo '<input type="hidden" value="'.$row['id_k'].'" name="id_koszyk">';  
            echo '<input id="del" type="submit" value="Usuń z koszyka" name="usun">';
            echo '</form>';                   
        }           

     ?>

</div>
   

</div>     

</body>
</html>