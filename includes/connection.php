<?php
    mysql_connect('server','username','password') or die (mysql_error());
    mysql_selectdb('dbname') or die (mysql_error());
    
    mysql_query( "SET NAMES utf8");     
    mysql_query( "SET CHARACTER SET utf8");
    
?>