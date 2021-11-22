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


//Honteusement derobé sur internet
function captchaMath()
{
	$n1 = mt_rand(0,10);
	$n2 = mt_rand(0,10);
	$nbrFr = array('zero','un','deux','trois','quatre','cinq','six','sept','huit','neuf','dix');
	$resultat = $n1 + $n2;
	$phrase = $nbrFr[$n1] .' plus '.$nbrFr[$n2];
	
	return array($resultat, $phrase);	
}

function captcha()
{
	list($resultat, $phrase) = captchaMath();
	$_SESSION['captcha'] = $resultat;
	return $phrase;
}
?>