<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if (!empty($arResult)){
  $menu=array();
  $parent=0;
  $parents=array(1=>"root");
  foreach($arResult as $i => $arItem){
    #print_r($arItem);
    if($arItem["DEPTH_LEVEL"]==1){
      $parent="root";
    }
    elseif($lastLevel && $arItem["DEPTH_LEVEL"] < $lastLevel){
      $parent=$parents[$arItem["DEPTH_LEVEL"]-1];
    }
    $menu[$parent][]=$arItem;
    $lastLevel = $arItem["DEPTH_LEVEL"];
    $lastLINK = $arItem["LINK"];
    if($arItem["IS_PARENT"]){
      $parent=$lastLINK;
      $parents[$arItem["DEPTH_LEVEL"]]=$lastLINK;
    }
    if($arItem["LINK"]=="/catalog/accessories/covers-for-tables/"){
      #pre($parents);
    }
  }
  #print_r($menu);
  if(count($menu["root"])){
  ?>
    <div class="cat_menu_in">
      <div class="block_pattern_top3"></div>
      <div class="block_pattern_bottom3"></div>
      <ul>
      <?
      foreach($menu["root"] as $arItem){
        ?>
        <li <?if($arItem["SELECTED"]){?>class="active"<?}?>>
          <a href="<?=$arItem["LINK"]?>">
            <span><?=$arItem["TEXT"]?></span>
          </a>
          <?if(count($menu[$arItem["LINK"]]) && $arItem["SELECTED"]){?>
            <ul>
              <?foreach($menu[$arItem["LINK"]] as $arItem1){?>
              <li>
                <a <?if($arItem1["SELECTED"]){?>class="active"<?}?> href="<?=$arItem1["LINK"]?>"><?=$arItem1["TEXT"]?></a>
                <?if($arItem1["SELECTED"]){?>
                  <?foreach($menu[$arItem1["LINK"]] as $arItem2){?>
                  <a href="<?=$arItem2["LINK"]?>" class="level3"><?=$arItem2["TEXT"]?></a>
                  <?}?>
                <?}?>
              </li>
              <?}?>
            </ul>
          <?}?>
        </li>
        <?
      }
      ?>
      </ul>
    </div>
  <?}
}?>