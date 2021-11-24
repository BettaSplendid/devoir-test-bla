<?php

//Ensure connexion  to database
require_once('config/config.php');
require_once('debug_helper.php');

// Connexion table tables BDD - fait

// Attraper ID de utilisateur connecté

// verification droit de voir les articles gros????

// On suppose deja connecté et tout. Ou on appelle la fonction de connexion

// Fonction attraper articles / titre + id

// Consulter par default, bouton modification qui donne crée une liste

// Fonction ajouter articles */ titre + contenu + author via session

// Fonction mettre les articles dans la corbeille avant effacement sur



check_articles_table();

check_user_access_all_articles();


function check_articles_table()
{
    global $dtbs;

    $sh = $dtbs->prepare("DESCRIBE `parrot_articles`");
    if ($sh->execute()) {
        // my_table exists
        debug_helper_counters("Database exists");
    } else {
        debug_helper_counters("Database does not exists");
        // my_table does not exist    
    }
}

function check_user_access_all_articles()
{
    global $c_user_id;
    global $dtbs;

    $c_user_id = $_SESSION['id'];

    debug_helper_counters("id : $c_user_id");

    $search_request = 'SELECT * FROM `parrot_users` WHERE id = :id';
    $prepare__search = $dtbs->prepare($search_request);
    $prepare__search->execute(["id" => $c_user_id]);
    $bdd_search_output = $prepare__search->fetchAll(PDO::FETCH_ASSOC);

    debug_helper_counters("bdd search output : ");
    var_dump($bdd_search_output);

    $users_articles_permissions = $bdd_search_output[0]['authorisations'];

    debug_helper_counters("user permissions : $users_articles_permissions");
}


// Permissions articles
// 0 : personne sauf admin
// 1 : Juste auteur et admin
// 2 : contacts de l'auteur & admin