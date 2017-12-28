<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$bDefaultColumns = $arResult["GRID"]["DEFAULT_COLUMNS"];
$colspan = ($bDefaultColumns) ? count($arResult["GRID"]["HEADERS"]) : count($arResult["GRID"]["HEADERS"]) - 1;
$bPropsColumn = false;
$bUseDiscount = false;
$bPriceType = false;
$bShowNameWithPicture = ($bDefaultColumns) ? true : false; // flat to show name and picture column in one column
?>
<div class="order_box2_wrap">
  <div class="order_box2">
    <div class="pattern_bottom"></div>
    <div class="pattern_top"></div>
    <div class="order_head2">
      <span>Ваш заказ</span>
    </div>
    <?#pre($arResult)?>
    <div class="order_box2_body">
    	<?foreach ($arResult["GRID"]["ROWS"] as $k => $arData){?>
    	<?#pre($arData)?>
      <div class="order_in">
        <p><?=$arData["data"]["~NAME"]?><strong><?=$arData["data"]["QUANTITY"]?> x <?=number_format($arData["data"]["PRICE"],0,""," ")?> <span class="rub">i</span></strong></p>
      </div>
      <?}?>
      <div class="order_sum">Сумма заказа <br><?=number_format($arResult["ORDER_PRICE"],0,""," ")?> <span class="rub">i</span></div>
    </div>
  </div>

 	<?/*?><div class="links">
    <a href="#" title="Консультация онлайн" class="online_consult">
      <b></b>
      <span>Консультация <br>онлайн</span>
    </a>
  </div><?*/?>
</div>