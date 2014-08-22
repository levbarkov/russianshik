<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Интернет-магазин \"Одежда\"");
?>

<?$APPLICATION->IncludeComponent("shik:banners", "slider", Array(
	"BLOCK_ID" => "3",	// ID инфоблока
	"DETAIL_URL" => "",	// Путь к странице просмотра записи
	),
	false
);?>

<?$APPLICATION->IncludeComponent("shik:banners", "banners", Array(
	"BLOCK_ID" => "4",	// ID инфоблока
	"DETAIL_URL" => "",	// Путь к странице просмотра записи
	),
	false
);?>

 <?$APPLICATION->IncludeComponent(
	"shik:catalog.section.list",
	"all_sections",
	Array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID1" => "2",
		"COUNT_ELEMENTS" => "Y",
		"TOP_DEPTH" => "1",
		"SECTION_FIELDS" => array(),
		"SECTION_USER_FIELDS" => array(),
		"ADD_SECTIONS_CHAIN" => "Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_NOTES" => "",
		"CACHE_GROUPS" => "Y"
	)
);?>


<h2>Лучшие коллекции</h2>
<?$APPLICATION->IncludeComponent("bitrix:catalog.top", "shik", Array(
	"IBLOCK_TYPE_ID" => "catalog",
	"IBLOCK_ID" => "2",	// Инфоблок
	"ELEMENT_SORT_FIELD" => "name",	// По какому полю сортируем элементы
	"ELEMENT_SORT_ORDER" => "asc",	// Порядок сортировки элементов
	"ELEMENT_SORT_FIELD2" => "name",	// Поле для второй сортировки элементов
	"ELEMENT_SORT_ORDER2" => "asc",	// Порядок второй сортировки элементов
	"HIDE_NOT_AVAILABLE" => "N",	// Не отображать товары, которых нет на складах
	"ELEMENT_COUNT" => "8",	// Количество выводимых элементов
	"LINE_ELEMENT_COUNT" => "4",	// Количество элементов выводимых в одной строке таблицы
	"PROPERTY_CODE" => array(	// Свойства
		0 => "MINIMUM_PRICE",
		1 => "MAXIMUM_PRICE",
		2 => "",
	),
	"OFFERS_FIELD_CODE" => array(
		0 => "NAME",
		1 => "",
	),
	"OFFERS_PROPERTY_CODE" => array(
		0 => "ARTNUMBER",
		1 => "COLOR_REF",
		2 => "SIZES_SHOES",
		3 => "SIZES_CLOTHES",
		4 => "MORE_PHOTO",
		5 => "",
	),
	"OFFERS_SORT_FIELD" => "sort",
	"OFFERS_SORT_ORDER" => "asc",
	"OFFERS_SORT_FIELD2" => "id",
	"OFFERS_SORT_ORDER2" => "desc",
	"OFFERS_LIMIT" => "0",	// Максимальное количество предложений для показа (0 - все)
	"VIEW_MODE" => "SLIDER",	// Показ элементов
	"TEMPLATE_THEME" => "site",	// Цветовая тема
	"PRODUCT_DISPLAY_MODE" => "Y",
	"ADD_PICT_PROP" => "MORE_PHOTO",	// Дополнительная картинка основного товара
	"LABEL_PROP" => "NEWPRODUCT",	// Свойство меток товара
	"OFFER_ADD_PICT_PROP" => "MORE_PHOTO",
	"OFFER_TREE_PROPS" => array(
		0 => "COLOR_REF",
		1 => "SIZES_SHOES",
		2 => "SIZES_CLOTHES",
	),
	"SHOW_DISCOUNT_PERCENT" => "Y",	// Показывать процент скидки
	"SHOW_OLD_PRICE" => "Y",	// Показывать старую цену
	"ROTATE_TIMER" => "30",	// Время показа одного слайда, сек (0 - выключить автоматическую смену слайдов)
	"MESS_BTN_BUY" => "Купить",	// Текст кнопки "Купить"
	"MESS_BTN_ADD_TO_BASKET" => "В корзину",	// Текст кнопки "Добавить в корзину"
	"MESS_BTN_DETAIL" => "Подробнее",	// Текст кнопки "Подробнее"
	"MESS_NOT_AVAILABLE" => "Нет в наличии",	// Сообщение об отсутствии товара
	"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
	"DETAIL_URL" => "",	// URL, ведущий на страницу с содержимым элемента раздела
	"BASKET_URL" => "/personal/cart/",	// URL, ведущий на страницу с корзиной покупателя
	"ACTION_VARIABLE" => "action",	// Название переменной, в которой передается действие
	"PRODUCT_ID_VARIABLE" => "id_slider",	// Название переменной, в которой передается код товара для покупки
	"PRODUCT_QUANTITY_VARIABLE" => "quantity",	// Название переменной, в которой передается количество товара
	"PRODUCT_PROPS_VARIABLE" => "prop",	// Название переменной, в которой передаются характеристики товара
	"SECTION_ID_VARIABLE" => "SECTION_ID",	// Название переменной, в которой передается код группы
	"CACHE_TYPE" => "A",	// Тип кеширования
	"CACHE_TIME" => "180",	// Время кеширования (сек.)
	"CACHE_GROUPS" => "Y",	// Учитывать права доступа
	"DISPLAY_COMPARE" => "N",	// Выводить кнопку сравнения
	"PRICE_CODE" => array(	// Тип цены
		0 => "BASE",
	),
	"USE_PRICE_COUNT" => "N",	// Использовать вывод цен с диапазонами
	"SHOW_PRICE_COUNT" => "1",	// Выводить цены для количества
	"PRICE_VAT_INCLUDE" => "Y",	// Включать НДС в цену
	"PRODUCT_PROPERTIES" => "",	// Характеристики товара
	"USE_PRODUCT_QUANTITY" => "Y",	// Разрешить указание количества товара
	"CONVERT_CURRENCY" => "N",	// Показывать цены в одной валюте
	"OFFERS_CART_PROPERTIES" => array(
		0 => "ARTNUMBER",
		1 => "COLOR_REF",
		2 => "SIZES_SHOES",
		3 => "SIZES_CLOTHES",
	)
	),
	false
);
?>

<!-- Предложение шубы по индивидуальным меркам -->
<div class="sections sections-transparent">
    <div class="row">
        <?$APPLICATION->IncludeFile(SITE_DIR."include/offer.php", Array(), Array("MODE" => "html", "NAME" => GetMessage("OFFER"),));?>
    </div>
</div>

<br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>