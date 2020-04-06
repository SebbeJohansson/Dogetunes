<?php

include('functions.php');

if(isset($_POST['name'], $_POST['text'])){
	$dat = new DateTime();
    $date = $dat->format('Y-m-d H:i:s');
    $text = mysql_real_escape_string(stripcslashes($_POST['text']));	
	createOm($_POST['name'], $text, $date);
	echo "Information was sent";
}else{
	echo "Please enter the correct info.";
}

?>


