<?php
require_once __DIR__ . '/../bootstrap.php';
/**
 * An Array of all Movie details
 * poster_path, overview, release_date , title , vote_average
 * @param integer $mid
 * @return mixed 
 */
function get_movie_details($mid): mixed
{
    // sql abfrage
    $sql = 'SELECT  poster_path, 
                    overview, 
                    release_date, 
                    title , 
                    vote_average
            FROM    movie
            WHERE   mid=:mid';
    $statement = db()->prepare($sql);
    $statement->bindValue(':mid', $mid, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
}

/** 
 * Get the movietitle as a string
 * @param integer
 */
function get_movie_title($mid): string
{
    // sql abfrage
    $sql = 'SELECT  title        
            FROM    movie
            WHERE   mid=:mid';
    $statement = db()->prepare($sql);
    $statement->bindValue(':mid', $mid, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC)['title'];
}

/**
 * get all movies from the database
 * @param void 
 * @return array
 */
function get_all_movies()
{
    // sql abfrage
    $sql = 'SELECT  mid,title               
            FROM    movie';
    $statement = db()->prepare($sql);
    $statement->execute();
    while ($temp = $statement->fetch(PDO::FETCH_ASSOC)) {
        $res[] = $temp;
    }
    return $res;
}

/**
 * create or refresh the movie db
 */
function moviedb_refresh()
{
    // Definiere die API-URL und den API-Key
    $api_base_url = TMDB_BASE_URL;
    $api_target = "/movie/popular";
    // $api_key = "?api_key=" . TMDB_API_KEY;
    $api_key = "?api_key=" . get_config_value_from_env('/../../docker/.env', 'TMDB_API_KEY');
    // ATTANTION! &reg wird in html codiert, deshalb &amp fuer das & zeichen, dann region
    $api_var = "&language=de&page=1&ampregion=de";

    $api_url = $api_base_url . $api_target . $api_key . $api_var;

    // Hole die Daten von der API
    $response = file_get_contents($api_url);
    $data = json_decode($response, true);
    $data = $data["results"];
    // if there is no valid API key nothing happend and the default movies are showen
    if ($data) {
        // refresh db
        delete_movies_in_db();
        foreach ($data as $movie) {
            write_movie_in_db($movie['id'], $movie['title'], $movie['overview'], $movie['poster_path'], $movie['release_date'], $movie['vote_average']);
        }
    }
}

/**
 * takes the movie id and connects to the api 
 * writes the movie in the db
 * @param integer $mid 
 * @return bool
 */
function refresh_a_movie_in_db($mid)
{
    $api_base_url = TMDB_BASE_URL;
    $api_target = "/movie/" . $mid . "";
    // $api_key = "?api_key=" . TMDB_API_KEY;
    $api_key = "?api_key=" . get_config_value_from_env('/../../docker/.env', 'TMDB_API_KEY');
    $api_var = "&language=de";
    $api_url = $api_base_url . $api_target . $api_key . $api_var;
    $response = file_get_contents($api_url);
    $movie = json_decode($response, true);
    write_movie_in_db($movie['id'], $movie['title'], $movie['overview'], $movie['poster_path'], $movie['release_date'], $movie['vote_average']);
}

/**
 * delete all movies in the db
 * return true if successfull
 * 
 */
function delete_movies_in_db()
{
    $sql = 'DELETE FROM movie';
    $statement = db()->prepare($sql);
    return $statement->execute();
}

/**
 * write a movie in the db
 * return true if successfull
 * @param 
 */
function write_movie_in_db($mid, $title, $overview, $poster_path, $release_date, $vote_average)
{
    $sql = 'INSERT INTO movie(mid, title, overview, poster_path, release_date, vote_average)
            VALUES(:mid, :title, :overview, :poster_path, :release_date, :vote_average)';

    $statement = db()->prepare($sql);

    $statement->bindValue(':mid', $mid, PDO::PARAM_INT);
    $statement->bindValue(':title', $title, PDO::PARAM_STR);
    $statement->bindValue(':overview', $overview, PDO::PARAM_STR);
    $statement->bindValue(':poster_path', $poster_path, PDO::PARAM_STR);
    $statement->bindValue(':release_date', $release_date, PDO::PARAM_STR);
    $statement->bindValue(':vote_average', $vote_average, PDO::PARAM_STR);

    return $statement->execute();
}
