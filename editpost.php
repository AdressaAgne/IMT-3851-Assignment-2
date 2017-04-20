<?php
require_once('App/app.php');
require_once('controllers/editpost.php');
include_once('Modules/head.php');
?>
    <main>
        <h1>Edit Post</h1>
        
        <form action="" method="post">
            
            <div class="form-element">
                <label>Title:
                    <input type="text" name="title" placeholder="Title" value="<?= $post['title'] ?>" >
                </label>
            </div>
            <div class="form-element">
                <label>Image:
                    <input type="text" name="image" placeholder="Image" value="<?= $post['image_id'] ?>">
                </label>
            </div>
            <div class="form-element">
                <label>Style:
                    <select name="style">
                        <option value="<?= $post['style'] ?>"><?= $post['style'] ?></option>
                        <option value="post">Post</option>
                    </select>
                </label>
            </div>
            <div class="form-element">
                <label>Content:</label>
                <textarea name="content" rows="8" cols="80"><?= $post['content'] ?></textarea>
            </div>
            <div class="form-element">
                <input type="submit" name="editpost" value="Edit Post">
            </div>
            
            
        </form>
        
    </main>
    
<?php include_once('Modules/foot.php'); ?>