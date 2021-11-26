<?php

//Ensure connexion  to database
require_once('config/config.php');
require_once('debug_helper.php');

function get_articles_titles()
{
    global $dtbs;

    echo " Search db for account ()<br />";

    $search_request = 'SELECT art_id, titre FROM `parrot_articles` WHERE corbeille=0';
    $prepare__search = $dtbs->prepare($search_request);
    $prepare__search->execute(); // run the statement
    $bdd_search_output = $prepare__search->fetchAll(PDO::FETCH_ASSOC); // fetch the rows and put into associative recherche

    if (empty($bdd_search_output)) {
        echo "empty boy <br />";
    } else {
        echo "not empty boi <br />";
    }
    var_dump($bdd_search_output);

    debug_helper_counters("space");

    $number_of_articles = count($bdd_search_output);

    $i = 0;

    while ($i < $number_of_articles) {
        $i++;
        echo $bdd_search_output[$i]['titre'];
        echo  nl2br(" \n");
    }


    echo $number_of_articles;
}

// get_articles_titles();

function get_all_articles()
{
    global $dtbs;

    $search_request = 'SELECT art_id, titre, contenu, sommaire, auteur FROM `parrot_articles` WHERE corbeille=0';
    $prepare__search = $dtbs->prepare($search_request);
    $prepare__search->execute(); // run the statement
    $bdd_search_output = $prepare__search->fetchAll(PDO::FETCH_ASSOC); // fetch the rows and put into associative recherche

    $number_of_articles = count($bdd_search_output);
    for ($i = 0; $i < $number_of_articles; $i++) {
        $das_titre = $bdd_search_output[$i]['titre'];
        $das_sommaire = $bdd_search_output[$i]['sommaire'];
        $das_author = $bdd_search_output[$i]['auteur'];

        print_r("<div class='rectangle_article_container'>");
        print_r("<div class='square'></div>");
        print_r("<div class='very_real_article_author'> $das_author   </div>");
        // print_r("<div class='very_real_article_date'> $das_titre   </div>");
        print_r("<div class='very_real_article_titre'> $das_titre   </div>");
        print_r("<div class='very_real_article_sommaire'> $das_sommaire</div>");



        print_r("</div>");
        print_r(nl2br(" \n"));
    }
}

get_all_articles();

function get_newest_articles()
{
    global $dtbs;

    $search_request = 'SELECT art_id, titre, contenu, sommaire, auteur FROM `parrot_articles` WHERE corbeille=0';
    $prepare__search = $dtbs->prepare($search_request);
    $prepare__search->execute(); // run the statement
    $bdd_search_output = $prepare__search->fetchAll(PDO::FETCH_ASSOC); // fetch the rows and put into associative recherche

    for ($i = 0; $i < 6; $i++) {
        $das_titre = $bdd_search_output[$i]['titre'];
        $das_sommaire = $bdd_search_output[$i]['sommaire'];
        $das_author = $bdd_search_output[$i]['auteur'];

        print_r("<div class='rectangle_article_container'>");
        print_r("<div class='square'></div>");
        print_r("<div class='very_real_article_author'> $das_author   </div>");
        // print_r("<div class='very_real_article_date'> $das_titre   </div>");
        print_r("<div class='very_real_article_titre'> $das_titre   </div>");
        print_r("<div class='very_real_article_sommaire'> $das_sommaire</div>");



        print_r("</div>");
        print_r(nl2br(" \n"));
    }
}

