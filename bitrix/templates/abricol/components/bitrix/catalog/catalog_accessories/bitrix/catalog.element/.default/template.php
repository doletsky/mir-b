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
#pre($arResult["SECTION"]);
$RIGHT_BLOCK=array();
$TABLE_BLOCK=array();
switch( $arResult["SECTION"]["PATH"][0]["CODE"] ){
  case "cloth":
    $RIGHT_BLOCK=array("ROLL_WIDTH","CONTENT","DENSITY","COUNTRY");
    break;
  case "ciency":
    $RIGHT_BLOCK=array("CIE_COUNT","HEIGHT","WIDTH","DEPTH","MATERIAL","TRIM");
    break;
  case "shelves":
    $RIGHT_BLOCK=array("HEIGHT","WIDTH","DEPTH","MATERIAL","TRIM");
    break;
  case "balls":
    $RIGHT_BLOCK=array("DIAMETER_BALL","WEIGHT_BALL","MATERIAL_BALL","COUNTRY");
    break;
  case "triangles":
    $RIGHT_BLOCK=array("TRI_BALL","TRI_MATERIAL");
    break;
  case "sticker-for-kia":
    $RIGHT_BLOCK=array("NAKL_DIAM","NAKL_RIGIDITY");
    break;
  case "lamps-billiard":
    $TABLE_BLOCK=array("NAME","LAMPSHADES","SIZE","BARBELL");
    break;
  case "covers-for-tables":
    $RIGHT_BLOCK=array("BARBELL","COUNTRY");
    $TABLE_BLOCK=array("NAME","SIZE","BARBELL","COUNTRY");
    break;
  default:
    $RIGHT_BLOCK=array("BRAND","COUNTRY");
    break;
}



