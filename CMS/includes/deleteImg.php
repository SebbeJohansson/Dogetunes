<?php

$filname = $_GET['name'];

unlink("../../images/" . $filname);


header ("Location: http://dogetunes.tytos.se/CMS/?page=images");

?>