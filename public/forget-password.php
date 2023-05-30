<?php
require_once __DIR__ . '/../src/bootstrap.php';
require __DIR__ . '/../src/forget-password.php';
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
    <form class="" action="forget-password.php" method="post">
        <!-- Email -->
        <div class="form-floating mb-2">
            <input class="form-control" placeholder="E-Mail" type="email" name="email" id="email">
            <label for="email">E-Mail</label>
            <small><?= $errors['email'] ?? '' ?></small>
        </div>

        <button class="btn btn-primary" type="submit">Passwort zuruecksetzen</button>
    </form>
</div>
<?php view('footer') ?>