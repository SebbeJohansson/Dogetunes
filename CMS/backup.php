<?php

include ('includes/connection.php');

if(isset($_GET[go])){

$dat = new DateTime();
$date = $dat->format('Y-m-d H:i:s');

$zips="folder.zip";
$zips= $_POST['name']. "-" . $date . ".zip";
// increase script timeout value
ini_set("max_execution_time", 600);
ini_set('memory_limit','64M');
// create object
$zip = new ZipArchive();
// open archive
if ($zip->open($zips, ZIPARCHIVE::CREATE) !== TRUE) {
die ("Could not open archive");
}
// initialize an iterator
// pass it the directory to be processed
$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator("./"));
// iterate over the directory
// add each file found to the archive
foreach ($iterator as $key=>$value) {
$zip->addFile(realpath($key), $key) or die ("ERROR: Could not add file: $key");
}
// close and save archive
$zip->close();

function force_download($file)
{
    $dir      = "./";
    if ((isset($file))&&(file_exists($dir.$file))) {
       header("Content-type: application/force-download");
       header('Content-Disposition: inline; filename="' . $dir.$file . '"');
       header("Content-Transfer-Encoding: Binary");
       header("Content-length: ".filesize($dir.$file));
       header('Content-Type: application/octet-stream');
       header('Content-Disposition: attachment; filename="' . $file . '"');
       readfile("$dir$file");
    } else {
       echo "No file selected";
    } //end if

}//end function 

force_download($zips);
}
unlink($zips);

$author = $_POST['author'];
$name = $_POST['name'];

mysql_query("INSERT INTO backup VALUES (null, '$name', '$author', '$date')") or die (mysql_error());
?>
