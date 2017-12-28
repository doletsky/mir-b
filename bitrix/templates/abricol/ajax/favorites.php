<?
$offerIBlockID=array(
  4 => 5,
  7 => 8,
  9 => 10
);
global $USER;
if(!$USER->IsAuthorized()){
  $arElements = unserialize($_SESSION['favorites']);
}
else{
  $idUser = $USER->GetID();
  $rsUser = CUser::GetByID($idUser);
  $arUser = $rsUser->Fetch();
  $arElements = unserialize($arUser['UF_FAVORITES']);
}
if(!CModule::IncludeModule("sale")) return;
if(!CModule::IncludeModule("iblock")) return;
?>
<form action="#" method="post">
  <fieldset>
    <div class="exh2">Избранное</div>
    <div class="cart_tab" style="width:auto;">
      <div class="col_th_1 col_th" style="width:560px">Фото и наименование товара</div>
      <div class="col_th_2 col_th">Кол-во</div>
      <div class="col_th_3 col_th">Цена</div>
      <div class="col_th_4 col_th">Сумма</div>
      <div class="clear"></div>
      <span class="spr"></span>
      
      <?
      foreach($arElements as $IBLOCK_ID => $arr){
        $IDs=array_keys($arr);
        $arFilter = Array('IBLOCK_ID'=>$IBLOCK_ID, 'ACTIVE'=>'Y', 'ID'=>$IDs);
        $db_list = CIBlockElement::GetList(Array("sort"=>"asc"),$arFilter,false,false,array("NAME","PREVIEW_PICTURE","DETAIL_PAGE_URL","CATALOG_GROUP_1"));
        while($arItem = $db_list->GetNext()){
          if(isset($offerIBlockID[$IBLOCK_ID])){
            $arOffers = CCatalogSKU::getOffersList($arItem["ID"],$IBLOCK_ID,array(),array("ID","CATALOG_GROUP_1"));
            #pre($arOffers[$arItem["ID"]]);
            #pre($arItem);
            $minPrice=null;
            foreach($arOffers[$arItem["ID"]] as $arOffer){
              if(is_null($minPrice)) $minPrice=$arOffer["CATALOG_PRICE_1"];
              if($arOffer["CATALOG_PRICE_1"]<=$minPrice) $minPrice=$arOffer["CATALOG_PRICE_1"];
            }
			if(is_null($minPrice)){
				$arPrice = CPrice::GetBasePrice($arItem['ID']);
				$minPrice=$arPrice['PRICE'];
			}
          }
          else{
			$arPrice = CPrice::GetBasePrice($arItem['ID']);
			
            $minPrice=$arPrice['PRICE'];
          }
          #pre($arItem);
        ?>
        <div class="cart_tab_row">
          <div class="col_td_1 col_td" style="width:560px">
            <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="item_preview"><img src="<?=MakeImage($arItem["PREVIEW_PICTURE"],array("w"=>66,"h"=>40))?>" alt=""></a>
            <a class="item_name" href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["~NAME"]?></a>
            <div class="clear"></div>
          </div>
          <div class="col_td_2 col_td">
            <div class="amount">
              <input type="text" class="inp_sm" value="1" readonly disabled>
            </div>
          </div>
          <div class="col_td_3 col_td"><?=number_format($minPrice,0,'',' ')?> <span class="rub">i</span></div>
          <div class="col_td_4 col_td"><?=number_format($minPrice,0,'',' ')?> <span class="rub">i</span></div>
          <div class="col_td_5 col_td"><?/*?><span class="delete"></span><?*/?></div>
          <div class="clear"></div>
        </div>
        <?
      }}
      ?>
      
      <span class="spr spr2"></span>
      
      <?/*?><div class="total">ИТОГО</div>
      <div class="total_sum">340 000 <span class="rub">i</span></div><?*/?>
      <div class="clear"></div>
    </div>
    
    <?/*?>
    <div class="order_wrap">
      <div class="order_box">
        <div class="pattern_bottom"></div>
        <div class="pattern_top"></div>
        <div class="order_head">
          <p>Сумма заказа <strong>340 000 <span class="rub">i</span></strong></p>
        </div>
        <div class="order_body">
          <div class="sum">
            <p class="discount"><b></b>С учетом скидки 5%</p>
            <strong>345 <span class="rub">i</span></strong>
            <div class="clear"></div>
          </div>
          <input type="button" value="Оформить заказ" class="button close-reveal-modal">
        </div>
      </div>
      <a href="javascript:void(0);" title="Консультация онлайн" class="online_consult">
        <b></b>
        <span>Консультация <br>онлайн</span>
      </a>
    </div>
    <?*/?>
    <div class="clear"></div>
  
  </fieldset>
</form>