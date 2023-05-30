<?php require_once __DIR__ . '/../src/bootstrap.php';?>
<?php
require_login ();

if (is_post_request()) {
    if(user_leave_group($_SESSION['user_id'],$_POST['gid']))
    {
        redirect_to('/public/groups.php');
    }
}

?>