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
$SKU_PROPS = array();
foreach($arResult["SKU_PROPS"] as $CODE => $arr){
    #echo '111';pre($arr);
    foreach($arr["VALUES"] as $ID => $arr1){
        $SKU_PROPS[$ID] = $arr1["NAME"];
    }
}


#pre($arResult["OFFERS"]);


/*
$skuAvail=array();
$skuPriceFrom=array();
foreach($arResult["OFFERS"] as $offer){
    $tree=$offer["TREE"];
    if(!isset($skuAvail[$tree["PROP_8"]])){
      $skuAvail[$tree["PROP_8"]]=array();
      $skuPriceFrom[$tree["PROP_8"]]=array();
    }
    if(!isset($skuAvail[$tree["PROP_8"]][$tree["PROP_9"]])){
      $skuAvail[$tree["PROP_8"]][$tree["PROP_9"]]=array();
      $skuPriceFrom[$tree["PROP_8"]][$tree["PROP_9"]]=0;
    }
    array_push( $skuAvail[$tree["PROP_8"]][$tree["PROP_9"]], $tree["PROP_10"] );
    array_push( $skuAvail[$tree["PROP_8"]][$tree["PROP_9"]], $tree["PROP_11"] );
    array_push( $skuAvail[$tree["PROP_8"]][$tree["PROP_9"]], $tree["PROP_12"] );

    if($offer["MIN_PRICE"]["VALUE"] < $skuPriceFrom[$tree["PROP_8"]][$tree["PROP_9"]] || $skuPriceFrom[$tree["PROP_8"]][$tree["PROP_9"]]==0){
      $skuPriceFrom[$tree["PROP_8"]][$tree["PROP_9"]]=$offer["MIN_PRICE"]["VALUE"];
    }
}
#pre($skuAvail);
*/
?>



