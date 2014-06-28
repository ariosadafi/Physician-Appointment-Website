<?php @session_start(); ?>
<div id="menu">
        	<ul>
            	<li class="menuitem"><a href="index.php">Home</a></li>
				
				<?php if(isset($_SESSION['ID'])){ 
					if ($_SESSION['type'] == 1)
					{				
				?>
				<li class="menuitem"><a href="physician.php">Appointment Requests</a></li>
				<li class="menuitem"><a href="physician.php?a">My Busy Times</a></li>
				
				<?php } else if ($_SESSION['type'] == 0) { ?>
				
				<li class="menuitem"><a href="patient.php?a">My Requests</a></li>
				<li class="menuitem"><a href="patient.php">Request a New Appointment</a></li>
				<?php  }?>
				<li class="menuitem"><a href="logoff.php">Log off</a></li>
				
				<?php } else {?>
				<li class="menuitem"><a href="signup.php">Sign up</a></li>
                <li class="menuitem"><a href="login.php">Log in</a></li>
				<?php } ?>
            </ul>
			<div class ="welcome">
			<?php
					
					if(isset($_SESSION['ID']))
					{
						echo "Logged in as:  " . $_SESSION['username'];
					}
			?>
			</div>
</div>
