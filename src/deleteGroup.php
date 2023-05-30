<?php require_once __DIR__ . '/../src/bootstrap.php';?>
<?php
require_login ();

if (is_post_request()) {

    user_leave_group($_SESSION['user_id'],$_POST['gid']);
    
    if(delete_group($_POST['gid'], $_SESSION['user_id']))
    {
        redirect_to('/public/groups.php');
    }
}


?>