<?php
require_once('App/app.php');
include_once('Modules/head.php');
?>
<main>
<?php 
    $post = $posts->fetch($_GET['id']);
    include('Modules/'.$post['style'].'.php');
?>
</main>
<?php include_once('Modules/foot.php'); ?>