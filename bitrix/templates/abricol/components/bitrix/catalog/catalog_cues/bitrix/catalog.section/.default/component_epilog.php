<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $templateData */
/** @var @global CMain $APPLICATION */
use Bitrix\Main\Loader;
global $APPLICATION;

if(!empty($arResult['SEO_H1'])){
	$APPLICATION->SetPageProperty('new-h1', $arResult['SEO_H1']);
}