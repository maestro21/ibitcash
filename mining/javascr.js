var mining_case=0;
var cur_val;
var usdInt,usdInitSum;
var btc_mined=0;
var usd0=0;
var gs22;
var gs33;
var gs44;
var gs55;
var gs66;
var gs77;
var value;
var plus=0;
var mining_case=0;
var cloud,usd;
var b,b1,b2,b3,b4,b5,b6,b7;
var usd,usd1,usd2,usd3,usd4,usd5,usd6,usd7;
var c_btc;
var c_dgc;
var c_ltc;
var c_dsh;
var c_mnr;
var btc_mined=0;


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
function reset_value(a)
{
cs1=cursrt[a]+'sum';
cp1=cursrt[a]+'plus';
		if(a==7)
		{
				plus=0;
				value=0;
				cloud=btc_mined;
				document.getElementById(cs1).innerHTML = btc_mined.toFixed(8);
				
		}else{
				plus=btc_mined;
				value=сurrsum[a];
				сurrsum[a]=value+plus;
				document.getElementById(cp1).innerHTML = сurrsum[a].toFixed(8);
				document.getElementById(cs1).innerHTML = '0.00000000';
	}
	btc_mined=0;
}
function curInterval(curr,start)
{
if(usd0==0){
	butt='b'+cursrt[curr];
	cs=cursrt[curr]+'sum';
	if(start==1)
	{
		cur_val=curr;
		mining_case=1;
		btc_mined=progress;
		usdIntSum=setInterval(function() {
			btc_mined+=(cloud*(0.0000021839506173/param)/currency[curr])*parcur[curr];
			document.getElementById(cs).innerHTML = btc_mined.toFixed(8);
			document.getElementById(butt).style.backgroundColor = "#FF3333";
			document.getElementById(butt).style.borderColor = "#FF3333";
		}, 100);
}else{
usd0=1;
setTimeout(function() { usd0=0; }, 1000);
    var xmlhttp = getXmlHttp();
    xmlhttp.open('POST', '../mining/give.php', true);
    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xmlhttp.send("type=" + encodeURIComponent(curr));
    xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState == 4) {
    if(xmlhttp.status == 200) {
	if(mining_case==0){
	btc_mined=0;
	if(curr==7)
		{
		btc_mined=cloud;
		}
		mining_case=1;
		cur_val=curr;
		btc_mined=0;
		document.getElementById(butt).style.backgroundColor = "#FF3333";
		document.getElementById(butt).style.borderColor = "#FF3333";
		if(curr==7){btc_mined=cloud;}
		usdIntSum=setInterval(function() {
			btc_mined+=(cloud*(0.0000021839506173/param)/currency[curr])*parcur[curr];
			document.getElementById(cs).innerHTML = btc_mined.toFixed(8);
		}, 100);
	}
	else
	{
	clearInterval(usdIntSum);
	reset_value(cur_val);
	if(cur_val==curr){
	mining_case=0;
			document.getElementById(butt).style.backgroundColor = "#009933";
			document.getElementById(butt).style.borderColor = "#65B3B6";
	}
	else
	{	btc_mined=0;
		if(curr==7){btc_mined=cloud;}
		cur_val=curr;
		usdIntSum=setInterval(function() {
			btc_mined+=(cloud*(0.0000021839506173/param)/currency[curr])*parcur[curr];
			document.getElementById(cs).innerHTML = btc_mined.toFixed(8);
		}, 100);
		document.getElementById('bbtc').style.backgroundColor = "#009933";
		document.getElementById('bcld').style.backgroundColor = "#009933";
		document.getElementById('bdgc').style.backgroundColor = "#009933";
		document.getElementById('bltc').style.backgroundColor = "#009933";
		document.getElementById('bdsh').style.backgroundColor = "#009933";
		document.getElementById('bmnr').style.backgroundColor = "#009933";
		document.getElementById('beth').style.backgroundColor = "#009933";
		document.getElementById(butt).style.backgroundColor = "#FF3333";
		document.getElementById('bbtc').style.borderColor = "#65B3B6";
		document.getElementById('bcld').style.borderColor = "#65B3B6";
		document.getElementById('bdgc').style.borderColor = "#65B3B6";
		document.getElementById('bltc').style.borderColor = "#65B3B6";
		document.getElementById('bdsh').style.borderColor = "#65B3B6";
		document.getElementById('bmnr').style.borderColor = "#65B3B6";
		document.getElementById('beth').style.borderColor = "#65B3B6";
		document.getElementById(butt).style.borderColor = "#FF3333";
	}
	}
        }
      }
    };
}
}
}
/*var CheckMined = setInterval(function() {
var xmlhttp = getXmlHttp();
    xmlhttp.open('POST', '../mining/give.php', true);
    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xmlhttp.send("check=1");
    xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4) {
        if(xmlhttp.status == 200) {
		if(xmlhttp.responseText!='NO')
		{
		btc_mined=parseFloat(xmlhttp.responseText);
		}
}
}
};
}, 30000);*/