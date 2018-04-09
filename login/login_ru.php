﻿  <style>
    .tooltip {
      position: fixed;
      padding: 0.5em 1em;
      /* красивости... */

      border: 1px solid #b3c9ce;
      border-radius: 0.5em;
      text-align: center;
      font: italic 1em/1.3 arial, sans-serif;
      color: #333;
      background: #fff;
      box-shadow: 3px 3px 3px rgba(0, 0, 0, .3);
    }
  </style>
<center>
            <div class="cont_desc">
			<h1>Вход</h1><br>
				<form method="post" action="/login/">
						<div class="forms_block">
						<div class="forms_right_auth">
						<table>
						<tr>
						<td>
						<center>

							<input type="text" name="user" class="inp" placeholder="&nbsp;&nbsp;ЛОГИН/ПОЧТА" required> </td><td>
							<input type="password" name="pass" class="inp" placeholder="&nbsp;&nbsp;ПАРОЛЬ" required> </td></tr><tr><td colspan=2>
							<button class="exchange_button" style='width:100%' type="submit">Войти </button></td></tr></table>
							<br><center><a data-tooltip="<h5>Если у вас пролемы с входом - попробуйте войти через<br>электронную почту, заказать себе на почту новый пароль,<br> или обратится в службу поддержки</h5>" href="/reminder/"> Забыли пароль?</a></center>
						</div>
						
						</div>
											
						</center>
  <script>
    var showingTooltip;

    document.onmouseover = function(e) {
      var target = e.target;

      var tooltip = target.getAttribute('data-tooltip');
      if (!tooltip) return;

      var tooltipElem = document.createElement('div');
      tooltipElem.className = 'tooltip';
      tooltipElem.innerHTML = tooltip;
      document.body.appendChild(tooltipElem);

      var coords = target.getBoundingClientRect();

      var left = coords.left + (target.offsetWidth - tooltipElem.offsetWidth) / 2;
      if (left < 0) left = 0; // не вылезать за левую границу окна

      var top = coords.top - tooltipElem.offsetHeight - 5;
      if (top < 0) { // не вылезать за верхнюю границу окна
        top = coords.top + target.offsetHeight + 5;
      }

      tooltipElem.style.left = left + 'px';
      tooltipElem.style.top = top + 'px';

      showingTooltip = tooltipElem;
    };

    document.onmouseout = function(e) {

      if (showingTooltip) {
        document.body.removeChild(showingTooltip);
        showingTooltip = null;
      }

    };
  </script>

					
				</form>
			</div>
			</center>