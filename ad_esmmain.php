<?php

			session_start();

			if ($_POST['uid']) {
				$_SESSION['username'] = $_POST['uid'];
				$_SESSION['password'] = $_POST['pwd'];
			}
			
include 'cfg.inc';
dbconn();

	$qrylogin = mysql_query("select * from login");
	while($row = mysql_fetch_array($qrylogin)) {
		if (($row['username'] == $_SESSION['username']) and ($row['password'] == $_SESSION['password'])) {
			$auth=true;
		} else {
			$auth=false;
		}
	}

						$page = $_GET['p'];
						$menuitems[]=array(1, "index.php", "Home");
						$menuitems[]=array(2, "ad_fbcampmain.php", "Football Camps"); 
						$menuitems[]=array(3, "ad_bbcampmain.php", "Baseball Camps"); 
						$menuitems[]=array(4, "ad_evschedmain.php", "Event Schedule"); 
						$menuitems[]=array(5, "ad_createalbum.php", "Photo Gallery"); 
						//$menuitems[]=array(6, "ad_addimage.php", "Add Gallery Image"); 
						
	
	
?>					
	

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style.css" rel="stylesheet" type="text/css">

</head>
<body style="text-align: center;">
	
<?php
		if (! $auth) {
			echo 'login failed, please try again<br><a href="http://www.everettsm.com/login.html">Return to login page</a>';
	} else {
	
	?>
	
<div style="width: 900px; margin: 0px auto; padding-bottom: 20px;">
		<div style="width: 900px; text-align: left; border-bottom: 1px solid black;">
				<a href="http://www.everettsm.com"><img src="images/logo_opt2.jpg" border="0"></a>
		</div>
		<div style="float: right; margin: 10px 0 0 0; width: 100%; font: bold 9pt/9pt arial, tahoma;">
			
											<?php
										
										foreach ($menuitems as $menuitem) {
											if ($menuitem['0'] == $page) {
												$curr = 'currmenuitem';
											} else {
												$curr = '';
											}
								
											echo '<div class="menuitem ' . $curr . '"><a href="ad_esmmain.php?p=' . 
												$menuitem['0'] . '">' . $menuitem['2'] . '</a> </div>';
										}
									?>
			
			
			
											</div>

		<div style="float: left; width: 100%; margin-top: 40px; margin-left: 10px; text-align: left;
				font: 9pt/9pt arial, tahoma;">			
<?php		
									if ($_GET['i']) {
										include $_GET['i'];
									} elseif (! $page) {
										include 'ad_fbcampmain.php';
									} else { 
										include $menuitems[$page-1][1];
									}
		
?>

	</div>
	
	<?

	}
?>

<div style="margin: 0 0 100px; 0;">
	&nbsp;
</div>

</div>
</div>

</body>
</html>