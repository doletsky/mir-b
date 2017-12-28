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
<!-- services -->
<div class="photo_box">
	<?foreach($arResult["ITEMS"] as $i => $arItem){?>
		<div class="<?=$arItem['NAME']?>">
			<a href="<?=$arItem['DISPLAY_PROPERTIES']['LINK']['DISPLAY_VALUE']?>">
				<img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="">
				<?if($arItem['DETAIL_PICTURE']['SRC']):?>
					<img src="<?=$arItem['DETAIL_PICTURE']['SRC']?>" alt="">
				<?endif?>
				<?=$arItem['PREVIEW_TEXT']?>
			</a>
		</div>
     <?}?>


  <div class="clear"></div>
</div> 

    
<!-- /services -->