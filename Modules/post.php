<article class="post">
    <?php if($auth->isLoggedIn() && $post['user_id'] == $_SESSION['user']['id']){ ?>
        <small><a href="editPost.php?id=<?= $post['id'] ?>">edit</a></small>
    <?php } ?>
    
    <h1><a href="post.php?id=<?= $post['id'] ?>"><?= $post['title'] ?></a></h1>
    <p><?= $post['content'] ?></p>
    
</article>