$skuAvail=array();
$skuPriceFrom=array();
if( $arResult["SECTION"]["PATH"][0]["CODE"] == "covers-for-tables" ){
  // ЧЕХЛЫ ДЛЯ СТОЛОВ

  foreach($arResult["OFFERS"] as $offer){
    $tree=$offer["TREE"];
    #pre($tree);
    if(!isset($skuAvail[$tree["PROP_57"]])){
      $skuAvail[$tree["PROP_57"]]=array();
      $skuPriceFrom[$tree["PROP_57"]]=0;
    }
    foreach( $RIGHT_BLOCK as $PARAM_NAME ){
      if($offer["PROPERTIES"][$PARAM_NAME]["VALUE"]){
        $skuAvail[$tree["PROP_57"]][$PARAM_NAME] = $offer["PROPERTIES"][$PARAM_NAME]["VALUE"];
      }
      else{
        $skuAvail[$tree["PROP_57"]][$PARAM_NAME] = $arResult["PROPERTIES"][$PARAM_NAME]["VALUE"];
      }
    }
    if($offer["MIN_PRICE"]["VALUE"] < $skuPriceFrom[$tree["PROP_57"]] || $skuPriceFrom[$tree["PROP_57"]]==0){
      $skuPriceFrom[$tree["PROP_57"]]=$offer["MIN_PRICE"]["VALUE"];
    }
  }

}elseif( $arResult["SECTION"]["PATH"][0]["CODE"] == "lamps-billiard" ){
  // СВЕТИЛЬНИКИ

  foreach($arResult["OFFERS"] as $offer){
    $tree=$offer["TREE"];
    if(!isset($skuAvail[$tree["PROP_56"]])){
      $skuAvail[$tree["PROP_56"]]=array();
      $skuPriceFrom[$tree["PROP_56"]]=array();
    }
    if(!isset($skuAvail[$tree["PROP_56"]][$tree["PROP_57"]])){
      $skuAvail[$tree["PROP_56"]][$tree["PROP_57"]]=array();
      $skuPriceFrom[$tree["PROP_56"]][$tree["PROP_57"]]=0;
    }
    #array_push( $skuAvail[$tree["PROP_56"]][$tree["PROP_57"]], $tree["PROP_58"] );
    $skuAvail[$tree["PROP_56"]][$tree["PROP_57"]] = $offer["PROPERTIES"]["BARBELL"]["VALUE"];

    if($offer["MIN_PRICE"]["VALUE"] < $skuPriceFrom[$tree["PROP_56"]][$tree["PROP_57"]] || $skuPriceFrom[$tree["PROP_56"]][$tree["PROP_57"]]==0){
      $skuPriceFrom[$tree["PROP_56"]][$tree["PROP_57"]]=$offer["MIN_PRICE"]["VALUE"];
    }
  }

}
#pre($skuAvail);pre($skuPriceFrom);

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
            <a href="<?=$fullPath?>" class="fancybox" rel="gallery"><img data-cloudzoom = "zoomImage: '<?=$fullPath?>'" class="cloudzoom" src="<?=MakeImage($arPic,array("w"=>462,"h"=>215))?>" alt="" /><span class="b zoom"></span></a>
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

    <?#pre($arResult)?>
    <?#if(in_array($arResult["PROPERTIES"]["LUMINAIRE_TYPE"]["VALUE_ENUM_ID"],array(53,54))){?>
    <?if( $arResult["SECTION"]["PATH"][0]["CODE"] == "covers-for-tables" ){?>

    <div class="item_description_tab description_tab_2">
      <div class="pattern_bottom"></div>
      <div class="pattern_top"></div>
          <div class="tabs-content">
            <div class="descrip_head">
              <ul class="tabs">
                <?
                $i=0;
                foreach( $arResult["SKU_PROPS"]["SIZE"]["VALUES"] as $sID => $arSize ){
                  if(isset($skuAvail[$sID])){
                    $i++;
                    ?>
                    <li <?if($i==1){?>class="current"<?}?>><a href="#"><?=$arSize["NAME"]?> фт</a></li>
                <?}}?>
              </ul>
            </div>
            <?
            $i=0;
            foreach( $arResult["SKU_PROPS"]["SIZE"]["VALUES"] as $sID => $arSize ){
              if(isset($skuAvail[$sID])){
                $i++;
                ?>
              <!-- N shades -->
              <div class="box <?if($i==1){?>visible<?}?>">
                <?foreach( $RIGHT_BLOCK as $PARAM_NAME ){
                  if($offer["PROPERTIES"][$PARAM_NAME]["NAME"]){
                    $name = $offer["PROPERTIES"][$PARAM_NAME]["NAME"];
                  }
                  else{
                    $name = $arResult["PROPERTIES"][$PARAM_NAME]["NAME"];
                  }
                  ?>
                  <span class="item_label"><?=$name?></span>
                  <div class="select_2">
                    <div class="lineForm123">
                      <?=$skuAvail[$sID][$PARAM_NAME]?>
                    </div>
                  </div>
                  <div class="clear"></div>
                <?}?>
                <form action="<?=SITE_TEMPLATE_PATH?>/ajax/add-cart.php" method="post">
					<input type="hidden" name="IBLOCK_ID" value="<?=$arResult["IBLOCK_ID"]?>">
					<input type="hidden" name="ID" value="<?=$arResult["ID"]?>">
					<input type="hidden" name="SIZE" value="<?=$arSize["ID"]?>">
					<div class="sum_2">
					  <span class="strong"><?=number_format($skuPriceFrom[$sID],0,',',' ')?> <span class="rub">i</span></span>
					  <div class="buttons">
						<input type="button" value="Купить" class="button but_buy add-to-cart">
						<a href="javascript:void(0);" title="В избранное" class="add_to_fav"><span></span></a>
					  </div>
					</div>
				</form>
                
              </div>
              <!-- /N shades -->
            <?}}?>
          </div>
    </div>

    <?}elseif( $arResult["SECTION"]["PATH"][0]["CODE"] == "lamps-billiard" ){?>
    <div class="item_description_tab description_tab_2">
      <div class="pattern_bottom"></div>
      <div class="pattern_top"></div>
     
          <div class="tabs-content">
            <div class="descrip_head">
              <ul class="tabs">
                <?
                $i=0;
                foreach( $arResult["SKU_PROPS"]["LAMPSHADES"]["VALUES"] as $lID => $arLamp ){
                  if(isset($skuAvail[$lID])){
                    $i++;
                  ?>
                  <li rel="<?=$arLamp["ID"]?>" <?if($i==1){?>class="current"<?}?>><a href="#"><?=$arLamp["NAME"]?></a></li>
                <?}}?>
              </ul>
            </div>
            
            <?
            $i=0;
            foreach( $arResult["SKU_PROPS"]["LAMPSHADES"]["VALUES"] as $lID => $arLamp ){
              if(isset($skuAvail[$lID])){
                $i++;
				
              ?>
              <!-- N shades -->
              <div rel="<?=$arLamp["ID"]?>"  class="box box-table-buy <?if($i==1){?>visible<?}?> lamps_<?=$arLamp["ID"]?>">
                <div class="tabs-content">
                  <span class="item_label">Размер (фт)</span>
                  <ul class="tabs tabs3">
                    <?
                    $i1=0;
                    foreach( $arResult["SKU_PROPS"]["SIZE"]["VALUES"] as $sID => $arSize ){
                      if(isset($skuAvail[$lID][$sID])){
                        $i1++;
                      ?>
                      <li <?if($i1==1){?>class="current"<?}?>><a href="#"><?=$arSize["NAME"]?></a></li>
                    <?}}?>
                  </ul>
                  <div class="clear"></div>
                  
                  <?
                  $i1=0;
                  foreach( $arResult["SKU_PROPS"]["SIZE"]["VALUES"] as $sID => $arSize ){
                    if(isset($skuAvail[$lID][$sID])){
                      $i1++;
                    ?>
					<form action="<?=SITE_TEMPLATE_PATH?>/ajax/add-cart.php" method="post">
					<input type="hidden" name="IBLOCK_ID" value="<?=$arResult["IBLOCK_ID"]?>">
					<input type="hidden" name="ID" value="<?=$arResult["ID"]?>">
					<input type="hidden" name="SIZE" value="<?=$arSize["ID"]?>">
					<input type="hidden" name="LAMPSHADES" value="<?=$arLamp["ID"]?>">
                    <div class="box <?if($i1==1){?>visible<?}?>">
                      <span class="item_label">Штанга</span>
                      <div class="select_2">
                        <div class="lineForm123">
                          <?=$skuAvail[$lID][$sID]?>
                          <?/*?><select class="sel80" id="material_1" name="material_1">
                            <?foreach( $arResult["SKU_PROPS"]["BARBELL"]["VALUES"] as $bID => $item ){?>
                            <?if(in_array($bID,$skuAvail[$lID][$sID])){?>
                            <option value="<?=$item["NAME"]?>"><?=$item["NAME"]?></option>
                            <?}}?>
                          </select><?*/?>
                        </div>
                      </div>
                      <div class="clear"></div>
                      <div class="sum_2">
                        <span class="strong"><?=number_format($skuPriceFrom[$lID][$sID],0,',',' ')?> <span class="rub">i</span></span>
                        <div class="buttons">
                          <input type="button" value="Купить" class="button but_buy add-to-cart">
                          <a href="javascript:void(0);" title="В избранное" class="add_to_fav"><span></span></a>
                        </div>
                      </div>
                    </div>
					</form>
                  <?}}?>
                </div>
              </div>
              <!-- /N shades -->
            <?}}?>
          </div>
       
    </div>
    <?}else{?>
    <div class="item_description_tab wide">
        <div class="pattern_bottom"></div>
        <div class="pattern_top"></div>
        <div class="char_box">
          <?
          if(is_array($RIGHT_BLOCK) && count($RIGHT_BLOCK)){
            foreach( $RIGHT_BLOCK as $PARAM_NAME ){
              if($arResult["PROPERTIES"][$PARAM_NAME]["VALUE"]){
                ?>
                <div class="char"><?=$arResult["PROPERTIES"][$PARAM_NAME]["NAME"]?></div>
                <div class="char_descrip"><?=$arResult["PROPERTIES"][$PARAM_NAME]["VALUE"]?></div>
                <div class="clear"></div>
                <?
              }
            }
          }
          ?>
        </div>
		<form action="<?=SITE_TEMPLATE_PATH?>/ajax/add-cart.php" method="post">
					<input type="hidden" name="IBLOCK_ID" value="<?=$arResult["IBLOCK_ID"]?>">
					<input type="hidden" name="ID" value="<?=$arResult["ID"]?>">
					
			<div class="sum_2">
				<span class="strong"><?=number_format($arResult["PRICES"]["BASE"]["VALUE"],0,'',' ')?> <span class="rub">i</span></span>
				<div class="buttons">
					<input type="button" value="Купить" class="button but_buy add-to-cart">
					<a href="javascript:void(0);" title="В избранное" class="add_to_fav"><span></span></a>
				</div>
			</div>
		</form>
    </div>	
    <?}?>

    <div class="clear"></div>

