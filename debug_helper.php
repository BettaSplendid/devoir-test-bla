<?php

//Example utilisation

// Il faut require. Il faut le =1 pour reset à chaque visite.

// require_once('debug_helper.php');

// $_SESSION['debug_step_counter'] = 1;

// debug_helper_counters("Message en string");



function debug_helper_counters($message)
{
    global $data__passer;
    global $debug_count;

    $data__passer = $_SESSION['debug_step_counter'];

    $debug_count = $data__passer + 1;
    $message = ucfirst($message);

    echo  nl2br(" \n");
    echo "--------------------------------------- <br />";
    echo "  Debug step number: $data__passer <br />";
    echo "  '$message'<br />";
    echo "--------------------------------------- <br />";
    echo  nl2br(" \n");

    $_SESSION['debug_step_counter'] = $debug_count;
}
