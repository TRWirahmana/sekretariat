<?php
//--Form Functions Old ---------------------------------------
/*function form_open($name,$title,$action,$method){
	echo "<table border=0 cellpadding=10 cellspacing=0><tr><td>";
	echo "<form name=$name action=$action method=$method >";
	echo "<fieldset><legend>$title :</legend><table border=0>";
} */

// Form Functions Modivy by chandra
function form_open($name,$title,$action,$method){
	echo "<table border=0 cellpadding=10 cellspacing=0><tr><td>";
	echo "<form name=$name action=$action method=$method enctype=multipart/form-data onKeyUp=\"highlight(event)\" onClick=\"highlight(event)\">";
	echo "<fieldset><legend>$title </legend><table border=0>";
}

function form_labelfield($title){
	echo "<tr><td align=left colspan=2>$title </td>
	      </tr>";
}
function form_textlabel($title,$label){
	echo "<tr><td align=right>$title : </td>
	      <td>$label</td></tr>";
}
function form_opennotable($name,$title,$action,$method){
	echo "<form name=$name action=$action method=$method enctype=\"multipart/form-data\">";
	echo "<b>$title</b>";
}
function form_close(){
	echo "</table></fieldset></form></td></tr></table>";
}
function form_closenotable(){
	echo "</form>";
}
function form_hiddenfield($name,$value){
	echo "<input type=hidden name=$name value=\"$value\">";
}
function form_textfield($name,$title,$size,$value){
	echo "<tr><td align=right>$title : </td>
	      <td><input type=text name=$name size=$size value=\"$value\" class=txt_input></td></tr>";
}

function form_textfield_readonly($name,$title,$size,$value){
	echo "<tr><td align=right>$title : </td>
	      <td><input type=text name=$name size=$size value=\"$value\" class=txt_input READONLY></td></tr>";
}


function form_numberfield($name,$title,$size,$value){
	echo "<tr><td align=right>$title : </td>
	      <td><input type=text name=$name size=$size value=\"$value\" dir=\"rtl\"></td></tr>";
}

function form_radiofield($name,$title,$data,$value){
	echo "<tr><td align=right>$title : </td><td>";
	for ($i=0;$i<count($data);$i++){
		$r_name = $data[$i]['name'];
		$r_value= $data[$i]['value'];
		echo "<input type=radio name=$name value=$r_value>$r_name";
	}
	echo "</td></tr>";
}

function form_submit($name,$value){
	echo "<tr><td></td><td rowspan=2><input type=submit name=$name class=\"button\" value=\"$value\">";
}

function form_cancel($name,$value){
	echo "<input type=submit name=$name class=\"button\" value=\"$value\" onclick=\"window.history.back()\"></td></tr>";
}

function form_submit_cancel($name,$value,$url){
	echo "<tr>
	<td></td>
	<td><input type=submit name=$name class=\"button\" value=\"$value\">
	<input type=reset name=cancel class=\"button\" value=Cancel onclick=\"url_submit('${url}')\">
	</td></tr>";
}

function form_filefield($name,$title,$size){
	echo "<tr><td align=right>$title : </td>
	      <td><input type=file name=$name size=$size></td></tr>";
}
function form_pgselect($name,$title,$sql,$selected){

	$stm = pg_query($sql);
	echo "<tr><td align=right>$title :</td><td><select name=$name>";
	echo "<option value=\"\">--Select One--</option>";
	while ($row=pg_fetch_row($stm)){
		$isselected = ($selected==$row[0])?" selected":" ";
		echo "<option value=\"".$row[0]."\" ${isselected}>".$row[1]."</option>";
	}
	echo "</td></tr>";
}

function form_pgselect_job($name,$title,$sql,$selected){

	$stm = pg_query($sql);
	
	echo "<tr><td align=right>$title :</td><td><select name=$name";
	echo "<option value=\"\">--Select One--</option>";
	while ($row=pg_fetch_row($stm)){
		$isselected = ($selected==$row[0])?" selected":" ";
		echo "<option value=\"".$row[0]."\" ${isselected}>".$row[1]."</option>";
	}
	echo "</td></tr>";
}

