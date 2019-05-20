
<?php
     

	include ("connect.php");
	$login 	  = $_SESSION['login'];
	$haslo    = $_SESSION['haslo'];
	
		if (!isset($_SESSION['zalogowany_worker']))		
	{
		
		header('Location: logowanie.php');
		exit();
	}
   
    $id_produkt = $_POST['id_produkt'];
    $id_sklep = $_POST['id_sklep']; 
        
    $show_sklep=mysqli_query($conn, "SELECT * FROM sklep  ");
    $show_product = mysqli_query($conn, "SELECT * FROM produkt 
    WHERE id_sklep='$id_sklep'"); 
    
 if (isset($_POST['usun']) && isset($_POST['wybierz_sklep']) ) {
        echo 'test';
   
    $delete = mysqli_query($conn ,"DELETE  FROM produkt WHERE id='$id_produkt'");
        
        if (mysqli_query($conn, $delete)) 
        {
            echo '<div id=green_komunikat>';
                echo'Produkt został usunięty'; 
            echo '</div>';
        }
         else {
    echo "Error: " . $delete . "<br>" . mysqli_error($conn);
}
    }
                 
$conn->close();
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
   
    #del {
        
    float: left;
    top: 40px;
    left: 10px;    
    
    }
    
    #produkty {
    bottom: 80px;
        
    } 
    #produkty > form {       
    padding:  40px;
    float: left;    
    } 
       
    #zdj {  
   top: 25px;    
    }
     
    select {
        width: 50%;
    }
    
    input[type=submit] {	
    float: left;
    width: 30%;
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
         <li><a href="#">Produkty</a>
            <ul>
                <li><a href="../php/produkt_dodaj.php">Dodaj</a></li>       
                <li><a href="../php/produkty_usun.php" >Usuń</a></li>
            </ul>
        </li>    
       <li><a href="../php/zamowienia_przeglad.php">Zamówienia</a></li>
        <li><a href="../index.php">Strona główna</a></li>		     
     </ol>
    </div>

 <div id="wybierz">
 <form method="POST" action="produkty_usun.php">
 <h1> Wybierz sklep z listy </h1><br>
 <select name="id_sklep"> 


<?php      
      while ($row = $show_sklep->fetch_assoc()) 
      {
          
        echo '<option value="'.$row['id'].'"> '.$row['nazwa'].' '.$row['miasto'].' '.$row['ulica'].' </option>';
          $id_sklep = $row['id'];
      }        
 ?>   
</select>     
     <br><br>
<input type="submit" value="Wyświetl" name="wybierz_sklep">
</form>
</div>
<div id="produkty">     
<?php        
     while ($row2 = $show_product->fetch_assoc())
            {   
            echo'<form method="POST" action="produkty_usun.php">';
                echo "<h2>" .$row2['nazwa']. "</h2><br>";
                echo "<h2>Rozmiar:" .$row2['rozmiar']. "</h2><br>";
                echo "<h2>Cena:" .$row2['cena']. " zł</h2><br>";
                echo "<img id='zdj'
                src=../img/".$row2['img']." height='150' width='150'>";
                echo '<input id="del" type="submit" value="Usuń" name="usun">';
                echo '<input type="hidden" value="'.$row2['id'].'" name="id_produkt">';
                echo '</form>';     
            }  
 ?>    
</div>

</div>     

</body>
</html>