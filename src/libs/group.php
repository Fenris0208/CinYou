<?php
/**
 * get all details in a array
 * @return mixed
 */
function get_group_details($gid)
{
    // sql abfrage
    $sql = 'SELECT  groupname, 
                    admin                  
            FROM    web_group
            WHERE   gid = :gid';
    $statement = db()->prepare($sql);
    $statement->bindValue(':gid', $gid, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
}

/** get the groupname as a string */
function get_group_name($gid)
{
    // sql abfrage
    $sql = 'SELECT  groupname                                  
            FROM    web_group
            WHERE   gid = :gid';
    $statement = db()->prepare($sql);
    $statement->bindValue(':gid', $gid, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC)['groupname'];
}

/**
 * get the groupid as int from a groupname
 * @param string $groupname
 * @return int
 */
function get_group_id($groupname)
{
    // sql abfrage
    $sql = 'SELECT gid FROM `web_group` WHERE groupname =:groupname';
    $statement = db()->prepare($sql);
    $statement->bindValue(':groupname', $groupname, PDO::PARAM_STR);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC)['gid'];
}

/**
 * get all group-ids relatet to a user
 */
function get_all_groups_by_user($uid)
{
    // sql abfrage
    $sql = 'SELECT  gid               
            FROM    user_group
            WHERE   uid =:uid';
    $statement = db()->prepare($sql);
    $statement->bindValue(':uid', $uid, PDO::PARAM_INT);
    $statement->execute();
    $res = NULL; 
    while ($temp = $statement->fetch(PDO::FETCH_ASSOC)) {
        $res[] = $temp;
    }
    return $res;
}

/**
 * get all groups relatet to a user
 */
function get_all_groups_without_user($uid)
{
    // sql abfrage
    $sql = 'SELECT web_group.gid
            FROM web_group
            WHERE web_group.gid

            NOT IN (   
                SELECT user_group.gid
                FROM user_group
                WHERE user_group.uid = :uid )';
    $statement = db()->prepare($sql);
    $statement->bindValue(':uid', $uid, PDO::PARAM_INT);
    $statement->execute();
    $res = NULL; 
    while ($temp = $statement->fetch(PDO::FETCH_ASSOC)) {
        $res[] = $temp;
    }
    return $res;
   
}

/**
 * get all groups available
 */
function get_all_groups()
{
    // sql abfrage
    $sql = 'SELECT  gid               
            FROM    web_group
            WHERE   1';
    $statement = db()->prepare($sql);
    $statement->execute();
    while ($temp = $statement->fetch(PDO::FETCH_ASSOC)) {
        $res[] = $temp;
    }
    return $res;
}

/**
 * checks if a user is part of a group 
 * return true/false
 * @param integer $uid
 * @param integer $gid
 * @return bool 
 */
function is_in_group($uid, $gid)
{
    // sql abfrage
    $sql = 'SELECT COUNT(uid) 
            FROM user_group
            WHERE uid=:uid AND gid=:gid  ';

    $statement = db()->prepare($sql);
    $statement->bindValue(':uid', $uid, PDO::PARAM_INT);
    $statement->bindValue(':gid', $gid, PDO::PARAM_INT);
    $statement->execute();

    // sql array [cout('id')=> 1] thats boolean
    return $statement->fetch(PDO::FETCH_ASSOC)['COUNT(uid)'];
}

/**
 * checks if the user is admin in a group
 * return true/false
 * @param integer $uid
 * @param integer $gid
 * @return bool 
 */
function is_admin_in_group($uid, $gid)
{

    // sql abfrage
    $sql = 'SELECT COUNT(admin) 
            FROM web_group
            WHERE admin=:uid AND gid=:gid';

    $statement = db()->prepare($sql);
    $statement->bindValue(':uid', $uid, PDO::PARAM_INT);
    $statement->bindValue(':gid', $gid, PDO::PARAM_INT);
    $statement->execute();

    // sql array [cout('id')=> 1] thats boolean
    return $statement->fetch(PDO::FETCH_ASSOC)['COUNT(admin)'];
}

/** 
 * make a html form 
 * user_groups indicate if the user is in the group
 * @param bool $user_groups 
 * 
 */
function print_group($gid)
{
    $group = get_group_details($gid);
    $uid = $_SESSION['user_id'];

    echo '<li class="list-group-item d-flex justify-content-between align-items-center">';
    echo ' <span class="badge bg-primary rounded-pill me-2">Events: ' . get_amount_of_events_by_group($gid) . '</span>';
    echo '<div class="ms-lg-2 ms-0 me-sm-auto me-2">';
    echo '<h3>' . $group['groupname'] . '</h3>';
    if ($group['admin'] == $uid) {
        echo '<span class="badge bg-primary">Admin</span>';
    }
    echo '</div>';
    echo '<div class="d-flex me-sm-3 me-0">';
    if (is_admin_in_group($uid, $gid)) {
        // delete group
        echo '<form action="/src/deleteGroup.php" method="POST">';
        echo '<input type="hidden" name="gid" value="' . $gid . '">';
        echo '<input class="btn btn-danger me-2" type="submit" value="löschen">';
        echo '</form>';
    }
    if (is_in_group($uid, $gid)) {
        // leave group
        echo '<form action="/src/leaveGroup.php" method="POST">';
        echo '<input type="hidden" name="gid" value="' . $gid . '">';
        echo '<input class="btn btn-outline-dark " type="submit" value="verlassen">';
        echo '</form>';
    } else {
        // join group
        echo '<form action="/src/joinGroup.php" method="POST">';
        echo '<input type="hidden" name="gid" value="' . $gid . '">';
        echo '<input class="btn btn-dark" type="submit" value="beitreten">';
        echo '</form>';
    }
    echo '</div>';
    echo '</li>';

}

/**
 * user join a group
 * in the db
 * 
 */
function join_group($uid, $gid)
{
    $sql = 'INSERT INTO user_group(uid,gid)
    VALUES(:uid, :gid)';

    $statement = db()->prepare($sql);

    $statement->bindValue(':uid', $uid, PDO::PARAM_INT);
    $statement->bindValue(':gid', $gid, PDO::PARAM_INT);

    return $statement->execute();

}

/**
 * user leave a group
 * in the db
 */
function user_leave_group($uid, $gid)
{
    $sql = 'DELETE FROM user_group
            WHERE uid=:uid AND gid=:gid';

    $statement = db()->prepare($sql);

    $statement->bindValue(':uid', $uid, PDO::PARAM_INT);
    $statement->bindValue(':gid', $gid, PDO::PARAM_INT);

    return $statement->execute();
}

/**
 * create a group
 * user get admin in this group
 * need the uid
 * @param string $groupname
 * @return bool 
 */
function create_group($groupname)
{
    $sql = 'INSERT INTO web_group(groupname, admin)
    VALUES(:groupname, :admin)';

    $statement = db()->prepare($sql);
    $statement->bindValue(':groupname', $groupname, PDO::PARAM_STR);
    $statement->bindValue(':admin', $_SESSION['user_id'], PDO::PARAM_INT);


    return $statement->execute();
}

/**
 * delete a group
 * @param $uidAdmin has to be the $_SESSION['user_id'] to verify only admin can delet group
 * @return true if success
 * 
 * 
 */
function delete_group($gid, $uidAdmin)
{
    $sql = 'DELETE FROM web_group 
            WHERE gid=:gid and admin=:admin';

    $statement = db()->prepare($sql);
    $statement->bindValue(':admin', $uidAdmin, PDO::PARAM_INT);
    $statement->bindValue(':gid', $gid, PDO::PARAM_INT);

    return $statement->execute();

}

