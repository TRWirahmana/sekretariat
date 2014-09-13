<script language="javascript">

//***** Function formating the Date for inputbox *****

function fnSetDateFormat(oDateFormat)
{
  oDateFormat['FullYear'];		//Example = 2007
  oDateFormat['Year'];		//Example = 07
  oDateFormat['FullMonthName'];	//Example = January
  oDateFormat['MonthName'];	//Example = Jan
  oDateFormat['Month'];		//Example = 01
  oDateFormat['Date'];		//Example = 01
  oDateFormat['FullDay'];		//Example = Sunday
  oDateFormat['Day'];		//Example = Sun
  oDateFormat['Hours'];		//Example = 01
  oDateFormat['Minutes'];		//Example = 01
  oDateFormat['Seconds'];		//Example = 01

  var sDateString;

  //Example = 01/01/00  dd/mm/yy
  //sDateString = oDateFormat['Date']+"/"+oDateFormat['Month']+"/"+oDateFormat['Year'];

  //Example = 01/01/0000  dd/mm/yyyy
  //sDateString = oDateFormat['Date']+"/"+oDateFormat['Month']+"/"+oDateFormat['FullYear'];

  //Example = Jan-01-0000 Mmm/dd/yyyy
  sDateString = oDateFormat['MonthName']+"-"+oDateFormat['Date']+"-"+oDateFormat['FullYear'];

  return sDateString;
}

</script>
					