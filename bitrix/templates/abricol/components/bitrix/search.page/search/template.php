<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
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
?>
<p class="sisea-results">Найдено <?=$arResult["NAV_RESULT"]->NavRecordCount?> <?plural_form(
	  $arResult["NAV_RESULT"]->NavRecordCount,
	  array('страница','страницы','страниц')
	);?></p>
			<div class="sisea-results-list">
			<?
			$i=0;
			if(!$_GET['PAGEN_1'])
				$_GET['PAGEN_1']=1;
			else
				$i = ($_GET['PAGEN_1']-1)*($arResult["NAV_RESULT"]->NavPageSize);
				
			
			foreach($arResult["SEARCH"] as $arItem):
			
			$i++;
			?>
				<div class="sisea-result">
					<div class="clearfix">
						<div class="title"><?=$i?> <a href="<?echo $arItem["URL"]?>" title=""><?echo $arItem["TITLE"]?></a></div>
						<div class="result_bread_crumbs clearfix">
							<?if($arItem["CHAIN_PATH"]):?>
							
								<?=str_replace("&nbsp;/&nbsp;","&nbsp;»&nbsp;",$arItem["CHAIN_PATH"])?>
							<?endif;?></div>
					</div>
					<div class="extract"><p><?echo str_replace(array("<b>","</b>"), array('<span class="sisea-highlight">','</span>'), $arItem["BODY_FORMATED"])?></p></div>
				</div>
			<?endforeach?>
				
				
				
			</div>
			<?if($arParams["DISPLAY_BOTTOM_PAGER"] != "N") echo $arResult["NAV_STRING"]?>
			

