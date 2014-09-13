<?php

$conn = mysql_connect("localhost","root",""); 
$db=mysql_select_db("peraturan");
if(isset($_GET['id']))
{

$id    = $_GET['id'];
$query = "SELECT name, type, size, path FROM file_dokumen WHERE file_id = '$id'";

$result = mysql_query($query) or die('Error, query failed');
if ($row=mysql_fetch_array($result)){
   $name=$row[0];
   $type=$row[1];
   $size=$row[2];
   $path = $row[3];  

}
header("Content-Disposition: attachment; filename=$name");
header("Content-length: $size");
header("Content-type: $type");

readfile("$path"); 

}

?>