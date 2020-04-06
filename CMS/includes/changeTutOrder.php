<?php

include ('functions.php');
include ('connection.php');

if($_GET['act'] == 'changeup' ){
    $current = $_GET['orderID'];
    $aid = $_GET['aid'];
    $cat = $_GET['cat'];
    $res = mysql_query("SELECT id, orderID FROM artists WHERE orderID < ".(int)$current ." AND cat_name = '$cat' ORDER BY orderID DESC LIMIT 1");
    $result = mysql_fetch_array($res);

    $prev_aid = $result['id'];
    $prev = $result['orderID'];

    mysql_query("UPDATE artists SET orderID = '".$current."' WHERE id = '" . (int)$prev_aid . "' AND cat_name = '$cat'");
    mysql_query("UPDATE artists SET orderID = '".$prev."' WHERE id = '" . (int)$aid . "' AND cat_name = '$cat'");
     
    header("Location:/CMS/?page=artistList&cat=$cat");
    exit;
}
if($_GET['act'] == 'changedown' ){
    $current = $_GET['orderID'];
    $aid = $_GET['aid'];
    $cat = $_GET['cat'];
    $res = mysql_query("SELECT id, orderID FROM artists WHERE orderID > ".(int)$current ." AND cat_name = '$cat' ORDER BY orderID ASC LIMIT 1");
    $result = mysql_fetch_array($res);

    $next_aid = $result['id'];
    $next = $result['orderID'];

    mysql_query("UPDATE artists SET orderID = '".$current."' WHERE id = '" . (int)$next_aid . "' AND cat_name = '$cat'");
    mysql_query("UPDATE artists SET orderID  = '".$next."' WHERE id = '" . (int)$aid . "' AND cat_name = '$cat'");

    header("Location:/CMS/?page=artistList&cat=$cat");
    exit;
}

?>
