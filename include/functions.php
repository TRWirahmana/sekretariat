<?php 
/* Fungsi Set Tanggal Indo */
$hari = array( "Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu","Minggu");
$bulan= array(1=> "January", "February","maret","April", "Mei","Juni","July","Agustus", "September", "Oktober", "November", "Desember" );
$tgl= date("d");
$bln=date("n");
$hr=date("w");
$thn=date("Y");
#echo ("$hari[$hr], $tgl $bulan[$bln] $thn");
?>

<?php 

function page_refresh($url){
  echo "<meta HTTP-EQUIV=\"Refresh\" CONTENT=\"0; URL=$url\" >";
}

function urlrewrite($url){

}

function module_alert(){
	echo "<br><br><br><br><br><br><br><br><br><br><br><br>
		<div align=center valign=center><table><tr><td>
		<fieldset><legend>Proces Info:</legend><center>
		<b><font color=red>Sorry accsess denied...</font></b><br></center></fieldset>
	</td></tr></table></div>";
	return true;
}


function sql_table($sql){

$stm = mysql_query($sql);
echo "<table border=1>";
echo "<tr>";
for($i=0;$i<mysql_num_fields($stm);$i++)
{
    echo "<th>";
    echo mysql_field_name($stm, $i);
    echo "</th>";
}

while($row=mysql_fetch_row($stm))
{
    echo "<tr>";
    for($j=0;$j<$i;$j++)
    {
    echo "<td>&nbsp;";
    echo $row[$j];
    echo "</td>";
    }
    echo "</tr>";
}
echo "</tr>";
echo "</table>";
}

function exec_upload_asli($fname){
		
		$myUploadobj = new UPLOAD; //creating instance of file.
		$upload_dir="uploader";
		echo "<br>";
		// use function to upload file.
		$file= $myUploadobj->upload_file($upload_dir,$fname,true,true,0,"jpg|jpeg|gif"); 
		
		if($file==false)
			echo $myUploadobj->error;
		else
			echo "File Name : <img src=".$upload_dir."/".$file.">";	
		echo "<br>";

}

// DECODE STRING
function encoded($ses) 
{ 
 $sesencoded = $ses;
 $num = mt_rand(3,9);
 for($i=1;$i<=$num;$i++) 
 {
    $sesencoded = 
    base64_encode($sesencoded);
 }
 $alpha_array = 
 array('Y','D','U','R','P',
 'S','B','M','A','T','H');
 $sesencoded = 
 $sesencoded."+".$alpha_array[$num];
 $sesencoded =
 base64_encode($sesencoded);
 return $sesencoded;
}//end of encoded function

function decoded($str)
{
  $alpha_array = 
  array('Y','D','U','R','P', 
  'S','B','M','A','T','H');
  $decoded = 
   base64_decode($str);
  list($decoded,$letter) = 
  split("\+",$decoded);
  for($i=0;$i<count($alpha_array);$i++)
  {
  if($alpha_array[$i] == $letter)
  break;
  }
  for($j=1;$j<=$i;$j++) 
  {
     $decoded = 
      base64_decode($decoded);
  }
  return $decoded;
}//end of decoded function

?>