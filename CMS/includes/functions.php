<?php
include ('connection.php');

/*---------------------------------------------------------------------------*/

function getAdmin($username){
    $query = mysql_query("SELECT * FROM users WHERE username = '$username'");
    return mysql_fetch_array($query);
}
function getOm(){
    $query = mysql_query("SELECT id, titel, latestUpdate FROM about") or die (mysql_error());

    $num = mysql_num_rows($query);
    echo "<section id='hwrapp'><h3>$num about texts</h3><a href='createabout.php'><img src='images/add.png'></a></section>";
    
    while($result = mysql_fetch_assoc($query)){
    echo "<tr><td><a href=\"editabout.php?id=" . $result['id']. "\">{$result['titel']}</a></td><td>{$result['latestUpdate']}</td><td><span class='right'><a href=\"/CMS/?page=delete&g=om&id=" . $result['id'] . "\"><img style='width:25px; margin-right: 5px;' src='images/delete.png'></a></span></td></tr>";
    }
    
}
function getOMEdit($id){
    $query = mysql_query("SELECT * FROM about WHERE id = '$id'") or die (mysql_error());
    return mysql_fetch_assoc($query);
}
function createOm($titel, $text, $date){
    mysql_query("INSERT INTO about VALUES (null, '$titel', '$text', '$date')") or die (mysql_error());
    $query = mysql_query("SELECT id FROM about WHERE titel = '$titel'");
    $result = mysql_fetch_array($query);
    $id = $result['id'];
    header ("Location: /CMS/editabout.php?id=$id");
}
function EditOm($id, $titel, $text, $date){
    mysql_query("UPDATE about SET `titel` = '$titel', `text` = '$text', `latestUpdate` = '$date' WHERE id = '$id'") or die (mysql_error());
}
function getNewsEdit($id){
    $query = mysql_query("SELECT * FROM news WHERE id = '$id'") or die (mysql_error());
    return mysql_fetch_assoc($query);
}
function getNews($limit){
    if($limit){
        $query = mysql_query("SELECT id, titel, author, date, status FROM news ORDER BY id DESC LIMIT $limit") or die (mysql_error());
    	echo "<section id='hwrapp'><h3>Latest News</h3><a href='createnews.php'><img src='images/add.png'></a></section>";
    	$num = mysql_num_rows($query);
    }else{
        $query = mysql_query("SELECT id, titel, author, date, status, orderID FROM news ORDER BY orderID DESC") or die (mysql_error());
    	$num = mysql_num_rows($query);
    	echo "<section id='hwrapp'><h3>$num News</h3><a href='createnews.php'><img src='images/add.png'></a></section>";
    }
    $i=0;
    while($result = mysql_fetch_assoc($query)){
    $i++;
    if($result['status'] == '1'){
        $varde = "checked";
        $number= 1;
    }else{
        $varde = '';
        $number = 0;
    }
    if(!$limit){
        if($i == 1){
            echo "<tr><td><input class='{$result['id']}' id='box' name='box' type='checkbox' value='$number' $varde /><a href=\"editnews.php?id=" . $result['id']. "\">{$result['titel']}</a></td><td>{$result['date']}</td><td><span class='right'><a href=\"/CMS/?page=delete&g=news&id=" . $result['id'] . "\"><img style='width:25px;' src='images/delete.png'></a><img src='../images/ArrowDown.png' style='width:15px; margin: 5px;' title='Downwards' onClick=\"changeOrder('down',{$result['orderID']},{$result['id']})\"/></span></td></tr>";
        }elseif($result['orderID'] == 2){
            echo "<tr><td><input class='{$result['id']}' id='box' name='box' type='checkbox' value='$number' $varde /><a href=\"editnews.php?id=" . $result['id']. "\">{$result['titel']}</a></td><td>{$result['date']}</td><td><span class='right'><a href=\"/CMS/?page=delete&g=news&id=" . $result['id'] . "\"><img style='width:25px;' src='images/delete.png'></a><img src='../images/ArrowUP.png' style='width:15px; margin: 5px;' title='Upwards' onClick=\"changeOrder('up',{$result['orderID']},{$result['id']}) \"/></span></td></tr>";
        }else{
            echo "<tr><td><input class='{$result['id']}' id='box' name='box' type='checkbox' value='$number' $varde /><a href=\"editnews.php?id=" . $result['id']. "\">{$result['titel']}</a></td><td>{$result['date']}</td><td><span class='right'><a href=\"/CMS/?page=delete&g=news&id=" . $result['id'] . "\"><img style='width:25px;' src='images/delete.png'></a><img src='../images/ArrowUP.png' style='width:15px; margin: 5px 5px 5px 1px;' title='Upwards' onClick=\"changeOrder('up',{$result['orderID']},{$result['id']}) \"/><img src='../images/ArrowDown.png' style='width:15px; margin: 5px 1px 5px 5px;' title='Downwards' onClick=\"changeOrder('down',{$result['orderID']},{$result['id']})\"/></span></td></tr>";
        }
    }else{
        echo "<tr><td><input class='{$result['id']}' id='box' name='box' type='checkbox' value='$number' $varde /><a href=\"editnews.php?id=" . $result['id']. "\">{$result['titel']}</a></td><td>{$result['date']}</td><td><span class='right'><a href=\"/CMS/?page=delete&g=news&id=" . $result['id'] . "\"><img style='width:25px;' src='images/delete.png'></a></span></td></tr>";
    }

    }
  	if(!$limit){
    echo "<tr><td>".'<b>'.'Number of News: '.'</b>'.$num.'  stycken'."</td><td></td><td></td></tr>";
  	}
}
function editNews($id, $titel, $tilePicString, $tilePicOrg, $content, $author){

    if (empty($_FILES['tilePic']['name'])){

        if($tilePic == $tilePicOrg){
            mysql_query("UPDATE news SET titel = '$titel', content = '$content', author = '$author' WHERE id = '$id'") or die (mysql_error());
            header ("Location: /CMS/?page=news");
        }else{
            rename("../../images/$tilePicOrg", "../../images/$tilePicString");
            mysql_query("UPDATE news SET titel = '$titel', tilePic = '$tilePicString', content = '$content', author = '$author' WHERE id = '$id'") or die (mysql_error());
            header ("Location: /CMS/?page=news");
        }
        exit;
        }
        unlink($_SERVER["DOCUMENT_ROOT"] ."/images/" . $tilePicOrg);
        
        if (is_uploaded_file($_FILES['tilePic']['tmp_name'])){

            $path = "../../images/";
            if(file_exists($path . $tilePicOrg)){
                $i = 1;
                while(file_exists($path . "(" . $i . ")" . $tilePicOrg)){
                    $i++;
                }
                $Picname = ("(" . $i . ")" . $tilePicOrg);
            }else{
                $Picname = $tilePicString;
            }

        if (move_uploaded_file($_FILES['tilePic']['tmp_name'], '../../images/' . $Picname)){ 
        
        } else { 
        echo 'Imagge could not be moved';
        exit;
        }
        mysql_query("UPDATE news SET titel = '$titel', tilePic = '$Picname', content = '$content', author = '$author' WHERE id = '$id'") or die (mysql_error());
        header ("Location: /CMS/?page=news");
        } 
}
function addNews($titel, $content, $tilePic, $author, $date, $status){
    if(empty($_FILES['tilePic']['name'])){
        header ("Location: /CMS/?page=news");
        exit;
        }
        $explode = explode(".", $_FILES['tilePic']['name']);
        foreach ($explode as $exp);
        
        if ($exp == 'jpg' || $exp == 'JPG' || $exp == 'png' || $exp == 'PNG' || $exp = 'gif'|| $exp = 'GIF'){
        if (is_uploaded_file($_FILES['tilePic']['tmp_name'])){

        $path = "../../images/";
        if(file_exists($path . $_FILES['tilePic']['name'])){
            $i = 1;
            while(file_exists($path . "(" . $i . ")" . $_FILES['tilePic']['name'])){
                $i++;
            }
            $Picname = ("(" . $i . ")" . $_FILES['tilePic']['name']);
        }else{
            $Picname = $_FILES['tilePic']['name'];
        }
                
        if (move_uploaded_file($_FILES['tilePic']['tmp_name'], '../../images/' . $Picname)){ 
        
        } else { 
        echo 'Bilden kunde inte flyttas.';
        exit;
        } 
        }
        $res = mysql_query("SELECT orderID FROM news ORDER BY orderID DESC LIMIT 1");
        $result = mysql_fetch_array($res);
        $orderID = $result['orderID'] + 1;
        mysql_query("INSERT INTO news VALUES (null, '$titel', '$content', '$Picname', '$author', '$date', '$status', '$orderID')") or die (mysql_error());
        header ("Location: /CMS/?page=news");
        }
}
function getTyt($name, $limit){

    if($limit){
    	$query = mysql_query("SELECT id, titel, cat_name, date, status FROM artists ORDER BY orderID DESC LIMIT $limit") or die (mysql_error());
    	$num = mysql_num_rows($query);
        echo "<section id='hwrapp'><h3>Latest Artists</h3><a href='createartist.php'><img src='images/add.png'></a></section>";
    }else{
        $query = mysql_query("SELECT id, titel, cat_name, date, status, orderID FROM artists WHERE cat_name = '$name' ORDER BY orderID") or die (mysql_error());
    	$num = mysql_num_rows($query);
    	echo "<section id='hwrapp'><h3>$num $name artists</h3><a href='createartist.php?cat=$name'><img src='images/add.png'></a></section>";
        $sql = mysql_query("SELECT orderID FROM artists WHERE cat_name = '$name' ORDER BY orderID DESC ") or die (mysql_error());
        $res = mysql_fetch_assoc($sql);
    }

    $i=0;
    while($result = mysql_fetch_assoc($query)){
    $i++;
    if($result['status'] == '1'){
        $varde = "checked";
    }else{
        $varde = '';
    }

    if(!$limit){
        if($num > 1){
            if($i == 1){
                echo "<tr><td><input id='{$result['id']}' class='boxTut' name='box' type='checkbox' value='1' $varde /><a href=\"editartist.php?id=" . $result['id']. "\">{$i}) {$result['titel']}</a></td><td>{$result['date']}</td><td><span class='right'><a href=\"/CMS/?page=delete&g=artists&cat=" . $result['cat_name'] . "&id=" . $result['id'] . "\"><img style='width:25px; margin-right: 5px;' src='images/delete.png'></a><img src='../images/ArrowDown.png' style='width:15px; margin: 5px;' title='Downwards' onClick=\"changeTutOrder('down',{$result['orderID']},{$result['id']},'{$result['cat_name']}')\"/></span></td></tr>";
            }elseif($result['orderID'] == $res['orderID']){
                echo "<tr><td><input id='{$result['id']}' class='boxTut' name='box' type='checkbox' value='1' $varde /><a href=\"editartist.php?id=" . $result['id']. "\">{$i}) {$result['titel']}</a></td><td>{$result['date']}</td><td><span class='right'><a href=\"/CMS/?page=delete&g=artists&cat=" . $result['cat_name'] . "&id=" . $result['id'] . "\"><img style='width:25px; margin-right: 5px;' src='images/delete.png'></a><img src='../images/ArrowUP.png' style='width:15px; margin: 5px;' title='Upwards' onClick=\"changeTutOrder('up',{$result['orderID']},{$result['id']},'{$result['cat_name']}')\"/></span></td></tr>";
            }else{
                echo "<tr><td><input id='{$result['id']}' class='boxTut' name='box' type='checkbox' value='1' $varde /><a href=\"editartist.php?id=" . $result['id']. "\">{$i}) {$result['titel']}</a></td><td>{$result['date']}</td><td><span class='right'><a href=\"/CMS/?page=delete&g=artists&cat=" . $result['cat_name'] . "&id=" . $result['id'] . "\"><img style='width:25px; margin-right: 5px;' src='images/delete.png'></a><img src='../images/ArrowUP.png' style='width:15px; margin: 5px 5px 5px 1px;' title='Upwards' onClick=\"changeTutOrder('up',{$result['orderID']},{$result['id']},'{$result['cat_name']}')\"/><img src='../images/ArrowDown.png' style='width:15px; margin: 5px 1px 5px 5px;' title='Downwards' onClick=\"changeTutOrder('down',{$result['orderID']},{$result['id']},'{$result['cat_name']}')\"/></span></td></tr>";
            }
        }else{
            echo "<tr><td><input id='{$result['id']}' class='boxTut' name='box' type='checkbox' value='1' $varde /><a href=\"editartist.php?id=" . $result['id']. "\">{$i}) {$result['titel']}</a></td><td>{$result['date']}</td><td><span class='right'><a href=\"/CMS/?page=delete&g=artists&cat=" . $result['cat_name'] . "&id=" . $result['id'] . "\"><img style='width:25px; margin-right: 5px;' src='images/delete.png'></a></span></td></tr>";
        }
    }else{
        echo "<tr><td><input id='{$result['id']}' class='boxTut' name='box' type='checkbox' value='1' $varde /><a href=\"editartist.php?id=" . $result['id']. "\">{$result['titel']}</a></td><td>{$result['cat_name']}</td><td>{$result['date']}</td><td><span class='right'><a href=\"/CMS/?page=delete&g=artists&cat=" . $result['cat_name'] . "&id=" . $result['id'] . "\"><img style='width:25px; margin-right: 5px;' src='images/delete.png'></a></span></td></tr>";
    }


    }
  	if(!$limit){
    echo "<tr><td>".'<b>'.'Number of '.$name.' artists: '.'</b>'.$num.''."</td><td></td><td></td></tr>";
  	}
}
function getTytCatSelect(){
    $query = mysql_query("SELECT * FROM cats") or die (mysql_error());
    echo "<section id='hwrapp'><h3>Choose a category</h3></section>";
    while($result = mysql_fetch_assoc($query)){
        echo "<div class='tile'>
            <h3 style='margin-left: 5px;'>{$result['name']}</h3>
            <a href='/CMS/?page=artistList&cat=" . $result['name']. "'><div class='bildbox' style='border-radius: 0 0 5px 5px;'>
                <img src='/images/{$result['icon']}' alt='{$result['icon']}'>
            </div>
            </div>
            </a>";
    }
}

