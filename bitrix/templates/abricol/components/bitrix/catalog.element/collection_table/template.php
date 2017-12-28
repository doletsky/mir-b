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
$texts=array(
  8 => "Размер игрового поля 8-и футового стола: 2,24х1,12 м. Бильярдная комната должна быть не меньше 5,74х4,62 м",
  9 => "Размер игрового поля 9-ти футового стола: 2,54х1,27 м. Бильярдная комната должна быть не меньше 6,04х4,77 м",
  10 => "Размер игрового поля 10-ти футового стола: 2,84х1,42 м. Бильярдная комната должна быть не меньше 6,34х4,92 м",
  11 => "Размер игрового поля 11-ти футового стола: 3,20х1,60 м. Бильярдная комната должна быть не меньше 6,70х5,10 м",
  12 => "Размер игрового поля 12-ти футового стола: 3,50х1,75 м. Бильярдная комната должна быть не меньше 7,00х5,25 м",
);


#pre($arParams);
$SKU_PROPS = array();
foreach($arResult["SKU_PROPS"] as $CODE => $arr){
    #echo '111';pre($arr);
    foreach($arr["VALUES"] as $ID => $arr1){
        $SKU_PROPS[$ID] = $arr1["NAME"];
    }
}
#pre($arResult["OFFERS"]);
$skuAvail=array();
$sizes=array();
$skuPriceFrom=array();
foreach($arResult["OFFERS"] as $offer){
    $tree=$offer["TREE"];
    $sizes[$offer["PROPERTIES"]["SIZE"]["VALUE"]]=1;
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
    /*$skuAvail[$tree["PROP_8"]][$tree["PROP_9"]]=array(
        $tree["PROP_10"],
        $tree["PROP_11"],
        $tree["PROP_12"]
    );*/
}
krsort($sizes);
#pre($sizes);
#pre($skuAvail);
?>


<?

?>

        <div class="item_box">
          <div class="item_photo"><a href="<?=$arResult['DETAIL_PAGE_URL']?>"><img src="<?=MakeImage($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"][0],array("w"=>220,"h"=>114))?>" alt=""></a></div>
          <div class="item_description">
            <div class="h3"><a href="<?=$arResult['DETAIL_PAGE_URL']?>"><?=$arResult['NAME']?></a></div>
            <div class="detail det1">
              <span class="cloth"></span>
              <p><span class="strong">Сукно</span><?=$arResult["PROPERTIES"]["CLOTH"]["VALUE"]?></p>
            </div>
            <div class="detail det2">
              <span class="shock_absorbers"></span>
              <p><span class="strong">Амортизаторы</span><?=$arResult["PROPERTIES"]["ABSORBETS"]["VALUE"]?></p>
            </div>
            <div class="detail det3">
              <span class="pockets"></span>
              <p><span class="strong">Лузы</span><?=$arResult["PROPERTIES"]["LUZA"]["VALUE"]?></p>
            </div>
          </div>
        </div>





