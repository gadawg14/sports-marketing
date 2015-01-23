<?php

 define ("MAX_SIZE","400");
//global $filename;

 if($_SERVER["REQUEST_METHOD"] == "POST")
 {
 		$fn = mysql_real_escape_string($_POST['foldername']);
 		//echo 'attempted insert / save' . $fn;
		$image = $_FILES["gallimage"]["name"];
		//echo $image;
 		$uploadedfile = $_FILES['gallimage']['tmp_name'];

  		if ($image) 
		{
			  $filename = stripslashes($_FILES['gallimage']['name']);
			  //echo '<br>' . $filename . '<br>';
			   $extension = getExtension($filename);
			  $extension = strtolower($extension);
			 if (($extension != "jpg") && ($extension != "jpeg") 
					&& ($extension != "png") && ($extension != "gif")) 
			  {
					echo ' Unknown Image extension ';
					$errors=1;
			  }
			 else
			{
			   $size=filesize($_FILES['gallimage']['tmp_name']);
				 
				if ($size > MAX_SIZE*1024)
				{
					 echo "You have exceeded the size limit";
					 $errors=1;
				}
			 
				if($extension=="jpg" || $extension=="jpeg" )
				{
					$uploadedfile = $_FILES['gallimage']['tmp_name'];
					$src = imagecreatefromjpeg($uploadedfile);
				}
				else if($extension=="png")
				{
					$uploadedfile = $_FILES['gallimage']['tmp_name'];
					$src = imagecreatefrompng($uploadedfile);
				}
				else 
				{
					$src = imagecreatefromgif($uploadedfile);
				}
			 
         	  list($width,$height)=getimagesize($uploadedfile);
               
               
                if ($width > $height) {
                   
                    $newwidth=500;
                    $newheight=($height/$width)*$newwidth;
                    //$newwidthinter=300;
                    //$newheightinter=($height/$width)*$newwidthinter;
                    $newwidththumb = (140/$newheight)*500;
                    $newheightthumb = 140;
                    //$newheightthumb = 140;
                    $thumbx = ($newwidththumb-180)/2;
                    //if ($newheightinter >= 140) {
                    //    $thumby = ($newheightinter-140)/2;
                    //}else {
                        $thumby=0;
                    //}
                } else {
                   
                    $newheight=500;
                    $newwidth=($width/$height)*$newheight;
                    //$newheightinter=300;
                    //$newwidthinter=($width/$height)*$newheightinter;
                    $newwidththumb = 180;
                    $newheightthumb = (180/$newwidth)*500;
                    $thumbx=0;
                    //if ($newwidthinter >=180) {
                        //$thumby = ($newheightthumb-140)/2;
							$thumby = 10;
                    //} else {
                    //    $thumbx = 0;
                    //}

                }
               
                    /*echo $newheight . '<br>';
                    echo $newwidth . '<br>';
                    echo $newheightinter . '<br>';
                    echo $newwidthinter . '<br>';
                    echo $newheightthumb . '<br>';
                    echo $newwidththumb . '<br>';
                    echo $thumby . '<br>';
                    echo $thumbx . '<br>';
                */
               
                    $tmp=imagecreatetruecolor($newwidth,$newheight);
                    $tmpinter=imagecreatetruecolor($newwidththumb,$newheightthumb);
                    $tmp1=imagecreatetruecolor(180, 140);
               
                    imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
                    imagecopyresampled($tmpinter,$src,0,0,0,0,$newwidththumb,$newheightthumb,$width,$height);
                    //imagecopyresampled($tmp1,$src,0,0,0,0,$newwidththumb,$newheightthumb,$width,$height);
               
                    imagecopyresampled($tmp1, $tmpinter, 0,0,$thumbx,$thumby,180,140, 180, 140);
           
               
                $filename = "images/albums2/". $fn . "/" .  $_FILES['gallimage']['name'];
                //$filename1 = "images/albums/" . $fn . "/thumbs/" . $_FILES['gallimage']['name'];
                $filename2 = "images/albums2/" . $fn . "/thumbs/" . $_FILES['gallimage']['name'];

               
                imagejpeg($tmp,$filename,100);
                //imagejpeg($tmpinter,$filename1,100);
                imagejpeg($tmp1,$filename2,100);
               
                imagedestroy($src);
                imagedestroy($tmp);
                imagedestroy($tmp1);
                imagedestroy($tmpinter);
			}
		}

		$imgsql = "insert into gallimages
			(`gallid`, `imagename`, `link`)
			values
			('" . $fn . "', '" . $image . "', '" . $_POST['linkimage'] . "')";
			$imgres = mysql_query($imgsql) or die(mysql_error() .  "<br />".$imgsql); 
			
			if ($imgres) {
				$dbmsg = 'Your Photo has been added!';
				$justadd = true;
			} else {
				$dbmsg = 'Photo not added - contact your friendly programmer' . $imgsql;
			}



}


