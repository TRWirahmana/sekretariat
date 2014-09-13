<?php
$id=$_REQUEST["id"];
   $sql="delete from jenis_peraturan where jenis_id=$id";
$result=mysql_query($sql);
   if($result){?>
      <SCRIPT language="JavaScript">
      alert('Delete Succes!');
      </SCRIPT> <?php
	  header("Location: index.php?_mod=peraturan&task=report_jenis&act=new");
   }else{?>
     <SCRIPT language="JavaScript">
      alert('Delete Failed!');
      </SCRIPT> 
	  <?php
	  header("Location: index.php?_mod=peraturan&task=report_jenis&act=new");
    }

?>