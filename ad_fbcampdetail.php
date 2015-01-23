<?php
	require_once 'cfg.inc';
	dbconn();
	
	$dbmsg = '';

	
	if ($_POST['submit']) {

	$id=$_POST['id'];

		$pupdsql = "update fbregistrations set paid='" . $_POST['paid'] . 
				"', pmtdate='" . $_POST['pmtdate'] . "' where id=" . $id;
		
					//"update registration set  = '" . addslashes($_POST['phead']) .
						//"', pdesc = '" . addslashes($_POST['pdetails']) . "', price = " . $_POST['pprice'] . 
					//	", active = '" . $_POST['active'] . "', mat = '" . $_POST['mat'] . 
			//			"', featured = '" . $_POST['featured'] . "', onsale = '" . $_POST['onsale'] . 
				//		"', saleprice = " . $_POST['saleprice'] . ", retailprice = " . $_POST['retailprice'];
		
        //$pupdsql = mysql_real_escape_string($pupdsql);
		$sqlres = mysql_query($pupdsql);
		if ($sqlres) {
			$dbmsg = 'record updated<br>';
		} else {
			$dbmsg = 'record not updated - contact your friendly programmer' . $pupdsql;
		}
	} else {
		$id=$_GET['id'];	
	}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<LINK REL=StyleSheet HREF="style.css" TYPE="text/css" MEDIA=screen>
</head>


<body>

<div style="width: 600px; margin: 20px 0 100px 160px;font: 10pt/12pt arial, tahoma;">

<?php 
	if ($dbmsg) {
		echo $dbmsg; 
	}
?>

<?php

					$dataquery = "select * FROM fbregistrations f 
						where f.id=" . $id . 
						" order by f.date asc";
                    //$dataquery = mysql_real_escape_string($dataquery);
					$sql = mysql_query($dataquery);
					while($row = mysql_fetch_array($sql)){ 
						echo '<a href="ad_esmmain.php?i=ad_fbcampreglist.php&id=' . $row['campid'] . '">Return to Registration Listing</a>';
							echo '<br><br>Camper\'s Name: ' .  $row['campername'] . '<br>';
							echo 'Date: ' .  $row['date'] . '<br>';
							echo 'Age: ' .  $row['age'] . '<br>';
							echo 'Street: ' .  $row['street'] . '<br>';
							echo 'City: ' .  $row['city'] . '<br>';
							echo 'State: ' .  $row['state'] . '<br>';
							echo 'Zip: ' .  $row['zip'] . '<br>';
							echo 'Apt: ' .  $row['apt'] . '<br>';
							echo 'Home Phone: ' .  $row['homephone'] . '<br>';
							echo 'Secondary Phone: ' .  $row['secondaryphone'] . '<br>';
							echo 'Email: ' .  $row['email'] . '<br>';
							echo 'Birthdate: ' .  $row['birthdate'] . '<br>';
							echo 'Payor Name: ' .  $row['payorname'] . '<br>';
							echo 'School Name: ' .  $row['schoolname'] . '<br>';
							echo 'Next Grade: ' .  $row['nextgrade'] . '<br>';
							echo 'Off Position: ' .  $row['offposition'] . '<br>';
							echo 'Def Position: ' .  $row['defposition'] . '<br>';
							echo 'ST Position: ' .  $row['stposition'] . '<br>';
							echo 'Referred by: ' .  $row['referred'] . '<br>';
							echo 'Other: ' .  $row['otherdesc'] . '<br>';
							echo 'Waiver: ' .  $row['waiver'] . '<br>';

				
						echo '<form action="ad_esmmain.php?i=ad_fbcampdetail.php" method="POST" style="font: 9pt/9pt arial, tahoma; margin-left: 5px;">';
						echo '<br><Br>';

						echo 'Paid: <input type="text" name="paid" value="' . $row['paid'] . '"><br>';
						echo 'Payment Date: <input type="text" size="50" name="pmtdate" value="' . $row['pmtdate'] . '"><br><br>';
						
						?>

						<input type="submit" name="submit" value="Save Registration">
						<input type="hidden" name="id" value="<?php echo $row['id']; ?>">

							
					      </form>
<?php
						}
	
?>

</div>
</body>
</html>