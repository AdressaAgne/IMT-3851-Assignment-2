<?php

$post = $posts->fetch($_GET['id']);

if(!$auth->isLoggedIn() || $post['user_id'] != $auth->get_id()) header('location: index.php');

if(isset($_POST['editpost'])){
    $posts->edit($_GET['id'], $_POST['title'], $_POST['content'], $_POST['image'], $_POST['style'], $_POST['categories']);
    redirect('post.php?id='.$_GET['id']);
}