<?php
$errors = [];
$inputs = [];

if (is_post_request()) {
    if(!$_SESSION['user_id']){
        redirect_to('login.php');
    }

    $fields = [
        'password' => 'string | required | secure',
        'password2' => 'string | required | same: password',
    ];

    // custom messages
    $messages = [
        'password2' => [
            'required' => 'Please enter the password again',
            'same' => 'The password does not match'
        ]
    ];

    [$inputs, $errors] = filter($_POST, $fields, $messages);

    if ($errors) {
        redirect_with('/public/change-password.php', [
            'inputs' => $inputs,
            'errors' => $errors
        ]);
    }

   if(set_new_user_passwd($_SESSION['user_id'], $inputs['password'])){
    redirect_with_message(
        '/public/index.php',
        'Passwort erfolgreich geaendert!'
    );
   }else {
    redirect_with_message(
        '/public/index.php',
        'Passwort aendern hat nicht funktioniert bitte wenden sie sich anden Admin'
    );
   }
    
   
} else if (is_get_request()) {
    [$inputs, $errors] = session_flash('inputs', 'errors');
}
?>