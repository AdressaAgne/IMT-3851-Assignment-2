<article class="post">

    <?php if($auth->isLoggedIn() && $post['user_id'] == $_SESSION['user']['id']){ ?>
        <small><a href="editpost.php?id=<?= $post['id'] ?>">Edit</a></small>
        <small><a href="deletepost.php?id=<?= $post['id'] ?>">Delete</a></small>
    <?php } ?>
    
    <h1><a href="post.php?id=<?= $post['id'] ?>"><?= $post['title'] ?></a></h1>
    <p><?= $post['content'] ?></p>
    
    <p><strong>Votes: <?= $post['up'] ?> (<?= $post['average'] * 100 ?>%)</strong></p>
    
    <a href="vote.php?vote=0&post=<?= $post['id'] ?>&page=<?= $_SERVER['PHP_SELF'] ?>" class="down">Thumbs Down</a>
    <a href="vote.php?vote=1&post=<?= $post['id'] ?>&page=<?= $_SERVER['PHP_SELF'] ?>" class="up">Thumbs Up</a>
    
</article>