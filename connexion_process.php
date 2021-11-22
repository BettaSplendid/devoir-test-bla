<?php
// Cela envoie un cookie persistant qui dure une journée.
session_start([
    'cookie_lifetime' => 86400,
]);
// $_SESSION['mail'];
// $_SESSION['pseudo'];
// $_SESSION['mdp'];

//Ensure connexion  to database
require_once('connect_mysql.php');
