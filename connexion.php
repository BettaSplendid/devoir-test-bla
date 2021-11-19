<?php
try
{
	$db = new PDO('mysql:host=localhost;dbname=parrot_blog;charset=utf8', 'root');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
echo "Connected successfully";
?>