<?php require_once __DIR__ . '/../src/bootstrap.php';?>
<?php
require_login ();

if (is_post_request()) {
    if(join_group($_SESSION['user_id'], $_POST['gid']))
    {
        $message = '<h1>Bestaetigung</h1>';
        $message .= '<p>Sie sind der Gruppe '.get_group_name($_POST['gid']) . ' beigetreten.</p>';
        $subject = 'Gruppe beigetreten';
        if(send_mail_to_current_user($message,$subject))
        {
            redirect_to('/public/groups.php');
        }
        else 
        {
            echo 'Es gab einen Fehler beim versenden der Mail';
        }
    }
}
?>