<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasSettings" aria-labelledby="offcanvasLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasLabel">Settings</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
   
        <div class="list-group border-0">
            <a class="list-group-item list-group-item-action border-0"><?php echo $_SESSION['username']; ?></a>
            <hr>
            <a href="change-mail.php" class="list-group-item list-group-item-action border-0">Email Adresse aendern</a>

            <?php
            if (get_newsletter($_SESSION['user_id'])) {
                echo '<a href="/src/newsletter.php" class="list-group-item list-group-item-action border-0">Email Newsletter ausschalten</a>';
            }else{
                echo '<a href="/src/newsletter.php" class="list-group-item list-group-item-action border-0">Email Newsletter einschalten</a>';
            }

            ?>
            <hr>
            <a href="change-password.php" class="list-group-item list-group-item-action border-0">Passwort aendern </a>
            <hr>
            <?php if (is_user_logged_in()) {
                echo '<a href="/src/logout.php" class="list-group-item list-group-item-action border-0">logout</a>';
            } else {
                echo '<a href="login.php" class="list-group-item list-group-item-action border-0">login</a>';
            } ?>
        </div>
    </div>
</div>