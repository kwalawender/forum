<?php

try
{
    $pdo = new PDO('mysql: host=localhost; dbname=test', 'admin', '');
}
catch (PDOException $e)
{
    print "Błąd połączenia z bazą!: " . $e->getMessage() . "<br/>";
    die();
}
session_start();
?>