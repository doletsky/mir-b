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
<?
#pre($arResult["OFFERS"]);
$CODES=array("TABLE","CUES","ACCESS","FURNITURE");
$elementsCount=0;
$sum=0;
foreach($CODES as $CODE){
  #$CODE=$CODES[0];
  $arResult[$CODE]=array();
  $arSelect = Array("ID", "NAME", "PREVIEW_PICTURE", "DETAIL_PICTURE", "DETAIL_PAGE_URL","CATALOG_GROUP_1", "PROPERTY_*");
  $arFilter = Array("IBLOCK_ID"=>$arResult["PROPERTIES"][$CODE]["LINK_IBLOCK_ID"], "ACTIVE"=>"Y", "ID"=>$arResult["PROPERTIES"][$CODE]["VALUE"]);
  #pre($arFilter);
  $res = CIBlockElement::GetList(Array("sort"=>"asc"), $arFilter, false, false, $arSelect);
  while($obElement = $res->GetNextElement()){
	$arElement = $obElement->GetFields();
    $minPrice=null;
	$arElement['PROPERTIES'] = $obElement->GetProperties();
	
    if($arElement["CATALOG_PRICE_1"]) $minPrice=$arElement["CATALOG_PRICE_1"];

    $arOffers=CCatalogSKU::getOffersList($arElement["ID"],$arResult["PROPERTIES"][$CODE]["LINK_IBLOCK_ID"],array(),array("CATALOG_GROUP_1"),array("CODE"=>array()) );
    foreach($arOffers[$arElement["ID"]] as $arOffer){
      if(is_null($minPrice)) $minPrice=$arOffer["CATALOG_PRICE_1"];
      if($minPrice>$arOffer["CATALOG_PRICE_1"]) $minPrice=$arOffer["CATALOG_PRICE_1"];
    }
    $arElement["MIN_PRICE"]=$minPrice;
    #pre($arElement);
    $arResult[$CODE][]=$arElement;
    $sum+=$arElement["MIN_PRICE"];
  }
  $elementsCount+=count($arResult[$CODE]);
}
$sum = number_format((int)$sum, 0, ',', ' ');
?>



<?if($arResult["PROPERTIES"]["IS_EXISTS"]["VALUE_XML_ID"]=="Y"){?>
<div class="presence"><span class="b"></span>В наличии в <a href="">Екатеринбурге</a></div>
<?}?>
<?/*
<!--div class="presence"><b></b>В наличии в <a href="#">Екатеринбурге</a></div-->
*/?>
<div class="gallery">
    <?#pre($arResult)?>
    <div class="sliderkit photosgallery-vertical">
      <div class="sliderkit-nav">           
        <div class="sliderkit-nav-clip">
          <ul>
            <li style="display:none;">
              <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" rel="nofollow" title="" class="photo_preview">
                <img src="<?=MakeImage($arResult['PREVIEW_PICTURE']["SRC"],array("w"=>111,"h"=>60))?>" alt="" />
              </a>
             
            </li>
            <?foreach($CODES as $CODE){?>
              <?foreach($arResult[$CODE] as $arElement){
			  ?>
                <li>
                 <a href="<?=$arElement["DETAIL_PAGE_URL"]?>" rel="nofollow" title="" class="photo_preview">
                    <img src="<?=MakeImage($arElement['PREVIEW_PICTURE'],array("w"=>111,"h"=>60))?>" alt="" />
                  </a>
                  <div class="descrip">
                    <p>
                      <a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><?=$arElement["NAME"]?></a>
                      <span><?=number_format((int)$arElement["MIN_PRICE"],0,',',' ')?> <span class="rub">i</span></span>
                    </p>
                  </div>
                </li>
              <?}?>
            <?}?>
            <li></li>
          </ul>
        </div>
        <div class="sliderkit-btn sliderkit-nav-btn sliderkit-nav-prev"><a rel="nofollow" href="#" title="Previous line"><span>Previous</span></a></div>
        <div class="sliderkit-btn sliderkit-nav-btn sliderkit-nav-next"><a rel="nofollow" href="#" title="Next line"><span>Next</span></a></div>
      </div>
      <div class="sliderkit-panels">
        <div class="sliderkit-panel">
          <a rel="gallery" class="fancybox" href="<?=MakeImage($arResult['DETAIL_PICTURE']["SRC"],array())?>"><img src="<?=MakeImage($arResult['DETAIL_PICTURE']["SRC"],array("w"=>522,"h"=>290))?>" alt="" /></a>
        </div>
        <?foreach($CODES as $CODE){?>
          <?foreach($arResult[$CODE] as $arElement){?>
          <div class="sliderkit-panel">
             <a rel="gallery" class="fancybox" href="<?=MakeImage($arElement['DETAIL_PICTURE'],array())?>"><img src="<?=MakeImage($arElement['DETAIL_PICTURE'],array("w"=>522,"h"=>290))?>" alt="" /></a>
          </div>
          <?}?>
        <?}?>
      </div>
    </div>
    
    <div class="mobile_photo"><img src="<?=MakeImage($arResult['DETAIL_PICTURE']["SRC"],array("w"=>522,"h"=>290))?>" alt="" /></div>
    
    <div class="buy">
      <div class="buttons">
	  	 <form action="<?=SITE_TEMPLATE_PATH?>/ajax/add-cart.php" method="post">
			<input type="hidden" name="IBLOCK_ID" value="<?=$arResult["IBLOCK_ID"]?>">
			<input type="hidden" name="ID" value="<?=$arResult["ID"]?>">
        <input type="button" value="Купить" class="button but_buy add-to-cart">
        <a href="javascript:void(0);" title="В избранное" class="add_to_fav"><span></span></a>
		</form>
      </div>
      <p>от <?=$sum?> <span class="rub">i</span><span class="em">за <?=$elementsCount?> <?=words($elementsCount,"предмет","предмета","предметов")?></span></p>
    </div>

