<?php

//Example utilisation

// Il faut require. Il faut le =1 pour reset à chaque visite.
// 

// require_once('debug_helper.php');

// $_SESSION['yourCountersNameHere'] = 1;


// debug_helper_counters();



function debug_helper_counters()
{
    global $data__passer;
    global $debug_count;

    $data__passer = $_SESSION['yourCountersNameHere'];

    $debug_count = $data__passer + 1;
    
    echo  nl2br(" \n");
    echo "--------------------------------------- <br />";
    echo "  Debug step number: $data__passer <br />";
    echo "--------------------------------------- <br />";
    echo  nl2br(" \n");

    $_SESSION['yourCountersNameHere'] = $debug_count;
}
