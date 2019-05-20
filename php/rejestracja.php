
<?php 
include ("connect.php");

function eliteEncrypt($string) {
    // Create a salt
    $salt = md5($string."%*4!#$;\.k~'(_@");

    // Hash the string
    $string = md5("$salt$string$salt");

    return $string;
}


if (isset($_POST['rejestruj']))
{
   $imie = 		($_POST['imie']);
   $nazwisko = 	($_POST['nazwisko']);
   $login = 	($_POST['login']);
   $haslo1 = 	eliteEncrypt($_POST['haslo1']);
   //$conn = 		mysql_real_escape_string(GetFromPost('haslo1'));
   $haslo2 = 	eliteEncrypt($_POST['haslo2']);
   $email = 	($_POST['email']);    
   $adresdo = $email;     
   $temat = "Potwierdzenie rejestracji w serwisie";
   $adresod = "sklep_internetowy.pl";
   $zawartosc = "Aby potwierdzić rejestrację w serwisie kliknij na poniższy link http://localhost/sklep/php/potwierdzenie.php "; 
   $adresod = "sklep_internetowy.pl"; 
       
 //Udana walidacja? Załóżmy, że tak!
		$status=true;
		$sql_login = mysqli_query($conn,"SELECT login FROM users WHERE login = '$login'"); 
		$sql_email = mysqli_query($conn,"SELECT email FROM users Where email = '$email' "); 
	
		if(empty($_POST['imie']) || empty($_POST['nazwisko']) || empty($_POST['login']) || empty($_POST['haslo1']) || empty($_POST['haslo2']) || empty($_POST['email']))
		{
			 $status=false;
			 echo '<div id=red_komunikat>';
				echo 'Musisz wypełnić wszystkie dane!';
                echo '</div>';
		}
		else if ((strlen($imie)<3) || (strlen($imie)>20))
		{
			$status=false;
			echo
			'<h3>Imie musi posiadać od 3 do 20 znaków i nie może zawierać cyfr i znaków specjalnych np !,@,#,$ </h3>';
		}	
		else if (ctype_alnum($login)== FALSE)
		{
			$status=false;
			echo '<div id=red_komunikat>';
            echo'Nick może składać się tylko z liter i cyfr (bez polskich znaków)'; 
            echo '</div>';
		}
		else if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])(?=.*[!@#$%])[0-9A-Za-z!@#$%]{6,15}$/',($_POST['haslo1'])))
		{
			$status=false;
			echo '<div id=red_komunikat>';
            echo'Hasło musi zawierać minimum 6 znaków (cyfry, małe, duże litery i znak specjalny np # $ %)'; 
            echo '</div>';
		}				
		else if (mysqli_num_rows($sql_login)>0)
		{	
			$status=false;
			
			echo '<div id=red_komunikat>';
            echo'Login jest zajęty! Podaj inny'; 
            echo '</div>';
		}
		else if (mysqli_num_rows($sql_email)>0) 
		{
			$status=false;
			echo '<div id=red_komunikat>';
            echo'Podany adres istnieje w Bazie danych!'; 
            echo '</div>';
			
		} 
		else if ($haslo1 != $haslo2)
		{
			$status=false;
			echo '<div id=red_komunikat>';
            echo'Hasła sie nie zgadzają!'; 
            echo '</div>';
			
		}
		else if (strpos($email, '@') != TRUE)
		{
			$status=false;
			echo '<div id=red_komunikat>';
            echo'Błędny email! brak @'; 
            echo '</div>';;
		}
   
   
   
   if ($status == true){
	   
      $encoding = "utf-8";
    // Preferences for Subject field
    $subject_preferences = array(
        "input-charset" => $encoding,
        "output-charset" => $encoding,
        "line-length" => 76,
        "line-break-chars" => "\r\n"
    );
   // Mail header
    $from_name = "Internetowy sklep odzieżowy";
    $header = "Content-type: text/html; charset=".$encoding." \r\n";
    $header .= "From: ".$from_name." <".$adresod."> \r\n";
    $header .= "MIME-Version: 1.0 \r\n";
    $header .= "Content-Transfer-Encoding: 8bit \r\n";
    $header .= "Date: ".date("r (T)")." \r\n";
    $header .= iconv_mime_encode("Subject", $temat, $subject_preferences);
    mail($adresdo, $temat, $zawartosc, $header);
            echo '<div id=green_komunikat>';
            echo'Wiadomość z linkiem aktywacyjnym  Została wysłana!'; 
            echo '</div>';
       echo '<form method="POST" action="potwierdzenie.php">'
       echo '<input type="hidden" name="imie">';
       echo '<input type="hidden" name="nazwisko">';
       echo '<input type="hidden" name="login">';
       echo '<input type="hidden" name="email">';
       echo '<input type="hidden" name="haslo1">';
           echo '</form>';
   }
 
 $conn->close();
}
?>
 

<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<title>Rejestracja w serwisie</title>
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
#rejestracja {
    display: block;
    position: relative;
    width: 300px;
	left: 5px;
    bottom: -5px;
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
              <li><img src="../img/logo4.png"></img></li>
		      <li><a href="../php/rejestracja.php">Rejestracja</a></li>
		      <li><a href="../php/logowanie.php">Logowanie</a></li>
		      <li><a href="../php/produkty.php">Produkty</a></li>
		      <li><a href="../index.php">Strona główna</a></li>
            </ol>
        </div>
 
<form method="POST" action="rejestracja.php">
 <div id="rejestracja">
    <h1>Proszę wypełnić wszystkie dane</h1><br>
	<h1>Imię</h1> <input type="text" name="imie"/><br>
	<h1>Nazwisko</h1><input type="text" name="nazwisko">
	<h1>Login</h1><input type="text" name="login"><br>
	<h1>Hasło</h1><input type="password" name="haslo1"><br>
	<h1>Powtórz hasło</h1><input type="password" name="haslo2"><br>
	<h1>Email</h1><input type="text" name="email"><br><br><br>
	<h1><input type="submit" value="Zarejestruj" name="rejestruj"></h1>	
 </div>
</form> 

</div>
</body>

</html>



