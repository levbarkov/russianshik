<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Ремонт одежды");
$APPLICATION->SetTitle("Ремонт одежды");
?>

<section class="repair">
        <div class="row">
            <div class="col-xs-12 repair__title">
                <h1 class="repair__title">Ремонт меховых изделий</h1>
            </div>
            <div class="col-xs-9 repair__wrapper">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="col-xs-4">
                            <span class="repair__list-icon">
                            <span class="repair__list-icon-hover"></span></span>
                            <h2 class="repair__list-title">Мелкий ремонт</h2>
                            <ul class="repair__list">
                                <li class="repair__list-item">Замена пуговиц</li>
                                <li class="repair__list-item">Замена молний</li>
                                <li class="repair__list-item">Замена подкладки</li>
                            </ul>
                            <a class="repair__list-link" href="#">Весь перечень</a>
                        </div>
                        <div class="col-xs-4">
                            <span class="repair__list-icon-reshaping">
                            <span class="repair__list-icon-reshaping-hover"></span></span>

                            <h2 class="repair__list-title">Перекрой изделия</h2>
                            <ul class="repair__list">
                                <li class="repair__list-item">Подгонка по фигуре</li>
                                <li class="repair__list-item">Укоротить изделие</li>
                                <li class="repair__list-item">Укоротить рукава</li>
                            </ul>
                            <a class="repair__list-link" href="#">Весь перечень</a>
                        </div>
                        <div class="col-xs-4">
                            <span class="repair__list-icon-restoration">
                            <span class="repair__list-icon-restoration-hover"></span></span>

                            <h2 class="repair__list-title">Реставрация</h2>
                            <ul class="repair__list">
                                <li class="repair__list-item">Ремонт разрывов</li>
                                <li class="repair__list-item">Устранение потертостей</li>
                                <li class="repair__list-item">Химчистка после моли</li>
                            </ul>
                            <a class="repair__list-link" href="#">Весь перечень</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 btn-block">
                <a class="btn btn-default repair__download-btn" href="#">Скачать прейскурант цен на ремонт изделий</a>
            </div>
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-12">
                        <h1 class="repair__order-title">Порядок работы по ремонту мехового изделия</h1>
                    </div>
                    <div class="col-xs-3 repair__order-item">

                        <div class="repair__order-icon-wrapper">
                        <div class="repair__order-icon">
                           <span class="repair__order-icon-receiving"> </span>
                        </div>

                        </div>
                        <p class="repair__order-icon-text">Прием изделия</p>
                    </div>
                    <div class="col-xs-3 repair__order-item">
                        <div class="repair__order-icon-wrapper">
                        <div class="repair__order-icon">
                           <span class="repair__order-icon-money"> </span>
                        </div>

                        </div>
                        <p class="repair__order-icon-text">Оценивание работ по
                            <a class="repair__order-icon-link" href="#">прайсу</a></p>
                    </div>
                    <div class="col-xs-3 repair__order-item">
                        <div class="repair__order-icon-wrapper">
                            <div class="repair__order-icon">
                                <span class="repair__order-icon-calendar"> </span>
                            </div>

                        </div>
                        <p class="repair__order-icon-text">Ремонтные работы до двух недель</p>
                    </div>
                    <div class="col-xs-3 repair__order-item">
                        <div class="repair__order-icon-wrapper">
                            <div class="repair__order-icon">
                                <span class="repair__order-icon-surrender"> </span>
                            </div>

                        </div>
                        <span class="repair__order-icon-text">Сдача работы</span>
                    </div>


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

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>