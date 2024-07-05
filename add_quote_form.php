<?php
session_start();

$starttime = microtime(true);

$isLogin = $_SESSION['login'] ?? false;

if (!$isLogin) {
    // Redirect to login page if not logged in
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Neues Zitat hinzufügen</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h1>Neues Zitat hinzufügen</h1>

    <form method="post" action="soap_client.php">
        <label for="zitat">Geben Sie ein neues Zitat ein:</label><br>
        <textarea name="zitat" id="zitat" rows="4" cols="50" required></textarea><br><br>
        <button type="submit">Zitat hinzufügen</button>
    </form>

    <p style="text-align: right; background: #ccc; padding: 0.5em">
        <?php echo number_format(microtime(true) - $starttime, 7, ','); ?> sec
    </p>
</body>
</html>
