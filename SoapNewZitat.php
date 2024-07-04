<?php
session_start();


include 'soap_client.php';

$starttime = microtime(true);

$name = 'SOAPNewZitat Übung';
$beschreibung = 'Beispiel';

// Load user data or initialize if not available



$meldung = '';
$isLogin = $_SESSION['login'] ?? false;

// Logout process


$meldungZitat = '';

// Handle form submission for quote addition
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $isLogin) {
    if (isset($_POST['zitat'])) {
        $zitat = $_POST['zitat'];

       
    }
} 

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title><?php echo $name; ?></title>
    <meta name="description" content="<?php echo $beschreibung; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
</head>
<body>
    <h1><?php echo $name; ?></h1>

    <?php if (!$isLogin) { ?>
        <p><?php echo $meldung; ?></p>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <label for="user">Benutzername:</label><br>
            <input type="text" name="user" id="user" value="<?php echo htmlspecialchars($user); ?>"><br><br>
            <label for="pwd">Passwort:</label><br>
            <input type="password" name="pwd" id="pwd" value="<?php echo htmlspecialchars($pwd); ?>"><br><br>
            <input type="submit" value="Anmelden">
        </form>
    <?php } else { ?>
        <p><?php echo "Hallo '<b>" . htmlspecialchars($isLogin) . "</b>' du bist angemeldet!"; ?></p>
        <p><a href="<?php echo $_SERVER['PHP_SELF']; ?>?logout">Abmelden nicht vergessen</a></p>

        <?php if ($meldungZitat): ?>
            <p><?php echo $meldungZitat; ?></p>
        <?php endif; ?>

        <form method="post" action="soap_client.php">
            <label for="zitat">Geben Sie ein neues Zitat ein:</label><br>
            <textarea name="zitat" id="zitat" rows="4" cols="50" required></textarea><br><br>
            <button type="submit">Zitat hinzufügen</button>
        </form>
    <?php } ?>

    <p style="text-align: right; background: #ccc; padding: 0.5em">
        <?php echo number_format(microtime(true) - $starttime, 7, ','); ?> sec
    </p>
</body>
</html>
