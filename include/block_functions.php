<script language="javascript">
function Block_ShowOrHide(div_id){
    if(document.all(div_id).style.display == 'none'){ 
		document.all(div_id).style.display = '';
		tray = 't'+div_id;
		document.all('tx_battlefield').style.display ='none';
    }else{ 
		document.all(div_id).style.display ='none';
		tray = 't'+div_id;
		document.all('tx_battlefield').style.display = '';
    }
}
</script>

<?php
function block_create($title, $content){
       echo "<ul id='user-menu'>";
            echo "<li class=menu-header>$title</li>";
                echo $content;
        echo "</li>";
    echo "</ul>";

}
function tray_create($id,$title){
	echo "<div id=\"x_${id}\" style=\"display: none\"><table  border=0 cellspacing=0 cellpadding=0 width=100%>";
	echo "<tr bgcolor=#DEDEDE><td align=center>$title</td></tr>";
	echo "</table></div>";
}
function block_render($mname){
	$mod_dir = "modules/$mname/blocks";
	if (@is_dir($mod_dir)) {
   	 	if ($dh = @opendir($mod_dir)) {
        	while (($file = @readdir($dh)) !== false) {
				if (($file<>'.') and ($file<>'..') and (substr($file,strlen($file)-3,3)<>'LCK') and (substr($file,strlen($file)-3,3)<>'LOG')){
					$reqfile = "./modules/$mname/blocks/".$file;
					@require($reqfile);
					block_create($block_id,$block_title,$block_content);
				}
        	}
        	closedir($dh);
    	}
	}
}
function tray_render($mname){
	$mod_dir = "modules/$mname/blocks";
	if (is_dir($mod_dir)) {
   	 	if ($dh = opendir($mod_dir)) {
        	while (($file = readdir($dh)) !== false) {
				if (($file<>'.') and ($file<>'..')){
            		require("./modules/$mname/blocks/".$file);
					tray_create($block_id,$block_title);
				}
        	}
        	closedir($dh);
    	}
	}
}
?>