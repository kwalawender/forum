<?php

    if($_SESSION['zalogowany'] == TRUE && isset($_POST['wyloguj'])) {
        $_SESSION['idUzytk'] = '';
        $_SESSION['zalogowany'] = FALSE;
        echo '<meta http-equiv="refresh" content="1; URL=index.php">';
        echo '<p style="padding-top:10px;"><strong>Proszę czekać...</strong><br>trwa wylogowywanie<p></p>';
    }
?>
