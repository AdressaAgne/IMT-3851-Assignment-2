<?php
require_once('App/app.php');
include_once('Modules/head.php');
?>

    <main>
    <h1>INDEX</h1>
    <?php 
        $post = $posts->fetch($_GET['id']);
        include('Modules/'.$post['style'].'.php');
    ?>
    </main>
<?php include_once('Modules/foot.php'); ?>