<?php
require_once __DIR__ . '/../src/bootstrap.php';
require __DIR__ . '/../src/update-forget-password.php';
?>
<?php view('header_bg', ['title' => 'Password Forget']) ?>
<?php view('navbar', ['page' => 'test']) ?>


<?php
if ($_GET['email'] && $_GET['token']) {
    $email = $_GET['email'];
    $token = $_GET['token'];
}
?>
<!-- Event Mask -->
<div class="text-center p-2">
    <img src="/src/img/videokamera.png" alt="ICON" height="200px">
</div>

<div class="container bg-white border border-2  border-dark-subtle  p-4 mt-4 round-corners" style="max-width: 450px;">
    <form class="" action="/src/update-forget-password.php" method="post">
        <input type="hidden" name="email" value="<?php echo $email; ?>">
        <input type="hidden" name="token" value="<?php echo $token; ?>">
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
        <button class="btn btn-primary" type="submit">Passwort reset</button>
    </form>
</div>
<?php view('footer') ?>