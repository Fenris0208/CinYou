<?php
require_once __DIR__ . '/../src/bootstrap.php';
require_once __DIR__ . '/../src/login.php';
?>
<?php
if (is_user_logged_in()) {
    redirect_to('/public/index.php');
}
?>
<!-- Setzt den html header -->
<?php view('header_bg', ['title' => 'Login']) ?>
<?php view('navbar', ['page' => 'login']) ?>
<!-- Gibt Errors und Messages aus -->
<?php if (isset($errors['login'])) : ?>
    <div class="alert alert-error">
        <?= $errors['login'] ?>
    </div>
<?php endif ?>



<div class="text-center p-2">
    <img src="/src/img/videokamera.png" alt="Bootstrap" height="200">
</div>

<div class="container bg-white border border-2  border-dark-subtle  p-4 mt-4 round-corners" style="max-width: 450px;">
    <form class="" action="login.php" method="post">
        <h3 class="text-center">Einloggen</h3>
        <!-- username -->
        <div class="form-floating mb-2">
            <input class="form-control" name="username" id="username" type="text" class="form-control" placeholder="Nutzername" aria-label="Nutzername" aria-describedby="basic-addon1">
            <label for="username">Nutzername</label>
        </div>

        <!-- password -->
        <div class="form-floating mb-2">
            <input class="form-control" name="password" id="password" type="password" class="form-control" placeholder="Passwort" aria-label="Passwort" aria-describedby="basic-addon2">
            <label for="password">Passwort</label>
        </div>

        <section class="d-flex flex-column justify-content-center text-center">
                    <button class="btn btn-primary btn-block m-2" type="submit">Login</button>
                    <a href="forget-password.php">Password vergessen?</a>
                    <hr>
                    <p>Noch nicht registiert?</p>

                    <a href="register.php">Register</a>
                    <a href="./index.php">Home</a>
                </section>
    </form>
</div>

<!-- Setzt den Abschluss des HTML Dokuments  -->
<?php view('footer') ?>