<?php

try
{
	$pdo = new PDO('mysql:host=eu-cdbr-azure-north-e.cloudapp.net;dbname=electionsvilo', 'b96e3a4970b9aa', 'f4ae5bca');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->exec('set names "utf8"');
}catch(PDOException $e)
{
	$error = 'Nie można nawiązać połączenia z bazą danych: ';
	include $_SERVER['DOCUMENT_ROOT'] . '/Elections/html/error.html.php';
	exit();
}
//$output = 'Pomyślnie nawiązano połączenie z bazą danych<br>';
