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
      $parent=$parents[$arItem["DEPTH_LEVEL"]];
    }
    $menu[$parent][]=$arItem;
    $lastLevel = $arItem["DEPTH_LEVEL"];
    $lastLINK = $arItem["LINK"];
    if($arItem["IS_PARENT"]){
      $parent=$lastLINK;
      $parents[$arItem["DEPTH_LEVEL"]]=$lastLINK;
    }
  }
  #print_r($menu);
  if(count($menu["root"])){
  ?>
    <ul>
    <?
    foreach($menu["root"] as $arItem){
      ?>
      <li <?if($arItem["SELECTED"]){?>class="active"<?}?>>
        <a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
        <?if(count($menu[$arItem["LINK"]])){
		#print_r($menu[$arItem["LINK"]] );
		?>
        <ul>
          <?foreach($menu[$arItem["LINK"]] as $arItem1){
		 // print_r($arItem1 );
		 
		  ?>
          <li><a <?if($arItem1["SELECTED"]){?>class="active"<?}?> href="<?=$arItem1["LINK"]?>"><?=$arItem1["TEXT"]?></a></li>
          <?}?>
        </ul>
        <?}?>
      </li>
    <?}?>
    </ul>
  <?}
}?>