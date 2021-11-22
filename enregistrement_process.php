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
require_once('debug_helper.php');

$_SESSION['yourCountersNameHere'] = 1;


//Creation des variables php pour traitment


debug_helper_counters(); //Debug test

$mail = strip_tags($_POST['email']);
$pseudo = strip_tags($_POST['pseudo']);
$mdp = strip_tags($_POST['mdp']);
$mdp_repeated = strip_tags($_POST['mdp-repeat']);
$error = [
    "message" => "",
    "existe" => false
];

debug_helper_counters(); //Debug test

function normal_chars($string)
{
    $string = htmlentities($string, ENT_QUOTES, 'UTF-8');
    $string = preg_replace('~&([a-z]{1,2})(acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', $string);
    $string = html_entity_decode($string, ENT_QUOTES, 'UTF-8');


    return trim($string, ' -');
}

debug_helper_counters(); //Debug test


$mail = normal_chars($mail);
$pseudo = normal_chars($pseudo);
$mdp = normal_chars($mdp);
$mdp_repeated = normal_chars($mdp_repeated);

debug_helper_counters(); //Debug test

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

debug_helper_counters(); //Debug test

if (empty($mail) || empty($pseudo) || empty($mdp) || empty($mdp_repeated)) {
    echo "$mail vaut soit 0, vide, ou pas définie du tout";
    echo  nl2br(" \n");
    $error["message"] = "vaut soit 0, vide, ou pas définie du tout";
    $error["existe"] = true;
    return $error;
}

debug_helper_counters(); //Debug test

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

debug_helper_counters(); //Debug test

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

debug_helper_counters(); //Debug test

//VERIFIER SI IL N'y A PAS DEJA DES UTILISATEURS AVEC PSEUDO OU EMAIL

function ze_inserto()
{
    global $pseudo;
    global $mail;
    global $mdp;
    global $dtbs;
    // INSERT USERS AFTER VERIFICATION CHECK
    $insert_request = 'INSERT INTO parrot_users(pseudo, email, mdp) VALUES (:pseudo, :mail, :mdp)';

    //Prepare
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

ze_inserto();

debug_helper_counters(); //Debug test

// CETTE FONCTION MARCHE. 
function search_db()
{
    global $dtbs;
    global $pseudo;

    var_dump($pseudo);

    $search_request = 'SELECT * FROM `parrot_users` WHERE `pseudo` = $pseudo';

    var_dump($pseudo);

    $prepare__search = $dtbs->prepare($search_request);

    $prepare__search->bind_param("sss", $type , $name, $description);

    $prepare__search->execute(); // run the statement

    $resultat_array = $prepare__search->fetchAll(PDO::FETCH_ASSOC); // fetch the rows and put into associative array
    var_dump($resultat_array);

    if (empty($resultat_array)) {
        echo "value found";
    } else {
        echo "value not found";
    }
    echo 'Fin';
}

search_db();

debug_helper_counters(); //Debug test