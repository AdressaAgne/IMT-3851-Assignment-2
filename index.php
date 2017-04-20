<?php

if(isset($_POST['desc'])){
    unset($_COOKIE['order']);
    setcookie('order', null, -1);
    header('location: index.php');
} 
if(isset($_POST['asc'])){
    setcookie('order', 'asc', time() + 86400 * 30);
    header('location: index.php');
} 

require_once('App/app.php');
include_once('Modules/head.php');

?>

<main>
    <h1>Home</h1>
    <form method="post">
        <input type="submit" name="desc" value="Order by most popular">
        <input type="submit" name="asc" value="Order by least popular">
    </form>
    
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