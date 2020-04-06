<?php

include ('functions.php');
include ('connection.php');


$value = $_POST['value'];
$id = $_POST['id'];

if($value == 'true'){
	$varde = 1;
}else{
	$varde = 0;
}

mysql_query("UPDATE artists SET status = '$varde' WHERE id = '$id'") or die (mysql_error());

echo "Everything worked";

?>