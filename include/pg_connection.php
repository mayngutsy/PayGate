<?php 
// main php page for payGate

 //Application Version
 define("PGVERSION", "0.1"); 

 //DB host
 if(!defined('DBHOST')){
 	define("DBHOST", "localhost");
 }

 //DB Engine MYSQLmj
 define("DBENGINE", "mysql");
 define("MYSQLUSER", "root");
 define("MYSQLPASS", "");
 define("MYSQLDBNAME", "paygate");


/* define("DBENGINE", "pgsql");
 define("PGSQLUSER", "");
 define("PGSQLPASS", "");
 define("PGSQLDBNAME", "paygate");

 define("DBENGINE", "sqlite3");
 define("DBFILE", "file director");
 */

 //service providers array 

init('PDO');

function init($db){
	global $PAY;
	global $dbh;
	$PAY["VERSION"]="";



 if('PDO' == $db){
	 	switch(DBENGINE){
	 	case "mysql":
	 	try{
	 	
	 	$dbh = new PDO('mysql:host='.DBHOST. ';dbname=' . MYSQLDBNAME, MYSQLUSER, MYSQLPASS,
	 		array(PDO::ATTR_PERSISTENT => true));
	 	}catch(PDOException $e){
	 		$e->getMessage();
	 	}
	 	$sth = $dbh->query("SHOW VARIABLES WHERE variable_name = 'version'");
	 	$PAY['VERSION'] = 'MySQL server version ' . $sth->fetchColumn(1);
	 	$dbh = $PAY["dbh"]=$dbh;
	 	break;
	 	case "pgsql":
	 	try{
	// get port from host
	 	$dbh = new PDO('pgsql: host='. DBHOST.';port=4563'. ';dbname=' . PGSQLDBNAME, PGSQLUSER, PGSQLPASS,
	 		array(PDO::ATTR_PERSISTENT => true) );
	 	}catch(PDOException $e){
	 		$e->getMessage();
	 	}
	 	$sth = $dbh->query('SELECT VERSION()');
	 	 $PAY['VERSION'] = explode(' ', $sth->fetchColumn());
	 	 $dbh = $PAY["dbh"]=$dbh;
	 	break;
	 	case "sqlite3":
	 	try{

	 		$dbh = new PDO('sqlite3:'.DBFILE,'unused', 'unused');
	 		$PAY["VERSION"] = SQLite3::version();
	 	}catch(PDOException $e){
	 		$e->getMessage();
	 	}
	 	$dbh = $PAY["dbh"]=$dbh;
	 	break;
	 }
 }else{

 }

}


?>