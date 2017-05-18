<?php
require_once('App/app.php');

require_once('controllers/admin.php');

$title = 'Admin';

include_once('Modules/head.php');
?>

<main>
    <h1>Admin</h1>
    <h2>Categories</h2>

    <h3>Add new category</h3>
        <form method="POST">
            <div class="form-element">
                <label>New Category Name:
                <input type="text" name="name" value="" placeholder="New Category Name">
                </label>
            </div>
            <div class="form-element">
                <input type="submit" name="add_cat" value="Add Category">
            </div>
        </form>

    <h3>Edit Or delete Cetagory</h3>
    <table>
        <thead>
            <tr>
                <td>Name</td>
                <td>Articles</td>
                <td></td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cats->fetchAll() as $key => $cat) { ?>
                <form method="post">
                    <input type="hidden" name="id" value="<?= $cat['id'] ?>">
                <tr>
                    <td><input type="text" name="name" value="<?= $cat['name'] ?>" placeholder="<?= $cat['name'] ?>"></td>
                    <td><?= $cat['articles'] ?></td>
                    <td><input type="submit" name="edit_cat" value="Edit Category"></td>
                    <td>
                        <input type="submit" name="delete_post" value="delete">
                    </td>
                </tr>
                </form>
            <?php } ?>
        </tbody>
    </table>


    <h3>Delete News</h3>
    <table>
        <thead>
            <tr>
                <td>Name</td>
                <td>Surname</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($posts->fetchAll() as $key => $post) { ?>
                <tr>
                    <td><?= $post['title'] ?></td>
                    <td><?= substr($post['content'], 0, 100) ?></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="id" value="<?= $post['id'] ?>">
                            <input type="submit" name="delete_post" value="delete">
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    
    
    <h3>Delete Users</h3>
    <table>
        <thead>
            <tr>
                <td>Name</td>
                <td>Surname</td>
                <td>Mail</td>
                <td>Rank</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($auth->fetchAll() as $key => $user) { ?>
                <tr>
                    <td><?= $user['name'] ?></td>
                    <td><?= $user['surname'] ?></td>
                    <td><?= $user['mail'] ?></td>
                    <td><?= $user['rank'] ?></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="id" value="<?= $user['id'] ?>">
                            <input type="submit" name="delete_user" value="delete">
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    
    
</main>
    
<?php include_once('Modules/foot.php'); ?>