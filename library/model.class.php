<?php

//called by the views

abstract class Model {
	
	//returns an Article object
	public static function getUserContacts($terms)
	{
		$quoteStarts = substr($terms, 0, 1)=='"';
		$termsArray = explode('"', $terms);
		for ($i=0+$quoteStarts; $i<count($termsArray); $i+=2)
		{
			$explosion = explode(' ', $termsArray[$i]);
			$termsArray[$i] = $explosion[0];
			for ($j=1; $j<count($explosion); $j++)
				$termsArray[count($termsArray)] = $explosion[$j];
		}
	
		$ownerName = GoogleClient::authenticate();
	
		$results = Database::querySearchContacts($ownerName, $termsArray);
		
		$out = array();
		for ($i=0; $i<mysqli_num_rows($results); $i++)
		{
			$currentResult = mysqli_fetch_assoc($results);
			
			$out[$i] = new Contact($currentResult['contactID'], $currentResult['firstName'], $currentResult['lastName'], $currentResult['phoneNumber'], $currentResult['notes']);
		}
		
		return $out;
	}
	
	public static function getContact($id)
	{
		$ownerName = GoogleClient::authenticate();
		
		$result = Database::queryContact($id, $ownerName);
		
		return $result===NULL ? NULL : new Contact($result['contactID'], $result['firstName'], $result['lastName'], $result['phoneNumber'], $result['notes']);
	}
}
?>