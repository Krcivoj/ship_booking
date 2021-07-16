<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="description" content="Mjesto za oglašavanje brodova" />
        <title>Discover Kvarner</title>
        <link rel="icon" type="image/x-icon" href="assets/ship.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Rock+Salt&display=swap" rel="stylesheet">
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <!-- Font Icon -->
        <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>

    </head>
    <body>

    <!--navigacija-->
    <div class="nav">
        <ul class="menu-bar">
            <a href="index.php?rt=excursions" id="link"><li class="left">DISCOVER KVARNER</li></a>

            <?php
            if(!isset($_SESSION['user'])){
                echo '<li class="right"><a href="view/help.php" target="_BLANK" class="button">Pomoć</a></li>';
                echo '<li class="right"><a href="index.php?rt=authentication" class="button">Prijavi se</a></li>';
                echo '<li class="right"><a href="index.php?rt=authentication/signup_index" class="button">Registriraj se</a></li>';
            }
            else{
                $user = unserialize($_SESSION['user']);
                echo '<li class="right"><a href="view/help.php" target="_BLANK" class="button">Pomoć</a></li>';
                echo '<li class="right"><a href="index.php?rt=authentication/logout" class="button">Odjava</a></li>';
                echo '<li class="right"><a href="index.php?rt=user" class="button">Pozdrav, ' . $user->name . '</a></li>';
            }

            ?>    
        </ul>
    </div>

    <!--
        <div class="nav">
    <ul class="menu-bar">
        <a href="index.php?rt=excursions" id="link"><li class="left">DISCOVER KVARNER</li></a>
        <li class="right"><a href="index.php?rt=authentication/logout" class="button">Odlogiraj se</a></li>
        </ul>
    </div>

    -->