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
<?if($arResult["PROPERTIES"]["IS_EXISTS"]["VALUE_XML_ID"]=="Y"){?>
<div class="presence"><span class="b"></span>В наличии в <a href="">Екатеринбурге</a></div>
<?}?>
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
			 <a class="fancybox" rel="gallery" href="<?=CFile::GetPath($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"][0])?>">
                <img data-cloudzoom = "zoomImage: '<?=CFile::GetPath($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"][0])?>'" class="cloudzoom"  src="<?=MakeImage($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"][0],array("w"=>462,"h"=>215))?>" alt="">
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
			 <a class="fancybox" rel="gallery" href="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>">
                <img data-cloudzoom="zoomImage:'<?=$arResult["DETAIL_PICTURE"]["SRC"]?>'" class="cloudzoom"  src="<?=MakeImage($arResult["DETAIL_PICTURE"]["SRC"],array("w"=>462,"h"=>215))?>" alt="">
			  </a> 
                <?/*?><div class="note_box note2">
                    <em>Стол из <a href="#">коллекции «Президент»</a></em>
                </div><?*/?>
            </div>
        </div>
    </div>
    <?}?>
	
    <div class="item_description_tab description_tab_2 tab_r">
        <div class="pattern_bottom"></div>
        <div class="pattern_top"></div>
        
            <fieldset>
                <div class="tabs-content">
                    <div class="descrip_head">
                        <ul class="tabs">
                        	<?
                          /*
                          #pre($skuAvail);
                        	$i=0;
                        	foreach( $arResult["GAME_TYPE"] as $arGame ){
                            if(isset($skuAvail[$arGame])){
                              $i++;
                        		?>
                            <li <?if($i==1){?>class="current"<?}?>><a href="#"><?=$arGame?></a></li>
                          <?}}*/?>
                          <li class="current"><a href="">Бильярдные столы</a></li>
                        </ul>
                    </div>

										<?
                    /*
                  	$i=0;
                  	foreach( $arResult["GAME_TYPE"] as $arGame ){
                      if(isset($skuAvail[$arGame])){
                  		  $i++;
                        */
                  		  ?>
	                    <!-- game-block -->
	                    <div class="box visible">
	                        <div class="tabs-content">
	                            <span class="item_label">Стол (футов)</span>
	                            <ul class="tabs tabs3">
                                <?
                                $i=0;
                                foreach( $arResult["GAME_TYPE"] as $arGame ){
                                  if(isset($skuAvail[$arGame])){
                                    $i++;
                                    ?>
              											<?
              	                  	$i1=0;
              	                  	foreach( $arResult["SKU_PROPS"]["SIZE"]["VALUES"] as $sID => $arSize ){
                                      if(isset($skuAvail[$arGame][$sID])){
                                        $i1++;
              	                  		?>
    	                                <li rel="<?=$arSize["ID"]?>" <?if($i==1 && $i1==1){?>class="current"<?}?>><a href="#"><?=$arSize["NAME"]?></a></li>
    	                              <?}}?>
                                <?}}?>
	                            </ul>
	                            <div class="clear"></div>

                              <?
                              $i=0;
                              foreach( $arResult["GAME_TYPE"] as $arGame ){
                                if(isset($skuAvail[$arGame])){
                                  $i++;
                                  ?>
                                  <?
                                  $i1=0;
                                  foreach( $arResult["SKU_PROPS"]["SIZE"]["VALUES"] as $sID => $arSize ){
                                    if(isset($skuAvail[$arGame][$sID])){
                                      $i1++;
                                    ?>
    	                            <div rel="<?=$arSize["ID"]?>" class="box-table-buy box <?if($i==1 && $i1==1){?>visible<?}?>">
                                    <form action="<?=SITE_TEMPLATE_PATH?>/ajax/add-cart.php" method="post">
                                      <input type="hidden" name="IBLOCK_ID" value="<?=$arResult["IBLOCK_ID"]?>">
                                      <input type="hidden" name="ID" value="<?=$arResult["ID"]?>">
                                      <input type="hidden" name="SIZE" value="<?=$sID?>">
                                      <!--<input type="hidden" name="GAME_TYPE" value="<?=$arGame?>">-->

    	                                <span class="item_label">Материал стола</span>
    	                                <div class="select_2">
    	                                    <div class="lineForm">
    	                                        <select class="sel80 custom-select" id="material_<?=$arSize["ID"]?>"  name="MATERIAL">
                                                  <?foreach( $arResult["SKU_PROPS"]["MATERIAL"]["VALUES"] as $mID => $item ){?>
                                                  <?if(in_array($mID,$skuAvail[$arGame][$sID])){?>
    	                                            <option <?if($mID==60) echo 'selected';?> value="<?=$mID?>"><?=$item["NAME"]?></option>
    	                                            <?}}?>
    	                                        </select>
    	                                    </div>
    	                                </div>
    	                                <div class="clear"></div>

    	                                <span class="item_label">Тип основы</span>
    	                                <div class="select_2">
    	                                    <div class="lineForm">
    	                                        <select class="sel80 custom-select" id="base_type_<?=$arSize["ID"]?>" name="BASE_TYPE">
    	                                            <?foreach( $arResult["SKU_PROPS"]["BASE_TYPE"]["VALUES"] as $btID => $item ){?>
                                                  <?if(in_array($btID,$skuAvail[$arGame][$sID])){?>
                                                  <option value="<?=$btID?>"><?=$item["NAME"]?></option>
                                                  <?}}?>
    	                                        </select>
    	                                    </div>
    	                                </div>
    	                                <div class="clear"></div>
                                      <?/*?>
    	                                <span class="item_label">Толщина плиты</span>
    	                                <div class="select_2">
    	                                    <div class="lineForm">
    	                                        <select class="sel80 custom-select" name="THICKNESS">
    	                                            <?foreach( $arResult["SKU_PROPS"]["THICKNESS"]["VALUES"] as $tID => $item ){?>
                                                  <?if(in_array($tID,$skuAvail[$arGame][$sID])){?>
                                                  <option value="<?=$tID?>"><?=$item["NAME"]?></option>
                                                  <?}}?>
    	                                        </select>
    	                                    </div>
    	                                </div>
    	                                <div class="clear"></div>
                                      <?*/?>
    	                                <div class="sum_2">
    	                                    <span class="strong">от <?=number_format($skuPriceFrom[$arGame][$sID],0,'',' ')?> <span class="rub">i</span></span>
    	                                    <div class="buttons">
    	                                        <input type="button" value="Купить" class="button but_buy add-to-cart">
    	                                        <a href="javascript:void(0);" title="В избранное" class="add_to_fav" id="favorites_<?=$arResult["IBLOCK_ID"]?>_<?=$arResult["ID"]?>"><span></span></a>
    	                                    </div>
    	                                </div>
                                    </form>
    	                            </div>
    	                            <?}}?>
                              <?}}?>
	                        </div>
	                    </div>
	                    <!-- /game-block -->
	                  <?/*}}*/?>
                </div>
            </fieldset>
        </form>
    </div>

    <div class="clear"></div>

