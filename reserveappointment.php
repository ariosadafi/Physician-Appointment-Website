<style type="text/css">
<!--
.style2 {font-size: 12px}
-->
</style>
<h2> Reserve an appointment</h2>

<?php 

		if (isset($_POST['resphy']))
		{
			connect();
			$query = "SELECT id FROM users WHERE name = '". $_POST['phyname']."'";
			$row = mysql_fetch_array(mysql_query($query));
			$phyid = $row['id'];
			$query = "SELECT t1,t2,t3,t4,t5,t6,t7 FROM users u, timeslot ts WHERE u.id = ts.phID AND u.name = '". $_POST['phyname']."'";
			if($row = mysql_fetch_array(mysql_query($query)))
			{
				?>
			<p> Select the date you want to have an appointment:</p>
			<form name="frmReserve" method="post" action="">
			<input type="hidden" name="phyid" value="<?php echo $phyid ?>">
			  <table width="399" border="0" cellspacing="2" cellpadding="4">	
					<tr>
				  <td width="33">Date:</td>
				  <td width="344">(Year / Month / Day ) <br />
                 <input name= "year" type="text" size="20" maxlength="4" style="width:50px;"/>
                 <select name="month">
                   <?php 
				$i=1;
				while ($i<13)
				{
                 echo "<option>" . $i . "</option>";
				 $i = $i+1;
				}
				?>
                 </select>
                 <select name="day">
                   <?php 
				$i=1;
				while ($i<31)
				{
                 echo "<option>" . $i . "</option>";
				 $i = $i+1;
				}
				?>
                 </select></td>
				</tr>
				<tr>
				  <td>Time:</td>
				  <td><select name="slot">
					
					<option value="1" <?php if($row['t1'] == 1) echo "disabled='disabled'" ?>> 9 ~ 10 </option>
					<option value="2" <?php if($row['t2'] == 1) echo "disabled='disabled'" ?>> 10 ~ 11 </option>
					<option value="3" <?php if($row['t3'] == 1) echo "disabled='disabled'" ?>> 11 ~ 12 </option>
					<option value="4" <?php if($row['t4'] == 1) echo "disabled='disabled'" ?>> 14 ~ 15 </option>
					<option value="5" <?php if($row['t5'] == 1) echo "disabled='disabled'" ?>> 15 ~ 16 </option>
					<option value="6" <?php if($row['t6'] == 1) echo "disabled='disabled'" ?>> 16 ~ 17 </option>
					<option value="7" <?php if($row['t7'] == 1) echo "disabled='disabled'" ?>> 17 ~ 18 </option>
					
				  </select>
			      <span class="style2">				  (selected physician is not available on gray times) </span></td>
				</tr>
				<tr>
				  <td>&nbsp;</td>
				  <td><div align="right">
					<input name="resdate" type="submit" id="Submit" value="Go" />
				  </div></td>
				</tr>
			  </table>
			</form>

				
			<?php
			}
		}
		elseif (isset($_POST['resdate']))
		{
		
			$date = $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day'];
			$slot = $_POST['slot'];
			$phyid = $_POST['phyid'];
			
			connect();
//			$query = "SELECT * FROM appointment WHERE date ='". $date . "' AND slot =". $slot. " AND phid =" . $phyid;
// $res = mysql_query($query);
//			if ($res)
//			{
//echo "<div id ='message'>";
//					echo "The Phyisician is not available at the requested time.<br> ";
//					echo "Please try a different time....";
		//			header( "refresh:4;url=patient.php" );
//					echo "</div>";
//
	//		}
	//		exit();
			
			$query = "INSERT INTO appointment (paid, phid, date, status, slot) VALUES (" . $_SESSION['ID'] . "," . $phyid . ",'" . $date . "',1," . $slot . ")";
			
			$res = mysql_query($query);
			if ($res)
			{?>
				
			<div id ="message">
				Your request is successfully received.<br><br>
			</div>
				
				
			<?php 	header( "refresh:2;url='patient.php?'" );}
			else
				trigger_error(mysql_error(), E_USER_ERROR); 
			
			
		
		
		}
		else
		{


?>

  

<p> Select the phyisician you want to have an appointment with: </p>
<form name="frmReserve" method="post" action="">
  <table width="367" border="0" cellspacing="2" cellpadding="4">
    <tr>
      <td width="163">Physician:</td>
      <td width="182">
	  <select name="phyname">
	  <?php
 		connect();
		$query = "SELECT name FROM users WHERE type = 1";
		$result = mysql_query($query);
		while($row = mysql_fetch_array($result))
		{?>
        <option>  <?php echo $row['name']; ?>	</option>
        <?php } ?>
      </select>
      </td>
    </tr>
  
    <tr>
      <td>&nbsp;</td>
      <td><div align="right">
        <input name="resphy" type="submit" id="Submit" value="Go" />
      </div></td>
    </tr>
  </table>
</form>

<?php
}
?>
