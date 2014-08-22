<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
// $wizTemplateId = COption::GetOptionString("main", "wizard_template_id", "eshop_adapt_horizontal", SITE_ID);
// $template =  ($wizTemplateId == "eshop_adapt_vertical") ? "vertical" : "";
?>
<?$APPLICATION->IncludeComponent("bitrix:catalog.viewed.products", "shik", Array(
	"HIDE_NOT_AVAILABLE" => "N",	// Не отображать товары, которых нет на складах
	"PAGE_ELEMENT_COUNT" => "5",	// Количество элементов на странице
	"SHOW_DISCOUNT_PERCENT" => "Y",	// Показывать процент скидки
	"PRODUCT_SUBSCRIPTION" => "N",	// Разрешить оповещения для отсутствующих товаров
	"SHOW_NAME" => "Y",	// Показывать название
	"SHOW_IMAGE" => "Y",	// Показывать изображение
	"MESS_BTN_BUY" => "Купить",	// Текст кнопки "Купить"
	"MESS_BTN_DETAIL" => "Подробнее",	// Текст кнопки "Подробнее"
	"MESS_BTN_SUBSCRIBE" => "Подписаться",	// Текст кнопки "Уведомить о поступлении"
	"LINE_ELEMENT_COUNT" => "5",	// Количество элементов, выводимых в одной строке
	"TEMPLATE_THEME" => "site",	// Цветовая тема
	"SHOW_OLD_PRICE" => "N",	// Показывать старую цену
	"PRICE_CODE" => array(	// Тип цены
		0 => "BASE",
	),
	"SHOW_PRICE_COUNT" => "1",	// Выводить цены для количества
	"PRICE_VAT_INCLUDE" => "Y",	// Включать НДС в цену
	"CONVERT_CURRENCY" => "N",	// Показывать цены в одной валюте
	"BASKET_URL" => "/personal/cart/",	// URL, ведущий на страницу с корзиной покупателя
	"ACTION_VARIABLE" => "action",	// Название переменной, в которой передается действие
	"PRODUCT_ID_VARIABLE" => "id",	// Название переменной, в которой передается код товара для покупки
	"ADD_PROPERTIES_TO_BASKET" => "Y",	// Добавлять в корзину свойства товаров и предложений
	"PRODUCT_PROPS_VARIABLE" => "prop",	// Название переменной, в которой передаются характеристики товара
	"PARTIAL_PRODUCT_PROPERTIES" => "N",	// Разрешить частично заполненные свойства
	"USE_PRODUCT_QUANTITY" => "N",	// Разрешить указание количества товара
	"SHOW_PRODUCTS_2" => "Y",	// Показывать товары каталога
	"OFFER_TREE_PROPS_3" => array(
		0 => "COLOR_REF",
		1 => "SIZES_SHOES",
		2 => "SIZES_CLOTHES",
	),
	"PRODUCT_QUANTITY_VARIABLE" => "quantity",	// Название переменной, в которой передается количество товара
	),
	false
);?>