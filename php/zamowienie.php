<?php
	include ("connect.php");
	$login 	  = $_SESSION['login'];
	$haslo    = $_SESSION['haslo'];
	
		if (!isset($_SESSION['zalogowany']))		
	{
		
		header('Location: logowanie.php');
		exit();
	}

$show_sklep = mysqli_query($conn, "SELECT * FROM sklep");

   //  $id_sklep = $_POST['id_sklep'];
  //  $id_user = $_POST['id_user'];
 //    $id_k = $_POST['id_k']; 
       
    //echo $_POST['id_user'];
     //echo $_POST['id_sklep'];
     //echo $_POST['id_k'];                            
    
    if (isset($_POST['zamowienie']))
{
        echo 'test';
   $imie = 		($_POST['imie']);
   $nazwisko = 	($_POST['nazwisko']);
   $ul = 	    ($_POST['ul']);
   $nr = 	    ($_POST['nr']); 
   $kod = 	    ($_POST['kod']);
   $miasto = 	($_POST['miasto']);
         
     $insert = mysqli_query ($conn, "INSERT INTO zamowienia
(id, imie, nazwisko, ulica, nr, kod, miasto) VALUES 
(NULL, '$imie', '$nazwisko', '$ul', '$nr', '$kod', '$miasto')");
                        
    $id_zamowienia = $_POST['id_zamowienia'];
    $id_koszykklietnasklepu = $_POST['koszykklientasklepu']; 
        
      $status=true;
        
   if(empty($_POST['imie']) || empty($_POST['nazwisko']) || empty($_POST['ul']) || empty($_POST['nr']) || empty($_POST['kod']) || empty($_POST['miasto']))
		{
			 $status=false;
			 echo '<div id=red_komunikat>';
				echo 'Musisz wypełnić wszystkie dane!';
                echo '</div>';
		}
            
    if ($status == true){
        echo 'jestem tu';
        if (mysqli_query($conn, $insert)) { 
            echo "Dodano zamowienie";
            $select_idZamowenia = mysqli_query ($conn,"SELECT id FROM zamowienie WHERE id = '$id_zamowienia' LIMIT 1 ");
            $row = mysqli_fetch_assoc($select_idZamowenia);
            $id_zamowienia = $row['id'];
            $insert2 = mysqli_query ($conn, "INSERT INTO pozycja_zamowienia (id, id_zamowienia, id_koszykklientasklepu) VALUES (NULL, '$id_zamowienia', '$id_koszykklientasklepu')");
                    
                        if (mysqli_query($conn, $insert2)) {
                         
                            
                        }   else {
                    echo "Error: " . $insert2 . "<br>" . mysqli_error($conn);
                       }
                } else {
                    echo "Error: " . $insert . "<br>" . mysqli_error($conn);
                       }
                            }
}
?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title>Zaologowano</title>
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
    
    #zamowienie {
    display: block;
    position: relative;
    width: 300px;
	left: 5px;
    bottom: 90px;
    padding: 5px 2px;
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
    bottom: -10px;
    padding: 60px 35px;   
}
h4 {
    position: absolute;
	color: green;
	font-size: 16px;
	font-family: "Trebuchet MS", Times: monospace;
    left: 8px;
    bottom: -20px;
    padding: 60px 35px;  
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
 <h1> Wybierz sklep z listy dla którego czchcesz zlozyc zamowienie </h1><br>
 <select name="id_sklep"> 

<?php      
      while ($row = $show_sklep->fetch_assoc()) 
      {
          
        echo '<option value="'.$row['id'].'"> '.$row['nazwa'].' '.$row['miasto'].' '.$row['ulica'].' </option>'; 
         
      }        
 ?>   
</select>     
     <br><br>
</form>
</div>

<div id="zamowienie">       
<form method="POST" action="zamowienie.php">
 
    <h1>Proszę wypełnić wszystkie dane</h1><br>
	<h1>Imię</h1> <input type="text" name="imie"/><br>
	<h1>Nazwisko</h1><input type="text" name="nazwisko">
	<h1>Ulica</h1><input type="text" name="ul"><br>
	<h1>Nr lokalu/domu</h1><input type="text" name="nr"><br>
	<h1>Kod pocztowy</h1><input type="text" name="kod"><br>
	<h1>Miasto</h1><input type="text" name="miasto"><br><br><br>
    
    <?php
     

     $select_idK = mysqli_query($conn, "SELECT id_k FROM koszykklientasklepu,produkt,sklep,users WHERE (sklep.id = koszykklientasklepu.id_sklep) AND (users.id = koszykklientasklepu.id_user) AND (produkt.id = koszykklientasklepu.id_produkt)");
     while ($row = mysqli_fetch_assoc($select_idK)){
     $id_koszykklientasklepu =  $row['id_k'];
         echo $row['id_k'];
     }
    ?>
   
    <input type="hidden" value="<?php $row['id_k']  ?>" name="id_k" >
	<input type="submit" value="Kupuję" name="zamowienie">
    
 
</form> 
</div>
	
		
       
    
	</div>
	


</body>

</html>