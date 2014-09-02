<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Интернет-магазин \"Русский Шик\"");
?>

<!-- слайдер -->
<section class="slider">
<?$APPLICATION->IncludeComponent("shik:banners", "slider", Array(
	"BLOCK_ID" => "3",	// ID инфоблока
	"DETAIL_URL" => "",	// Путь к странице просмотра записи
	),
	false
);?>
</section>
<!-- слайдер конец -->

<!-- банеры -->
<?$APPLICATION->IncludeComponent("shik:banners", "banners", Array(
	"BLOCK_ID" => "4",	// ID инфоблока
	"DETAIL_URL" => "",	// Путь к странице просмотра записи
	),
	false
);?>
<!-- банеры конец -->

<!-- популярные предложения + советы портного-->
<section class="section-popular">
	<div class="row">
		<!-- популярные предложения -->
		<div class="col-xs-9 popular">
	 <?
 $APPLICATION->IncludeComponent(
	"shik:popular",
	"all_sections",
	Array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "2",
		"COUNT_ELEMENTS" => "Y",
		"TOP_DEPTH" => "1",
		"SECTION_FIELDS" => array(),
		"SECTION_USER_FIELDS" => array(),
		"ADD_SECTIONS_CHAIN" => "Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_NOTES" => "",
		"CACHE_GROUPS" => "Y",
		"PRICE_CODE" => "BASE",
		"USE_PRICE_COUNT" => "Y",
	)
);
?>

<?

// $APPLICATION->IncludeComponent("shik:catalog.top", "template1", Array(
	// "IBLOCK_TYPE" => "catalog",	// Тип инфоблока
	// "IBLOCK_ID" => "2",	// Инфоблок
	// "VIEW_MODE" => "SLIDER",	// Показ элементов
	// "TEMPLATE_THEME" => "site",	// Цветовая тема
	// "PRODUCT_DISPLAY_MODE" => "Y",
	// "ADD_PICT_PROP" => "MORE_PHOTO",	// Дополнительная картинка основного товара
	// "LABEL_PROP" => "NEWPRODUCT",	// Свойство меток товара
	// "OFFER_ADD_PICT_PROP" => "MORE_PHOTO",
	// "OFFER_TREE_PROPS" => array(
		// 0 => "COLOR_REF",
		// 1 => "SIZES_SHOES",
		// 2 => "SIZES_CLOTHES",
	// ),
	// "SHOW_DISCOUNT_PERCENT" => "Y",	// Показывать процент скидки
	// "SHOW_OLD_PRICE" => "Y",	// Показывать старую цену
	// "MESS_BTN_BUY" => "Купить",	// Текст кнопки "Купить"
	// "MESS_BTN_ADD_TO_BASKET" => "Добавить в корзину",	// Текст кнопки "Добавить в корзину"
	// "MESS_BTN_DETAIL" => "Подробнее",	// Текст кнопки "Подробнее"
	// "MESS_NOT_AVAILABLE" => "Товара нет",	// Сообщение об отсутствии товара
	// "ELEMENT_SORT_FIELD" => "sort",	// По какому полю сортируем элементы
	// "ELEMENT_SORT_ORDER" => "asc",	// Порядок сортировки элементов
	// "ELEMENT_SORT_FIELD2" => "name",	// Поле для второй сортировки элементов
	// "ELEMENT_SORT_ORDER2" => "asc",	// Порядок второй сортировки элементов
	// "SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
	// "DETAIL_URL" => "",	// URL, ведущий на страницу с содержимым элемента раздела
	// "BASKET_URL" => "/personal/cart/",	// URL, ведущий на страницу с корзиной покупателя
	// "ACTION_VARIABLE" => "action",	// Название переменной, в которой передается действие
	// "PRODUCT_ID_VARIABLE" => "id_section",	// Название переменной, в которой передается код товара для покупки
	// "PRODUCT_QUANTITY_VARIABLE" => "quantity",	// Название переменной, в которой передается количество товара
	// "PRODUCT_PROPS_VARIABLE" => "prop",	// Название переменной, в которой передаются характеристики товара
	// "SECTION_ID_VARIABLE" => "SECTION_ID",	// Название переменной, в которой передается код группы
	// "DISPLAY_COMPARE" => "N",	// Выводить кнопку сравнения
	// "ELEMENT_COUNT" => "12",	// Количество выводимых элементов
	// "LINE_ELEMENT_COUNT" => "4",	// Количество элементов выводимых в одной строке таблицы
	// "PROPERTY_CODE" => array(	// Свойства
		// 0 => "MINIMUM_PRICE",
		// 1 => "MAXIMUM_PRICE",
	// ),
	// "OFFERS_FIELD_CODE" => array(
		// 0 => "NAME",
	// ),
	// "OFFERS_PROPERTY_CODE" => array(
		// 0 => "ARTNUMBER",
		// 1 => "COLOR_REF",
		// 2 => "SIZES_SHOES",
		// 3 => "SIZES_CLOTHES",
		// 4 => "MORE_PHOTO",
	// ),
	// "OFFERS_SORT_FIELD" => "sort",
	// "OFFERS_SORT_ORDER" => "asc",
	// "OFFERS_SORT_FIELD2" => "id",
	// "OFFERS_SORT_ORDER2" => "desc",
	// "OFFERS_LIMIT" => "0",	// Максимальное количество предложений для показа (0 - все)
	// "PRICE_CODE" => array(	// Тип цены
		// 0 => "BASE",
	// ),
	// "USE_PRICE_COUNT" => "N",	// Использовать вывод цен с диапазонами
	// "SHOW_PRICE_COUNT" => "1",	// Выводить цены для количества
	// "PRICE_VAT_INCLUDE" => "Y",	// Включать НДС в цену
	// "PRODUCT_PROPERTIES" => "",	// Характеристики товара
	// "USE_PRODUCT_QUANTITY" => "Y",	// Разрешить указание количества товара
	// "CACHE_TYPE" => "A",	// Тип кеширования
	// "CACHE_TIME" => "180",	// Время кеширования (сек.)
	// "CACHE_GROUPS" => "Y",	// Учитывать права доступа
	// "HIDE_NOT_AVAILABLE" => "N",	// Не отображать товары, которых нет на складах
	// "CONVERT_CURRENCY" => "N",	// Показывать цены в одной валюте
	// "OFFERS_CART_PROPERTIES" => array(
		// 0 => "ARTNUMBER",
		// 1 => "COLOR_REF",
		// 2 => "SIZES_SHOES",
		// 3 => "SIZES_CLOTHES",
	// )
	// ),
	// false,
	// array(
	// "ACTIVE_COMPONENT" => "N"
	// )
