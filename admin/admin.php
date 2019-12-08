<?php 
require_once("constant_file.php");
//require_once("script/pg_script.js");
require_once(ASBPATH ."/include/pg_connection.php");
require_once(ASBPATH ."/include/pg_functions.php");
require_once(ASBPATH ."/include/dashboard_layout.php");

$tvs = array("DStv", "Gotv", "Star Times",);
$electricity = array("AEDC", "BEDC", "EKEDC", "EEDC", "IBEDC", "IKEDC", "JEDC", "KNEDC", "KEDC", "PHEDC", "YEDC");
$networks = array("MTN","GLO","Airtel", "9mobile" );

$all_providers = array($tvs, $electricity, $networks);

//main services 
$services = array("ELECTRICITY", "NETWORKS", "TVS", "FLIGHT", "MOVIE TICKET", "SCHOOL FEES", "EVENTS");


global $PAY; 

//$self_url = $PAY["self_url"] =$_SERVER["SCRIPT_NAME"];

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

	//$PAY[$service] = $service;
	
}


//$title_pg_admin is used to set diff titles on admin and users page
//set $title_pg_admin = true on admin;

//$title_pg_admin = true;
//page_title();







function form_request(){
	$form = "";
	if(isset($_REQUEST["service"])){
		$form = $_REQUEST["service"];
	}

	switch ($form) {
			case 'Electricity':
				do_disco_input_form("id", "service", "add_disco", "Add");
				break;
			case 'Networks':
				do_network_input_form("id", "service", "add_network", "Add");
				break;
			case 'Tvs':
				do_tv_input_form("id", "service", "add_tv", "Add");
				break;
			case 'Flights':
				do_flight_input_form("id", "service", "add_airline", "Add");
				break;
			case 'Events':
				do_event_input_form("id", "service", "add_events", "Add");
				break;
			case "Movies":
				do_movie_input_form("id", "service", "add_movie", "Add");
				break;
			case 'Education':
				do_education_input_form("id", "service", "add_school", "Add");
				break;
			default:
				page();
				break;
	}
}


global $field;
$field["field"] ="";
$field["field_content"] = "";
/*
function to_add_fields(){
	global $field;
	if(isset($_REQUEST["add_field"])){
		$co = $_REQUEST["add_field"];
		
		$field["field"][]=  "<tr><td><p class = \"form_field\">Licence</p></td><td onClick =\"\">".form_input_text("state 6")."</td></tr>\n";
		foreach($field["field"] as $field_content){
			$field["field_content"] .=$field_content;
		}
			content($field["field_content"]);
		return $field["field_content"];
	}else{
		return "";
	}

}*/







?>