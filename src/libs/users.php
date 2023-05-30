<?php
/**
 * Get a user in the database
 *
 * @param string $username
 * @return mixed
 * get an array of all data
 */
function find_user_by_username(string $username)
{
    $sql = 'SELECT username, password, uid, email
            FROM users
            WHERE username=:username';

    $statement = db()->prepare($sql);
    $statement->bindValue(':username', $username, PDO::PARAM_STR);
    $statement->execute();

    return $statement->fetch(PDO::FETCH_ASSOC);
}

/**
 * Get a user in the database by his id
 *
 * @param string $username
 * @return mixed
 * get an array of all data
 */
function get_user_by_uid(int $uid)
{
    $sql = 'SELECT username, password, uid, email
            FROM users
            WHERE uid=:uid';

    $statement = db()->prepare($sql);
    $statement->bindValue(':uid', $uid, PDO::PARAM_INT);
    $statement->execute();

    return $statement->fetch(PDO::FETCH_ASSOC);
}


/**
 * @return mixed 
 * return uid from user if exist, else 0
 */
function get_uid_by_email(string $email)
{
    $sql = 'SELECT uid
            FROM users
            WHERE email=:email';

    $statement = db()->prepare($sql);
    $statement->bindValue(':email', $email, PDO::PARAM_STR);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC)['uid'];
}

/** 
 * Get users id by username
 * return uid
 */
function get_user_id(string $username)
{
    $sql = 'SELECT uid
            FROM users
            WHERE username=:username';

    $statement = db()->prepare($sql);
    $statement->bindValue(':username', $username, PDO::PARAM_STR);
    $statement->execute();

    return $statement->fetch(PDO::FETCH_ASSOC)['uid'];
}


/**
 * @return string token
 * and also set a token in db
 */

 function set_token_for_user($uid)
 {
     // generates a secure token
     $token = bin2hex(random_bytes(16));
     $sql = 'UPDATE users 
             SET token = :token 
             WHERE uid = :uid';
 
     $statement = db()->prepare($sql);
     $statement->bindValue(':uid', $uid, PDO::PARAM_INT);
     $statement->bindValue(':token', $token, PDO::PARAM_STR);
     $statement->execute();
     return $token;
 }


/**
 * @return NULL 
 * resets the token in the users db 
 */
function reset_token_to_NULL($uid)
{
    $sql = 'UPDATE users 
            SET token = NULL 
            WHERE uid = :uid';

    $statement = db()->prepare($sql);
    $statement->bindValue(':uid', $uid, PDO::PARAM_INT);
    $statement->execute();
}

 
 
/**
 * @return TRUE on success
 * 
 */
function set_new_user_passwd_with_token($email, $token, $uid, $password)
{
    $sql = 'UPDATE users 
            SET password = :password
            WHERE uid = :uid 
            AND email =:email
            AND token = :token';
    $statement = db()->prepare($sql);
    $statement->bindValue(':uid', $uid, PDO::PARAM_INT);
    $statement->bindValue(':email', $email, PDO::PARAM_STR);
    $statement->bindValue(':token', $token, PDO::PARAM_STR);
    $statement->bindValue(':password', password_hash($password, PASSWORD_BCRYPT), PDO::PARAM_STR);
    return $statement->execute();
}

/**
 * @return TRUE on success
 * 
 */
function set_new_user_passwd($uid, $password)
{
    $sql = 'UPDATE users 
    SET password = :password
    WHERE uid = :uid';
    $statement = db()->prepare($sql);
    $statement->bindValue(':uid', $uid, PDO::PARAM_INT);
    $statement->bindValue(':password', password_hash($password, PASSWORD_BCRYPT), PDO::PARAM_STR);
    return $statement->execute();
}

/**
 * @return TRUE on success
 * 
 */
function set_new_email($newmail, $uid)
{
    $sql = 'UPDATE users 
            SET email = :newmail
            WHERE uid = :uid';
    $statement = db()->prepare($sql);
    $statement->bindValue(':uid', $uid, PDO::PARAM_INT);
    $statement->bindValue(':newmail', $newmail, PDO::PARAM_STR);
    return $statement->execute();
}

?>