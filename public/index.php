<?php
require __DIR__ . '/../src/bootstrap.php';
?>

<!-- HEADER -->
<?php view('header_index', ['title' => 'Home']) ?>
<!-- set Navbar -->
<?php view('navbar', ['page' => 'home']) ?>

<div class="container-fluid">
    <div class="row text-center" style="margin-top: 76px;">
        <!-- 56 px ist die Navbar Hoch, da sie fixed ist muss hier der Abstand angegeben werden-->
        <div class="col-lg-2">
        </div>
        <div class="col-lg-4 mt-lg-5">
            <h1 style="color: white;">Mach das Kino zu deinem Treffpunkt</h1>
            <h5 style="color: white;"><br>Entdecke neue Filme, knüpfe Kontakte und genieße gemeinsame Filmabende in bester Gesellschaft.</h5>
            <div style="margin-top: 100px;">
                <?php
                    if(!is_user_logged_in()){
                        echo '<a class="btn btn-primary " style="margin-right: 100px;" href="login.php" role="button">Login</a>';
                        echo '<a class="btn btn-primary " href="register.php" role="button">Register</a>';
                    }
                ?>
            </div>
        </div>
        <!-- Picture -->
        <!-- <div class="col-lg-4">
            <img src="https://rovocad.de/wp-content/uploads/2017/08/Platzhalter.jpg" class="img-fluid " style="height: 450px;">
        </div> -->
        <div class="col-lg-2">
        </div>

    </div>


    <div class="row text-center " style="background-color: #5A5955;">
        <div class="col-lg-12 ">
        </div>
    </div>
    <!-- Top 3 Films Carusell -->
    <!-- Down Strip -->



    <div>
        <?php
        moviedb_refresh();
        ?>
    </div>


</div>

<?php view('footer') ?>