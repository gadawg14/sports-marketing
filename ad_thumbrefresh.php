<?php

require_once 'cfg.inc';
	dbconn();
	$sqlgall = "select * from gallimages where gallid in (15,16,17,18,19,20)";
	$sqlres = mysql_query($sqlgall);
	while ($row = mysql_fetch_array($sqlres)) {
					mkdir($_SERVER['DOCUMENT_ROOT'] . "/everettsm/images/albums3/" . $row['gallid']);
					mkdir($_SERVER['DOCUMENT_ROOT'] . "/everettsm/images/albums3/" . $row['gallid'] . "/thumbs");

		$image = $row['imagename'];
		$uploadedfile = 'images/albums2/' . $row['gallid'] . '/' . $image;
		$filename2 = "images/albums3/" . $row['gallid'] . "/thumbs/" . $image;
		
			  $filename = stripslashes($row['imagename']);
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
			 
				if($extension=="jpg" || $extension=="jpeg" )
				{
					//$uploadedfile = $_FILES['gallimage']['tmp_name'];
					$src = imagecreatefromjpeg($uploadedfile);
				}
				else if($extension=="png")
				{
					//$uploadedfile = $_FILES['gallimage']['tmp_name'];
					$src = imagecreatefrompng($uploadedfile);
				}
				else 
				{
					$src = imagecreatefromgif($uploadedfile);
				}
			 
         	  list($width,$height)=getimagesize($uploadedfile);
               
               
                if ($width > $height) {
                   
                    //$newwidth=500;
                    //$newheight=($height/$width)*$newwidth;
                    $newwidthinter=300;
                    $newheightinter=($height/$width)*$newwidthinter;
                    //$newwidththumb = 180;
                    //$newheightthumb = ($height/$width)*$newwidththumb;
                    //$newheightthumb = 140;
                    $thumbx = 60;
                    //if ($newheightinter >= 140) {
                       // $thumby = ($newheightinter-140)/2;
                    //}else {
                        $thumby=0;
                    //}
                } else {
                   
                    //$newheight=500;
                    //$newwidth=($width/$height)*$newheight;
                    $newheightinter=300;
                    $newwidthinter=($width/$height)*$newheightinter;
                    //$newheightthumb = 140;
                    //$newwidththumb = ($width/$height)*$newheightthumb;
                    //$newwidththumb = 180;
                    $thumby=0;
                    if ($newwidthinter >=180) {
                        $thumbx = ($newwidthinter-180)/2;
                    } else {
                        $thumbx = 0;
                    }

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
               
                    //$tmp=imagecreatetruecolor($newwidth,$newheight);
                    $tmpinter=imagecreatetruecolor($newwidthinter,$newheightinter);
                    $tmp1=imagecreatetruecolor(180, 140);
               
                    //imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
                    imagecopyresampled($tmpinter,$src,0,0,0,0,$newwidthinter,$newheightinter,$width,$height);
                    //imagecopyresampled($tmp1,$src,0,0,0,0,$newwidththumb,$newheightthumb,$width,$height);
               
                    imagecopyresampled($tmp1, $tmpinter, 0,0,$thumbx,$thumby,180,140, 180, 140);
           
               
                //$filename = "images/albums3/". $fn . "/" .  $_FILES['gallimage']['name'];
                //$filename1 = "images/albums/" . $fn . "/thumbs/" . $_FILES['gallimage']['name'];
                //$filename2 = "images/albums3/" . $row['gallid'] . "/thumbs/" . $image;

               
                //imagejpeg($tmp,$filename,100);
                //imagejpeg($tmpinter,$filename1,100);
                imagejpeg($tmp1,$filename2,100);
               
                imagedestroy($src);
                //imagedestroy($tmp);
                imagedestroy($tmp1);
                imagedestroy($tmpinter);
			}
		}
	
	
	
	?>
	