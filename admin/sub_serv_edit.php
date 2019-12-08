<?php require_once("constant_file.php");
//require_once("script/pg_script.js");
require_once(ASBPATH ."/include/pg_connection.php");
require_once(ASBPATH ."/include/pg_functions.php");
require_once(ASBPATH ."/include/dashboard_layout.php");

//insert serivces sql class
class insert_sub_serv_sql{

	public function insert_disco_sql($sub_serv_array){
		global $PAY;
		global $dbh;
		$query = '
		INSERT INTO discos (disco_name, state_1, state_2, state_3, state_4, state_5, licence)
						VALUES (?,?,?,?,?,?,?)';
		$sth = $dbh->prepare($query);
		if($sth)$sth->execute(array(@$sub_serv_array["disco_name"], @$sub_serv_array["state_1"], @$sub_serv_array["state_2"], 
									@$sub_serv_array["state_3"], @$sub_serv_array["state_4"], @$sub_serv_array["state_5"], @$sub_serv_array["licence"]));
		else $error = $dbh->errorinfo();
		//error_message($error[2]);
		
	}

	public function insert_network_sql($sub_serv, $sub_serv_array){
		global $PAY;
		global $dbh;
		$query = "
		INSERT INTO $sub_serv(disco name, state1, state2, state3, state4, state5)
						VALUES (?,?,?,?,?,?)";
		$sth = $dbh->prepare($query);
		if($sth)$sth->execute(array($sub_serv_array["disco name"], $sub_serv_array["state1"], $sub_serv_array["state2"], 
									$sub_serv_array["state3"], $sub_serv_array["state4"], $sub_serv_array["state5"],));
		else $error = $dbh->errorinfo();
		//error_message($error[2]);
		
		redirect("admin.php?services=Electricity&id=448");
	}

	public function insert_event_sql($sub_serv, $sub_serv_array){
		global $PAY;
		global $dbh;
		$query = "
		INSERT INTO $sub_serv(disco name, state1, state2, state3, state4, state5)
						VALUES (?,?,?,?,?,?)";
		$sth = $dbh->prepare($query);
		if($sth)$sth->execute(array($sub_serv_array["disco name"], $sub_serv_array["state1"], $sub_serv_array["state2"], 
									$sub_serv_array["state3"], $sub_serv_array["state4"], $sub_serv_array["state5"],));
		else $error = $dbh->errorinfo();
		//error_message($error[2]);
		
		redirect("admin.php?services=Electricity&id=448");
	}

	public function insert_tv_sql($sub_serv, $sub_serv_array){
		global $PAY;
		global $dbh;
		$query = "
		INSERT INTO $sub_serv(disco name, state_1, state_2, state_3, state_4, state_5)
						VALUES (?,?,?,?,?,?)";
		$sth = $dbh->prepare($query);
		if($sth)$sth->execute(array($sub_serv_array["disco name"], $sub_serv_array["state1"], $sub_serv_array["state2"], 
									$sub_serv_array["state3"], $sub_serv_array["state4"], $sub_serv_array["state5"],));
		else $error = $dbh->errorinfo();
		//error_message($error[2]);
		
		redirect("admin.php?services=Electricity&id=448");
	}

	public function insert_movie_sql($sub_serv, $sub_serv_array){
		global $PAY;
		global $dbh;
		$query = "
		INSERT INTO $sub_serv(disco name, state1, state2, state3, state4, state5)
						VALUES (?,?,?,?,?,?)";
		$sth = $dbh->prepare($query);
		if($sth)$sth->execute(array($sub_serv_array["disco name"], $sub_serv_array["state1"], $sub_serv_array["state2"], 
									$sub_serv_array["state3"], $sub_serv_array["state4"], $sub_serv_array["state5"],));
		else $error = $dbh->errorinfo();
		//error_message($error[2]);
		
		redirect("admin.php?services=Electricity&id=448");
	}

