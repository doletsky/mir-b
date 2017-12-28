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
<div class="services">
  <div class="serv_box">
  	<?foreach($arResult["ITEMS"] as $i => $arItem){?>
  	<?if($i>0 && $i%2==0){?>
  		</div><div class="serv_box">
  	<?}?>
    <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
      <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="">
	    <span>
	      <strong><?=$arItem["NAME"]?></strong>
	      <b></b>
	    </span>
    </a>
    <?}?>
  </div>
  <div class="clear"></div>
</div>
