

<?php

$isLogin = $_SESSION['login'] ?? false;
?>
<div class="navbar">
    <a href="../home.php">Home</a>
    <?php if ($isLogin): ?>
        <a href="../SoapNewZitat.php">New Quote</a>
        <a href="../logout.php" class="right">Logout</a>
    <?php else: ?>
        <a href="../register.php" class="right">Register</a>
        <a href="../login.php" class="right">Login</a>
    <?php endif; ?>
</div>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }
    .navbar {
        background-color: #333;
        overflow: hidden;
    }
    .navbar a {
        float: left;
        display: block;
        color: #f2f2f2;
        text-align: center;
        padding: 14px 20px;
        text-decoration: none;
    }
    .navbar a:hover {
        background-color: #ddd;
        color: black;
    }
    .navbar .right {
        float: right;
    }
</style>