	public function insert_education_sql($sub_serv, $sub_serv_array){
		global $PAY;
		global $dbh;
		$query = "
		INSERT INTO $sub_serv(disco name, state1, state2, state3, state4, state5)
						VALUES (?,?,?,?,?,?)";
		$sth = $dbh->prepare($query);
		if($sth)$sth->execute(array($sub_serv_array["disco name"], $sub_serv_array["state1"], $sub_serv_array["state2"], 
									$sub_serv_array["state3"], $sub_serv_array["state4"], $sub_serv_array["state5"],));
		else $error = $dbh->errorinfo();
		//error_message($error[2]);
		
		redirect("admin.php?services=Electricity&id=448");
	}
}

class update_sub_serv_sql{
	//edit update_disco sql
	function update_disco_sql($set_value, $get){
		//echo $set_value["disco_name"];
		global $dbh;
		$query = "UPDATE discos
				SET disco_name = ?,
					state_1 = ?,
				 	state_2 = ?,
				 	state_3 = ?,
					state_4 = ?,
				 	state_5 = ?,
				 	licence = ?
				WHERE disco_id = ?";

		$sth = $dbh->prepare($query);
		if($sth)$sth->execute(array($set_value["disco_name"], $set_value["state_1"], $set_value["state_2"], $set_value["state_3"],
									$set_value["state_4"], $set_value["state_5"], $set_value["licence"], $get));
		$error = $dbh->errorinfo();
	
	}

	function update_network_sql($set_value, $get){
		global $dbh;
		$query = "UPDATE discos
				SET disco_name = ?,
					state_1 = ?,
				 	state_2 = ?,
				 	state_3 = ?,
					state_4 = ?,
				 	state_5 = ?,
				 	licence = ?
				WHERE disco_id = ?";

		$sth = $dbh->prepare($query);
		if($sth)$sth->execute(array($set_value, $get));
		else $error = $dbh->errorinfo();
		return $error;
	}

	function update_movies_sql($get, $set_value){
		global $dbh;
		$query = "UPDATE discos
				SET disco_name = ?,
					state_1 = ?,
				 	state_2 = ?,
				 	state_3 = ?,
					state_4 = ?,
				 	state_5 = ?,
				 	licence = ?
				WHERE disco_id = ?";

		$sth = $dbh->prepare($query);
		if($sth)$sth->execute(array($set_value, $get));
		else $error = $dbh->errorinfo();
		return $error;
	}

	function update_event_sql($get, $set_value){
		global $dbh;
		$query = "UPDATE discos
				SET disco_name = ?,
					state_1 = ?,
				 	state_2 = ?,
				 	state_3 = ?,
					state_4 = ?,
				 	state_5 = ?,
				 	licence = ?
				WHERE disco_id = ?";

		$sth = $dbh->prepare($query);
		if($sth)$sth->execute(array($set_value, $get));
		else $error = $dbh->errorinfo();
		return $error;
	}

	function update_tvs_sql($get, $set_value){
		global $dbh;
		$query = "UPDATE discos
				SET disco_name = ?,
					state_1 = ?,
				 	state_2 = ?,
				 	state_3 = ?,
					state_4 = ?,
				 	state_5 = ?,
				 	licence = ?
				WHERE disco_id = ?";

		$sth = $dbh->prepare($query);
		if($sth)$sth->execute(array($set_value, $get));
		else $error = $dbh->errorinfo();
		return $error;
	}

	function update_flight_sql($get, $set_value){
		global $dbh;
		$query = "UPDATE discos
				SET disco_name = ?,
					state_1 = ?,
				 	state_2 = ?,
				 	state_3 = ?,
					state_4 = ?,
				 	state_5 = ?,
				 	licence = ?
				WHERE disco_id = ?";

		$sth = $dbh->prepare($query);
		if($sth)$sth->execute(array($set_value, $get));
		else $error = $dbh->errorinfo();
		return $error;
	}

	function update_education_sql($get, $set_value){
		global $dbh;
		$query = "UPDATE discos
				SET disco_name = ?,
					state_1 = ?,
				 	state_2 = ?,
				 	state_3 = ?,
					state_4 = ?,
				 	state_5 = ?,
				 	licence = ?
				WHERE disco_id = ?";

		$sth = $dbh->prepare($query);
		if($sth)$sth->execute(array($set_value, $get));
		else $error = $dbh->errorinfo();
		return $error;
	}

}

