<? 

$logout = date('d/m/Y | h:m:s');
		   $logout .= " | ip : ".$_SERVER['REMOTE_ADDR'];

echo "test";
session_destroy();
page_refresh('index.php');


?>