<article class="post">
    <?php if($post['user_id'] == $_SESSION['user']['id']){ ?>
        <a href="editPost.php">edit</a>
    <?php } ?>
    
    <h1><a href="post.php?id=<?= $post['id'] ?>"><?= $post['title'] ?></a></h1>
    <p><?= $post['content'] ?></p>
    
</article>