<?php

//Ensure connexion  to database
require_once('config/config.php');
require_once('debug_helper.php');

function get_articles_titles()
{
    global $dtbs;

    echo " Search db for account ()<br />";

    $search_request = 'SELECT art_id, titre FROM `parrot_articles`';
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

get_articles_titles();
