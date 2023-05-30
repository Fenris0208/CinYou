<?php
require_once __DIR__ . '/../src/bootstrap.php';
require_login();



if (is_post_request()) {

    $uid = $_SESSION['user_id'];
    $mid = $_POST['selected_movieID'];
    $gid = $_POST['gid'];
    $price = $_POST['price'];
    $cinemare = $_POST['location'];
    $date = $_POST['eventdate'];

    create_event($uid, $mid, $gid, $price, $cinemare, $date);


    // gets the last created event from this user
    $events = get_all_events__by_user($uid);
    $eid = end($events)['eid'];

    // subscribe the user to the user_event list
    // and send a mail
    if (subscribe_to_event($uid, $eid, 0)) {
        $event = get_event_details($eid);
        $message = '<h1>Teilnahme am Event</h1>';
        $message .= '<p>Sie haben sich erfolgreich zu '  . get_movie_title($event['mid']) . ' angemeldet<br>';
        $message .= 'Das Event startet am ' . $event['date'] . 'in ' . $event['cinemare'] . ' und wird ' . $event['price'] . ' Euro kosten<br>';
        $message .= '<br><br>Sollten Sie nicht teilnehmen koennen meldent Sie sich bitte ueber das Portal ab.</p>';
        $subject = 'Eventteilnahme';
        if (!send_mail_to_current_user($message, $subject)) {
            redirect_with_message(
                '/public/index.php',
                'Event angelegt.<br>Es gab einen Fehler mit dem Versenden der Mail. Bitte wenden sie sich an den Administrator'
            );
        }
    }

    redirect_with_message(
        '/public/events.php',
        'Event angelegt.'
    );
} else {
    redirect_to('/public/index.php');
}
?>