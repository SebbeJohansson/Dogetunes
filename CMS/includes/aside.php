<section id="logobox">
			<a href="/CMS/?page=profile"><img class="profilpic" src="../images/<?php echo $admin['profilepic']; ?>" alt="profil bild"></a>
			<a href="/CMS/?page=profile"><p><?php echo $admin['username']; ?></p></a>
		</section>
		
		<section class="separator">
		<h3>Content</h3>
		</section>
		<section class="menu">
		<a href="/CMS/">
		<?php if($_GET['id'] == true || $_GET['page'] == true){echo "<div class='Lista'>";}else{echo "<div class='Act'>";} ?>
			<img class='Bild' src='images/Home.png' alt="home icon">
			<div class='Textbox'><?php if($_GET['id'] == true || $_GET['page'] == true){echo "<h4 class='Text'>Home</h4>";}else{echo "<h4 class='active'>Home</h4>";} ?></div>
		</div>
		</a>
		<a href="/CMS/?page=news">
		<?php if($_GET['page'] == "news"){echo "<div class='Act'>";}else{echo "<div class='Lista'>";} ?>
			<img class='Bild' src='images/News.png' alt="news icon">
			<div class='Textbox'><?php if($_GET['page'] == "news"){echo "<h4 class='active'>News</h4>";}else{echo "<h4 class='Text'>News</h4>";} ?></div>
		</div>
		</a>
		<a href="/CMS/?page=artists">
		<?php if($_GET['page'] == "artists" || $_GET['page'] == "artistList"){echo "<div class='Act'>";}else{echo "<div class='Lista'>";} ?>
			<img class='Bild' src='images/artisticon.png' alt="artist icon">
			<div class='Textbox'><?php if($_GET['page'] == "artists" || $_GET['page'] == "artistList"){echo "<h4 class='active'>Artists</h4>";}else{echo "<h4 class='Text'>Artists</h4>";} ?></div>
		</div>
		</a>
		<a href="/CMS/?page=cats">
		<?php if($_GET['page'] == "cats"){echo "<div class='Act'>";}else{echo "<div class='Lista'>";} ?>
			<img class='Bild' src='images/Category.png' alt="cat icon">
			<div class='Textbox'><?php if($_GET['page'] == "cats"){echo "<h4 class='active'>Categories</h4>";}else{echo "<h4 class='Text'>Categories</h4>";} ?></div>
		</div>
		</a>
		<a href="/CMS/?page=documents">
		<?php if($_GET['page'] == "documents"){echo "<div class='Act'>";}else{echo "<div class='Lista'>";} ?>
			<img class='Bild' src='images/document.png' alt="doc icon">
			<div class='Textbox'><?php if($_GET['page'] == "documents"){echo "<h4 class='active'>Documents</h4>";}else{echo "<h4 class='Text'>Documents</h4>";} ?></div>
		</div>
		</a>
		
		</section>

    	<section class="separator">
		<h3>System</h3>
		</section>
		<section class="menu">
		<!--a href="/CMS/?page=kodmall">
		<!--?php if($_GET['page'] == "kodmall"){echo "<div class='Act'>";}else{echo "<div class='Lista'>";} ?>
			<img class='Bild' src='images/Html.png' alt="kod icon">
			<div class='Textbox'><!--?php if($_GET['page'] == "kodmall"){echo "<h4 class='active'>Filer</h4>";}else{echo "<h4 class='Text'>Filer</h4>";} ?></div>
		</div>
		</a-->
		<a href="/CMS/?page=images">
		<?php if($_GET['page'] == "images"){echo "<div class='Act'>";}else{echo "<div class='Lista'>";} ?>
			<img class='Bild' src='images/images.png' alt="images icon">
			<div class='Textbox'><?php if($_GET['page'] == "images"){echo "<h4 class='active'>Images</h4>";}else{echo "<h4 class='Text'>Images</h4>";} ?></div>
		</div>
		</a>
		<!--<a href="/CMS/?page=backup">
		<div class='Lista'>
			<img class='Bild' src='images/Backup.png' alt="backup icon">
			<div class='Textbox'><?php /*if($_GET['page'] == "backup"){echo "<h4 class='active'>Backup</h4>";}else{echo "<h4 class='Text'>Backup</h4>";}*/ ?></div>
		</div>
		</a>-->
		<a href="/CMS/?page=users">
		<?php if($_GET['page'] == "users"){echo "<div class='Act'>";}else{echo "<div class='Lista'>";} ?>
			<img class='Bild' src='images/Users.png' alt="users icon">
			<div class='Textbox'><?php if($_GET['page'] == "users"){echo "<h4 class='active'>Users</h4>";}else{echo "<h4 class='Text'>Users</h4>";} ?></div>
		</div>
		</a>
		</section>