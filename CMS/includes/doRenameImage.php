<?php

if($_POST['image_name']){
	$orgName = $_POST['org_name'];
	$newName = $_POST['image_name'];

	$path = "../../images/";
	if(!file_exists($path . $orgName)){
		echo "Name not available!";
	}else{
		if(rename("../../images/$orgName", "../../images/$newName")){
		echo "Name changed";
		}
	}	
}else{
	echo "Please enter a name";
}
