<?php

require '../library/autoloader.php';

$firstName = isset($_POST['firstname']) ? $_POST['firstname'] : NULL;
$lastName = isset($_POST['lastname']) ? $_POST['lastname'] : NULL;
$phoneNumber = isset($_POST['phonenumber']) ? $_POST['phonenumber'] : NULL;
$notes = isset($_POST['notes']) ? $_POST['notes'] : NULL;
$id = isset($_POST['id']) ? (int)$_POST['id'] : NULL;

if ($id!==NULL && $id>0)
{
	$ownerEmail = GoogleClient::authenticate();

	Database::updateContact($firstName, $lastName, $phoneNumber, $notes, $id, $ownerEmail);
}
header('Location: ../?p=console');
?>