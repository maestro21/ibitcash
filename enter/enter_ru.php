<script language="javascript" src="../jquery-2.2.1.js"></script>
<SCRIPT language=javascript>
    function toBuf(name) {
        if (document.selection.createRange().text != "") {
            name.focus();
            document.selection.createRange().duplicate().execCommand("Copy");
        } else {
            name.focus();
            name.createTextRange().execCommand("Copy");
        }
    }
    function chang(s) {
        $('.active').removeClass('active');
        $(s).addClass('active');
        switch (s) {
            case "#cinf":
                $('.obmenu').slideUp(500);
                $('#inf').slideDown(500);
                break;
            case "#cbtc":
                $('.obmenu').slideUp(500);
                $('#btc1').slideDown(500);
                break;
            case "#cltc":
                $('.obmenu').slideUp(500);
                $('#ltc').slideDown(500);
                break;
            case "#cpee":
                $('.obmenu').slideUp(500);
                $('#pee').slideDown(500);
                break;
            case "#cdsh":
                $('.obmenu').slideUp(500);
                $('#dsh').slideDown(500);
                break;
            case "#cdgc":
                $('.obmenu').slideUp(500);
                $('#dgc').slideDown(500);
                break;
            case "#ceth":
                $('.obmenu').slideUp(500);
                $('#eth').slideDown(500);
                break;
            case "#crdd":
                $('.obmenu').slideUp(500);
                $('#rdd').slideDown(500);
                break;
            case "#cpb":
                $('.obmenu').slideUp(500);
                $('#pb').slideDown(500);
                break;
            case "#cqiwi":
                $('.obmenu').slideUp(500);
                $('#qw').slideDown(500);
                break;
            case "#csbr":
                $('.obmenu').slideUp(500);
                $('#sb').slideDown(500);
                break;
            case "#cvmc":
                $('.obmenu').slideUp(500);
                $('#vmc').slideDown(500);
                break;
            case "#cvtb":
                $('.obmenu').slideUp(500);
                $('#vtb').slideDown(500);
                break;
            case "#cyad":
                $('.obmenu').slideUp(500);
                $('#yad').slideDown(500);
                break;
            case "#cwm":
                $('.obmenu').slideUp(500);
                $('#wm').slideDown(500);
                break;
            case "#canother":
                $('.obmenu').slideUp(500);
                $('#another').slideDown(500);
                break;
        }
    }
</SCRIPT>

