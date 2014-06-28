

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<title>  </title>

</head>

<body>

<div id="container">

	<?php include 'header.php' ?>
	<?php include 'menu.php' ?>
	<?php include 'functions.php' ?>
	
	<div id="content">
		<?php
		
			if(!isset($_SESSION['type']))
			{
				echo "<div id ='message'>";		  					
				echo "You are not logged in.....<br /> ";								
				echo "Please login, redirecting now....<br />";
				header("refresh:2;url='login.php'" );											
				echo "</div>";
			}
			else if ($_SESSION['type'] != 1)
			{
				echo "<div id ='message'>";		  					
				echo "You are not allowed to view this material.....<br /> ";								
				echo "Redirecting now....<br />";
				header("refresh:2;url='patient.php'" );											
				echo "</div>";
			}
			else
			{
			
		
			
		
		?>
		
		
		
		<?php 
				if (isset($_GET['a']))
				{
					include 'busytime.php';
				}	
				else
				
		
		include 'apprequests.php'
		 ?>

	
	
	
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		
		<?php } //end of else ?>
  </div>
	<?php include 'footer.php' ?>
   </div>
</body>
</html>
