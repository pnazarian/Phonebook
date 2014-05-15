<!DOCTYPE html Public "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Phonebook Service</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	</head>
	<body>
		
		<?php include 'views/includes/header.php'; ?>
		
		<u><h2>Creating a New Contact</h2></u>
		
		<form action="models/create_model.php" method="POST">
			<p><b>First Name: </b><input type="text" name="firstname" /></p>
			
			<p><b>Last Name: </b><input type="text" name="lastname" /></p>
			
			<p><b>Phone Number: </b><input type="text" name="phonenumber" /> (Do not use spaces or symbols, just 10 digits)</p>
			
			<p><b>Notes: </b><textarea name="notes"></textarea></p>
			
			<input type="submit" value="Submit" />
			
		</form>
	</body>
</html>