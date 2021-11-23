<?php

$domaine = "http://localhost";

$error = [
    "message" => "",
    "existe" => false
];

session_start();
$_SESSION['id'] = null;
$_SESSION['mail'] = null;
$_SESSION['pseudo'] = null;
$_SESSION['logged_in'] = null;
$_SESSION['yourCountersNameHere'] = 0;
