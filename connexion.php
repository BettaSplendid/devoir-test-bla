<?php
try
{
	$db = new PDO('mysql:host=localhost;dbname=parrot_blog;charset=utf8', 'root');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
mysqli_report(MYSQLI_REPORT_ERROR || MYSQLI_REPORT_STRICT);
echo "Connected successfully";
?>