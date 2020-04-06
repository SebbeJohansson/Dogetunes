 <html lang="sv">
    <head>
        <title>Tytos.se</title>
        <meta charset="utf-8">
        <!--[if IE]>
            <link rel="stylesheet" type="text/css" href="style-ie.css"/>
        <![endif]-->
        <link rel="stylesheet" type="text/css" href="http://tytos.se/css/style.css"/>
        <link rel="stylesheet" type="text/css" href="http://tytos.se/css/slide.css"/>
        <link rel="stylesheet" type="text/css" href="http://tytos.se/css/lightbox.css"/>
        
        <meta name="HandheldFriendly" content="True">
        <meta name="MobileOptimized" content="320">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1"> 
        <link rel="shortcut icon" href="http://tytos.se/images/shortcut.png">
        <link rel="apple-touch-icon-precomposed" href="http://tytos.se/images/appicon.png"> 

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script src="http://tytos.se/includes/lightbox/lightbox-2.6.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="http://tytos.se/includes/responsiveslides.min.js"></script>
        <script>
          $(function() {
            $(".rslides").responsiveSlides({
                  auto: true,             // Boolean: Animate automatically, true or false
                  speed: 500,            // Integer: Speed of the transition, in milliseconds
                  timeout: 4000,          // Integer: Time between slide transitions, in milliseconds
                  pager: true,           // Boolean: Show pager, true or false
                  nav: false,             // Boolean: Show navigation, true or false
                  random: false,          // Boolean: Randomize the order of the slides, true or false
                  pause: false,           // Boolean: Pause on hover, true or false
                  pauseControls: true,    // Boolean: Pause when hovering controls, true or false
                  prevText: "Previous",   // String: Text for the "previous" button
                  nextText: "Next",       // String: Text for the "next" button
                  maxwidth: "",           // Integer: Max-width of the slideshow, in pixels
                  navContainer: "",       // Selector: Where controls should be appended to, default is after the 'ul'
                  manualControls: "",     // Selector: Declare custom pager navigation
                  namespace: "rslides",   // String: Change the default namespace used
                  before: function(){},   // Function: Before callback
                  after: function(){}     // Function: After callback
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

            ga('create', 'UA-45669914-1', 'tytos.se');
            ga('send', 'pageview');

        </script>
        
    </head>
    <body>
        <header>
            <section id="hwrapp">
                <section class="logo">
                    <a href="/"><img src="http://tytos.se/images/tytos.png" alt="Tytos"></a>
                </section>
                <nav>
                    <section id="cssmenu">
                        <ul>
                            <li <?php if($_GET['p']){echo "";}else{echo "class='active'";} ?>><?php if($_GET['p']){echo "<a href='/'><span>Start</span></a>";}else{echo "<p><span>Start</span></p>";} ?></li>
                            <li <?php if($_GET['p'] == "om"){echo "class='active'";}else{echo "";} ?>><?php if($_GET['p'] == "om"){echo "<p><span>Om</span></p>";}else{echo "<a href='/p/om'><span>Om</span></a>";} ?></li>
                            <li <?php if($_GET['p'] == "kategorier"){echo "class='active'";}else{echo "";} ?>><?php if($_GET['p'] == "kategorier"){echo "<p><span>Kategorier</span></p>";}else{echo "<a href='/p/kategorier'><span>Kategorier</span></a>";} ?></li>
                        </ul>
                    </section>
                </nav>
                <section id="searchbar">
                    <img src="http://cdn1.cdnme.se/956187/7-3/search_5203b6cfe087c337304ef09c.png" class="sok" style="float: left">
                    <form method="get" role="search" action="/">
                        <input type="hidden" name="p" value="search">
                        <input type="text" placeholder="Sök..." name="q">
                    </form>
                </section>
            </section>
        </header>
        <section id="mobileheader">
            <section class="logo">
                    <a href="/"><img src="http://tytos.se/images/tytos.png" alt="Tytos"></a>
            </section>
            <section class="menu_button">
                <img id="menu_click" src="http://tytos.se/images/menu.png">
            </section>
        </section>
        <section id="content">
            <section class="slidemenu">
                <?php include ('includes/slidemenu.php'); ?>
            </section>
            <section id='contentwrapp'>
				<section class="error">
                        <h1 class="errorh1">Du har inte behörighet till "tytos.se<?php echo $_SERVER['REQUEST_URI'] ?>"<br>(ERROR 403)</h1>
                    <h4 class="errorh4">Tyvärr fungerade inte den länk du försökte gå till. 
                    Sidan du letar efter kan ha flyttats, ändrat sin adress eller av någon
                    annan anledning inte nås för tillfället.
                    </h4>
                    <br><a href="javascript:history.go(-1);"><p style="margin: 0; padding: 0; text-align: center"> < Till föregående sida</p></a
                 </section>
            </section>
   
    </body>
</html>