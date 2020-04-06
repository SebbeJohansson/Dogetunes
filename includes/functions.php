<?php

include ("connection.php");
/*--------------------------------------------------------------------------------*/

function slug($z){
    $z = strtolower($z);
    $z = preg_replace('/[^a-z0-9 -]+/', '', $z);
    $z = str_replace(' ', '-', $z);
    return trim($z, '-');
}

function getNews(){
	$query = mysql_query("SELECT * FROM news WHERE status = 1 ORDER BY orderID DESC");
	$num = mysql_num_rows($query); 
    if($num == 0){
        echo "<p>There are no news yet!</p>";
    }
	while($result = mysql_fetch_array($query)){
		$pretext = strip_tags(substr($result['content'], 0, 20));
		$titel = ucfirst($result['titel']);
		$string = explode(" ", $result['titel']);
        $string2 = implode("-", $string);

		echo "<a href='/news/$string2'><div class='tileC'>
            <h3>$titel</h3>
            <div class='bildbox'>
                <img src='../images/{$result['tilePic']}' alt='{$result['titel']}'>
            </div>
          </div></a>";
	}
}
function getLatestNews(){
	$query = mysql_query("SELECT * FROM news WHERE status = 1 ORDER BY orderID DESC LIMIT 3");
	$num = mysql_num_rows($query); 
    if($num == 0){
        echo "<p>There are no news yet!</p>";
    }
	while($result = mysql_fetch_array($query)){
		$pretext = strip_tags(substr($result['content'], 0, 20));
		$titel = ucfirst($result['titel']);
		$string = explode(" ", $result['titel']);
        $string2 = implode("-", $string);

		echo "<a href='/news/$string2'><div class='tileC'>
            <h3>$titel</h3>
            <div class='bildbox'>
                <img src='../images/{$result['tilePic']}' alt='{$result['titel']}'>
            </div>
          </div></a>";
	}
	echo "<a href='/p/newslist'><div class='tileC'>
            <h3>Show More</h3>
            <div class='bildbox'>
                <img src='/images/ShowMore.png' alt='Show More'>
            </div>
          </div></a>";
}
function getLatestTutorials(){
	$query = mysql_query("SELECT * FROM artists WHERE status = 1 ORDER BY id DESC LIMIT 4");

	$num = mysql_num_rows($query);
    if($num == 0){
        echo "<p>There are no artists!</p>";
    }
	while($result = mysql_fetch_array($query)){
		$titel = ucfirst($result['titel']);
		$string = explode(" ", $result['titel']);
        $string2 = implode("-", $string);

		echo "<a href='/artists/{$result['cat_name']}/$string2'><div class='tileC'>
                <h3>$titel</h3>
                <div class='bildbox'>
                    <img src='../images/{$result['tilePic']}' alt='{$result['titel']}'>
                </div>
            </div></a>";
	}
  
}
function getNewsByName($titel){
	$query = mysql_query("SELECT * FROM news WHERE titel = '$titel'");
	$result = mysql_fetch_array($query);
    $name = explode(" ", $result['author']);
    $name2 = implode("-", $name);
	echo "<div id='rightbox'><img src='../images/{$result['tilePic']}' alt='{$result['titel']}'></div>";
	echo "<div id='leftbox'><h1>{$result['titel']}</h1>";
	echo "<h5>Published: {$result['date']} - by <a href='../profile/$name2'>{$result['author']}</a></h5>";
	echo "<p>{$result['content']}</p></div>";
}
function getCat(){
	$query = mysql_query("SELECT * FROM cats ORDER BY id");
	$num = mysql_num_rows($query); 
    if($num == 0){
        echo "<p>There are no categories!</p>";
    }
	while($result = mysql_fetch_array($query)){
		$name = ucfirst($result['name']);
		echo "<a href='/categories/{$result['name']}'><div class='tileC'>
                <h3 style='height: auto;'>$name</h3>
                <div class='bildbox'>
                    <img src='../images/{$result['icon']}' alt='{$result['name']}'>
                </div>
            </div></a>";
	}
}
function getMenuCat(){
	$query = mysql_query("SELECT * FROM cats ORDER BY id");
	$num = mysql_num_rows($query); 
    if($num == 0){
        echo "<p>There are no categories!</p>";
    }
	while($result = mysql_fetch_array($query)){
		$name = ucfirst($result['name']);
		echo "<li><a href='/categories/{$result['name']}'>{$result['name']}</a></li>";
	}
}

