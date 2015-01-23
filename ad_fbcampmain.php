<?php

	require_once 'cfg.inc';

$dataquery = "select * FROM fbcamp f 
						order by f.date asc";


dbconn();

echo '<div style="margin: 0px auto; width: 100%;">';

echo '<div style="width: 100%; margin: 0 0 0 20px;">';

echo '<div style="float: left; margin-bottom: 30px;">';
	echo '<a href="ad_esmmain.php?i=ad_fbcampadd.php&as=a">Add New Camp</a>';
echo '</div>';

echo '<div style="clear: both; width: 100%;">';
?>
	
	<div style="font: 9pt/9pt arial, tahoma; text-align: left; margin: 30px 0 0 0;">
	<table rules="rows" cellspacing="20" border="0">
	
	<tr><td width="40"><b>ID</b></font></td>
	<td width="100"><b>Date</b></font></td>
	<td width="240"><b>Title</b></font></td>
	<td width="80"><b>Active</b></font></td>
	<td><b>&nbsp;  </b></font></td>
	<td><b>&nbsp; </b></font></td>
	</tr>

<?php
//$dataquery = mysql_real_escape_string($dataquery);
$sql = mysql_query($dataquery);
$i = 0;
while($row = mysql_fetch_array($sql)){ 
		echo "<tr>";
    // Build your formatted results here. 
    echo '<td>', $row['id'];
    echo '<td>' . $row['date'] . '</td>' . "\n";
    echo '<td>' . 	substr($row['title'], 0, 30), '</a></td>', "\n";
    echo '<td>', $row['active'] .'</td>', "\n";
    echo '<td width="80"><a href="ad_esmmain.php?i=ad_fbcampreglist.php&id=' . $row['id'] . '">Reg List</td>';
    echo '<td><a href="ad_esmmain.php?i=ad_fbcampmtopt.php&id=' . $row['id'] . '">Add Payment Options</td>';
    echo '</tr>';
} 

echo '</table>','</div>';


?>

	
</div>
</div>

