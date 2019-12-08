
<?php

require_once("constant_file.php");
require_once(ASBPATH ."/include/pg_connection.php");
require_once(ASBPATH ."/include/pg_functions.php");


//page url
//$self_url = $PAY["self_url"] =$_SERVER["SCRIPT_NAME"];
//echo $self_url;
 //service providers array
$tvs = array("DStv", "Gotv", "Star Times",);
$electricity = array("AEDC", "BEDC", "EKEDC", "EEDC", "IBEDC", "IKEDC", "JEDC", "KNEDC", "KEDC", "PHEDC", "YEDC");
$networks = array("MTN","GLO","Airtel", "9mobile" );

$all_providers = array($tvs, $electricity, $networks);

//main services 
$services = array("ELECTRICITY", "NETWORKS", "TVS", "FLIGHT", "MOVIE TICKET", "SCHOOL FEES", "EVENTS");

function lenght_cunter($arr){
 	echo count($arr);

} 
global $PAY;

foreach ($services as $service) {
	$PAY[$service] = "";

	if($service == "ELECTRICITY"){
//echo $service;
		foreach($electricity  as $power){
		$PAY[$service][] = $power;
		//print_r($PAY[$service]);
		}
	}
	if($service == "NETWORKS"){
		foreach($networks as $network){
		$PAY[$service][] = $network;}
	}

	if($service == "TVS"){
		foreach($tvs as $tv){
		$PAY[$service][] = $tv;}
	}

	
}


page_title();

/*function page(){
	set_var();
	global $PAY;

	require_once("main.php");
	require_once("footer.php");
	exit;
}

function display_services(){
	$sth = fetch_all("pg_services");

	$row = $sth->fetch(PDO::FETCH_ASSOC);
	$a ="<ul>" ;
	
	do{
		$a .="<li><a href = \"admin.php?id=" . $row["services_id"]. "&services=".$row["services"]."\">" . $row["services"] . "</a></li>";
	}while(
		$row = $sth->fetch(PDO::FETCH_ASSOC)
	);
	$a .="</ul>";
	pre_content($a);
}
display_services();


function services_input_form(){
	global $PAY;
$a = form_start();
$a .= func();
$a .=form_input_text("text");
$a .=form_button_hidden("id", "id");
$a .=form_button("submit", "submit","Submit");
$a .=end_form();
content($a);
}

//used for adding form fields based on user demand
function to_add_fields(){
	if(isset($_REQUEST[$add_field])){

	}

}*/



function user_sign_up_form(){
	global $PAY;
	if(isset($_GET["action"])&& $_GET["action"]=="register"){
		//$id = $_REQUEST["id"];	
		$a =start_div("user_register");	
		$a .=form_head("Sign Up Here");
		$a .=form_start();
		$a .= "<table>";	
		$a .= "<tr><td><p class = \"form_field\">Username or Email</p></td><td>".form_input_text("username")."</td></tr>";
		$a .= "<tr><td><p class = \"form_field\">Password</p></td><td>".form_input_text("Password")."</td></tr>";
		$a .= "<tr><td>".form_button("submit", "submit","Sing Up") . "</td></tr>";
		//$a .= "<tr>". form_button_hidden("id", $id) ."</tr>";
		$a .= "</table>";
		$a .=end_form();
		$a .=end_div();
		pre_content($a);
	}
}
user_sign_up_form();

function user_login_form(){
	global $PAY;
	if(isset($_GET["action"])&& $_GET["action"]=="log_in"){
		//$id = $_REQUEST["id"];	
		$a =start_div("log_in");	
		$a .=form_head("Log in");
		$a .=form_start();
		$a .= "<table>";	
		$a .= "<tr><td><p class = \"form_field\">Username or Email</p></td><td>".form_input_text("username")."</td></tr>";
		$a .= "<tr><td><p class = \"form_field\">Password</p></td><td>".form_input_text("password")."</td></tr>";
		$a .= "<tr><td><p class = \"form_field\">Phone number</p></td><td>".form_input_text("phone_no")."</td></tr>";
		$a .= "<tr><td>".form_button("submit", "submit","log in") . "</td></tr>";
		//$a .= "<tr>". form_button_hidden("id", $id) ."</tr>";
		$a .= "</table>";
		$a .=end_form();
		$a .=end_div();
		pre_content($a);
	}	
}
user_login_form();

page();

//error("Error message");
	
?> 

