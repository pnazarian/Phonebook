<?php
		
	$terms = isset($_GET['terms']) ? $_GET['terms'] : '';
	$onPage = isset($_GET['onpage']) ? max(1, (int)$_GET['onpage']) : 1;
		
	$contacts = Model::getUserContacts($terms);
	
	$perPage = 8;
	
?>

<!DOCTYPE html Public "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Phonebook Service</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	</head>
	<body>
	
		<?php include 'views/includes/header.php'; ?>
		
		<a href="?p=create">Add a new contact</a>
		
		<u><h2>(<?php echo count($contacts); ?>) Contacts Found<?php echo $terms=='' ? '' : ' matching <i>'.$terms.'</i>'; ?>:</h2></u>
		
		<?php
		if ($terms!='')
		{
			?>
			<p><a href="?p=console">View all contacts</a></p>
			<?php
		}
		?>
		<form action="index.php" method="GET">
			<input type="text" name="terms" />
			<input type="hidden" name="p" value="console" />
			<input type="submit" value="Search" />
		</form>
		
		<ul>
			<?php
			for ($i=($onPage-1)*$perPage; $i<count($contacts) && $i<$onPage*$perPage; $i++)
			{
				$contact = $contacts[$i];
			
				?>
				<li>
					<b><a href="?p=contact&id=<?php echo $contact->id; ?>"><?php echo $contact->lastName.', '.$contact->firstName; ?></a></b>
					(<a href="models/delete_model.php?id=<?php echo $contact->id; ?>">Delete</a>)
				</li>
				<br />
				<?php
			}
			?>
			
			<form id="pageChanger" action="" method="GET">
			<input type="hidden" name="p" value="console" />
			
			<SCRIPT language="JavaScript">
			function updatePageNumber( n , isCustom)
					 {
						var newVal = +document.forms["pageChanger"].elements["onpage"].value + n;
						
						newVal = Math.max(1, Math.min(<?php echo (int)((count($contacts)-1)/$perPage)+1; ?>, newVal));
						
						if (newVal != document.forms["pageChanger"].elements["onpage"].value)
						{
							document.forms["pageChanger"].elements["onpage"].value = newVal;
							document.forms["pageChanger"].submit();
						}
					 }
			</SCRIPT>
			
			<input type="hidden" name="terms" value="<?php echo $terms; ?>" />
			
			<a href="javascript:updatePageNumber(-1, false)">&lt </a>
			<input type="text" name="onpage" size="1" value="<?php echo $onPage; ?>" onchange="updatePageNumber(0, true)" /> of <?php echo (int)((count($contacts)-1)/$perPage)+1; ?>
			<a href="javascript:updatePageNumber(1, false)"> &gt</a>
			
			</form>
		</ul>
	</body>
</html>