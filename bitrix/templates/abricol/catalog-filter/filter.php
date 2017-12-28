<?


if($_REQUEST["type"]=='collections'){
	$_REQUEST["filter"]["GAME_TYPE"]= 	$_REQUEST["GAME_TYPE"]; 
	$_REQUEST["filter"]["ROOM_L"]= 	$_REQUEST["ROOM_L"]; 
	$_REQUEST["filter"]["ROOM_W"]= 	$_REQUEST["ROOM_W"]; 
	foreach($_REQUEST["filter"] as $k=>$v){
	  if($k=="price" && $_REQUEST["filter"]["price"]){
		$priceArr=explode("-",$_REQUEST["filter"]["price"]);
		$isPrice0=isset($priceArr[0]) && $priceArr[0];
		$isPrice1=isset($priceArr[1]) && $priceArr[1];
		if( $isPrice0 && $isPrice1 ){
		  $GLOBALS["arrFilter"]["><PROPERTY_MIN_PRICE_FOR_SORT"]=array($priceArr[0],$priceArr[1]);
		}
		elseif( $isPrice0 && !$isPrice1 ){
		  $GLOBALS["arrFilter"][">=PROPERTY_MIN_PRICE_FOR_SORT"]=$priceArr[0];
		}
		elseif( !$isPrice0 && $isPrice1 ){
		  $GLOBALS["arrFilter"]["<=PROPERTY_MIN_PRICE_FOR_SORT"]=$priceArr[1];
		}
		
	  }elseif($k=="ROOM_L" || $k=="ROOM_W"){
		$GLOBALS["arrFilter"]["<=PROPERTY_".$k]=$v;
	  }
	  elseif($v){
		$GLOBALS["arrFilter"]["=PROPERTY_".$k]=$v;
	  }
	}

}else{
	foreach($_REQUEST["filter"] as $k=>$v){
	  if($k=="price" && $_REQUEST["filter"]["price"]){
		$priceArr=explode("-",$_REQUEST["filter"]["price"]);
		$isPrice0=isset($priceArr[0]) && $priceArr[0];
		$isPrice1=isset($priceArr[1]) && $priceArr[1];
		if( $isPrice0 && $isPrice1 ){
		  $GLOBALS["arrFilter"]["><CATALOG_PRICE_1"]=array($priceArr[0],$priceArr[1]);
		}
		elseif( $isPrice0 && !$isPrice1 ){
		  $GLOBALS["arrFilter"][">=CATALOG_PRICE_1"]=$priceArr[0];
		}
		elseif( !$isPrice0 && $isPrice1 ){
		  $GLOBALS["arrFilter"]["<=CATALOG_PRICE_1"]=$priceArr[1];
		}
	  }
	  elseif($v){
		$GLOBALS["arrFilter"]["OFFERS"]["=PROPERTY_".$k]=array($v);
	  }
	}
}
#pre($GLOBALS["arrFilter"]);
?>