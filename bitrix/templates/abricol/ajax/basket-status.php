<?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket", "status", array(
	"COLUMNS_LIST" => array(
		0 => "NAME",
		1 => "PROPS",
		2 => "PRICE",
		3 => "QUANTITY",
		4 => "DELETE",
		5 => "DISCOUNT",
	),
	"PATH_TO_ORDER" => "/order/",
	"HIDE_COUPON" => "Y",
	"QUANTITY_FLOAT" => "N",
	"PRICE_VAT_SHOW_VALUE" => "N",
	"COUNT_DISCOUNT_4_ALL_QUANTITY" => "Y",
	"USE_PREPAYMENT" => "N",
	"SET_TITLE" => "N"
	),
	false
);?>