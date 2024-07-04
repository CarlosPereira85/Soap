<?php
// header("Access-Control-Allow-Origin: *");  // CORS


include_once 'includes/PDOConnection.inc.php';  // Include your PDO connection script here

function setZitat($neuesZitat) {
    try {
        // Initialize your PDO connection (example)
        global $db;
        
        // Prepare statement to insert new quote into database
        $stmt = $db->prepare("INSERT INTO zitate (zitat) VALUES (:zitat)");
        $stmt->bindParam(':zitat', $neuesZitat['neuesZitat']); // Use $neuesZitat['neuesZitat'] to access the parameter correctly
        $stmt->execute();
        
        return true; // Return true on success
    } catch (PDOException $e) {
        // Handle database connection or query errors
        return false;
    }
}

function getZitat() {
    try {
        // Initialize your PDO connection (example)
        
        global $db;
        // Prepare statement to retrieve last inserted quote from database
        $stmt = $db->query("SELECT zitat FROM zitate ORDER BY id DESC LIMIT 1");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($result) {
            return $result['zitat'];
        } else {
            return "Kein Zitat gefunden.";
        }
    } catch (PDOException $e) {
        // Handle database connection or query errors
        return "Fehler beim Abrufen des Zitats.";
    }
}

$options = array('uri' => 'meimei');
$server = new SoapServer(null, $options);

$server->addFunction('setZitat');
$server->addFunction('getZitat');
$server->handle();
?>
