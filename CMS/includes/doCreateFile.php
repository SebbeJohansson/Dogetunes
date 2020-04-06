<?php

$filname = $_POST['name'];
$content = $_POST['content'];
$dir = $_POST['dir'];

if(!file_exists("../../". $dir. "/". $filname)){

if($dir){
	$file = fopen("../../". $dir. "/". $filname, w);
}else{
	$file = fopen("../../" . $filname, w);
}

fwrite($file, $content);
fclose($file);
header ("Location: http://dogetunes.tytos.se/CMS/?page=kodmall&dir=$dir");
}else{
	header ("Location: http://dogetunes.tytos.se/CMS/createfile.php?dir=$dir&e=1");
}
?>