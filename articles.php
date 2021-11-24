<?php

//Ensure connexion  to database
require_once('config/config.php');

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

    <link rel="shortcut icon" href="659d15e99fed5c1fdb7923de68673c79.png" type="image/x-icon">
    <link rel="stylesheet" href="mystyle.css">
    <script src="https://cdn.tiny.cloud/1/67l8eg596qjlctom7d5l1fwf5b41hsp50qi8p1fru6fts7nz/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'a11ychecker advcode casechange export formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
            toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter pageembed permanentpen table',
            toolbar_mode: 'floating',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
        });
    </script>

</head>

<body class="index_background">
    <div class="bar_bar">
        <a href="contact.php">Contact</a>
        <a href="comptes.php">Comptes</a>
        <a href="https://cultofthepartyparrot.com/">News</a>
        <a href="articles.php">Articles</a>
        <a class="active" href="index.php">Accueil</a>
    </div>

    La page avec articles.

    <div>
        Alors voila.
    </div>
    <div>
        Ajouter des articles.
        <?php
        include 'articles_manipulator.php';

        ?>


    </div>