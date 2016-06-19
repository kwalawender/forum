<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Glowna</title>
    </head>
    <body>
        <center><h1>Liczba logowań użytkowników</h1></center>
        <form action='glowna.php' method='post'>
            <center>
            <table><td>
                    <input type='submit' name='statystyki' value='Statystyki'/>
                    <input type='submit' name='wyloguj' value='Wyloguj'/>
                </td></table>
            </center>
        </form>
    </body>
</html>

<?php 
include("polaczenie.php");


   if ($_SESSION['admin'] == 1) {
        echo 'Jestes zalogowany';

         echo "<table cellpadding=\"2\" border=1>";
         echo "<tr>";
         echo "<td>"."UŻYTKOWNIK"."</td>";
         echo "<td>"."DATA REJESTRACJI"."</td>";
         echo "<td>"."LICZBA LOGOWAŃ"."</td>";
         echo "</tr>";  
    foreach($pdo->query('SELECT Nazwa, Data_rejestracji, Liczba_logowan  from uzytkownicy order by Liczba_logowan DESC;') as $row) {
        echo "<tr>";
        echo "<td>";
        echo $row['Nazwa'];
        echo "</td>";
        echo "<td>";
        echo $row['Data_rejestracji'];
        echo "</td>";
        echo "<td>";
        echo $row['Liczba_logowan'];
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
        echo 'Nie masz uprawnień admina.';
?>
