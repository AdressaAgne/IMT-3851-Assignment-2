<?php

$auth->requireAuth();

if(isset($_POST['edit_password'])){
    $pw_msg = $auth->changePassword($_POST['pw1'], $_POST['pw2'], $_POST['oldpw']);
}

if(isset($_POST['edit_profile'])){
    $profile_msg = $auth->editProfile($_POST['name'], $_POST['surname'], $_POST['mail']);
}