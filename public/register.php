<?php
require_once __DIR__ . '/../src/bootstrap.php';
require __DIR__ . '/../src/register.php';
?>
<?php
if (is_user_logged_in()) {
    redirect_to('/public/index.php');
}
?>
<?php view('header_bg', ['title' => 'Register']) ?>
<?php view('navbar', ['page' => 'login']) ?>


<!-- Event Mask -->

<div class="text-center p-2">
    <img src="/src/img/videokamera.png" alt="ICON" height="200px">
</div>
<div class="container bg-white border border-2  border-dark-subtle  p-4 mt-4 round-corners" style="max-width: 450px;">
    <form class="" action="register.php" method="post">
        <!-- username -->
        <div class="form-floating mb-2">
            <input class="form-control" type="text" name="username" id="username" placeholder="Username" value="<?= $inputs['username'] ?? '' ?>" class="<?php error_class($errors, 'username') ?>">
            <label for="username">Username</label>
        </div>

        <!-- Email -->
        <div class="form-floating mb-2">
            <input class="form-control" placeholder="E-Mail" type="email" name="email" id="email" value="<?= $inputs['email'] ?? '' ?>" class="<?= error_class($errors, 'email') ?>">
            <label for="email">E-Mail</label>
            <small><?= $errors['email'] ?? '' ?></small>
        </div>

        <!-- password 1 -->
        <div class="form-floating mb-2">
            <input class="form-control" placeholder="Passwort" type="password" name="password" id="password" value="<?= $inputs['password'] ?? '' ?>" class="<?= error_class($errors, 'password') ?>">
            <small><?= $errors['password'] ?? '' ?></small>
            <label for="password">Password</label>
        </div>

        <!-- password 2 -->
        <div class="form-floating mb-2">
            <input class="form-control" placeholder="Passwort wiederholen" type="password" name="password2" id="password2" value="<?= $inputs['password2'] ?? '' ?>" class="<?= error_class($errors, 'password2') ?>">
            <label for="password2">Passwort wiederholen</label>
            <small><?= $errors['password2'] ?? '' ?></small>
        </div>
        <hr>
        <div>
            <label for="agree">
                <input type="checkbox" name="agree" id="agree" value="checked" <?= $inputs['agree'] ?? '' ?> />  
                        Ich stimme den <a href="#" title="term of services">term of services</a> zu.
                     </label>
            <small><?= $errors['agree'] ?? '' ?></small>
        </div>
        <footer>Schon registriert? <a href="login.php">Login</a></footer>

        <hr>

        <button class="btn btn-primary" type="submit">Registrieren</button>
    </form>
</div>
<?php view('footer') ?>