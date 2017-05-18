<?php

if($auth->rank() < 2) redirect('index.php');

// Delete a category
if(isset($_POST['delete_cat'])){
    $cats->delete($_POST['id']);
}
// Delete a user
if(isset($_POST['delete_user'])){
    $auth->delete($_POST['id']);
}
// Delete a post
if(isset($_POST['delete_post'])){
    $posts->delete($_POST['id']);
}

// Edit a category
if(isset($_POST['edit_cat'])){
    $cats->edit($_POST['id'], $_POST['name']);
}

// Add a category
if(isset($_POST['add_cat'])){
    $cats->add($_POST['name']);
}