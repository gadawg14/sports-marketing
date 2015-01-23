<h3>Event Schedule Maintenance</h3><br><br>
<?php

	require_once 'cfg.inc';

$dataquery = "select * FROM esmupcoming order by date desc";


dbconn();

echo '<div style="margin: 0px auto; width: 900px;">';

echo '<div style="width: 100%;">';

echo '<div style="float: left; margin-bottom: 20px;">';
	echo '<a href="ad_esmmain.php?i=ad_evsched.php&as=a">Add New Event</a>';
echo '</div>';

echo '<div style="clear: both; width: 100%;">';
?>
	
	<div style="font-size: 90%; text-align: left; margin-top: 10px;" align="center">
	<table rules="rows" cellspacing="0" border="0">
	
	<tr><td width="25"><b>ID</b></font></td>
	<td width="50"><b>Date</b></font></td>
	<td width="100"><b>Location</b></font></td>
	<td width="100"><b>Link Title</b></font></td>
	<td width="100"><b>Link</b></font></td>
	<td width="50"><b>Active</b></font></td>

	</tr>

<?php

//$dataquery = mysql_real_escape_string($dataquery);
$sql = mysql_query($dataquery);
$i = 0;
while($row = mysql_fetch_array($sql)){ 
		echo "<tr>";
    // Build your formatted results here. 
    echo '<td width=25>', $row['id'];
    echo '<td width=100>' . $row['date'] . '</td>' . "\n";
    echo '<td width=200>', '<a href="ad_esmmain.php?i=ad_evsched.php&evid=' . $row['id'] . '">' . 
    	substr($row['location'], 0, 30), '</a></td>', "\n";
    echo '<td width=100>', $row['linktitle'] .'</td>', "\n";
    echo '<td width=200>', $row['link'] .'</td>', "\n";
    echo '<td width=100>', $row['active'] .'</td>', "\n";
    echo '</tr>';
} 

echo '</table>','</div>';


?>

	
</div>
</div>

