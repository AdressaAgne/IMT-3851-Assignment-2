<?php
require_once('App/app.php');

$post = $posts->fetch($_GET['id']);

if(!$auth->isLoggedIn() || $post['user_id'] != $auth->get_id()) header('location: index.php');

$posts->delete($_GET['id']);

redirect('index.php');