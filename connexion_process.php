<?php

//Ensure connexion  to database
require_once('config/config.php');
require_once('debug_helper.php');

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

    echo " Search db for account ()<br />";

    $search_request = 'SELECT * FROM `parrot_users` WHERE email = :email';
    $prepare__search = $dtbs->prepare($search_request);
    $prepare__search->execute(["email" => $mail]); // run the statement
    $bdd_search_output = $prepare__search->fetchAll(PDO::FETCH_ASSOC); // fetch the rows and put into associative recherche

    echo "resultat recherche <br />";
    var_dump($bdd_search_output);

    $array_to_pass = $bdd_search_output;

    if ($bdd_search_output) {
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


function compare_password($passed_array)
{
    global $dtbs;
    global $mdp;


    debug_helper_counters(" Function compare password");


    if (!isset($passed_array)) {
        echo "Password-id array wasn't properly handed <br />";
        return 0;
    }
    if (empty($passed_array)) {
        echo "Password-id  array is empty <br />";
        return 0;
    }

    var_dump($mdp);

    if (empty($mdp)) {
        echo "No password was given by the user<br />";
        return 0;
    }

    debug_helper_counters("zeee id"); // Debug test
    var_dump($passed_array);


    debug_helper_counters("ID to search"); // Debug test
    $id_to_search = $passed_array[0]['id'];
    var_dump($id_to_search);


    $search_request = 'SELECT * FROM `parrot_users` WHERE id = :id';
    $prepare__search = $dtbs->prepare($search_request);
    $prepare__search->execute(["id" => $id_to_search]);
    $bdd_search_output = $prepare__search->fetchAll(PDO::FETCH_ASSOC);


    debug_helper_counters("var dump resultat recherche dans bdd"); // Debug test
    var_dump($bdd_search_output);


    $retrieved_mdp = $bdd_search_output[0]["mdp"];


    debug_helper_counters("var dump retrieved mdp"); // Debug test
    var_dump($retrieved_mdp);


    debug_helper_counters("test de comparaison"); // Debug test
    var_dump($retrieved_mdp);
    echo "<br />";
    var_dump($mdp);


    if ($retrieved_mdp == $mdp) {
        echo "Ca marcheeee! Le mot de passe fourni '$retrieved_mdp' est egal au mot de passe récupéré '$mdp' !<br />";
        return 1;
    } else {
        echo "ca marche poooo. Les mots de passe fourni '$retrieved_mdp' n'est pas egal au mot de passe récupéré '$mdp'<br />";
        return 0;
    }
}



function connect_to_website()
{

    global $zeee_result;
    //On cherche un mail qui correspond

    $zeee_result = search_db_for_account();

    var_dump($zeee_result);

    if (!$zeee_result) {
        return;
    }

    var_dump($zeee_result);

    //On regarde si le mot de passe fourni correspond avec celui de la bdd
    if (!compare_password($zeee_result)) {
        return;
    }
    //Tout va bien, on met les bonnes variables.

    debug_helper_counters("Output session"); // Debug test

    pass_session_variables($zeee_result);

    debug_helper_counters("Congrats"); // Debug test

    echo "Successfully logged in!";
}

function pass_session_variables($received_array) {

    
    global $session_mail;
    global $session_pseudo;
    global $session_id;

    $session_id = $received_array[0]['id'];
    $session_pseudo = $received_array[0]['pseudo'];
    $session_mail = $received_array[0]['email'];

    set_session_variables(true);

}

connect_to_website();
