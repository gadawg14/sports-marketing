<?php
	
	if ($_POST['submit']) {
		$photoid = $_POST['id'];
	} else {
		$photoid = $_GET['id'];
	}

	require_once 'cfg.inc';
	dbconn();
	$photosql = "SELECT p.id, g.imagename, p.title, g.id as photoid
							FROM gallimages g
							JOIN photogalleries p ON p.id = g.gallid
							WHERE g.id =" . $photoid;
    //$photosql = mysql_real_escape_string($photosql);
	$photores = mysql_query($photosql);
	$photorow = mysql_fetch_array($photores);
	
	if ($_POST['submit']) {
		
		unlink('images/albums2/' . $photorow['id'] . '/thumbs/' . $photorow['imagename']);
		unlink('images/albums2/' . $photorow['id'] . '/' . $photorow['imagename']);
		
		$delsql = "delete from gallimages where id=" . $photoid;
		$delres = mysql_query($delsql);
		
			if ($delres) {
				echo 'Photo Deleted<br><Br><a href="http://www.everettsm.com/ad_esmmain.php?p=5">Return to the Main Admin page</a>';
				exit();
			} else {
				echo 'Photo not deleted - contact your friendly programmer' . $delsql;
			}
			
		
	}
	
	
	?>
	
	
<div style="width: 700px; font: 9pt/9pt arial, tahoma; text-align: left; margin: 30px 0 0 60px;">
		
		<h1>Remove an Image</h1>
		<br><Br>
		
	<form action="ad_esmmain.php?i=ad_imgdelete.php" method="POST">

		<?php
		
			echo '<input type="hidden" name="id" value="' . $photoid . '">';

			echo '<img src="images/albums2/' . $photorow['id'] . '/thumbs/' . $photorow['imagename'] . '">';
			echo '<br><br>From Gallery: <h5>' . $photorow['title'] . '</h5>';
		?>
		<br><br>
		
		Are you sure you want to delete this image?
		<br><br>
		<input type="submit" name="submit" value="Yes, Delete this image!">
	</form>

</div>	