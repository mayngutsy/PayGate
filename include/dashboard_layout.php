<?php 
//sub_services table
class sub_services_table{

	var $disco_table,
	 	$network_table,
		$tv_table,
		$flight_table,
	 	$event_table,
	 	$movie_table,
	 	$education_table;

	/**
	 * Receive service date and pass it to the init();
	 *@param service
	 *@param
	 */ 	
	public function __construct(){}

	public function set_disco_table($row, $id, $sub_service, $service="", $service_id=""){
		$content_array = array($row["disco_name"]);
		$a ="<tr>";
		$a .= "<td>".$row["disco_name"]."</td><td>".$row["state_1"]."</td><td>".$row["state_2"]."</td>
					<td>".$row["state_3"]."</td>
					<td>".$row["state_4"]."</td>
					<td>".$row["state_5"]."</td>
					<td>".$row["licence"]."</td>";

		$a .= "<td>";
		$a .= form_start("sub_serv_edit.php");
		$a .= form_button_hidden("disco_id", $id);
		$a .= form_button_hidden("sub_service", $sub_service);
		$a .= form_button_hidden("service", $service);
		$a .= form_button_hidden("service_id", $service_id);
		$a .= form_button("submit", "edit_disco", "Edit");
		$a .= form_button("submit", "delete_disco", "Delete");
		$a .= end_form();
		$a .= "</td>";

		$a .= "</tr>";

		$this->disco_table = $a;
		return $this->disco_table;

	}


	public function set_network_table($row, $id, $sub_service){
		$a ="<tr>";
		$a .= "<td>".$row["network"]."</td>";

		$a .= "<td>";
		$a .= form_start();
		$a .= form_button_hidden("network_id", $id);
		$a .= form_button_hidden("sub_service", $sub_service);
		$a .= form_button("submit", "edit_network", "Edit");
		$a .= form_button("submit", "delete_network", "Delete");
		$a .= end_form();
		$a .= "</td>";

		$a .= "</tr>";

		$this->network_table = $a;
		return $this->network_table;

	}

	public function set_event_table($row, $id, $sub_service){
		$a ="<tr>";
		$a .= "<td>".$row["event"]."</td>";

		$a .= "<td>";
		$a .= form_start();
		$a .= form_button_hidden("event_id", $id);
		$a .= form_button_hidden("sub_service", $sub_service);
		$a .= form_button("submit", "edit_event", "Edit");
		$a .= form_button("submit", "delete_event", "Delete");
		$a .= end_form();
		$a .= "</td>";

		$a .= "</tr>";

		$this->event_table = $a;
		return $this->event_table;

	}

	public function set_movie_table($row, $id, $sub_service){
		$a ="<tr>";
		$a .= "<td>".$row["movie"]."</td>";

		$a .= "<td>";
		$a .= form_start();
		$a .= form_button_hidden("movie_d", $id);
		$a .= form_button_hidden("sub_service", $sub_service);
		$a .= form_button("submit", "edit_movie", "Edit");
		$a .= form_button("submit", "delete_movie", "Delete");
		$a .= end_form();
		$a .= "</td>";

		$a .= "</tr>";

		$this->movie_table = $a;
		return $this->movie_table;

	}

	public function set_flight_table($row, $id,$sub_service){
		$a ="<tr>";
		$a .= "<td>".$row["flight"]."</td>";

		$a .= "<td>";
		$a .= form_start();
		$a .= form_button_hidden("flight_id", $id);
		$a .= form_button_hidden("sub_service", $sub_service);
		$a .= form_button("submit", "edit_flight", "Edit");
		$a .= form_button("submit", "delete_flight", "Delete");
		$a .= end_form();
		$a .= "</td>";

		$a .= "</tr>";

		$this->flight_table = $a;
		return $this->flight_table;

	}