class delete_sub_serv_sql{
	function delete_disco_sql($get){
		global $dbh;
		$query = " DELETE FROM discos
				WHERE disco_id = ?";
		$sth = $dbh->prepare($query);
		if($sth)$sth->execute(array($get));
		$error = $dbh->errorinfo();
	}

	function delete_network_sql($get){
		global $dbh;
		$query = " DELETE FROM discos
				WHERE disco_id = ?";
		$sth = $dbh->prepare($query);
		if($sth)$sth->execute(array($get));
		$error = $dbh->errorinfo();
	}

	function delete_movie_sql($get){
		global $dbh;
		$query = " DELETE FROM discos
				WHERE disco_id = ?";
		$sth = $dbh->prepare($query);
		if($sth)$sth->execute(array($get));
		$error = $dbh->errorinfo();
	}

	function delete_event_sql($get){
		global $dbh;
		$query = " DELETE FROM discos
				WHERE disco_id = ?";
		$sth = $dbh->prepare($query);
		if($sth)$sth->execute(array($get));
		$error = $dbh->errorinfo();
	}

	function delete_flight_sql($get){
		global $dbh;
		$query = " DELETE FROM discos
				WHERE disco_id = ?";
		$sth = $dbh->prepare($query);
		if($sth)$sth->execute(array($get));
		$error = $dbh->errorinfo();
	}

	function delete_education_sql($get){
		global $dbh;
		$query = " DELETE FROM discos
				WHERE disco_id = ?";
		$sth = $dbh->prepare($query);
		if($sth)$sth->execute(array($get));
		$error = $dbh->errorinfo();
	}


}


//sub service insert request
function sub_service_insert_request(){
	$sub_serv_insert = new insert_sub_serv_sql;
	if(isset($_REQUEST["add_disco"])){
		$service_id = $_REQUEST["service_id"];
		$service = $_REQUEST["service"];
		//error free source url: get you back to wwhere you coming from
		$src_url= "admin.php?service=" . $service ."&id=" . $service_id;
		//source url with error handler
		$error_src_url= "admin.php?service=" . $service ."&id=" . $service_id."&input_error=\"disco_error\"";

		//$collected_field = array();

		if(empty($_POST["disco_name"]) || empty($_POST["state_1"])){
			
			//redirect to source url with error
			redirect($error_src_url);
	 	}

		$required_field_array=array("disco_name", "state_1", "state_2", "state_3", "state_4", "state_5", "licence");
		foreach($required_field_array as $field_name){
				if(isset($_POST[$field_name])){
					$collected_field[$field_name] = $_POST[$field_name];
					

				}
				//redirect($error_src_url);
			//}

			
		}
		
		$sub_serv_insert->insert_disco_sql($collected_field);

		redirect($src_url);
	}
}
sub_service_insert_request();

function sub_serv_update_request(){
	if(isset($_REQUEST["edit_disco"])){
		global $PAY;
		global $disco_fields_array;
		$disco_id = $_REQUEST["disco_id"];
		$sub_service = $_REQUEST["sub_service"];
		//echo $sub_service;

		$sth = fetch_from_id("discos", "disco_id", $disco_id);
		$row =$sth->fetch(PDO::FETCH_ASSOC);

			do{ //the last execution of the loop sets the variables
				foreach($disco_fields_array as $field_name){
					$PAY[$field_name] = $row[$field_name]; 
				}
			}while($row =$sth->fetch(PDO::FETCH_ASSOC));
			//request disco_id and sub_service pased in from set_disco table

		global $service_from_edit;
		global $service_id_from_edit;
		$service_from_edit = $_REQUEST["service"];
		$service_id_from_edit = $_REQUEST["service_id"];

		global $head_message;
		$head_message= "Update";
		//disco_id and sunb_service is set into disco_input_form
		do_disco_input_form("disco_id", "sub_service", "update_disco", "Update");
		
	}
	
}

sub_serv_update_request();