</div>

<?
$arr=array("COLOR","GAMMA","GAME_TYPE","WATER_REPELLENT","FIXING_CEILING","MOUNTING_KIT","","","","","");
$hasChars=false;
foreach($arr as $k){
  if(isset($arResult["PROPERTIES"][$k]["VALUE"]) && $arResult["PROPERTIES"][$k]["VALUE"]){
    $hasChars=true;
  }
}
$showChars=false;
if( $hasChars || $arResult["PREVIEW_TEXT"] ) $showChars=true;
?>
<!-- description tabs -->
<div class="descrip_tabs">
    <div class="tabs-content">
        <ul class="tabs">
          <?if($showChars){?>
          <li class="current"><a href="#">Характеристики</a></li>
          <?}?>
          <li <?if(!$showChars){?>class="current"<?}?> ><a href="#">Описание</a></li>
        </ul>
        <span class="spr"></span>

        <?if($showChars){?>
        <!-- characteristics -->
        <div class="box visible">
          <?if($hasChars){?>
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
          <?}?>
          <article>
            <?=$arResult["PREVIEW_TEXT"]?>
            <div class="clear"></div>
          </article>
        </div>
        <!-- /characteristics -->
        <?}?>

        <!-- description -->
        <div class="box <?if(!$showChars){?>visible<?}?>">
            <?#pre($arResult)?>
            <?
            if($arResult["PROPERTIES"]["LUMINAIRE_TYPE"]["VALUE_ENUM_ID"]==53){
              $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/inc/lamp-cone.php");
            }
            elseif($arResult["PROPERTIES"]["LUMINAIRE_TYPE"]["VALUE_ENUM_ID"]==54){
              $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/inc/lamp-ball.php");
            }
            ?>
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

