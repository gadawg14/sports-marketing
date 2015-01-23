<?php

	require_once 'cfg.inc';
	dbconn();

	if ($_POST['delsubm']) {
				$delquery = "delete from bbregistrations where id=" . $_POST['id'] ;
				//echo $delquery;
                //$delquery = mysql_real_escape_string($delquery);
				$delres = mysql_query($delquery);
				if ($delres) {
						$justdel = 1;
				} else {
						$justdel = 0;
				}		
	}





?>

<div style="float: left; width: 10%; height: 100px;">
</div>


<div id="abrightcol">

     <div style="width: 100%; padding: 10px 0 10px 0; margin-top: 0px; text-align: left; border-left: 3px solid #efeff0; 
   	border-right: 3px solid #efeff0;  background-color: #f6f6f6;">
        <div style="text-align: left; color: #000000; padding: 0 0px 0 0px; width: 640px;">

<?php
		
		if ($justdel==1) {
				echo '<div style="margin: 10px;">';
				echo '<div style="text-align: center;">Registration Deleted</div><br>';
				echo '</div>';
		} else {

					$dataquery = "select * FROM bbregistrations f 
						where f.id=" . $_GET['id'];
                    //$dataquery = mysql_real_escape_string($dataquery);
					$sql = mysql_query($dataquery);
					while($row = mysql_fetch_array($sql)){ 
						echo '<a href="ad_esmmain.php?i=ad_bbcampreglist.php&id=' . $row['campid'] . '">Return to Registration Listing</a>';
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

		
				
?>

<br><br>
						<form action="ad_esmmain.php?i=ad_bbcampregdelete.php" method="POST">
							<?php
							
								echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
							}
							
							?>
							<input type="submit" name="delsubm" value="Delete this Registration">
				      </form>

<?php

		}
		
		?>
		
	
</div>
</div>
</div>
