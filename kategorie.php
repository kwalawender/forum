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
        <center><h1>TEMATY</h1></center>
        <center><form method="POST" action="dodajTemat.php">
<input type="submit" value="DODAJ TEMAT" name="dodajTemat">
            </form></center>
</body>
</html>


<?php include("polaczenie.php");

$_SESSION['kategoria']=$_GET['id']; 
        $idCat = $_GET['id'];

  if ($_SESSION['zalogowany'] == TRUE) {

          foreach($pdo->query('SELECT k.Nazwa FROM kategorie as k
WHERE k.idKategorie = '.$idCat.';') as $row) {
      echo '<h1>'. 'Nazwa kategorii: '.$row['Nazwa'].'</h1>';
}       

         ?>       
<table class="table table-bordered">
  <thead class="thead-inverse">
    <tr bgcolor="yellow">
      <th>NAZWA TEMATU</th>
      <th>DATA UTWORZENIA</th>
      <th>STWORZONY PRZEZ</th>
    </tr>
  </thead><?php           
    foreach($pdo->query('SELECT t.idTemat, t.Nazwa, t.Tresc, t.Data, u.Nazwa as user
FROM kategorie as k, temat as t, uzytkownicy as u 
WHERE k.idKategorie = t.idKategorie AND t.idUzytkownika = u.idUzytkownika AND k.idKategorie = '.$idCat.';') as $row) {
        echo "<tr>";
        echo "<td>";
        echo '<a href="tematy.php?id='. $row['idTemat'] . '">' . $row['Nazwa'] . '</a>';
        echo "</td>";
        echo "<td>";
        echo $row['Data'];
        echo "<td>";
        echo $row['user'];
        echo "</td>";        
        echo "</tr>";

    }
            echo "</table>";
    if($_SESSION['zalogowany'] == TRUE && isset($_POST['wyloguj'])) {
        $_SESSION['idUzytk'] = '';
        $_SESSION['zalogowany'] = FALSE;
        echo '<meta http-equiv="refresh" content="1; URL=index.php">';
        echo '<p style="padding-top:10px;"><strong>Proszę czekać...</strong><br>trwa wylogowywanie<p></p>';
    }
        }
    else
        echo 'Nie jesteś zalogowany';