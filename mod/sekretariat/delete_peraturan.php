<?php
function getFileId($peraturan_id){
  $sql="select file_id from file_dokumen where peraturan_id=$peraturan_id";
  $res=mysql_query($sql);
  if ($row=mysql_fetch_array($res)){
    return $row[0];
  }else return "#NA";
}

   $id=$_REQUEST["id"];
   $sql="delete from peraturan where peraturan_id=$id";
   $result=mysql_query($sql);
   
   $file_id= getFileId($id);

   $sql_file="select path from file_dokumen where peraturan_id=$file_id";
   if ($row=mysql_fetch_array($sql_file)){
       $path=$row[0];
       unlink($path);
   }
   $sql="delete from file_dokumen where file_id=$file_id";
   $result=mysql_query($sql);
   
   if($result){?>
      <SCRIPT language="JavaScript">
      alert('Delete Succes!');
      </SCRIPT> <?php
	  header("Location: index.php?_mod=peraturan&task=admin_peraturan&act=new");
   }else{?>
     <SCRIPT language="JavaScript">
      alert('Delete Failed!');
      </SCRIPT> 
	  <?php
	  header("Location: index.php?_mod=peraturan&task=admin_peraturan&act=new");
    }

?>