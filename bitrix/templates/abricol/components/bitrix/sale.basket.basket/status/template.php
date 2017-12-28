<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixBasketComponent $component */
?>
<?
#pre($arResult);
$items=$arResult["ITEMS"]["AnDelCanBuy"];
$count=0;
foreach($items as $item){
	$count+=$item["QUANTITY"];
}
?>
<script>
$("#cart .items_num, #mobile_cart .items_num").text(<?=$count?>);
</script>