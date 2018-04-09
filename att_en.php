<script type="text/javascript">

function showatt(a){

	switch(a){

		case 1:

		document.getElementById('att1').innerHTML = 'Message sent!!';

		document.getElementById('att2').style.backgroundColor = '#00FF66';

		break;

		case 2:

		document.getElementById('att1').innerHTML = 'Request is closed';

		document.getElementById('att2').style.backgroundColor = '#00FF66';

		break;	

		case 3:

		document.getElementById('att1').innerHTML = 'Incorrect captcha';

		document.getElementById('att2').style.backgroundColor = '#FFDDDD';

		break;	

		case 4:

		document.getElementById('att1').innerHTML = 'Your request has been sent. Please await the approval.';

		document.getElementById('att2').style.backgroundColor = '#00FF66';

		break;

		case 5:

		document.getElementById('att1').innerHTML = 'The exchange is successful.';

		document.getElementById('att2').style.backgroundColor = '#00FF66';

		break;

		case 6:

		document.getElementById('att1').innerHTML = 'Your request has been sent.';

		document.getElementById('att2').style.backgroundColor = '#00FF66';

		break;

		case 7:

		document.getElementById('att1').innerHTML = 'Incorrect PIN!';

		document.getElementById('att2').style.backgroundColor = '#FFDDDD';

		break;

		case 8:

		document.getElementById('att1').innerHTML = 'Enter the correct amount/wallet!';

		document.getElementById('att2').style.backgroundColor = '#FFDDDD';

		break;

		case 9:

		document.getElementById('att1').innerHTML = 'Data successfully updated';

		document.getElementById('att2').style.backgroundColor = '#00FF66';

		break;

		case 10:

		document.getElementById('att1').innerHTML = 'Your new PIN was sent to your email.';

		document.getElementById('att2').style.backgroundColor = '#00FF66';

		break;

		case 11:

		document.getElementById('att1').innerHTML = 'Incorrect email/PIN';

		document.getElementById('att2').style.backgroundColor = '#FFDDDD';

		break;
		case 12:
		document.getElementById('att1').innerHTML = 'Incorrect password!';
		document.getElementById('att2').style.backgroundColor = '#FFDDDD';
		break;
		case 13:
		document.getElementById('att1').innerHTML = 'This nickname not registered';
		document.getElementById('att2').style.backgroundColor = '#FFDDDD';
		break;

	}

	$('#att').slideDown(500);

}

</script>

<div hidden id='att' style="

 position:fixed;

 margin:auto;

 text-align:center;

   height: 100%;

  width: 35%;

  z-index: 1000;

  position: fixed;

  top: 40%;

  left:40%"><center>

  <div id='att2' style="border-radius:0.5em;width:100%;">

  <br>

 <span id='att1'>asd asdasd asdas</span>

 <br><br>

 <span onclick="$('#att').slideUp(500);" id='att2' style='position:absolute ;top:0.5em;right:0.5em'>[X]</span>

 </div></center>

 </div>
