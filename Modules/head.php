<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main.css">
    <title><?= isset($title) ? $title : 'Home' ?></title>
</head>
<body>
<nav>
    <div class="container">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="addpost.php">Add Post</a></li>
            <?php if($auth->isLoggedIn()){ ?>
                <li>You are logged in as <?= $_SESSION['user']['name'] ?> <?= $_SESSION['user']['surname'] ?></li>
                <li><a href="?logout">Logout</a></li>
            <?php }  else { ?>
                <li><a href="login.php">Login</a></li>
            <?php } ?>
        </ul>
    </div>
</nav>