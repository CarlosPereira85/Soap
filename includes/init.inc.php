<?php

$meldung = '';
$isLogin = $_SESSION['login'] ?? false;

// Logout process


$meldungZitat = '';

// Handle form submission for quote addition
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $isLogin) {
    if (isset($_POST['zitat'])) {
        $zitat = $_POST['zitat'];

        // Insert new quote into database
        $stmt = $db->prepare("INSERT INTO Zitate (zitat) VALUES (:zitat)");
        $stmt->bindParam(':zitat', $zitat);

        if ($stmt->execute()) {
            $meldungZitat = 'Zitat erfolgreich hinzugefügt.';
        } else {
            $meldungZitat = 'Fehler beim Hinzufügen des Zitats. Bitte versuchen Sie es erneut.';
        }
    }
}

// Fetch all quotes from database
$stmt = $db->query("SELECT * FROM Zitate");
$quotes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>