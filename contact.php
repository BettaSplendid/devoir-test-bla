<?php

//Ensure connexion  to database
require_once('connect_mysql.php');

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Le blogroquet - Enregistrement</title>
    <meta name="description" content="Ce site ne sert pas à grand chose. C'est une #perte de te mps. Franchement, vous avez mieux à faire."></meta>
    <meta property="og:image" content="https://thumbs.dreamstime.com/z/parrot-sits-branch-bright-silhouette-drawn-various-lines-style-minimalism-tattoo-bird-logo-parrot-sits-174762319.jpg">
    <meta property="og:title" content="Parrot Homework Network">

    <link rel="shortcut icon" href="659d15e99fed5c1fdb7923de68673c79.png" type="image/x-icon">
    <link rel="stylesheet" href="mystyle.css">

</head>

<body class="background_contact">
    <div class="background_contact_picture">
        <div class="bar_bar">
            <a href="contact.php">Contact</a>
            <a href="comptes.php">Comptes</a>
            <a href="https://cultofthepartyparrot.com/">News</a>
            <a href="articles.php">Articles</a>
            <a class="active" href="index.php">Accueil</a>
        </div>

        <div>
            <div class="contact_container">
                Pseudo <br> Mail <br> Sujet <br> Test humanité <br> BOite de texte <br> Envoyer <br>

                <br><br>
                <form action="formstuff.php" class="form_stuff">

                    <label for="fname">pseudo :</label>
                    <input class="form_stuff_pseudo" type="text" id="fname" name="firstname" placeholder="Votre pseudo">

                    <label for="mail">Mail:</label>
                    <input class="form_stuff_" type="email" id="mail" name="mail" placeholder="Votre mail">

                    <label for="Sujet">Sujet :</label>
                    <input class="form_stuff_pseudo" type="text" id="Sujet" name="Sujet" placeholder="Sujet de votre requête">

                    <!-- <label for="captcha">Combien font <?php echo captcha(); ?></label> -->

                    <label for="message">Votre message :</label>
                    <textarea class="form_stuff_pseudo" id="message" name="message" style="height:200px"></textarea>

                    <input class="form_stuff_submit" type="submit" value="Envoyer">

                </form>
            </div>
        </div>
    </div>