	public function set_tv_table($row, $id, $sub_service){
		$a ="<tr>";
		$a .= "<td>".$row["tv"]."</td>";

		$a .= "<td>";
		$a .= form_start();
		$a .= form_button_hidden("tv_id", $id);
		$a .= form_button_hidden("sub_service", $sub_service);
		$a .= form_button("submit", "edit_tv", "Edit");
		$a .= form_button("submit", "delete_tv", "Delete");
		$a .= end_form();
		$a .= "</td>";

		$a .= "</tr>";

		$this->tv_table = $a;
		return $this->tv_table;

	}

	public function set_education_table($row, $id, $sub_service){
		$a ="<tr>";
		$a .= "<td>".$row["education"]."</td>";

		$a .= "<td>";
		$a .= form_start();
		$a .= form_button_hidden("education_id", $id);
		$a .= form_button_hidden("sub_service", $sub_service);
		$a .= form_button("submit", "edit_education", "Edit");
		$a .= form_button("submit", "delete_education", "Delete");
		$a .= end_form();
		$a .= "</td>";

		$a .= "</tr>";

		$this->education_table = $a;
		return $this->education_table;

	}



} 


// specify column head array that discribes fields of each sub_service to be displayaed
//$sub_services matches table name for sub_service to fetch from
function display_sub_service($sub_services, $column_head_array, $sub_services_id, $service="", $service_id= ""){
	$table_display = new sub_services_table;
	$sth = fetch_all($sub_services);

	$row = $sth->fetch(PDO::FETCH_ASSOC);

	$a = "<div class = \"sub_serv_display\">";
	$a .= "<table border = \"2\">";
	$a .= "<tr>";
	foreach($column_head_array as $column_head){
	$a .= "<td>$column_head</td>";}
	$a .= "</tr>";

	do{	
		$id = $row[$sub_services_id];

		if($sub_services == "discos"){
			$sub_service = $row["disco_name"];
			$a .= $table_display->set_disco_table($row, $id, $sub_service, $service, $service_id);
		}
		if($sub_services == "network"){
			$sub_service = $row["network_name"];
			$a .= $table_display->set_network_table($row, $id, $sub_service);
		}
		if($sub_services == "event"){
			$sub_service = $row["event_name"];
			$a .= $table_display->set_event_table($row, $id, $sub_service);
		}
		if($sub_services == "movie"){
			$sub_service = $row["movie_name"];
			$a .= $table_display->set_movie_table($row, $id, $sub_service);
		}
		if($sub_services == "tv"){
			$sub_service = $row["tv_name"];
			$a .= $table_display->set_tv_table($row, $id, $sub_service);
		}
		if($sub_services == "flight"){
			$sub_service = $row["flight_name"];
			$a .= $table_display->set_flight_table($row, $id, $sub_service);
		}
		if($sub_services == "education"){
			$sub_service = $row["education_name"];
			$a .= $table_display->set_education_table($row, $id, $sub_service);
		}
	}while($row = $sth->fetch(PDO::FETCH_ASSOC));
	$a .= "<table>";
	$a .= "</div>";
	content($a);
}


function do_disco_input_form($service_id, $service, $input_form_name="", $value ="" ){
	$service_id = $_REQUEST[$service_id];
	$service = $_REQUEST[$service];

	//get services url

	/**
	 * $service_from_edit passes the service name from sub_serv_update_request function: location; sub_serv_edit.php
	 *  $service_id_from_edit passes the service_id  from sub_serv_update_request function: location; sub_serv_edit.php
	 */
	global $service_from_edit;
	global $service_id_from_edit;
	if(isset($_GET["service"])){$url_service = $_GET["service"] ;}else{$url_service = $service_from_edit;}
	if(isset($_GET["id"])){$url_id = $_GET["id"]; }else{$url_id = $service_id_from_edit;}
	

	//input_error is used to request error from sub_serv_edit.php error url on redirect 
	if(isset($_REQUEST["input_error"])){
		error_message("Failed! Add at least two or more fields");
	}
		//get the services_id for action list url
	$sth = fetch_from_id("pg_services", "services_id", $service_id);
	$row =$sth->fetch(PDO::FETCH_ASSOC);

	if($service_id == $row["services_id"] ){
	//action list assoc url array
		action_list(array("Delete Electricity"=>"serv_edit.php?id=".urlencode($service_id)."&action=".urlencode("delete_service"),
						"Edit Electricity"=>"serv_edit.php?id=".urlencode($service_id)."&action=".urlencode("edit_service") ));

	}

	//pass in column head array to be used for disco
	$disco_column_head = array("Disco", "State 1", "State 2", "State 3", "State 4", "State 5", "licence", "Action");
	
	disco_input_form($service_id, $service, $input_form_name, $value);
	display_sub_service("discos", $disco_column_head, "disco_id", $url_service, $url_id);
	page();

}

