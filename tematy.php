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
        <center><h1>POSTY</h1></center>
        <center><form method="POST" action="dodajPost.php">
<input type="submit" value="ODPOWIEDZ" name="dodajPost">
            </form></center>
</body>
</html>


<?php include("polaczenie.php");


  if ($_SESSION['zalogowany'] == TRUE) {
        
        $idTem = $_GET['id'];
        $_SESSION['temat'] = $_GET['id'];
        
    foreach($pdo->query('SELECT t.Nazwa FROM Temat as t
WHERE t.idTemat = '.$idTem.';') as $row) {
      echo '<h1>'. 'Nazwa tematu: '.$row['Nazwa'].'</h1>';
}      
        
            if(isset($_REQUEST['dodajTemat']) && $_REQUEST['dodajTemat']=='DODAJ TEMAT')
            { 
                header('Location: dodajTemat.php');
            }
                

         ?>       
<table class="table table-bordered">
  <thead class="thead-inverse">
    <tr bgcolor="yellow">
      <th>Nazwa użytkownika</th>
      <th>Tresc odpowiedzi</th>
      <th>Data utworzenia</th>
    </tr>
  </thead><?php   
    foreach($pdo->query('SELECT o.idOdpowiedzi, o.Tresc, o.Data_utworzenia, u.Nazwa as user
FROM temat as t, odpowiedzi as o, uzytkownicy as u 
WHERE t.idTemat = o.idTemat AND o.idUzytkownika = u.idUzytkownika AND t.idTemat = '.$idTem.';') as $row) {
   
        echo "<tr>";
        echo "<td>";
        echo $row['user'];
        echo "</td>";   
        echo "<td>";
        echo $row['Tresc'];
        echo "</td>";  
        echo "<td>";
        echo $row['Data_utworzenia'];
   
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