function getTytEdit($id){
    $query = mysql_query("SELECT * FROM artists WHERE id = '$id'") or die (mysql_error());
    return mysql_fetch_assoc($query);
}
function editTyt($id, $titel, $tilePicString, $tilePicOrg, $description, $cat, $grade, $content, $tags, $country, $merchant, $item_name, $sellamount, $soundcloudid, $extra, $qrcode, $selling){

    if (empty($_FILES['tilePic']['name'])){

        if($tilePicString == $tilePicOrg){
            mysql_query("UPDATE artists SET titel = '$titel', content = '$content', description = '$description', grade = '$grade', cat_name = '$cat', tags = '$tags', country = '$country', merchant = '$merchant', item_name = '$item_name', sellamount = '$sellamount', soundcloudid = '$soundcloudid', extra = '$extra', qrcode = '$qrcode', selling = '$selling' WHERE id = '$id'") or die (mysql_error());
            header ("Location: /CMS/?page=artistList&cat=$cat");
        }else{
            rename("../../images/$tilePicOrg", "../../images/$tilePicString");
            mysql_query("UPDATE artists SET titel = '$titel', tilePic = '$tilePicString', content = '$content', description = '$description', grade = '$grade', cat_name = '$cat', tags = '$tags', country = '$country', merchant = '$merchant', item_name = '$item_name', sellamount = '$sellamount', soundcloudid = '$soundcloudid', extra = '$extra', qrcode = '$qrcode', selling = '$selling' WHERE id = '$id'") or die (mysql_error());
            header ("Location: /CMS/?page=artistList&cat=$cat");
        }
        exit;
        }
        unlink($_SERVER["DOCUMENT_ROOT"]. "/images/" . $tilePicOrg);
        
        if (is_uploaded_file($_FILES['tilePic']['tmp_name'])){

            $path = "../../images/";
            if(file_exists($path . $tilePicOrg)){
                $i = 1;
                while(file_exists($path . "(" . $i . ")" . $tilePicOrg)){
                    $i++;
                }
                $Picname = ("(" . $i . ")" . $tilePicOrg);
            }else{
                $Picname = $tilePicString;
            }

        if (move_uploaded_file($_FILES['tilePic']['tmp_name'], $path . $Picname)){ 
        
        } else { 
        echo 'Bilden kunde inte flyttas.';
        exit;
        }
	
	if($merchant){
	    $selling = 1;
	}
	
	
	$extra = mysql_real_escape_string($extra);
	
        mysql_query("UPDATE artists SET titel = '$titel', tilePic = '$Picname', content = '$content', description = '$description', grade = '$grade', cat_name = '$cat', tags = '$tags', country = '$country', merchant = '$merchant', item_name = '$item_name', sellamount = '$sellamount', soundcloudid = '$soundcloudid', extra = '$extra', qrcode = '$qrcode', selling = '$selling' WHERE id = '$id'") or die (mysql_error());
        header ("Location: /CMS/?page=artistList&cat=$cat");
        } 
}
function addTyt($titel, $author, $content, $description, $status, $tilePic, $grade, $date, $cat, $tags, $country, $merchant, $item_name, $sellamount, $soundcloudid, $extra, $qrcode, $selling){
    
    if(empty($_FILES['tilePic']['name'])){
        exit;
        }
        $explode = explode(".", $_FILES['tilePic']['name']);
        foreach ($explode as $exp);
        
        if ($exp == 'jpg' || $exp == 'JPG' || $exp == 'png' || $exp == 'PNG' || $exp = 'gif'|| $exp = 'GIF'){
        if (is_uploaded_file($_FILES['tilePic']['tmp_name'])){
        $path = "../../images/";
        if(file_exists($path . $_FILES['tilePic']['name'])){
            $i = 1;
            while(file_exists($path . "(" . $i . ")" . $_FILES['tilePic']['name'])){
                $i++;
            }
            $Picname = ("(" . $i . ")" . $_FILES['tilePic']['name']);
        }else{
            $Picname = $_FILES['tilePic']['name'];
        }
        
        if(move_uploaded_file($_FILES['tilePic']['tmp_name'], $path . $Picname)){ 
        
        } else { 
        echo 'Bilden kunde inte flyttas.';
        exit;
        } 
        }
	
	if($merchant){
	    $selling = 1;
	}else{
	    $selling = 0;
	}
	
	$tags = $country. "," .$tags;
        $res = mysql_query("SELECT orderID FROM artists ORDER BY orderID DESC LIMIT 1");
        $result = mysql_fetch_array($res);
        $orderID = $result['orderID'] + 1;
	$extra = mysql_real_escape_string($extra);
	
        mysql_query("INSERT INTO artists VALUES (null, '$titel', '$author', '$content', '$description','$Picname', '$grade', '$date', '$cat', '$status', '$tags', '$country', '$merchant', '$item_name', '$sellamount', '$soundcloudid', '$extra', '$qrcode', '$selling', '$orderID')") or die (mysql_error());
        header ("Location: /CMS/?page=artistList&cat=$cat");
        }
}


