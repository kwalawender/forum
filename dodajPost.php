<!DOCTYPE html>
<html>
   <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Dodaj Temat</title>
    </head> 
    <body>
        <center><h1>Odpowiedz</h1></center>
        <form action='dodajPost.php' method='post'>
            <center><table><td>Tresc odpowiedzi:</td></table></center> 
            <textarea name="post" cols=40 rows=6></textarea>
            <table><td><input type='submit' name='dodaj' value='Dodaj post'/></td></table>
            </center>
        </form>
</body>
</html>

<?php
include("polaczenie.php");

if (isset($_POST['dodaj']))
{
	$post =  trim($_POST['post']);
        $idKat = $_SESSION['kategoria'];
        $idTem = $_SESSION['temat'];
        $idUzyt = $_SESSION['idUzyt'];

        echo $_SESSION['kategoria'];

$stmt = $pdo->prepare("INSERT INTO odpowiedzi(idOdpowiedzi, Tresc, Data_utworzenia, idUzytkownika, idTemat) VALUES (NULL, :tresc, NOW(), :idUzyt, :idTem)");
$stmt->execute(array(':tresc' => $post, ':idUzyt' => $idUzyt, ':idTem' => $idTem));
$affected_rows = $stmt->rowCount();        
}
?>