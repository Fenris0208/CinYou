<?php
require __DIR__ . '/../src/bootstrap.php';
require_login()
?>
<!-- HEADER -->
<?php view('header_bg', ['title' => 'Gruppen']) ?>
<!-- set Navbar -->
<?php view('navbar', ['page' => 'groups']) ?>

<div class="container py-1 mt-4 rounded px-lg-5 px-sm-0 px-0 py-2" style="background-color: rgba(255,240,245,.5);">
    <ul class="list-group">
        <?php
        // button create Group
        echo '<form action="/src/addGroup.php" method="post">';
        echo '<div class="input-group">';
        echo '<input class="btn btn-primary" type="submit" value="Gruppe erstellen">';
        echo '<input class="form-control" type="text" name="groupname" placeholder="Gruppenname" value="">';
        echo '</div>';
        echo '</form>';

        echo '<hr>';

        if (isset($_SESSION['user_id'])) {

            // first all joined groups    
            $groups = get_all_groups_by_user($_SESSION['user_id']);
            if (isset($groups)) {
                foreach ($groups as $group) {
                    print_group($group['gid']);
                }
            }
            echo '<hr>';

            // than all other 
            $groups = get_all_groups_without_user($_SESSION['user_id']);
            if (isset($groups)) {
                foreach ($groups as $group) {
                    print_group($group['gid']);
                }
            }
        } else {
        }


        ?>
    </ul>
</div>