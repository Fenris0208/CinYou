<?php
require_once __DIR__ . '/../bootstrap.php';

/**
 * Create an event
 * @return true if success
 */
function create_event($uid, $mid, $gid, $price, $cinemare, $date){
     $sql = 'INSERT INTO event(gid, mid, owner, date, price, cinemare )
            VALUES(:gid, :mid, :owner, :date, :price, :cinemare)';

    $statement = db()->prepare($sql);

    $statement->bindValue(':gid', $gid, PDO::PARAM_INT);
    $statement->bindValue(':mid', $mid, PDO::PARAM_INT);
    $statement->bindValue(':owner', $uid, PDO::PARAM_INT);
    $statement->bindValue(':date', $date, PDO::PARAM_STR);
    $statement->bindValue(':price', $price, PDO::PARAM_STR);
    $statement->bindValue(':cinemare', $cinemare, PDO::PARAM_STR);

    return $statement->execute();

}


/**
 * An Array of all Event details
 * gid, mid, owner, date, price, cinemare
 * @param integer $eid
 * @return mixed 
 */
function get_event_details($eid): mixed
{
    // sql abfrage
    $sql = 'SELECT  gid, 
                    mid, 
                    owner,
                    date, 
                    price , 
                    cinemare
            FROM    event
            WHERE   eid = :eid';
    $statement = db()->prepare($sql);
    $statement->bindValue(':eid', $eid, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
}

/**
 * Get all Events releated to a group
 * returns a array of eid's 
 * @param int $gid: etst
 * @return array
 */
function get_all_events_by_group($gid)
{
    // sql abfrage
    $sql = 'SELECT  eid               
            FROM    event
            WHERE   gid =:gid';
    $statement = db()->prepare($sql);
    $statement->bindValue(':gid', $gid, PDO::PARAM_INT);
    $statement->execute();
    while ($temp = $statement->fetch(PDO::FETCH_ASSOC)) {
        $res[] = $temp;
    }
    return $res;
}

/**
 * Get alle Events related to a user
 * 
 * @param integer $uid
 * @return array
 */
function get_all_events__by_user($uid)
{
    $sql = 'SELECT event.eid
    FROM event
    WHERE event.gid

     IN (   
        SELECT user_group.gid
        FROM user_group
        WHERE user_group.uid = :uid )';
    $statement = db()->prepare($sql);
    $statement->bindValue(':uid', $uid, PDO::PARAM_INT);
    $statement->execute();
    while ($temp = $statement->fetch(PDO::FETCH_ASSOC)) {
        $res[] = $temp;
    }
    return $res;
}

/**
 * get an array of usernames related by a event id
 * @param integer $eid
 * @return array
 */
function get_all_usernames_by_event($eid)
{
    //sql abfrage
    $sql = 'SELECT users.username 
            FROM user_events 
            LEFT JOIN users 
                on user_events.uid = users.uid 
            WHERE user_events.eid = :eid
    ';
    $statement = db()->prepare($sql);
    $statement->bindValue(':eid', $eid, PDO::PARAM_INT);
    $statement->execute();
    while ($temp = $statement->fetch(PDO::FETCH_ASSOC)) {
        $res[] = $temp;
    }
    return $res;
}

/**
 * get all user id related by one event
 * @param integer $eid
 * @return array
 */
function get_all_user_by_event($eid)
{
    // sql abfrage
    $sql = 'SELECT  uid, 
            FROM    user_events
            WHERE   eid = :eid';
    $statement = db()->prepare($sql);
    $statement->bindValue(':eid', $eid, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
}

/**
 * get number of events from a group
 * @param integer $gid
 * @return integer
 */
function get_amount_of_events_by_group($gid)
{
    // sql abfrage
    $sql = 'SELECT COUNT(eid) 
            FROM    event
            WHERE   gid = :gid';
    $statement = db()->prepare($sql);
    $statement->bindValue(':gid', $gid, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC)['COUNT(eid)'];
}

/**
 * make html code for one event 
 * 
 */
function print_event($eid)
{
    
    $event = get_event_details($eid);

    if(!get_movie_details($event['mid']))
    {
        refresh_a_movie_in_db($event['mid']);
    }

    $movie = get_movie_details($event['mid']);

    $date = explode(' ', $event['date'])[0];
    $time = substr(explode(' ', $event['date'])[1], 0, -3);
    $is_admin = $_SESSION['user_id'] == $event['owner'];
    $is_subscribed = is_subscrib($_SESSION['user_id'], $eid);

    echo '<li class="list-group-item d-flex justify-content-between align-items-center">';
    echo '<div class="me-lg-3 me-sm-2 me-1">';
    echo '<a href=><img class="img-fluid img-thumbnail"';
    echo 'src="https://www.themoviedb.org/t/p/w185/' . $movie['poster_path'] . '"';
    echo '></a>';
    echo '</div>';
    echo '<div class="col">';
    echo '<h1 class="">' . $movie['title'] . ' mit: '.get_group_name($event['gid']) . '</h1>';
    echo '<p>' . $movie['overview'] . '</p>';
    echo '<div class="d-flex ">';
    echo '<div class="">Bewertung: ' . $movie['vote_average'] . '</div>';
    echo '</div>';
    // all information
    echo '<div class="d-flex justify-content-between align-items-end mb-0 mt-4 p-sm-3 p-1 border border-2">';
    echo '<div>';
    echo '<div class="h4">Datum: ' . $date . '</div>';
    echo '<div class="h4">Uhrzeit: ' . $time . ' Uhr</div>';
    echo '</div>';
    echo '<div>';
    echo '<div class="h4">Preis: ' . $event['price'] . '</div>';
    echo '<div class="h4">Ort: ' . $event['cinemare'] . '</div>';
    echo '</div>';
    // buttons
    echo '<div class="me-lg-3 me-0">';
    echo '<div class="d-flex justify-content-between align-items-end px-0">';
    if ($is_subscribed) {
        echo '<form action="/src/unsubscribe.php" method="POST">';
        echo '<input type="hidden" name="eid" value="' . $eid . '">';
        echo '<input class="btn btn-outline-dark" type="submit" value="absagen">';
        echo '</form>';
    } else {
        echo '<form action="/src/subscribe.php" method="POST">';
        echo '<input type="hidden" name="eid" value="' . $eid . '">';
        echo '<input class="btn btn-outline-dark" type="submit" value="teilnehmen">';
        echo '</form>';
    }
    if ($is_admin) {
        echo '<form action="/src/deleteEvent.php" method="POST">';
        echo '<input type="hidden" name="eid" value="' . $eid . '">';
        echo '<input class="btn btn-outline-dark" type="submit" value="loeschen" >';
        echo '</form>';
    }
    echo '</div>';

    //Dropdown menue
    echo '<div class="text-end">';
    echo '<div class="dropdown">';
    echo '<span class="badge bg-primary rounded-pill " type="button"';
    echo 'data-bs-toggle="dropdown" aria-expanded="false">Teilnehmer</span>';
    echo '<ul class="dropdown-menu">';
    foreach (get_all_usernames_by_event($eid) as $user) {
        echo '<li><span class="dropdown-item">' . $user['username'] . '</span></li>';
    }
    echo '</ul>';
    echo '</div>';
    echo '</div>';
    //Dropdown end

    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</li>';
}

/**
 * delte a event by id from the db 
 * verify with uid that only the owner of an event can delet it
 * @return true on success
 */
function delete_event($eid,$uid)
{
    // sql abfrage
    $sql = 'DELETE FROM event 
            WHERE eid = :eid
            AND owner=:uid';

    $statement = db()->prepare($sql);
    $statement->bindValue(':eid', $eid, PDO::PARAM_INT);
    $statement->bindValue(':uid', $uid, PDO::PARAM_INT);

    return $statement->execute();
}





/**
 * get the events where the user is admin
 * 
 * @param integer $uid
 */
function get_events_by_admin($uid)
{
    // sql abfrage
    $sql = 'SELECT eid 
            FROM event 
            WHERE owner = :uid  ';

    $statement = db()->prepare($sql);
    $statement->bindValue(':uid', $uid, PDO::PARAM_INT);
    $statement->execute();
    while ($temp = $statement->fetch(PDO::FETCH_ASSOC)) {
        $res[] = $temp;
    }
    return $res;
}

/**
 * a user subscribe to an event
 * return true if success
 * @param integer $uid
 * @param integer $eid
 * @param integer $external
 * 
 */
function subscribe_to_event($uid, $eid, $external)
{
    //sql query
    $sql = 'INSERT INTO user_events(eid, uid, external)
    VALUES(:eid, :uid, :external)';

    $statement = db()->prepare($sql);

    $statement->bindValue(':uid', $uid, PDO::PARAM_INT);
    $statement->bindValue(':eid', $eid, PDO::PARAM_INT);
    $statement->bindValue(':external', $external, PDO::PARAM_INT);

    return $statement->execute();
}

/**
 * a user unsubscribe to an event
 * return true if success
 * @param integer $uid
 * @param integer $eid
 * 
 */
function unsubscribe_to_event($uid, $eid)
{
    //sql query
    $sql = 'DELETE FROM user_events 
            WHERE   uid=:uid 
                AND eid=:eid';

    $statement = db()->prepare($sql);

    $statement->bindValue(':uid', $uid, PDO::PARAM_INT);
    $statement->bindValue(':eid', $eid, PDO::PARAM_INT);

    return $statement->execute();
}

/**
 * user is subscrib to an event
 * return true if so
 * @param integer $uid 
 * @param integer $eid
 * @return bool
 */
function is_subscrib($uid, $eid)
{
    // sql abfrage
    $sql = 'SELECT COUNT(uid) 
        FROM user_events
        WHERE uid=:uid AND eid=:eid  ';

    $statement = db()->prepare($sql);
    $statement->bindValue(':uid', $uid, PDO::PARAM_INT);
    $statement->bindValue(':eid', $eid, PDO::PARAM_INT);
    $statement->execute();


    // sql array [cout('id')=> 1] thats boolean
    return $statement->fetch(PDO::FETCH_ASSOC)['COUNT(uid)'];
}
