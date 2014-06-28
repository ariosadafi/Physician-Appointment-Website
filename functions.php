<?php

function connect()
{

		$db = "s196065";
		$link = mysql_connect('localhost', 's196065', 'tersupse');
		if (!$link) {
			die('Could not connect: ' . mysql_error());
		}
		
		$r2 = mysql_select_db($db);

		if (!$r2) {
			echo "Cannot select database\n";
			trigger_error(mysql_error(), E_USER_ERROR); 
		} 		
}

function login($user,$pass)
{
		$query = "SELECT ID, type FROM users WHERE username = '" . $user . "' and password='" . $pass . "'";
		//echo $query;
		$result = mysql_query($query);
		$ret = 0;
		if ($result)
			if($row = mysql_fetch_array($result))
			{
				$_SESSION['username']= $user;
			//	echo $row['type'];
				$_SESSION['type'] = $row['type'];
				
				$_SESSION['ID'] = $row['ID'];
				$_SESSION['timeout'] = time();
				$ret = 1;
			}
		return $ret;	
}
function setBusy($c1,$c2,$c3,$c4,$c5,$c6,$c7)
{
		if(!isset($c1))	$c1 = 0;
		if(!isset($c2))	$c2 = 0;
		if(!isset($c3))	$c3 = 0;
		if(!isset($c4))	$c4 = 0;
		if(!isset($c5))	$c5 = 0;
		if(!isset($c6))	$c6 = 0;
		if(!isset($c7))	$c7 = 0;


		$query = "UPDATE timeslot SET t1 =" . $c1 . ",t2=" . $c2 . ",t3=" . $c3 . ",t4=" . $c4 . ",t5=" . $c5 . ",t6=" . $c6 . ",t7=" . $c7 . " WHERE phID = ". $_SESSION['ID'];
		//echo $query;
		$result = mysql_query($query);
		return $result;
		
		
		//more check here later
		
}

function enumslot($num)
{
	if ($num == 1) $res = "9 ~ 10";
	if ($num == 2) $res = "10 ~ 11";
	if ($num == 3) $res = "11 ~ 12";
	if ($num == 4) $res = "14 ~ 15";
	if ($num == 5) $res = "15 ~ 16";
	if ($num == 6) $res = "16 ~ 17";
	if ($num == 7) $res = "17 ~ 18";
	return $res;
}

function enumstatus($num)
{
	if ($num == 1) $res = "requested";
	if ($num == 2) $res = "confirmed";
	if ($num == 3) $res = "re-assigned";
	if ($num == 4) $res = "refused";
	return $res;
}

?>