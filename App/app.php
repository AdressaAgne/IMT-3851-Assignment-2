<?php

if(!isset($_SESSION)){
    session_start();
}

/**
 * Die and Dump
 * @param  [type] $args [description]
 * @return [type]       [description]
 */
function dd(...$args){
    die(print_r([$args]));
}

function redirect($page){
    header('location: '.$page);
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