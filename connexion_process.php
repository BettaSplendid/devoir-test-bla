<?php

//Ensure connexion  to database
require_once('connect_mysql.php');

$_SESSION['loggedin'] = true;
echo "Session set as true.";

//Creation des variables php pour traitment
$mail = strip_tags($_POST['email']);
$pseudo = strip_tags($_POST['pseudo']);
$mdp = strip_tags($_POST['mdp']);
$error = [
    "message" => "",
    "existe" => false
];

function normal_chars($string)
{
    $string = htmlentities($string, ENT_QUOTES, 'UTF-8');
    $string = preg_replace('~&([a-z]{1,2})(acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', $string);
    $string = html_entity_decode($string, ENT_QUOTES, 'UTF-8');


    return trim($string, ' -');
}


$mail = normal_chars($mail);
$pseudo = normal_chars($pseudo);
$mdp = normal_chars($mdp);


function ze_inserto()
{
    global $pseudo;
    global $mail;
    global $mdp;
    global $dtbs;
    // INSERT USERS AFTER VERIFICATION CHECK
    $insert_request = 'INSERT INTO parrot_users(pseudo, email, mdp) VALUES (:pseudo, :mail, :mdp)';

    //Prepare
    $insertRecipe = $dtbs->prepare($insert_request);


    // Exécution !
    $insertRecipe->execute([
        'pseudo' => $pseudo,
        'mail' => $mail,
        'mdp' => $mdp,
    ]);

    echo "Insertion reussi.";
    echo  nl2br(" \n");
}
