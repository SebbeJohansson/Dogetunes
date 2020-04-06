<?php

$filname = $_POST['name'];
$filenameOrg = $_POST['nameOrg'];
$content = $_POST['content'];
$dir = $_POST['dir'];

if($dir){
	$file = fopen("../../" . $dir. "/". $filenameOrg, w);
	rename("../../". $dir . "/" . $filenameOrg, "../../" . $dir . "/" . $filname);
}else{
	$file = fopen("../../" . $filenameOrg, w);
	rename("../../" . $filenameOrg, "../../" . $filname);
}

fwrite($file, $content);
fclose($file);

header ("Location: http://dogetunes.tytos.se/CMS/?page=kodmall&dir=$dir");

?>