<?php

//Ensure connexion  to database
require_once('connexion.php');


//Creation des variables php pour traitment

$mail = strip_tags($_POST['email']);
$pseudo = strip_tags($_POST['Pseudo']);
$mdp = strip_tags($_POST['mdp']);
$mdp_repeated = strip_tags($_POST['mdp-repeat']);
$error = [
    "message" => "",
    "existe" => false
];

//Debug output to see the inputs avant utilisation
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


//Verification de la variable
if ((!isset($mail)) || (!isset($pseudo)) || (!isset($mdp))  || (!isset($mdp_repeated))) {
    echo ('Il vous faut un mail, pseudo, mdp et une verification correcte pour vous inscrire. Bouuh. Sale nul.');
    // Arrête l'exécution de PHP
    $error["message"] = "Il vous faut un mail, pseudo, mdp et une verification correcte pour vous inscrire. Bouuh. Sale nul.";
    $error["existe"] = true;
    return $error;
}

if (empty($mail)||empty($pseudo)||empty($mdp)||empty($mdp_repeated))  {
    echo '$var vaut soit 0, vide, ou pas définie du tout';
    echo  nl2br(" \n");
    $error["message"] = "Il vous faut un mail, pseudo, mdp et une verification correcte pour vous inscrire. Bouuh. Sale nul.";
    $error["existe"] = true;
    return $error;
}


//Verifier validité du mail
if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
  echo("$mail is a valid email address");
  echo  nl2br(" \n");
} else {
    $error["message"] = "Il vous faut un mail, pseudo, mdp et une verification correcte pour vous inscrire. Bouuh. Sale nul.";
    $error["existe"] = true;
    return $error;
}


//Compare les MDP
$var1 = $_POST['mdp'];
$var2 = $_POST['mdp-repeat'];
if (strcmp($var1, $var2) !== 0) {
    echo "Vos mots de passe ne sont pas identiques. Veuillez verifier.";
}


//USERS CHECK



//VERIFIER SI IL N'y A PAS DEJA DES UTILISATEURS AVEC PSEUDO OU EMAIL






// INSERT USERS AFTER VERIFICATION CHECK
$insert_request = 'INSERT INTO parrot_users(pseudo, email, mdp) VALUES (:pseudo, :mail, :mdp)';
            

//Prepare
$insertRecipe = $db->prepare($insert_request);


// Exécution ! La recette est maintenant en base de données
$insertRecipe->execute([
    'pseudo' => $pseudo,
    'mail' => $mail,
    'mdp' => $mdp,
]);



//INSERT INTO parrot_users(pseudo, email, mdp) VALUES (1, 2, 3)
// INSERT INTO `parrot_users`(`id`, `pseudo`, `email`, `mdp`, `articles_assoc`, `authorisations`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]')


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
    <meta property="og:image" content="https://thumbs.dreamstime.com/z/parrot-sits-branch-bright-silhouette-drawn-various-lines-style-minimalism-tattoo-bird-logo-parrot-sits-174762319.jpg">
    <meta property="og:title" content="Parrot Homework Network">

    <link rel="shortcut icon" href="659d15e99fed5c1fdb7923de68673c79.png" type="image/x-icon">
    <link rel="stylesheet" href="mystyle.css">

</head>

<body class="the_container">
    <div class="index_background">

        <div class="bar_bar">
            <a href="contact.php">Contact</a>
            <a href="comptes.php">Comptes</a>
            <a href="https://cultofthepartyparrot.com/">News</a>
            <a href="https://cultofthepartyparrot.com/">Articles</a>
            <a class="active" href="index.php">Accueil</a>
        </div>
        <div>
            <h5>Rappel de vos informations</h5>

            <p><b>Email</b> : <?php echo htmlspecialchars($_POST['email']); ?></p>

            <p><b>Pseudo</b> : <?php echo htmlspecialchars($_POST['Pseudo']); ?></p>

            <p><b>Mdp</b> : <?php
                            $var1 = $_POST['mdp'];
                            $var2 = $_POST['mdp-repeat'];
                            if (strcmp($var1, $var2) !== 0) {
                                echo "Creation echouée. Veuillez verifier votre mot de passe.";
                            } else {
                                echo "Correct";
                            }
                            ?></p>
        </div>