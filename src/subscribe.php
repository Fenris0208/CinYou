<?php require_once __DIR__ . '/../src/bootstrap.php'; ?>
<?php
require_login();

// vars: uid, eid, external
$eid = $_POST['eid'];
$uid = $_SESSION['user_id'];
$external = 0;

if (subscribe_to_event($uid, $eid, $external)) {
    $event = get_event_details($eid);
    $message = '<h1>Teilnahme am Event</h1>';
    $message .= '<p>Sie haben sich erfolgreich zu '  . get_movie_title($event['mid']) . ' angemeldet<br>';
    $message .= 'Das Event startet am ' . $event['date'] . 'in ' . $event['cinemare'] . ' und wird ' . $event['price'] . ' Euro kosten<br>';
    $message .= '<br><br>Sollten Sie nicht teilnehmen koennen meldent Sie sich bitte ueber das Portal ab.</p>';
    $subject = 'Eventteilnahme';
    if (!send_mail_to_current_user($message, $subject)) {
        redirect_with_message(
            '/public/events.php',
            'Es gab einen Fehler mit dem Versenden der Mail. Bitte wenden sie sich an den Administrator'
        );
    }
}
redirect_to('/public/events.php');
?> 