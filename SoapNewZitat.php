<?php
session_start();




?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title><?php echo $name; ?></title>
    <meta name="description" content="<?php echo $beschreibung; ?>">
</head>
<body>

    <main>
        <div>
        <?php include_once 'includes/header.inc.php'; ?>
        
        <?php include_once 'includes/main.inc.php'; ?>

       

        
        </div>
            
            
        </main>
    </nav>
    
</body>
</html>
