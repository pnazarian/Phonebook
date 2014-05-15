<?php

require '../library/autoloader.php';

$id = isset($_GET['id']) ? $_GET['id'] : NULL;

if ($id!==NULL)
{
	$ownerEmail = GoogleClient::authenticate();
	
	Database::deleteContact($id, $ownerEmail);
}

header('Location: ../?p=console');
?>