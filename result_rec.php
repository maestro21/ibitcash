<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>

<?
if (isset($_POST["m_operation_id"]) && isset($_POST["m_sign"]))
{
	CModule::IncludeModule("iblock");
	CModule::IncludeModule("sale");
	
	if (!($arOrder = CSaleOrder::GetByID(intval($_POST["m_orderid"]))))
	{
		echo $arOrder["ID"]."|error";
		exit;
	}
	
	CSalePaySystemAction::InitParamArrays($arOrder, $arOrder["ID"]);

	$m_id = CSalePaySystemAction::GetParamValue("m_id");
	$m_key = CSalePaySystemAction::GetParamValue("m_key");

	
	$arHash = array( $_POST['m_operation_id'],
					 $_POST['m_operation_ps'],
					 $_POST['m_operation_date'],
					 $_POST['m_operation_pay_date'],
					 $_POST['m_shop'],
					 $_POST['m_orderid'],
					 $_POST['m_amount'],
					 $_POST['m_curr'],
					 $_POST['m_desc'],
					 $_POST['m_status'],
					 $m_key);
	$sign_hash = strtoupper(hash('sha256', implode(":", $arHash)));
	
	if ($_POST["m_sign"] == $sign_hash && $_POST['m_status'] == "success")
	{
		if ($arOrder["PAYED"]=="N")
		{			
			$arFields = array(
				"PS_STATUS" => "Y",
				"PS_STATUS_CODE" => "-",
				"PS_STATUS_DESCRIPTION" => $_POST['m_operation_id'],
				"PS_STATUS_MESSAGE" => $_POST['m_operation_ps'],
				"PS_SUM" => $_POST["m_amount"],
				"PS_CURRENCY" => $_POST["m_curr"],
				"PS_RESPONSE_DATE" => date(CDatabase::DateFormatToPHP(CLang::GetDateFormat("FULL", LANG))),
				"USER_ID" => $arOrder["USER_ID"],
			);
						
			if (CSaleOrder::Update($arOrder["ID"], $arFields))
			{	
				if ($arOrder["PRICE"] == $_POST["m_amount"] && $arOrder["CURRENCY"]==$_POST["m_curr"])
				{
					CSaleOrder::PayOrder($arOrder["ID"], "Y", false);
					CSaleOrder::StatusOrder($arOrder["ID"], "F");
					
					echo $arOrder["ID"]."|success";
					exit;
				}
			}	
		}
		else
		{
			echo $arOrder["ID"]."|payed";
			exit;
		}
	}

	echo $arOrder["ID"]."|error";
}
?>