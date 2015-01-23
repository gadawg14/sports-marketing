<?php
	
	require_once 'cfg.inc';



	if ($_POST['submit']) {
		
		$sinssql = "insert into fbcamp_options
			(campid, price, description, active)
			values
			('" . $_POST['campid'] . "', '" .
			$_POST['price'] . "', '" .
			$_POST['description'] . "', '" .
			$_POST['active'] . "')";
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
		
<form action="ad_esmmain.php?i=ad_fbcampmtopt.php" method="POST">
	Price: <input type="text" name="price" size="50" maxlength="20"><br>
	<table><tr>
	<td valign="top">Description:</td><td>
	<textarea name="description" cols="30" rows="6"></textarea></td></tr></table>
	Active: <input type="radio" name="active" value="y">Yes&nbsp; &nbsp;
		<input type="radio" name="active" value="n">No &nbsp;<br><br>
	<?php
	
		echo '<input type="hidden" name="campid" value="' . $_GET['id'] . '">';

?>

<br><br>
<input type="submit" name="submit" value="Save">
</form>

</div>
