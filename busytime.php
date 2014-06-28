<?php

	connect();
	if (isset($_POST['busy']))	
	{
		if(isset($_POST['c1']))		$c1 = $_POST['c1'];
		else						$c1 = 0;
		if(isset($_POST['c2']))		$c2 = $_POST['c2'];
		else						$c2 = 0;
		if(isset($_POST['c3']))		$c3 = $_POST['c3'];
		else						$c3 = 0;
		if(isset($_POST['c4']))		$c4 = $_POST['c4'];
		else						$c4 = 0;
		if(isset($_POST['c5']))		$c5 = $_POST['c5'];
		else						$c5 = 0;
		if(isset($_POST['c6']))		$c6 = $_POST['c6'];
		else						$c6 = 0;
		if(isset($_POST['c7']))		$c7 = $_POST['c7'];
		else						$c7 = 0;
			
		if (setBusy($c1,$c2,$c3,$c4,$c5,$c6,$c7))
		{
		?>
		<div id ="message">
			Successfully Updated.<br><br>
		</div>
		<?php 
		header( "refresh:2;url='physician.php?a'" );
		}
	}
	
	$query = "SELECT * FROM timeslot WHERE phID = '" . $_SESSION['ID'] . "'";
	//echo $query;
	$result = mysql_query($query);
	if ($result)
	{
		if($row = mysql_fetch_array($result))
		{
			$t1 = $row['t1'];
			$t2 = $row['t2'];
			$t3 = $row['t3'];
			$t4 = $row['t4'];
			$t5 = $row['t5'];
			$t6 = $row['t6'];
			$t7 = $row['t7'];
		}
	}

?>
<h2> Set Busy Time: </h2>
		<form action="physician.php?a" method="post">
		  <p>&nbsp;</p>
		  <table width="650" border="1" cellspacing="2" cellpadding="4" style="text-align:center">
            <tr>
              <td>&nbsp;</td>
              <td><div align="center">9 ~ 10 </div></td>
              <td><div align="center">10 ~ 11 </div></td>
              <td><div align="center">11 ~ 12 </div></td>
              <td><div align="center">14 ~ 15 </div></td>
              <td><div align="center">15 ~ 16 </div></td>
              <td><div align="center">16 ~ 17 </div></td>
              <td><div align="center">17 ~ 18 </div></td>
            </tr>
            <tr>
              <td>Busy?</td>
              <td><div align="center">
                <input type="checkbox" name="c1" value="1" <?php if (isset($t1) && $t1 == 1) echo "checked='checked'" ?>>
              </div></td>
              <td><div align="center">
                <input type="checkbox" name="c2" value="1"<?php if (isset($t2)&& $t2 == 1) echo "checked='checked'" ?>>
              </div></td>
              <td><div align="center">
                <input type="checkbox" name="c3" value="1"<?php if (isset($t3)&& $t3 == 1) echo "checked='checked'" ?>>
              </div></td>
              <td><div align="center">
                <input type="checkbox" name="c4" value="1"<?php if (isset($t4)&& $t4 == 1) echo "checked='checked'" ?>>
              </div></td>
              <td><div align="center">
                <input type="checkbox" name="c5" value="1"<?php if (isset($t5)&& $t5 == 1) echo "checked='checked'" ?>>
              </div></td>
              <td><div align="center">
                <input type="checkbox" name="c6" value="1"<?php if (isset($t6)&& $t6 == 1) echo "checked='checked'" ?>>
              </div></td>
              <td><div align="center">
                <input type="checkbox" name="c7" value="1"<?php if (isset($t7)&& $t7 == 1) echo "checked='checked'" ?>>
              </div></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><div align="center"></div></td>
              <td><div align="center"></div></td>
              <td><div align="center"></div></td>
              <td><div align="center"></div></td>
              <td><div align="center"></div></td>
              <td><div align="center"></div></td>
              <td><div align="right">
                <input name="busy" type="submit" id="Submit" value="Done" />
              </div></td>
            </tr>
          </table>
		  <p><br />
	      </p>
		  <p>&nbsp;</p>
		</form>