<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("��������-������� \"������\"");
?>

<?$APPLICATION->IncludeComponent("shik:banners", "slider", Array(
	"BLOCK_ID" => "3",	// ID ���������
	"DETAIL_URL" => "",	// ���� � �������� ��������� ������
	),
	false
);?>

<?$APPLICATION->IncludeComponent("shik:banners", "banners", Array(
	"BLOCK_ID" => "4",	// ID ���������
	"DETAIL_URL" => "",	// ���� � �������� ��������� ������
	),
	false
);?>

 <?
 // $APPLICATION->IncludeComponent(
	// "shik:catalog.section.list",
	// "all_sections",
	// Array(
		// "IBLOCK_TYPE" => "catalog",
		// "IBLOCK_ID1" => "2",
		// "COUNT_ELEMENTS" => "Y",
		// "TOP_DEPTH" => "1",
		// "SECTION_FIELDS" => array(),
		// "SECTION_USER_FIELDS" => array(),
		// "ADD_SECTIONS_CHAIN" => "Y",
		// "CACHE_TYPE" => "A",
		// "CACHE_TIME" => "36000000",
		// "CACHE_NOTES" => "",
		// "CACHE_GROUPS" => "Y"
	// )
// );
?>

<section class="section-popular">
	<div class="row">
		<div class="col-xs-9 popular">
			<div class="popular__controls">
                <h3 class="popular__title">���������� ������</h3>
                <button class="btn btn-default popular__controls-btn active" data-filter=".category-1">�������
                    ���������
                </button>
                <button class="btn btn-default popular__controls-btn" data-filter=".category-2">����������</button>
                <button class="btn btn-default popular__controls-btn" data-filter=".category-3">������� ������</button>
            </div>
			<div class="popular__list">
