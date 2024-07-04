<?php     
session_start();

$starttime = microtime(true);

$name = 'Login_3';
$beschreibung = 'Beispiel';

# -------------------------------------------------------------
# Wenn Benutzer-Array vorhanden denn laden, sonst Erzeugen
# und speichern
# -------------------------------------------------------------
if($daten = @file_get_contents('daten/benutzer.txt')) {
    
    $benutzer = unserialize($daten);
    
} else {
    
    $benutzer = array('MeiMei'       => password_hash('geheim', PASSWORD_DEFAULT),
                      'admin'        => password_hash('supergeheim', PASSWORD_DEFAULT),
                      'renate'       => password_hash('123456', PASSWORD_DEFAULT),
                      'reiner korn'  => password_hash('Geheim', PASSWORD_DEFAULT)
                );
            
    file_put_contents('daten/benutzer.txt', serialize($benutzer));
}
# -------------------------------------------------------------


$user ='';
$pwd = '';
$meldung = 'Benutzername und Passwort eingeben.';

$isLogin = $_SESSION['login'] ?? false;


# *****************************************
# Löschen 
# *****************************************
if(isset($_GET['logout']) && $isLogin) {
    unset($_SESSION['login']);
    header('Location: ' . $_SERVER['PHP_SELF']);
    die;
}
# *****************************************

if(!$isLogin) {
    
    if(isset($_POST['user']) && isset($_POST['pwd'])) {
        
        $user = $_POST['user'];
        $pwd  = $_POST['pwd'];
            
        if(isset($benutzer[$user]) && password_verify($pwd, $benutzer[$user])) {
            
            $_SESSION['login'] = $user;
            
            if(password_needs_rehash($benutzer[$user], PASSWORD_DEFAULT, ['cost' => 12])) {
                
                # Hash wurde geändert!
                $benutzer[$user] = password_hash($pwd, PASSWORD_DEFAULT, ['cost' => 12]);
                file_put_contents('daten/benutzer.txt', serialize($benutzer));    # speichern!
            }
            
            // Redirect to SOAPNewZitate page after successful login
            header('Location: /SoapNewZitat.php');
            die;
            
        } else {
            $meldung = 'Benutzername und/oder Passwort sind falsch.<br>Eingabe wiederholen!';
        }
        
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
        
        <h1><?= $name;  ?></h1>
    
    
        <?php if(!$isLogin) { ?>
        
            <p><?= $meldung ?></p>
            
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
                
                <label for="user">Benutzername:</label><br>
                <input type="text" name="user" id="user" value="<?= $user; ?>">
                <br><br>
                
                <label for="pwd">Passwort:</label><br>
                <input type="password" name="pwd" id="pwd" value="<?= $pwd; ?>">
                <br><br>
                
                <input type="submit" value="Anmelden">
            </form>
        
        <?php } else { ?>
        
            <p>
                <?= "Hallo '<b>$isLogin</b>' du bist angemeldet!" ?>
                
            </p>
            
            <p>
                <a href="<?= $_SERVER['PHP_SELF'] ?>?logout">
                    Abmelden nicht vergessen
                </a>
            </p>
        
        <?php } ?>        
        
        <p style="text-align: right; background: #ccc; padding: 0.5em">
            <?php echo number_format(microtime(true) - $starttime, 7, ',') ?> sec
        </p>
        
    </body>
    
</html>
