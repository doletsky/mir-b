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
<!-- certificates -->
<div class="certificates">
	<h5>Сертификаты</h5>
	<div class="certificates_slider">
		<?foreach($arResult["ITEMS"] as $arItem){?>
		<div class="certificate">
 			<img src="<?=MakeImage($arItem["PREVIEW_PICTURE"]["SRC"],array("w"=>188,"h"=>259))?>" alt=""><?=$arItem["~NAME"]?>
		</div>
		<?}?>
	</div>
</div>
<!-- /certificates -->