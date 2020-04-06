<?php 
include ("includes/functions.php");
$name = $_GET['name'];
$string = explode("-", $name);
$string2 = implode(" ", $string);
$keywords = getKeywords($string2);
?>
<!Doctype html>
<html lang="sv">
    <head>
        <?php
        $name = explode("-", $_GET['name']);
        $name2 = implode(" ", $name);

        ?>
        <title>Dogetunes.net <?php if($_GET['p'] == "tyt"){echo '- '. ucfirst($name2). ' - ' .ucfirst($_GET['cat']);}elseif($_GET['p'] == "cat"){echo '- '. ucfirst($name2);}elseif(!$_GET['p']){echo "- Start";}else{echo '- '. ucfirst($_GET['p']);}?></title>
        <meta charset="utf-8">
	<meta name="description" content="Dogetunes is a website where you can tip or buy music using Dogecoins to independent artists worldwide.">
	<meta name="keywords" content="<?php if($_GET['p'] == "tyt"){echo $keywords['tags'];}else{echo 'dogecoin';}?>">
        <!--[if lte IE 8]>
            <meta http-equiv="refresh" content="0; url=/http_error/error.php" />
            <script type="text/javascript">
            window.top.location = '/http_error/error.php';
            </script>
        <![endif]-->
        
        <!-- css -->
        <link rel="stylesheet" type="text/css" href="/css/style.css"/>
        <link rel="stylesheet" type="text/css" href="/css/slide.css"/>
        <link rel="stylesheet" type="text/css" href="/css/shCoreRDark.css">
	
	<?php
	    if($_GET['p'] == "costs"){
		echo '<link rel="stylesheet" type="text/css" href="/css/costs.css"/>';
	    }
        ?>
	
        <!--link rel="alternate" href="/feeds/" title="Dogetunes" type="application/rss+xml"/-->
        <!-- meta och ikoner -->
        <meta name="HandheldFriendly" content="True">
        <meta name="MobileOptimized" content="320">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1"> 
        <link rel="shortcut icon" href="/images/shortcut.png">
        <link rel="apple-touch-icon-precomposed" href="/images/appicon.png">

		<!-- Facebook like-->
 		<script id="facebook-jssdk" src="//connect.facebook.net/sv_SE/all.js#xfbml=1"></script>
		<?php 
		if($_GET['p'] == "tyt"){
			$name = $_GET['name'];
          	 $string = explode("-", $name);
           	 $string2 = implode(" ", $string);
			 getFbLike($string2);
  		}
		?>
        <!-- plugins och jquery -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script src="/includes/lightbox/lightbox-2.6.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="/includes/responsiveslides.min.js"></script>
        <!-- Syntaxhighlighter -->
        <script type="text/javascript" src="/scripts/shCore.js"></script>
        <script type="text/javascript" src="/scripts/shBrushJScript.js"></script>
        <script type="text/javascript" src="/scripts/shBrushCpp.js"></script>
        <script type="text/javascript" src="/scripts/shBrushCss.js"></script>
        <script type="text/javascript" src="/scripts/shBrushJava.js"></script>
        <script type="text/javascript" src="/scripts/shBrushPhp.js"></script>
        <script type="text/javascript" src="/scripts/shBrushSql.js"></script>
        <script type="text/javascript" src="/scripts/shBrushXml.js"></script>
	<script type="text/javascript" src='/scripts/main.js'></script>
	<script type="text/javascript" src='https://w.soundcloud.com/player/api.js'></script>

        
        <script type="text/javascript">SyntaxHighlighter.all();</script>
        <script>
          $(function() {
            $(".rslides").responsiveSlides({
                  auto: true,             /* Boolean: Animate automatically, true or false*/
                  speed: 500,            /* Integer: Speed of the transition, in milliseconds*/
                  timeout: 4000,          /*  Integer: Time between slide transitions, in milliseconds*/
                  pager: false,           /*  Boolean: Show pager, true or false*/
                  nav: true,             /*  Boolean: Show navigation, true or false*/
                  random: false,          /* Boolean: Randomize the order of the slides, true or false*/
                  pause: false,           /*  Boolean: Pause on hover, true or false*/
                  pauseControls: true,    /*  Boolean: Pause when hovering controls, true or false*/
                  prevText: "Previous",   /*  String: Text for the "previous" button*/
                  nextText: "Next",       /*  String: Text for the "next" button*/
                  maxwidth: "",           /*  Integer: Max-width of the slideshow, in pixels*/
                  navContainer: "",       /*  Selector: Where controls should be appended to, default is after the 'ul'*/
                  manualControls: "",     /*  Selector: Declare custom pager navigation*/
                  namespace: "rslides",   /*  String: Change the default namespace used*/
                  before: function(){},   /*  Function: Before callback*/
                  after: function(){}     /*  Function: After callback*/
                });
          });
        </script>
        <script>
            $(document).ready(function(){
                $("#menu_click").click(function(){
                $(".slidemenu").slideToggle("slow");
                });
            });
        </script>
        
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-45669914-4', 'dogetunes.Dogetunes.se');
	    ga('require', 'displayfeatures');
            ga('send', 'pageview');

        </script>
	<script type="text/javascript" src='https://w.soundcloud.com/player/api.js'></script>
	<script>
	$(document).ready(function(){
    var widgetIframe = document.getElementById('sc-widget'),
        widget       = SC.Widget(widgetIframe);

    widget.bind(SC.Widget.Events.READY, function() {
      widget.bind(SC.Widget.Events.PLAY, function() {
        // get information about currently playing sound
        widget.getCurrentSound(function(currentSound) {
          console.debug('sound ' + currentSound.get('') + 'began to play');
        });
      });
      // get current level of volume
      widget.getVolume(function(volume) {
        console.debug('current volume value is ' + volume);
      });
      // set new volume level
      widget.setVolume(10);
      console.debug('Set Volume to: ' + volume);
      // get the value of the current position
    });

  }());
	</script>
	
	
    </head>
    <body>
	<div id="fb-root"></div>
      <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/sv_SE/all.js#xfbml=1";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