function getCat(){
    $query = mysql_query("SELECT * FROM cats ORDER BY id DESC ") or die (mysql_error());
    $num = mysql_num_rows($query);
    echo "<section id='hwrapp'><h3>$num categories</h3><a href='createcat.php'><img src='images/add.png'></a></section>";

    while($result = mysql_fetch_assoc($query)){
    $num = mysql_num_rows($query);

    echo "<tr><td><a href=\"editcat.php?id=" . $result['id']. "\">{$result['name']}</a></td><td>{$result['icon']}</td><td><span class='right'><a href=\"/CMS/?page=delete&g=cats&id=" . $result['id'] . "\"><img style='width:25px; margin-right: 5px;' src='images/delete.png'></a></span></td></tr>";
    }
    echo "<tr><td>".'<b>'.'Number of categories: '.'</b>'.$num.'  stycken'."</td><td></td><td></td></tr>";
}
function getPreCat(){
    $query = mysql_query("SELECT id, name, author, color FROM cats ORDER BY id DESC LIMIT 3");

    while($result = mysql_fetch_array($query)){
        echo "<tr><td><a href='editCats.php?id={$result['id']}'>{$result['name']}</a></td><td>{$result['author']}</td><td>{$result['color']}</td></tr>";
    }
}
function getCatEdit($id){
    $query = mysql_query("SELECT * FROM cats WHERE id = '$id'") or die (mysql_error());
    return mysql_fetch_assoc($query);
}

