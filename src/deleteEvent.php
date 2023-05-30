<?php require_once __DIR__ . '/../src/bootstrap.php'; ?>
<?php
require_login();

if (is_post_request()) {
    // delete the event related to the current user
    delete_event($_POST['eid'],$_SESSION['user_id']);
    unsubscribe_to_event($_SESSION['user_id'],$_POST['eid']);
    redirect_to('/public/events.php');
}
?>