<?php
require_once('App/app.php');
require_once('controllers/login.php');
include_once('Modules/head.php');
?>
    <main>
        <h1>Login:</h1>
        <form method="post">
            <div class="form-element">
                <label>Mail:
                    <input type="text" name="mail" required placeholder="mail">
                </label>
            </div>
            <div class="form-element">
                <label>Password:
                    <input type="password" name="password" required placeholder="Password">
                </label>
            </div>
            <div class="form-element">
                <input type="submit" name="login" value="Login">
            </div>
        </form>
        
        <h1>Register:</h1>
        <form method="post">
            <div class="form-element">
                <label>Name:
                    <input type="text" name="name" placeholder="Name">
                </label>
            </div>
            <div class="form-element">
                <label>Surname:
                    <input type="text" name="surname"  placeholder="Username">
                </label>
            </div>
            <div class="form-element">
                <label>Mail:
                    <input type="mail" name="mail"  placeholder="Mail">
                </label>
            </div>
            <div class="form-element">
                <label>Password:
                    <input type="password" name="pw1"  placeholder="Password">
                </label>
            </div>
            <div class="form-element">
                <label>Password Again:
                    <input type="password" name="pw2"  placeholder="Password Again">
                </label>
            </div>
            <div class="form-element">
                <input type="submit" name="register" value="Register">
            </div>
        </form>
    </main>
<?php include_once('Modules/foot.php'); ?>