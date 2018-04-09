var mining_case=0;
var cur_val;
var usdInt,usdInitSum;
var usd11=-1;
var usd22=-1;
var usd33=-1;
var usd44=-1;
var usd55=-1;
var usd66=-1;
var usd77=-1;
var usd0=-1;
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
  function val_sum(id){
    var xmlhttp = getXmlHttp();
    xmlhttp.open('POST', '../mining/give.php', true);
    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xmlhttp.send("vals=1&id="+ encodeURIComponent(id));
    xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4) {
        if(xmlhttp.status == 200) {
          var sumstr = xmlhttp.responseText;
		  var arrsum=sumstr.split(' ');
if (usd11==-1){ usd11=parseFloat(arrsum[1]);}
if (usd22==-1){ usd22=parseFloat(arrsum[2]);}
if (usd33==-1){ usd33=parseFloat(arrsum[3]);}
if (usd44==-1){ usd44=parseFloat(arrsum[4]);}
if (usd55==-1){ usd55=parseFloat(arrsum[5]);}
if (usd66==-1){ usd66=parseFloat(arrsum[6]);}
if (usd77==-1){ usd77=parseFloat(arrsum[7]);}
if (usd0==-1){ usd0=parseFloat(arrsum[0]);}

        }
      }
    };
	}
var cloud,usd;
var b,b1,b2,b3,b4,b5,b6,b7;
var usd,usd1,usd2,usd3,usd4,usd5,usd6,usd7;
	  var c_btc;
	  var c_dgc;
	  var c_ltc;
	  var c_dsh;
	  var c_mnr;
	  var c_eth;
	  var param;
  function val_Prices(btc,dgc,ltc,dsh,mnr,eth,prm)
  {
	  c_btc=btc;
	  c_dgc=dgc;
	  c_ltc=ltc;
	  c_dsh=dsh;
	  c_mnr=mnr;
	  c_eth=eth;
	  param=prm;
  }
  function btcIntervalW(time,mount,cusd)
{
		cur_val=2;
		mining_case=1;
		usd1=(cusd+time*mount*(0.0000057839506173/param))*10/c_btc;
		usd11=cusd+(time*mount*(0.0000057839506173/param)*10/c_btc);
		usdIntSum=setInterval(function() {
			b1=usd1;
			usd1=usd1+mount*(0.0000057839506173/param)/c_btc;
			b1=usd1-b1;
			usd11=usd11+b1;
			document.getElementById('btcsum').innerHTML = usd11.toFixed(11);
		}, 100);
}
  function dgcIntervalW(time,mount,cusd)
{
		cur_val=3;
		mining_case=1;
		usd2=(cusd+time*mount*(0.0000057839506173/param))*10/c_dgc;
		usd22=cusd+time*mount*(0.0000057839506173/param)*10/c_dgc;
		usdIntSum=setInterval(function() {
			b2=usd2;
			usd2=usd2+mount*(0.0000057839506173/param)/c_dgc;
			b2=usd2-b2;
			usd22=usd22+b2;
			document.getElementById('dgcsum').innerHTML = usd22.toFixed(11);
		}, 100);
}
  function ltcIntervalW(time,mount,cusd)
{
		cur_val=4;
		mining_case=1;
		usd3=(cusd+time*mount*(0.0000057839506173/param))*10/c_ltc;
		usd33=cusd+time*mount*(0.0000057839506173/param)*10/c_ltc;
		usdIntSum=setInterval(function() {
			b3=usd3;
			usd3=usd3+mount*(0.0000057839506173/param)/c_ltc;
			b3=usd3-b3;
			usd33=usd33+b3;
			document.getElementById('ltcsum').innerHTML = usd33.toFixed(11);
		}, 100);
}
  function dshIntervalW(time,mount,cusd)
{
		cur_val=5;
		mining_case=1;
		usd4=(cusd+time*mount*(0.0000057839506173/param))*10/c_dsh;
		usd44=cusd+time*mount*(0.0000057839506173/param)*10/c_dsh;
		usdIntSum=setInterval(function() {
			b4=usd4;
			usd4=usd4+mount*(0.0000057839506173/param)/c_dsh;
			b4=usd4-b4;
			usd44=usd44+b4;
			document.getElementById('dshsum').innerHTML = usd44.toFixed(11);
		}, 100);
}
  function mnrIntervalW(time,mount,cusd)
{
		cur_val=6;
		mining_case=1;
		usd5=(cusd+time*mount*(0.0000057839506173/param))*10/c_mnr;
		usd55=cusd+time*mount*(0.0000057839506173/param)*10/c_mnr;
		usdIntSum=setInterval(function() {
			b5=usd5;
			usd5=usd5+mount*(0.0000057839506173/param)/c_mnr;
			b5=usd5-b5;
			usd55=usd55+b5;
			document.getElementById('mnrsum').innerHTML = usd55.toFixed(11);
		}, 100);
}
  function ethIntervalW(time,mount,cusd)
{
		cur_val=7;
		mining_case=1;
		usd6=cusd+time*mount*(0.0000057839506173/param)*10/c_eth;
		usd66=cusd+time*mount*(0.0000057839506173/param)*10/c_eth;
		usdIntSum=setInterval(function() {
			b6=usd6;
			usd6=usd6+mount*(0.0000057839506173/param)/c_eth;
			b6=usd6-b6;
			usd66=usd66+b6;
			document.getElementById('ethsum').innerHTML = usd66.toFixed(11);
		}, 100);
}
  function cldIntervalW(time,mount,cusd)
{
		cur_val=8;
		mining_case=1;
		usd7=cusd+time*mount*(0.0000057839506173/param)*10;
		usd77=cusd+time*mount*(0.0000057839506173/param)*10;
		usdIntSum=setInterval(function() {
			b6=usd7;
			usd7=usd7+usd7 * (0.0000057839506173/param);
			b6=usd7-b6;
			usd77=usd77+b6;
			document.getElementById('cldsum').innerHTML = usd77.toFixed(11);
		}, 100);
}

