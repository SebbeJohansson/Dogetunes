<?php

include ('functions.php');
include ('connection.php');

if(isset($_POST['submit'])){
	$date = date('Y-m-d');
	$content = mysql_real_escape_string(stripcslashes($_POST['content']));
	addNews($_POST['titel'], $content, $_POST['tilePic'], $_POST['author'], $date, $_POST['status']);
}

?>