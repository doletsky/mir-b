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
<div class="articles_news">
  <div class="tabs-content">
    <div class="box visible">
      <ul>
      	<?foreach($arResult["ITEMS"] as $arItem){?>
        <li>
          <b>&mdash;</b>
          <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a>
          <p><?=$arItem["PREVIEW_TEXT"]?></p>
          <span><?=$arItem["DISPLAY_ACTIVE_FROM"]?></span>
        </li>
        <?}?>
      </ul>
      <?=$arResult["NAV_STRING"]?>
    </div>
</div>