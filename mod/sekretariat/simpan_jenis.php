<?php
extract($_POST);
if($act=="new"){
   $sql="insert into jenis_peraturan(nama_peraturan,date_insert) values('$nama',now())";
   $result=mysql_query($sql);
 }else{
   $sql="update jenis_peraturan set nama_peraturan='$nama' where jenis_id=$id";
   $result=mysql_query($sql);
 }
   if($result){
     if($act=="new"){
    ?>
      <SCRIPT language="JavaScript">
      alert('Insert Succes!');
      </SCRIPT> <?php
	  header("Location: index.php?_mod=peraturan&task=report_jenis&act=new");
	 }else{?>
	   <SCRIPT language="JavaScript">
      alert('Update Succes!');
      </SCRIPT> <?php
	  header("Location: index.php?_mod=peraturan&task=report_jenis&act=new");
	 }
   }else{
       if($act=="new"){
    ?>
     <SCRIPT language="JavaScript">
      alert('Insert Failed!');
      </SCRIPT> 
	  <?php
	  header("Location: index.php?_mod=peraturan&task=report_jenis&act=new");
	  }else{?>
	    <SCRIPT language="JavaScript">
         alert('Update Failed!');
        </SCRIPT> <?php
	    header("Location: index.php?_mod=peraturan&task=report_jenis&act=new");  
	  }
    }

?>