<!-- tables type -->
<div class="type_box">
    <div class="h3">Типы бильярдных столов</div>

    <div class="size_table">
        <div class="tabs-content">
            <div class="tab_head">
                <div class="pattern_bottom"></div>
                <div class="tab_head_in">
                    <span>Стол (футов)</span>
                    <ul class="tabs">
                        <li class="current"><a href="#">Все размеры</a></li>
                        <?foreach( $sizes as $size => $v ){?>
                          <li><a href="#"><?=$size?></a></li>
                        <?}?>
                    </ul>
                </div>
            </div>

            <!-- all sizes -->
            <div class="box visible">
                <div class="tab_head_2">
                    <div class="tab_th_1 tab_th">Тип игры</div>
                    <div class="tab_th_2 tab_th">Размер поля</div>
                    <div class="tab_th_3 tab_th">Материал стола</div>
                    <div class="tab_th_4 tab_th">Тип плиты</div>
                    <div class="tab_th_5 tab_th th_center">Кол-во ног</div>
                    <div class="tab_th_6 tab_th">Вес</div>
                    <div class="tab_th_7 tab_th">Цена</div>
                </div>
                <?/*
                <!--<div class="note_box">
                    <em>Размер игрового поля 8-ми футового стола: 3,20х1,60 м. Бильярдная комната должна быть не меньше 6,70х5,10 м.</em>
                </div>-->
                */?>
                <?
                $size=0;
                foreach($arResult["OFFERS"] as $arOffer){
                  if($arOffer["PROPERTIES"]["SIZE"]["VALUE"]!=$size){
                    $size=$arOffer["PROPERTIES"]["SIZE"]["VALUE"];
                    ?>
                    <div class="note_box">
                      <span class="b"></span>
                      <span class="em"><?=$texts[$size]?></span>
                    </div>
                    <?
                  }
                  ?>
                  <div class="tab_row base_type_<?=$arOffer["PROPERTIES"]["BASE_TYPE"]["VALUE_ENUM_ID"]?> material_<?=$arOffer["PROPERTIES"]["MATERIAL"]["VALUE_ENUM_ID"]?> size_<?=$arOffer["PROPERTIES"]["SIZE"]["VALUE_ENUM_ID"]?>">
                      <form action="<?=SITE_TEMPLATE_PATH?>/ajax/add-cart.php" method="post">
					  <input type="hidden" name="IBLOCK_ID" value="<?=$arResult["IBLOCK_ID"]?>">
					  <input type="hidden" name="ID" value="<?=$arResult["ID"]?>">
					  <input type="hidden" name="SIZE" value="<?=$arOffer["PROPERTIES"]["SIZE"]["VALUE_ENUM_ID"]?>">
					  <input type="hidden" name="BASE_TYPE" value="<?=$arOffer["PROPERTIES"]["BASE_TYPE"]["VALUE_ENUM_ID"]?>">
					  <input type="hidden" name="MATERIAL" value="<?=$arOffer["PROPERTIES"]["MATERIAL"]["VALUE_ENUM_ID"]?>">
						
					  <div class="tab_td_1 tab_td"><?=$arOffer["GAME_TYPE"]?></div>
                      <div class="tab_td_2 tab_td"><?=$arOffer["PROPERTIES"]["SIZE"]["VALUE"]?> фт</div>
                      <div class="tab_td_3 tab_td"><?=$arOffer["PROPERTIES"]["MATERIAL"]["VALUE"]?>&nbsp;</div>
                      <div class="tab_td_4 tab_td"><?=$arOffer["PROPERTIES"]["BASE_TYPE"]["VALUE"]?>&nbsp;</div>
                      <div class="tab_td_5 tab_td td_center"><?=$arOffer["LEGS"]?>&nbsp;</div>
                      <div class="tab_td_6 tab_td"><?=$arOffer["PROPERTIES"]["WEIGHT"]["VALUE"]?>&nbsp;</div>
                      <div class="tab_td_7 tab_td"><?=number_format((int)$arOffer["CATALOG_PRICE_1"], 0, ',', ' ')?></div>
                      <div class="tab_td_8 tab_td">
                          <a href="javascript:void(0);" class="add_to_cart2 add-to-cart" title="В корзину"><span class="b"></span></a>
                          <a href="javascript:void(0);" class="add_to_fav2 add_to_fav" title="В избранное"><span class="b"></span></a>
                      </div>
					  </form>
                  </div>
                <?}?>
            </div>
            <!-- /all sizes -->

            <?foreach( $sizes as $size => $v ){?>
            <!-- N -->
            <div class="box">
                <div class="tab_head_2">
                    <div class="tab_th_1 tab_th">Тип игры</div>
                    <div class="tab_th_2 tab_th">Размер поля</div>
                    <div class="tab_th_3 tab_th">Материал стола</div>
                    <div class="tab_th_4 tab_th">Тип плиты</div>
                    <div class="tab_th_5 tab_th th_center">Кол-во ног</div>
                    <div class="tab_th_6 tab_th">Вес</div>
                    <div class="tab_th_7 tab_th">Цена</div>
                </div>
                <div class="note_box">
                    <span class="b"></span>
                    <span class="em"><?=$texts[$size]?></span>
                </div>
                <?
                foreach($arResult["OFFERS"] as $arOffer){
                  if($arOffer["PROPERTIES"]["SIZE"]["VALUE"]==$size){
                  ?>
                  <div class="tab_row">
					 <form action="<?=SITE_TEMPLATE_PATH?>/ajax/add-cart.php" method="post">
					  <input type="hidden" name="IBLOCK_ID" value="<?=$arResult["IBLOCK_ID"]?>">
					  <input type="hidden" name="ID" value="<?=$arResult["ID"]?>">
					  <input type="hidden" name="SIZE" value="<?=$arOffer["PROPERTIES"]["SIZE"]["VALUE_ENUM_ID"]?>">
					  <input type="hidden" name="BASE_TYPE" value="<?=$arOffer["PROPERTIES"]["BASE_TYPE"]["VALUE_ENUM_ID"]?>">
					  <input type="hidden" name="MATERIAL" value="<?=$arOffer["PROPERTIES"]["MATERIAL"]["VALUE_ENUM_ID"]?>">
                      <div class="tab_td_1 tab_td"><?=$arOffer["GAME_TYPE"]?></div>
                      <div class="tab_td_2 tab_td"><?=$arOffer["PROPERTIES"]["SIZE"]["VALUE"]?> фт</div>
                      <div class="tab_td_3 tab_td"><?=$arOffer["PROPERTIES"]["MATERIAL"]["VALUE"]?>&nbsp;</div>
                      <div class="tab_td_4 tab_td"><?=$arOffer["PROPERTIES"]["BASE_TYPE"]["VALUE"]?>&nbsp;</div>
                      <div class="tab_td_5 tab_td td_center"><?=$arOffer["LEGS"]?>&nbsp;</div>
                      <div class="tab_td_6 tab_td"><?=$arOffer["PROPERTIES"]["WEIGHT"]["VALUE"]?>&nbsp;</div>
                      <div class="tab_td_7 tab_td"><?=number_format((int)$arOffer["CATALOG_PRICE_1"], 0, ',', ' ')?>&nbsp;</div>
                      <div class="tab_td_8 tab_td">
                          <a href="javascript:void(0);" class="add_to_cart2 add-to-cart" title="В корзину"><span class="b"></span></a>
                          <a href="javascript:void(0);" class="add_to_fav2 add_to_fav" title="В избранное"><span class="b"></span></a>
                      </div>
                  </div>
				   </form>
                <?}}?>
            </div>
            <!-- /N -->
            <?}?>

        </div>

        <div class="pattern_top"></div>
    </div>


    <div class="size_table size_table_mob">
        <div class="tabs-content">
            <div class="tab_head">
                <div class="pattern_bottom"></div>
                <div class="tab_head_in">
				
				    <ul class="tabs">
                        <li class="current"><a href="#">Все размеры</a></li>
                        <?foreach( $sizes as $size => $v ){?>
                          <li><a href="#"><?=$size?></a></li>
                        <?}?>
                    </ul>
				
                   
                </div>
            </div>

            <!-- all sizes -->
            <div class="box visible">
			  <?
                $size=0;
                foreach($arResult["OFFERS"] as $arOffer){
                  if($arOffer["PROPERTIES"]["SIZE"]["VALUE"]!=$size){
                    $size=$arOffer["PROPERTIES"]["SIZE"]["VALUE"];
                    ?>
                    <div class="note_box">
                      <span class="b"></span>
                      <span class="em"><?=$texts[$size]?></span>
                    </div>
                    <?
                  }
                  ?>
                <div class="tab_row_mob">
					 <form action="<?=SITE_TEMPLATE_PATH?>/ajax/add-cart.php" method="post">
					  <input type="hidden" name="IBLOCK_ID" value="<?=$arResult["IBLOCK_ID"]?>">
					  <input type="hidden" name="ID" value="<?=$arResult["ID"]?>">
					  <input type="hidden" name="SIZE" value="<?=$arOffer["PROPERTIES"]["SIZE"]["VALUE_ENUM_ID"]?>">
					  <input type="hidden" name="BASE_TYPE" value="<?=$arOffer["PROPERTIES"]["BASE_TYPE"]["VALUE_ENUM_ID"]?>">
					  <input type="hidden" name="MATERIAL" value="<?=$arOffer["PROPERTIES"]["MATERIAL"]["VALUE_ENUM_ID"]?>">
                    <p>Тип игры</p>
                    <span><?=$arOffer["GAME_TYPE"]?></span>
                    <div class="clear"></div>

                    <p>Размер поля</p>
                    <span><?=$arOffer["PROPERTIES"]["SIZE"]["VALUE"]?> фт</span>
                    <div class="clear"></div>

                    <p>Материал стола</p>
                    <span><?=$arOffer["PROPERTIES"]["MATERIAL"]["VALUE"]?></span>
                    <div class="clear"></div>
					<p>Тип плиты</p>
                    <span><?=$arOffer["PROPERTIES"]["BASE_TYPE"]["VALUE"]?> фт</span>
                    <div class="clear"></div>
                    <p>Цена</p>
      <span class="price_td">
      	<span class="em"><?=number_format((int)$arOffer["CATALOG_PRICE_1"], 0, ',', ' ')?></span>
        <a href="javascript:void(0);" class="add_to_cart2 add-to-cart" title="В корзину"><span class="b"></span></a>
        <a href="javascript:void(0);" class="add_to_fav2 add_to_fav" title="В избранное"><span class="b"></span></a>
      </span>
                    <div class="clear"></div>
					 </form>
                </div>
			<?}?>
               

            </div>
            <!-- /all sizes -->
			<?foreach( $sizes as $size => $v ){?>
            <!-- 8 -->
            <div class="box">
				 <?
                foreach($arResult["OFFERS"] as $arOffer){
                  if($arOffer["PROPERTIES"]["SIZE"]["VALUE"]==$size){
                  ?>
                <div class="tab_row_mob">
					 <form action="<?=SITE_TEMPLATE_PATH?>/ajax/add-cart.php" method="post">
					  <input type="hidden" name="IBLOCK_ID" value="<?=$arResult["IBLOCK_ID"]?>">
					  <input type="hidden" name="ID" value="<?=$arResult["ID"]?>">
					  <input type="hidden" name="SIZE" value="<?=$arOffer["PROPERTIES"]["SIZE"]["VALUE_ENUM_ID"]?>">
					  <input type="hidden" name="BASE_TYPE" value="<?=$arOffer["PROPERTIES"]["BASE_TYPE"]["VALUE_ENUM_ID"]?>">
					  <input type="hidden" name="MATERIAL" value="<?=$arOffer["PROPERTIES"]["MATERIAL"]["VALUE_ENUM_ID"]?>">
                    <p>Тип игры</p>
                    <span><?=$arOffer["GAME_TYPE"]?></span>
                    <div class="clear"></div>

                    <p>Размер поля</p>
                    <span><?=$arOffer["PROPERTIES"]["SIZE"]["VALUE"]?> фт</span>
                    <div class="clear"></div>

                    <p>Материал стола</p>
                    <span><?=$arOffer["PROPERTIES"]["MATERIAL"]["VALUE"]?></span>
                    <div class="clear"></div>
					<p>Тип плиты</p>
                    <span><?=$arOffer["PROPERTIES"]["BASE_TYPE"]["VALUE"]?></span>
                    <div class="clear"></div>
                    <p>Цена</p>
					  <span class="price_td">
						<span class="em"><?=number_format((int)$arOffer["CATALOG_PRICE_1"], 0, ',', ' ')?></span>
						<a href="javascript:void(0);" class="add_to_cart2 add-to-cart" title="В корзину"><span class="b"></span></a>
						<a href="javascript:void(0);" class="add_to_fav2 dd_to_fav" title="В избранное"><span class="b"></span></a>
					  </span>
                    <div class="clear"></div>
					</form>
                </div>
			<?}}?>
                

            </div>
            <!-- /8 -->
		<?}?>

        </div>

        <div class="pattern_top"></div>
    </div>

</div>
<!-- /tables type -->

