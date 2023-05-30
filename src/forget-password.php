<?php

if(is_post_request())
{
   $email = $_POST['email'];
    // search user id by mail
    
    $uid = get_uid_by_email($email);
    
    // if not 
    if (!$uid)
    {
        redirect_to('index.php');
        echo '<br>failed ';
    }
    
    // if exist
    // generate a token 
    $token = set_token_for_user($uid);
    echo $token . '<br>';
    // send mail to user 
    $message = '<h1>Passwort-Reset</h1>';
    $message .= '<p>Sie haben ihr Passwort zurückgesetzt. Bitte klicken sie auf den nachfolgenden link';
    $message .= '<br><a href="http://localhost/public/update-forget-password.php?token='.$token.'&email='.$email.'">Hier klicken fuer neues Passwort</a>';
    $message .= '<br><br>Sollten Sie ihr Passwort nicht zurückgesetzt haben ignorieren Sie diese Mail oder kontaktieren Sie den Administrator.</p>'; 
    echo $email;
    
    if(send_mail($email,$message, 'Passwortreset'))
    {
        echo '<br>mail send  ';
    }
    else echo '<br>mail failed ';

    redirect_to('/public/index.php');
    
}
?>