<?php

//Ensure connexion  to database
require_once('config/config.php');
require_once('debug_helper.php');

// Connexion table tables BDD - fait

// Attraper ID de utilisateur connecté - fait

// verification droit de voir les articles gros????

// Fonction attraper articles / titre + id

// Consulter par default, bouton modification qui donne crée une liste

// Fonction ajouter articles */ titre + contenu + author via session

// Fonction mettre les articles dans la corbeille avant effacement sur






// perms articles
// 0 : personne sauf admin
// 1 : Juste auteur et admin
// 2 : contacts de l'auteur & admin



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

function check_user_access_articles()
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

    $users_articles_perms = $bdd_search_output[0]['authorisations'];

    debug_helper_counters("user perms : $users_articles_perms");
}

function addarticles()
{
    global $user_id;
    global $the_title;
    global $the_text;
    global $the_author;
    global $the_perms;
    global $dtbs;

    $user_id = $_SESSION['id'];

    $setup_request = 'INSERT INTO parrot_articles(titre, contenu, auteur, perms) VALUES (:titre, :contenu, :auteur, :perms)';

    $publish_request = $dtbs->prepare($setup_request);

    $publish_request->execute([
        'titre' => $the_title,
        'contenu' => $the_text,
        'auteur' => $the_author,
        'perms' => $the_perms,
    ]);
}
