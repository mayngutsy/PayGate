<?php
	//updating the index
	require_once("constant_file.php");
	require_once(ASBPATH ."/include/pg_functions.php");
	require_once("admin.php");

	$title_pg_admin = true;
	page_title();
	require_once("pay_header.php");
	form_request();
	require_once("footer.php");
?>