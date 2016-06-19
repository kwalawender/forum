<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Kategorie</title>
        
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css//bootstrap-theme.min.css" rel="stylesheet">
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
    </head>
    <body>
        <center><h1>Kategorie</h1></center>
        <nav class="navbar navbar-default" role="navigation">
            <div class="navbar-header">
                
                <form action='glowna.php' method='post'>
                    <a href="index.php" class="btn btn-danger">Strona główna</a>
                <input type='submit' class="btn btn-default" name='statystyki' value='Statystyki'/>
                    <input type='submit' class="btn btn-default" name='wyloguj' value='Wyloguj'/>
                            </form>
            </div>
        </nav>
    </body>
</html>

<?php 

include("polaczenie.php");
include ("wyloguj.php");

   if ($_SESSION['zalogowany'] == TRUE) {
        
        
         if ($_SESSION['admin'] == 1) {
             if (isset($_POST['statystyki']))
                  header('Location: statystyki.php');
         }
         else echo 'Nie masz uprawnien admina.';

         ?>       
<table class="table table-bordered">
  <thead class="thead-inverse">
    <tr bgcolor="yellow">
      <th>KATEGORIA</th>
      <th>OPIS KATEGORII</th>
    </tr>
  </thead><?php
    foreach($pdo->query('SELECT idKategorie, Nazwa, Opis FROM kategorie') as $row) {
        echo "<tr>";
        echo "<td>";
        echo '<a href="kategorie.php?id='. $row['idKategorie'] . '">' . $row['Nazwa'] . '</a>';
        echo "</td>";
        echo "<td>";
        echo $row['Opis'];
        echo "</td>";
echo "</tr>";
    }
            
        echo "</table>";
include ("wyloguj.php");
        }
    else
        echo 'Nie jesteś zalogowany';
?>