function getRandomArtist(){
	
	$soundcloud = 0;
	$url = slug($title);
	
	while ($soundcloud == 0){
		$randomid = rand(0, 200);
		$query = mysql_query("SELECT * FROM artists WHERE id = '$randomid'");
		$result = mysql_fetch_array($query);
		if($result['soundcloudid'] != ""){
			$soundcloud = 1;
		}
	}
	$titel = ucfirst($result['titel']);
  	$string = explode(" ", $result['titel']);
    $string2 = implode("-", $string);
	
	echo "<h1 class='dogesans'>Such Artist, Much Wow - <a href='artists/{$result['cat_name']}/{$string2}'><span style='color: black;'>{$titel}</span></a></h1>";
	if($result['soundcloudid'] != ""){
		echo '<iframe id="sc-widget" style="margin-bottom: 70px;" width="100%" height="250" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//soundcloud.com/'; echo "{$result['soundcloudid']}"; echo '&amp;auto_play=false&amp;hide_related=false&amp;visual=true"></iframe>';
	}
}















function getTyt($cat){
	$query = mysql_query("SELECT * FROM artists WHERE cat_name = '$cat' AND status = 1 ORDER BY -orderID DESC");

	$num = mysql_num_rows($query);
    if($num == 0){
        echo "<p>There are no artists in this category.</p>";
    }
	
	while($result = mysql_fetch_array($query)){
		$pretext = strip_tags(substr($result['description'], 0, 20));
		$titel = ucfirst($result['titel']);
		$string = explode(" ", $result['titel']);
		$string2 = implode("-", $string);
		if($result['merchant']){
		    $result['selling'] = 1;
		}
		echo "<a href='/artists/{$result['cat_name']}/$string2'><div class='";
		if($result['selling']==0){echo "notselling";};
		echo " tileC'><h3>$titel</h3>";
		
		if($result['selling']){
			echo "<h2 style='float: right; color: #e3c06d; margin: 0px; width: 0;text-indent: -25%;margin-top: -3px;font-size: 18px;'>Selling</h2>";
		}
		echo "<div class='bildbox'>
                    <img src='../images/{$result['tilePic']}' alt='{$result['titel']}'>
                </div>
            </div></a>";
	}
}
function getTytTags($name){

    $query = mysql_query("SELECT * FROM artists WHERE (tags LIKE '%$name%')");
    $num = mysql_num_rows($query); 
    if($num === 0){
        echo "<div style='width: 100%; margin: 30px 0; float: left;'><h1>$name</h1>";
        echo "<p>There are no artists with the tag \"$name\"</p>";
    }else{
        if($num === 1){
            echo "<p>There are $num artists with the tag \"$name\"</p>";
        }
        elseif($num > 1){
            echo "<p>There are $num artists with the tag \"$name\"</p>";
        }
        while($result = mysql_fetch_array($query)){
        $string = explode(" ", $result['titel']);
        $string2 = implode("-", $string);
        if($result['status'] == 1){
        echo "<a href='/artists/{$result['cat_name']}/$string2'><div class='tileC'>
                <h3>{$result['titel']}</h3>
                <div style='border-radius: 0 0 5px 5px;' class='bildbox'>
                    <img src='../images/{$result['tilePic']}' alt='{$result['titel']}'>
                </div>
            </div></a></div>";
        }
    }
}
}
function getDescCat($cat){
	$query = mysql_query("SELECT * FROM cats WHERE name = '$cat'");
	$result = mysql_fetch_array($query);
	extract($result);
		echo "<section id='Desccat'><section class='tilesholder'><h1 style='color: #fff;'>About the artist</h1>";
		echo "<p style='color: #fff;'>$description</p></section></section>";
}
function getFbLike($name){
  	$query = mysql_query("SELECT * FROM artists WHERE titel = '$name'");
	$result = mysql_fetch_array($query);
  	echo "
  	<meta name='description' content='{$result['description']}' />
    <meta property='og:title' content='{$result['titel']}' />
    <meta property='og:site_name' content='Tytos' />
    <meta property='og:image' content='../images/{$result['tilePic']}' />
    <meta property='og:type' content='Article' />";
}
function getTytByName($titel){
	$query = mysql_query("SELECT * FROM artists WHERE titel = '$titel'");
	$result = mysql_fetch_array($query);
	$titel = ucfirst($result['titel']);
  	$string = explode(" ", $result['titel']);
    $string2 = implode("-", $string);
    $name = explode(" ", $result['author']);
    $name2 = implode("-", $name);
    $string = explode(",", $result['tags']);
	
	echo "<div id='right'><h1>Information</h1>
		  <p><b>Category: </b><a href='http://dogetunes.net/categories/{$_GET['cat']}'>{$_GET['cat']}</a></p><p><b>Links:</b><br>{$result['content']}</p><p><b>Donations:</b><br><img style='width: 200px' src='{$result['qrcode']}'/></p><p><b>Tags:</b><br>";
	if($result['tags']){
        foreach ($string as $value) {
            $value = trim($value);
            $string = explode(" ", $value);
            $string2 = implode("-", $string);
            echo "<a class='tag' href='/tag/$string2'>$value</a>";
        }
    }else{
        echo "<p>The artist is not yet tagged.</p>";
    }
	echo "</p></div>";
	echo "<div id='left'><h1>{$titel}</h1>";
	/*echo "<h5>Added: {$result['date']} - by <a href='../profile/$name2'>{$result['author']}</a></h5>";*/
	echo "<div class='fb-like' data-href='../tutorials/{$result['cat_name']}/$string2' data-layout='button_count' data-action='like' data-show-faces='true' data-share='true'></div>";
	if($result['soundcloudid'] != ""){
		echo '<iframe id="sc-widget" width="100%" height="450" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https://soundcloud.com/'; echo "{$result['soundcloudid']}"; echo '&amp;auto_play=true&amp;hide_related=false&amp;visual=true"></iframe>';
	}
	
	if ($result['merchant'] != ""){
	echo '<p>
	
	
<form action="https://www.coinpayments.net/index.php" method="post">
 <input type="hidden" name="cmd" value="_donate">
 <input type="hidden" name="reset" value="1">
 <input type="hidden" name="merchant" value="';
	echo "{$result['merchant']}";
	echo '">
 <input type="hidden" name="item_name" value="Donate to ';
	echo "{$result['titel']}";
	echo '">
 <input type="hidden" name="currency" value="DOGE">
 <input type="hidden" name="amountf" value="100.00000000">
 <input type="hidden" name="allow_amount" value="1">
 <input type="hidden" name="want_shipping" value="0">
 <input type="hidden" name="success_url" value="http://dogetunes.net/p/success">
 <input type="hidden" name="cancel_url" value="javascript:history.go(-1)">
 <input type="hidden" name="allow_extra" value="0">
 <input type="image" src="https://www.coinpayments.net/images/pub/donate-med-grey.png" alt="Donate with CoinPayments.net">
</form>
<h2 class="buynow">Buy NOW:</h2>
<div class="infowrapper"><h3>Price - Ð'; echo "{$result['sellamount']} </h3>";echo '
<h3>Info - '; echo "{$result['item_name']} </h3></div>";echo '
<form action="https://www.coinpayments.net/index.php" method="post">
 <input type="hidden" name="cmd" value="_pay">
 <input type="hidden" name="reset" value="1">
 <input type="hidden" name="merchant" value="';
	echo "{$result['merchant']}";
	echo '">
 <input type="hidden" name="item_name" value="';
	echo "{$result['item_name']}";
	echo '">
 <input type="hidden" name="currency" value="DOGE">
 <input type="hidden" name="amountf" value="';
	echo "{$result['sellamount']}";
	session_start();
	$file_name="google.se";
	$_SESSION['filename'] = $file_name;
	echo '">
 <input type="hidden" name="quantity" value="1">
 <input type="hidden" name="allow_quantity" value="0">
 <input type="hidden" name="want_shipping" value="0">
 <input type="hidden" name="success_url" value="http://dogetunes.net/p/success">
 <input type="hidden" name="cancel_url" value="javascript:history.go(-1)">
 <input type="hidden" name="allow_extra" value="0">
 <input type="image" src="https://www.coinpayments.net/images/pub/buynow-med-grey.png" alt="Buy Now with CoinPayments.net">
</form>
	</p></div>
	
	';
	}
	if($result['extra']){
		echo "<section>".$result['extra']."</section>";
	}
}

