<?php
require_once __DIR__ . '/../src/bootstrap.php';
?>
<?php
if (!is_user_logged_in()) {
    redirect_to('/public/index.php');
}
$uid = $_SESSION['user_id'];

if (get_newsletter($uid)) {
    disable_newsletter($uid);
    redirect_with_message(
        '/public/login.php',
        'Newsletter abbestellt'
    );
} else {
    enable_newsletter($uid);
    redirect_with_message(
        '/public/login.php',
        'Newsletter eingeschaltet'
    );
}
?>
