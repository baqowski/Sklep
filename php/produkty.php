
<?php
     

	include ("connect.php");
	$login 	  = $_SESSION['login'];
	$haslo    = $_SESSION['haslo'];
	
		if (!isset($_SESSION['zalogowany']))		
	{
		
		header('Location: logowanie.php');
		exit();
	}
    
    $sql=mysqli_query($conn, "SELECT * FROM sklep  ");
    

    if (isset($_POST['wybierz_sklep']) && isset($_POST['id_sklep']) && isset($_SESSION['login']) && isset($_SESSION['haslo']))
    { 
       
    $id_sklep = $_POST['id_sklep']; 
    $login = $_SESSION['login'];
    $haslo= $_SESSION['haslo'];    
    $query = mysqli_query($conn, "SELECT * FROM produkt WHERE id_sklep='$id_sklep'");
        
    } 
    
$conn->close();
?>

<!DOCTYPE html>
<html>
  <head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
      <title>Produkty</title>
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
    bottom: 50px;
        
    } 
    #produkty > form {       
    padding:  40px;
    float: left;    
    } 
       
    #zdj {  
   top: 25px;    
    }
     
    h2{
            
        
    }

    
    input[type=submit] {
    float: left;
    width: 50%;
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
 <form method="POST" action="produkty.php">
 <h1> Wybierz sklep z listy </h1><br>
 <select name="id_sklep"> 


<?php      
      while ($row = $sql->fetch_assoc()) 
      {
          
        echo '<option value="'.$row['id'].'"> '.$row['nazwa'].' '.$row['miasto'].' '.$row['ulica'].' </option>'; 
    //    $id_user = $_POST['id_user'];
      //  $id_produkt = $_POST['id_produkt']; 
      }        
 ?>   
</select>     
     <br><br>
	<input type="submit" value="Wyswietl" name="wybierz_sklep">
</form>
</div>

<div id="produkty">     
     
<?php
    
    if (mysqli_num_rows($query)>0)
    {
        
     while ($row2 = $query->fetch_assoc())
            { 
            echo'<form method="POST" action="dodaj_do_koszyka.php">';
                echo "<h2>" .$row2['nazwa']. "</h2><br>";
                echo "<h2>Rozmiar:" .$row2['rozmiar']. "</h2><br>";
                echo "<h2>Cena:" .$row2['cena']. " zł</h2><br>";
                echo "<img id='zdj'
                src=../img/".$row2['img']." height='150' width='150'>";
                echo '<input id="del" type="submit" value="Dodaj do koszyka" name="koszyk">';
                echo '<input type="hidden" value="'.$row2['id'].'" name="id_produkt">';
                echo '</form>';       
            }  
    }
    else {
                echo '<div id=red_komunikat>';
                echo 'Brak produktów!';
                echo '</div>';
        }
 ?>
      
</div>
</div>     

</body>
</html>