<?php
include ("connect.php");
function eliteEncrypt($string) {
    // Create a salt
    $salt = md5($string."%*4!#$;\.k~'(_@");

    // Hash the string
    $string = md5("$salt$string$salt");

    return $string;
}    

	$login 	  = $_SESSION['login'];
	$haslo    = $_SESSION['haslo'];
	
		if (!isset($_SESSION['zalogowany']))		
	{
		
		header('Location: logowanie.php');
		exit();
	}
    

    if (isset($_POST['koszyk']))
    {
  
        $id_produkt = $_POST['id_produkt'];
        $login = $_SESSION['login'];
        $haslo= eliteEncrypt($_SESSION['haslo']);
  
        $query2 = mysqli_query($conn, "SELECT id FROM users WHERE (login = '$login') AND haslo = '$haslo' LIMIT 1"); 
        
        $query3 = mysqli_query($conn, "SELECT id_sklep FROM produkt WHERE id='$id_produkt' LIMIT 1"); 
        
        $row = mysqli_fetch_assoc($query2);
        $id_user =  $row['id'];
         
        $row2 = mysqli_fetch_assoc($query3);
        $id_sklep =  $row2['id_sklep'];

       $sql = "INSERT INTO koszykklientasklepu (id_k,id_sklep,id_user,id_produkt) VALUES ('NULL','$id_sklep','$id_user',$id_produkt)";
        
    if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
        
    }      
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

  


        
 

</div>

 
</body>
</html>