function confirm_sub_serv_update(){
	global $PAY;
	global $disco_fields_array;
	$update_sub_ser = new update_sub_serv_sql;
	if(isset($_REQUEST["update_disco"])){
		//initiat request from disco_input_form
		$disco_id = $_REQUEST["service_id"];
		$service = $_REQUEST["service"];
		
		//$collected_field = array();

		if(empty($_POST["disco_name"]) || empty($_POST["state_1"])){

			$sth = fetch_from_id("discos", "disco_id", $disco_id);
			$row =$sth->fetch(PDO::FETCH_ASSOC);

			do{ //the last execution of the loop sets the variables
				foreach($disco_fields_array as $field_name){
					$PAY[$field_name] = $row[$field_name]; 
				}
			}while($row =$sth->fetch(PDO::FETCH_ASSOC));
				//error message to display
				//request service_id and "service" from disco_input_form
			error_message("Failed! Disco name and state 1 is required");
			do_disco_input_form("service_id", "service", "update_disco", "Update");
	 	}else{

			$required_field_array=array("disco_name", "state_1", "state_2", "state_3", "state_4", "state_5", "licence");
			foreach($required_field_array as $field_name){
					if(isset($_POST[$field_name])){
						$collected_field[$field_name] = $_POST[$field_name];
					}
			}

			$update_sub_ser->update_disco_sql($collected_field, $disco_id);

			$sth = fetch_from_id("discos", "disco_id", $disco_id);
			$row =$sth->fetch(PDO::FETCH_ASSOC);

			do{ //the last execution of the loop sets the variables
				foreach($disco_fields_array as $field_name){
					$PAY[$field_name] = $row[$field_name]; 
				}
			}while($row =$sth->fetch(PDO::FETCH_ASSOC));

			global $head_message;
			$head_message= "Update";

			error_message("Update Successful");
			do_disco_input_form("service_id", "service", "update_disco", "Update");
		}
		
	}
}

confirm_sub_serv_update();

function delete_sub_serv_request(){
	global $PAY;
	global $disco_fields_array;
	$update_sub_serv = new delete_sub_serv_sql;
	if(isset($_REQUEST["delete_disco"])){
		$disco_id = $_REQUEST["disco_id"];
		$sub_service = $_REQUEST["sub_service"];

		//
		$service = $_REQUEST["service"];
		$service_id = $_REQUEST["service_id"];

		// confirm delete form	
		$a =  form_head("Delete Disco");
		$a .= sub_message("Are you sure to delete ".$sub_service);
		$a .= form_start("sub_serv_edit.php");
		$a .= form_button_hidden("delete_id", $disco_id);
		$a .= form_button_hidden("cancel_id", $disco_id);
		$a .= form_button_hidden("sub_service", $sub_service);
		$a .= form_button_hidden("service_id", $service_id);
		$a .= form_button_hidden("service", $service);
		$a .= form_button("submit", "delete_done", "Delete");
		$a .= form_button("submit", "cancel_delete", "Cancel");
		$a .= end_form();
		pre_content($a);
		page();
		
	}

	if(isset($_REQUEST["delete_done"])){
		$delete_id = $_REQUEST["delete_id"];
		$update_sub_serv->delete_disco_sql($delete_id);

		//get service and service id
		$service_id = $_REQUEST["service_id"];
		$service= $_REQUEST["service"];

		// build url for redirect on delete successful
		//redirect to service url
		//error free source url: takes you back to service
		$src_url= "admin.php?service=" . $service ."&id=" . $service_id;
		redirect($src_url);

	}

	if(isset($_REQUEST["cancel_delete"])){
		$cancel_id = $_REQUEST["cancel_id"];
		$sub_service= $_REQUEST["sub_service"];

		$sth = fetch_from_id("discos", "disco_id", $cancel_id);
		$row =$sth->fetch(PDO::FETCH_ASSOC);

		do{ //the last execution of the loop sets the variables
			foreach($disco_fields_array as $field_name){
				$PAY[$field_name] = $row[$field_name]; 
			}
		}while($row =$sth->fetch(PDO::FETCH_ASSOC));

		global $service_from_edit;
		global $service_id_from_edit;
		$service_id_from_edit = $_REQUEST["service_id"];
		$service_from_edit= $_REQUEST["service"];


		global $head_message;
		$head_message= "Update";

		do_disco_input_form("cancel_id", "sub_service", "update_disco", "Update");
	}

}

delete_sub_serv_request();



?>