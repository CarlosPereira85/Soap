<?php
session_start();

include_once 'includes/PDOConnection.inc.php';

$starttime = microtime(true);

$name = 'SOAPNewZitat Übung';
$beschreibung = 'Beispiel';

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

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title><?php echo $name; ?></title>
    <meta name="description" content="<?php echo $beschreibung; ?>">
</head>
<body>
    <h1><?php echo $name; ?></h1>

    <?php if (!$isLogin) { ?>
        <p>Bitte zuerst <a href="login.php">einloggen</a>.</p>
    <?php } else { ?>
        <p>Hallo '<b><?php echo htmlspecialchars($isLogin); ?></b>', du bist angemeldet!</p>
        <p><a href="logout.php">Abmelden nicht vergessen</a></p>

        <?php if ($meldungZitat): ?>
            <p><?php echo $meldungZitat; ?></p>
        <?php endif; ?>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="zitat">Geben Sie ein neues Zitat ein:</label><br>
            <textarea name="zitat" id="zitat" rows="4" cols="50" required></textarea><br><br>
            <button type="submit">Zitat hinzufügen</button>
        </form>

        <h2>Zitate</h2>
        <ul>
            <?php foreach ($quotes as $quote): ?>
                <li><?php echo htmlspecialchars($quote['zitat']); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php } ?>

    <p style="text-align: right; background: #ccc; padding: 0.5em">
        <?php echo number_format(microtime(true) - $starttime, 7, ','); ?> sec
    </p>
</body>
</html>
