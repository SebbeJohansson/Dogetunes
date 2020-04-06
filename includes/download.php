<?php

include ('connection.php');

/* skapa fullständig sökväg till filen */
$file = $_SERVER{'DOCUMENT_ROOT'}.'/Docs/' . $_GET['file'];

$link = $_GET['file'];
$query = mysql_query("SELECT counter FROM documents WHERE link = '$link'");
$hej = mysql_fetch_array($query);
$num = ($hej['counter']) + 1;
$sql = mysql_query("UPDATE documents SET counter = '$num' WHERE link = '$link'");

/* kolla om filen finns */
if(!file_exists($file))
{
   die("Invalid filename");
   
}else{
    
$mime = $_FILES["$file"]["type"];
$size = filesize($file);
header('Content-type: ' . $mime);
header('Content-Disposition: attachment; filename="' . $_GET['file'] . '"');
header('Content-Length: ' . $size);
readfile($file);
} 
?>
