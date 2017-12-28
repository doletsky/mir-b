<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
#pre($_POST);
if(!CModule::IncludeModule("sale")) return;
if(!CModule::IncludeModule("iblock")) return;

if(isset($_REQUEST['IBLOCK_ID']) && isset($_REQUEST['ID']) ){

	$arProduct=array();
	$arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL", "PREVIEW_PICTURE", "CATALOG_PRICE_1", "PROPERTY_MIN_PRICE_FOR_SORT");
	$arFilter = Array("IBLOCK_ID"=>(int)$_REQUEST['IBLOCK_ID'], "ACTIVE"=>"Y", "ID"=>(int)$_REQUEST["ID"]);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	while($ob = $res->GetNextElement()){
		$arProduct = $ob->GetFields();
	}

	$offerIBlockID=array(
		4 => 5,
		7 => 8,
		9 => 10
	);
	$input=$_POST;
	unset($input["IBLOCK_ID"],$input["ID"]);
	$ak=array_keys($input);
	
	$arOffer=null;
	$CODEs=array();
	if(isset($offerIBlockID[$_REQUEST['IBLOCK_ID']])){

		$arSelect = Array("ID","PROPERTY_*", "CATALOG_GROUP_1", "CATALOG_PRICE_ID_1");
		$arFilter = Array("IBLOCK_ID"=>$offerIBlockID[$_REQUEST['IBLOCK_ID']], "PROPERTY_CML2_LINK"=>$_REQUEST['ID'] ,"ACTIVE"=>"Y");
		foreach($ak as $key){
			if($_REQUEST[$key]!=0){
				$arFilter["PROPERTY_".$key]=$_REQUEST[$key];
				$arSelect[]="PROPERTY_".$key;
				$CODEs[]=$key;
			}
		}
		pre($arFilter);
		$res = CIBlockElement::GetList(Array("CATALOG_PRICE_ID_1"=>"DESC"), $arFilter, false, false, $arSelect);
		
		while($ob = $res->GetNextElement()){
			$arOffer = $ob->GetFields();
			
		}
	}
	//pre($arOffer);

	global $USER;

	if(isset($arOffer)){
		$arPrice = CPrice::GetByID($arOffer["CATALOG_PRICE_ID_1"]);
	}else{
		$arPrice = CPrice::GetBasePrice($_REQUEST["ID"]);
	}
	if($_REQUEST['IBLOCK_ID']==6){
		$arPrice['PRICE'] = $arProduct['PROPERTY_MIN_PRICE_FOR_SORT_VALUE'];
	}
	echo $arPrice['PRICE'];
	if(!$_REQUEST["PRODUCT_PRICE_ID"]) $_REQUEST["PRODUCT_PRICE_ID"] = 1;
	$arFields = array(
	    "PRODUCT_ID" => (int)$_REQUEST["ID"],
	    "PRODUCT_PRICE_ID" => (int)$_REQUEST["PRODUCT_PRICE_ID"],
	    "PRICE" => 	$arPrice['PRICE'],
	    "CURRENCY" => "RUB",
	    "QUANTITY" => 1,
	    "LID" => LANG,
	    "DELAY" => "N",
	    "CAN_BUY" => "Y",
	    "NAME" => $arProduct["NAME"],
	    "MODULE" => "catalog",
	    "NOTES" => "",
	    "DETAIL_PAGE_URL" => $arProduct["DETAIL_PAGE_URL"],
	    //"PRODUCT_PROVIDER_CLASS" => "CCatalogProductProvider"
	);

	$property_enums = CIBlockProperty::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID"=>$offerIBlockID[$_REQUEST['IBLOCK_ID']]));
	while($enumFields = $property_enums->GetNext()){
		//pre($enumFields);
		
		$fields[$enumFields["CODE"]]=$enumFields;
	}

	$arProps = array();
	foreach($CODEs as $CODE){
		$arProps[] = array(
			"NAME" => $fields[$CODE]["NAME"],
			"CODE" => $CODE,
			"VALUE" => $arOffer["PROPERTY_".$CODE."_VALUE"]
		);
	}

	$arFields["PROPS"] = $arProps;
	//pre($arFields);
	$isOK=CSaleBasket::Add($arFields);

	#var_dump($isOK);
	
	$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_TEMPLATE_PATH."/ajax/basket-status.php"), false);
}
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>