<?php
require_once __DIR__ . '/../src/bootstrap.php';
require __DIR__ . '/../src/change-mail.php';
?>

<?php view('header_bg', ['title' => 'Register']) ?>
<?php view('navbar', ['page' => 'login']) ?>

<div class="text-center p-2">
    <img src="/src/img/videokamera.png" alt="ICON" height="200px">
</div>
<div class="container bg-white border border-2  border-dark-subtle  p-4 mt-4 round-corners" style="max-width: 450px;">
    <form class="" action="change-mail.php" method="post">
       
        <!-- Email -->
        <div class="form-floating mb-2">
            <input class="form-control" placeholder="E-Mail" type="email" name="email" id="email" value="<?= $inputs['email'] ?? '' ?>" class="<?= error_class($errors, 'email') ?>">
            <label for="email">E-Mail</label>
            <small><?= $errors['email'] ?? '' ?></small>
        </div>

        <hr>

        <button class="btn btn-primary" type="submit">E-Mail aendern</button>
    </form>
</div>
<?php view('footer') ?>