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

<div class="turnkey">
  <div class="wrap">
	  <?/*<div class="headline"><div class="h2">Бильярд под ключ</div></div>*/?>
    <div class="steps">
	<?foreach($arResult["ITEMS"] as $i => $arItem){

	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
      <div class="step_box" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <span class="<?=$arItem["DISPLAY_PROPERTIES"]['CLASS']['DISPLAY_VALUE']?>"></span>
        <a href="<?=$arItem["DISPLAY_PROPERTIES"]['LINK']['DISPLAY_VALUE']?>"><?=$arItem["NAME"]?></a>
        <div class="clear"></div>
      </div>
      <?}?>
    </div>
  </div>
</div> 
