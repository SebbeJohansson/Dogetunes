<?php

include ('functions.php');

if(isset($_POST['submit'])){
	editDoc($_POST['id'], $_POST['name'], $_POST['cat'], $_POST['filename'], $_POST['filenameOrg']);
}

?>