function do_network_input_form($service_id, $service, $input_form_name="", $value =""){
	$service_id = $_REQUEST[$service_id];
	$service = $_REQUEST[$service];

	//input_error is used to request error from sub_serv_edit.php  
	if(isset($_REQUEST["input_error"])){
		error_message("Failed! Add at least one network");
	}

	//get the services_id for action list url
	$sth = fetch_from_id("pg_services", "services_id", $service_id);
	$row =$sth->fetch(PDO::FETCH_ASSOC);

	if($service_id == $row["services_id"] ){
		//action list assoc url array
		action_list(array("Delete Network"=>"serv_edit.php?id=".urlencode($service_id)."&action=".urlencode("delete_service"),
							"Edit Network"=>"serv_edit.php?id=".urlencode($service_id)."&action=".urlencode("edit_service") ));
	}
	$network_column_head = array("Networks", "Action");

	network_input_form($service_id,$service, $input_form_name, "Add");
	display_sub_service("network", $network_column_head, "network_id");
	page();

}

function do_event_input_form($service_id, $service , $input_form_name="", $value =""){
	$service_id = $_REQUEST[$service_id];
	$service = $_REQUEST[$service ];

	//input_error is used to request error from sub_serv_edit.php  
	if(isset($_REQUEST["input_error"])){
		error_message("Failed! Add at least two or more fields");
	}

	//get the services_id for action list url
	$sth = fetch_from_id("pg_services", "services_id", $service_id);
	$row =$sth->fetch(PDO::FETCH_ASSOC);

	if($service_id == $row["services_id"] ){
		action_list(array("Delete Event"=>"serv_edit.php?id=".urlencode($service_id)."&action=".urlencode("delete_service"),
							"Edit Event"=>"serv_edit.php?id=".urlencode($service_id)."&action=".urlencode("edit_service") ));
	}

	$network_column_head = array("Event", "Date", "Time", "Location", "Tickets", "Action");

	event_input_form($service_id,$service, $input_form_name, "Add");
	display_sub_service("event", $network_column_head, "event_id");
	page();

}

function do_movie_input_form($service_id, $service, $input_form_name="", $value =""){
	$service_id = $_REQUEST[$service_id];
	$service = $_REQUEST[$service];

	//input_error is used to request error from sub_serv_edit.php  
	if(isset($_REQUEST["input_error"])){
		error_message("Failed! Add at least two or more fields");
	}

	//get the services_id for action list url
	$sth = fetch_from_id("pg_services", "services_id", $service_id);
	$row =$sth->fetch(PDO::FETCH_ASSOC);

	if($service_id == $row["services_id"] ){
		action_list(array("Delete Movie"=>"serv_edit.php?id=".urlencode($service_id)."&action=".urlencode("delete_service"),
							"Edit Movie"=>"serv_edit.php?id=".urlencode($service_id)."&action=".urlencode("edit_service") ));
	}

	$network_column_head = array("Movie", "Title", "Date", "Time", "Tickets", "Cinema", "Action");

	movie_input_form($service_id,$service, $input_form_name, "Add");
	display_sub_service("movie", $network_column_head, "movie_id");
	page();
	

}

