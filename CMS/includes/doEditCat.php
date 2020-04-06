<?php

include ('functions.php');
include ('connection.php');

if(isset($_POST['submit'])){
	$description = mysql_real_escape_string(stripcslashes($_POST['description']));
	editCat($_POST['id'], $_POST['name'], $_POST['iconOrg'], $_POST['iconString'], $description);
}

?>