function editCat($id, $name, $iconOrg, $iconString, $description){

    if (empty($_FILES['icon']['name'])){

        if($iconString == $iconOrg){
            mysql_query("UPDATE cats SET name = '$name', description = '$description'  WHERE id = '$id'") or die (mysql_error());
            header ("Location: /CMS/?page=cats");
        }else{
            rename("../../images/$iconOrg", "../../images/$iconString");
            mysql_query("UPDATE cats SET name = '$name', description = '$description', icon = '$iconString'  WHERE id = '$id'") or die (mysql_error());
            header ("Location: /CMS/?page=cats");
        }
        exit;
        }
        unlink($_SERVER["DOCUMENT_ROOT"] ."/images/" . $iconOrg);
        
        if (is_uploaded_file($_FILES['icon']['tmp_name'])){

            $path = "../../images/";
            if(file_exists($path . $iconString)){
                $i = 1;
                while(file_exists($path . "(" . $i . ")" . $iconString)){
                    $i++;
                }
                $Picname = ("(" . $i . ")" . $iconString);
            }else{
                $Picname = $iconString;
            }

        if (move_uploaded_file($_FILES['icon']['tmp_name'], $path . $Picname)){ 
        
        } else { 
        echo 'Bilden kunde inte flyttas.';
        exit;
        }
        mysql_query("UPDATE cats SET name = '$name', description = '$description', icon = '$Picname'  WHERE id = '$id'") or die (mysql_error());
            header ("Location: /CMS/?page=cats");
        } 
}
function addCat($name, $icon, $description, $author){
    
    if(empty($_FILES['icon']['name'])){
        exit;
        }
        $explode = explode(".", $_FILES['icon']['name']);
        foreach ($explode as $exp);
        
        if ($exp == 'jpg' || $exp == 'JPG' || $exp == 'png' || $exp == 'PNG' || $exp = 'gif'|| $exp = 'GIF'){
        if (is_uploaded_file($_FILES['icon']['tmp_name'])){
        $path = "../../images/";
        if(file_exists($path . $_FILES['icon']['name'])){
            $i = 1;
            while(file_exists($path . "(" . $i . ")" . $_FILES['icon']['name'])){
                $i++;
            }
            $Picname = ("(" . $i . ")" . $_FILES['icon']['name']);
        }else{
            $Picname = $_FILES['icon']['name'];
        }
        
        if(move_uploaded_file($_FILES['icon']['tmp_name'], $path . $Picname)){ 
        
        } else { 
        echo 'Bilden kunde inte flyttas.';
        exit;
        } 
        }
        mysql_query("INSERT INTO cats VALUES (null, '$name', '$description', '$Picname', '$author')") or die (mysql_error());
        header ("Location: /CMS/?page=cats");
        }
} 
function getDocEdit($id){
    $query = mysql_query("SELECT * FROM documents WHERE id = '$id'") or die (mysql_error());
    return mysql_fetch_assoc($query);
}
function getCatsOption(){
    $result = mysql_query("SELECT * FROM cats") or die(mysql_error());
    while($cat = mysql_fetch_array($result)){            
        echo "<option value=".$cat['name'].">". $cat['name']. "</option>";
    }
}
function getDoc(){
    $query = mysql_query("SELECT id, name, cat, counter  FROM documents ORDER BY id DESC ") or die (mysql_error());
    $num = mysql_num_rows($query);
    echo "<section id='hwrapp'><h3>$num Dokument</h3><a href='uploadDoc.php'><img src='images/add.png'></a></section>";

    while($result = mysql_fetch_assoc($query)){
    $num = mysql_num_rows($query);
    echo "<tr><td><a href=\"editDoc.php?id=" . $result['id']. "\">{$result['name']}</a></td><td>{$result['cat']}</td><td>{$result['counter']}</td><td><span class='right'><a href=\"/CMS/?page=delete&g=documents&id=" . $result['id'] . "\"><img style='width:25px; margin-right: 5px;' src='images/delete.png'></a></span></td></tr>";
    }
    echo "<tr><td>".'<b>'.'Antal Dokument: '.'</b>'.$num.'  stycken'."</td><td></td><td></td><td></td></tr>";
}
function addDoc($name, $cat){
    if (isset($_FILES['Doc']['name'])){
            
    if (is_uploaded_file($_FILES['Doc']['tmp_name'])){
        $path = "../../Docs/";
        if(file_exists($path . $_FILES['Doc']['name'])){
            $i = 1;
            while(file_exists($path . "(" . $i . ")" . $_FILES['Doc']['name'])){
                $i++;
            }
            $link = ("(" . $i . ")" . $_FILES['Doc']['name']);
        }else{
            $link = $_FILES['Doc']['name'];
        }
        
    if (move_uploaded_file($_FILES['Doc']['tmp_name'], $path . $link)){ 
    
    } else { 
    echo 'Bilden kunde inte flyttas.';
    exit;
    } 
    }
    $counter = 0;
    mysql_query("INSERT INTO documents VALUES (null, '$name', '$link', '$cat' , '$counter')") or die (mysql_error());
    header ("Location: /CMS/?page=documents");
    exit;

    }else{
        echo "ingen fil har vals";
    }
}
function editDoc($id, $name, $cat, $filename, $filenameOrg){
    if (empty($_FILES['Doc']['name'])){

    if($filename == $filenameOrg){
        mysql_query("UPDATE documents SET name = '$name', cat = '$cat'  WHERE id = '$id'") or die (mysql_error());
        header ("Location: /CMS/?page=documents");
    }else{
        rename("../../Docs/$filenameOrg", "../../Docs/$filename");
        mysql_query("UPDATE documents SET name = '$name', link = '$filename', cat = '$cat'  WHERE id = '$id'") or die (mysql_error());
        header ("Location: /CMS/?page=documents");
    }
    exit;
    }
    unlink($_SERVER["DOCUMENT_ROOT"]. "/Docs/". $filenameOrg);
    
    if (is_uploaded_file($_FILES['Doc']['tmp_name'])){

        $path = "../../Docs/";
        if(file_exists($path . $filename)){
            $i = 1;
            while(file_exists($path . "(" . $i . ")" . $filename)){
                $i++;
            }
            $link = ("(" . $i . ")" . $filename);
        }else{
            $link = $filename;
        }
    if (move_uploaded_file($_FILES['Doc']['tmp_name'], '../../Docs/' . $filename)){ 
    
    } else { 
    echo 'Bilden kunde inte flyttas.';
    exit;
    }
    mysql_query("UPDATE documents SET name = '$name', link = '$filename', cat = '$cat'  WHERE id = '$id'") or die (mysql_error());
    header ("Location: /CMS/?page=documents");
    }

}

