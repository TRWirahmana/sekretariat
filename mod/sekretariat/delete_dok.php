<?php


   $id=$_REQUEST["id"];
   $sql="delete from surat_masuk where surat_id=$id";
   $result=mysql_query($sql);
   
   
   
   if($result){?>
      <SCRIPT language="JavaScript">
      alert('Delete Succes!');
      </SCRIPT> <?php
	  header("Location: index.php?_mod=sekretariat&task=admin_surat&act=new");
   }else{?>
     <SCRIPT language="JavaScript">
      alert('Delete Failed!');
      </SCRIPT> 
	  <?php
	  header("Location: index.php?_mod=sekretariat&task=admin_surat&act=new");
    }

?>