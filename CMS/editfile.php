<?php
session_start();

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 600)) {
    
    session_unset(); 
    session_destroy();
    header ("Location: http://tytos.se/CMS/login.php?s=inactive");
}
$_SESSION['LAST_ACTIVITY'] = time();

if(isset($_SESSION['user'])){ 

?>
 
<?php
include ("includes/connection.php");
include ('includes/functions.php');

$admin = getAdmin($_SESSION['user']);
?>
<html lang="sv">
<head>
    <title>CMS - Ändra "<?php echo $_GET['name']; ?>"</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta http-equiv="cleartype" content="on">
	<link rel="shortcut icon" href="http://tytos.se/images/shortcut.png">
    <link rel="apple-touch-icon-precomposed" href="http://tytos.se/images/appicon.png">

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

	<link rel="stylesheet" href="plugins/codemirror/doc/docs.css">
	<link rel="stylesheet" href="plugins/codemirror/lib/codemirror.css">
	<script src="plugins/codemirror/lib/codemirror.js"></script>
	<script src="plugins/codemirror/lib/codemirror.js"></script>
	<script src="plugins/codemirror/mode/css/css.js"></script>
	<script src="plugins/codemirror/mode/php/php.js"></script>
	<script src="plugins/codemirror/mode/xml/xml.js"></script>
	<script src="plugins/codemirror/mode/javascript/javascript.js"></script>

	<style type="text/css">
      .CodeMirror {
        border: 1px solid #eee;
        height: auto;
        width: 95%;
        margin: 10px auto;
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
				<?php
				$filename = $_GET['name'];
				$dir = $_GET['dir'];
				if($dir){
					$contents = (file_get_contents("../". $dir. "/". $filename));
				}else{
					$contents = (file_get_contents("../". $filename));
				}
				fclose($fileread);
				$contents2 = htmlspecialchars($contents);
				?>
			<section id='hwrapp'><h3>Redigera: "<?php echo $filename; ?>"</h3></section>
			<form method="post" action="includes/doEditFile.php">
				
                <label>Namn</label>
                <input name="nameOrg" type="hidden" value="<?php echo $filename; ?>" required="required"><br>
				<input name="name" type="text" value="<?php echo $filename; ?>" required="required"><br>
				<label>Innehåll</label><br>
				<textarea id="code" name="content" style="height: 400px" required="required"><?php echo $contents2; ?></textarea>
				<input type="hidden" name="dir" value="<?php echo $_GET['dir']; ?>">
				<input type="submit" name="submit" value="Ändra fil" class="submit">

			</form>
			<script>
      		var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
        	lineNumbers: true,
        	viewportMargin: Infinity
      		});
    		</script>

		</section>
	</section>
 	<?php }else{
    	header ("Location: http://tytos.se/CMS/login.php?s=inactive");
 	}
	?>
</body>
</html>
