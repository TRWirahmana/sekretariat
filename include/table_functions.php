<?php
function table_title($title){
	echo "<table widht=100% border=0 cellspacing=0 cellpadding=0><tr><td><img src=./images/tab_g.gif></td><td background=./images/tab_fond.gif><font class=bltitle>$title</font></td><td><img src=./images/tab_d.gif></td></tr></table>";
}
function table_open($width,$bgcolor,$border,$cellspacing,$cellpadding){
	echo "<table width=$width bgcolor=$bgcolor cellspacing=$cellspacing cellpadding=$cellpadding style=\"border:solid windowtext .2pt;
           padding:0in 1.4pt 0in 1.4pt\">";
}
function tr_bgcolor($bc){
	$bc = ($bc=='#FFFFFF')?'#DEDEDE':'#FFFFFF';
	return $bc;
}
function table_close(){
	echo "</table>";
}
/*function table_header($header){
		echo "<tr bgcolor=#D5D5D5 align=center>";
		for($i=0;$i<count($header);$i++){
			echo "<td>".$header[$i]."</td>";
		}
		echo "</tr>";
}*/

function table_header($bgcolor,$header,$class){
	echo "<tr class=\"bodystyle\" bgcolor=$bgcolor align=center  height=20>";
	for($i=0;$i<count($header);$i++){
		echo "<td><font class=$class><B>$header[$i]</b></font></td>";
	}
	echo "</tr>";
}

function td_alarmbgcolor($value){
	if ($value <=90){
		$alarm_cl = "red";
	}elseif(($value > 90) and ($value <= 100)){
		$alarm_cl = "yellow";
	}elseif($value > 100){
		$alarm_cl = "green";
	}
	return $alarm_cl;
}
?>