function form_pgselect_excv($name,$title,$sql,$selected){

	$stm = pg_query($sql);
	echo "<tr><td align=right>$title :</td><td><select name=$name>";
	echo "<option value=\"\">--Select One--</option>";
	while ($row=pg_fetch_row($stm)){
		$isselected = ($selected==$row[0])?" selected":" ";
		echo "<option value=\"".$row[0]."\" ${isselected}>".$row[0]." / ".$row[1]."</option>";
	}
	echo "</td></tr>";
}
function form_pgselect_month($name,$title,$sql,$selected){

	$stm = pg_query($sql);
	echo "<tr><td align=right>$title :</td><td><select name=$name>";
	echo "<option value=\"\">--Select One--</option>";
	while ($row=pg_fetch_row($stm)){
	switch ($row[1]) {
	case '01'	     : $bulan="Jan";
		break;
	case '02'	     : $bulan="Feb";
		break;
	case '03'	     : $bulan="Mar";
	    break;
	case '04'	     : $bulan="Apr";
		break;
	case '05'	     : $bulan="Mei";
		break;
	case '06'	     : $bulan="Jun";
		break;
	case '07'	     : $bulan="Jul";
		break;
	case '08'	     : $bulan="Aug";
		break;
	case '09'	     : $bulan="Sep";
	    break;
	case '10'	     : $bulan="Okt";
		break;
	case '11'	     : $bulan="Nov";
		break;
	case '12'	     : $bulan="Des";
		break;
	}
		$bln=$row[0];
		$bln.="-";
		$bln.=$row[1];
		$isselected = ($selected==$bln)?" selected":" ";
		echo "<option value=\"".$row[0]."-".$row[1]."\" ${isselected}>".$bulan." - ".$row[0]."</option>";
	}
	echo "</td></tr>";
}
function form_pgselected($name,$title,$sql,$selected){
	$stm = pg_query($sql);
	echo "<tr><td align=right>$title :</td><td><select name=$name>";
	echo "<option value=\"\">--Select One--</option>";
	while ($row=pg_fetch_array($stm)){
		$isselected = ($selected==$row['SVALUE'])?" selected":" ";
		echo "<option value=\"".$row['SVALUE']."\" ${isselected}>".$row['SNAME']."</option>";
	}
	echo "</td></tr>";
}

/*function form_mysqlselect_multi($name,$title,$sql,$selected){
	$stm = mysql_query($sql);
	echo "<tr><td align=right>$title :</td><td><select name=$name MULTIPLE>";
	while ($row=mysql_fetch_array($stm)){
		$isselected = ($selected==$row['SVALUE'])?" selected":" ";
		echo "<option value=\"".$row['SVALUE']."\" ${isselected}>".$row['SNAME']."</option>";
	}
	echo "</td></tr>";
}*/




function form_arrayselect($name,$title,$data,$selected){
	echo "<tr><td align=right>$title :</td><td><select name=$name>";
	echo "<option value=\"\">--All--</option>";
	for($i=0;$i<count($data);$i++){
		$isselected = ($selected==$data[$i]['SVALUE'])?" selected":" ";
		echo "<option value=\"".$data[$i]['SVALUE']."\" ${isselected}>".$data[$i]['SNAME']."</option>";
	}
	echo "</td></tr>";
}
function form_arrayselectb($name,$title,$data,$selected){
	echo "<tr><td align=right>$title :</td><td><select name=$name>";
	echo "<option value=\"\">--Pilih--</option>";
	for($i=0;$i<count($data);$i++){
		$isselected = ($selected==$data[$i]['SVALUE'])?" selected":" ";
		echo "<option value=\"".$data[$i]['SVALUE']."\" ${isselected}>".$data[$i]['SNAME']."</option>";
	}
	echo "</td></tr>";
}

function form_checkfield($name,$title,$sql){
	$stm = ociexec($sql);
	echo "<tr><td align=right>$title :</td><td>";
	while(ocifetch($stm)){
		echo "<input type=checkbox name=$name value=\"".ociresult($stm,'CVALUE')."\">".ociresult($stm,'CNAME')."<br>";
	}
	echo "</td></tr>";
}
function form_checkbox($name,$title){
	$stm = ociexec($sql);
	echo "<tr><td align=right> :</td><td>";
	echo "<input type=checkbox name=$name>".$title."<br>";
	echo "</td></tr>";
	
}
function form_datefield($name,$title,$value){
	echo "<tr><td align=right>$title : </td>";
	echo "<td><input type=text name=$name id=\"idCalendar\" value=$value >&nbsp
	<img src='include/img/cal.gif' align='absmiddle' onmouseover=\"fnInitCalendar(this, 'idCalendar')\"></td</tr>";
	  
}
function form_textarea($name,$title,$cols,$rows,$value){
	echo "<tr><td align=right valign=top>$title : </td>
	      <td><textarea name=$name cols=$cols rows=$rows>${value}</textarea></td></tr>";
}
function form_button($name,$title,$url){
	echo "<tr><td align=right></td>
	      <td><input type=button class=button name=$name value=\"$title\" onclick=\"url_submit('${url}')\"></td></tr>";
}
//======================================================== tny_MCE EDITOR HERE ====================
function form_texteditor($title,$id,$name,$rows,$cols){
echo "<tr><td valign=top></td>
<td><bR>
<div style=\"background-color:#3399CC;padding-left:5px; color:white;\"><strong>$title :</strong></div>
<textarea id=$id name=$name rows=$rows cols=$cols style=\"width:100%\"></textarea></td></tr>";
}
function submit_cancel($name,$value,$url){
echo "<tr><td rowspan=2 align=right><input type=submit name=$name value=\"$value\"></td><td><input type=button name=Cancel value=Cancel onclick=\"url_submit('${url}')\"></td></tr>";
}
?>