function do_tv_input_form($service_id, $service, $input_form_name="", $value =""){
	$service_id = $_REQUEST[$service_id];
	$service = $_REQUEST[$service];

	//input_error is used to request error from sub_serv_edit.php  
	if(isset($_REQUEST["input_error"])){
		error_message("Failed! Add at least two or more fields");
	}

	//get the services_id for action list url
	$sth = fetch_from_id("pg_services", "services_id", $service_id);
	$row =$sth->fetch(PDO::FETCH_ASSOC);

	if($service_id == $row["services_id"] ){
		action_list(array("Delete Tv"=>"serv_edit.php?id=".urlencode($service_id)."&action=".urlencode("delete_service"),
							"Edit Tv"=>"serv_edit.php?id=".urlencode($service_id)."&action=".urlencode("edit_service") ));
	}

	//this column head are subject to change as wwe get more info on this servic
	$network_column_head = array("Tv", "NetK Orientation", "Country", "Time", "Tickets", "Action");

	tv_input_form($service_id,$service, $input_form_name, "Add");
	display_sub_service("tv", $network_column_head, "tv_id");
	page();

}

function do_flight_input_form($service_id, $service, $input_form_name="", $value =""){
	$service_id = $_REQUEST[$service_id];
	$service = $_REQUEST[$service];

	//input_error is used to request error from sub_serv_edit.php  
	if(isset($_REQUEST["input_error"])){
		error_message("Failed! Add at least two or more fields");
	}

	//get the services_id for action list url
	$sth = fetch_from_id("pg_services", "services_id", $service_id);
	$row =$sth->fetch(PDO::FETCH_ASSOC);

	if($service_id == $row["services_id"] ){
		action_list(array("Delete flight"=>"serv_edit.php?id=".urlencode($service_id)."&action=".urlencode("delete_service"),
							"Edit flight"=>"serv_edit.php?id=".urlencode($service_id)."&action=".urlencode("edit_service") ));
	}

	//this column head are subject to change as wwe get more info on this servic
	$network_column_head = array("flight", "Orientation", "Country", "Time", "Tickets", "Action");

	flight_input_form($service_id, $service, $input_form_name, "Add");
	display_sub_service("flight", $network_column_head, "flight_id");
	page();
	
}

function do_education_input_form($service_id, $service, $input_form_name="", $value =""){
	$service_id = $_REQUEST[$service_id];
	$service = $_REQUEST[$service];

	//input_error is used to request error from sub_serv_edit.php  
	if(isset($_REQUEST["input_error"])){
		error_message("Failed! Add at least two or more fields");
	}

	//get the services_id for action list url
	$sth = fetch_from_id("pg_services", "services_id", $service_id);
	$row =$sth->fetch(PDO::FETCH_ASSOC);

	if($service_id == $row["services_id"] ){
		action_list(array("Delete Education"=>"serv_edit.php?id=".urlencode($service_id)."&action=".urlencode("delete_service"),
							"Edit Education"=>"serv_edit.php?id=".urlencode($service_id)."&action=".urlencode("edit_service") ));
	}
	//this column head are subject to change as we get more info on this service
	$network_column_head = array("flight", "NetK Orientation", "Country", "Time", "Tickets", "Action");

	education_input_form($service_id, $service, $input_form_name, "Add");
	display_sub_service("Education", $network_column_head, "Education_id");
	page();

}

