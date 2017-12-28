<?
global $APPLICATION;
#pre($arParams);
?>
<div class="sort_box">
  <div class="aligned">
    <?
    $urlClean=$APPLICATION->GetCurPageParam("",array("sort"));

    $urlSortName=$APPLICATION->GetCurPageParam("sort=name",array("sort","order"));
    $urlSortNameBack=$APPLICATION->GetCurPageParam("sort=name&order=desc",array("sort","order"));
    $isSortName=(isset($_REQUEST["sort"]) && $_REQUEST["sort"]=="name");
    
    $urlSortPrice=$APPLICATION->GetCurPageParam("sort=price",array("sort","order"));
    $urlSortPriceBack=$APPLICATION->GetCurPageParam("sort=price&order=desc",array("sort","desc"));
    $isSortPrice=(isset($_REQUEST["sort"]) && $_REQUEST["sort"]=="price");

    $isBack = (isset($_REQUEST["order"]) && $_REQUEST["order"]=="desc");
    ?>
    <div class="sort_filter sort item">
      <p>Сортировать по</p>
      
      <a href="<?if($isBack){echo $urlSortName;}else{echo $urlSortNameBack;}?>" class="<?if($isSortName) echo 'active';?>"><span>названию</span><span class="<?if($isBack){?>b<?}else{?>a<?}?>"></span></a>

      <a href="<?if($isBack){echo $urlSortPrice;}else{echo $urlSortPriceBack;}?>" class="<?if($isSortPrice) echo 'active';?>"><span>цене</span><span class="<?if($isBack){?>b<?}else{?>a<?}?>"></span></a>
    </div>
    <?
    $urlClean=$APPLICATION->GetCurPageParam("",array("new","spec"));
    $urlNew=$APPLICATION->GetCurPageParam("new=Y",array("new","spec"));
    $isNew=isset($_REQUEST["new"]);
    #if($isNew) $GLOBALS["arrFilter"]["PROPERTY_IS_NEW"]=21;
    $urlSpec=$APPLICATION->GetCurPageParam("spec=Y",array("new","spec"));
    $isSpec=isset($_REQUEST["spec"]);
    #if($isSpec) $GLOBALS["arrFilter"]["PROPERTY_IS_SPEC"]=22;
    ?>
    <div class="sort_filter sort3 item">
      <span class="spec <?if($isNew) echo 'active';?>"><a href="<?if($isNew){echo $urlClean;}else{echo $urlNew;}?>"><span>новинки</span></a></span>
      <span class="spec <?if($isSpec) echo 'active';?>"><a href="<?if($isSpec){echo $urlClean;}else{echo $urlSpec;}?>"><span>спецпредложения</span></a></span>
    </div> 
    <?
  	if($arParams['IBLOCK_ID']==6){
  		$onPageArr=array(5, 20,50,100);
  		$arParams["PAGE_ELEMENT_COUNT"] = 50;
  	}else{
  		$onPageArr=array(20,50,100);
  	}
    $onPage=$arParams["PAGE_ELEMENT_COUNT"];
    ?>
    <div class="sort_filter sort2 item">
      <p>Выводить по</p>
      <?
      $count=count($onPageArr);
      foreach($onPageArr as $i => $onPageI){
        $urlPage=$APPLICATION->GetCurPageParam("onp=".$onPageI,array("onp"));
      ?>
      <a <?if($onPageI==$onPage){?>class="active"<?}?> href="<?=$urlPage?>"><span><?=$onPageI?></span></a><?if($i<$count-1){?><span class="em">,</span><?}?>
      <?
      }
      ?>
    </div>
    <span class="aligned__under"></span>
  </div>
  <div class="clear"></div>
</div>