<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$filterView = (COption::GetOptionString("main", "wizard_template_id", "eshop_adapt_horizontal", SITE_ID) == "eshop_adapt_vertical" ? "HORIZONTAL" : "VERTICAL");
?>

<?$APPLICATION->IncludeComponent("bitrix:catalog", "shik", Array(
	"IBLOCK_TYPE" => "catalog",	// Тип инфоблока
	"IBLOCK_ID" => "2",	// Инфоблок
	"HIDE_NOT_AVAILABLE" => "N",	// Не отображать товары, которых нет на складах
	"SECTION_ID_VARIABLE" => "SECTION_ID",	// Название переменной, в которой передается код группы
	"SEF_MODE" => "Y",	// Включить поддержку ЧПУ
	"SEF_FOLDER" => "/catalog/",	// Каталог ЧПУ (относительно корня сайта)
	"AJAX_MODE" => "N",	// Включить режим AJAX
	"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
	"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
	"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
	"CACHE_TYPE" => "A",	// Тип кеширования
	"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
	"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
	"CACHE_GROUPS" => "Y",	// Учитывать права доступа
	"SET_STATUS_404" => "Y",	// Устанавливать статус 404, если не найдены элемент или раздел
	"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
	"ADD_SECTIONS_CHAIN" => "Y",
	"ADD_ELEMENT_CHAIN" => "Y",	// Включать название элемента в цепочку навигации
	"USE_ELEMENT_COUNTER" => "Y",	// Использовать счетчик просмотров
	"USE_FILTER" => "Y",	// Показывать фильтр
	"FILTER_NAME" => "",	// Фильтр
	"FILTER_FIELD_CODE" => array(	// Поля
		0 => "",
		1 => "",
	),
	"FILTER_PROPERTY_CODE" => array(	// Свойства
		0 => "",
		1 => "",
	),
	"FILTER_PRICE_CODE" => array(	// Тип цены
		0 => "BASE",
	),
	"FILTER_VIEW_MODE" => "VERTICAL",	// Вид отображения умного фильтра
	"USE_REVIEW" => "Y",	// Разрешить отзывы
	"MESSAGES_PER_PAGE" => "10",	// Количество сообщений на одной странице
	"USE_CAPTCHA" => "Y",	// Использовать CAPTCHA
	"REVIEW_AJAX_POST" => "Y",	// Использовать AJAX в диалогах
	"PATH_TO_SMILE" => "/bitrix/images/forum/smile/",	// Путь относительно корня сайта к папке со смайлами
	"FORUM_ID" => "1",	// ID форума для отзывов
	"URL_TEMPLATES_READ" => "",	// Страница чтения темы (пусто - получить из настроек форума)
	"SHOW_LINK_TO_FORUM" => "Y",	// Показать ссылку на форум
	"POST_FIRST_MESSAGE" => "N",	// Начинать тему текстом элемента
	"USE_COMPARE" => "N",	// Использовать компонент сравнения
	"PRICE_CODE" => array(	// Тип цены
		0 => "BASE",
	),
	"USE_PRICE_COUNT" => "Y",	// Использовать вывод цен с диапазонами
	"SHOW_PRICE_COUNT" => "1",	// Выводить цены для количества
	"PRICE_VAT_INCLUDE" => "Y",	// Включать НДС в цену
	"PRICE_VAT_SHOW_VALUE" => "N",	// Отображать значение НДС
	"CONVERT_CURRENCY" => "Y",	// Показывать цены в одной валюте
	"CURRENCY_ID" => "RUB",	// Валюта, в которую будут сконвертированы цены
	"BASKET_URL" => "/personal/cart/",	// URL, ведущий на страницу с корзиной покупателя
	"ACTION_VARIABLE" => "action",	// Название переменной, в которой передается действие
	"PRODUCT_ID_VARIABLE" => "id",	// Название переменной, в которой передается код товара для покупки
	"USE_PRODUCT_QUANTITY" => "Y",	// Разрешить указание количества товара
	"PRODUCT_QUANTITY_VARIABLE" => "quantity",	// Название переменной, в которой передается количество товара
	"ADD_PROPERTIES_TO_BASKET" => "Y",	// Добавлять в корзину свойства товаров и предложений
	"PRODUCT_PROPS_VARIABLE" => "prop",	// Название переменной, в которой передаются характеристики товара
	"PARTIAL_PRODUCT_PROPERTIES" => "N",	// Разрешить добавлять в корзину товары, у которых заполнены не все характеристики
	"PRODUCT_PROPERTIES" => "",	// Характеристики товара, добавляемые в корзину
	"SHOW_TOP_ELEMENTS" => "N",	// Выводить топ элементов
	"SECTION_COUNT_ELEMENTS" => "N",	// Показывать количество элементов в разделе
	"SECTION_TOP_DEPTH" => "1",	// Максимальная отображаемая глубина разделов
	"SECTIONS_VIEW_MODE" => "TEXT",	// Вид списка подразделов
	"SECTIONS_SHOW_PARENT_NAME" => "N",	// Показывать название раздела
	"PAGE_ELEMENT_COUNT" => "15",	// Количество элементов на странице
	"LINE_ELEMENT_COUNT" => "3",	// Количество элементов, выводимых в одной строке таблицы
	"ELEMENT_SORT_FIELD" => "sort",	// По какому полю сортируем товары в разделе
	"ELEMENT_SORT_ORDER" => "asc",	// Порядок сортировки товаров в разделе
	"ELEMENT_SORT_FIELD2" => "id",	// Поле для второй сортировки товаров в разделе
	"ELEMENT_SORT_ORDER2" => "desc",	// Порядок второй сортировки товаров в разделе
	"LIST_PROPERTY_CODE" => array(	// Свойства
		0 => "",
		1 => "NEWPRODUCT",
		2 => "SALELEADER",
		3 => "SPECIALOFFER",
		4 => "",
	),
	"INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
	"LIST_META_KEYWORDS" => "UF_KEYWORDS",	// Установить ключевые слова страницы из свойства раздела
	"LIST_META_DESCRIPTION" => "UF_META_DESCRIPTION",	// Установить описание страницы из свойства раздела
	"LIST_BROWSER_TITLE" => "UF_BROWSER_TITLE",	// Установить заголовок окна браузера из свойства раздела
	"DETAIL_PROPERTY_CODE" => array(	// Свойства
		0 => "OLD_PRICE",
		1 => "SIZE",
		2 => "ARTICLE",
		3 => "COLOR",
		4 => "MATERIAL",
		5 => "MANUFACTURING",
		6 => "NEWPRODUCT",
		7 => "MANUFACTURER",
		8 => "",
	),
	"DETAIL_META_KEYWORDS" => "-",	// Установить ключевые слова страницы из свойства
	"DETAIL_META_DESCRIPTION" => "-",	// Установить описание страницы из свойства
	"DETAIL_BROWSER_TITLE" => "-",	// Установить заголовок окна браузера из свойства
	"DETAIL_DISPLAY_NAME" => "N",	// Выводить название элемента
	"DETAIL_DETAIL_PICTURE_MODE" => "IMG",	// Режим показа детальной картинки
	"DETAIL_ADD_DETAIL_TO_SLIDER" => "N",	// Добавлять детальную картинку в слайдер
	"DETAIL_DISPLAY_PREVIEW_TEXT_MODE" => "E",	// Показ описания для анонса на детальной странице
	"LINK_IBLOCK_TYPE" => "",	// Тип инфоблока, элементы которого связаны с текущим элементом
	"LINK_IBLOCK_ID" => "",	// ID инфоблока, элементы которого связаны с текущим элементом
	"LINK_PROPERTY_SID" => "",	// Свойство, в котором хранится связь
	"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",	// URL на страницу, где будет показан список связанных элементов
	"USE_ALSO_BUY" => "Y",	// Показывать блок "С этим товаром покупают"
	"ALSO_BUY_ELEMENT_COUNT" => "4",	// Количество элементов для отображения
	"ALSO_BUY_MIN_BUYES" => "1",	// Минимальное количество покупок товара
	"USE_STORE" => "Y",	// Показывать блок "Количество товара на складе"
	"USE_STORE_PHONE" => "Y",	// Выводить телефон
	"USE_STORE_SCHEDULE" => "Y",	// Выводить график работы
	"USE_MIN_AMOUNT" => "N",	// Подменять числа на выражения
	"STORE_PATH" => "/store/#store_id#",	// Шаблон пути к каталогу STORE (относительно корня)
	"MAIN_TITLE" => "Наличие на складах",	// Заголовок блока
	"PAGER_TEMPLATE" => "arrows",	// Шаблон постраничной навигации
	"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
	"DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
	"PAGER_TITLE" => "Товары",	// Название категорий
	"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
	"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000000",	// Время кеширования страниц для обратной навигации
	"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
	"TEMPLATE_THEME" => "site",	// Цветовая тема
	"ADD_PICT_PROP" => "MORE_PHOTO",	// Дополнительная картинка основного товара
	"LABEL_PROP" => "-",	// Свойство меток товара
	"SHOW_DISCOUNT_PERCENT" => "Y",	// Показывать процент скидки
	"SHOW_OLD_PRICE" => "Y",	// Показывать старую цену
	"DETAIL_SHOW_MAX_QUANTITY" => "N",	// Показывать общее количество товара
	"MESS_BTN_BUY" => "Купить",	// Текст кнопки "Купить"
	"MESS_BTN_ADD_TO_BASKET" => "В корзину",	// Текст кнопки "Добавить в корзину"
	"MESS_BTN_COMPARE" => "Сравнение",	// Текст кнопки "Сравнение"
	"MESS_BTN_DETAIL" => "Подробнее",	// Текст кнопки "Подробнее"
	"MESS_NOT_AVAILABLE" => "Нет в наличии",	// Сообщение об отсутствии товара
	"DETAIL_USE_VOTE_RATING" => "Y",	// Включить рейтинг товара
	"DETAIL_VOTE_DISPLAY_AS_RATING" => "rating",	// В качестве рейтинга показывать
	"DETAIL_USE_COMMENTS" => "N",	// Включить отзывы о товаре
	"DETAIL_BRAND_USE" => "Y",	// Использовать компонент "Бренды"
	"DETAIL_BRAND_PROP_CODE" => "-",	// Таблица с брендами
	"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
	"SEF_URL_TEMPLATES" => array(
		"sections" => "",
		"section" => "#SECTION_CODE#/",
		"element" => "#SECTION_CODE#/#ELEMENT_CODE#/",
		"compare" => "compare/",
	)
	),
	false
);?>

</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>