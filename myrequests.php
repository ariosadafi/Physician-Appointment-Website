<h2> Your current appointments </h2>
<?php
connect();

if(isset($_POST['delete']))
{
	$sql = "DELETE FROM appointment WHERE id =". $_POST['delete'];
	$res = mysql_query($sql);
	if ($res)
	{
	?>
	<div id ="message">
			Successfully Deleted.<br><br>
	</div>
	<?php
	header( "refresh:2;url='patient.php?a'" );
	}
}









$sql = "SELECT a.id, u.name, a.date, a.slot, a.status FROM appointment a, users u where a.phID = u.id AND a.paid =".$_SESSION['ID'];
$res = mysql_query($sql);
if ($res)
{
?>
<form action="patient.php?a" method="post">
<table width="650" border="0" cellspacing="2" cellpadding="4">
  <tr>
    <td>Physician</td>
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
			<button type="submit" value="<?php echo $row['id'] ?>" name="delete">Delete</button>
		</td>
  	</tr>
	<?php	
	}
}


?>



</table>
</form>