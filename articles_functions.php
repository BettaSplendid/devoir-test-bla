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

    debug_helper_counters("bdd search output : $bdd_search_output ");

    $users_articles_perms = $bdd_search_output[0]['authorisations'];

    debug_helper_counters("user perms : $users_articles_perms");
}

function addarticles($le_user_id, $le_title, $le_content)
{
    global $user_id;
    global $the_title;
    global $the_text;
    global $the_author;
    global $the_perms;
    global $dtbs;

    $user_id = $le_user_id;
    $the_title = $le_title;
    $the_author = $_SESSION['pseudo'];
    $the_text = $le_content;


    $setup_request = 'INSERT INTO parrot_articles(titre, contenu, auteur, perms) VALUES (:titre, :contenu, :auteur, :perms)';

    $publish_request = $dtbs->prepare($setup_request);


    debug_helper_counters("$user_id");

    debug_helper_counters("$the_title");

    debug_helper_counters("$the_text");

    debug_helper_counters("$the_author");

    debug_helper_counters("$the_perms");

    echo "Hey listen <br />";

    $the_perms = "2";

    $publish_request->execute([
        'titre' => $the_title,
        'contenu' => $the_text,
        'auteur' => $the_author,
        'perms' => $the_perms
    ]);

    echo "Inserted the article!";

    echo $the_text;
}

$_SESSION['debug_step_counter'] = 1;

debug_helper_counters("a");
echo $_POST['mytextarea'];
debug_helper_counters("a");

check_articles_table();

check_user_access_articles();

function prepare_add_article()
{
    $le_user_id = $_SESSION['id'];
    $le_title = "Le titre de lorem";
    $le_content = $_POST['mytextarea'];
    addarticles($le_user_id, $le_title, $le_content);
}
