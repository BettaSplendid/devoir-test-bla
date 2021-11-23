<?php

//Pas très beau.
function set_session_variables($Cnnct)
{
    global $pseudo;
    global $mail;
    if ($Cnnct) {
        $_SESSION['loggedin'] = true;
        $_SESSION['pseudo'] = $pseudo;
        $_SESSION['mail'] = $mail;
    } else {
        $_SESSION['loggedin'] = false;
        $_SESSION['pseudo'] = null;
        $_SESSION['mail'] = null;
    }
}
