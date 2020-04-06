<?php

include ('functions.php');
include ('connection.php');

if(isset($_POST['submit'])){
	$content = mysql_real_escape_string(stripcslashes($_POST['content']));
	editNews($_POST['id'], $_POST['titel'], $_POST['tilePicString'],$_POST['tilePicOrg'], $content, $_POST['author']);
}

?>