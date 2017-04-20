<?php

require_once('App/app.php');
//require_once('controllers/index.php');

if(isset($_POST['login'])){
    $auth->login($_POST['mail'], $_POST['password']);
}
if(isset($_POST['register'])){
    $auth->register($_POST['name'], $_POST['surname'], $_POST['mail'], $_POST['pw1'], $_POST['pw2']);
    echo 'You are now a user';
}

$auth->redirectIfLoggedIn();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    <style>
        .form-element{
            padding: 10px;
            width: 200px;
        }
        label{
            display: block;
            width: 100%;
        }
        input{
            width: 200px;
        }
    </style>
    
    <h1>Login:</h1>
    <form method="post">
        <div class="form-element">
            <label>Mail:
                <input type="text" name="mail" required placeholder="mail">
            </label>
        </div>
        <div class="form-element">
            <label>Password:
                <input type="password" name="password" required placeholder="Password">
            </label>
        </div>
        <div class="form-element">
            <input type="submit" name="login" value="Login">
        </div>
    </form>
    
    <h1>Register:</h1>
    <form method="post">
        <div class="form-element">
            <label>Name:
                <input type="text" name="name" placeholder="Name">
            </label>
        </div>
        <div class="form-element">
            <label>Surname:
                <input type="text" name="surname"  placeholder="Username">
            </label>
        </div>
        <div class="form-element">
            <label>Mail:
                <input type="mail" name="mail"  placeholder="Mail">
            </label>
        </div>
        <div class="form-element">
            <label>Password:
                <input type="password" name="pw1"  placeholder="Password">
            </label>
        </div>
        <div class="form-element">
            <label>Password Again:
                <input type="password" name="pw2"  placeholder="Password Again">
            </label>
        </div>
        <div class="form-element">
            <input type="submit" name="register" value="Register">
        </div>
    </form>
    
</body>
</html>