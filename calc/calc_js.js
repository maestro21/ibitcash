var c_btc;
var c_dgc;
var c_ltc;
var c_dsh;
var c_mnr;
var c_eth;
var c_cld;
var cv=1;
var prm;
var x;
var calc=1;
 function val_Prices(btc3,dgc3,ltc3,dsh3,mnr3,eth3,cld3,prm3)
 {
	  c_btc=btc3;
	  c_dgc=dgc3;
	  c_ltc=ltc3;
	  c_dsh=dsh3;
	  c_mnr=mnr3;
	  c_eth=eth3;
	  c_cld=cld3;
	  prm=prm3;
  }
 function calculate(val)
 {
var str = val
var st = str.replace(",",".");
var cs =  st
document.getElementById("sum").value = cs;

	 switch (cv)
	 {
		 case 1: valute=c_btc;
		 break;
		 case 2: valute=c_dgc;
		 break;
		 case 3: valute=c_ltc;
		 break;
		 case 4: valute=c_dsh;
		 break;
		 case 5: valute=c_mnr;
		 break;
		 case 6: valute=c_eth;
		 break;
	 }
	 
	 var perc=val/100;
	if(calc==1){
	 var cr=(cs*(0.0000021839506173*10/prm)*60*60*60*0.8);
	 var pr1=cr/perc;
	 }else{
	 var cr=(cs*(0.0000021839506173*10/prm)*60*60*60*0.8)*0.6/valute;
	 pr1='-';
	 document.getElementById('proc1').innerHTML = pr1;
	 document.getElementById('proc2').innerHTML = pr1;
	 document.getElementById('proc3').innerHTML = pr1;
	 document.getElementById('proc4').innerHTML = pr1;
	 document.getElementById('proc5').innerHTML = pr1;
	 document.getElementById('proc6').innerHTML = pr1;
	 document.getElementById('proc7').innerHTML = pr1;
	 }
	 var dl=cr*valute;
	document.getElementById('cript1').innerHTML = cr.toFixed(8);
	document.getElementById('doll1').innerHTML = dl.toFixed(2);
	if(calc==1) {document.getElementById('proc1').innerHTML = pr1.toFixed(2);}
	var d1=dl*7;
	var c1=cr*7;
	if(calc==1) {pr1=cr*7/perc;}
	document.getElementById('cript2').innerHTML = c1.toFixed(8);
	document.getElementById('doll2').innerHTML = d1.toFixed(2);
	if(calc==1) {document.getElementById('proc2').innerHTML = pr1.toFixed(2);}
	var d1=dl*30;
	var c1=cr*30;
	if(calc==1) {pr1=cr*30/perc;}
	document.getElementById('cript3').innerHTML = c1.toFixed(8);
	document.getElementById('doll3').innerHTML = d1.toFixed(2);
	if(calc==1) {document.getElementById('proc3').innerHTML = pr1.toFixed(2);}
	var d1=dl*90;
	var c1=cr*90;
	if(calc==1) {pr1=cr*90/perc;}
	document.getElementById('cript4').innerHTML = c1.toFixed(8);
	document.getElementById('doll4').innerHTML = d1.toFixed(2);
	if(calc==1) {document.getElementById('proc4').innerHTML = pr1.toFixed(2);}
		var d1=dl*182;
	var c1=cr*182;
	if(calc==1) {pr1=cr*182/perc;}
	document.getElementById('cript5').innerHTML = c1.toFixed(8);
	document.getElementById('doll5').innerHTML = d1.toFixed(2);
	if(calc==1) {document.getElementById('proc5').innerHTML = pr1.toFixed(2);}
		var d1=dl*365;
	var c1=cr*365;
	if(calc==1) {pr1=cr*365/perc;}
	document.getElementById('cript6').innerHTML = c1.toFixed(8);
	document.getElementById('doll6').innerHTML = d1.toFixed(2);
	if(calc==1) {document.getElementById('proc6').innerHTML = pr1.toFixed(2);}
		var d1=dl*1095;
	var c1=cr*1095;
	if(calc==1) {pr1=cr*1095/perc;}
	document.getElementById('cript7').innerHTML = c1.toFixed(8);
	document.getElementById('doll7').innerHTML = d1.toFixed(2);
	if(calc==1) {document.getElementById('proc7').innerHTML = pr1.toFixed(2);}
 }
  function ch_val(c_v)
{
	if(c_v==1)
	{
		document.getElementById("val_name").innerHTML='BTC';
		cv=1;
	}
		if(c_v==2)
    {
		document.getElementById("val_name").innerHTML='DOGE';
		cv=2;
	}
		if(c_v==3)
	{
		document.getElementById("val_name").innerHTML='LTC';
		cv=3;
	}
		if(c_v==4)
	{
		document.getElementById("val_name").innerHTML='XRP';
		cv=4;
	}
		if(c_v==5)
	{
		document.getElementById("val_name").innerHTML='BCH';
		cv=5;
	}
		if(c_v==6)
	{
		document.getElementById("val_name").innerHTML='ETH';
		cv=6;
	}
	var a=document.getElementById("sum").value;
	calculate(a);
}