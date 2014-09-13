<?php 

session_start();
include("config.php");

    $home_module 	= 'sekretariat';
    $default_theme	= 'sekretariat';
//
if (isset($_SESSION['userid']) && isset($_SESSION['mlevel']) && isset($_SESSION['username'])){
  if (isset($_GET['_mod']) || isset($_GET['task']) ) {
     
	$_mod    = isset($_GET['_mod'])?$_GET['_mod']:$home_module;
	$task    = (!isset($_GET['task']))?'index':$_GET['task'];
  }else {
       
	$_mod    = "sekretariat";	
	$task    = "admin_surat";	 
  }}else{
       $_mod    = "sekretariat";	
	$task    = "report_agenda";
}

//echo $_SESSION['mlevel'];
    $mod_url  = "index.php?_mod=$_mod";
    $file_url = "index.php?_mod=$_mod&task=$task";  
  include("include/include.php");
  if (file_exists("./mod/$_mod/include.php")) {
	  require("./mod/$_mod/include.php");
  }
  require('./template/'.$default_theme.'/index.php');
  //echo "test";
?>
		  