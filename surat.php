<?php
$conn = mysql_connect("localhost","root","1234567890"); 
$db=mysql_select_db("sekretariat");

if(isset($_GET['id']))
{
// if id is set then get the file with the id from database


$id    = $_GET['id'];
$query = "SELECT nama_file, type, size, content " .
         "FROM surat_masuk WHERE surat_id = '$id'";

$result = mysql_query($query) or die('Error, query failed');
list($name, $type, $size, $content) = mysql_fetch_array($result);

header("Content-length: $size");
header("Content-type: $type");
header("Content-Disposition: attachment; filename=$name");
echo $content;

exit;
}

?>