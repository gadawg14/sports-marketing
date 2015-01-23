<?php
	
	require_once 'cfg.inc';



	if ($_POST['submit']) {
		
		$sinssql = "insert into fbcamp
			(title, location, date, description, active)
			values
			('" . $_POST['title'] . "', '" .
			$_POST['location'] . "', '" .
			$_POST['date'] . "', '" .
			$_POST['description'] . 
			'", "' . $_POST['maplink'] . 
			"','y')";
            //$sinssql = mysql_real_escape_string($sinssql);
			$sqlres = mysql_query($sinssql); 
			if ($sqlres) {
				$dbmsg = 'record added';
				$justadd = true;
			} else {
				$dbmsg = 'record not added - contact your friendly programmer' . $pinssql;
			}
		
	}
?>

	<div style="width: 600px; font: 9pt/9pt arial, tahoma; text-align: left; margin: 30px 0 0 60px;">
		
<form action="ad_esmmain.php?i=ad_fbcampadd.php" method="POST">
	Title: <input type="text" name="title" size="50" maxlength="150"><br>
	<br>Date: <input type="text" name="date" size="30" maxlength="30"><br>
	<br>Location: <input type="text" name="location" size="50" maxlength="150"><br>
	<br>Description: <input type="text" name="description" size="50" maxlength="250"><br>
	<br>Maplink (optional): <input type="text" name="maplink" size="50" maxlength="250"><br>


		<!-- echo '<input type="hidden" name="ss" value="insert">';  -->
	

<br><br>
<input type="submit" name="submit" value="Save">
</form>

</div>
