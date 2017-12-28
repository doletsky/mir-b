<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->SetTitle("Оформление заказа");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_after.php");
?>
<?$APPLICATION->IncludeComponent("bitrix:sale.order.ajax", "order", Array(
	"COMPONENT_TEMPLATE" => ".default",
		"PAY_FROM_ACCOUNT" => "N",	// Позволять оплачивать с внутреннего счета
		"ONLY_FULL_PAY_FROM_ACCOUNT" => "N",	// Позволять оплачивать с внутреннего счета только в полном объеме
		"COUNT_DELIVERY_TAX" => "N",	// Рассчитывать налог для доставки
		"ALLOW_AUTO_REGISTER" => "Y",	// Оформлять заказ с автоматической регистрацией пользователя
		"SEND_NEW_USER_NOTIFY" => "Y",	// Отправлять пользователю письмо, что он зарегистрирован на сайте
		"DELIVERY_NO_AJAX" => "Y",	// Рассчитывать стоимость доставки сразу
		"DELIVERY_NO_SESSION" => "Y",	// Проверять сессию при оформлении заказа
		"TEMPLATE_LOCATION" => "popup",	// Шаблон местоположения
		"DELIVERY_TO_PAYSYSTEM" => "d2p",	// Последовательность оформления
		"USE_PREPAYMENT" => "N",	// Использовать предавторизацию для оформления заказа (PayPal Express Checkout)
		"ALLOW_NEW_PROFILE" => "N",	// Разрешить множество профилей покупателей
		"SHOW_PAYMENT_SERVICES_NAMES" => "Y",	// Отображать названия платежных систем
		"SHOW_STORES_IMAGES" => "N",	// Показывать изображения складов в окне выбора пункта выдачи
		"PATH_TO_BASKET" => "/cart/",	// Страница корзины
		"PATH_TO_PERSONAL" => "index.php",	// Страница персонального раздела
		"PATH_TO_PAYMENT" => "payment.php",	// Страница подключения платежной системы
		"PATH_TO_AUTH" => "/auth/",	// Страница авторизации
		"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
		"DISABLE_BASKET_REDIRECT" => "N",	// Оставаться на странице, если корзина пуста
		"PRODUCT_COLUMNS" => "",	// Дополнительные колонки таблицы товаров заказа
		"PROP_1" => "",	// Не показывать свойства для типа плательщика "Физ.лицо" (s1)
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>