<?php
	
	require_once 'cfg.inc';
	dbconn();
	if ($_POST['submit']) {
		
		$gallid=$_POST['id'];
		$updsql = "update photogalleries
			set title = '" . $_POST['title'] . 
			"', seq = " . $_POST['seq'] . 
			" where id = " . $_POST['id'];
			//$updres = mysql_real_escape_string($updres);
			$updres = mysql_query($updsql);
			
			if ($updres) {
				$dbmsg = 'record updated';
			} else {
				$dbmsg = 'record not added - contact your friendly programmer' . $pinssql;
			}
			echo $dbmsg;
	
	} else {
		$gallid = $_GET['id'];	
	}
	
	?>
	
<div style="width: 600px; font: 9pt/9pt arial, tahoma; text-align: left; margin: 30px 0 0 60px;">
		
		<h1>Edit Gallery Details</h1>
		
	<form action="ad_esmmain.php?i=ad_editgallery.php" method="POST">

		<?php
		
			$gallsql = "select * from photogalleries where id=" . $gallid;
            //$gallsql = mysql_real_escape_string($gallsql);
			$gallres = mysql_query($gallsql);
			$gallrow = mysql_fetch_array($gallres);
			echo '<input type="text" name="title" value="' . $gallrow['title'] . '" size="60">';
			echo '<br><br><input type="text" name="seq" value="' . $gallrow['seq'] . '" size="20">';
			echo '<input type="hidden" name="id" value="' . $gallid . '">';

		?>
		
		<br><br>
		<input type="submit" name="submit" value="Save">
	</form>

</div>
