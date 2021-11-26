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

function get_the_articles()
{
    global $dtbs;

    echo "Getting articles...";

    $search_request = 'SELECT art_id, titre, contenu, sommaire FROM `parrot_articles` WHERE corbeille=0';
    $prepare__search = $dtbs->prepare($search_request);
    $prepare__search->execute(); // run the statement
    $bdd_search_output = $prepare__search->fetchAll(PDO::FETCH_ASSOC); // fetch the rows and put into associative recherche

    $number_of_articles = count($bdd_search_output);
    var_dump($number_of_articles);
    for ($i = 0; $i < $number_of_articles; $i++) {
        $das_titre = $bdd_search_output[$i]['titre'];
        $das_sommaire = $bdd_search_output[$i]['sommaire'];
        print_r("<div class='rectangle_article_container'>");
        print_r("<div class='square'></div>");
        print_r("<div class='actual_article_output_box'> $das_titre   </div>");
        print_r("<div class='very_real_article_sommaire'> $das_sommaire</div>");



        print_r("</div>");
        print_r(nl2br(" \n"));
    }
}

get_the_articles();
