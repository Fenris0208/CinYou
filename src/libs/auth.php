<?php

/**
 * Register a user
 *
 * @param string $email
 * @param string $username
 * @param string $password
 * @param bool $is_admin
 * @return bool
 */
function register_user(string $email, string $username, string $password, bool $is_admin = false): bool
{
    $sql = 'INSERT INTO users(username, email, password, is_admin)
            VALUES(:username, :email, :password, :is_admin)';

    $statement = db()->prepare($sql);

    $statement->bindValue(':username', $username, PDO::PARAM_STR);
    $statement->bindValue(':email', $email, PDO::PARAM_STR);
    $statement->bindValue(':password', password_hash($password, PASSWORD_BCRYPT), PDO::PARAM_STR);
    $statement->bindValue(':is_admin', (int)$is_admin, PDO::PARAM_INT);

    return $statement->execute();
}

/**
 *find the user in the DB
 * verify the user against the DB
 * set user in Session
 * @param string $username
 * @param string $password
 * @return bool 
 */
function login(string $username, string $password): bool
{
    $user = find_user_by_username($username);
    
    // if the user set his mail as username 
    // this get the information via username
    if (!$user) {
        $uid = get_uid_by_email($username);
        if($uid){
            $user = get_user_by_uid($uid);
        }
        else return false;
    }

    // if user found, check the password
    if ($user && password_verify($password, $user['password'])) {
        // prevent session fixation attack
        session_regenerate_id(true);
        // set username in the session
        $_SESSION['username'] = $user['username'];
        $_SESSION['user_id']  = $user['uid'];
        $_SESSION['user_mail']  = $user['email'];
        return true;
    }
    return false;
}


/**
 * Checks if user is logged in
 * @return bool
 */
function is_user_logged_in(): bool
{
    return isset($_SESSION['username']);
}

/** 
 * redirect user who is not logged in
 */
function require_login(): void
{
    if (!is_user_logged_in()) {
        $source = $_SERVER['PHP_SELF'];
        redirect_with_source('/public/login.php', $source);
    }
}


/**
 * logs the user out
 * and redicret to url 
 *
 * @param $url
 */
function logout($url): void
{
    if (is_user_logged_in()) {
        unset($_SESSION['username'], $_SESSION['user_id']);
        session_destroy();
        redirect_to($url);
    }
}

/**
 * @return $_SESSION['username']
 * @return null
 */
function current_user()
{
    if (is_user_logged_in()) {
        return $_SESSION['username'];
    }
    return null;
}
