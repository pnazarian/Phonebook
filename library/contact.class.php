<?php

class Contact
{
	public $id;
	public $firstName;
	public $lastName;
	public $phoneNumber;
	public $notes;
	
	public function __construct($id, $firstName, $lastName, $phoneNumber, $notes)
	{
		$this->id = $id;
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->phoneNumber = $phoneNumber;
		$this->notes = $notes;
	}
	
}

?>