<?php 
require_once("constant_file.php");
//require_once("script/pg_script.js");
require_once(ASBPATH ."/include/pg_connection.php");
require_once(ASBPATH ."/include/pg_functions.php");

$message = "";

//insert serivces sql
function insert_services_sql($pg_services){
	global $PAY;
	global $dbh;
	$query = '
	INSERT INTO pg_services(services)
					VALUES (?)';
	$sth = $dbh->prepare($query);
	if($sth)$sth->execute(array($pg_services));
	else $error = $dbh->errorinfo();
	//error_message($error[2]);
	
	redirect("index.php");
}

// service insert request
function service_insert_request(){
	if(isset($_REQUEST["add_services"])){
		if(empty($_POST["services"])){
			error_message("Failed!You can not add empty service field ");
			require("admin.php");
			
			//redirect("admin.php");
		}else{
			$service = $_POST["services"];
			insert_services_sql($service);
		}
			
	}
}
service_insert_request();

//Delete services sql
function delete_services_sql($get){
	global $dbh;
	$query = "DELETE FROM pg_services
			  WHERE services_id = ?";
	$sth = $dbh->prepare($query);
	if($sth)$sth->execute(array($get));
	else $error = $dbh->errorinfo();

	redirect("index.php");
}

function delete_serv_request(){//delete services request
	if(isset($_REQUEST["action"])){
		if($_REQUEST["action"] == "delete_service"){
			$service_id = $_REQUEST["id"];

			delete_services_sql($service_id);
		}
			
	}
}
delete_serv_request();

//edit services sql
function update_service_sql($get, $set_value){
	global $dbh;
	$query = "UPDATE pg_services
			SET services = ?
			WHERE services_id = ?";

	$sth = $dbh->prepare($query);
	if($sth)$sth->execute(array($set_value, $get));
	else $error = $dbh->errorinfo();
	redirect("admin.php");
}

//update request
function update_request(){
	global $PAY;
	if(isset($_REQUEST["action"])){
		if($_REQUEST["action"] == "edit_service"){
			$service_id = $_REQUEST["id"]; 

			$sth = fetch_from_id("pg_services", "services_id", $service_id);
			$row =$sth->fetch(PDO::FETCH_ASSOC);

			do{
				//sets context to edit
				$PAY["edit_context"] = $row["services"];
				//echo $PAY["text_field_value"] = "pass";
			}while($row =$sth->fetch(PDO::FETCH_ASSOC));
			//display input form for edit
			input_form("services", "update_services", "Update Service", "serv_edit.php", "edit_context", "service_update_done",$service_id);
		}
			//update_service_sql($service_id);
		return $service_id;
	}

	
}
update_request();

function confirm_serv_update(){
	if(isset($_REQUEST["update_services"])){
		$service = $_POST["services"];
		$service_id = $_POST["service_update_done"];
		if(empty($_POST["services"])){
				error_message("Failed!You can not add empty service field ");
				require("admin.php");
				
				//redirect("admin.php");
		}else{
				$service = $_POST["services"];
				update_service_sql($service_id, $service);
		}
	
	}
}
confirm_serv_update();

?>