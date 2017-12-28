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
<?#pre($arResult);
if(count($arResult['SECTIONS'])){
?>
<ul class="catalogue_list sections-list">
<?
foreach ($arResult['SECTIONS'] as $arSection){
	#pre($arSection);
?>
	<li>
    <div href="<?=$arSection["SECTION_PAGE_URL"]?>" class="cat_box">
	<span class="cat_name"> 
				<span class="strong"><a href="<?=$arSection["SECTION_PAGE_URL"]?>"><?=$arSection["NAME"]?></a></span>
				<span class="b"><?if($arSection["ELEMENT_CNT"]){?><?=(int)$arSection["ELEMENT_CNT"]?><?}?></span>
			</span>
      <?if($arSection["PICTURE"]["SRC"]){?><a href="<?=$arSection["SECTION_PAGE_URL"]?>"><img src="<?=MakeImage($arSection["PICTURE"]["SRC"],array("w"=>296,"h"=>150,"zc"=>0))?>" alt="" /></a><?}?>
			
      <?if($arSection["UF_PRICE_FROM"]){?><span class="price2">от <?=number_format($arSection["UF_PRICE_FROM"],0,'.',' ')?> <span class="rub">i</span></span><?}?>
    </div>
  </li>
<?
}
?>
</ul>
<?
}
?>