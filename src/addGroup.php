<?php require_once __DIR__ . '/../src/bootstrap.php'; ?>
<?php
require_login();

if (is_post_request()) {
    create_group($_POST['groupname']);
    $gid = get_group_id($_POST['groupname']);
    join_group($_SESSION['user_id'], $gid);
    redirect_to('/public/groups.php');
}
?>