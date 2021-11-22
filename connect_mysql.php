<?php

//require_once("../config/config.php");
//Pas besoin pour le moment.

//CONNEXION BDD
$domaine = "http://localhost";
$username = "root";
$password = "";
$host = "localhost"; //localhost 
$dbn = "parrot_blog";

$option = [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

$dsn = "mysql:host=$host;dbname=$dbn;charset=utf8";

try {
    $dtbs = new PDO($dsn, $username, $password, $option);
} catch (PDOException $error) {
    $message = $error->getMessage();
    var_dump($message);
    die("Erreur lors de ma connexion PDO");
}
echo "Connected successfully with variables method";








// Connexion en dure ancienne. Elle marche mais elle est pas belle donc je la commente.
// try {
//     $dtbs = new PDO('mysql:host=localhost;dbname=parrot_blog;charset=utf8', 'root');
// } catch (Exception $e) {
//     die('Erreur : ' . $e->getMessage());
// }
// echo "Connected successfully with hardcoded method";
