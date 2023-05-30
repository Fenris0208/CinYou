<?php
require_once __DIR__ . '/../src/bootstrap.php';
$errors = [];
$inputs = [];
if(!is_user_logged_in()){
    redirect_to('/public/index.php');
}

if (is_post_request()) {
    $fields = [
        'email' => 'email | required | email | unique: users, email'
    ];
    // custom messages
    $messages = [
        'password2' => [
            'same' => 'The password does not match'
        ],
        'agree' => [
            'required' => 'You need to agree to the term of services to register'
        ]
    ];

    [$inputs, $errors] = filter($_POST, $fields, $messages);
    if ($errors) {
        redirect_with('/public/change-mail.php', [
            'inputs' => $inputs,
            'errors' => $errors
        ]);
    }
    
    if(!set_new_email($inputs['email'],$_SESSION['user_id'])){
        redirect_with_message(
            '/public/login.php',
            'Fehler beim setzen einer neuen Mail. Bitte wenden sie sich an den Admin'
        );
    }

    redirect_with_message(
        '/public/login.php',
        'E-Mail erfolgreich geaendert'
    );
    redirect_to('login.php');

}
else if (is_get_request()) {
    [$inputs, $errors] = session_flash('inputs', 'errors');
}
