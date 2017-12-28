<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @global CDatabase $DB */

$frame = $this->createFrame()->begin();

if (!empty($arResult['ITEMS']))
{


?>
<div class="viewed">
    <h3>Вы уже смотрели</h3>

    <div class="viewed_items_slider">
		<?
		foreach ($arResult['ITEMS'] as $key => $arItem)
		{
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $elementEdit);
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $elementDelete, $elementDeleteParams);
		$strMainID = $this->GetEditAreaId($arItem['ID']);
		?>
        <div class="viewed_box" id="<? echo $strMainID; ?>">
              <a href="<? echo $arItem['DETAIL_PAGE_URL']; ?>"> <img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt=""></a>
            <div class="viewed_content">
                <a href="<? echo $arItem['DETAIL_PAGE_URL']; ?>"><? echo $arItem['NAME']; ?></a>
                <p><?=number_format($arItem['MIN_PRICE']['DISCOUNT_VALUE'], 0, ',', ' ')?><span class="rub">i</span></p>
            </div>
        </div>
		<?}?>
        <!--<div class="viewed_box viewed_all">
            <span class="all_viewed"></span>
            <div class="viewed_content">
                <a href="#">Вся история просмотров</a>
                <p>143 товара</p>
            </div>
        </div>-->
    </div>
</div>


<?
}
?>
<?$frame->beginStub();?>
<?$frame->end();