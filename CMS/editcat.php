<?php
session_start();

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 600)) {
    
    session_unset(); 
    session_destroy();
    header ("Location: http://dogetunes.tytos.se/CMS/login.php?s=inactive");
}
$_SESSION['LAST_ACTIVITY'] = time();

if(isset($_SESSION['user'])){ 

?>
<!DOCTYPE html>
<?php
include ("includes/connection.php");
include ('includes/functions.php');

$admin = getAdmin($_SESSION['user']);
$get = getCatEdit($_GET['id']);
?>
<html lang="sv">
<head>
    <title>CMS - Edit "<?php echo $get['name']?>"</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta http-equiv="cleartype" content="on">
	<link rel="shortcut icon" href="http://dogetunes.tytos.se/images/shortcut.png">
    <link rel="apple-touch-icon-precomposed" href="http://dogetunes.tytos.se/images/appicon.png">

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<script src="script/jquery.mobile-menu.js"></script>
	<script>
		$(function(){
			$("#content").mobile_menu({
			menu: ['#menu #userbox a', '#menu #firstbox', '#menu #secondbox'],
			menu_width: 250,
			prepend_button_to: '#mobile-bar'
			});
		});
	</script>
</head>

<body>
	<aside>
	<?php include('includes/aside.php');?>
	</aside>
	<section id="content">
		<header>
			<?php include('includes/header.php');?>
		</header>
		<section id="mobileheader">
			<?php include('includes/mobileheader.php');?>
		</section>
		<section id="contentholder">

			<section id='hwrapp'><h3>Edit "<?php echo $get['name']?>"</h3><a href="http://dogetunes.tytos.se/CMS/?page=delete&g=cats&id=<?php echo $get['id']; ?>"><img src="images/delete.png"></a></section>
			<form method="post" action="includes/doEditCat.php" enctype="multipart/form-data">
				<input name="id" type="hidden" value="<?php echo $get['id']?>">
                <label>Titel</label>
				<input name="name" type="text" value="<?php echo $get['name']?>" placeholder="Titel" required><br>
				<label>Change picture name</label><br>
				<input type="hidden" name="iconOrg" value="<?php echo $get['icon'] ?>">
				<input type="text" name="iconString" value="<?php echo $get['icon'] ?>">
				<label>Chnage picture</label><br>
				<input name="icon" type="file"><br>
				<label>Description</label><br>
				<textarea name="description" type="text" required><?php echo $get['description']?></textarea><br>
				<input type="submit" name="submit" value="Edit artist" class="submit">

			</form>

		</section>
	</section>
 	<?php }else{
    	header ("Location: http://dogetunes.tytos.se/CMS/login.php?s=inactive");
 	}
	?>
</body>
</html>
