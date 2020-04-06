<?php
session_start();

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 3000)) {
    
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
$get = getNewsEdit($_GET['id']);
?>
<html lang="sv">
<head>
    <title>CMS Edit "<?php echo $get['titel'] ?>"</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta http-equiv="cleartype" content="on">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<link rel="shortcut icon" href="http://dogetunes.tytos.se/images/shortcut.png">
    <link rel="apple-touch-icon-precomposed" href="http://dogetunes.tytos.se/images/appicon.png">

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<script src="script/jquery.mobile-menu.js"></script>
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

			<section id='hwrapp'><h3>Edit: "<?php echo $get['titel']?>"</h3><a href="http://dogetunes.tytos.se/CMS/?page=delete&g=news&id=<?php echo $get['id']; ?>"><img src="images/delete.png"></a></section>
			<form method="post" action="includes/doEditNews.php" enctype="multipart/form-data">
				<input name="id" type="hidden" value="<?php echo $get['id']?>">
                <label>Titel</label>
				<input name="titel" type="text" value="<?php echo $get['titel']?>" placeholder="Titel" required>
				<label>Picture</label><br>
				<input type="text" name="tilePicString" value="<?php echo $get['tilePic'] ?>">
				<input type="hidden" name="tilePicOrg" value="<?php echo $get['tilePic'] ?>">
				<input type="file" name="tilePic">
				<div>
					<div>
						<textarea id="elm1" name="content" rows="15" cols="80" style="width: 80%" required><?php echo $get['content']?></textarea>
					</div>
				</div>
				<input type="hidden" name="author" value="<?php echo $get['author']?>">
                <input type="submit" name="submit" value="Edit nnews" class="submit">
			</form>

		</section>
	</section>
 	<?php }else{
    	header ("Location: http://dogetunes.net/CMS/login.php?s=inactive");
 	}
	?>
</body>
</html>
