<?php

include_once 'PDOConnection.inc.php';
include_once 'init.inc.php';
$name = 'Zitate';
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

   
</body>
</html>