<?php
// Cela envoie un cookie persistant qui dure une journée.
session_start([
    'cookie_lifetime' => 86400,
]);
// $_SESSION['mail'];
// $_SESSION['pseudo'];
// $_SESSION['mdp'];

//Ensure connexion  to database
require_once('connect_mysql.php');

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
        <?php
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            echo "Welcome to the member's area, " . $_SESSION['username'] . "!";
            //include 'blablabal.php';
        } else {
            echo "Please log in first to see this page.";
        }

        ?>


    </div>