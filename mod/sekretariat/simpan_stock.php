<?php
			  
extract($_POST);
$sql="insert into ambil_stock(no_awal,no_akhir,penanggungjawab,tanggal_ambil,date_entry) values($awal,$akhir,'$pj','$tgl_ambil',now())";
//echo $sql;
$result=mysql_query($sql);
$ambil_id=mysql_insert_id();
$status=0;
for ($i=$awal;$i<=$akhir;$i++){
   $sql1="insert into stock_nomor(ambil_id,nomor,status,date_entry) values($ambil_id,$i,$status,now())";
   //echo $sql;
   $result1=mysql_query($sql1);
 }

if($result && $result1){
     if($act=="new"){
    ?>
      <SCRIPT language="JavaScript">
      alert('Insert Succes!');
      </SCRIPT> <?php
	  header("Location: index.php?_mod=administrasi&task=admin_surat&act=new");
	 }else{?>
	   <SCRIPT language="JavaScript">
      alert('Update Succes!');
      </SCRIPT> <?php
	  header("Location: index.php?_mod=administrasi&task=admin_surat&act=new");
	 }
   }else{
       if($act=="new"){
    ?>
     <SCRIPT language="JavaScript">
      alert('Insert Failed!');
      </SCRIPT> 
	  <?php
	  header("Location: index.php?_mod=administrasi&task=admin_surat&act=new");
	  }else{?>
	    <SCRIPT language="JavaScript">
         alert('Update Failed!');
        </SCRIPT> <?php
	   header("Location: index.php?_mod=administrasi&task=admin_surat&act=new");
	  }
    }
?>