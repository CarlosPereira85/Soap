<?php
session_start();
unset($_SESSION['login']);
setcookie('user', '', time() - 3600, '/'); // Cookie löschen
header('Location: login.php');
exit();
?>