</script>

        <header>
            <section id="hwrapp">
                <section class="logo">
                    <a href="/"><img src="/images/Dtuneslogo.png" alt="Dogetunes"></a>
                </section>
                <nav>
                    <section id="cssmenu">
                        <ul>
                            <li <?php if($_GET['p']){echo "";}else{echo "class='active'";} ?>><?php if($_GET['p']){echo "<a href='/'><span>Home</span></a>";}else{echo "<p><span>Home</span></p>";} ?></li>
                            <li <?php if($_GET['p'] == "categories"){echo "class='active'";}else{echo "";} ?>><?php if($_GET['p'] == "categories"){echo "<p><span>Music</span></p>";}else{echo "<a href='/p/categories'><span>Music</span></a>";} ?></li>
							<li <?php if($_GET['p'] == "about"){echo "class='active'";}else{echo "";} ?>><?php if($_GET['p'] == "about"){echo "<p><span>About</span></p>";}else{echo "<a href='/p/about'><span>About</span></a>";} ?></li>
							<li <?php if($_GET['p'] == "getadded"){echo "class='active'";}else{echo "";} ?>><?php if($_GET['p'] == "getadded"){echo "<p><span>Get Added!</span></p>";}else{echo "<a href='/p/getadded'><span>Get Added!</span></a>";} ?></li>
							<li <?php if($_GET['p'] == "costs"){echo "class='active'";}else{echo "";} ?>><?php if($_GET['p'] == "costs"){echo "<p><span>Costs</span></p>";}else{echo "<a href='/p/costs'><span>Costs</span></a>";} ?></li>
							
						</ul>
                    </section>
                </nav>
                <section id="searchbar">
                    <img src="/images/search.png" alt="Search..." class="sok" style="float: left">
                    <form method="get" role="search" action="/">
                        <input type="hidden" name="p" value="search">
                        <input type="text" placeholder="Search..." name="q">
                    </form>
                </section>
            </section>
        </header>
        <section id="mobileheader">
            <section class="logo">
                    <a href="/"><img src="/images/Dtuneslogo.png" alt="Dogetunes"></a>
            </section>
            <section class="menu_button">
                <img id="menu_click" src="/images/menu.png" alt="Meny">
            </section>
        </section>
        <section id="content">
            <section class="slidemenu">
                <?php include ('includes/slidemenu.php'); ?>
            </section>
            <?php if(!$_GET['p']){ ?>
            
				<div class="banner">
                	<a href="#"><div class="rslides1_nav prev"></div></a>
                	<a href="#"><div class="rslides1_nav next"></div></a>
                	<ul class="rslides">
						<li><a href="/"><img src="/images/dogetunes_banner.png" alt="Dogetunes"></a></li>
                  		<li><a href="/artists/Analogue/Runaway-Saints"><img src="/images/runawaysaints_frontpage.jpg" alt="Runaway Saints"></a></li>
						<li><a href="/p/costs"><img src="/images/slideimage.jpg" alt="GET FEATURED"></a></li>
                  	</ul>
            	</div>
            
            	<section id="social">
                	<div class="iconbox">
                    	<a href="https://www.twitter.com/officialdtunes"><img src="/images/twitter.png" alt="twitter"></a>
                    	<a href="https://www.facebook.com/dogetunes"><img src="/images/facebook.png" alt="facebook"></a>
                    	<a href="/feeds/"><img src="/images/rss.png" alt="Rss"></a>
                	</div>
            	</section>
		
            <?php }else{ ?>
                <div class="iconbox">
                    <a href="https://www.twitter.com/officialdtunes"><img src="/images/twitter.png" alt="twitter"></a>
                    <a href="https://www.facebook.com/dogetunes"><img src="/images/facebook.png" alt="facebook"></a>
		    <a href="/feeds/"><img src="/images/rss.png" alt="Rss"></a>
		</div>
            <?php } ?>
	    
            <section id='contentwrapp'>
			<!--a href="http://www.kinguin.net/?r=4613&bannerid=7" target="_blank" style="text-decoration: none;">
				<img src="http://www.kinguin.net/affiliateplus/banner.php?id=7&account_id=4613&store_id=1" alt="Kinguin - Always the best deal - Banner 728x90" title="Kinguin - Always the best deal - Banner 728x90" width="98%"  />
			</a-->
                <?php 
                if(!$_GET['p']){
					echo "</br><h1>Latest Artists</h1><section id='tiles'>";
                    getLatestTutorials();
					echo "</section>";
					getRandomArtist();
					echo "<h1><a href='/p/newslist'>News</a></h1><section id='tiles'>";
                    getLatestNews();
					echo "</section>";
                }
                elseif($_GET['p'] == "categories"){
					echo "<h1>Categories</h1><section id='tiles'>";
                    getCat();
					echo "</section>";
                }

                elseif($_GET['p'] == "news"){
                	$name = $_GET['name'];
                	$string = explode("-", $name);
                	$string2 = implode(" ", $string);
	                getNewsByName($string2);
	                echo "</section>";
                }
                elseif($_GET['p'] == "cat"){
                    $name = ucfirst($_GET['name']);
		    echo '<h1>'; echo $name; echo ' Artists</h1>'; echo '<div class="sellercheckbox"><label class="selllabel">Sellers only</label></div><br><section id="tiles">';
                    getTyt($_GET['name']);
		    echo "</section>";
                }
                elseif($_GET['p'] == "tag"){
                $string = explode("-", $_GET['name']);
                $string2 = implode(" ", $string);
  				echo "<h1>Artists with the tag $string2</h1><section id='tiles'>";
                    getTytTags($string2);
                echo "</section>";
                }
                elseif($_GET['p'] == "artists"){
                $name = $_GET['name'];
                $string = explode("-", $name);
                $string2 = implode(" ", $string);
                echo "<section id='tiles'>";
                    getTytByName($string2);
                echo "</section>";
                }
                elseif($_GET['p'] == "search"){
                    $query =  $_GET['q'];
                    $string = explode("+", $query);
                    $string2 = implode(" ", $string);
                    $stringen = mysql_real_escape_string(htmlspecialchars(trim($string2)));
                    if($query){
                        search($stringen);
                    }else{
                        echo "<script>window.location.assign('/p/search_error')</script>";
                    }
                }
				elseif($_GET['p'] == "profile"){
                    getProfile($_GET['name']);
                }
                elseif($_GET['p'] == "mail"){
                    echo "<h1>Your email was successfully sent to us! Thanks!</h1>
                    <p>We will contact you as fast as we can!</p>";
                }
                elseif($_GET['p'] == "mailerror"){
                    echo "<h1>Error! We could not send your email!</h1>
                    <p>Go back and control read all fields</p>";
                }
                elseif($_GET['p'] == "search_error"){
                    echo "<h1>Error on search</h1>
                    <p>Please write a search term when searching.</p>";
                }
				elseif($_GET['p'] == "getadded"){
                    include ("includes/getadded.php");
                }
				elseif($_GET['p'] == "costs"){
                    include ("includes/costs.php");
				}
				elseif($_GET['p'] == "success"){
					session_start();
					$file_name = $_SESSION['filename'];
                    echo "<h1 class='dogesans'>Much Success!</h1>
                    <p>Thank you for supporting the Ðogecoin economy!</p>
					<p>If you have purchased music, the artist will manually send the music to you as soon as possible!</p>
					<p>If you have tipped an artist, thank you for your support!</p>";
					//echo $file_name;
                }
				elseif($_GET['p'] == "newslist"){
                	echo "<h1>News</h1><section id='tiles'>";
                    getNews();
					echo "</section>";
                }
                ?>
            </section>
            <?php
            if($_GET['p'] == "about") {
                getom();
            }
            
            ?>
        </section>
	<?php /*<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Responsive -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-7710914564954808"
     data-ad-slot="9308771379"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>*/?>
<script src='scripts/main.js'></script>

<script type="text/javascript" src='https://w.soundcloud.com/player/api.js'></script>
	<script>
	$(document).ready(function(){
    var widgetIframe = document.getElementById('sc-widget'),
        widget       = SC.Widget(widgetIframe);

    widget.bind(SC.Widget.Events.READY, function() {
      widget.bind(SC.Widget.Events.PLAY, function() {
        // get information about currently playing sound
	widget.setVolume(40);
        widget.getCurrentSound(function(currentSound) {
          console.debug('sound ' + currentSound.get('') + 'began to play');
        });
      });
      // get current level of volume
      widget.getVolume(function(volume) {
        console.debug('current volume value is ' + volume);
      });
      // set new volume level
      widget.setVolume(10);
      console.debug('Set Volume to: ' + volume);
      // get the value of the current position
      
    });
widget.bind(SC.Widget.Events.PLAY_PROGRESS, function() {
	});
  }());
	
	</script>

	
        <?php
	
        if($_GET['p'] == "news" || $_GET['p'] == "cat" || $_GET['p'] == "artists"){
            echo '<div id="disqus_box">';
            include ("includes/disqus.php");
            echo '</div>';
        }
            include ("includes/footer.php");
        ?>
    </body>
    
</html>