<?
//include "btc_query.php";
//include_once "../sth.php";
defined('ACCESS') or die();
if ($login) {

    $wsql = mysql_query("SELECT * FROM enter WHERE status=10 AND paysys='Bitcoin' AND login='$login'");
    $bpurse = 'Generate Bitcoin adress in bitcoin enter window!';

    if(mysql_num_rows($wsql))
    {
        $bpurse = mysql_result($wsql, 0, 'purse');
        if ($bpurse == '') {
            $bpurse = 'Generate Bitcoin adress in bitcoin enter window!';
        }
    }

    $t = time(); ?>
    <div style="margin-left:10%;margin-right:10%;"><br>
        <div class="left_div">
            <div>
                <ul class="left-menu">
                    <li><a href="/mining/">Майнинг</a></li>
                    <li class="active_l"><a href="/enter/">Пополнить баланс</a></li>
                    <li><a href="/exchange/">Обмен на облако Cloud</a></li>
                    <li><a href="/withdrawal/">Вывести средства</a></li>
                    <li><a href="/history/">История операций</a></li>
                    <li><a href="/calc/">Калькулятор дохода</a></li>
                    <li><a href="/ref/">Партнерская программа</a></li>
                    <li><a href="/profile/">Профиль</a></li>
                </ul>
            </div>
        </div>
        <div class="right_div">

            <div class="pay_menu">

                <ul>
                    <li id='cinf' <? if ($_GET['check'] == 0) echo "class='active'"; ?>>
                        <a onclick="chang('#cinf');"><img src="../image/info.png" width="40"></a>
                    </li>
                    <li id='cbtc' <? if ($_GET['check'] == 1) echo "class='active'"; ?>>
                        <a onclick="chang('#cbtc');"><img src="../image/bitcoin.png" width="40"></a>
                    </li>
                    <li id='cdsh' <? if ($_GET['check'] == 4) echo "class='active'"; ?>>
                        <a onclick="chang('#cdsh');"><img src="../image/dash.png" width="40"></a>
                    </li>
                    <li id='cdgc' <? if ($_GET['check'] == 2) echo "class='active'"; ?>>
                        <a onclick="chang('#cdgc');"><img src="../image/dogecoin.png" width="40"></a>
                    </li>
                    <li id='ceth' <? if ($_GET['check'] == 6) echo "class='active'"; ?>>
                        <a onclick="chang('#ceth');"><img src="../image/ethereum.png" width="40"></a>
                    </li>
                    <li id='cltc' <? if ($_GET['check'] == 3) echo "class='active'"; ?>>
                        <a onclick="chang('#cltc');"><img src="../image/litecoin.png" width="40"></a>
                    </li>
                    <li id='crdd' <? if ($_GET['check'] == 5) echo "class='active'"; ?>>
                        <a onclick="chang('#crdd');"><img src="../image/redocoin.png" width="40"></a>
                    </li>
                    <li id='cpee' <? if ($_GET['check'] == 16) echo "class='active'"; ?>>
                      
                    </li>
                </ul>
            </div>

            <div class="pay_content">

                <p>Внимание после нажатия на кнопку запросить кошелёк,нужно подождать пока сгенерируется кошелёк для пополнения!</p>
                <div class="tab_pane" id="tab2Rules">

                    <div class='obmenu' id='inf' style="color:#000000;font-size:1em;">
                        <p>Каждый раз для Вас генерируется новый кошелёк!<b><span size=4> </span></b></p>
                        <p>После перевода необходимо дождаться подтверждений в системе!<br></p>
                        <p><font color=blue></font></font></p>
                        <br>

                        <p><span style="font-size:1em;" size=4><b></b></span></p>
                        <p><span style="font-size:1em;" size=4><b></b></span></p>
                        <p>Только после того, как система подтвердит Вашу транзакцию, средства будут зачислены на Ваш
                            счет.</p><br>
                        <p>ЕСЛИ КРИПТОВАЛЮТА ПО КАКИМ-ЛИБО ПРИЧИНАМ НЕ БЫЛА ЗАЧИСЛЕНА НА ВАШ БАЛАНС — ОБРАТИТЕСЬ В ТЕХ.
                            ПОДДЕРЖКУ!</p>
                    </div>


                    <div class='obmenu' id='btc1' style="color:#000000;font-size:1em;">
                        <br>
                        <img src="../image/bitcoin.png" width="40" style="position:relative;padding:5px;margin:5px;"><b>BITCOIN</b>
                        <p>Введите сумму BTC <br><span id='btcp'
                                                                               style="color:#333333;font-size:1.3em;"></span>
                        </p><br><input type="text" value="" class="coin_input">
                        <button class='exchange_button' onclick='get_purse(1,this)'>Запросить кошелёк</button>
                        <br></div>

                    <div class='obmenu' id='dgc' style="color:#000000;font-size:1em;"><br>
                        <img src="../image/dogecoin.png" width="40"
                             style="position:relative;padding:5px;margin:5px;"><b>DOGECOIN</b>
                        <p>Введите сумму  DOGE <br><span id='dgcp'
                                                                                style="color:#333333;font-size:1.3em;"></span>
                        </p><br><input type="text" value="" class="coin_input">
                        <button class='exchange_button' onclick='get_purse(3,this)'>Запросить кошелёк</button>
                        <br></div>

                    <div class='obmenu' id='ltc' style="color:#000000;font-size:1em;"><br>
                        <img src="../image/litecoin.png" width="40" style="position:relaive;padding:5px;margin:5px;"><b>LITECOIN</b>
                        <p>Введите сумму  LTC <br><span id='ltcp'
                                                                               style="color:#333333;font-size:1.3em;"></span>
                        </p><br><input type="text" value="" class="coin_input">
                        <button class='exchange_button' onclick='get_purse(2,this)'>Запросить кошелёк</button>
                        <br></div>

                    <div class='obmenu' id='dsh' style="color:#000000;font-size:1em;"><br>
                        <img src="../image/dash.png" width="40" style="position:relative;padding:5px;margin:5px;"><b>RIPPLE</b>
                        <p>Введите сумму  XRP <br><span id='dshp'
                                                                                style="color:#333333;font-size:1.3em;"></span>
                        </p><br><input type="text" value="" class="coin_input">
                        <button class='exchange_button' onclick='get_purse(4,this)'>Запросить кошелёк</button>
                        <br></div>

                    <div class='obmenu' id='rdd' style="color:#000000;font-size:1em;"><br>
                        <img src="../image/redocoin.png" width="40" width="40"
                             style="position:relative;padding:5px;margin:5px;"><b>BITCOIN CASH</b>
                        <p> Введите сумму BCH  <br><span id='mnrp'
                                                                               style="color:#333333;font-size:1.3em;"></span>
                        </p><br><input type="text" value="" class="coin_input">
                        <button class='exchange_button' onclick='get_purse(5,this)'>Запросить кошелёк</button>
                        <br></div>

                    <div class='obmenu' id='eth' style="color:#000000;font-size:1em;">
                        <img src="../image/ethereum.png" width="40"
                             style="position:relative;padding:5px;margin:5px;"><b>ETHEREUM</b>
                        <p>Введите сумму ETH <br><span id='ethp'
                                                                               style="color:#333333;font-size:1.3em;"><br></span>
                        </p><br><input type="text" value="" class="coin_input">
                        <button class='exchange_button' onclick='get_purse(6,this)'>Запросить кошелёк</button>
                        <br></div>


                    <script language='javascript'>
                        function get_purse(par,_this) {
                            var sbmBtn = $(_this);
                            var user = '<?echo $user_id?>';
                            var ammount = sbmBtn.siblings('.coin_input').val();
                            if (ammount == '') {
                                sbmBtn.siblings('.coin_input').addClass('has-error');
                                sbmBtn.siblings('.coin_input').on('keydown',function () {
                                    $(this).removeClass('has-error');
                                });
                            }
                            ammount = +ammount * 100000000000;
                            if (ammount != '') {
                                sbmBtn.attr('disabled', 'disabled');//выключить повторное нажатие

                                var windowOpen = $('<div />');
                                $k = $.ajax({  //какое нахуй К
                                    type: "POST",
                                    url: "createPaymant.php",
                                    data: "id="+user+"&type="+par+"&amount="+ammount,
                                    success: function (msg) {
                                        switch (par) {
                                            case 1:
                                                document.getElementById('btcp').innerHTML = msg;
                                                break;
                                            case 2:
                                                document.getElementById('ltcp').innerHTML = msg;
                                                break;
                                            case 3:
                                                document.getElementById('dgcp').innerHTML = msg;
                                                break;
                                            case 4:
                                                document.getElementById('dshp').innerHTML = msg;
                                                break;
                                            case 5:
                                                document.getElementById('mnrp').innerHTML = msg;
                                                break;
                                            case 6:
                                                document.getElementById('ethp').innerHTML = msg;
                                                break;
//                                        case 7:
//                                            document.getElementById('check1').innerHTML = msg;
//                                            show_check();
//                                            break;
                                        }
                                        windowOpen = windowOpen.append(msg).find('.coin_input.hreff').val();
                                        window.open(windowOpen);
                                    }
                                }).always(function(){
                                    sbmBtn.removeAttr('disabled'); //включить кнопку
                                });

                            }
                        }
                    </script>
                    <style>
                        .coin_input {
                            display: inline-block;
                            width: 15%;
                            padding: 6px 3px;
                            font-size: 0.8em;
                            color: #555;
                            background-color: #fff;
                            background-image: none;
                            border: 1px solid #ccc;
                            border-radius: 4px;
                            -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
                            box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
                            -webkit-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
                            transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
                        }
                        .coin_input:focus {
                            border: 1px solid #66afe9;
                            outline: 0;
                            -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102,175,233,.6);
                            box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102,175,233,.6);
                        }
                        .has-error {
                            border-color: #a94442;
                            -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 6px #ce8483;
                            box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 6px #ce8483;
                        }
                        button[disabled] {
                            background: #5099f4;
                            cursor: not-allowed;
                            filter: alpha(opacity=65);
                            -webkit-box-shadow: none;
                            box-shadow: none;
                            opacity: .65;
                        }
                        button:disabled {
                            background: #5099f4;
                            cursor: not-allowed;
                            filter: alpha(opacity=65);
                            -webkit-box-shadow: none;
                            box-shadow: none;
                            opacity: .65;
                        }
                    </style>

                    

        <script>
            function show_check() {
                $('.obmenu').hide();
                $('#check').slideDown(500);
            }
            $('.obmenu').hide();
            $('#inf').slideDown(500);
        </script>

        <br><br></div>
    <?
} else {
    ?>
    <script>document.location.href = 'https://ibit.cash/login';</script><?
}

?>

