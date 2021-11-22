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


//Creation des variables php pour traitment


$mail = strip_tags($_POST['email']);
$pseudo = strip_tags($_POST['pseudo']);
$mdp = strip_tags($_POST['mdp']);
$mdp_repeated = strip_tags($_POST['mdp-repeat']);
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
$mdp_repeated = normal_chars($mdp_repeated);

//Debug output to see the inputs avant utilisation
echo  nl2br(" \n");
echo  nl2br(" \n");
echo "mail : $mail";
echo nl2br(" \n");
echo "pseudo : $pseudo";
echo  nl2br(" \n");
echo "mdp : $mdp";
echo  nl2br(" \n");
echo "mdp repeat : $mdp_repeated";
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

if (empty($mail) || empty($pseudo) || empty($mdp) || empty($mdp_repeated)) {
    echo '$var vaut soit 0, vide, ou pas définie du tout';
    echo  nl2br(" \n");
    $error["message"] = "vaut soit 0, vide, ou pas définie du tout";
    $error["existe"] = true;
    return $error;
}



//Verifier validité du mail
function mail_validity_ver()
{
    global $mail;
    if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        echo ("$mail is a valid email address");
        echo  nl2br(" \n");
        echo  nl2br(" \n");
    } else {
        $error["message"] = "Il vous faut un mail, pseudo, mdp et une verification correcte pour vous inscrire. Bouuh. Sale nul.";
        $error["existe"] = true;
        return $error;
    }
}

mail_validity_ver();

//Compare les MDP
$var1 = $_POST['mdp'];
$var2 = $_POST['mdp-repeat'];
if (strcmp($var1, $var2) !== 0) {
    echo "Vos mots de passe ne sont pas identiques. Veuillez les verifier.";
    echo  nl2br(" \n");
} else {
    echo "Mdp identiques. Bien.";
    echo  nl2br(" \n");
}



//VERIFIER SI IL N'y A PAS DEJA DES UTILISATEURS AVEC PSEUDO OU EMAIL



function ze_inserto()
{
    global $pseudo;
    global $mail;
    global $mdp;
    global $db;
    // INSERT USERS AFTER VERIFICATION CHECK
    $insert_request = 'INSERT INTO parrot_users(pseudo, email, mdp) VALUES (:pseudo, :mail, :mdp)';

    //Prepare
    $insertRecipe = $db->prepare($insert_request);


    // Exécution !
    $insertRecipe->execute([
        'pseudo' => $pseudo,
        'mail' => $mail,
        'mdp' => $mdp,
    ]);

    echo "Insertion reussi.";
    echo  nl2br(" \n");
}

// ze_inserto();


$sth = $db->prepare("SELECT mdp FROM parrot_users");
$sth->execute();

/* Récupère la première colonne depuis la première ligne d'un jeu de résultats */
print("Récupère la première colonne depuis la première ligne d'un jeu de résultats :\n");
$result = $sth->fetchColumn();
echo array_search($mdp, $result);
