<?php
include ("connect.php");

	$login 	    = $_SESSION['login'];
	$haslo      = $_SESSION['haslo'];
    //$id_user    = $_SESSION['id_user'];
    //$id_produkt = $_SESSION['id_produkt'];    
    $show_sklep = mysqli_query($conn, "SELECT * FROM sklep");

	

		if (!isset($_SESSION['zalogowany_worker']))		
	{
		
		header('Location: logowanie.php');
		exit();
    }     
     
        

    $sql = mysqli_query ($conn, "select produkt.nazwa, produkt.img FROM produkt, pozycja_zamowienia,koszykklientasklepu,zamowienia,sklep,users WHERE
    koszykklientasklepu.id_k = pozycja_zamowienia.id_koszykklientasklepu AND
    zamowienia.id = pozycja_zamowienia.id_zamowienia AND
    koszykklientasklepu.id_sklep = sklep.id AND
    koszykklientasklepu.id_user = users.id AND
    produkt.id = koszykklientasklepu.id_produkt");  
   
    $cena = mysqli_query ($conn, "SELECT SUM(cena) FROM 
     produkt,koszykklientasklepu WHERE 
    (koszykklientasklepu.id_sklep = sklep.id) AND 
    (koszykklientasklepu.id_user = users.id) AND
    (produkt.id = koszykklientasklepu.id_produkt)");
    
    $wiersz = mysqli_fetch_assoc($cena);

   
    

   

      
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
 


 <div id="koszyk">

     <?php
     
echo "<div id='total'>Całkowity koszt:" .$wiersz['SUM(cena)']. " zl</div> ";
     
        while ($row = mysqli_fetch_assoc($sql)) 
        { 
           
            
         //   echo '<form method="POST" action="koszyk.php">';       
            echo "<h2>Rozmiar: " .$row['rozmiar']. "</h2>";
            echo "<img id='zdj' src=../img/".$row['img']." height='150' width='150'>";
            echo '<input type="hidden" value="'.$row['id_k'].'" name="id_koszyk">';
         //   echo '<input id="del" type="submit" value="Usuń z koszyka" name="usun">';
         //   echo '</form>';            
        }
            
            
     
     ?>

</div>
   

</div>     

</body>
</html>