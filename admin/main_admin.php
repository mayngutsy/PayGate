	<body> 
		<div>
			<div class = "header">PayGate</div>
			<div>header image comes here</div>
			<div><?php echo $PAY["ERROR"];?> </div>
			<div><a href = "">Your Profile</a></div>
			<div class = "sign_in"><a href= "paygate.php?action=log_in">Log in</a></div>
			<div class = "register"><a href= "paygate.php?action=register">Register</a></div>
		</div>

		<div id="manu_wrap">
			<div>
				<P>Select Services to edit</p>
				<?php display_services("pg_services");?>
				<span><?php input_form("services", "add_services","Add Services", "serv_edit.php"); ?></span>
			</div>
			<div><?php  echo $PAY["MESSAGE"]; echo $PAY["PRECONTENT"];?></div>
	
	
			<div id= "services"><?php echo $PAY["CONTENT"]?></div>
		
		
		</div>

		
		
<!-- payment form for user preference. Form displays based on user selection -->
		<div id="payment_form">
			<div id = "diplay_payment_form"></div>
		</div>
			
			
			</ul>
			
		</div>
