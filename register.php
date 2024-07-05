<?php
session_start();

include_once 'includes/PDOConnection.inc.php';

$name = 'Registrierung';
$meldung = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    try {
        // Insert user into database
        $stmt = $db->prepare("INSERT INTO Users (username, password) VALUES (:username, :password)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);

        if ($stmt->execute()) {
            $_SESSION['registration_success'] = true;
            header('Location: login.php');
            exit;
        } else {
            $meldung = 'Fehler bei der Registrierung. Versuchen Sie es erneut.';
        }
    } catch (PDOException $e) {
        if ($e->errorInfo[1] === 1062) {
            $meldung = 'Benutzername bereits vergeben. Bitte wählen Sie einen anderen.';
        } else {
            $meldung = 'Fehler bei der Registrierung. Versuchen Sie es erneut.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title><?php echo $name; ?></title>
</head>
<body>
    <h1><?php echo $name; ?></h1>
    <p><?php echo $meldung; ?></p>
    <form action="register.php" method="POST">
        <label for="username">Benutzername:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Passwort:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Registrieren">
    </form>
</body>
</html>