// input forms
function disco_input_form($id, $service, $submit_name, $value, $edit_context=""){
	global $PAY;
	global $head_message; // creates a meassage from delete cancelled

	if($head_message)$head = $head_message;else $head = "Add";
	// form starts here
	$a =start_div("disco");	
	$a .=form_head( $head. " Discos");
	$a .=form_start("sub_serv_edit.php");
	$a .= "<table id = \"disco_form\">";
	$a .= "<tr><td><p class = \"form_field\">Disco</p></td><td>".form_input_text("disco_name", $edit_context)."</td></tr>\n";
	$a .= "<tr><td><p class = \"form_field\">State 1</p></td><td>".form_input_text("state_1", $edit_context)."</td></tr>\n";
	$a .= "<tr><td><p class = \"form_field\">State 2</p></td><td>".form_input_text("state_2", $edit_context)."</td></tr>\n";
	$a .= "<tr><td><p class = \"form_field\">State 3</p></td><td>".form_input_text("state_3", $edit_context)."</td></tr>\n";
	$a .= "<tr><td><p class = \"form_field\">State 4</p></td><td>".form_input_text("state_4", $edit_context)."</td></tr>\n";
	$a .= "<tr><td><p class = \"form_field\">State 5</p></td><td>".form_input_text("state_5", $edit_context)."</td></tr>\n";
	$a .= "<tr><td><p class = \"form_field\">Licence</p></td><td>".form_input_text("licence",$edit_context)."</td></tr>\n";
	$a .= "<tr><td>" . form_button_hidden("service_id", $id) . "</td></tr>";
	$a .= "<tr><td>" . form_button_hidden("service", $service) . "</td></tr>";
	$a .= "<tr><td>" .form_button("submit", $submit_name, $value) . "</td></tr>";
	$a .= "</table>";
	$a .=end_form();

	//started an add field form 
	$a .=form_start();
	$a .= "<table>";
	$a .= "<tr><td>".form_button("button", "add_field","Add field") . "</td></tr>";
	$a .= "</table>";
	$a .=end_form();
	$a .=end_div();
	content($a);

	
}

function network_input_form($id, $service, $submit_name, $value){
	global $PAY;	
		$a =start_div("network");	
		$a .=form_head("Add Networks");
		$a .=form_start("sub_serv_edit.php");
		$a .= "<table id = form_table>";	
		$a .= "<tr><td><p class = \"form_field\">Network Name</p></td><td>".form_input_text("network")."</td></tr>\n";
		$a .= "<tr><td>". form_button_hidden("id", $id) ."</td></tr>\n";
		$a .= "<tr><td>". form_button_hidden("service", $service) ."</td></tr>\n";
		$a .= "<tr><td>".form_button("submit", $submit_name, $value) . "</td></tr>\n";
		$a .= "</table>";
		$a .=end_form();
		$a .=end_div();
		content($a);
}

function tv_input_form($id, $service, $submit_name, $value){
	global $PAY;	
		$a =start_div("tv");	
		$a .=form_head("Add TVs");
		$a .=form_start("sub_serv_edit.php");
		$a .= "<table id = \"form_table\">";	
		$a .= "<tr><td><p class = \"form_field\">TV</p></td><td>".form_input_text("tv")."</td></tr>\n";
		$a .= "<tr><td>". form_button_hidden("id", $id) ."</td></tr>\n";
		$a .= "<tr><td>". form_button_hidden("service", $service) ."</td></tr>\n";
		$a .= "<tr><td>".form_button("submit", $submit_name, $value) . "</td></tr>\n";
		$a .= "</table>";
		$a .=end_form();
		$a .=end_div();
		content($a);
}	

	
function flight_input_form($id, $service, $submit_name, $value){
	global $PAY;	
		$a =start_div("flight");	
		$a .=form_head("Add Airlines");
		$a .=form_start("sub_serv_edit.php");
		$a .= "<table id = \"form_table\">";	
		$a .= "<tr><td><p class = \"form_field\">Airline</p></td><td>".form_input_text("flight")."</td></tr>\n";
		$a .= "<tr><td><p class = \"form_field\">Departure</p></td><td>".form_input_text("flight")."</td></tr>\n";
		$a .= "<tr><td><p class = \"form_field\">Airline</p></td><td>".form_input_text("flight")."</td></tr>\n";
		$a .= "<tr><td><p class = \"form_field\">Airline</p></td><td>".form_input_text("flight")."</td></tr>\n";
		$a .= "<tr><td>". form_button_hidden("id", $id) ."</td></tr>\n";
		$a .= "<tr><td>". form_button_hidden("service", $service) ."</td></tr>\n";
		$a .= "<tr><td>".form_button("submit", $submit_name, $value) . "</td></tr>\n";
		$a .= "</table>";
		$a .=end_form();
		$a .=end_div();
		content($a);
}	
	