// );
?>
		</div>
		<!-- популярные предложения конец -->
		
		<!-- советы портного -->
		<div class="col-xs-3 tips">
<?
$APPLICATION->IncludeComponent("bitrix:news.list", "shik_mainpage", Array(
	"IBLOCK_TYPE" => "content",	// Тип информационного блока (используется только для проверки)
	"IBLOCK_ID" => "7",	// Код информационного блока
	"NEWS_COUNT" => "3",	// Количество новостей на странице
	"SORT_BY1" => "ACTIVE_FROM",	// Поле для первой сортировки новостей
	"SORT_ORDER1" => "DESC",	// Направление для первой сортировки новостей
	"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
	"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
	"FILTER_NAME" => "",	// Фильтр
	"FIELD_CODE" => array(	// Поля
		0 => "",
		1 => "",
	),
	"PROPERTY_CODE" => array(	// Свойства
		0 => "",
		1 => "",
	),
	"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
	"DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
	"AJAX_MODE" => "N",	// Включить режим AJAX
	"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
	"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
	"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
	"CACHE_TYPE" => "A",	// Тип кеширования
	"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
	"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
	"CACHE_GROUPS" => "N",	// Учитывать права доступа
	"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
	"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
	"SET_TITLE" => "N",	// Устанавливать заголовок страницы
	"SET_STATUS_404" => "N",	// Устанавливать статус 404, если не найдены элемент или раздел
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
	"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
	"PARENT_SECTION" => "",	// ID раздела
	"PARENT_SECTION_CODE" => "",	// Код раздела
	"INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
	"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
	"DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
	"PAGER_TITLE" => "Ќовости",	// Название категорий
	"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
	"PAGER_TEMPLATE" => "",	// Шаблон постраничной навигации
	"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
	"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
	"DISPLAY_DATE" => "Y",	// Выводить дату элемента
	"DISPLAY_NAME" => "Y",	// Выводить название элемента
	"DISPLAY_PICTURE" => "N",	// Выводить изображение для анонса
	"DISPLAY_PREVIEW_TEXT" => "N",	// Выводить текст анонса
	"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
	),
	false
);
?>
		</div>
		<!-- советы портного конец -->

	</div>
</section>
<!-- популярные предложения + советы портного-->

</div>
<!-- заголовок и основная часть конец-->

<!-- предложение шубы по индивидуальным меркам -->
<div class="sections sections-transparent">
    <div class="row">
        <?$APPLICATION->IncludeFile(SITE_DIR."include/offer.php", Array(), Array("MODE" => "html", "NAME" => GetMessage("OFFER"),));?>
    </div>
</div>
<!-- предложение шубы по индивидуальным меркам конец -->

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>