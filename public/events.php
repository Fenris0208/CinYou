<?php
require __DIR__ . '/../src/bootstrap.php';
require_login()
?>

<!-- HEADER -->
<?php view('header_bg', ['title' => 'Events']) ?>
<!-- set Navbar -->
<?php view('navbar', ['page' => 'events']) ?>



<!-- Wrapping beginning -->
<div class="container py-1 mt-4 rounded px-lg-3 px-sm-1 px-0 py-2" style="background-color: rgba(255,240,245,.5);">
    <ul class="list-group">


        <div class="container text-center my-2">
            <div class="container">
                <form action="/public/addEvent.php" method="get">
                    <input class="btn btn-primary" type="submit" value="Event erstellen">
                </form>
            </div>
        </div>

        <!-- generate for every event a list item -->
        <?php

        if (isset($_SESSION['user_id'])) {
            $events = get_all_events__by_user($_SESSION['user_id']);

            // if there are no events for a user

            if (!$events) {
                echo '<h1 style="text-align: center">Bitte treten sie Kinogruppen bei um Events zu sehen.</h1>';
            } else {
                foreach ($events as $event) {
                    print_event($event['eid']);
                }
            }
        }
        ?>
        <!-- Wrapping end -->
    </ul>
</div>