<?php

include ('functions.php');
include ('connection.php');

if(isset($_POST['submit'])){
	$date = date('Y-m-d');
	$content = mysql_real_escape_string(stripcslashes($_POST['content']));
	$description = mysql_real_escape_string(stripcslashes($_POST['description']));

	addTyt($_POST['titel'], $_POST['author'], $content, $description, $_POST['status'] ,$_POST['tilePic'], $_POST['grade'], $date, $_POST['cat'], $_POST['tags'], $_POST['country'], $_POST['merchant'], $_POST['item_name'], $_POST['sellamount'], $_POST['soundcloudid'], $_POST['extra'], $_POST['qrcode'], $_POST['selling']);
}

?>