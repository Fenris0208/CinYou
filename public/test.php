<?php
require_once __DIR__ . '/../src/bootstrap.php';
echo 'start<br>';
// echo get_config_value_from_env('/../../docker/.env','TMDB_API_KEY');
echo get_config_value_from_env('/../../docker/.env','TMDB_API_KEY');

moviedb_refresh();
// echo nl2br(print_r($_SESSION,true));
// get_token_for_user(6);
// find_user_by_email('n.dietrich1988@googlemail.com');
// echo $uid;
// 
// 
// $connection = mysqli_connect(
//     'database',
//     'authentificator',
//     'passwort',
//     'cinyou'
// );

// $query = 'SELECT * FROM users';

// $result = mysqli_query($connection,$query);

// echo '<h1>test</h1>';
// while ($res = mysqli_fetch_assoc($result))
// {
//     echo '<h2>'. $res['username'] . ' his email is: ' . $res['email'] . '</h2>';
// }
// redirect_to('../info.php');
// echo nl2br(print_r($_SESSION,true));
?>