function event_input_form($id, $service, $submit_name, $value){
	global $PAY;	
		$a =start_div("event");	
		$a .=form_head("Add Events");
		$a .=form_start("sub_serv_edit.php");
		$a .= "<table id = \"form_table\">";	
		$a .= "<tr><td><p class = \"form_field\">Events</p></td><td>".form_input_text("event")."</td></tr>\n";
		$a .= "<tr><td><p class = \"form_field\">Time</p></td><td>".form_input_text("event")."</td></tr>\n";
		$a .= "<tr><td><p class = \"form_field\">Date</p></td><td>".form_input_text("event")."</td></tr>\n";
		$a .= "<tr><td><p class = \"form_field\">Ticket</p></td><td>".form_input_text("event")."</td></tr>\n";
		$a .= "<tr><td><p class = \"form_field\">Location</p></td><td>".form_input_text("event")."</td></tr>\n";
		$a .= "<tr><td>". form_button_hidden("id", $id) ."</td></tr>\n";
		$a .= "<tr><td>". form_button_hidden("service", $service) ."</td></tr>\n";
		$a .= "<tr><td>".form_button("submit", $submit_name,$value) . "</td></tr>\n";
		$a .= "</table>";
		$a .=end_form();
		$a .=end_div();
		content($a);
}	

function movie_input_form($id, $service, $submit_name, $value){
	global $PAY;	
		$a =start_div("movies");	
		$a .=form_head("Add Movies");
		$a .=form_start("sub_serv_edit.php");
		$a .= "<table id = \"form_table\">";	
		$a .= "<tr><td><p class = \"form_field\">Movies</p></td><td>".form_input_text("movie")."</td></tr>\n";
		$a .= "<tr><td><p class = \"form_field\">Movies</p></td><td>".form_input_text("movie")."</td></tr>\n";
		$a .= "<tr><td><p class = \"form_field\">Movies</p></td><td>".form_input_text("movie")."</td></tr>\n";
		$a .= "<tr><td><p class = \"form_field\">Movies</p></td><td>".form_input_text("movie")."</td></tr>\n";
		$a .= "<tr><td><p class = \"form_field\">Movies</p></td><td>".form_input_text("movie")."</td></tr>\n";
		$a .= "<tr><td><p class = \"form_field\">Movies</p></td><td>".form_input_text("movie")."</td></tr>\n";
		$a .= "<tr><td>". form_button_hidden("id", $id) ."</td></tr>\n";
		$a .= "<tr><td>". form_button_hidden("service", $service) ."</td></tr>\n";
		$a .= "<tr><td>".form_button("submit", $submit_name, $value) . "</td></tr>\n";
		$a .= "</table>";
		$a .=end_form();
		$a .=end_div();
		content($a);
}	

function education_input_form($id, $service, $submit_name, $value){
	global $PAY;	
		$a =start_div("school");	
		$a .=form_head("Add Schools");
		$a .=form_start("sub_serv_edit.php");
		$a .= "<table id = \"form_table\">";	
		$a .= "<tr><td><p class = \"form_field\">Name of School</p></td><td>".form_input_text("school")."</td></tr>\n";
		$a .= "<tr><td>". form_button_hidden("id", $id) ."</td></tr>\n";
		$a .= "<tr><td>". form_button_hidden("service", $service) ."</td></tr>\n";
		$a .= "<tr><td>".form_button("submit", $submit_name, $value) . "</td></tr>\n";
		$a .= "</table>";
		$a .=end_form();
		$a .=end_div();
		content($a);
}

?>