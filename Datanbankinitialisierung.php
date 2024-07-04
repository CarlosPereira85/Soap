<?php
include_once 'includes/PDOConnection.inc.php';

$sql =<<<HERE
CREATE DATABASE IF NOT EXISTS soap_abschluss;
USE soap_abschluss;

DROP TABLE IF EXISTS Zitate;
CREATE TABLE Zitate (
    id INTEGER AUTO_INCREMENT,
    zitat TEXT DEFAULT '',
    PRIMARY KEY(id)
);

INSERT INTO Zitate 
    (zitat)
VALUES 
    ("Logik bringt dich von A nach B. Deine Fantasie bringt dich überall hin."),
    ("Jeder Fortschritt hat einen unscheinbaren Anfang!"),
    ("Wer allen gefallen will, der wird selten einem dienen."),
    ("Wenn wir die Ohnmacht unseres guten Willens erkennen, wird uns bewusst, wie wenig unser Wollen erreichen kann."),
    ("Wenn man sich seiner machtlosen Situation bewusstwird, schlägt die Ohnmacht in Wut um."),
    ("Die Zeit eines jeden läuft ab, ganz gleich wie gut er sie nutzt."),
    ("Atomstrom erscheint nur deshalb sauber, weil der Schmutz und die Gefahren für unsere Kinder und zukünftige Generationen im Boden vergraben werden."),
    ("Nichts bleibt dicht, alles wird licht. Wo das Haar mal war, gibt es viel Haut und kein Haar");

CREATE TABLE IF NOT EXISTS Users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

HERE;

$db->exec($sql);
?>
