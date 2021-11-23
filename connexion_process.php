<?php

//Ensure connexion  to database
require_once('connect_mysql.php');

//Creation des variables php pour traitment
$mail = strip_tags($_POST['email']);
$mdp = strip_tags($_POST['mdp']);


function normal_chars($string)
{
    $string = htmlentities($string, ENT_QUOTES, 'UTF-8');
    $string = preg_replace('~&([a-z]{1,2})(acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', $string);
    $string = html_entity_decode($string, ENT_QUOTES, 'UTF-8');


    return trim($string, ' -');
}


$mail = normal_chars($mail);
$mdp = normal_chars($mdp);


function search_db_for_account()
{
    global $dtbs;
    global $mail;

    $search_request = 'SELECT * FROM `parrot_users` WHERE email = :email';
    $prepare__search = $dtbs->prepare($search_request);
    $prepare__search->execute(["email" => $mail]); // run the statement
    $resultat_array = $prepare__search->fetchAll(PDO::FETCH_ASSOC); // fetch the rows and put into associative array

    var_dump($resultat_array);

    if ($resultat_array) {
        echo "We found your mail bb <br />";
        return 1;
    } else {
        echo "Can't find a matching email <br />";
        return 0;
    }
    // Not supposed to happen but just in case
    echo "Error, test failed. <br />";
    return;
}

//        $_SESSION['loggedin'] = true;

function compare_password()
{
    global $dtbs;
    global $mdp;

    $search_request = 'SELECT * FROM `parrot_users` WHERE mdp = :mdp';
    $prepare__search = $dtbs->prepare($search_request);
    $prepare__search->execute(["mdp" => $mdp]); // run the statement
    $resultat_array = $prepare__search->fetchAll(PDO::FETCH_ASSOC); // fetch the rows and put into associative array


    $placeholder_variable2 = $resultat_array[0]["mdp"];
    var_dump($resultat_array);

    var_dump($placeholder_variable2);

    if ($placeholder_variable2 == $mdp) {
        echo "Ca marcheeee! Le mot de passe fourni $placeholder_variable2 est egal au mot de passe récupéré $mdp !";
        return 1;
    } else {
        echo "ca marche poooo";
        return 0;
    }
}


function connect_to_website()
{
    global $error_stuff;

    if (!search_db_for_account()) {
        return;
    }
    if (!compare_password()) {
        return;
    }

    $_SESSION['loggedin'] = true;
    echo $_SESSION['loggedin'];
    echo "Successfully logged in";
}

connect_to_website();