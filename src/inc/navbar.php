<nav class="navbar navbar-expand-lg bg-white">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <!-- <img src="/WebAppKino/src/img/videokamera.png" alt="Bootstrap" height="35"> -->
                <img src="/src/img/videokamera.png" alt="Bootstrap" height="35">

                CinYou</a>
            <button class="navbar-toggler me-auto" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <form class="d-flex align-items-end" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                <!-- me -> Margin end: fuehrt dazu dass das search hinten ist; 
                geaendert auf mx -> Mitte -->
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">                      
                        <a class="nav-link <?php if ($page == 'home'){echo 'active';}?> " aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($page == 'groups'){echo 'active';}?>" href="groups.php">Gruppen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($page == 'movies'){echo 'active';}?>" href="movies.php">Filme</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($page == 'events'){echo 'active';}?>" href="events.php">Events</a>
                    </li>
                </ul>
            </div>
            <a class="" data-bs-toggle="offcanvas" href="#offcanvasSettings" role="button" aria-controls="offcanvasExample">
                <img src="/src/img/rahmen.png" alt="Bootstrap" height="35">
            </a>
        </div>
    </nav>

<?php view('offcanvas_settings') ?>