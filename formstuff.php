<?php
//Trucs de debug
echo "Bonjour le monde";
//Pareil

echo  nl2br(" \n");

if (!isset($_POST['email']) || !isset($_POST['Pseudo']) | !isset($_POST['mdp'])  | !isset($_POST['mdp-repeat'])) {
    echo ('Il vous faut un mail, pseudo, mdp et une verification correcte pour vous inscrire. Bouuh. Sale nul.');

    // Arrête l'exécution de PHP
    return;
}

$mail = $_POST['email'];
$pseudo = $_POST['Pseudo'];
$mdp = $_POST['mdp'];
$mdp_repeated = $_POST['mdp-repeat'];

echo  nl2br(" \n");
echo "mail : ";
echo $mail;
echo nl2br(" \n");
echo "pseudo : ";
echo $pseudo;
echo  nl2br(" \n");
echo "mdp : ";
echo $mdp;
echo  nl2br(" \n");
echo "mdp repeat : ";
echo $mdp_repeated;
echo  nl2br(" \n");
echo  nl2br(" \n");

//Compare les MDP
$var1 = $_POST['mdp'];
$var2 = $_POST['mdp-repeat'];
if (strcmp($var1, $var2) !== 0) {
    echo "Veuillez verifier votre mot de passe.";
}


//VERIFIER SI IL N'y A PAS DEJA DES UTILISATEURS AVEC PSEUDO OU EMAIL


?>


<!-- H -->
<!-- T -->
<!-- M -->
<!-- L -->


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Le blogroquet - Enregistrement</title>
    <meta name="description" content="Ce site ne sert pas à grand chose. C'est une #perte de te mps. Franchement, vous avez mieux à faire.">
    </meta>
    <meta property="og:image" content="https://thumbs.dreamstime.com/z/parrot-sits-branch-bright-silhouette-drawn-various-lines-style-minimalism-tattoo-bird-logo-parrot-sits-174762319.jpg">
    <meta property="og:title" content="Parrot Homework Network">

    <link rel="shortcut icon" href="659d15e99fed5c1fdb7923de68673c79.png" type="image/x-icon">
    <link rel="stylesheet" href="mystyle.css">

</head>

<body class="the_container">
    <div class="index_background">

        <div class="bar_bar">
            <a href="contact.html">Contact</a>
            <a href="comptes.html">Comptes</a>
            <a href="https://cultofthepartyparrot.com/">News</a>
            <a href="https://cultofthepartyparrot.com/">Articles</a>
            <a class="active" href="index.html">Accueil</a>
        </div>
        <div>
            <h5>Rappel de vos informations</h5>

            <p><b>Email</b> : <?php echo htmlspecialchars($_POST['email']); ?></p>

            <p><b>Pseudo</b> : <?php echo htmlspecialchars($_POST['Pseudo']); ?></p>

            <p><b>Mdp</b> : <?php
                            $var1 = $_POST['mdp'];
                            $var2 = $_POST['mdp-repeat'];
                            if (strcmp($var1, $var2) !== 0) {
                                echo "Verification echouée. Veuillez verifier votre mot de passe.";
                            } ?></p>
        </div>