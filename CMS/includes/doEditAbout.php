<?php

include('functions.php');

if(isset($_POST['name'], $_POST['text'])){
	$dat = new DateTime();
    $date = $dat->format('Y-m-d H:i:s');
    $text = mysql_real_escape_string(stripcslashes($_POST['text']));
	EditOm($_POST['id'], $_POST['name'], $text, $date);
	echo "Informations updated";
}else{
	echo "Form not correctly entered.";
}

?>