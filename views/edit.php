<?php
	
	$id = isset($_GET['id']) ? (int)$_GET['id'] : NULL;
	
	$contact = Model::getContact($id);
	
?>

<!DOCTYPE html Public "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Phonebook Service</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	</head>
	<body>
		
		<?php include 'views/includes/header.php'; ?>
		
		<?php
		if ($contact===NULL)
		{
			?>
			<h2>Contact Not Found</h2>
			<?php
		}
		else
		{
			?>
			
			<u><h2>Editing: <?php echo $contact->lastName; ?>, <?php echo $contact->firstName; ?></h2></u>
			
			<form action="models/edit_model.php" method="POST">
				<p><b>First Name: </b><input type="text" name="firstname" value="<?php echo $contact->firstName; ?>"/></p>
				
				<p><b>Last Name: </b><input type="text" name="lastname" value="<?php echo $contact->lastName; ?>"/></p>
				
				<p><b>Phone Number: </b><input type="text" name="phonenumber" value="<?php echo $contact->phoneNumber; ?>" /> (Do not use spaces or symbols, just 10 digits)</p>
				
				<p><b>Notes: </b><textarea name="notes"><?php echo $contact->notes; ?></textarea></p>
				
				<input type="hidden" name="id" value="<?php echo $contact->id; ?>" />
				
				<input type="submit" value="Save" />
				
			</form>
			
			<p><a href="?p=contact&id=<?php echo $id; ?>">Cancel the changes</a></p>
			<p><a href="models/delete_model.php?id=<?php echo $contact->id; ?>">Delete this contact</a></p>
			<p><a href="?p=console">Back to all contacts</a></p>
		<?php
		}
		?>
		
	</body>
</html>