function getUsers(){
    $query = mysql_query("SELECT full_name, username, email FROM users WHERE admin = 1 ") or die (mysql_error());
    $num = mysql_num_rows($query);
    echo "<section id='hwrapp'><h3>$num Användare</h3><a href='createuser.php'><img src='images/add.png'></a></section>";

    while($result = mysql_fetch_assoc($query)){
    $num = mysql_num_rows($query);
    echo "<tr><td>{$result['full_name']}</td><td>{$result['username']}</td></tr>";
    }
}
function addUser($full_name, $username, $password, $email){
    $admin = 1;
    $profilePic = "";
    $text = "";
    $passwordNew = sha1($password);
    mysql_query("INSERT INTO users VALUES (null, '$full_name', '$username', '$passwordNew', '$email', '$text', '$admin', '$profilePic')") or die (mysql_error());
    header ("Location: /CMS/?page=users");
}
function getProfileByName($username){
    $query = mysql_query("SELECT * FROM users WHERE username = '$username'") or die (mysql_error());
    $result = mysql_fetch_assoc($query);
    echo "<section class='profile_pic_box'><img src='../images/{$result['profilepic']}'></section><section class='username_box'><h1>{$result['full_name']}</h1></section>";

    echo "<section id='hwrapp'><h3>Ändra din profil</h3></section>";
    echo "<form method='post' action='includes/doEditProfile.php' enctype='multipart/form-data'>
                <input name='id' type='hidden' value='{$result['id']}'>
                <br><br><label>Namn</label>
                <input name='full_name' type='text' value='{$result['full_name']}' required><br>
                <label>Användarnamn</label>
                <input name='username' type='text' value='{$result['username']}' required><br>
                <label>E-Post</label>
                <input name='epost' type='text' value='{$result['email']}' required><br>
                <label>Om mig</label>
                <textarea name='info' required>{$result['text']}</textarea><br>
                <label>Byt namn på profilbilden</label><br>
                <input type='hidden' name='profilepicOrg' value='{$result['profilepic']}'>
                <input type='text' name='profilepicString' value='{$result['profilepic']}'><br>
                <label>Byt profilbild</label><br>
                <input type='file' name='profilepic'><br>
                <input type='submit' name='submit' value='Ändra Profil' class='submit'>
            </form>";
            echo "<section id='hwrapp'><h3>Byt ditt lösenord</h3></section>";
             echo "<section id='password_box'><form method='post' name='REG' action='includes/doEditProfile.php?a=pass'>
                <input name='id' type='hidden' value='{$result['id']}'>
                <label>Nya lösenordet</label>
                <input name='newpass' type='password' required><br>
                <input type='submit' name='submit' value='Ändra Lösenord' class='submit'>
            </form></section>";
}
function editProfile($id, $full_name, $username, $epost, $info, $profilepicOrg, $profilepicString){
    if (empty($_FILES['profilepic']['name'])){

        if($profilepicString == $profilepicOrg){
            mysql_query("UPDATE users SET full_name = '$full_name', username = '$username', email = '$epost', `text` = '$info', admin = 1 WHERE id = '$id'") or die (mysql_error());
            header ("Location: /CMS/?page=profile");
        }else{
            rename("../../images/$profilepicOrg", "../../images/$profilepicString");
            mysql_query("UPDATE users SET full_name = '$full_name', username = '$username', email = '$epost', `text` = '$info', admin = 1, profilepic = '$profilepicString' WHERE id = '$id'") or die (mysql_error());
            header ("Location: /CMS/?page=profile");
        }
        exit;
        }
        unlink($_SERVER["DOCUMENT_ROOT"] ."/images/" . $profilepicOrg);
        
        if (is_uploaded_file($_FILES['profilepic']['tmp_name'])){

            $path = "../../images/";
            if(file_exists($path . $profilepicString)){
                $i = 1;
                while(file_exists($path . "(" . $i . ")" . $profilepicString)){
                    $i++;
                }
                $Picname = ("(" . $i . ")" . $profilepicString);
            }else{
                $Picname = $profilepicString;
            }

        if (move_uploaded_file($_FILES['profilepic']['tmp_name'], $path . $Picname)){ 
        
        } else { 
        echo 'Bilden kunde inte flyttas.';
        exit;
        }
        mysql_query("UPDATE users SET full_name = '$full_name', username = '$username', email = '$epost', `text` = '$info', admin = 1, profilepic = '$Picname' WHERE id = '$id'") or die (mysql_error());
        header ("Location: /CMS/?page=profile");
    } 
}
function uploadImages($upload){
    if (empty($_FILES['images']['name'])){
        exit;
        }        
        if (is_uploaded_file($_FILES['images']['tmp_name'])){

            $path = "../../images/";
            if(file_exists($path . $_FILES['images']['name'])){
                $i = 1;
                while(file_exists($path . "(" . $i . ")" . $_FILES['images']['name'])){
                    $i++;
                }
                $Picname = ("(" . $i . ")" . $_FILES['images']['name']);
            }else{
                $Picname = $_FILES['images']['name'];
            }

        if (move_uploaded_file($_FILES['images']['tmp_name'], $path . $Picname)){ 
        
        } else { 
        echo 'Bilden kunde inte flyttas.';
        exit;
        }
        header ("Location: /CMS/?page=images");
    } 
}
function editPass($id, $newpass, $username){
    mysql_query("UPDATE users SET password = '$newpass' WHERE id = '$id'") or die (mysql_error());
    header ("Location: /CMS/?page=profile");
}
function getBackup(){
    $query = mysql_query("SELECT name, author, date FROM backup LIMIT 10") or die (mysql_error());
    $num = mysql_num_rows($query);
    $user = $_SESSION['user'];
    echo "<section id='hwrapp'><h3>$num Backups</h3></section>";
    echo "<form action='/CMS/backup.php?go' method='post'>
                <label>Ny backup</label><br>
                <input name='name' type='text' required>
                <input name='author' type='hidden' value='$user'>
                <input type='submit' value='Create backup' class='submit'>
                </form>";
    if(!$num == 0){
        echo "<table><thead><tr><th>Namn</th><th>Skapare</th><th>Datum</th></tr></thead><tbody>";
        while($result = mysql_fetch_assoc($query)){
            echo "<tr><td>{$result['name']}</td><td>{$result['author']}</td><td>{$result['date']}</td></tr>";   
        }
    }else{

    }
    echo "</tbody></table>";
}
function delete($g, $id){
    if($g == 'news'){
    $query = mysql_query("SELECT tilePic FROM news WHERE id = '$id'");
    $result = mysql_fetch_array($query);
    $file = $result['tilePic'];
    unlink($_SERVER["DOCUMENT_ROOT"]. "/images/". $file);
    mysql_query("DELETE FROM $g WHERE id = $id") or die (mysql_error());
    }
    elseif($g == 'artists'){
    $query = mysql_query("SELECT tilePic FROM artists WHERE id = '$id'");
    $result = mysql_fetch_array($query);
    $file = $result['tilePic'];
    unlink($_SERVER["DOCUMENT_ROOT"]. "/images/". $file);
    mysql_query("DELETE FROM $g WHERE id = $id") or die (mysql_error());
    }
    elseif($g == 'documents'){
    $query = mysql_query("SELECT link FROM documents WHERE id = '$id'");
    $result = mysql_fetch_array($query);
    $file = $result['link'];
    unlink($_SERVER["DOCUMENT_ROOT"]. "/Docs/". $file);
    mysql_query("DELETE FROM $g WHERE id = $id") or die (mysql_error());
    }
    elseif($g == 'cats'){
    $query = mysql_query("SELECT icon FROM cats WHERE id = '$id'");
    $result = mysql_fetch_array($query);
    $file = $result['icon'];
    unlink($_SERVER["DOCUMENT_ROOT"]. "/images/". $file);
    mysql_query("DELETE FROM $g WHERE id = $id") or die (mysql_error());
    }
    elseif($g == 'om'){
        mysql_query("DELETE FROM $g WHERE id = $id") or die (mysql_error());
        echo "<script>window.location.assign('/CMS/')</script>";
    }
    else{
        mysql_query("DELETE FROM $g WHERE id = $id") or die (mysql_error());
    }
}

