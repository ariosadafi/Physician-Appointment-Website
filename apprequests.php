<h2> Your patient appointments: </h2>
<?php

connect();

if (isset($_POST['approve']))
{
	
	$sql = "UPDATE appointment SET status = 2 WHERE id=". $_POST['approve'];
	$res = mysql_query($sql);
	if($res)
	{
	?>
	<div id ="message">
			Successfully Approved.<br><br>
	</div>
	<?php
	header( "refresh:2;url='physician.php'" );
	}
}
else if (isset($_POST['refuse']))
{
//	mysql_query("BEGIN");
	$sql = "SELECT slot,status FROM appointment WHERE id = " . $_POST['refuse'];
	$row = mysql_fetch_array(mysql_query($sql));
	$slot = $row['slot'];
	
	if($row['status'] == 1)
	{
		
		$i = 1;
		$found = 0;
		$phid = -1;
		$query = "SELECT phID FROM timeslot WHERE t". $slot . " = 0 AND phID <> ". $_SESSION['ID'];
		$result = mysql_fetch_array(mysql_query($query));
		if ($result)
		{
			$found = $slot;
			$phid = $result['phID'];
		}	
		while ($i < 7 && $found == 0)
		{
			$right = $slot + $i;
			$left = $slot - $i;
			if ($right <= 7)
			{
				$query = "SELECT phID FROM timeslot WHERE t". $right . " = 0 AND phID <> ". $_SESSION['ID'];
				$result = mysql_fetch_array(mysql_query($query));
				if ($result)
				{
					$found = $right;
					$phid = $result['phID'];
				}
			}
			if ($left > 0)
			{
				$query = "SELECT phID FROM timeslot WHERE t". $left . " = 0 AND phID <> ". $_SESSION['ID'];
				$result = mysql_fetch_array(mysql_query($query));
				if ($result)
				{
					$found = $left;
					$phid = $result['phID'];
				}
			}
			
			$i = $i + 1;
		}
		
		if ($found != 0)
		{
			$sql = "UPDATE appointment SET status = 3, phid = ".  $phid ." WHERE id= ". $_POST['refuse'];	
			$res = mysql_query($sql);
			if ($res)
			{
			?>
			<div id ="message">
				Successfully Rejected and re-assigned.<br><br>
			</div>
			<?php
				header( "refresh:2;url='physician.php'" );
			}
		}
//		mysql_query("COMMIT");
			
	}
	else if ($row['status'] == 3)
	{
		$sql = "UPDATE appointment SET status = 4 WHERE id=". $_POST['refuse'];
		$res = mysql_query($sql);
		if($res)
		{
		?>
		<div id ="message">
				Successfully Refused.<br><br>
		</div>
		<?php
			header( "refresh:2;url='physician.php'" );
		}
	}
}



$sql = "SELECT u.name, a.date, a.status, a.slot, a.id FROM appointment a, users u WHERE u.id = a.paid AND a.phid = " . $_SESSION['ID'];
$res = mysql_query($sql);
if ($res)
{
?>
<form action="" method="post">
<table width="650" border="0" cellspacing="2" cellpadding="4" border="1">
  <tr>
    <td>Patient</td>
    <td>Date</td>
    <td>Time</td>
    <td>Status</td>
    <td>&nbsp;</td>
  </tr>
<?php 
	while($row = mysql_fetch_array($res))
	{
	?>
	<tr>
		<td><?php echo $row['name']?></td>
		<td><?php echo $row['date']?></td>
		<td><?php echo enumslot($row['slot'])?></td>
		<td><?php echo enumstatus($row['status'])?></td>
		<td>
		<?php if ($row['status'] == 3 || $row['status'] == 1){ ?>
			<button type="submit" value="<?php echo $row['id'] ?>" name="approve">Approve</button>
			<button type="submit" value="<?php echo $row['id'] ?>" name="refuse">Refuse</button>
		<?php } ?>
		</td>
  	</tr>
	<?php	
	}
}

?>
</table>
</form>
