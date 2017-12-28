<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<?#pre($arResult);?>
<?if($arResult["SECTION"]["UF_PRICELIST"]){?>
<a href="<?=CFile::GetPath($arResult["SECTION"]["UF_PRICELIST"])?>" class="price_download" target="_blank">
  <b></b><?if($arResult["SECTION"]["UF_PRICELIST_TITLE"]){ echo $arResult["SECTION"]["UF_PRICELIST_TITLE"]; }else{?>Скачать прайс-лист<?}?>
</a>
<?}?>