/*----------------------------------------------------------------------------
Alla funktioner som har med filhanteringen att göra
----------------------------------------------------------------------------*/

function viewFiles($type){
    $path = "../$type";
    $protected = array('.', '..', '.DS_Store', 'backup.php');
    $dir = @opendir($path) or die ("Kan inte öppna mappen");

    while($file = readdir($dir)){

        if(filetype($path . "/" . $file) == "dir"){
            $date = date ("d/m-y H:i:s", filemtime($path . "/" . $file));
            if($type){
                if(!in_array($file,$protected)){
                echo "<tr><td><img style='width:30px; margin-right: 5px;' src='/CMS/images/folder.png'><a href='/CMS/?page=kodmall&dir=$type/$file'>$file</a></td><td>$date</td><td><span class='right'><a href='includes/deletedir.php?dir=$type&name=$file'><img style='width:25px; margin-right: 5px;' src='/CMS/images/delete.png'></a></span></td></tr>";
                }
            }else{
                if(!in_array($file,$protected)){
                echo "<tr><td><img style='width:30px; margin-right: 5px;' src='/CMS/images/folder.png'><a href='/CMS/?page=kodmall&dir=$file'>$file</a></td><td>$date</td><td><span class='right'><a href='includes/deletedir.php?dir=$type&name=$file'><img style='width:25px; margin-right: 5px;' src='/CMS/images/delete.png'></a></span></td></tr>";
                }
            }
        }
        else if(filetype($path . "/" . $file) == "file"){
            if(!in_array($file,$protected)){
            $date = date ("d/m-y H:i:s", filemtime($path . "/" . $file));
            echo "<tr><td><img style='width:30px; margin-right: 5px;' src='/CMS/images/document.png'><a href='editfile.php?dir=$type&name=$file'>$file</a></td><td>$date</td><td><span class='right'><a href='includes/deletefile.php?dir=$type&name=$file'><img style='width:25px; margin-right: 5px;' src='/CMS/images/delete.png'></a></span></td></tr>";
            }
        }
    }
    closedir($dir);
}
function viewImages(){
    $path = "../images";
    $protected = array('.', '..', '.DS_Store');
    $dir = @opendir($path) or die ("Kan inte öppna mappen");

    while($file = readdir($dir)){

        if(filetype($path . "/" . $file) == "dir"){
        }
        else if(filetype($path . "/" . $file) == "file"){
            if(!in_array($file,$protected)){
            $date = date ("d/m-y H:i:s", filemtime($path . "/" . $file));
            echo "<div class='tile'>
            <form action='includes/doRenameImage.php' method='POST' class='ajax'>
                <input name='image_name' type='text' value='$file' style='border: 0; width: 70%; margin: 3px; float: left;'/>
                <input name='org_name' type='hidden' value='$file'/>
                <input type='submit' value='S' class='submit'>
            </form>
            <a href='../images/$file'><div class='bildbox'>
                <img src='../images/$file' alt='$file'>
            </div>
            <a href='/CMS/includes/deleteImg.php?name=$file'><img style='width:25px; margin: 5px;' src='images/delete.png'></a>
            </div>
            </a>";
            }
        }
    }
    closedir($dir);
}



?>