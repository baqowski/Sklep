<?php
	include ("connect.php");
	$imie 	  = $_SESSION ['imie'];
	$nazwisko = $_SESSION ['nazwisko'];
	$login 	  = $_SESSION['login'];
	$haslo    = $_SESSION['haslo'];
	
		if (!isset($_SESSION['zalogowany_admin']))		
	{
		
		header('Location: logowanie.php');
		exit();
	}

    function eliteEncrypt($string) {
    // Create a salt
    $salt = md5($string."%*4!#$;\.k~'(_@");

    // Hash the string
    $string = md5("$salt$string$salt");

    return $string;
}

    if (isset($_POST['dodaj']))
{
   $imie = 		($_POST['imie']);
   $nazwisko = 	($_POST['nazwisko']);
   $login = 	($_POST['login']);
   $haslo1 = 	eliteEncrypt($_POST['haslo1']);
   //$conn = 		mysql_real_escape_string(GetFromPost('haslo1'));
   $haslo2 = 	eliteEncrypt($_POST['haslo2']);
   $email = 	($_POST['email']);  
  
 //Udana walidacja? Załóżmy, że tak!
		$status=true;
		$sql_login = mysqli_query($conn,"SELECT login FROM users WHERE login = '$login'"); 
		
		$sql_email = mysqli_query($conn,"SELECT email FROM users Where email = '$email' "); 
		
		//$rekord = $conn->query($zap_login);
		//echo $zap_login;
		if(empty($_POST['imie']) || empty($_POST['nazwisko']) || empty($_POST['login']) || empty($_POST['haslo1']) || empty($_POST['haslo2']) || empty($_POST['email']))
		{
			 $status=false;
			 echo 
			'<h3> Musisz wypełnić wszystkie pola</h3>';
		}
//Sprawdzenie długości imienia nie mniejzsze niz 3 nie wieksze niz 20 
		else if ((strlen($imie)<3) || (strlen($imie)>20))
		{
			$status=false;
			echo
			'<h3>Imie musi posiadać od 3 do 20 znaków i nie może zawierać cyfr i znaków specjalnych np !,@,#,$ </h3>';
		}
// sprawdza czy w loginie uzyto polskich znaków		
		else if (ctype_alnum($login)== FALSE)
		{
			$status=false;
			echo
			'<h3>Nick może składać się tylko z liter i cyfr (bez polskich znaków) </h3>';
		}
//walidacja hasla
		else if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])(?=.*[!@#$%])[0-9A-Za-z!@#$%]{6,15}$/',($_POST['haslo1'])))
		{
			$status=false;
			echo
			'<h3>Password must contain 6 characters of letters, numbers and at least one special character </h3>';
		}	
	/*	else if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])(?=.*[!@#$%])[0-9A-Za-z!@#$%]{6,15}$/',($_POST['haslo2'])))
		{
			$status=false;
			echo
			'<h3>Password must contain 6 characters of letters, numbers and at least one special character </h3>';
		} */ 
//sprawdzenie czy login znajduje sie juz w bazie danych				
		else if (mysqli_num_rows($sql_login)>0)
		{	
			$status=false;
			echo
			'<h3>Login zajęty! Podaj inny </h3>';
		}
//sprawdzenie czy email znajduje sie juz w bazie danych		
		else if (mysqli_num_rows($sql_email)>0) 
		{
			$status=false;
			echo
			'<h3>Podany adres istnieje w Bazie danych! </h3>';
		} 
//sprawdzenie czy hasla sa takie same
		else if ($haslo1 != $haslo2)
		{
			$status=false;
			echo
			'<h3>Hasła sie nie zgadzają! </h3>';
		}
//sprawdzenie czy poprawno wpisano email
		else if (strpos($email, '@') != TRUE)
		{
			$status=false;
			echo
			'<h3>Podano błedny adres email </h3>';
		}
   //$_SESSION['v_imie'] = $imie;
   
   
   if ($status == true){
	   
   
 $sql = ("INSERT INTO `users` VALUES ('NULL','$imie', '$nazwisko','$login','$haslo1','$email', 2 )")
 or die("Błąd w dodaniu do bazy");
	if ($conn->query($sql) == TRUE)
{
   echo '<div id=green_komunikat>';
                echo'Dodano pomyslnie'; 
            echo '</div>';
} 
else 
{
    echo "Error: " . $sql . "<br>" . $conn->error;
}
 //INSERT INTO `users` (`id`, `imie`, `nazwisko`, `login`, `haslo`, `email`) VALUES ('', 'xxx', 'xxx', 'xxxxx', 'zxc', 'qwerty');
//	mysql_close($dbname);
	
 
   }
 
 $conn->close();
}
?>
<!DOCTYPE html>
<html>
  <head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
      <title>Dodaj Sklep</title>
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
        left: 190px;
        font-family: 'Jokerman'; Helvetica: monospace;
        position: relative;
      }
    #dodawanie {
    display: block;
    position:absolute;
    width: 300px;
	left: 5px;
    top: 2px;
    padding: 0px 0px;
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
    bottom: -20px;
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
                <li><a href="#">Zmień hasło</a></li>
                <li><a href="wyloguj.php">Wyloguj</a></li>
            </ul>
        </li>
        <li><a href="#">Sklepy</a>
            <ul>
                <li><a href="../php/sklep_dodaj.php">Dodaj</a></li>
                <li><a href="../php/sklep_usun.php">Usuń</a></li>
                <li><a href="../php/sklep_wyswietl.php">Wyświetl</a></li>
                
            </ul>
        </li>    
        <li><a href="#">Pracownicy</a>
            <ul>
                <li><a href="../php/pracownik_dodaj.php">Dodaj </a></li>
                <li><a href="../php/pracownik_usun.php">Usuń</a></li>
                <li><a href="#">Wyświetl</a></li>
            </ul>
        </li>
        <li><a href="../index.php">Strona główna</a></li>
        </ol>
        </div> 
      
 <form method="POST" action="pracownik_dodaj.php">
 <div id="dodawanie">
    <h1>Proszę wypełnić wszystkie dane pracownika</h1><br>
	<h1>Imię</h1> <input type="text" name="imie"/><br>
	<h1>Nazwisko</h1><input type="text" name="nazwisko">
	<h1>Login</h1><input type="text" name="login"><br>
	<h1>Hasło</h1><input type="password" name="haslo1"><br>
	<h1>Powtórz hasło</h1><input type="password" name="haslo2"><br>
	<h1>Email</h1><input type="text" name="email"><br><br><br>
	<h1><input type="submit" value="Dodaj" name="dodaj"></h1>	
 </div>
</form> 
      
    </div>
</body>
</html>