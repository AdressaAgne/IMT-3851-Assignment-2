<?php
require_once('App/app.php');
include_once('Modules/head.php');
?>

<main>
    <h1>Home</h1>
    <a href="index.php">Order by most popular</a>
    <a href="index.php?asc">Order by least popular</a>
    
    <form method="post">
        <div class="form-element">
            <input type="search" class="search" name="search" value="<?= isset($_POST['search']) ? $_POST['search'] : '' ?>" placeholder="Search...">
        </div>
        <div class="form-element">
            <input type="submit" class="search" name="" value="Search">
        </div>
    </form>
    
    <?php 
        foreach ($posts->fetchAll() as $post) {
            include('Modules/'.$post['style'].'.php');
        }
    ?>
</main>
    
<?php include_once('Modules/foot.php'); ?>