var btc;
var dgc;
var ltc;
var dsh;
var mnr;
var eth;
var c_v;
var c_v1;
var c_btc=1;
var c_dgc;
var c_ltc;
var c_dsh;
var c_mnr;
var c_eth;
var c_cld;
var k;
var g;
var cv2=0;
cv=0;
var onch=0.6;
var p1,p2,p3;
  var cv=1;
  	var R = new RegExp('(\\d+)([,.]?)(\\d*)', 'g');
 function val_Prices(btc3,dgc3,ltc3,dsh3,mnr3,eth3,cld3)
 {
	  c_btc=btc3;
	  c_dgc=dgc3;
	  c_ltc=ltc3;
	  c_dsh=dsh3;
	  c_mnr=mnr3;
	  c_eth=eth3;
	  c_cld=cld3;
	  c_v1=cld3;
  }

 function getXmlHttp() {
    var xmlhttp;
    try {
      xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
    try {
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    } catch (E) {
      xmlhttp = false;
    }
    }
    if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
      xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
  }
function ch_val(c_v)
{
	if(c_v==0)
	{
		document.getElementById('be').disabled = true;
		cv=0;
				document.getElementById('cur_cld').value = '';
				document.getElementById('cur_val').value = '';
				document.getElementById('imgv').src = "/image/select.png";


	}else{
		document.getElementById('be').disabled = false;
	}
	if(c_v==1)
	{
		cv=1;
				k=btc*c_btc/c_cld;
				document.getElementById('cur_val').value = btc.toFixed(8);
				document.getElementById('imgv').src = "/image/bitcoin.png";


	}
		if(c_v==2)
    {
		cv=2;
		k=dgc*c_dgc/onch;
				document.getElementById('cur_val').value = dgc.toFixed(8);
				if(cv2==0)
				{
					document.getElementById('cur_val').value = dgcwb.toFixed(8);
				}
				document.getElementById('cur_cld').value = k.toFixed(8);
				document.getElementById('imgv').src = "/image/dogecoin.png";
	}
		if(c_v==3)
	{
		cv=3;
		k=ltc*c_ltc/onch;
				document.getElementById('cur_val').value = ltc.toFixed(8);
				document.getElementById('imgv').src = "/image/litecoin.png";
	}
		if(c_v==4)
	{
		cv=4;
		k=dsh*c_dsh/onch;
				document.getElementById('cur_val').value = dsh.toFixed(8);
				document.getElementById('imgv').src = "/image/dash.png";
	}
		if(c_v==5)
	{
		cv=5;
		k=mnr*c_mnr/onch;
				document.getElementById('cur_val').value = mnr.toFixed(8);
				document.getElementById('imgv').src = "/image/rc.png";
	}
		if(c_v==6)
	{
		cv=6;
		k=eth*c_eth/onch;
				document.getElementById('cur_val').value = eth.toFixed(8);
				if(cv2==0)
				{
					document.getElementById('cur_val').value = ethwb.toFixed(8);
				}
				document.getElementById('imgv').src = "/image/ethereum.png";
	}
	         document.getElementById('cur_cld').value = k.toFixed(8);
				document.getElementById('be').disabled=false;
				cld_f(document.getElementById('cur_val').value);
}
function ch_val1(c_v1)
{
	cv2=c_v1;
	bon=0;
	if(cv==0){
		p2=c_cld;
	}
	if(cv==1){
		p2=c_btc;
	}
		
	if(cv==2){
		p2=c_dgc;
		if(cv2==2)
		{
			bon=dgcwb-dgc;
		}
	}
	if(cv==3){
		p2=c_ltc;
	}
		
	if(cv==4){
		p2=c_dsh;
	}
	if(cv==5){
		p2=c_mnr;
	}
		
	if(cv==6){
		p2=c_eth;
		if(cv2==2)
		{
			bon=ethwb-eth;
		}
	}
	if(c_v1==0)
	{
		onch=c_cld;
		document.getElementById('imgv1').src = "/image/cly.png";
	}
	else
	{
		bon=0
	}
	if(c_v1==1)
	{
		onch=c_btc;
		document.getElementById('imgv1').src = "/image/bitcoin.png";
	}
	if(c_v1==2)
	{
		onch=c_dgc;
		document.getElementById('imgv1').src = "/image/dogecoin.png";
	}
	if(c_v1==3)
	{
		onch=c_ltc;
		document.getElementById('imgv1').src = "/image/litecoin.png";
	}
	if(c_v1==4)
	{
		onch=c_dsh;
		document.getElementById('imgv1').src = "/image/dash.png";
	}
	if(c_v1==5)
	{
		onch=c_mnr;
		document.getElementById('imgv1').src = "/image/rc.png";
	}
	if(c_v1==6)
	{
		onch=c_eth;
		document.getElementById('imgv1').src = "/image/ethereum.png";
	}
		p1=document.getElementById('cur_val').value;
		p3=p1*p2/onch*0.85;
		if(c_v1==0)
		{
			p3=(p1+bon)*p2/onch;
		}
		document.getElementById('cur_cld').value = p3.toFixed(8);
		cld_f(document.getElementById('cur_val').value);
}
function cld_f(cours)
{
var str = cours
var st = str.replace(",",".");
var cs =  st
document.getElementById("cur_val").value = cs;
	switch(cv)
	{
		case 1:
			g=btc;
			break;
		case 2:
			g=dgc;
			if(cv2==0)
			{
			g=dgcwb;
			}
			break;
		case 3:
			g=ltc;
			break;
		case 4:
			g=dsh;
			break;
		case 5:
			g=mnr;
			break;
		case 6:
			g=eth;
			if(cv2==0)
			{
			g=ethwb;
			}
			break;
	}
g=g.toFixed(8);
if(cs>g || cs<=0 || isNaN(cs)==true || cv==cv2)	
{
	document.getElementById('cur_cld').value = "incorrect value";
	document.getElementById('be').disabled=true;
}
else
	{
			document.getElementById('be').disabled=false;
	var f;
	if(cv2==0){
		par2=1;
	}else{
		par2=0.85;
	}
if(cv==1){
			f=(cs*c_btc)/onch*par2;
}
if(cv==2){
			f=(c_dgc*cs)/onch*par2;
}
if(cv==3){
			f=(cs*c_ltc)/onch*par2;
}
if(cv==4){
			f=(cs*c_dsh)/onch*par2;
}
if(cv==5){
			f=(cs*c_mnr)/onch*par2;
}
if(cv==6){
			f=(cs*c_eth)/onch*0.85;			
	}
}
	document.getElementById('cur_cld').value = f.toFixed(8);
}
function exchange(id)
{
if(document.getElementById('chsbar').value != 0){
var xmlhttp = getXmlHttp();
var mn=document.getElementById('cur_val').value;
xmlhttp.open('POST', '../exchange/functions.php/', true);
xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
xmlhttp.send("exch=1&cv="+ encodeURIComponent(cv)+"&cv2="+encodeURIComponent(cv2)+"&mn="+encodeURIComponent(mn));
xmlhttp.onreadystatechange = function() {
if (xmlhttp.readyState == 4) {
if(xmlhttp.status == 200) {
if(xmlhttp.responseText=='OK')
{
showatt(5);
setTimeout(location.reload(),5000)
}
else{
showatt(14);
}
}
}
};
}
}