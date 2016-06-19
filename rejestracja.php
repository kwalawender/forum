<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Rejestracja</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css//bootstrap-theme.min.css" rel="stylesheet">
        <script type="text/javascript" src="js/bootstrap.min.js"></script>        
    </head>
    <body>
        <center><h1 class="text-primary">Rejestracja</h1></center>
<div class="well well-sm">
    <form class="form-inline" method="post">
        <div class="form-group">
            <input type="text" class="form-control" name="login" placeholder="Podaj login">
        </div> 
        <div class="form-group">
            <input type="password" class="form-control" name="haslo1" placeholder="Podaj hasło">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="haslo2" placeholder="Powtórz hasło">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="email" placeholder="Podaj e-mail">
        </div>
        <input type="submit" class="btn btn-danger" value="Utwórz konto" name="rejestruj">
    </form>
</div>
</body>
</html>

<?php 
 
if (isset($_POST['rejestruj']))
{
    include("polaczenie.php");

	$login = trim($_POST['login']);
	$haslo1 =  trim($_POST['haslo1']);
	$haslo2 = trim($_POST['haslo2']);
	$email = trim($_POST['email']);

        $stmt2 = $pdo->query("SELECT Nazwa, Haslo FROM uzytkownicy WHERE Nazwa= '$login'");

	if ($stmt2->rowCount() == 0)
	{
            $stmt2 = $pdo->query("SELECT Nazwa, Haslo FROM uzytkownicy WHERE Email= '$email'");
            if ($stmt2->rowCount() == 0)
            {           
                if ($haslo1 == $haslo2)
                {
                $stmt = $pdo->prepare("INSERT INTO uzytkownicy(idUzytkownika, Nazwa, Haslo, Data_rejestracji, Ostatnie_logowanie, Liczba_logowan, Email, Admin) VALUES (NULL, :login, :haslo1, NOW(), NOW(), '0', :email, '0')");
                $stmt->bindValue(":login", $login, PDO::PARAM_STR);
                $stmt->bindValue(":haslo1", $haslo1, PDO::PARAM_STR);
                $stmt->bindValue(":email", $email, PDO::PARAM_STR);
                $stmt->execute();
		echo "<h2>"."Konto zostało utworzone!"."</h2>";
                }
            else echo "<h2>"."Hasła nie są takie same"."</h2>";
            }
        else echo "<h2>"."Podany e-mail jest juz zajety."."</h2>";
        }
    else echo "<h2>"."Podany login jest już zajęty."."</h2>";
}
?>