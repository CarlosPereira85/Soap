<?php

$dsn = 'mysql:host=localhost;port=3306 ; dbname=soap_abschluss';
$user = 'root';
$pwd = '';
try {

    $db = new PDO($dsn, $user, $pwd );
    
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Fehler: " . $e->getMessage();
    die();
}
?>
