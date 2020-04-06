<?php
session_start();

if(isset($_SESSION['user'])){
     header ("Location: /CMS");
}else{  
?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <title>CMS - login</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1"> 
    <link rel="shortcut icon" href="../images/shortcut.png">
    <link rel="apple-touch-icon-precomposed" href="../images/appicon.png"> 
    <style type="text/css">
    body{
        background: #28282B;
        width: 100%;
        height: 100%;
    }
    </style>
</head>

<body>
    <section id="logo">
            <img src="../images/Dtuneslogo.png" alt="logo">
        </section>
	<section id="loginbox">
    <?php if($_GET['s'] == "inactive"){
        echo "<p style='color: red;'>You have been logged out because of inactivity!</p>";
    } ?>
    <?php if($_GET['e'] == "wrong"){
        echo "<p style='color: red;'>Wrong username or password.</p>";
    } ?>
	<form action="includes/dologin.php" method="post">
          
        <div id="User">
            <input type="text" name="username" placeholder="Username" />
        </div>
        <div id="Pass">
            <input type="password" name="password" placeholder="Passowrd"/>
        </div>
        <div id="Submit">
            <input type="submit" name="login" value="Login" class="Buttom" />
        </div>
    </form>
   </section>
<?php }?>
</body>
</html>