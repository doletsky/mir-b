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
$CODES=array("TABLE","CUES","ACCESS","FURNITURE");
if(!empty($arResult['ITEMS'])){
  foreach($arResult["ITEMS"] as $arItem){

    $elementsCount=0;
    $sum=0;

    foreach($CODES as $CODE){
      #$CODE=$CODES[0];
      $arItem[$CODE]=array();
      $arSelect = Array("ID", "NAME", "PREVIEW_PICTURE", "DETAIL_PICTURE", "DETAIL_PAGE_URL","CATALOG_GROUP_1");
      $arFilter = Array("IBLOCK_ID"=>$arItem["PROPERTIES"][$CODE]["LINK_IBLOCK_ID"], "ACTIVE"=>"Y", "ID"=>$arItem["PROPERTIES"][$CODE]["VALUE"]);
      #pre($arFilter);
      $res = CIBlockElement::GetList(Array("sort"=>"asc"), $arFilter, false, false, $arSelect);
      while($arElement = $res->GetNext()){
        $minPrice=null;
        if($arElement["CATALOG_PRICE_1"]) $minPrice=$arElement["CATALOG_PRICE_1"];

        $arOffers=CCatalogSKU::getOffersList($arElement["ID"],$arItem["PROPERTIES"][$CODE]["LINK_IBLOCK_ID"],array(),array("CATALOG_GROUP_1"),array("CODE"=>array()) );
        foreach($arOffers[$arElement["ID"]] as $arOffer){
          if(is_null($minPrice)) $minPrice=$arOffer["CATALOG_PRICE_1"];
          if($minPrice>$arOffer["CATALOG_PRICE_1"]) $minPrice=$arOffer["CATALOG_PRICE_1"];
        }
        $arElement["MIN_PRICE"]=$minPrice;
        #pre($arElement);
        $arItem[$CODE][]=$arElement;
        $sum+=$arElement["MIN_PRICE"];
      }
      $elementsCount+=count($arItem[$CODE]);
    }
	
	$sum = number_format((int)$sum, 0, ',', ' ');
	
    ?>
  	<!-- collection -->
  	<div class="collection">
  	  <div class="h3"><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a><span>за <?=$elementsCount?> <?=words($elementsCount,"предмет","предмета","предметов")?></span></div>
  	  <?/*?><div class="presence"><b></b>В наличии в <a href="#">Екатеринбурге</a></div><?*/?>
  	  <!-- gallery -->
  	  <div class="gallery">
  	    <?#pre($arItem)?>
  	    <div class="sliderkit photosgallery-vertical">
  	      <div class="sliderkit-nav">						
  	        <div class="sliderkit-nav-clip">
  	          <ul>
                <li>
                  <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" rel="nofollow" title="" class="photo_preview">
                    <img src="<?=MakeImage($arItem['PREVIEW_PICTURE']["SRC"],array("w"=>111,"h"=>60))?>" alt="" />
                  </a>
                  <div class="descrip">
                    <p>
                      <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">Коллекция <?=$arItem["NAME"]?></a>
                      <span><?=$sum?> <span class="rub">i</span></span>
                    </p>
                  </div>
                </li>
                <?foreach($CODES as $CODE){?>
                  <?foreach($arItem[$CODE] as $arElement){?>
      	            <li>
      	              <a href="<?=$arElement["DETAIL_PAGE_URL"]?>" rel="nofollow" title="" class="photo_preview">
                        <img src="<?=MakeImage($arElement['PREVIEW_PICTURE'],array("w"=>111,"h"=>60))?>" alt="" />
                      </a>
      	              <div class="descrip">
      	                <p>
      	                  <a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><?=$arElement["NAME"]?></a>
      	                  <span><?=(int)$arElement["MIN_PRICE"]?> <span class="rub">i</span></span>
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
              <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img src="<?=MakeImage($arItem['DETAIL_PICTURE']["SRC"],array("w"=>522,"h"=>290))?>" alt="" /></a>
            </div>
            <?foreach($CODES as $CODE){?>
              <?foreach($arItem[$CODE] as $arElement){?>
    	        <div class="sliderkit-panel">
    	           <img src="<?=MakeImage($arElement['DETAIL_PICTURE'],array("w"=>522,"h"=>290))?>" alt="" />
    	        </div>
    	        <?}?>
            <?}?>
  	      </div>
  	    </div>
  	    
  	    <div class="mobile_photo"><img src="<?=SITE_TEMPLATE_PATH?>/img/temp/collection_photo_1.jpg" alt="" /><p>от 340 400 <span class="rub">i</span></p></div>
  	  
  	    <div class="buy">
  	      <div class="buttons">
  	        <input type="button" value="Купить" class="button but_buy">
  	        <a href="javascript:void(0);" title="В избранное" class="add_to_fav"><span></span></a>
  	      </div>
  	      <p>от <?=$sum?> <span class="rub">i</span><span class="em">за <?=$elementsCount?> <?=words($elementsCount,"предмет","предмета","предметов")?></span></p>
  	    </div>
  	  </div>
  	  <!-- /gallery -->
  	</div>
  	<!-- /collection -->
    <?#pre($arItem);?>
    <?
	}
}
else{
?>
<p>&nbsp;</p>
<p>В разделе нет товаров</p>
<?}?>
<div style="height:30px;"></div>
<?
	if ($arParams["DISPLAY_BOTTOM_PAGER"])
	{
		?><? echo $arResult["NAV_STRING"]; ?><?
	}

?>