<?php
require_once __DIR__ . '/bootstrap.php';


// Definiere die API-URL und den API-Key
$api_base_url = "https://api.themoviedb.org/3";
$api_target = "/movie/popular";
$api_key = "?api_key=" . get_config_value_from_env('/../../docker/.env','TMDB_API_KEY');
// $api_key = "?api_key=" . $TMDB_API_KEY;
// VORSICHT! &reg wird in html codiert, deshalb &amp fuer das & zeichen, dann region
$api_var = "&language=de&page=1&ampregion=de";
$api_url = $api_base_url . $api_target . $api_key . $api_var;

//echo $api_url ;
$pic_base_url= TMDB_PICTURE_URL;
$pic_size = "/w154";

// Hole die Daten von der API
$response = file_get_contents($api_url);

// if the api key is not valid
if(!$response){
    redirect_with_message(
        '/public/index.php',
        'error with loading movies - No valid API Key.<br>Contact the admin. You can  continue to create additional events on the "Events-Page"'
    );
}
else $data = json_decode($response, true); 
