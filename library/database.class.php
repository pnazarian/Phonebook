<?php

//called by Model

class Database extends Singleton {

	private $db;
	
	protected function __construct()
	{
		$this->db = @mysqli_connect('localhost', 'phonebookcom', 'iNvErNo22', 'phonebook');
	}
	
	protected function querySearchContacts($ownerEmail, $termsArray)
	{
		$query = 'SELECT *, (0+';
		
		for ($i=0; $i<count($termsArray); $i++)
		{
			if ($i>0)
			{
				$query .= ' +';
			}
		
			$term = $termsArray[$i];
		
			$query .= " (firstName LIKE '%$term%')*1 +
						   (lastName LIKE '%$term%')*1 ";
		}
		
		$query .= ') AS relevance FROM contacts WHERE ownerEmail="'.$ownerEmail.'" HAVING relevance>0 ORDER BY relevance DESC';
				
		return mysqli_query($this->db, $query);
	}
	
	protected function queryContact($id, $ownerEmail)
	{
		$query = 'SELECT * FROM contacts WHERE contactID='.$id.' AND ownerEmail="'.$ownerEmail.'"';
		
		$results = mysqli_query($this->db, $query);
		
		return mysqli_num_rows($results)>0 ? mysqli_fetch_assoc($results) : NULL;
	}
	
	protected function deleteContact($id, $ownerEmail)
	{
		$query = 'DELETE FROM contacts WHERE contactID='.$id.' AND ownerEmail="'.$ownerEmail.'"';
		
		mysqli_query($this->db, $query);
	}
	
	protected function insertContact($firstName, $lastName, $phoneNumber, $notes, $ownerEmail)
	{
		$query = 'INSERT INTO contacts VALUES (NULL, "'.$firstName.'", "'.$lastName.'", "'.$phoneNumber.'", "'.$notes.'", "'.$ownerEmail.'")';
		
		mysqli_query($this->db, $query);
	}
	
	protected function updateContact($firstName, $lastName, $phoneNumber, $notes, $id, $ownerEmail)
	{
		$query = 'UPDATE contacts SET  ';
		
		if ($firstName !== NULL)
		{
			$query .= 'firstName="'.$firstName.'", ';
		}
		if ($lastName !== NULL)
		{
			$query .= 'lastName="'.$lastName.'", ';
		}
		if ($phoneNumber !== NULL)
		{
			$query .= 'phoneNumber="'.$phoneNumber.'", ';
		}
		if ($notes !== NULL)
		{
			$query .= 'notes="'.$notes.'", ';
		}
		
		$query = substr($query, 0, -2);
		$query .= ' WHERE contactID='.$id.' AND ownerEmail="'.$ownerEmail.'"';
		
		mysqli_query($this->db, $query);
	}
}

?>