<?php
require_once('App/app.php');
include_once('Modules/head.php');
?>
    <main>
        <h1>INDEX</h1>
        <?php 
            foreach ($posts->fetchAll() as $post) {
                include('Modules/'.$post['style'].'.php');
            }
        ?>
    </main>
    
<?php include_once('Modules/foot.php'); ?>