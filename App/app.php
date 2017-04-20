<?php

if(!isset($_SESSION)){
    session_start();
}

// Inclues the config file
require_once('config.php');

// Inclues the database class
require_once('database.php');

require_once('auth.php');

require_once('posts.php');

$auth = new Auth();

if(isset($_GET['logout'])){
    $auth->logout();
}