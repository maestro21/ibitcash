<script type="text/javascript">
function showatt(a){
	switch(a){
		case 1:
		document.getElementById('att1').innerHTML = 'Сообщение отправлено!';
		document.getElementById('att2').style.backgroundColor = '#00FF66';
		break;
		case 2:
		document.getElementById('att1').innerHTML = 'Запрос закрыт';
		document.getElementById('att2').style.backgroundColor = '#00FF66';
		break;	
		case 3:
		document.getElementById('att1').innerHTML = 'Неверно введена капча';
		document.getElementById('att2').style.backgroundColor = '#FFDDDD';
		break;	
		case 4:
		document.getElementById('att1').innerHTML = 'Ваша заявка отправлена в обработку. Ждите ответа модератора.';
		document.getElementById('att2').style.backgroundColor = '#00FF66';
		break;
		case 5:
		document.getElementById('att1').innerHTML = 'Обмен произведён успешно.';
		document.getElementById('att2').style.backgroundColor = '#00FF66';
		break;
		case 6:
		document.getElementById('att1').innerHTML = 'Ваша заявка отправлена в обработку';
		document.getElementById('att2').style.backgroundColor = '#00FF66';
		break;
		case 7:
		document.getElementById('att1').innerHTML = 'PIN введён не верно!';
		document.getElementById('att2').style.backgroundColor = '#FFDDDD';
		break;
		case 8:
		document.getElementById('att1').innerHTML = 'Введите корректную сумму/Номер счёта!';
		document.getElementById('att2').style.backgroundColor = '#FFDDDD';
		break;
		case 9:
		document.getElementById('att1').innerHTML = 'Данные успешно обновлены!';
		document.getElementById('att2').style.backgroundColor = '#00FF66';
		break;
		case 10:
		document.getElementById('att1').innerHTML = 'Ваш новый PIN выслан вам на э-мейл';
		document.getElementById('att2').style.backgroundColor = '#00FF66';
		break;
		case 11:
		document.getElementById('att1').innerHTML = 'Не верный э-мейл/PIN';
		document.getElementById('att2').style.backgroundColor = '#FFDDDD';
		break;
		case 12:
		document.getElementById('att1').innerHTML = 'Не верный пароль';
		document.getElementById('att2').style.backgroundColor = '#FFDDDD';
		break;
		case 13:
		document.getElementById('att1').innerHTML = 'Такой пользователь не зарегистрирован';
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
 