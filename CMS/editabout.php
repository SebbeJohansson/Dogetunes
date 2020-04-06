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
$get = getOMEdit($_GET['id']);
?>
<html lang="sv">
<head>
    <title>CMS - Edit "<?php echo $get['titel']?>"</title>
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
	<script src="plugins/tinymce/js/tinymce/tinymce.dev.js"></script>
	<script src="plugins/tinymce/js/tinymce/plugins/table/plugin.dev.js"></script>
	<script src="plugins/tinymce/js/tinymce/plugins/paste/plugin.dev.js"></script>
	<script src="plugins/tinymce/js/tinymce/plugins/spellchecker/plugin.dev.js"></script>

	<script>
		$(function(){
			$("#content").mobile_menu({
			menu: ['#menu #userbox a', '#menu #firstbox', '#menu #secondbox'],
			menu_width: 250,
			prepend_button_to: '#mobile-bar'
			});
		});
		tinymce.init({
		selector: "textarea#elm1",
		theme: "modern",
		height: 400, 
		plugins: [
			"advlist autolink link image jbimages lists charmap print preview hr anchor pagebreak spellchecker",
			"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
			"save table contextmenu directionality template paste textcolor importcss"
		],
		external_plugins: {
			//"moxiemanager": "/moxiemanager-php/plugin.js"
		},
		content_css: "css/development.css",
		add_unload_trigger: false,

		toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages | print preview media fullpage | forecolor backcolor emoticons table",

		image_advtab: true,
		relative_urls: false,

		style_formats: [
			{title: 'Rubrik', block: 'h1'},
			{title: 'Underrubrik', format: 'h3'},
			{title: 'Brödtext', inline: 'p'},
		],

		template_replace_values : {
			username : "Jack Black"
		},

		template_preview_replace_values : {
			username : "Preview user name"
		},

		templates: [ 
			{title: 'Some title 1', description: 'Some desc 1', content: '<strong class="red">My content: {$username}</strong>'}, 
			{title: 'Some title 2', description: 'Some desc 2', url: 'development.html'} 
		],

		setup: function(ed) {
			/*ed.on(
				'Init PreInit PostRender PreProcess PostProcess BeforeExecCommand ExecCommand Activate Deactivate ' +
				'NodeChange SetAttrib Load Save BeforeSetContent SetContent BeforeGetContent GetContent Remove Show Hide' +
				'Change Undo Redo AddUndo BeforeAddUndo', function(e) {
				console.log(e.type, e);
			});*/
		},

		spellchecker_callback: function(method, words, callback) {
			if (method == "spellcheck") {
				var suggestions = {};

				for (var i = 0; i < words.length; i++) {
					suggestions[words[i]] = ["First", "second"];
				}

				callback(suggestions);
			}
		}
	});
	</script>
<script language="Javascript">
    function submitForm() {
    tinyMCE.triggerSave();
    document.forms[0].submit();
    }
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

			<section id='hwrapp'><h3>Edit: "<?php echo $get['titel']?>"</h3><a href="http://dogetunes.tytos.se/CMS/?page=delete&g=om&id=<?php echo $get['id']; ?>"><img src="images/delete.png"></a></section>
			<form method="post" action="includes/doEditAbout.php" class="ajax">
				<input name="id" type="hidden" value="<?php echo $get['id']?>">
                <label>Titel</label>
				<input name="name" type="text" value="<?php echo $get['titel']?>" placeholder="Titel" required><br>
				<label>Text</label><br>
				<div>
					<div>
						<textarea id="elm1" name="text" rows="15" cols="80" style="width: 80%" required><?php echo $get['text']?></textarea>
					</div>
				</div>
				<input type="submit" value="Edit" class="submit">
			</form>
			<div style="float:left; width: 100%;" id="result"></div>

		</section>
	</section>
 	<?php }else{
    	header ("Location: http://dogetunes.tytos.se/CMS/login.php?s=inactive");
 	}
	?>
	<script src='script/main.js'></script>

</body>
</html>
