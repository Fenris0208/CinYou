<?php

function send_mail_to_current_user($message, $subject)
{
    // if newsletter is disable no email is send
    if(!get_newsletter($_SESSION['user_id'])) return true;
    if(!isset($_SESSION['user_mail'])) return false;
    
    $to = $_SESSION['user_mail'];
    $headers = "From: info@cinyou.com\r\n";
    $headers .= "Reply-To: info@cinyou.com\r\n";
    // $headers .= "CC: cc@example.com\r\n";
    // $headers .= "BCC: bcc@example.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=utf-8\r\n";

    return mail($to, $subject, $message, $headers);
}

/**
 * @return TRUE 
 * on success
 */
function send_mail($email,$message, $subject)
{
    $to = $email;
    $headers = "From: info@cinyou.com\r\n";
    $headers .= "Reply-To: info@cinyou.com\r\n";
    // $headers .= "CC: cc@example.com\r\n";
    // $headers .= "BCC: bcc@example.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=utf-8\r\n";

    return mail($to, $subject, $message, $headers);
}

function enable_newsletter($uid){
    $sql = 'UPDATE users
            SET newsletter = 1
            WHERE uid = :uid';
    $statement = db() -> prepare($sql);
    $statement->bindValue(':uid', $uid, PDO::PARAM_INT);
    return $statement->execute();
}

function disable_newsletter($uid){
    $sql = 'UPDATE users
    SET newsletter = 0
    WHERE uid = :uid';

    $statement = db()->prepare($sql);
    $statement->bindValue(':uid', $uid, PDO::PARAM_INT);
    return $statement->execute();
}

function get_newsletter($uid){
      // sql abfrage
      $sql = 'SELECT  newsletter        
      FROM    users
      WHERE   uid=:uid';
$statement = db()->prepare($sql);
$statement->bindValue(':uid', $uid, PDO::PARAM_INT);
$statement->execute();
return $statement->fetch(PDO::FETCH_ASSOC)['newsletter'];
}

?>