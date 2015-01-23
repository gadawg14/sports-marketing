<h3>Add a Photo Gallery</h3>
<?php

	require_once 'cfg.inc';

	if ($_POST['cralbumsubmit']) {

		$inssql = "insert into photogalleries
			(site, title, seq)
			values
			('esm', '" . $_POST['title'] . "', " . $_POST['seq'] . ")";
			
            //$inssql = mysql_real_escape_string($inssql);
			$sqlres = mysql_query($inssql); 
			if ($sqlres) {
				
				$crdirsql = "select * from photogalleries order by id desc limit 0,1";
                //$crdirsql = mysql_real_escape_string($crdirsql);
				$sqlres = mysql_query($crdirsql);
				while($dirrow = mysql_fetch_array($sqlres)){ 
					mkdir($_SERVER['DOCUMENT_ROOT'] . "/everettsm/images/albums2/" . $dirrow['id']);
					mkdir($_SERVER['DOCUMENT_ROOT'] . "/everettsm/images/albums2/" . $dirrow['id'] . "/thumbs");
					
				}
				
				$dbmsg = 'gallery added';
				
			} else {
				$dbmsg = 'record not updated - contact your friendly programmer' . $evinssql;
			}

			echo $dbmsg;

	}


$dataquery = "select * FROM photogalleries order by id";


dbconn();

echo '<div style="margin: 0px auto; width: 900px;">';

echo '<div style="width: 100%;">';

?>

	<div style="width: 100%; margin-top: 10px;">
		<form name="newalbum" method="POST" action="http://www.everettsm.com/ad_esmmain.php?p=5">
				Gallery Title: <input type="text" name="title" size="60"><br><br>
				Seq: <input type="text" name="seq" size="20"><br>
				<br><br>
				<input type="submit" name="cralbumsubmit" value="Save">
			
		</form>
		
		
	</div>


<div style="clear: both; width: 100%; margin-top: 50px;
		font: 10pt/12pt tahoma, arial;">

	
	<div style="text-align: left; margin-top: 10px;" align="center">
	<table cellspacing="5" cellpadding="5" border="0" rules="rows"
			style="font: .9em georgia, sans-serif; letter-spacing: 1px;">
	
	<td><b>Gallery Name</b></td>
	<td><b>Seq</b></td>
	<td>Gallery Info</td>
	<td>Photo</td>

	</tr>

<?php

//$dataquery = mysql_real_escape_string($dataquery);
$sql = mysql_query($dataquery);
$i = 0;
while($row = mysql_fetch_array($sql)){ 
		echo "<tr>";
    echo '<td width=400>', $row['title'] .'</td>', "\n";
    echo '<td width=40>', $row['seq'] .'</td>', "\n";
    echo '<td width=100 style="font: 10pt/10pt georgia;">
    		<a style="text-decoration: none;" href="http://www.everettsm.com/ad_esmmain.php?i=ad_editgallery.php&id=' . 
    		$row['id'] . '">[Edit]</a>';
    echo '<td width=100 style="font: 10pt/10pt georgia;">
        		<a style="text-decoration: none;" href="http://www.everettsm.com/ad_esmmain.php?i=ad_addimage.php&id=' . 
        		$row['id'] . '">[Add / Edit]</a>';
    echo '</tr>';
} 

echo '</table>','</div>';


?>

	
</div>
</div>

