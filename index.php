<?php 
session_start();
include("config.php");
//echo "test";
/*if (isset($_POST)){
}else{
  $submit="";
}*/
//echo "test";
extract($_POST);
	if (isset($submit)){	
	  if ($submit=="Login"){
					$user_id = $_POST['userid'];
					$password = $_POST['password'];
					
					$sql = "select * from user where user_id ='$user_id' and password='$password' ";
					$stm = mysql_query($sql);
					//echo $sql;
					$is_user_exist = "no";
					if ($row=mysql_fetch_array($stm))
						{
						  
						   $LoginFailed = false;
						   $is_user_exist="yes"; 						   
						   
						   $user_id			= $row['user_id'];
						   $username	= $row['user_name'];
						   $user_level  = $row['user_type'];					   
						}
						
					if ($is_user_exist == "yes"){
						   #@Header("Location: index.php");
						   
							$_SESSION['user_id']=$user_id;
							$_SESSION['username']=$username;
							$_SESSION['mlevel'] = $user_level;
				
						   $log = date('d/m/Y | h:m:s');
						   $log .= " | ip : ".$_SERVER['REMOTE_ADDR'];
						   
						    // page_refresh('index.php');						   
						}else{
						    echo "<script>alert(':. User atau Password Salah :.')</script>";
						   $LoginFailed = true;						  
						}
		}
	} 


if (!isset($_SESSION['user_id']) && !isset($_SESSION['mlevel']) && !isset($_SESSION['username'])) //redirect login area
	{
		require("include/authent.php");
}else{
    $home_module 	= 'sekretariat';
    $default_theme	= 'sekretariat';
  if (isset($_GET['_mod']) || isset($_GET['task'])) {
	$_mod    = isset($_GET['_mod'])?$_GET['_mod']:$home_module;
	$task    = (!isset($_GET['task']))?'index':$_GET['task'];
  }else {
     
	$_mod    = "sekretariat";
	if ($_SESSION['mlevel']=="1"){
	  $task    = "report";
	 }else{
	  $task="report";
	  }
	 
	 //$task    = "input";
  }
//echo $_SESSION['mlevel'];
    $mod_url  = "index.php?_mod=$_mod";
    $file_url = "index.php?_mod=$_mod&task=$task";  
  include("include/include.php");
  if (file_exists("./mod/$_mod/include.php")) {
	  require("./mod/$_mod/include.php");
  }

//function
//if (file_exists("./mod/$_mod/$task.function.php")) {
//	require("./mod/$_mod/$task.function.php");
//}
//---------------------------------------------------
//Module Access Check................................
  $module_access = true;
  if (file_exists("./mod/$_mod/access.php")) {
	require_once("./mod/$_mod/access.php");
  }else{
	$module_access = false;
  }
   require('./template/'.$default_theme.'/index.php');
}


?>
