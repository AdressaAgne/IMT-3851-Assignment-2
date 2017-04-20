<?php
require_once('App/app.php');

$post = $posts->fetch($_GET['id']);

if(!$auth->isLoggedIn() || $post['user_id'] != $_SESSION['user']['id']) header('location: index.php');

$posts->delete($_GET['id']);

redirect('index.php');