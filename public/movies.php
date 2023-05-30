<?php
require_once __DIR__ . '/../config/tmdb_api.php';
require_once __DIR__ . '/../src/movies.php';
require_once __DIR__ . '/../src/bootstrap.php';
?>

<!-- HEADER -->
<?php view('header_bg', ['title' => 'TopMovies']) ?>

<!-- NavBar -->
<?php view('navbar', ['page' => 'movies']) ?>






<!-- Top 3 Filem -->
<div class="container px-4 pb-5 round-corners bg-white">
    <div class="row text-center pt-lg-3" id="div-top3">
        <?php
        $pic_size = "/w400"; //siehe tmdb api
        for ($i = 0; $i < 3; $i++) {
            $movie= $data["results"][$i];
            $pic_url = $pic_base_url . $pic_size . $movie['poster_path'];
            $get_param = "?selected_movieID=" . $movie['id'] . "&selected_movieTitle=". $movie['title'] ;
            echo '<div class="col-lg-4 mt-3">';
            echo "<a href='./addEvent.php" . $get_param . "'><img src='" . $pic_url . "' height='400px'></a>";
            echo '<h4 class="mt-2">' . $movie['title'] . '</h4>';
            echo '</div>';
        } ?>
    </div>
</div>

<!-- alle 15 der anderen Filem -->
<div class="container-fluid " style="background-color: rgba(255,240,245,.5);">
    <!-- Setzt die Rows for 3 mal mit j -->
    <?php

    $movie_counter = 3;
    $pic_size = "/w200";
    for ($j = 0; $j < 15; $j += 5) {
        echo "<div class='row  text-center pt-lg-5 pb-lg-3 '>";
        echo "<div class='col'></div>";

        // Setzt die Colums 5 mal mit i
        for ($i = 1; $i <= 5; $i++) {

            $movie= $data["results"][$movie_counter];
            $pic_url = $pic_base_url . $pic_size . $movie['poster_path'];
            $get_param = "?selected_movieID=" . $movie['id'] . "&selected_movieTitle=". $movie['title'] ;

            echo '<div class="col-lg-2 ">';
            echo "<a href='./addEvent.php" . $get_param . "'><img src='" . $pic_url . "' height='250px'></a>";
            echo '<h5 class="mt-2">' . $movie['title'] . '</h5>';
            echo '</div>';
            $movie_counter++;
        }
        echo '<div class="col"></div>';
        echo '</div>';
    }
    ?>
</div>




<!-- footer -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
</main>
</body>