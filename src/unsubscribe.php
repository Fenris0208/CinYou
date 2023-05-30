<?php require_once __DIR__ . '/../src/bootstrap.php';?>
<?php
require_login ();

// vars: uid, eid, external
$eid = $_POST['eid'];
$uid = $_SESSION['user_id'];
$external = 0;


if(unsubscribe_to_event($uid, $eid))
{
    // send a mail
    $event = get_event_details($eid);
    $message = '<h1>Absage am Event</h1>';
    $message .= '<p>Sie haben sich erfolgreich vom '  . get_movie_title($event['mid']) . ' abgemeldet<br>';
    $message .= '<br><br>Sollten Sie doch teilnehmen moechten melden Sie sich bitte wieder an.</p>';
    $subject = 'Absage';
    if (!send_mail_to_current_user($message, $subject)) {
        redirect_with_message(
            '/public/events.php',
            'Es gab einen Fehler mit dem Versenden der Mail. Bitte wenden sie sich an den Administrator'
        );
    }
}

redirect_to('/public/events.php');

?> 