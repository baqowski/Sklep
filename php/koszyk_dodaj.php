<?php
include ("connect.php");
	$login 	  = $_SESSION['login'];
	$haslo    = $_SESSION['haslo'];
	
		if (!isset($_SESSION['zalogowany']))		
	{
		
		header('Location: logowanie.php');
		exit();
	}
    $id_user = $_POST['id_user'];
    $query= ("SELECT * From users WHERE id ='$id_user'");
      if ($result = mysqli_query($conn,$query))
        {
            while ($row = mysqli_fetch_assoc($result))
            {    
                echo $row['id'] ;     

            }
          
             //mysqli_free_result($result);
        } 
echo 'test0';
    //include ("produkty.php");
    if (isset($_POST['koszyk']) && isset($_POST['id_sklep']))
    {
        echo 'test1';
       $id_sklep = $_POST['id_sklep'];
       $id_user = $_POST['id_user'];
       $sql = "INSERT INTO koszykklientasklepu (id,id_sklep,id_user) VALUES ('NULL','$id_sklep','$id_user')";
        
    if (mysqli_query($conn, $sql)) {
    echo '<div id=green_komunikat>';
        echo'Dodano do koszyka'; 
            echo '</div>';   
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
    
     div   {
        background-color:beige;
        width: 50%;
        top: 10px;    
    }
    
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
              

     
    #wybierz {
    margin 0px;
    background-color:bisque;
    position:absolute;
    display: block;    
    width: 30%;
    height: 120px;
    bottom: 0px;
    padding: 20px 5px;
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
   
	width: 20%;
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
    left: 140px;
    bottom: 200px;
    padding: 200px 85px;
   
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
    #produkty {
        
    position: inherit;
    padding: 20px 100px;
        left: 500px;
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