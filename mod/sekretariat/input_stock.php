<?php
function getNama($nip){
    $nama='';
    $sql="select nama from pegawai where nip='$nip'";
    $qup=mysql_query($sql);	
    if ($row=mysql_fetch_array($qup)){
         $nama=$row[0];
	}
	return $nama;
}
function add_date($givendate,$day=0,$mth=0,$yr=0) {
      $cd = strtotime($givendate);
      $newdate = date('Y-m-d h:i:s', mktime(date('h',$cd),
    date('i',$cd), date('s',$cd), date('m',$cd)+$mth,
    date('d',$cd)+$day, date('Y',$cd)+$yr));
      return $newdate;
              }
function count_days( $a, $b )
{
    
    $gd_a = getdate( $a );
    $gd_b = getdate( $b );
    
    $a_new = mktime( 12, 0, 0, $gd_a['mon'], $gd_a['mday'], $gd_a['year'] );
    $b_new = mktime( 12, 0, 0, $gd_b['mon'], $gd_b['mday'], $gd_b['year'] );
    
    return round( abs( $a_new - $b_new ) / 2628000 );
} 
?>
<script type="text/javascript" src="include/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme : "simple"
	});
</script>
<link rel="stylesheet" type="text/css" href="style.css">
<script language="JavaScript" src="inc/Calendar/calendar_db.js"></script>
	<link rel="stylesheet" href="inc/Calendar/calendar.css">
<?php	
/*$act=$_REQUEST["act"];
 $save_url = "index.php?_mod=$_mod&task=simpan_stock&act=".$act;
 if ($act=="edit") {
     $id=$_REQUEST["id"];
	 $sql="select * from stock_nomor where no_id=$id";
	 $query=mysql_query($sql);
	 if ($row=mysql_fetch_array($query)) {
	     $nomor     =$row[1];
		 $status    =$row[2];		 
		 $tgl_entry =$row[3];
		 }
	 
 }else{
          $id     ="";
        //  $nomor  =$_REQUEST['nomor'];
		  $status     ="";
		  $tmt       ="";
		   
 }
 $save_url = "index.php?_mod=$_mod&task=simpan_stock&act=".$act;
 if ($act=="edit") {
     $id=$_REQUEST["id"];
	 $sql="select * from stock_nomor where no_id=$id";
	 $query=mysql_query($sql);
	 if ($row=mysql_fetch_array($query)) {
	     $nomor  =$row[1];
		 $status =$row[2];		 
		 $tmt    =$row[3];
		 }
	 
 }else{
		 
		 $nip       =$_REQUEST["nip"];
		 $nama =getNama($nip);
		 $gol_id    ="";
		 $tmt ="";
		 
 }

*/

 $save_url = "index.php?_mod=$_mod&task=simpan_stock";
 echo "Input Stock Nomor >> </br></br><br>";
?>
<table border=0 width="100%" style="border:1px solid #cccccc"><tr><td>
<form action="<?php echo $save_url;?>" method="post" name="form" >
<table>
<tr><td width="150px">Pengambilan nomor dari</td><td><input type="text" name="awal" value="" size="15"></td>
    <td width="90px">sampai dengan</td><td><input type="text" name="akhir" value="" size="15"></td></tr>
<tr><td width="150px">Penanggung Jawab</td><td colspan=3><input type="text" name="pj" value="" size="50"></td></tr>
<tr><td width="150px">Tanggal Pengambilan</td><td colspan=3><input type="text" name="tgl_ambil" value="" size="10"/><script language="JavaScript">
	new tcal ({
		'formname': 'form',
		'controlname': 'tgl_ambil'
	});
	</script></td></tr>
<tr><td><input class="button3d" type="reset" name="reset" value="Batal"/></td>
<td><input class="button3d" type="submit" name="submit" value="Simpan"/>
				</td></tr>
			
				
			</table>
				
			</form>
			</td></tr>
			</table>