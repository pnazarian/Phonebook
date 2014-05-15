<?php

require '../library/autoloader.php';

$firstName = isset($_POST['firstname']) ? $_POST['firstname'] : NULL;
$lastName = isset($_POST['lastname']) ? $_POST['lastname'] : NULL;
$phoneNumber = isset($_POST['phonenumber']) ? $_POST['phonenumber'] : NULL;
$notes = isset($_POST['notes']) ? $_POST['notes'] : NULL;

if ($firstName!==NULL && $lastName!==NULL)
{
	$ownerEmail = GoogleClient::authenticate();
	
	Database::insertContact($firstName, $lastName, $phoneNumber, $notes, $ownerEmail);
}

header('Location: ../?p=console');
?>