<?/*
<!--div class="presence"><b></b>В наличии в <a href="#">Екатеринбурге</a></div-->
*/?>
<div class="gallery_box">
		<?
    $photoCount=count($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"]);
    $isMorePhoto=is_array($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"]);
    if($isMorePhoto && $photoCount>1){?>
		<!-- gallery -->
    <div class="gallery gallery_small">

      <div class="sliderkit photosgallery-vertical">
        <div class="sliderkit-nav">
          <div class="sliderkit-nav-clip">
            <ul>
            	<?foreach($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"] as $arPic){?>
              <li>
                <a href="#" rel="nofollow" title="" class="photo_preview"><img src="<?=MakeImage($arPic,array("w"=>61,"h"=>61))?>" alt="" /></a>
              </li>
              <?}?>
              <li></li><!--не удалять пустой LI-->
            </ul>
          </div>
          <div class="sliderkit-btn sliderkit-nav-btn sliderkit-nav-prev"><a rel="nofollow" href="#" title="Previous line"><span>Previous</span></a></div>
          <div class="sliderkit-btn sliderkit-nav-btn sliderkit-nav-next"><a rel="nofollow" href="#" title="Next line"><span>Next</span></a></div>
        </div>
        <div class="sliderkit-panels">
        	<?foreach($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"] as $arPic){?>
        		<? $fullPath=CFile::GetPath($arPic);?>
          <div class="sliderkit-panel">
            <a href="<?=$fullPath?>" rel="gallery" class="fancybox"><img data-cloudzoom = "zoomImage: '<?=$fullPath?>'" class="cloudzoom" src="<?=MakeImage($arPic,array("w"=>462,"h"=>215))?>" alt="" /><span class="b zoom"></span></a>
          </div>
          <?}?>
        </div>
      </div>

      <div class="mobile_photo"><a href="<?=CFile::GetPath($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"][0])?>" class="fancybox"><img src="<?=MakeImage($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"][0],array("w"=>462,"h"=>215))?>" alt="" /><span class="b zoom"></span></a></div>
    </div>
    <!-- /gallery -->
		<?}elseif($isMorePhoto && $photoCount==1){?>
    <div class="gallery_wrap">
        <div class="gallery_wrap_in">
            <div class="single_photo single_photo_2">
			<a class="fancybox" rel="gallery"  href="<?=CFile::GetPath($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"][0])?>">
                <img data-cloudzoom="zoomImage:'<?=CFile::GetPath($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"][0])?>'" class="cloudzoom"  src="<?=MakeImage($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"][0],array("w"=>462,"h"=>215))?>" alt="">
             </a>
			 <?/*?><div class="note_box note2">
                    <em>Стол из <a href="#">коллекции «Президент»</a></em>
                </div><?*/?>
            </div>
        </div>
    </div>
		<?}elseif($arResult["DETAIL_PICTURE"]["SRC"]){?>
    <div class="gallery_wrap">
        <div class="gallery_wrap_in">
            <div class="single_photo single_photo_2">
                <img data-cloudzoom="zoomImage:'<?=$arResult["DETAIL_PICTURE"]["SRC"]?>'" class="cloudzoom"  src="<?=MakeImage($arResult["DETAIL_PICTURE"]["SRC"],array("w"=>462,"h"=>215))?>" alt="">
                <?/*?><div class="note_box note2">
                    <em>Стол из <a href="#">коллекции «Президент»</a></em>
                </div><?*/?>
            </div>
        </div>
    </div>
    <?}?>

	
    <div class="item_description_tab descrip_tab_2">
      <div class="pattern_bottom"></div>
      <div class="pattern_top"></div>
      <div class="item_head">Бильярдный кий для Русской пирамиды</div>
      <div class="item_tab_th_box">
        <div class="item_tab_th item_tab_th_1">Длина</div>
        <div class="item_tab_th item_tab_th_2">Вес</div>
        <div class="item_tab_th item_tab_th_3">Диаметр наклейки</div>
        <div class="clear"></div>
      </div>
	  
			
		<div class="offers_wrap">
		  <?
		  $i=1;
		  foreach($arResult["OFFERS"] as $arOffer){?>
		  <form class="offer_wrap check__<?=$arOffer["ID"]?> <?if(count($arResult["OFFERS"])==1):?>highlight<?endif?>" action="<?=SITE_TEMPLATE_PATH?>/ajax/add-cart.php" method="post">
		
			<input type="hidden" name="IBLOCK_ID" value="<?=$arResult["IBLOCK_ID"]?>">
			<input type="hidden" name="ID" value="<?=$arResult["ID"]?>">
			<input type="hidden" name="PRODUCT_PRICE_ID" value="<?=$arOffer["ID"]?>">
			<input type="hidden" name="LENGTH" value="<?=$arOffer["PROPERTIES"]["LENGTH"]["VALUE"]?>">
			<input type="hidden" name="WEIGHT" value="<?=$arOffer["PROPERTIES"]["WEIGHT"]["VALUE"]?>">
			<input type="hidden" name="STICKER" value="<?=$arOffer["PROPERTIES"]["STICKER"]["VALUE"]?>">
		    <div class="item_tab_td_box <?if(count($arResult["OFFERS"])==1):?>highlight<?endif?>">
		  	  <div class="item_tab_td item_tab_td_0 for-highlight"><label class="label_check"><input name="check" id="check__<?=$arOffer["ID"]?>" <?if(count($arResult["OFFERS"])==1):?>checked<?endif?> value="<?=$arOffer["ID"]?>" type="checkbox" /></label></div>
			  <div class="item_tab_td item_tab_td_1"><?=$arOffer["PROPERTIES"]["LENGTH"]["VALUE"]?></div>
			  <div class="item_tab_td item_tab_td_2"><?=$arOffer["PROPERTIES"]["WEIGHT"]["VALUE"]?></div>
			  <div class="item_tab_td item_tab_td_3"><?=$arOffer["PROPERTIES"]["STICKER"]["VALUE"]?></div>
			  <div class="clear"></div>
		    </div>
		  </form>
		  <?}?>
		  <?#pre($arResult["OFFERS"][0])?>
		  <div class="sum_2">
			<span class="strong"><?=number_format($arResult["OFFERS"][0]["MIN_PRICE"]["VALUE"], 0, ',', ' ')?> <span class="rub">i</span></span>
			<div class="buttons">
			  <input type="button" value="Купить" class="button but_buy add-to-cart2">
			  <a href="javascript:void(0);" title="В избранное" class="add_to_fav add_to_fav3"><span></span></a>
			</div>
		  </div>
	    </div>
    </div>	

    <div class="clear"></div>

</div>

<!-- description tabs -->
<div class="descrip_tabs">
    <div class="tabs-content">
        <ul class="tabs">
            <li class="current"><a href="#">Характеристики</a></li>
            <li><a href="#">Описание</a></li>
        </ul>
        <span class="spr"></span>

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
            </div>
        </div>
        <!-- /characteristics -->

        <!-- description -->
        <div class="box">
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

<!-- attended products -->

