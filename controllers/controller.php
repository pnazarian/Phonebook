<?php

$p = isset($_GET['p']) ? $_GET['p'] : '';

if (is_file('views/'.$p.'.php'))
{
	require 'views/'.$p.'.php';
}
else
{
	require 'views/index.php';
}

?>