</div>

<?
$arr=array("COLOR","GAMMA","GAME_TYPE","WATER_REPELLENT","FIXING_CEILING","MOUNTING_KIT","","","","","");
$hasChars=false;
foreach($arr as $k){
  if(isset($arResult["PROPERTIES"][$k]["VALUE"]) && $arResult["PROPERTIES"][$k]["VALUE"]){
    $hasChars=true;
  }
}
?>

<? if($arResult['PROPERTIES']['TABLE']['VALUE'][0]){?>
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.element", 
	"collection_table", 
	array(
		"TEMPLATE_THEME" => "blue",
		"DISPLAY_NAME" => "Y",
		"DETAIL_PICTURE_MODE" => "IMG",
		"ADD_DETAIL_TO_SLIDER" => "Y",
		"ADD_PICT_PROP" => "-",
		"LABEL_PROP" => "-",
		"DISPLAY_PREVIEW_TEXT_MODE" => "E",
		"PRODUCT_SUBSCRIPTION" => "Y",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_OLD_PRICE" => "N",
		"SHOW_MAX_QUANTITY" => "N",
		"SHOW_CLOSE_POPUP" => "Y",
		"DISPLAY_COMPARE" => "Y",
		"COMPARE_PATH" => "",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_BTN_COMPARE" => "Сравнить",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"USE_VOTE_RATING" => "N",
		"USE_COMMENTS" => "N",
		"BRAND_USE" => "N",
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "4",
		"ELEMENT_ID" => $arResult["PROPERTIES"]["TABLE"]["VALUE"][0],
		"ELEMENT_CODE" => "",
		"SECTION_ID" => "",
		"SECTION_CODE" => "",
		"SECTION_URL" => "",
		"DETAIL_URL" => "",
		"BASKET_URL" => "/personal/basket.php",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"CHECK_SECTION_ID_VARIABLE" => "N",
		"SEF_MODE" => "N",
		"SET_TITLE" => "N",
		"SET_CANONICAL_URL" => "N",
		"SHOW_DEACTIVATED" => "N",
		"SET_BROWSER_TITLE" => "N",
		"BROWSER_TITLE" => "-",
		"SET_META_KEYWORDS" => "N",
		"META_KEYWORDS" => "-",
		"SET_META_DESCRIPTION" => "N",
		"META_DESCRIPTION" => "-",
		"SET_LAST_MODIFIED" => "N",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_ELEMENT_CHAIN" => "N",
		"PROPERTY_CODE" => array(
			0 => "ABSORBETS",
			1 => "ADDITION",
			2 => "IS_EXISTS",
			3 => "LUZA",
			4 => "MIN_PRICE_FOR_SORT",
			5 => "IS_NEW",
			6 => "OTHERS",
			7 => "IS_SPEC",
			8 => "CLOTH",
			9 => "TABLE_TYPE",
			10 => "TREE_COLOR",
			11 => "CLOTH_COLOR",
			12 => "",
		),
		"OFFERS_FIELD_CODE" => array(
			0 => "",
			1 => "ID",
			2 => "CODE",
			3 => "XML_ID",
			4 => "NAME",
			5 => "TAGS",
			6 => "SORT",
			7 => "PREVIEW_TEXT",
			8 => "PREVIEW_PICTURE",
			9 => "DETAIL_TEXT",
			10 => "DETAIL_PICTURE",
			11 => "DATE_ACTIVE_FROM",
			12 => "ACTIVE_FROM",
			13 => "DATE_ACTIVE_TO",
			14 => "ACTIVE_TO",
			15 => "SHOW_COUNTER",
			16 => "SHOW_COUNTER_START",
			17 => "IBLOCK_TYPE_ID",
			18 => "IBLOCK_ID",
			19 => "IBLOCK_CODE",
			20 => "IBLOCK_NAME",
			21 => "IBLOCK_EXTERNAL_ID",
			22 => "DATE_CREATE",
			23 => "CREATED_BY",
			24 => "CREATED_USER_NAME",
			25 => "TIMESTAMP_X",
			26 => "MODIFIED_BY",
			27 => "USER_NAME",
			28 => "",
		),
		"OFFERS_PROPERTY_CODE" => array(
			0 => "SIZE",
			1 => "WEIGHT",
			2 => "MATERIAL",
			3 => "BASE_TYPE",
			4 => "",
		),
		"OFFERS_SORT_FIELD" => "sort",
		"OFFERS_SORT_ORDER" => "asc",
		"OFFERS_SORT_FIELD2" => "name",
		"OFFERS_SORT_ORDER2" => "desc",
		"OFFERS_LIMIT" => "0",
		"BACKGROUND_IMAGE" => "-",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"USE_PRICE_COUNT" => "Y",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"PRICE_VAT_SHOW_VALUE" => "Y",
		"PRODUCT_PROPERTIES" => array(
		),
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"USE_PRODUCT_QUANTITY" => "Y",
		"LINK_IBLOCK_TYPE" => "",
		"LINK_IBLOCK_ID" => "",
		"LINK_PROPERTY_SID" => "",
		"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
		"SET_VIEWED_IN_COMPONENT" => "N",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_NOTES" => "",
		"CACHE_GROUPS" => "Y",
		"USE_ELEMENT_COUNTER" => "Y",
		"HIDE_NOT_AVAILABLE" => "N",
		"GIFTS_DETAIL_BLOCK_TITLE" => "Выберите один из подарков",
		"GIFTS_DETAIL_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_DETAIL_PAGE_ELEMENT_COUNT" => "3",
		"GIFTS_DETAIL_TEXT_LABEL_GIFT" => "Подарок",
		"GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE" => "Выберите один из товаров, чтобы получить подарок",
		"GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT" => "3",
		"GIFTS_MESS_BTN_BUY" => "Выбрать",
		"GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
		"GIFTS_SHOW_IMAGE" => "Y",
		"GIFTS_SHOW_NAME" => "Y",
		"GIFTS_SHOW_OLD_PRICE" => "Y",
		"USE_GIFTS_DETAIL" => "Y",
		"USE_GIFTS_MAIN_PR_SECTION_LIST" => "Y",
		"OFFERS_CART_PROPERTIES" => array(
		),
		"ADD_TO_BASKET_ACTION" => array(
			0 => "BUY",
			1 => "ADD",
		),
		"SHOW_BASIS_PRICE" => "N",
		"CONVERT_CURRENCY" => "Y",
		"CURRENCY_ID" => "RUB",
		"QUANTITY_FLOAT" => "N",
		"COMPONENT_TEMPLATE" => "collection_table",
		"OFFER_ADD_PICT_PROP" => "-",
		"OFFER_TREE_PROPS" => array(
		)
	),
	false
);?>
<?}?>
  <?foreach($CODES as $CODE){?>
              <?foreach($arResult[$CODE] as $arElement){
			  if($arElement["IBLOCK_ID"]==4) continue;

			  ?>
		<div class="item_box_2">

          <div class="item_photo_2">
		    
			<?if($arElement['PROPERTIES']['MORE_PHOTO']['VALUE']):?>
				<div class="flexslider">
					<ul class="slides">
					  <li><a href="#"><img src="<?=MakeImage($arElement['PREVIEW_PICTURE'],array("w"=>170,"h"=>150))?>" alt=""></a></li>
					    <?foreach($arElement['PROPERTIES']['MORE_PHOTO']['VALUE'] as $Photo):?>
							<li><a href="#"><img src="<?=MakeImage($Photo,array("w"=>170,"h"=>150))?>" alt=""></a></li>
						<?endforeach?>
					</ul>
				</div>
			<?else:?>
				<a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><img src="<?=MakeImage($arElement['PREVIEW_PICTURE'],array("w"=>170,"h"=>150))?>" alt=""></a>
			<?endif;?>
          
			
			


          </div>
          <div class="item_description">
            <div class="headline_2">
              <div class="h3"><a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><?=$arElement["NAME"]?></a></div>
              <div class="price">
                <div class="buttons_2">
				 <form action="<?=SITE_TEMPLATE_PATH?>/ajax/add-cart.php" method="post">
					<input type="hidden" name="IBLOCK_ID" value="<?=$arElement["IBLOCK_ID"]?>">
					<input type="hidden" name="ID" value="<?=$arElement["ID"]?>">
                    <a href="javascript:void(0);" class="add_to_cart2 add-to-cart" title="В корзину"><span class="b"></span></a>
                    <a href="javascript:void(0);" class="add_to_fav2 add_to_fav" title="В избранное"><span class="b"></span></a>
				  </form>
                </div>
                <p>от <?=number_format((int)$arElement["MIN_PRICE"],0,',',' ')?> <span class="rub">i</span></p>
              </div>
            </div>
            <div class="details">
				<?
				if($arElement['IBLOCK_ID']==9 && $arElement['PROPERTIES']['LUMINAIRE_TYPE']['VALUE']=='') $arShowProps = array('CIE_COUNT','MATERIAL','HEIGHT', 'WIDTH');
				elseif($arElement['IBLOCK_ID']==9) $arShowProps = array('LUMINAIRE_TYPE','COLOR','MOUNTING_KIT');
	
				?>
				
			<?foreach($arElement['PROPERTIES'] as $key=>$arProp):?>
			<?if(in_array($key,$arShowProps)):?>
			  <div class="detail_2">
                <span class="strong"><?=$arProp['NAME']?></span> <?=$arProp['VALUE']?>
              </div>
			  <?endif?>
			<?endforeach?>
            
            
            </div>
          </div>

         <div class="item_photo_2 item_photo_mob">
            <a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><img src="<?=MakeImage($arElement['PREVIEW_PICTURE'],array("w"=>170,"h"=>150))?>" alt=""></a>
          </div>

        </div>

        <span class="spr item_spr"></span>
<?}?>
<?}?>
<!-- description tabs -->
<div class="descrip_tabs">
    <div class="tabs-content">
        <ul class="tabs">
          <?if($hasChars){?>
          <li class="current"><a href="#">Характеристики</a></li>
          <?}?>
          <li <?if(!$hasChars){?>class="current"<?}?> ><a href="#">Описание</a></li>
        </ul>
        <span class="spr"></span>

        <?if($hasChars){?>
        <!-- characteristics -->
        <div class="box visible">
            <div class="char_list">
              <span class="b"></span>
              <?if($arResult["PROPERTIES"]["COLOR"]["VALUE"]){?>
              <p>Цвет</p>
              <span><?=$arResult["PROPERTIES"]["COLOR"]["VALUE"]?></span>
              <?}?>

              <?if($arResult["PROPERTIES"]["GAMMA"]["VALUE"]){?>
              <p>Цветовая гамма</p>
              <span><?=$arResult["PROPERTIES"]["GAMMA"]["VALUE"]?></span>
              <?}?>

              <?if($arResult["PROPERTIES"]["GAME_TYPE"]["VALUE"]){?>
              <p>Тип игры</p>
              <span><?=$arResult["PROPERTIES"]["GAME_TYPE"]["VALUE"]?></span>
              <?}?>

              <?if($arResult["PROPERTIES"]["WATER_REPELLENT"]["VALUE"]){?>
              <p>Водоотталкивающая пропитка</p>
              <span><?=$arResult["PROPERTIES"]["WATER_REPELLENT"]["VALUE"]?></span>
              <?}?>

              <?if($arResult["PROPERTIES"]["FIXING_CEILING"]["VALUE"]){?>
              <p>Крепление плафона</p>
              <span><?=$arResult["PROPERTIES"]["FIXING_CEILING"]["VALUE"]?></span>
              <?}?>

              <?if($arResult["PROPERTIES"]["MOUNTING_KIT"]["VALUE"]){?>
              <p>Крепежный набор</p>
              <span><?=$arResult["PROPERTIES"]["MOUNTING_KIT"]["VALUE"]?></span>
              <?}?>
              
            </div>
        </div>
        <!-- /characteristics -->
        <?}?>

        <!-- description -->
        <div class="box <?if(!$hasChars){?>visible<?}?>">
            <?#pre($arResult)?>
            <article>
                <?=$arResult["DETAIL_TEXT"]?>
                <div class="clear"></div>
            </article>
        </div>
        <!-- /description -->

		
		
        <span class="spr"></span>
    </div>
</div>
<!-- /description tabs -->

