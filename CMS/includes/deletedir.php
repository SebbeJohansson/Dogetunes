<?php

$filname = $_GET['name'];
$dir = $_GET['dir'];

if($dir == true){
   $dirpath = $dir . "/" . $filname;
}else{
   $dirpath = $filname;
}

if (is_dir("../../". $dirpath)) {
  $objects = scandir("../../". $dirpath);
  foreach ($objects as $object) {
    if ($object != "." && $object != "..") {
        if (filetype("../../".$dirpath."/".$object) == "dir"){
          rmdir("../../". $dirpath."/".$object);
        }else{
          unlink("../../". $dirpath."/".$object);
        }
    }
  }
    rmdir("../../". $dirpath);
}

header ("Location: http://dogetunes.tytos.se/CMS/?page=kodmall&dir=$dir");

?>