function btcInterval(cloud,usd1,id)
{
	usd=usd;
    var xmlhttp = getXmlHttp();
    xmlhttp.open('POST', '../mining/give.php', true);
    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xmlhttp.send("type=2&id="+ encodeURIComponent(id));
    xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4) {
        if(xmlhttp.status == 200) {

        }
      }
    };
	if(mining_case==0){
		mining_case=1;
		cur_val=2;
		usdIntSum=setInterval(function() {
			b1=usd1;
			usd1=usd1+cloud*(0.0000057839506173/param)/c_btc;
			b1=usd1-b1;
			usd11=usd11+b1;
			document.getElementById('btcsum').innerHTML = usd11.toFixed(11);
		}, 100);
	}
	else
	{	if(cur_val==2){
		clearInterval(usdIntSum);
		mining_case=0;
	}
	else
	{
		cur_val=2;
		clearInterval(usdIntSum);
		usdIntSum=setInterval(function() {
			b1=usd1;
			usd1=usd1+cloud*(0.0000057839506173/param)/c_btc;
			b1=usd1-b1;
			usd11=usd11+b1;
			document.getElementById('btcsum').innerHTML = usd11.toFixed(11);
		}, 100);
	}
	}
}
function dgcInterval(cloud,usd2,id)
{
    var xmlhttp = getXmlHttp();
    xmlhttp.open('POST', '../mining/give.php', true);
    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xmlhttp.send("type=3&id="+ encodeURIComponent(id));
    xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4) {
        if(xmlhttp.status == 200) {
        }
      }
    };
	if(mining_case==0){
		mining_case=1;
		cur_val=3;
		usdIntSum=setInterval(function() {
			b2=usd2;
			usd2=usd2+cloud*(0.0000057839506173/param)/c_dgc;
			b2=usd2-b2;
			usd22=usd22+b2;
			document.getElementById('dgcsum').innerHTML = usd22.toFixed(11);
		}, 100);
	}
	else
	{	if(cur_val==3){
		clearInterval(usdIntSum);
		mining_case=0;
	}
	else
	{
		cur_val=3;
		clearInterval(usdIntSum);
		usdIntSum=setInterval(function() {
			b2=usd2;
			usd2=usd2+cloud*(0.0000057839506173/param)/c_dgc;
			b2=usd2-b2;
			usd22=usd22+b2;
			document.getElementById('dgcsum').innerHTML = usd22.toFixed(11);
		}, 100);
	}
	}
	
}
function ltcInterval(cloud,usd3,id)
{
    var xmlhttp = getXmlHttp();
    xmlhttp.open('POST', '../mining/give.php', true);
    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xmlhttp.send("type=4&id="+ encodeURIComponent(id));
    xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4) {
        if(xmlhttp.status == 200) {
        }
      }
    };
	if(mining_case==0){
		mining_case=1;
		cur_val=4;
		usdIntSum=setInterval(function() {
			b3=usd3;
			usd3=usd3+cloud*(0.0000057839506173/param)/c_ltc;
			b3=usd3-b3;
			usd33=usd33+b3;
			document.getElementById('ltcsum').innerHTML = usd33.toFixed(11);
		}, 100);
	}
	else
	{	if(cur_val==4){
		clearInterval(usdIntSum);
		mining_case=0;
	}
	else
	{
		cur_val=4;
		clearInterval(usdIntSum);
		usdIntSum=setInterval(function() {
			b3=usd3;
			usd3=usd3+cloud*(0.0000057839506173/param)/c_ltc;
			b3=usd3-b3;
			usd33=usd33+b3;
			document.getElementById('ltcsum').innerHTML = usd33.toFixed(11);
		}, 100);
	}
	}
}
function dshInterval(cloud,usd4,id)
{
    var xmlhttp = getXmlHttp();
    xmlhttp.open('POST', '../mining/give.php', true);
    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xmlhttp.send("type=5&id="+ encodeURIComponent(id));
    xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4) {
        if(xmlhttp.status == 200) {
        }
      }
    };
	if(mining_case==0){
		mining_case=1;
		cur_val=5;
		usdIntSum=setInterval(function() {
			b4=usd4;
			usd4=usd4+cloud*(0.0000057839506173/param)/c_dsh;
			b4=usd4-b4;
			usd44=usd44+b4;
			document.getElementById('dshsum').innerHTML = usd44.toFixed(11);
		}, 100);
	}
	else
	{	if(cur_val==5){
		clearInterval(usdIntSum);
		mining_case=0;
	}
	else
	{
		cur_val=5;
	clearInterval(usdIntSum);
			usdIntSum=setInterval(function() {
			b4=usd4;
			usd4=usd4+cloud*(0.0000057839506173/param)/c_dsh;
			b4=usd4-b4;
			usd44=usd44+b4;
			document.getElementById('dshsum').innerHTML = usd44.toFixed(11);
		}, 100);
	}
	}
}
function mnrInterval(cloud,usd5,id)
{
    var xmlhttp = getXmlHttp();
    xmlhttp.open('POST', '../mining/give.php', true);
    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xmlhttp.send("type=6&id="+ encodeURIComponent(id));
    xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4) {
        if(xmlhttp.status == 200) {
        }
      }
    };
	if(mining_case==0){
		mining_case=1;
		cur_val=6;
			usdIntSum=setInterval(function() {
			b5=usd5;
			usd5=usd5+cloud*(0.0000057839506173/param)/c_mnr;
			b5=usd5-b5;
			usd55=usd55+b5;
			document.getElementById('mnrsum').innerHTML = usd55.toFixed(11);
		}, 100);
	}
	else
	{	if(cur_val==6){
		clearInterval(usdIntSum);
		mining_case=0;
	}
	else
	{
		cur_val=6;
		clearInterval(usdIntSum);
		usdIntSum=setInterval(function() {
			b5=usd5;
			usd5=usd5+cloud*(0.0000057839506173/param)/c_mnr;
			b5=usd5-b5;
			usd55=usd55+b5;
			document.getElementById('mnrsum').innerHTML = usd55.toFixed(11);
		}, 100);
	}
	}
}
function ethInterval(cloud,usd6,id)
{
    var xmlhttp = getXmlHttp();
    xmlhttp.open('POST', '../mining/give.php', true);
    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xmlhttp.send("type=7&id="+ encodeURIComponent(id));
    xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4) {
        if(xmlhttp.status == 200) {
        }
      }
    };
	if(mining_case==0){
		mining_case=1;
		cur_val=7;
		usdIntSum=setInterval(function() {
			b6=usd6;
			usd6=usd6+cloud*(0.0000057839506173/param)/c_eth;
			b6=usd6-b6;
			usd66=usd66+b6;
			document.getElementById('ethsum').innerHTML = usd66.toFixed(11);
		}, 100);
	}
	else
	{	if(cur_val==7){
		clearInterval(usdIntSum);
		mining_case=0;
	}
	else
	{
		cur_val=7;
		clearInterval(usdIntSum);
			usdIntSum=setInterval(function() {
			b6=usd6;
			usd6=usd6+cloud*(0.0000057839506173/param)/c_eth;
			b6=usd6-b6;
			usd66=usd66+b6;
			document.getElementById('ethsum').innerHTML = usd66.toFixed(11);
		}, 100);
	}
	}
}
function cldInterval(cloud,usd7,id)
{
    var xmlhttp = getXmlHttp();
    xmlhttp.open('POST', '../mining/give.php', true);
    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xmlhttp.send("type=8&id="+ encodeURIComponent(id));
    xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4) {
        if(xmlhttp.status == 200) {
        }
      }
    };
	if(mining_case==0){
		mining_case=1;
		cur_val=8;
					b7=usd7;
			usd7=usd7+usd7 * (0.0000057839506173/param);
			b7=usd7-b7;
		usdIntSum=setInterval(function() {
			usd77=usd77+b7;
			document.getElementById('cldsum').innerHTML = usd77.toFixed(11);
		}, 100);
	}
	else
	{	if(cur_val==8){
		clearInterval(usdIntSum);
		mining_case=0;
	}
	else
	{
		cur_val=8;
			clearInterval(usdIntSum);
				usdIntSum=setInterval(function() {
			b7=usd7;
			usd7=usd7+usd7 * (0.0000057839506173/param);
			b7=usd7-b7;
			usd77=usd77+b7;
			document.getElementById('cldsum').innerHTML = usd77.toFixed(11);
		}, 100);
	}
	}
}			