<?
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
?>
<script>
<?
$count=0;
foreach($arElements as $IBLOCK_ID => $arr){
  foreach($arr as $ID => $v){
    $count++;
    ?>
    $("#favorites_<?=$IBLOCK_ID?>_<?=$ID?>").addClass("added");
    <?
  }
}
?>
$("#favorite .items_num, #mobile_favorite .items_num").text(<?=$count?>);
refreshFavorites();
</script>