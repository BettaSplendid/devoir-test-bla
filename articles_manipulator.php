<?php


//Ensure connexion  to database
require_once('config/config.php');
require_once('debug_helper.php');

$_SESSION['debug_step_counter'] = 1;

debug_helper_counters("a");
echo $_POST['content'];
debug_helper_counters("a");