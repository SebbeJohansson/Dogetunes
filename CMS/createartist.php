<?php
session_start();

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 10000)) {
    
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
    <title>CMS | Add Artist</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta http-equiv="cleartype" content="on">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<link rel="shortcut icon" href="http://dogetunes.tytos.se/images/shortcut.png">
    <link rel="apple-touch-icon-precomposed" href="http://dogetunes.tytos.se/images/appicon.png">
    <link href="plugins/flat_ui_elements/bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- Loading Flat UI -->
    <link href="plugins/flat_ui_elements/css/flat-ui.css" rel="stylesheet">


	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<script src="script/main.js"></script>
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
		tinymce.init({
		selector: "textarea#elm2",
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

			<section id='hwrapp'><h3>Add Artist</h3></section>
			<form method="post" action="includes/doCreateArtist.php" enctype="multipart/form-data">
				<input type="hidden" name="author" value="<?php echo $admin['full_name']?>">
                <label>Titel</label>
				<input name="titel" type="text" maxlength="22" placeholder="Titel" required><br>
				<label>Picture</label><br>
				<input type="file" name="tilePic" required><br>
				<label>Links</label><br>
				<div>
					<div>
						<textarea id="elm1" name="content" rows="30" cols="80" style="width: 80%"></textarea>
					</div>
				</div>
				<label>Country</label><br>
				<input name="country" type="text" placeholder="Country" value="<?php echo $get['country']; ?>" required></textarea>
  				<div class="soundcloudcheckbox <?php if($get['soundcloudid']){echo "highlighted";}?>"><label class="selllabel"><?php if(!$get['soundcloudid']){echo "Enable SoundCloud";}else{echo "Disable Soundcloud";}?></label></div><br>
				<div class="soundcloud">
				<label>Soundcloud username</label><br>
				<input id="soundcloudid" name="soundcloudid" type="text" placeholder="SoundCloud Username" value="<?php echo $get['soundcloudid']; ?>"></textarea><br><label>Tags</label><br>
  				</div>
				<div class="span3">
          			<input name="tags" id="tagsinput" class="tagsinput" value="<?php echo $get['tags']; ?>" required/>
        		</div>
				<div class="sellcheckbox <?php if($get['merchant']){echo "highlighted";}?>"><label class="selllabel"><?php if(!$get['merchant']){echo "Enable Selling";}else{echo "Disable Selling";}?></label></div><br>
				<div class="sellmusic" style="display: <?php if($get['merchant']){echo "block;";}else{echo "none;";}?>">
				<label>MerchantID</label><br>
				<input id="merchant" name="merchant" type="text" placeholder="Merchant ID" value="<?php echo $get['merchant']; ?>"></textarea><br>
				<label>Album/song Name</label><br>
				<input name="item_name" type="text" placeholder="Album/songname" value="<?php echo $get['item_name']; ?>"></textarea><br>
				<label>Price (in DOGE)</label><br>
				<input name="sellamount" type='text' placeholder="0.00" value="<?php echo $get['sellamount']; ?>"></textarea><br>
				</div>
				<label>Extra info (more selling etc.)</label><br>
				<div>
					<div>
						<textarea id="elm2" name="extra" rows="30" cols="80" style="width: 80%"><?php echo $get['extra']; ?></textarea>
					</div>
				</div>
				<label>ImgurLink for QR code</label><br>
				<input name="qrcode" type='text' placeholder="URL" value="<?php echo $get['qrcode']; ?>"></textarea><br>
				<label>Status</label><br>
				<select name="status" class="select">
                    <option value="1">Online</option>
                    <option value="0">Offline</option>
				</select>
				<select name="cat" class="select" required>
                    <?php
                    $result = mysql_query("SELECT * FROM cats") or die(mysql_error());
                    while($cat = mysql_fetch_array($result)){ 
                    	 if($_GET['cat'] == $cat['name']){$grade = "selected='selected'";}else{$grade =  "";}            
                        echo "<option $grade value=".$cat['name'].">{$cat['name']}</option>";
                    }
                    ?>
                </select>
                <a href="javascript:submitForm();"><input type="submit" name="submit" value="Add artist" class="submit"></a>
		
			</form>

		</section>
	</section>
 	<?php }else{
    	header ("Location: http://dogetunes.tytos.se/CMS/login.php?s=inactive");
 	}
	?>
	<script src="script/jquery.mobile-menu.js"></script>
    <script src="plugins/flat_ui_elements/js/jquery.ui.touch-punch.min.js"></script>
    <script src="plugins/flat_ui_elements/js/bootstrap.min.js"></script>
    <script src="plugins/flat_ui_elements/js/bootstrap-select.js"></script>

    <script src="plugins/flat_ui_elements/js/jquery.tagsinput.js"></script>
    <script src="plugins/flat_ui_elements/js/jquery.placeholder.js"></script>
    <script src="plugins/flat_ui_elements/js/jquery.stacktable.js"></script>
    <script src="http://vjs.zencdn.net/c/video.js"></script>
    <script src="plugins/flat_ui_elements/js/application.js"></script>


</body>
</html>
