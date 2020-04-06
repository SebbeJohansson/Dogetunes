<?php

$filname = $_GET['name'];
$dir = $_GET['dir'];

if($dir == true){
	unlink("../../". $dir. "/". $filname);
}else{
	unlink("../../" . $filname);
}

header ("Location: http://dogetunes.tytos.se/CMS/?page=kodmall&dir=$dir");

?>