<?
if( is_array($arResult["PROPERTIES"]["OTHERS"]["VALUE"]) && count($arResult["PROPERTIES"]["OTHERS"]["VALUE"])){

  #pre($arResult["PROPERTIES"]["OTHERS"]["VALUE"]);

  $arOffers = CCatalogSKU::getOffersList($arResult["PROPERTIES"]["OTHERS"]["VALUE"]);

  #pre($arOffers);


  $arFilter = Array('ACTIVE'=>'Y',"ID"=>$arResult["PROPERTIES"]["OTHERS"]["VALUE"]);
  $db_list = CIBlockElement::GetList(Array("rand"=>"asc"),$arFilter,false,false,array("IBLOCK_ID","NAME","DETAIL_PAGE_URL","PREVIEW_PICTURE"));
  global $USER;
  ?>
  <!-- attended products -->
  <div class="attended">
    <h3>Сопутствующие товары</h3>
    <div class="items_slider">
      <?
      while($arItem = $db_list->GetNext()){
        #pre($arItem);
        if(isset($arOffers[$arItem["ID"]])){
          $min=null;
          foreach($arOffers[$arItem["ID"]] as $arOfferID => &$arOffer){
            $arr=GetCatalogProductPrice($arOfferID,1);
            if(is_null($min)) $min=$arr["PRICE"];
            if($arr["PRICE"] < $min) $min=$arr["PRICE"];
            $arOffers[$arItem["ID"]][$arOfferID]["PRICE"]=$arr["PRICE"];
          }
          $price = $min;
        }
        else{
          $arPrice = CCatalogProduct::GetOptimalPrice($arItem["ID"], 1, $USER->GetUserGroupArray());
          $price = $arPrice["PRICE"]["PRICE"];
        }
        ?>
        <div class="cat_box">
            <span class="cat_name">
              <span class="strong"><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a></span>
            </span>
			<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img src="<?=MakeImage($arItem["PREVIEW_PICTURE"],array("w"=>210,"h"=>223))?>" alt="<?=$arItem["NAME"]?>" /></a>
            <?
            
            #pre($arPrice);
            ?>
            <span class="price2">от <?=number_format($price,0,'',' ')?> <span class="rub">i</span></span>
            <?/*<span class="buttons_3">
              <a href="javascript:void(0);" class="add_to_cart2" title="В корзину"><b></b></a>
              <a href="javascript:void(0);" class="add_to_fav2" title="В избранное"><b></b></a>
            </span>*/?>
        </div>
        <?
      }
      #pre($arOffers);
      ?>
    </div>
  </div>
  <!-- /attended products -->
<?
}
?>


<!-- already viewed --> 
<?$APPLICATION->IncludeComponent(
"bitrix:catalog.viewed.products",
    "",
    Array(
        "IBLOCK_TYPE" => "catalog",
        "IBLOCK_ID" => $arParams['IBLOCK_ID'],
        "SHOW_FROM_SECTION" => "N",
        "HIDE_NOT_AVAILABLE" => "N",
        "SHOW_DISCOUNT_PERCENT" => "Y",
        "PRODUCT_SUBSCRIPTION" => "N",
        "SHOW_NAME" => "Y",
        "SHOW_IMAGE" => "Y",
        "MESS_BTN_BUY" => "Купить",
        "MESS_BTN_DETAIL" => "Подробнее",
        "MESS_BTN_SUBSCRIBE" => "Подписаться",
        "PAGE_ELEMENT_COUNT" => "5",
        "LINE_ELEMENT_COUNT" => "3",
        "TEMPLATE_THEME" => "blue",
        "DETAIL_URL" => "",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000",
        "CACHE_GROUPS" => "Y",
        "SHOW_OLD_PRICE" => "N",
        "PRICE_CODE" => array("BASE"),
        "SHOW_PRICE_COUNT" => "1",
        "PRICE_VAT_INCLUDE" => "Y",
        "CONVERT_CURRENCY" => "N",
        "BASKET_URL" => "/personal/basket.php",
        "ACTION_VARIABLE" => "action",
        "PRODUCT_ID_VARIABLE" => "id",
        "ADD_PROPERTIES_TO_BASKET" => "Y",
        "PRODUCT_PROPS_VARIABLE" => "prop",
        "PARTIAL_PRODUCT_PROPERTIES" => "N",
        "USE_PRODUCT_QUANTITY" => "N",
        "SHOW_PRODUCTS_".$arParams['IBLOCK_ID'] => "Y",
        "SECTION_ID" => $GLOBALS["CATALOG_CURRENT_SECTION_ID"],
        "SECTION_CODE" => "",
        "SECTION_ELEMENT_ID" => $GLOBALS["CATALOG_CURRENT_ELEMENT_ID"],
        "SECTION_ELEMENT_CODE" => "",
        "DEPTH" => "2",
        "PRODUCT_QUANTITY_VARIABLE" => "quantity",
        "PROPERTY_CODE_2" => array(""),
        "CART_PROPERTIES_2" => array("", ""),
        "ADDITIONAL_PICT_PROP_2" => "MORE_PHOTO",
        "LABEL_PROP_2" => "NEWPRODUCT",
        "PROPERTY_CODE_3" => array(""),
        "CART_PROPERTIES_3" => array(""),
        "ADDITIONAL_PICT_PROP_3" => "MORE_PHOTO",
        "OFFER_TREE_PROPS_3" => array("")
    )
);?>
<!-- /already viewed -->