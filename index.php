<?php

//Ensure connexion  to database
require_once('config/config.php');
var_dump($_SESSION['loggedin'])
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Le blogroquet</title>
    <meta name="description" content="Ce site ne sert pas à grand chose. C'est une #perte de te mps. Franchement, vous avez mieux à faire.">
    </meta>
    <meta property="og:image" content="https://thumbs.dreamstime.com/z/parrot-sits-branch-bright-silhouette-drawn-various-lines-style-minimalism-tattoo-bird-logo-parrot-sits-174762319.jpg">
    <meta property="og:title" content="Parrot Homework Network">

    <link rel="icon" href="sharpparrot.png" type="image/x-icon">
    <link rel="stylesheet" href="mystyle.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>


<body>
    <input type="hidden" value="$_SESSION['loggedin']" class="user_id">
    <div>
        <div class="superheader"></div>
        <div class="header_bar">
            <img class="header_logo" src='sharpparrot.png'>
        </div>
        <div class="bar_bar">
            <a href="contact.php">Contact</a>
            <a href="comptes.php">Comptes</a>
            <a href="https://cultofthepartyparrot.com/">News</a>
            <a href="articles.php">Articles</a>
            <a class="active" href="index.php">Accueil</a>
        </div>
        <header>
            <!-- <h1>Une histoire de la psittacine-té</h1>
            <h1>Le Premier blog de la psittacine-té dans le monde!</h1>
            <div class="titre_petit">
                <h2>En europe</h2>
                <h3>En france</h3>
                <h4>En lorraine.</h4>
                <h5>Depuis metz en fait.</h5>
            </div> -->
        </header>
        <div class="super_container">



            <div class="index_portrait_container">
                <img class="fit_picture_index" src="48004636536_a409c3f4a2_b.jpg"></img>
                <div class="fit_picture_legend_index">
                    <em> Monsieur Con Ure, l'Auteur.</em>
                </div>
            </div>
            <br>

            <br>
            <hr>
            <br>
            <br>
            <div class="intro">
                <div id="container-article"></div>
            </div>
        </div>
    </div>
</body>

<footer>
    <div class="the_footerman">
        <div class="the_footerman_text">
            Plus de liens :
            <a href="articles.php">Articles</a>

            <a href="enregistrement.php">Enregistrement</a>

            <a href="connexion.php">Connexion</a>

            <a href="deconnexion.php">Deconnexion</a>

            <a href="https://cultofthepartyparrot.com/">Secret!</a>
        </div>
    </div>
    <div class="the_foot_of_the_footerman">
        @Mr Con Ure.
    </div>
    <script src="monscript.js"></script>
    <script>
        var article_id = <?php print($_SESSION['loggedin']) ?>
    </script>
</footer>