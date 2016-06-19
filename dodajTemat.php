<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Dodaj Temat</title>
    </head>
    <body>
        <center><h1>Dodaj nowy temat</h1></center>
        <form action='dodajTemat.php' method='post'>
            <center><center><table><td>Nazwa tematu:</td></table></center>
            <input type='text' name='temat'/>
            <center><table><td>Tresc posta:</td></table></center> 
            <textarea name="post" cols=40 rows=6></textarea>
            <table><td><input type='submit' name='dodaj' value='Dodaj temat'/></td></table>
            </center>
        </form>
        
</body>
</html>

<?php
include("polaczenie.php");

if (isset($_POST['dodaj']))
{

	$temat = trim($_POST['temat']);
	$post =  trim($_POST['post']);
        $idKat = $_SESSION['kategoria'];
        $idUzyt = $_SESSION['idUzyt'];

        echo $_SESSION['kategoria'];

$stmt = $pdo->prepare("INSERT INTO temat(idTemat, Nazwa, Tresc, Data, idKategorie, idUzytkownika) VALUES (NULL, :temat, :tresc, NOW(), :idKat, :idUzyt)");
$stmt->execute(array(':temat' => $temat, ':tresc' => $post, ':idKat' => $idKat, ':idUzyt' => $idUzyt));
$affected_rows = $stmt->rowCount();
$lastId = $pdo->lastInsertId();

$stmt2 = $pdo->prepare("INSERT INTO odpowiedzi(idOdpowiedzi, Tresc, Data_utworzenia, idUzytkownika, idTemat) VALUES (NULL, :tresc, NOW(), :idUzyt, :idTem)");
$stmt2->execute(array(':tresc' => $post, ':idUzyt' => $idUzyt, ':idTem' => $lastId));
$affected_rows = $stmt2->rowCount();
}
?>