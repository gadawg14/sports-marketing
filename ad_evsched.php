<?php
	require_once 'cfg.inc';

	$dbmsg = '';
	if ($_POST['evsubm']) {
		$sid = $_POST['evid'];
		dbconn();

	if ($_POST['ps'] == 'update') {

		$evupdsql = "update esmupcoming set location = '" . addslashes($_POST['location']) .
			"', date = '" . $_POST['date'] .
			"', active = '" . $_POST['active'] . "', link= '" . $_POST['link'] . "', linktitle= '" . $_POST['linktitle'] . 
			"'";

		$evupdsql .= " where id = " . $_POST['evid'];
        //$evupdsql = mysql_real_escape_string($evupdsql);
		$sqlres = mysql_query($evupdsql);
		if ($sqlres) {
			$dbmsg = 'record updated';
		} else {
			$dbmsg = 'record not updated - contact your friendly programmer' . $evupdsql;
		}
			
		
	} elseif ($_POST['ps'] == 'insert') {
		
		$evinssql = "insert into esmupcoming
			(date, location, linktitle, link, active)
			values
			('" . $_POST['date'] . "', '" .
			addslashes($_POST['location']) . "', '" .
			$_POST['linktitle'] . "', '" .
			$_POST['link'] . "', '" .
			$_POST['active'] . "')";
			 
			//$evinssql = mysql_real_escape_string($evinssql);
            $sqlres = mysql_query($evinssql); 
			if ($sqlres) {
				$dbmsg = 'record updated';
				$justadd = true;
			} else {
				$dbmsg = 'record not updated - contact your friendly programmer' . $evinssql;
			}
		
	}

}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<LINK REL=StyleSheet HREF="style.css" TYPE="text/css" MEDIA=screen>
</head>


<body>

<div style="width: 900px; margin: 0px auto;">
<br><br><a href="ad_esmmain.php?i=ad_evschedmain.php">Event Schedule Main Listing</a><br><br>
<?php 
	if ($dbmsg) {
		echo $dbmsg . ' | Add another or <a href="http://www.everettsm.com/ad_esmmain.php?i=ad_evschedmain.php">return</a> to the main listing page.'; 
	}
?>
<form action="ad_esmmain.php?i=ad_evsched.php" method="POST">
	
<?php


if ($_GET['as'] == 'a' or $justadd == true) {

	echo '<br>Date: <input type="text" name="date" size="20"><br>';
	echo '<br>Location: <input type="text" name="location" size="30"><br>';
	echo '<br>Link Title: <input type="text" name="linktitle" size="30"><br>';
	echo '<br>Link: <input type="text" name="link" size="30"><br>';
	echo '<br>Active?: &nbsp; &nbsp;';
	echo '<input type="radio" name="active" value="y">Yes &nbsp; &nbsp;';
	echo '<input type="radio" name="active" value="n" checked>No<br><br>';
		echo '<input type="hidden" name="ps" value="insert">';
	
} else {

	dbconn();
	if ($_GET['evid']) {
		$sid = $_GET['evid'];
	  $signwhere = "where id = " . $sid;
	} else {
		$signwhere = "where 1";
	}
	$evsql = "select * from esmupcoming " . $signwhere;
    //$evsql = mysql_real_escape_string($evsql);
	$sqlres = mysql_query($evsql);
	$row = mysql_fetch_array($sqlres);
	
	echo '<br>Date: <input type="text" name="date" size="20" value="' . $row['date'] . '"><br>';
	echo '<br>Location: <input type="text" name="location" size="30" value="' . $row['location'] . '"><br>';
	echo '<br>Link Title: <input type="text" name="linktitle" size="30" value="' . $row['linktitle'] . '"><br>';
	echo '<br>Link: <input type="text" name="link" size="30" value="' . $row['link'] . '"><br>';
	
	echo '<br>Active?: &nbsp; &nbsp; '; 	
	if ($row['active'] == 'y') {
		echo '<input type="radio" name="active" value="y" checked>Yes &nbsp; &nbsp;';
		echo '<input type="radio" name="active" value="n" >No';
	} else {
		echo '<input type="radio" name="active" value="y">Yes &nbsp; &nbsp;';
		echo '<input type="radio" name="active" value="n" checked>No<br><br>';
		
	}
	
	
	echo '<input type="hidden" name="ps" value="update">';
	echo '<input type="hidden" name="evid" value="' . $sid . '">';

}

?>

<br><br>
<input type="submit" name="evsubm" value="Save">
</form>

</div>
</body>
</html>