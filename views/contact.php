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
			<u><h2>Viewing: <?php echo $contact->firstName; ?> <?php echo $contact->lastName; ?></h2></u>
			
			<div style="background-color: #EEE">
			
			<p><b>First Name: </b><?php echo $contact->firstName; ?></p>

			<p><b>Last Name: </b><?php echo $contact->lastName; ?></p>

			<p><b>Phone Number: </b><?php echo $contact->phoneNumber; ?></p>
			
			<p><b>Notes: </b><?php echo $contact->notes; ?></p>
			
			</div>
			
			<p><a href="models/delete_model.php?id=<?php echo $contact->id; ?>">Delete this contact</a>
			<p><a href="?p=edit&id=<?php echo $contact->id; ?>">Edit this contact</a></p>
			<p><a href="?p=console">Back to all contacts</a></p>
		<?php
		}
		?>
		
	</body>
</html>