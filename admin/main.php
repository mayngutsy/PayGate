<!doctype html>
<html>
	<head>
		<meta charset = "utf-8"/>
		<link rel="stylesheet" href=""/>
		<link rel="stylesheet" href=""/>
		<link rel="stylesheet" href=""/>
		<title><?php echo $PAY["TITLE"] ?></title>
		
	</head>
	<body> 
		<div id="manu_wrap">
			<?php 
			action_list_on_main(array("Home"=>"serv_edit.php?id=".urlencode("")."&action=".urlencode("delete_service"),
						"Products"=>"serv_edit.php?id=".urlencode("")."&action=".urlencode("edit_service"),
						"Services"=>"serv_edit.php?id=".urlencode("")."&action=".urlencode("edit_service"),
						"About"=>"serv_edit.php?id=".urlencode("")."&action=".urlencode("edit_service"),
						"Help"=>"serv_edit.php?id=".urlencode("")."&action=".urlencode("edit_service"),)); ?>

		</div>

		<div class = "header" name = "header">
			<header class = "header"><p>PayGate</p>
				<div id = "profile">
					<div><a href = "">Your Profile</a></div>
					<div class = "sign_up"><a href =<?php echo "paygate.php?action=log_in"?>>Log in</a></div>
					<div class = "sign_up"><a href =<?php echo "paygate.php?action=register"?>>Register</a></div>
				</div>
			</header>
		</div>

		<div id="" class= "content_wrap">
				<p>Pay for</p>
				<div><?php echo $PAY["PRECONTENT"];?></div>
				<div><?php  echo $PAY["CONTENT"]; ?></div>
				<div><?php echo $PAY["POSTCONTENT"];?></div>
		</div>
		
<!-- payment form for user preference. Form displays based on user selection -->
		<div id="payment_form">
			<div id = "display_payment_form"></div>
		</div>
			
			
			</ul>
			
		</div>

