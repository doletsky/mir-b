<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
#pre($_POST);

global $USER;
#if(!CModule::IncludeModule("sale")) return;
#if(!CModule::IncludeModule("iblock")) return;

if(isset($_POST['IBLOCK_ID']) && $_POST['IBLOCK_ID'] && isset($_POST['ID']) && $_POST['ID']){
  $IBLOCK_ID=(int)$_POST['IBLOCK_ID'];
  $ID=(int)$_POST['ID'];
  if(!$USER->IsAuthorized()){
    $arElements = unserialize($_SESSION['favorites']);
    if(!isset($arElements[$IBLOCK_ID])){
      $arElements[$IBLOCK_ID]=array();
      $arElements[$IBLOCK_ID][$ID]=1;
    }
    elseif($_POST['added']=='true'){
      if(!isset($arElements[$IBLOCK_ID][$ID])) $arElements[$IBLOCK_ID][$ID] = 1;
    }
    else{
      if(isset($arElements[$IBLOCK_ID][$ID])){
        unset($arElements[$IBLOCK_ID][$ID]);
        if(!count($arElements[$IBLOCK_ID])) unset($arElements[$IBLOCK_ID]);
      }
    }
    $_SESSION["favorites"]=serialize($arElements);
  }
  else{
    $idUser = $USER->GetID();
    $rsUser = CUser::GetByID($idUser);
    $arUser = $rsUser->Fetch();
    $arElements = unserialize($arUser['UF_FAVORITES']);
    if(!isset($arElements[$IBLOCK_ID])){
      $arElements[$IBLOCK_ID]=array();
      $arElements[$IBLOCK_ID][$ID]=1;
    }
    elseif($_POST['added']=='true'){
      if(!isset($arElements[$IBLOCK_ID][$ID])) $arElements[$IBLOCK_ID][$ID] = 1;
    }
    else{
      if(isset($arElements[$IBLOCK_ID][$ID])){
        unset($arElements[$IBLOCK_ID][$ID]);
        if(!count($arElements[$IBLOCK_ID])) unset($arElements[$IBLOCK_ID]);
      }
    }
    $USER->Update($idUser, Array("UF_FAVORITES"=>serialize($arElements)));
  }
  #pre($arElements);

  $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_TEMPLATE_PATH."/ajax/favorites-status.php"), false);
}
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>