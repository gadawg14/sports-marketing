
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<body>
Please Wait, this process can take several minutes.


<?php


define('DOCROOT', $_SERVER['DOCUMENT_ROOT']);
define('DOWNLOAD_PATH', DOCROOT . '/everettsm/images/albums');
//define('DOWNLOAD_PATH', '/images/signings');

ECHO $_SERVER['DOCUMENT_ROOT'];
$gallfolder = $_GET['fname'];

if (file_exists(DOWNLOAD_PATH . "/$gallfolder/thumbs")) {
	$pd1 = opendir(DOWNLOAD_PATH . "/$gallfolder/thumbs");
	while (($file = readdir($pd1)) !== false) {
		if (substr($file, 0, 1) != ".") {
			unlink(DOWNLOAD_PATH . "/$gallfolder/thumbs/$file");
		}
	}
} else {
	mkdir(DOWNLOAD_PATH . "/$gallfolder/thumbs");
}

$pd = opendir(DOWNLOAD_PATH . "/$gallfolder");
while (($file = readdir($pd)) !== false) {
	$file_ext = substr(strrchr($file, "."), 1);
	$file_ext = strtolower($file_ext);
//	$chk_thumb = substr($file, 2);
	if ($file_ext == "jpg") {
		if (! file_exists(DOWNLOAD_PATH."/$gallfolder/thumbs/$file")) {
			list($width, $height) = getimagesize(DOWNLOAD_PATH."/$gallfolder/$file");
			if ($width > $height) {
				$newheight = round((180 / $width),4) * $height;
				$image_p = imagecreatetruecolor(180, $newheight);
				$image = imagecreatefromjpeg(DOWNLOAD_PATH."/$gallfolder/$file");
				imagecopyresampled($image_p, $image, 0, 0, 0, 0, 180, $newheight, $width, $height);
				imagejpeg($image_p, DOWNLOAD_PATH."/$gallfolder/thumbs/" . $file , 80);
				imagedestroy($image_p);
				imagedestroy($image);
			} else {
				$newwidth = round((180 / $height),4) * $width;
				$image_p = imagecreatetruecolor($newwidth, 180);
				$image = imagecreatefromjpeg(DOWNLOAD_PATH."/$gallfolder/$file");
				imagecopyresampled($image_p, $image, 0, 0, 0, 0, $newwidth, 180, $width, $height);
				imagejpeg($image_p, DOWNLOAD_PATH."/$gallfolder/thumbs/" . $file , 80);
				imagedestroy($image_p);
				imagedestroy($image);
			}
			
			
		}
		
	}
}

		echo '<div style="color: black;">';
		echo 'Thumb Creation process complete. You may now <a href="/admin_console.php?return=1"> return</a> to the admin
console.';
		echo '</div>';


?>

</body>
</html>