function getDoc($cat){
	$sql = mysql_query("SELECT * FROM documents WHERE cat = '$cat'");
    $num = mysql_num_rows($sql);
    if($num == 0){
        echo "<tr><td colspan='3'>Inget kursmaterial har laddats upp</td></tr>";
    }
    while($row = mysql_fetch_array($sql)){
        echo "<tr><td><a href='../includes/download.php?file=". $row['link']."'>{$row['link']}</a></td><td>{$row['counter']}</td></tr>";
    }
    if(!$num == 0){
    echo "<tr><td>".'<b>'.'Numbers of documents: '.'</b>'.$num."</td><td></td></tr>";
    }
}
function getContact($id){
	$query = mysql_query("SELECT * FROM users WHERE id = '$id'");
	return mysql_fetch_array($query);
}
function getom(){
	$query = mysql_query("SELECT * FROM about");
	while($result = mysql_fetch_array($query)){
        $bg = ($bg == '#F9F8F8') ? '#F2F2F2' : '#F9F8F8';
		echo "<section class='kontakt' style='background-color:$bg'><div class='Kontakt_content'><h1 style='margin: 0;'>{$result['titel']}</h1>";
		echo "<p style='color:grey;'>{$result['text']}</p></div></section>";
	}

}
function getProfile($name){
    $namn = explode("-", $name);
    $namn2 = implode(" ", $namn);
    $query = mysql_query("SELECT * FROM users WHERE full_name = '$namn2'");
    extract(mysql_fetch_array($query));
    echo "<section id='profPic'></section>
        <section id='profInfo'></section>";
    echo "<div id='rightbox'><img src='../images/$profilepic' alt='$full_name'></div>";
    echo "<div id='leftbox'><h1>$full_name</h1>";
    echo "<h3>$email</h3>";
    echo "<p>$text</p>";
    echo "</div>";

}
function search($search){
	$query = mysql_query("SELECT * FROM artists WHERE (titel LIKE '%$search%') AND status = 1");
	$num = mysql_num_rows($query); 
    if($num === 0){
    	echo "<div style='width: 100%; margin: 30px 0; float: left;'><h1>Artists</h1>";
        echo "<p>There are no artists by the name of \"$search\"</p>";
    }else{
    	echo "<h1>Artists</h1>";
    	if($num === 1){
    		echo "<p>Your search \"$search\" gave $num hit</p>";
    	}
    	elseif($num > 1){
    		echo "<p>Your search \"$search\" gave $num hits</p>";
    	}
		while($result = mysql_fetch_array($query)){
		$pretext = strip_tags(substr($result['description'], 0, 20));
		$string = explode(" ", $result['titel']);
        $string2 = implode("-", $string);
        if($result['status'] == 1){
		echo "<a href='/artists/{$result['cat_name']}/$string2'><div class='tileC'>
                <h3>{$result['titel']}</h3>
                <div style='border-radius: 0 0 5px 5px;' class='bildbox'>
                    <img src='../images/{$result['tilePic']}' alt='{$result['titel']}'>
                </div>
            </div></a>";
        }
		}
		
	}
	echo "</div>";
	$query = mysql_query("SELECT * FROM news WHERE (titel LIKE '%$search%' OR content LIKE '%$search%') AND status = 1");
	$num = mysql_num_rows($query); 
    if($num === 0){
    	echo "<div style='width: 100%; margin: 30px 0; float: left;'><h1>News</h1>";
        echo "<p>There are no news by the name of \"$search\"</p>";
    }else{
    	echo "<h1>Nyheter</h1>";
		if($num === 1){
    		echo "<p>Your search \"$search\" gave $num hit</p>";
    	}
    	elseif($num > 1){
    		echo "<p>Your search \"$search\" gave $num hits</p>";
    	}while($result = mysql_fetch_array($query)){
		$pretext = strip_tags(substr($result['content'], 0, 20));
		$titel = ucfirst($result['titel']);
		$string = explode(" ", $titel);
		$string2 = implode("-", $string);
		echo "<a href='/nyheter/$string2'><div class='tileC'>
                <h3>$titel</h3>
                <div style='border-radius: 0 0 5px 5px;' class='bildbox'>
                    <img src='../images/{$result['tilePic']}' alt='$titel'>
                </div>
            </div></a>";
        }	
	}
	echo "</div>";
	$query = mysql_query("SELECT * FROM artists WHERE (tags LIKE '%$search%') AND status = 1");
	$num = mysql_num_rows($query);
	echo "<div style='width: 100%; margin: 30px 0; float: left;'>";
    if($num === 0){
    	
        echo "<p>There are no artists with the tag \"$search\"</p>";
    }else{
    	echo "<h1>Artists by tags</h1>";
    	if($num === 1){
    		echo "<p>Your search \"$search\" gave $num hit</p>";
    	}
    	elseif($num > 1){
    		echo "<p>Your search \"$search\" gave $num hits</p>";
    	}
		while($result = mysql_fetch_array($query)){
		$pretext = strip_tags(substr($result['description'], 0, 20));
		$string = explode(" ", $result['titel']);
        $string2 = implode("-", $string);
        if($result['status'] == 1){
		echo "<a href='/artists/{$result['cat_name']}/$string2'><div class='tileC'>
                <h3>{$result['titel']}</h3>
                <div style='border-radius: 0 0 5px 5px;' class='bildbox'>
                    <img src='../images/{$result['tilePic']}' alt='{$result['titel']}'>
                </div>
            </div></a>";
        }
		}
	}
	echo "</div>";
}

function getKeywords($name){
	$query = mysql_query("SELECT tags FROM artists WHERE titel = '$name'");
	return mysql_fetch_array($query);
}

?>