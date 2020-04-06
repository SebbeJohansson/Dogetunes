<?php

$name = $_POST['name'];
$dir = $_POST['dir'];

if(!file_exists("../../" . $dir . "/" . $name)){

if($dir){
	mkdir("../../". $dir. "/". $name);
}else{
	mkdir("../../" . $name);
}
header ("Location: http://dogetunes.tytos.se/CMS/?page=kodmall&dir=$dir");
}else{
	header ("Location: http://dogetunes.tytos.se/CMS/createdir.php?dir=$dir&e=1");
}


?>