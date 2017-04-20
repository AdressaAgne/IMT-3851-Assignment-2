<?php

if(!isset($_SESSION)){
    session_start();
}

// Inclues the config file
require_once('config.php');

// Inclues the database class
require_once('database.php');

require_once('auth.php');
$auth = new Auth();

require_once('posts.php');
$posts = new Posts();

if(isset($_GET['logout'])){
    $auth->logout();
}