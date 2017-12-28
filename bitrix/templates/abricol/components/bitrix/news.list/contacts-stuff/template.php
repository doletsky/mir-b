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
<!-- employees -->
<div class="employees">
  <h5>Сотрудники</h5>
  <?foreach($arResult["ITEMS"] as $arItem){?>
  <div class="employee_box">
    <div class="employee_box__pic">
      <div class="employee_box__img">
        <img src="<?=MakeImage($arItem["PREVIEW_PICTURE"]["SRC"],array("w"=>141,"h"=>163,"zc"=>1))?>" alt="">
      </div>
      <div class="employee_box__stat">
        <span class="employee_box__stat-name"><?=$arItem["~NAME"]?></span>
        <em class="employee_box__stat-role"><?=$arItem["PROPERTIES"]["POSITION"]["VALUE"]?></em>
      </div>
    </div>
    <div class="employee_box__desc"><?=$arItem["PREVIEW_TEXT"]?></div>
  </div>
  <?}?>
</div>
 <!-- /employees -->