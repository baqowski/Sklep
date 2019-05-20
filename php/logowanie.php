<?php
	include ("connect.php");
    function eliteEncrypt($string) {
    // Create a salt
    $salt = md5($string."%*4!#$;\.k~'(_@");

    // Hash the string
    $string = md5("$salt$string$salt");

    return $string;
}
    

	
if (isset($_POST['zaloguj']))
	{
        
		$login = ($_POST['login']);
		$haslo = ($_POST['haslo']);
        $haslo2 = md5($_POST['haslo']);
		$encryptedHaslo = eliteEncrypt($_POST['haslo']);
    
		$sql_user = mysqli_query ($conn, "Select  login, haslo, perm FROM users WHERE
        (login = '$login') AND 
        (haslo = '$encryptedHaslo') AND
        (perm = 1)");
        $sql_worker = mysqli_query ($conn, "Select  login, haslo, perm FROM users WHERE 
        (login = '$login') AND 
        (haslo = '$encryptedHaslo') AND
        (perm = 2)");
        $sql_admin = mysqli_query ($conn, "Select  login, haslo, perm FROM users WHERE 
        (login = '$login') AND 
        (haslo = '$haslo2') AND 
        (perm = 3)");
			if(empty($_POST['login']) || empty($_POST['haslo']))
				{
                //echo 'test2';
					echo '<div id=red_komunikat>';
                    echo 'błędny login lub hasło!';
                    echo '</div>';		
				}				
			else if (mysqli_num_rows($sql_user) > 0)
			{
				echo '<div id=red_komunikat>';
				echo 'Zostałeś zalogowany!';
                echo '</div>';
				$_SESSION ['zalogowany'] = TRUE;
                $_SESSION ['zalogowany_admin'] = FALSE;
                $_SESSION ['zalogowany_worker'] = FALSE;
				$_SESSION ['login'] = $login;
				$_SESSION ['haslo'] = $haslo;
				header ('Location: zalogowany.php'); 
			}
            else if (mysqli_num_rows($sql_admin) > 0)
            {
                //zalogowano pomyslnie
				echo '<div id=green_komunikat>';
				echo 'Zostałeś zalogowany!';
                echo '</div>';
                echo 'test';
				$_SESSION ['zalogowany_admin'] = TRUE;
                $_SESSION ['zalogowany'] = FALSE;
                $_SESSION ['zalogowany_worker'] = FALSE;
				$_SESSION ['login'] = $login;
				$_SESSION ['haslo'] = $haslo;
				header ('Location: admin.php');                            
            }
            else if (mysqli_num_rows($sql_worker) > 0)
            {
                //zalogowano pomyslnie
				echo '<div id=green_komunikat>';
				echo 'Zostałeś zalogowany!';
                echo '</div>';
				$_SESSION ['zalogowany_worker'] = TRUE;
                $_SESSION ['zalogowany'] = FALSE;
                $_SESSION ['zalogowany_admin'] = FALSE;
				$_SESSION ['login'] = $login;
				$_SESSION ['haslo'] = $haslo;
				header ('Location: worker.php');                            
            }
			else
			{
					
				    echo '<div id=red_komunikat>';
                    echo 'błędny login lub hasło';
                    echo '</div>';
			}		
	}
	

?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Logowanie</title>
<link href="../css/style.css" rel="stylesheet" > </link>
</head>
<style>
    

    
   #panel_logowania { 
    width: 180px;
    bottom: 160px;
    height: 148px;
    background-color: aliceblue;
    padding: 7px 15px;     
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;    
}    
input[type=text]{
    width: 90%;
    padding: 6px 6px;     
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;  
}

input[type=password]{
    width: 90%;
    padding: 6px 6px;  
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;   
}
input[type=submit]{
    width: 90%;
    bottom: 5px;
    padding: 6px 6px;  
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;   
}    
    
   h3 {
    position: absolute;
	color: red;
	font-size: 16px;
	font-family: "Trebuchet MS", Times: monospace;
    left: -20px;
    bottom: 410px;
    padding: 20px 35px;
   
}
    h4 {
    position: absolute;
	color: green;
	font-size: 16px;
	font-family: "Trebuchet MS", Times: monospace;
    left: -20px;
    bottom: 410px;
    padding: 60px 35px;  
}  
</style>
<body>
	<div class='container'>
    
        <div id="header">
            <ol>
              <li><img src="../img/logo4.png"></img></li>
		      <li><a href="../php/rejestracja.php">Rejestracja</a></li>
		      <li><a href="../php/logowanie.php">Logowanie</a></li>
		      <li><a href="../php/produkty.php">Produkty</a></li>
		      <li><a href="../index.php">Strona główna</a></li>
            </ol>
        </div>
   
    <div id="panel_logowania">
            <form method="POST" action="logowanie.php">
                
                    <label><b>Login:</b></label><input type="text" name="login"><br>
                    <label><b>Hasło:</b></label><input type="password" name="haslo"><br><br>	
	               <input type="submit" value="Zaloguj" name="zaloguj">	
                
            </form> 
    </div>
    
	   </div>


</body>

</html>


