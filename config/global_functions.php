<?php

// //Pas très beau.
function set_session_variables($Cnnct)
{
    global $session_pseudo;
    global $session_mail;
    global $session_id;
    if ($Cnnct) {
        $_SESSION['loggedin'] = true;
        $_SESSION['pseudo'] = $session_pseudo;
        $_SESSION['mail'] = $session_mail;
        $_SESSION['id'] = $session_id;
    } else {
        $_SESSION['loggedin'] = false;
        $_SESSION['pseudo'] = null;
        $_SESSION['mail'] = null;
        $_SESSION['id'] = null;
    }

    var_dump($_SESSION['loggedin']);
    var_dump($_SESSION['pseudo']);
    var_dump($_SESSION['mail']);
    var_dump($_SESSION['id']);
}


