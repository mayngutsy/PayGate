<?php
//page url
$self_url = $PAY["self_url"] =$_SERVER["SCRIPT_NAME"];

//text field value for input form
$PAY["text_field_value"] = "";

function page_title(){
	global $title_pg_admin;
	global $PAY;
	if($title_pg_admin)$PAY["TITLE"]="PayGate Admin";
	else $PAY["TITLE"] = "PayGate";
}

// head services
function display_services($services){
	$sth = fetch_all($services);

	$row = $sth->fetch(PDO::FETCH_ASSOC);

	$a ="<ul>" ;
	
	do{
		$a .="<li><a href = \"index.php?service=" . urldecode($row["services"]). "&id=".urlencode($row["services_id"])."\">" . $row["services"] . "</a></li>";
	}while(
		$row = $sth->fetch(PDO::FETCH_ASSOC)
	);
	$a .="</ul>";
	echo $a;
}
	//common functions

//varibles to use when setting content body

$content_holders = array("PRECONTENT", "CONTENT", "MESSAGE", "ERROR", "BUTTON", "HIDDEN", "POSTCONTENT");

foreach($content_holders as $v){
	$PAY[$v] = "";
}

$disco_fields_array = array("disco_name", "state_1", "state_2", "state_3", "state_4", "state_5", "licence");
foreach($disco_fields_array as $v){
	$PAY[$v] = "";
}

$network_fields_array = array("network", "tv", "movie","event", "flight", "school");
foreach($network_fields_array as $v){
	$PAY[$v] = "";
}

$service_array = array("services");
foreach($service_array as $v){
	$PAY[$v] = "";
}


function set_var(){
	global $PAY;

	if(isset($PAY["PRE_CONT_ARRAY"]))foreach($PAY["PRE_CONT_ARRAY"] 	as $c)  $PAY["PRECONTENT"] 	.=$c;
	if(isset($PAY["BUTTON_ARRAY"]))foreach($PAY["BUTTON_ARRAY"] 		as $c)  $PAY["BUTTON"] 		.=$c;
	if(isset($PAY["CONT_ARRAY"]))foreach($PAY["CONT_ARRAY"]  			as $c)  $PAY["CONTENT"] 	.=$c;
	if(isset($PAY["HIDDEN_ARRAY"]))foreach($PAY["HIDDEN_ARRAY"]   		as $c)  $PAY["HIDDEN"] 		.=$c;
	if(isset($PAY["ERROR_ARRAY"]))foreach($PAY["ERROR_ARRAY"]  			as $c)  $PAY["ERROR"] 		.=$c;
	if(isset($PAY["MESS_ARRAY"]))foreach($PAY["MESS_ARRAY"]   			as $c)  $PAY["MESSAGE"] 	.=$c;
	if(isset($PAY["POST_CONT_ARRAY"]))foreach($PAY["POST_CONT_ARRAY"] 	as $c)  $PAY["POSTCONTENT"] .=$c;
}

//expects an assoc array of list items and their url
function action_list($list_array){
	//global $self_url;
	//if($url)$url =$url;
	//else $url = $self_url;
	$a = "<ul>";
	foreach($list_array as $item=>$url){
	$a .="<li><a href = \"$url\">$item</a></li>";
	}
	$a .="</ul>";
	content($a);
}

//action list on to be used on main pages
//expects an assoc array of list items and their url
function action_list_on_main($list_array){
	//global $self_url;
	//if($url)$url =$url;
	//else $url = $self_url;
	$a = "<ul>";
	foreach($list_array as $item=>$url){
	$a .="<li><a href = \"$url\">$item</a></li>";
	}
	$a .="</ul>";
	echo $a;
}

function start_div($c="", $d=""){
	return "<div class =\"$c\" id = \"$d\" >";
}

function form_head($c){
	return "<h4>$c</h4>\n";
}

function form_start($url="", $name = ""){
	global $self_url;
	if($name)$name = "name = \"$name\"";
	if($url)$url = $url;
	else $url = $self_url;
	return "<form action = \" $url\" method = \"post\" $name >\n";
	
}