</div>

<!-- description tabs -->
<div class="descrip_tabs">
    <div class="tabs-content">
        <ul class="tabs">
            <li class="current"><a href="#">Характеристики</a></li>
            <li><a href="#">Описание</a></li>
            <li id="color-select"><a href="#">Выбор цвета</a></li>
        </ul>
        <span class="spr"></span>

        <!-- characteristics -->
        <div class="box visible">
            <div class="char_list_2">
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
                <div class="detail">
                    <span class="add"></span>
                    <p><span class="strong">Дополнительно</span><?=$arResult["PROPERTIES"]["ADDITION"]["VALUE"]?></p>
                </div>
                <div class="detail">
                    <span class="paint_color"></span>
                    <p><span class="strong">Цвет выкраски</span><!-- 1st --><br><a href="#" class="color-select">Выбрать</a></p>
                </div>
                <div class="detail">
                    <span class="paint_color"></span>
                    <p><span class="strong">Цвет сукна</span><!-- yellow green --><br><a href="#" class="color-select">Выбрать</a></p>
                </div>
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

        <!-- color -->
        <div class="box">
            <div class="call_us">
                <span class="b"></span>
                <?$APPLICATION->IncludeComponent(
                  "bitrix:main.include",
                  "",
                  Array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => SITE_TEMPLATE_PATH."/include/".LANGUAGE_ID."/catalog-phones.php",
                    "EDIT_MODE" => "php",
                  ),
                  false
                );?>
            </div>

            <div class="paint_color_box color">
                <input type="hidden" name="paint_color" id="paint-color">
                <p>Основные цвета выкраски</p>
                <div class="paint_color_1 color_check">
                    <img src="<?=SITE_TEMPLATE_PATH?>/img/paint_colors/paint_color_1.png" alt="">
                    <label class="label_check" for="paint_color_1"><input name="check" id="paint_color_1" value="1" type="checkbox" /><span>1st</span></label>
                </div>
                <div class="paint_color_2 color_check">
                    <img src="<?=SITE_TEMPLATE_PATH?>/img/paint_colors/paint_color_2.png" alt="">
                    <label class="label_check" for="paint_color_2"><input name="check" id="paint_color_2" value="2" type="checkbox" /><span>2nd</span></label>
                </div>
                <div class="paint_color_3 color_check">
                    <img src="<?=SITE_TEMPLATE_PATH?>/img/paint_colors/paint_color_3.png" alt="">
                    <label class="label_check" for="paint_color_3"><input name="check" id="paint_color_3" value="3" type="checkbox" /><span>3rd</span></label>
                </div>
                <div class="paint_color_4 color_check">
                    <img src="<?=SITE_TEMPLATE_PATH?>/img/paint_colors/paint_color_4.png" alt="">
                    <label class="label_check" for="paint_color_4"><input name="check" id="paint_color_4" value="4" type="checkbox" /><span>4th</span></label>
                </div>
                <div class="paint_color_5 color_check">
                    <img src="<?=SITE_TEMPLATE_PATH?>/img/paint_colors/paint_color_5.png" alt="">
                    <label class="label_check" for="paint_color_5"><input name="check" id="paint_color_5" value="5" type="checkbox" /><span>5th</span></label>
                </div>
                <div class="paint_color_6 color_check">
                    <img src="<?=SITE_TEMPLATE_PATH?>/img/paint_colors/paint_color_6.png" alt="">
                    <label class="label_check" for="paint_color_6"><input name="check" id="paint_color_6" value="6" type="checkbox" /><span>6th</span></label>
                </div>
            </div>
            <div class="cloth_color_box color">
                <input type="hidden" name="cloth_color" id="cloth-color">
                <p>Основные цвета сукна</p>
                <div class="cloth_color_1 color_check">
                    <img src="<?=SITE_TEMPLATE_PATH?>/img/cloth_colors/cloth_color_1.png" alt="">
                    <label class="label_check" for="cloth_color_1"><input name="check" id="cloth_color_1" value="1" type="checkbox" /><span>Yellow green</span></label>
                </div>
                <div class="cloth_color_2 color_check">
                    <img src="<?=SITE_TEMPLATE_PATH?>/img/cloth_colors/cloth_color_2.png" alt="">
                    <label class="label_check" for="cloth_color_2"><input name="check" id="cloth_color_2" value="2" type="checkbox" /><span>Blue</span></label>
                </div>
                <div class="cloth_color_3 color_check">
                    <img src="<?=SITE_TEMPLATE_PATH?>/img/cloth_colors/cloth_color_3.png" alt="">
                    <label class="label_check" for="cloth_color_3"><input name="check" id="cloth_color_3" value="3" type="checkbox" /><span>Ligth blue</span></label>
                </div>
                <div class="cloth_color_4 color_check">
                    <img src="<?=SITE_TEMPLATE_PATH?>/img/cloth_colors/cloth_color_4.png" alt="">
                    <label class="label_check" for="cloth_color_4"><input name="check" id="cloth_color_4" value="4" type="checkbox" /><span>Red</span></label>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <!-- /color -->

        <span class="spr"></span>
    </div>
</div>
<!-- /description tabs -->

<!-- tables type -->
<div class="type_box">
    <div class="h3">Типы бильярдных столов</div>

    <div class="size_table tables_table">
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
				$i=0;
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
                  <div class="<?if($i==0):?>active<? $i=1; endif;?> tab_row base_type_<?=$arOffer["PROPERTIES"]["BASE_TYPE"]["VALUE_ENUM_ID"]?> material_<?=$arOffer["PROPERTIES"]["MATERIAL"]["VALUE_ENUM_ID"]?> size_<?=$arOffer["PROPERTIES"]["SIZE"]["VALUE_ENUM_ID"]?>">
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
    <div class="h3">Сопутствующие товары</div>
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