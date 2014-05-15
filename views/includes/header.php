<?php

$userEmail = GoogleClient::authenticate();

?>

<h1>Phonebook Service</h1>
<h3>You are logged in as <?php echo $userEmail; ?> (<a href="models/signout_model.php">Sign Out</a>)</h3>
		