?>


<div style="margin: 0px auto; width: 900px; margin-bottom: 100px;">
	<div style="width: 100%;">


<h1>Add a Photo:</h1>

	<div style="width: 100%; margin-top: 10px;">
		
		<form enctype="multipart/form-data" action="http://www.everettsm.com/ad_esmmain.php?i=ad_addimage.php" method="POST">
			<input type="hidden" name="MAX_FILE_SIZE" value="1000000">
		
		<!--<form name="photoupload" method="POST" action="http://www.everettsm.com/ad_esmmain.php?p=5"> -->
					 
			
			<?php
				dbconn();
				if ($fn) {
					$folderid = $fn;
				} else {
					$folderid = $_GET['id'];
				}				
				$gallsql = "select * from photogalleries where id=" . $folderid;
				$gallres = mysql_query($gallsql);
				$gallrow = mysql_fetch_array($gallres);
				echo '<h2>' .  $gallrow['title'] . '</h2>';
				echo '<input type="hidden" value="'. $gallrow['id'] . '" name="foldername">';
			?>
			
			<br><br><br><br>
			Image Name: <input type="file" name="gallimage" size="50"><br><br>
		Gallery Link:&nbsp; &nbsp; <input type="radio" name="linkimage" value="y">Yes
				&nbsp; &nbsp; <input type="radio" name="linkimage" value="n" checked>No


				<br><br><br>
				<input type="submit" name="uplphotosubmit" value="Save">
		</form>

	</div>
	<br><Br>
	<hr>
	<br><Br>
	<h1>Album Contents</h1>
	<br><Br>
<?php
		echo '<div style="width: 100%; border-left: 1px solid gray; padding-left: 10px; margin-bottom: 100px;">';
	$sqlimgs = "select * from gallimages where gallid = " . $folderid;
    //$sqlimgs = mysql_real_escape_string($sqlimgs);
	$imgsres = mysql_query($sqlimgs);
	while ($imgrow = mysql_fetch_array($imgsres)) {
		echo '<div style="float: left; height: 230px; width: 190px; margin: 10px 5px 20px 0px; text-align: center;
			border: 1px solid black; padding: 5px;">';
			echo '<div style="height: 190px;">';
		echo '<img src="images/albums2/' . $folderid . '/thumbs/' . $imgrow['imagename'] . 
			'" border=0 style="border: 3px solid #3B3232;">';
			echo '</div>';
			echo 'gallery link?  ' . $imgrow['link'] . '<br><br>';
		echo '<a href="http://www.everettsm.com/ad_esmmain.php?i=ad_imgdelete.php&id=' . 
			$imgrow['id'] . '" >delete</a>';

		echo '&nbsp; &nbsp; &nbsp;<a href="http://www.everettsm.com/ad_esmmain.php?i=ad_imgedit.php&id=' . 
			$imgrow['id'] . '" >edit</a>';

			
		echo '</div>';

	}
	
?>

</div>
	
	
	
</div>
</div>
