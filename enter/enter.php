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
        $('#attent').slideDown(500);
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

<?php
//include_once "../sth.php";
defined('ACCESS') or die();
if ($login) {
    $wsql = mysql_query("SELECT * FROM enter WHERE status=10 AND paysys='Bitcoin' AND login='$login'");
    $bpurse = mysql_result($wsql, 0, 'purse');
    if ($bpurse == '') {
        $bpurse = 'Generate Bitcoin adress in bitcoin enter window!';
    }
    $t = time(); ?>
    <div style="margin-left:10%;margin-right:10%;"><br>
        <div class="left_div">
            <div>
                <ul class="left-menu">
                    <li><a href="/mining/">Mining</a></li>
                    <li class="active_l"><a href="/enter/">Deposit funds</a></li>
                    <li><a href="/exchange/">Buy Cloud power</a></li>
                    <li><a href="/withdrawal/">Withdraw</a></li>
                    <li><a href="/history/">Transaction history</a></li>
                    <li><a href="/calc/">Income calculator</a></li>
                    <li><a href="/ref/">Affiliate program</a></li>
                    <li><a href="/profile/">Profile</a></li>
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

                    
                </ul>
            </div>
            <div class="pay_content">
                <div class="tab_pane" id="tab2Rules">
                    <div id='attent'>Attention after clicking on the button to request a purse, you need to wait until the purse for replenishment is generated!</div>
                    <div class='obmenu' id='inf' style="color:#000000;font-size:1em;">
                        <p>New wallet is generated each time! Never transfer funds to the same wallet.</p>
                        <p>You have to wait for confirmation after the transaction!<br></p>
                        <br>

                        <p><span style="font-size:1em;" size=4><b></b></span></p>
                        <p><span style="font-size:1em;" size=4><b></b></span>
                        <p>
                            <br>Your balance will be credited only after the transaction is confirmed.<br>
                            <br>If you haven't received your funds for whatever reason, open a Support ticket.
                    </div>


                    <div class='obmenu' id='dgc' style="color:#000000;width:100%;font-size:0.8em;"><br>
                        <img src="../image/dogecoin.png" width="40"
                             style="position:relative;padding:5px;margin:5px;"><b>DOGECOIN</b>
                        <p>Enter amount DOGE </p>
                        <p><span id='dgcp' style="color:#333333;font-size:1.3em;"></span></p><br>
                        <input type="text" value="" class="coin_input">
                        <button class='exchange_button' onclick='get_purse(3,this);'>Show wallet</button>
                        <br></div>
                    <span class='obmenu' id='btc1' style="color:#000000;width:100%;font-size:0.8em;"><br>
                                    <img src="../image/bitcoin.png" width="40"
                                         style="position:relative;padding:5px;margin:5px;"><b>BITCOIN</b>
                                    <p>Enter amount BTC </p><p><span id='btcp'
                                                                                                   style="color:#333333;font-size:1.3em;"></span></p><br>
                        <input type="text" value="" class="coin_input"><button
                                class='exchange_button' onclick='get_purse(1,this);'>Show wallet</button><br></div>
                <div class='obmenu' id='ltc' style="color:#000000;width:100%;font-size:0.8em;"><br>
                    <img src="../image/litecoin.png" width="40" style="position:relative;padding:5px;margin:5px;"><b>LITECOIN</b>
                    <p>Enter amount LTC  </p>
                    <p><span id='ltcp' style="color:#333333;font-size:1.3em;"></span></p><br><input type="text" value="" class="coin_input">
                    <button class='exchange_button' onclick='get_purse(2,this);'>Show wallet</button>
                    <br></div>
                <div class='obmenu' id='dsh' style="color:#000000;font-size:0.8em;width:100%;"><br>
                    <img src="../image/dash.png" width="40"
                         style="position:relative;padding:5px;margin:5px;"><b>RIPPLE</b>
                    <p>Enter amount XRP  </p>
                    <p><span id='dshp' style="color:#333333;font-size:1.3em;"></span></p><br><input type="text" value="" class="coin_input">
                    <button class='exchange_button' onclick='get_purse(4,this);'>Show wallet</button>
                    <br></div>
                <div class='obmenu' id='rdd' style="color:#000000;font-size:0.8em;width:100%;"><br>
                    <img src="../image/redocoin.png" width="40" width="40"
                         style="position:relative;padding:5px;margin:5px;"><b>BITCOIN CASH</b>
                    <p>Enter amount BCH  </p>
                    <p><span id='mnrp' style="color:#333333;font-size:1.3em;"></span></p><br><input type="text" value="" class="coin_input">
                    <button class='exchange_button' onclick='get_purse(5,this);'>Show wallet</button>
                    <br></div>
                <div class='obmenu' id='eth' style="color:#000000;font-size:0.8em;width:100%;">
                    <img src="../image/ethereum.png" width="40" style="position:relative;padding:5px;margin:5px;"><b>ETHEREUM</b>
                    <p>Enter amount ETH  </p>
                    <p><span id='ethp' style="color:#333333;font-size:1.3em;"></span></p><br><input type="text" value="" class="coin_input">
                    <button class='exchange_button' onclick='get_purse(6,this);'>Show wallet</button>
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
    <?
} else {
    ?>
    <script>document.location.href = 'https://ibit.cash/login';</script><?
}

?>
