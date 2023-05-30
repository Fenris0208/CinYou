<?php
require_once __DIR__ . '/../src/bootstrap.php';
$errors = [];
$inputs = [];

if (is_post_request()) {

    $fields = [
        'password' => 'string | required | secure',
        'password2' => 'string | required | same: password',
    ];

    // custom messages
    $messages = [
        'password2' => [
            'required' => 'Please enter the password again',
            'same' => 'The password does not match'
        ],
        'agree' => [
            'required' => 'You need to agree to the term of services to register'
        ]
    ];

    [$inputs, $errors] = filter($_POST, $fields, $messages);

    if ($errors) {
        redirect_with('/public/update-forget-password.php', [
            'inputs' => $inputs,
            'errors' => $errors
        ]);
    }
    // check all inputs
    $uid = get_uid_by_email($_POST['email']);
    if(!set_new_user_passwd_with_token($_POST['email'],$_POST['token'],$uid,$inputs['password'])){
        reset_token_to_NULL($uid);
        echo 'password reset failed. <br>Pls contact Admin!';
    }
    else {
        reset_token_to_NULL($uid);
       
    }
    redirect_to('/public/login.php');

} else if (is_get_request()) {
    [$inputs, $errors] = session_flash('inputs', 'errors');
}
?>