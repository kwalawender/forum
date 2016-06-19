<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Logowanie</title>
        
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css//bootstrap-theme.min.css" rel="stylesheet">
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
    </head>

    <body>
        <center><h1>Logowanie</h1></center>
        <form class="form" action='logowanie.php' method='post'>
            <div class="form-group">
            <label for="nameField">Nazwa użytkownika</label>
            <input type='text' class="form-control" id="nameField" name='login' placeholder="Wprowadź swoją nazwę użytkownika."/>
            </div>            
            
            <div class="form-group">
            <label for="hasloField">Hasło</label>
            <input type='password' class="form-control" id="hasloField" name='haslo' placeholder="Wpisz hasło."/>
            </div>  
            
 
    <input type='submit' class="btn btn-primary" name='loguj' value='Zaloguj'/>
        <button type="reset" class="btn btn-default">Wyczyść</button>
        <a href="rejestracja.php" class="btn btn-danger">REJESTRACJA</a>
            </center>
        </form>
</body>
</html>

<?php include("polaczenie.php"); ?>
<?php

if (isset($_POST['loguj']))
{
	$login = ($_POST['login']);
	$haslo = ($_POST['haslo']);

        $stmt = $pdo->query("SELECT idUzytkownika, Nazwa, Haslo FROM uzytkownicy WHERE Nazwa= '$login' AND Haslo = '$haslo'");
	if($stmt->rowCount()!=0)
	{ 
            foreach($pdo->query("SELECT idUzytkownika, Nazwa, Haslo, Admin FROM uzytkownicy WHERE Nazwa= '$login' AND Haslo = '$haslo'")as $row)
            {
                $_SESSION['zalogowany'] = true;
		$_SESSION['idUzyt'] =$row['idUzytkownika'];
                $_SESSION['admin']=$row['Admin'];
                $stmt = $pdo->query("UPDATE uzytkownicy SET Ostatnie_logowanie = NOW(), Liczba_logowan = Liczba_logowan + 1 WHERE Nazwa= '$login'");
                
                echo "Zalogowales sie!";
                echo header("Location: glowna.php");
            }
	}
	else echo "Wpisano złe dane.";
}
?>