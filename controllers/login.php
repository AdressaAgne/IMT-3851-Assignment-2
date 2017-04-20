<?php
if(isset($_POST['login'])){
    $auth->login($_POST['mail'], $_POST['password']);
}

if(isset($_POST['register'])){
    $reg = $auth->register($_POST['name'], $_POST['surname'], $_POST['mail'], $_POST['pw1'], $_POST['pw2']);
    if($reg === true) $reg = 'You are now a user';
}

$auth->redirectIfLoggedIn();