function select(){
	return "<select> <options></options> </select>";
}

function form_button($t,$n,$v){
	return "<input type =\"$t\" name = \"$n\" value = \"$v\">\n";

}

function form_input_text($input_name, $edit_context=""){
	global $PAY;
	//$PAY[$input_name] = "";
	$a = "";

	if($edit_context){
		$a .= "<input type =\"text\" name = \"$input_name\" value =\"". $PAY[$edit_context]."\">";

	}elseif(!isset($PAY[$input_name])){
		$a .= "<input type =\"text\" name = \"$input_name\" >";
	}
	else{
		$a .= "<input type =\"text\" name = \"$input_name\" value =\"". $PAY[$input_name]."\">";
	}
	return $a;
}

function alt_form_input_text($input_name, $edit_context=""){
	global $PAY;
	//$PAY[$input_name] = "";
	
	$a = "";

	// input_name array and edit_context. Set edit_context = ""
	if(is_array($input_name)){

		if($edit_context){
			foreach ($input_name as $name) {
			$a .= "<input type =\"text\" name = \"$name\" value =\"". $PAY[$edit_context]."\">";
			}


		}else{
			foreach ($input_name as $name) {
			$PAY[$name] = "";
			$a .= "<input type =\"text\" name = \"$name\" value =\"". $PAY[$name]."\">";}
			}

	}elseif($edit_context && !is_array($input_name)){

		$a .= "<input type =\"text\" name = \"$input_name\" value =\"". $PAY[$edit_context]."\">";
	}else{
		$a .= "<input type =\"text\" name = \"$input_name\" value =\"". $PAY[$input_name]."\">";

	}
	return $a;
}

function form_button_hidden($n,$id){
	return "<input type =\"hidden\" name = \"$n\" value = \"$id\">\n";

}

function end_form(){
	return "</form>";
}

function end_div(){
	return "</div>";
}

function sub_message($c){
	return "<h4>$c</h4>\n";
}





//set varibles to accumulate in an array
function pre_content($c){
	global $PAY;
 	$PAY["PRE_CONT_ARRAY"][] = "<div>$c</div>\n";
}

function button($n, $c){
	global $PAY;
	$PAY["BUTTON_ARRAY"][] = "<input type = \"submit\" name = \"$n\" value = \"$c\">\n";
}

function content($c){
	global $PAY;
 	$PAY["CONT_ARRAY"][] = "<div>$c</div>\n";
}

function error_message($c){
	global $PAY;
	$PAY["ERROR_ARRAY"][] = "<p>$c</p>\n";
}

function message($c){
	global $PAY;
	$PAY["MESS_ARRAY"][] = "<div>$c</div>\n";
}

function post_content($c){
	global $PAY;
 	$PAY["POST_CONT_ARRAY"][] = "<div class = \"post_content\">$c</div>\n";
}
// id can be ignored here
function input_form($text_field_name, $submit_name, $value, $url, $edit_context="", $hidden_btn_name="", $id = ""){
	global $PAY;
$a = form_start($url);
$a .=form_input_text($text_field_name, $edit_context);
$a .=form_button_hidden($hidden_btn_name, $id);
$a .=form_button("submit", $submit_name, $value);
$a .=end_form();
echo $a;
}

function redirect($location){
	header("location: $location", false);
	exit;
}


//for fetching all from table
function fetch_all($all){
	global $PAY;
	$dbh = $PAY["dbh"];
	$query = "SELECT * FROM $all";
	$sth= $dbh->prepare($query);
	if($sth)$sth->execute();
	else error("Select a valid service from the service");
	return $sth;

}

function fetch_from_id($table, $t_column, $get){
	global $PAY;
	$dbh = $PAY["dbh"];
	$query = "
	SELECT * FROM $table
				WHERE $t_column = ?";
	$sth= $dbh->prepare($query);
	if($sth)$sth->execute(array($get));

	return $sth;
}

function page($page=""){
	global $PAY;
	set_var();
	if(!$page)$page = "main_admin";
	//require_once("pay_header.php");
	require_once("$page.php");
	require_once("footer.php");
	exit;
}





?>