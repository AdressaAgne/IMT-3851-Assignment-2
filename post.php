<?php
require_once('App/app.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>INDEX</title>
</head>
<body>
    <h1>INDEX</h1>
    <?php if($auth->isLoggedIn()){ ?>
        <a href="?logout">Logout</a>
    <?php }  else { ?>
        <a href="/login.php">Login</a>
    <?php } ?>
    
    <main>
        
        <?php 
            $post = $posts->fetch($_GET['id']);
            include('Modules/'.$post['style'].'.php');
        ?>
        
    </main>
    
</body>
</html>