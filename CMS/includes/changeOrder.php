<?php

include ('functions.php');
include ('connection.php');

if($_GET['act'] == 'changeup' ){
    $current = $_GET['orderID'];
    $aid = $_GET['aid'];
    $res = mysql_query("SELECT id, orderID FROM news WHERE orderID > ".(int)$current ." ORDER BY orderID ASC LIMIT 1");
    $result = mysql_fetch_array($res);

    $prev_aid = $result['id'];
    $prev = $result['orderID'];

    mysql_query("UPDATE news SET orderID = '".$current."' WHERE id = '" . (int)$prev_aid . "'");
    mysql_query("UPDATE news SET orderID = '".$prev."' WHERE id = '" . (int)$aid . "'");
     
    header("Location:/CMS/?page=news");
    exit;
}
if($_GET['act'] == 'changedown' ){
    $current = $_GET['orderID'];
    $aid = $_GET['aid'];
    $res = mysql_query("SELECT id, orderID FROM news WHERE orderID < ".(int)$current ." ORDER BY orderID DESC LIMIT 1");
    $result = mysql_fetch_array($res);

    $next_aid = $result['id'];
    $next = $result['orderID'];

    mysql_query("UPDATE news SET orderID = '".$current."' WHERE id = '" . (int)$next_aid . "'");
    mysql_query("UPDATE news SET orderID  = '".$next."' WHERE id = '" . (int)$aid . "'");

    header("Location:/CMS/?page=news");
    exit;
}

?>
