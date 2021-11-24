<?php

require_once("connect_mysql.php");

$error = [
    "message" => "",
    "existe" => false
];

session_start();
$_SESSION['id'] = null;
$_SESSION['mail'] = null;
$_SESSION['pseudo'] = null;
$_SESSION['logged_in'] = null;
$_SESSION['debug_step_counter'] = 0;
