<?php
extract($_POST);

   $sql="insert into surat_masuk(no_agenda,tgl_surat,no_surat,pengirim,perihal,diteruskan_1,diteruskan_2,disposisi,tgl_selesai,keerangan,date_insert) values('$no_agenda','$tgl_surat','$no_surat','$pengirim','$perihal','$diteruskan_1','$diteruskan_2','$tgl_selesai','$keterangan',now())";


   $result=mysql_query($sql);
   if($result){?>
      <SCRIPT language="JavaScript">
      alert('Insert Succes!');
      </SCRIPT> <?php
	  header("Location: index.php?_mod=sekretariat&task=report&act=new");
   }else{?>
     <SCRIPT language="JavaScript">
      alert('Insert Failed!');
      </SCRIPT> 
	  <?php
	  header("Location: index.php?_mod=sekretariat&task=report&act=new");
    }
}
?>