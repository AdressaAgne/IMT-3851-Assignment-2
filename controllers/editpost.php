<?php

$post = $posts->fetch($_GET['id']);

if(!$auth->isLoggedIn() || $post['user_id'] != $_SESSION['user']['id']) header('location: index.php');

if(isset($_POST['editpost'])){
    $posts->edit($_GET['id'], $_POST['title'], $_POST['content'], $_POST['image'], $_POST['style']);
    redirect('post.php?id='.$_GET['id']);
}