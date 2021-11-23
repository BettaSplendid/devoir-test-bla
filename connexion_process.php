<?php

//Ensure connexion  to database
require_once('config/config.php');
// require_once('config/global_functions.php');

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
    global $array_to_pass;

    $search_request = 'SELECT * FROM `parrot_users` WHERE email = :email';
    $prepare__search = $dtbs->prepare($search_request);
    $prepare__search->execute(["email" => $mail]); // run the statement
    $resultat_recherche = $prepare__search->fetchAll(PDO::FETCH_ASSOC); // fetch the rows and put into associative recherche

    var_dump($resultat_recherche);

    $array_to_pass = $resultat_recherche;

    if ($resultat_recherche) {
        echo "We found your mail bb <br />";
        return $array_to_pass;
    } else {
        echo "Can't find a matching email <br />";
        return 0;
    }

    // Not supposed to happen but just in case
    echo "Error, test failed. <br />";
    return;
}


function compare_password()
{
    global $dtbs;
    global $mdp;
    global $array_to_process;

    $id_to_search = $array_to_process[0]['id'];



    $search_request = 'SELECT * FROM `parrot_users` WHERE id = :id';
    $prepare__search = $dtbs->prepare($search_request);
    $prepare__search->execute(["id" => $id_to_search]);
    $resultat_recherche = $prepare__search->fetchAll(PDO::FETCH_ASSOC);


    $retrieved_mdp = $resultat_recherche[0]["mdp"];
    var_dump($resultat_recherche);
    var_dump($retrieved_mdp);

    if ($retrieved_mdp == $mdp) {
        echo "Ca marcheeee! Le mot de passe fourni $retrieved_mdp est egal au mot de passe récupéré $mdp !";
        return 1;
    } else {
        echo "ca marche poooo";
        return 0;
    }
}


//Cette fonction paremètre les variables de session.
//Si $Cnnct = true, il nous defini en temps que connecté
function set_session_variables($Cnnct)
{
    global $pseudo;
    global $mail;
    if ($Cnnct) {
        $_SESSION['loggedin'] = true;
        $_SESSION['pseudo'] = $pseudo;
        $_SESSION['mail'] = $mail;
    } else {
        $_SESSION['loggedin'] = false;
        $_SESSION['pseudo'] = null;
        $_SESSION['mail'] = null;
    }
}



function connect_to_website()
{

    global $zeee_idddd;
    //On cherche un mail qui correspond
    if (!search_db_for_account()) {
        return;
    }
    //On regarde si le mot de passe fourni correspond avec celui de la bdd
    if (!compare_password()) {
        return;
    }
    //Tout va bien, on met les bonnes variables.
    set_session_variables(true);
    echo "Successfully logged in";
}





connect_to_website();
