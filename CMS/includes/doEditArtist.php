<?php

include ('functions.php');
include ('connection.php');

if(isset($_POST['submit'])){
	$content = mysql_real_escape_string(stripcslashes($_POST['content']));
	$description = mysql_real_escape_string(stripcslashes($_POST['description']));
	editTyt($_POST['id'], $_POST['titel'], $_POST['tilePicString'], $_POST['tilePicOrg'], $description, $_POST['cat'], $_POST['grade'], $content, $_POST['tags'], $_POST['country'], $_POST['merchant'], $_POST['item_name'], $_POST['sellamount'], $_POST['soundcloudid'], $_POST['extra'], $_POST['qrcode'], $_POST['selling']);
}

?>