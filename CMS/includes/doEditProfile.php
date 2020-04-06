<?php

include ('functions.php');
include ('connection.php');


if(!$_GET['a'] == "pass"){
	if($_POST['submit']){
		editProfile($_POST['id'], $_POST['full_name'], $_POST['username'], $_POST['epost'],$_POST['info'], $_POST['profilepicOrg'], $_POST['profilepicString']);
	}
}else{
	if($_POST['submit']){
		$newPassword = sha1($_POST['newpass']);
		editPass($_POST['id'], $newPassword);
	}
}

?>