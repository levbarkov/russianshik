<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Пошив на заказ");
?>
<!-- пошив на заказ -->
<section >
    <div class="row">
        <div class="col-xs-12">
            <h1 class="tailoring__title">Пошив изделий на заказ</h1>
        </div>
    </div>
</section>

<section >
    <div class="row">
        <div class="col-xs-9 tailoring">
            <?$APPLICATION->IncludeFile(SITE_DIR."include/custom_tailoring_maintext.php", Array(), Array("MODE" => "html", "NAME" => 'Основной текст страницы',));?>
			<div class="col-xs-12 our-team">
				<div class="row">
					<?$APPLICATION->IncludeFile(SITE_DIR."include/custom_tailoring_team.php", Array(), Array("MODE" => "html", "NAME" => 'Наша команда',));?>
				</div>
            </div>
        </div>
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
    </div>
</section>
	
<!-- пошив на заказ конец -->

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