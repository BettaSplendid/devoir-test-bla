<?php
//Ensure connexion  to database
require_once('connect_mysql.php');
require_once('debug_helper.php');

$_SESSION['yourCountersNameHere'] = 1;


// Creation des variables php pour traitment


debug_helper_counters(); // Debug test

$mail = strip_tags($_POST['email']);
$pseudo = strip_tags($_POST['pseudo']);
$mdp = strip_tags($_POST['mdp']);
$mdp_repeated = strip_tags($_POST['mdp-repeat']);

debug_helper_counters(); // Debug test

function normal_chars($string)
{
    $string = htmlentities($string, ENT_QUOTES, 'UTF-8');
    $string = preg_replace('~&([a-z]{1,2})(acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', $string);
    $string = html_entity_decode($string, ENT_QUOTES, 'UTF-8');


    return trim($string, ' -');
}

debug_helper_counters(); // Debug test


$mail = normal_chars($mail);
$pseudo = normal_chars($pseudo);
$mdp = normal_chars($mdp);
$mdp_repeated = normal_chars($mdp_repeated);

debug_helper_counters(); // Debug test

// Debug output to see the inputs avant utilisation
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


// Verification de la variable
if ((!isset($mail)) || (!isset($pseudo)) || (!isset($mdp))  || (!isset($mdp_repeated))) {
    echo ('Il vous faut un mail, pseudo, mdp et une verification correcte pour vous inscrire. Bouuh. Sale nul.');
    // Arrête l'exécution de PHP
    $error["message"] = "Il vous faut un mail, pseudo, mdp et une verification correcte pour vous inscrire. Bouuh. Sale nul.";
    $error["existe"] = true;
    return $error;
}

debug_helper_counters(); //Debug test

if (empty($mail) || empty($pseudo) || empty($mdp) || empty($mdp_repeated)) {
    echo "$mail vaut soit 0, vide, ou pas définie du tout";
    echo  nl2br(" \n");
    $error["message"] = "vaut soit 0, vide, ou pas définie du tout";
    $error["existe"] = true;
    return $error;
}

debug_helper_counters(); // Debug test

// Verifier validité du mail
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

debug_helper_counters(); //Debug test

mail_validity_ver();

// Compare les MDP
$var1 = $_POST['mdp'];
$var2 = $_POST['mdp-repeat'];
if (strcmp($var1, $var2) !== 0) {
    echo "Vos mots de passe ne sont pas identiques. Veuillez les verifier.";
    echo  nl2br(" \n");
} else {
    echo "Mdp identiques. Bien.";
    echo  nl2br(" \n");
}

debug_helper_counters(); //Debug test

// VERIFIER SI IL N'y A PAS DEJA DES UTILISATEURS AVEC PSEUDO OU EMAIL

function ze_inserto()
{
    global $pseudo;
    global $mail;
    global $mdp;
    global $dtbs;
    // INSERT USERS AFTER VERIFICATION CHECK
    $insert_request = 'INSERT INTO parrot_users(pseudo, email, mdp) VALUES (:pseudo, :mail, :mdp)';

    // Prepare
    $insertusers = $dtbs->prepare($insert_request);


    // Exécution !
    $insertusers->execute([
        'pseudo' => $pseudo,
        'mail' => $mail,
        'mdp' => $mdp,
    ]);

    echo "Insertion reussi.";
    echo  nl2br(" \n");
}



debug_helper_counters(); //Debug test

function search_db_pseudo()
{
    global $dtbs;
    global $pseudo;

    $search_request = 'SELECT * FROM `parrot_users` WHERE pseudo = :pseudo';
    $prepare__search = $dtbs->prepare($search_request);
    $prepare__search->execute(["pseudo" => $pseudo]); // run the statement
    $resultat_array = $prepare__search->fetchAll(PDO::FETCH_ASSOC); // fetch the rows and put into associative array

    if ($resultat_array) {
        echo "duplicate pseudo found <br />";
        return 1;
    } else {
        echo "duplicate pseudo not found <br />";
        return 0;
    }
    // Not supposed to happen but just in case
    echo "Error, test failed. <br />";
    return;
}

function search_db_mail()
{
    global $dtbs;
    global $mail;

    $search_request = 'SELECT * FROM `parrot_users` WHERE email = :email';
    $prepare__search = $dtbs->prepare($search_request);
    $prepare__search->execute(["email" => $mail]); // run the statement
    $resultat_array = $prepare__search->fetchAll(PDO::FETCH_ASSOC); // fetch the rows and put into associative array

    if ($resultat_array) {
        echo "duplicate mail found <br />";
        return 1;
    } else {
        echo "duplicate mail not found <br />";
        return 0;
    }
    // Not supposed to happen but just in case
    echo "Error, test failed. <br />";
    return;
}

// Cherche la base de donnée pour email ou pseudo deja utilisé
// Insert les données de compte si tout est clair
function check_and_insert()
{
    echo "Search da db <br />";
    if (search_db_pseudo()) {
        echo "Found duplicate xdata, no insertion<br />";
        return;
    } elseif (search_db_mail()) {
        echo "Found duplicate data, no insertion<br />";
        return;
    } else {
        // Insertion des données
        ze_inserto();
        echo "Inserted da data <br />";
        return;
    }
}

check_and_insert();

debug_helper_counters(); //Debug test