<?$APPLICATION->IncludeComponent("bitrix:catalog.top", "shik", Array(
	"IBLOCK_TYPE_ID" => "catalog",
	"IBLOCK_ID" => "2",	// ��������
	"ELEMENT_SORT_FIELD" => "name",	// �� ������ ���� ��������� ��������
	"ELEMENT_SORT_ORDER" => "asc",	// ������� ���������� ���������
	"ELEMENT_SORT_FIELD2" => "name",	// ���� ��� ������ ���������� ���������
	"ELEMENT_SORT_ORDER2" => "asc",	// ������� ������ ���������� ���������
	"HIDE_NOT_AVAILABLE" => "N",	// �� ���������� ������, ������� ��� �� �������
	"ELEMENT_COUNT" => "6",	// ���������� ��������� ���������
	"LINE_ELEMENT_COUNT" => "3",	// ���������� ��������� ��������� � ����� ������ �������
	"PROPERTY_CODE" => array(	// ��������
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
	"OFFERS_LIMIT" => "0",	// ������������ ���������� ����������� ��� ������ (0 - ���)
	"VIEW_MODE" => "SLIDER",	// ����� ���������
	"TEMPLATE_THEME" => "site",	// �������� ����
	"PRODUCT_DISPLAY_MODE" => "Y",
	"ADD_PICT_PROP" => "MORE_PHOTO",	// �������������� �������� ��������� ������
	"LABEL_PROP" => "NEWPRODUCT",	// �������� ����� ������
	"OFFER_ADD_PICT_PROP" => "MORE_PHOTO",
	"OFFER_TREE_PROPS" => array(
		0 => "COLOR_REF",
		1 => "SIZES_SHOES",
		2 => "SIZES_CLOTHES",
	),
	"SHOW_DISCOUNT_PERCENT" => "Y",	// ���������� ������� ������
	"SHOW_OLD_PRICE" => "Y",	// ���������� ������ ����
	"ROTATE_TIMER" => "0",	// ����� ������ ������ ������, ��� (0 - ��������� �������������� ����� �������)
	"MESS_BTN_BUY" => "������",	// ����� ������ "������"
	"MESS_BTN_ADD_TO_BASKET" => "� �������",	// ����� ������ "�������� � �������"
	"MESS_BTN_DETAIL" => "���������",	// ����� ������ "���������"
	"MESS_NOT_AVAILABLE" => "��� � �������",	// ��������� �� ���������� ������
	"SECTION_URL" => "",	// URL, ������� �� �������� � ���������� �������
	"DETAIL_URL" => "",	// URL, ������� �� �������� � ���������� �������� �������
	"BASKET_URL" => "/personal/cart/",	// URL, ������� �� �������� � �������� ����������
	"ACTION_VARIABLE" => "action",	// �������� ����������, � ������� ���������� ��������
	"PRODUCT_ID_VARIABLE" => "id_slider",	// �������� ����������, � ������� ���������� ��� ������ ��� �������
	"PRODUCT_QUANTITY_VARIABLE" => "quantity",	// �������� ����������, � ������� ���������� ���������� ������
	"PRODUCT_PROPS_VARIABLE" => "prop",	// �������� ����������, � ������� ���������� �������������� ������
	"SECTION_ID_VARIABLE" => "SECTION_ID",	// �������� ����������, � ������� ���������� ��� ������
	"CACHE_TYPE" => "A",	// ��� �����������
	"CACHE_TIME" => "180",	// ����� ����������� (���.)
	"CACHE_GROUPS" => "Y",	// ��������� ����� �������
	"DISPLAY_COMPARE" => "N",	// �������� ������ ���������
	"PRICE_CODE" => array(	// ��� ����
		0 => "BASE",
	),
	"USE_PRICE_COUNT" => "N",	// ������������ ����� ��� � �����������
	"SHOW_PRICE_COUNT" => "1",	// �������� ���� ��� ����������
	"PRICE_VAT_INCLUDE" => "Y",	// �������� ��� � ����
	"PRODUCT_PROPERTIES" => "",	// �������������� ������
	"USE_PRODUCT_QUANTITY" => "Y",	// ��������� �������� ���������� ������
	"CONVERT_CURRENCY" => "N",	// ���������� ���� � ����� ������
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
			</div>
		</div>
		<div class="col-xs-3 tips">
<?$APPLICATION->IncludeComponent("bitrix:news.list", "shik_mainpage", Array(
	"IBLOCK_TYPE" => "content",	// ��� ��������������� ����� (������������ ������ ��� ��������)
	"IBLOCK_ID" => "7",	// ��� ��������������� �����
	"NEWS_COUNT" => "3",	// ���������� �������� �� ��������
	"SORT_BY1" => "ACTIVE_FROM",	// ���� ��� ������ ���������� ��������
	"SORT_ORDER1" => "DESC",	// ����������� ��� ������ ���������� ��������
	"SORT_BY2" => "SORT",	// ���� ��� ������ ���������� ��������
	"SORT_ORDER2" => "ASC",	// ����������� ��� ������ ���������� ��������
	"FILTER_NAME" => "",	// ������
	"FIELD_CODE" => array(	// ����
		0 => "",
		1 => "",
	),
	"PROPERTY_CODE" => array(	// ��������
		0 => "",
		1 => "",
	),
	"CHECK_DATES" => "Y",	// ���������� ������ �������� �� ������ ������ ��������
	"DETAIL_URL" => "",	// URL �������� ���������� ��������� (�� ��������� - �� �������� ���������)
	"AJAX_MODE" => "N",	// �������� ����� AJAX
	"AJAX_OPTION_JUMP" => "N",	// �������� ��������� � ������ ����������
	"AJAX_OPTION_STYLE" => "Y",	// �������� ��������� ������
	"AJAX_OPTION_HISTORY" => "N",	// �������� �������� ��������� ��������
	"CACHE_TYPE" => "A",	// ��� �����������
	"CACHE_TIME" => "36000000",	// ����� ����������� (���.)
	"CACHE_FILTER" => "N",	// ���������� ��� ������������� �������
	"CACHE_GROUPS" => "N",	// ��������� ����� �������
	"PREVIEW_TRUNCATE_LEN" => "",	// ������������ ����� ������ ��� ������ (������ ��� ���� �����)
	"ACTIVE_DATE_FORMAT" => "d.m.Y",	// ������ ������ ����
	"SET_TITLE" => "N",	// ������������� ��������� ��������
	"SET_STATUS_404" => "N",	// ������������� ������ 404, ���� �� ������� ������� ��� ������
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// �������� �������� � ������� ���������
	"ADD_SECTIONS_CHAIN" => "N",	// �������� ������ � ������� ���������
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// �������� ������, ���� ��� ���������� ��������
	"PARENT_SECTION" => "",	// ID �������
	"PARENT_SECTION_CODE" => "",	// ��� �������
	"INCLUDE_SUBSECTIONS" => "Y",	// ���������� �������� ����������� �������
	"DISPLAY_TOP_PAGER" => "N",	// �������� ��� �������
	"DISPLAY_BOTTOM_PAGER" => "N",	// �������� ��� �������
	"PAGER_TITLE" => "�������",	// �������� ���������
	"PAGER_SHOW_ALWAYS" => "N",	// �������� ������
	"PAGER_TEMPLATE" => "",	// ������ ������������ ���������
	"PAGER_DESC_NUMBERING" => "N",	// ������������ �������� ���������
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// ����� ����������� ������� ��� �������� ���������
	"PAGER_SHOW_ALL" => "N",	// ���������� ������ "���"
	"DISPLAY_DATE" => "Y",	// �������� ���� ��������
	"DISPLAY_NAME" => "Y",	// �������� �������� ��������
	"DISPLAY_PICTURE" => "N",	// �������� ����������� ��� ������
	"DISPLAY_PREVIEW_TEXT" => "N",	// �������� ����� ������
	"AJAX_OPTION_ADDITIONAL" => "",	// �������������� �������������
	),
	false
);?>
        </div>

<!-- ����������� ���� �� �������������� ������ -->
<div class="sections sections-transparent">
    <div class="row">
        <?$APPLICATION->IncludeFile(SITE_DIR."include/offer.php", Array(), Array("MODE" => "html", "NAME" => GetMessage("OFFER"),));?>
    </div>
</div>

<br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>