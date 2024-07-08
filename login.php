<?php
session_start(); // Ensure session is started

include_once 'includes/PDOConnection.inc.php';

$name = 'Login';
$beschreibung = 'Beispiel';

$user = '';
$pwd = '';
$meldung = 'Benutzername und Passwort eingeben.';

$isLogin = $_SESSION['login'] ?? false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['user'];
    $pwd = $_POST['pwd'];

    // Retrieve user credentials from the database
    $stmt = $db->prepare("SELECT * FROM Users WHERE username = :username");
    $stmt->bindParam(':username', $user);
    $stmt->execute();
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($userData && password_verify($pwd, $userData['password'])) {
        $_SESSION['login'] = $user;

        // Redirect to main page after successful login
        header('Location: /includes/main.inc.php'); // Use absolute path
        exit;
    } else {
        $meldung = 'Benutzername und/oder Passwort sind falsch.<br>Eingabe wiederholen!';
    }
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title><?= $name; ?></title>
    <meta name="description" content="<?= $beschreibung ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
</head>
<body>
    <?php include_once 'includes/header.inc.php'; ?>
    <h1><?= $name; ?></h1>

    <?php if (!$isLogin) { ?>

        <p><?= $meldung ?></p>
        <p>Noch nicht registriert? <a href="register.php">Hier registrieren</a></p>

        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">

            <label for="user">Benutzername:</label><br>
            <input type="text" name="user" id="user" value="<?= htmlspecialchars($user); ?>">
            <br><br>

            <label for="pwd">Passwort:</label><br>
            <input type="password" name="pwd" id="pwd" value="<?= htmlspecialchars($pwd); ?>">
            <br><br>

            <input type="submit" value="Anmelden">
        </form>

    <?php } else { ?>

        <p>
            <?= "Hallo '<b>$isLogin</b>' du bist angemeldet!" ?>
        </p>

    <?php } ?>

</body>
</html>
