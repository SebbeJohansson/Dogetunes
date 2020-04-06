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
?>
<html lang="sv">
<head>
    <title>CMS - Fil</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta http-equiv="cleartype" content="on">
	<link rel="shortcut icon" href="http://dogetunes.tytos.se/images/shortcut.png">
    <link rel="apple-touch-icon-precomposed" href="http://dogetunes.tytos.se/images/appicon.png">

	<script src="script/ajax.js"></script>
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

	<link rel=stylesheet href="plugins/codemirror/doc/docs.css">
	<link rel="stylesheet" href="plugins/codemirror/lib/codemirror.css">
	<script src="plugins/codemirror/lib/codemirror.js"></script>
	<script src="plugins/codemirror/mode/css/css.js"></script>
	<script src="plugins/codemirror/mode/php/php.js"></script>
	<script src="plugins/codemirror/mode/xml/xml.js"></script>
	<script src="plugins/codemirror/mode/javascript/javascript.js"></script>


	<style type="text/css">
      .CodeMirror {
        border: 1px solid #eee;
        height: auto;
      }
      .CodeMirror + div{
        display: none;
      }
      .CodeMirror-scroll {
        overflow-y: hidden;
        overflow-x: auto;
      }
    </style>
</head>
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

			<section id='hwrapp'><h3>Create a folder</h3></section>
			<form method="post" action="includes/doCreateDir.php">
                <label>Folder Name</label>
                <?php if($_GET['e'] == 1){echo "<p>A folder with this name is already existing</p>";}?>
				<input name="name" type="text" required><br>
				<input type="hidden" name="dir" value="<?php echo $_GET['dir'] ?>">
				<input type="submit" name="submit" value="Create folder" class="submit">

			</form>

		</section>
	</section>
 	<?php }else{
    	header ("Location: http://dogetunes.tytos.se/CMS/login.php?s=inactive");
 	}
	?>
</body>
</html>
