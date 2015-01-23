<?php

	require_once 'cfg.inc';

dbconn();

$ctitlequery = "select * FROM fbcamp f 
						where f.id=" . $_GET['id'];

//$ctitlequery = mysql_real_escape_string($ctitlequery);
$ctitlesql = mysql_query($ctitlequery);
while($ctrow = mysql_fetch_array($ctitlesql)){ 
	$camptitle= $ctrow['date'] . ' : ' . $ctrow['location'];	
}
	

$dataquery = "select * FROM fbregistrations f 
						where f.campid=" . $_GET['id'] . 
						" order by f.date asc";


echo '<div style="margin: 2px; width: 700px;">';

echo '<div style="width: 100%; margin: 0 0 100px 10px;">';


echo '<div style="clear: both; width: 100%;">';
?>
	
	<div style="font: 9pt/9pt arial, tahoma; text-align: left; margin: 30px 0 0 0;">

	<?php
		echo '<b><span style="font: 12pt/12pt arial, tahoma;">' . $camptitle . '</span></b><br><br>';
		echo '<b>' . $campdetail . '</b><br><br>';		
		
		$sql1 = mysql_query("SELECT count( * ) FROM `fbregistrations` WHERE campid = " . $_GET['id']);
		$totcampers = mysql_result($sql1,0);
		$sql2 = mysql_query("SELECT count( * ) FROM `fbregistrations`WHERE campid = " . $_GET['id'] . " AND paid <> ''");
		$totpaid = mysql_result($sql2,0);
		echo 'Total Registrations: ' . $totcampers . '<br>';
		echo 'Total Paid Registrations: ' . $totpaid . '<br><br>';
		
		
		?>

	<table border="0">
	
	<tr><td width="150" style="border-bottom: 1px solid black;"><b>Reg ID</b></font></td>	
	<td width="100" style="border-bottom: 1px solid black;"><b>Date</b></font></td>
	<td width="200" style="border-bottom: 1px solid black;"><b>Camper</b></font></td>
	<td width="50" style="border-bottom: 1px solid black;"><b>Age</b></font></td>
	<td width="240" style="border-bottom: 1px solid black;"><b>Email</b></font></td>
	<td style="border-bottom: 1px solid black;"><b>Paid</b></font></td>		
	<td style="border-bottom: 1px solid black;"><b>Delete</b></font></td>		
	</tr>

<?php

//$dataquery = mysql_real_escape_string($dataquery);
$sql = mysql_query($dataquery);
while($row = mysql_fetch_array($sql)){ 
		echo "<tr>";
    // Build your formatted results here. 
    echo '<td style="border-bottom: 1px solid black; padding: 5px;">', $row['ppid'];
    echo '<td style="border-bottom: 1px solid black; padding: 5px;">', $row['date'];
    echo '<td style="border-bottom: 1px solid black;"><a style="text-decoration: none;" href="ad_esmmain.php?i=ad_fbcampdetail.php&id=' . $row['id'] . '">' . $row['campername'] . '</td>' . "\n";
    echo '<td style="border-bottom: 1px solid black;">' . $row['age'] .  '</td>', "\n";
    echo '<td style="border-bottom: 1px solid black;">', $row['email'] .'</td>', "\n";
    echo '<td style="border-bottom: 1px solid black;">', $row['paid'] .'</td>', "\n";
    echo '<td style="border-bottom: 1px solid black;">
    	<a href="ad_esmmain.php?i=ad_fbcampregdelete.php&id=', $row['id'] .'">Delete</a></td>', "\n";
        echo '</tr>';
} 

echo '</table>','</div>';


?>

	
</div>
</div>

