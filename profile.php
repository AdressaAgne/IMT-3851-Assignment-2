<?php
require_once('App/app.php');

require_once('controllers/profile.php');

$title = 'Profile';

include_once('Modules/head.php');
?>

<main>
    <h2>Profile</h2>
    
    <form method="post">
        <?= isset($profile_msg) ? $profile_msg : '' ?>
        <div class="form-element">
            <label>Name:
                <input type="text" name="name" placeholder="Name" value="<?= $auth->user['name'] ?>">
            </label>
        </div>
        <div class="form-element">
            <label>Surname:
                <input type="text" name="surname"  placeholder="Username" value="<?= $auth->user['surname'] ?>">
            </label>
        </div>
        <div class="form-element">
            <label>Mail:
                <input type="mail" name="mail"  placeholder="Mail" value="<?= $auth->user['mail'] ?>">
            </label>
        </div>
        
        <div class="form-element">
            <input type="submit" name="edit_profile" value="Edit your profile data">
        </div>
    </form>
    
    <form method="post">
        <?= isset($pw_msg) ? $pw_msg : '' ?>
        <div class="form-element">
            <label>Old Password:
                <input type="password" name="oldpw"  placeholder="Old Password">
            </label>
        </div>
        <div class="form-element">
            <label>New Password:
                <input type="password" name="pw1"  placeholder="New Password">
            </label>
        </div>
        <div class="form-element">
            <label>New Password Again:
                <input type="password" name="pw2"  placeholder="New Password Again">
            </label>
        </div>
        <div class="form-element">
            <input type="submit" name="edit_password" value="Edit password">
        </div>
    </form>    
    
    
    
</main>
    
<?php include_once('Modules/foot.php'); ?>