<?php
session_start();

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 900)) {
    
    session_unset(); 
    session_destroy();
    echo "<script>window.location.assign('/CMS/login.php?s=inactive')</script>";
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
    <title>CMS <?php if($_GET['page']){echo '- '.ucfirst($_GET['page']);}else{echo '- Start';}?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">	
	<meta http-equiv="cleartype" content="on">
	<link rel="shortcut icon" href="/images/shortcut.png">
    <link rel="apple-touch-icon-precomposed" href="/images/appicon.png">

    <script src="http://jqueryjs.googlecode.com/files/jquery-1.2.6.min.js" type="text/javascript"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>	

	<link href="plugins/iCheck/skins/flat/orange.css" rel="stylesheet">
	<script src="plugins/iCheck/icheck.js"></script>
	<link href="plugins/iCheck/skins/demo/css/custom.css?v=0.8.0.2" rel="stylesheet">
	<link href="plugins/iCheck/skins/all.css?v=0.8.0.2" rel="stylesheet">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="plugins/iCheck/icheck.min.js"></script>
<script>

$(document).ready(function(){
    $('input').iCheck({
    	checkboxClass: 'icheckbox_flat-orange',
    	radioClass: 'iradio_flat-orange'
  	});
});
</script>

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
	<script type="text/javascript">
    
 function popup(){   
    $(document).ready( function() {
    
        // When site loaded, load the Popupbox First
        loadPopupBox();
    
        $('#popupBoxClose').click( function() {            
            unloadPopupBox();
        });
        
        $('#container').click( function() {
            unloadPopupBox();
        });

        function unloadPopupBox() {    // TO Unload the Popupbox
            $('#popup_box').fadeOut("fast");
            $("#container").css({ // this is just for style        
                "opacity": "1"  
            }); 
        }    
        
        function loadPopupBox() {    // To Load the Popupbox
            $('#popup_box').fadeIn("fast");
            $("#container").css({ // this is just for style
                "opacity": "0.3"  
            });         
        }        
    });
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
			<div id="popup_box">
                <div id="popupHeader"><h4>Upload picture</h4></div>
                <form method="post" action="includes/doUploadImages.php" enctype="multipart/form-data">
                <label>Choose file</label>
                <br><br>
                <input type="file" name="images" required>
                <br><br>
                <input type="submit" name="submit" value="Upload" id="submit">
                </form>
                <a id="popupBoxClose"><img src="/CMS/images/close.png" width=25px></a>    
            </div>
        </section>

			<?php if(!$_GET['page']){
			echo "<table><thead><tr><th>Title</th><th>Creator</th><th>Date</th></tr></thead><tbody>";
				getNews(4);
				echo "</tbody></table>";
			echo "<table><thead><tr><th>Title</th><th>Category</th><th>Date</th><th></th></tr></thead><tbody>";
				getTyt('', 4);
				echo "</tbody></table>";
			echo "<table><thead><tr><th>Title</th><th>Last updated</th><th></th></tr></thead><tbody>";
				getOm();
				echo "</tbody></table>";
			}
			elseif($_GET['page'] == "news"){
				echo "<table id='roworder'><thead><tr><th>Title</th><th>Date</th><th></th></tr></thead><tbody>";
				getNews();
				echo "</tbody></table>";
			}
			elseif($_GET['page'] == "artists"){
				getTytCatSelect();
			}
			elseif($_GET['page'] == "artistList"){
				echo "<table><thead><tr><th>Titel</th><th>Datum</th><th></th></tr></thead><tbody>";
				getTyt($_GET['cat']);
				echo "</tbody></table>";
			}
			elseif($_GET['page'] == "cats"){
				echo "<table><thead><tr><th>Titel</th><th>Icon</th><th></th></tr></thead><tbody>";
				getCat();
				echo "</tbody></table>";
			}
			elseif($_GET['page'] == "documents"){
				echo "<table><thead><tr><th>Namn</th><th>Kategori</th><th>Counter</th><th></th></tr></thead><tbody>";
				getDoc();
				echo "</tbody></table>";
			}
			elseif($_GET['page'] == "kodmall"){
				$space = disk_free_space("/") / 1000000000;
				$space2 = round($space, 2);
				if(!$_GET['dir']){
					echo "<section id='hwrapp'><h3>Rot</h3><a href='/CMS/createdir.php?dir='><img src='images/addFolder.png'></a><a href='/CMS/createfile.php?dir='><img src='images/addFile.png'></a></section>";
					echo "<section id='hwrapp2'><a href='javascript:history.go(-1)'><img style='width:30px;' src='/CMS/images/back.png'></a><a href='javascript:history.go(1)'><img style='width:30px; margin-left: 2.5%;' src='/CMS/images/forward.png'></a><h3>$space2 gb kvar</h3></section>";
					echo "<table><thead><tr><th>Namn</th><th>Senast ändrad</th><th></th></tr></thead><tbody>";
					viewFiles("");
					echo "</tbody></table>";
				}else{
					$dir = $_GET['dir'];
					echo "<section id='hwrapp'><h3>/$dir</h3><a href='/CMS/createdir.php?dir=$dir'><img src='images/addFolder.png'></a><a href='/CMS/createfile.php?dir=$dir'><img src='images/addFile.png'></a></section>";
					echo "<section id='hwrapp2'><a href='javascript:history.go(-1)'><img style='width:30px;' src='/CMS/images/back.png'></a><a href='javascript:history.go(1)'><img style='width:30px; margin-left: 2.5%;' src='/CMS/images/forward.png'></a><h3>$space2 gb kvar</h3></section>";
					echo "<table><thead><tr><th>Namn</th><th>Senast ändrad</th><th></th></tr></thead><tbody>";
					viewFiles($dir);
					echo "</tbody></table>";
				}
			}
			elseif($_GET['page'] == "images"){
				echo "<section id='hwrapp'><h3>Bilder</h3><a class='right' href='#'><h3 onclick='popup();'>Ladda upp bild</h3></a></section>";
				viewImages();
			}
			elseif($_GET['page'] == "backup"){
				getBackup();
			}
			elseif($_GET['page'] == "users"){
				echo "<table><thead><tr><th>Namn</th><th>Användarnamn</th></tr></thead><tbody>";
				getUsers();
				echo "</tbody></table>";
			}
			elseif($_GET['page'] == "profile"){
				echo "<section id='hwrapp'><h3>Profile</h3></section>";
				getProfileByName($_SESSION['user']);
			}
			elseif($_GET['page'] == "delete"){
				$g = $_GET['g'];
				delete($g, $_GET['id']);
				$cat = $_GET['cat'];
				if($g == 'dogetunes.tytosar'){
					echo "<script>window.location.assign('/CMS/?page=dogetunes.tytosList&cat=$cat')</script>";
				}else{
					echo "<script>window.location.assign('/CMS/?page=$g')</script>";
				}
				
			}else{
			$page =	$_GET['page'];
			echo "<section id='hwrapp'><h3>Haha! trodde du verkligen att det 
			fanns en sida som hette <b>$page</b>
			</h3></section>";
			exit();
			}
			?>
		</section>
	</section>
 	<?php }else{
    	echo "<script>window.location.assign('/CMS/login.php')</script>";
    	exit();
 	}
	?>
    <script src='script/main.js'></script>


</body>
</html>
