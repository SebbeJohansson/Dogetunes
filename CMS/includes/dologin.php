<?php
session_start();

include ('connection.php');

    if(isset($_POST['login'])){
        if(isset($_POST['username'])){
            if(isset($_POST['password'])){
                $username = stripslashes(stripcslashes(strip_tags(mysql_real_escape_string($_POST['username']))));
                $password = stripslashes(stripcslashes(strip_tags(mysql_real_escape_string($_POST['password']))));
                $query = mysql_query("SELECT * FROM users WHERE username = '$username'") or die (mysql_error());
                $user = mysql_fetch_array($query);

                /*$salt1 = "db2/j{#LeAK";
                $salt2 = "U8&7(>72ck";
                $pas = sha1($password);

                $pass = $salt1.$pas.$salt2:*/
                
                if(sha1($password) == $user['password'] && $user['admin'] == 1){
                     $_SESSION['user'] = $user['username'];
                    header ("Location: /CMS");
                     
                }else {
                    header ("Location: /CMS/login.php?e=wrong");
                }
                
            }else {
                header ("Location: /CMS/login.php?e=wrong");
            }
        }else {
            header ("Location: /CMS/login.php?e=wrong");
        }
    }else {
        header ("Location: /CMS/login.php?e=wrong");

    }
?>