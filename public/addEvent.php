<?php
require __DIR__ . '/../src/bootstrap.php';
require_login()
?>
<!-- HEADER  & NavBar-->
<?php view('header_bg', ['title' => 'Gruppen']) ?>
<?php view('navbar', ['page' => 'groups']) ?>
<?php
$mid = 0;
$mtitle = '';
if (isset($_GET['selected_movieID']) && isset($_GET['selected_movieTitle'])) {
    $from_movies = true;
    $mid = $_GET['selected_movieID'];
    $mtitle = $_GET['selected_movieTitle'];
}
$timestamp_min = date('Y-m-d\TH:i', time() + 6 * 60 * 60);
$timestamp_max = date('Y-m-d\TH:i', time() + 365 * 24 * 60 * 60);
?>



<!-- Event Mask -->

<div class="container bg-white border border-2  border-dark-subtle  p-4 mt-4 round-corners" style="max-width: 450px;">
    <div class="text-center p-2 mb-4">
        <img src="/src/img/ecent_icon.png" alt="ICON" height="100px">
    </div>
    <form class="" action="/src/addEvent.php" method="post">
        <!-- moviename -->
        <div class="form-floating mb-2">
            <!-- Dropdown movie with preselection -->
            <select class="form-control" id="movie" name="selected_movieID">
                <?php
                foreach (get_all_movies() as $movie) {
                    echo '<option value="' . $movie['mid'] . '" ';
                    if ($movie['mid'] == $mid) echo 'selected'; // here preselection
                    echo '>' . get_movie_title($movie['mid']) . '</option>';
                }
                ?>
            </select>
            <label for="movie">Film</label>
        </div>

        <!-- eventgroup -->
        <div class="form-floating mb-2">
            <select class="form-control" id="groups" name="gid">
                <?php
                foreach (get_all_groups_by_user($_SESSION['user_id']) as $group) {
                    echo '<option value="' . $group['gid'] . '">' . get_group_name($group['gid']) . '</option>';
                }
                ?>
            </select>
            <label for="groups">Gruppe</label>
        </div>

        <!-- price -->
        <div class="form-floating mb-2">
            <input class="form-control" placeholder="Preis" type="number" step="0.01" min="0" max="999" name="price" id="price">
            <label for="price">Preis</label>
        </div>

        <!-- location -->
        <div class="form-floating mb-2">
            <input class="form-control" type="text" placeholder="Ort" name="location" id="ort">
            <label for="ort">Veranstaltungsort</label>
        </div>

        <!-- externa -->
        <div class="form-floating mb-2">
            <input class="form-control" type="number" placeholder="Anzahl Externe" name="count" id="exerna">
            <label for="exerna">Anzahl externe Besucher</label>
        </div>

        <!-- date -->
        <div class="form-floating mb-2">
            <input class="form-control" id="date" type="datetime-local" placeholder="" name="eventdate" min="<?php echo $timestamp_min ?>" max="<?php echo $timestamp_max ?>">
            <label for="date">Datum</label>
        </div>
        <button class="btn btn-primary" type="submit">Event erstellen</button>
    </form>
</div>