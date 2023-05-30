<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="/src/css/general.css" rel="stylesheet">
    <!-- Bindet alle Verlinkungen ein -->
    <title><?= $title ?? 'Home' ?> - CinYou</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" type="image/png" href="/src/img/videokamera.png"/>

</head>

<body class="m-0 border-0 bg-white " style="background-image:url('/src/img/background.png'); background-size: cover; background-position: 0% 45%;">
    <main>
        <?php flash() ?>