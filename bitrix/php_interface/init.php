<?

if(strstr($_SERVER['HTTP_HOST'], 'mir-b.ru')){
	include($_SERVER['DOCUMENT_ROOT'].'/redirect.php');

	include('seo.php');

}


include_once("include/minPrice.php" ) ;




function formatSizeUnits($bytes){
  if ($bytes >= 1073741824){
      $bytes = number_format($bytes / 1073741824, 2) . ' GB';
  }
  elseif ($bytes >= 1048576){
      $bytes = number_format($bytes / 1048576, 2) . ' MB';
  }
  elseif ($bytes >= 1024){
      $bytes = number_format($bytes / 1024, 2) . ' KB';
  }
  elseif ($bytes > 1){
      $bytes = $bytes . ' bytes';
  }
  elseif ($bytes == 1){
      $bytes = $bytes . ' byte';
  }
  else{
      $bytes = '0 bytes';
  }
  return $bytes;
}

/**
 * Генерация превьюшек для больших изображений
 *
 * @param string $src путь от корня сайта к исходной картинке
 * @param int $size размер изображения (сторона квадрата в пикселях)
 * @param int $lifeTime время жизни превьюшки в секундах (по дефолту месяц)
 * @return string
 */
function MakeImage($src, $params = false) {
	if (!is_array($params) AND is_numeric($params)) $params = array('w'=>intval($params)); // подмена
	if (is_numeric($src)) if ($src > 0) $src = CFile::GetPath($src);
	if (file_exists($_SERVER['DOCUMENT_ROOT'].$src)) {
	$ext = strtolower(pathinfo($_SERVER['DOCUMENT_ROOT'].$src, PATHINFO_EXTENSION)); // Расширение файла картинки
	$allowed_ext = array("jpg", "jpeg", "gif", "png");
	if (in_array($ext, $allowed_ext)) {
		$base_name = basename($src, ".".$ext); // Основное имя файла (без расширения)
		$code = substr(md5(serialize($params)), 8, 16); // сократим суффикс с параметрами до 16 символов, но возьмем его из середины хэша
					$newExt=$ext;
					if(isset($params["f"])){
						$newExt=$params["f"];
					}
		$target_file = $_SERVER['DOCUMENT_ROOT'].dirname($src)."/".$base_name."_thumb_".$code.".".$newExt; // Имя файла с превьюшкой
		$source_filemtime = filemtime($_SERVER['DOCUMENT_ROOT'].$src);
		if (file_exists($target_file)) $target_filemtime = filemtime($target_file);
		else $target_filemtime = 0;
		if ($source_filemtime>$target_filemtime) { // файл-исходник обновлен, либо нету сгенерированного
		require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/php_interface/phpThumb/phpthumb.class.php"); // Подключаем и иннициализируем phpThumb
		$phpThumb = new phpThumb();
		$phpThumb->f = $ext;
		$phpThumb->src = $src;
		$phpThumb->config_allow_src_above_docroot = true; // Разрешаем работать в других разделах (для многосайтовости)
		// Дефолтные параметры:
		$phpThumb->q = 100;
		$phpThumb->bg = "ffffff";
		$phpThumb->far = "C";
		$phpThumb->aoe = 0;
		/*$phpThumb->zc = 1;*/
		// Применение всех параметров
		if (is_array($params)) {
			foreach ($params as $param=>$value) {
			$phpThumb->$param = $value;
			}
		}
		$phpThumb->GenerateThumbnail();
		$phpThumb->RenderToFile($target_file);
		}
	}
	if (file_exists($target_file)) {
		return substr($target_file, strlen($_SERVER['DOCUMENT_ROOT']));
	}
	}
	return false;
}

function words($i,$word1,$word2,$word5){
		$i=(int)$i;
		if($i>10 && $i<=20) return $word5;
		switch($i%10){
			case 1:
					return $word1;
					break;
			case 2:
			case 3:
			case 4:
					return $word2;
					break;
			default:
					return $word5;
					break;
		}
}

function pre($str) {
	if (is_array($str)) {
		echo "<pre>"; print_r($str); echo "</pre>";
	} else {
		echo $str;
	}
}
#AddEventHandler("main", "OnBeforeUserRegister", "OnBeforeUserRegisterHandler");
#AddEventHandler("main", "OnBeforeUserUpdate", "OnBeforeUserRegisterHandler");
AddEventHandler("main", "OnBeforeEventAdd",  "OnBeforeEventAddHandler");

// описываем саму функцию
function OnBeforeUserRegisterHandler($args){
	if($args['EMAIL'])
		$args['LOGIN'] = $args['EMAIL'];
}

function plural_form($number, $after) {
  $cases = array (2, 0, 1, 1, 1, 2);
  echo $after[ ($number%100>4 && $number%100<20)? 2: $cases[min($number%10, 5)] ];
}
//добавляем необходимую информацию в письмо
function OnBeforeEventAddHandler(&$event, &$lid, &$arFields)
{
    if(substr_count("SALE_NEW_ORDER", $event)){
        CModule::IncludeModule('sale');
        $arOrder = CSaleOrder::GetByID($arFields['ORDER_ID']);
        if ($arOrderPropsValue = CSaleOrderPropsValue::GetOrderProps($arFields['ORDER_ID'])) {
            while ($orderProp = $arOrderPropsValue->Fetch()) {
                $arFields["ORDER_PROPS"][]=$orderProp;
                switch ($orderProp["ORDER_PROPS_ID"]) {
                    case 1:
                        $arFields["FIO_45"] = $orderProp["VALUE"];
                        break;
                    case 2:
                        $arFields["PHONE_45"] = $orderProp["VALUE"];
                        break;
                    case 3:
                        $arFields["EMAIL_45"] = $orderProp["VALUE"];
                        break;
                    case 6:
                        $arFields["COMMENT_45"] = $orderProp["VALUE"];
                        break;
                    case 5:
                        $arFields["ADDRESS_45"] = $orderProp["VALUE"];
                        break;
                }
            }
        }
        $pp=1;
        $dbBasketItems = CSaleBasket::GetList(array(),array("ORDER_ID" => $arFields['ORDER_ID']));
        while ($arItems = $dbBasketItems->Fetch())
        {
            $arFields["ORDER_LIST_INIT_45"].= $pp.". ".$arItems['NAME'].", ".intval($arItems['QUANTITY'])." шт.: ".intval($arItems['PRICE'])." руб.\n";
            $pp++;
        }

        $arFields["FIELD_TEST_INIT"] = "event: ".print_r($event, true)."\nlid: ".print_r($lid, true)."\narField: ".print_r($arFields,true)."\narOrder: ".print_r($arOrder,true);
    }

}

?>