<?if(is_array($TABLE_BLOCK) && count($TABLE_BLOCK)){?>
<!-- tables type -->
<div class="type_box">
    <div class="h3">Варианты комплектации</div>

    <div class="size_table lamps_table">
        <div class="tabs-content">
            <div class="tab_head">
                <div class="pattern_bottom"></div>
                <div class="tab_head_in">
                  <?=$arResult["SECTION"]["PATH"][0]["NAME"]?>
                </div>
            </div>
<?#pre($arResult["OFFERS"][0])?>
            <!-- all sizes -->
            <div class="box visible">
                <div class="tab_head_2">
                  <?
                  $arOffer=$arResult["OFFERS"][0];
                  #pre($TABLE_BLOCK);
                  foreach( $TABLE_BLOCK as $i => $PARAM_NAME ){
                    if(isset($arOffer["PROPERTIES"][$PARAM_NAME]["NAME"])){
                      $name=$arOffer["PROPERTIES"][$PARAM_NAME]["NAME"];
                      ?>
                      <div class="tab_th_<?=$i+1?> tab_th" ><?=$name?></div>
                      <?
                    }
                    else{
                      if($PARAM_NAME=='NAME') $name='Название';
                      if($PARAM_NAME=='COUNTRY') $name='Страна производитель';
                      ?>
                      <div class="tab_th_<?=$i+1?> tab_th" <?if($i==0){?>style="width:30%"<?}?> ><?=$name?></div>
                      <?
                    }
                  }
                  ?>
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
                  ?>
                  <div class="tab_row lamps_<?=$arOffer["PROPERTIES"]["LAMPSHADES"]['VALUE_ENUM_ID']?>">
				   <form action="<?=SITE_TEMPLATE_PATH?>/ajax/add-cart.php" method="post">
                    <?
                    foreach( $TABLE_BLOCK as $i => $PARAM_NAME ){
                      if($arOffer["PROPERTIES"][$PARAM_NAME]["VALUE"]){
                        $value=$arOffer["PROPERTIES"][$PARAM_NAME]["VALUE"];
                        ?>
                        <div class="tab_td_<?=$i+1?> tab_td"><?=$value?>&nbsp;</div>
                        <?
                      }
                      else{
                        if(isset($arResult[$PARAM_NAME])){
                          $value=$arResult[$PARAM_NAME];
                        }
                        else{
                          $value=$arResult["PROPERTIES"][$PARAM_NAME]["VALUE"];
                        }
                        ?>
                        <div class="tab_td_<?=$i+1?> tab_td" <?if($i==0){?>style="width:30%"<?}?> ><?=$value?>&nbsp;</div>
                        <?
                      }
                    }

                    ?>
					<input type="hidden" name="IBLOCK_ID" value="<?=$arResult["IBLOCK_ID"]?>">
					
					<input type="hidden" name="ID" value="<?=$arResult["ID"]?>">
					<input type="hidden" name="SIZE" value="<?=$arOffer["PROPERTIES"]["SIZE"]['VALUE_ENUM_ID']?>">
					<input type="hidden" name="LAMPSHADES" value="<?=$arOffer["PROPERTIES"]["LAMPSHADES"]['VALUE_ENUM_ID']?>">
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
                        <li><a href="#">8</a></li>
                        <li><a href="#">9</a></li>
                        <li><a href="#">10</a></li>
                        <li><a href="#">12</a></li>
                    </ul>
                </div>
            </div>

            <!-- all sizes -->
            <div class="box visible">

                <div class="tab_row_mob">
                    <p>Тип игры</p>
                    <span>Пирамида</span>
                    <div class="clear"></div>

                    <p>Размер поля</p>
                    <span>8 фт</span>
                    <div class="clear"></div>

                    <p>Материал стола</p>
                    <span>Массив ясеня или дуба</span>
                    <div class="clear"></div>

                    <p>Цена</p>
                    <span class="price_td">
                      <span class="em">250 000</span>
                      <a href="javascript:void(0);" class="add_to_cart2" title="В корзину"><span class="b"></span></a>
                      <a href="javascript:void(0);" class="add_to_fav2" title="В избранное"><span class="b"></span></a>
                    </span>
                    <div class="clear"></div>
                </div>

                <div class="tab_row_mob">
                    <p>Тип игры</p>
                    <span>Пирамида</span>
                    <div class="clear"></div>

                    <p>Размер поля</p>
                    <span>8 фт</span>
                    <div class="clear"></div>

                    <p>Материал стола</p>
                    <span>Массив ясеня или дуба</span>
                    <div class="clear"></div>

                    <p>Цена</p>
                    <span class="price_td">
                      <span class="em">250 000</span>
                      <a href="javascript:void(0);" class="add_to_cart2" title="В корзину"><span class="b"></span></a>
                      <a href="javascript:void(0);" class="add_to_fav2" title="В избранное"><span class="b"></span></a>
                    </span>
                    <div class="clear"></div>
                </div>

            </div>
            <!-- /all sizes -->

            <!-- 10 -->
            <div class="box">

                <div class="tab_row_mob">
                    <p>Тип игры</p>
                    <span>Пирамида</span>
                    <div class="clear"></div>

                    <p>Размер поля</p>
                    <span>8 фт</span>
                    <div class="clear"></div>

                    <p>Материал стола</p>
                    <span>Массив ясеня или дуба</span>
                    <div class="clear"></div>

                    <p>Цена</p>
                    <span class="price_td">
                      <span class="em">250 000</span>
                      <a href="javascript:void(0);" class="add_to_cart2" title="В корзину"><span class="b"></span></a>
                      <a href="javascript:void(0);" class="add_to_fav2" title="В избранное"><span class="b"></span></a>
                    </span>
                    <div class="clear"></div>
                </div>

                <div class="tab_row_mob">
                    <p>Тип игры</p>
                    <span>Пирамида</span>
                    <div class="clear"></div>

                    <p>Размер поля</p>
                    <span>8 фт</span>
                    <div class="clear"></div>

                    <p>Материал стола</p>
                    <span>Массив ясеня или дуба</span>
                    <div class="clear"></div>

                    <p>Цена</p>
                    <span class="price_td">
                      <span class="em">250 000</span>
                      <a href="javascript:void(0);" class="add_to_cart2" title="В корзину"><span class="b"></span></a>
                      <a href="javascript:void(0);" class="add_to_fav2" title="В избранное"><span class="b"></span></a>
                    </span>
                    <div class="clear"></div>
                </div>

            </div>
            <!-- /10 -->

            <!-- 12 -->
            <div class="box">

                <div class="tab_row_mob">
                    <p>Тип игры</p>
                    <span>Пирамида</span>
                    <div class="clear"></div>

                    <p>Размер поля</p>
                    <span>8 фт</span>
                    <div class="clear"></div>

                    <p>Материал стола</p>
                    <span>Массив ясеня или дуба</span>
                    <div class="clear"></div>

                    <p>Цена</p>
                    <span class="price_td">
                      <span class="em">250 000</span>
                      <a href="javascript:void(0);" class="add_to_cart2" title="В корзину"><span class="b"></span></a>
                      <a href="javascript:void(0);" class="add_to_fav2" title="В избранное"><span class="b"></span></a>
                    </span>
                    <div class="clear"></div>
                </div>

                <div class="tab_row_mob">
                    <p>Тип игры</p>
                    <span>Пирамида</span>
                    <div class="clear"></div>

                    <p>Размер поля</p>
                    <span>8 фт</span>
                    <div class="clear"></div>

                    <p>Материал стола</p>
                    <span>Массив ясеня или дуба</span>
                    <div class="clear"></div>

                    <p>Цена</p>
                    <span class="price_td">
                      <span class="em">250 000</span>
                      <a href="javascript:void(0);" class="add_to_cart2" title="В корзину"><span class="b"></span></a>
                      <a href="javascript:void(0);" class="add_to_fav2" title="В избранное"><span class="b"></span></a>
                    </span>
                    <div class="clear"></div>
                </div>

            </div>
            <!-- /12 -->

        </div>

        <div class="pattern_top"></div>
    </div>

</div>
<!-- /tables type -->
<?}?>


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
<!-- /attended products -->


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