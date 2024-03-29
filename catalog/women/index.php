<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?>

<?$APPLICATION->IncludeComponent("bitrix:catalog", "shik", Array(
	"IBLOCK_TYPE" => "catalog",	// ��� ���������
	"IBLOCK_ID" => "2",	// ��������
	"HIDE_NOT_AVAILABLE" => "N",	// �� ���������� ������, ������� ��� �� �������
	"SECTION_ID_VARIABLE" => "SECTION_ID",	// �������� ����������, � ������� ���������� ��� ������
	"SEF_MODE" => "Y",	// �������� ��������� ���
	"SEF_FOLDER" => "/catalog/",	// ������� ��� (������������ ����� �����)
	"AJAX_MODE" => "N",	// �������� ����� AJAX
	"AJAX_OPTION_JUMP" => "N",	// �������� ��������� � ������ ����������
	"AJAX_OPTION_STYLE" => "Y",	// �������� ��������� ������
	"AJAX_OPTION_HISTORY" => "N",	// �������� �������� ��������� ��������
	"CACHE_TYPE" => "A",	// ��� �����������
	"CACHE_TIME" => "36000000",	// ����� ����������� (���.)
	"CACHE_FILTER" => "N",	// ���������� ��� ������������� �������
	"CACHE_GROUPS" => "Y",	// ��������� ����� �������
	"SET_STATUS_404" => "Y",	// ������������� ������ 404, ���� �� ������� ������� ��� ������
	"SET_TITLE" => "Y",	// ������������� ��������� ��������
	"ADD_SECTIONS_CHAIN" => "Y",
	"ADD_ELEMENT_CHAIN" => "Y",	// �������� �������� �������� � ������� ���������
	"USE_ELEMENT_COUNTER" => "Y",	// ������������ ������� ����������
	"USE_FILTER" => "Y",	// ���������� ������
	"FILTER_NAME" => "",	// ������
	"FILTER_FIELD_CODE" => array(	// ����
		0 => "",
		1 => "",
	),
	"FILTER_PROPERTY_CODE" => array(	// ��������
		0 => "",
		1 => "",
	),
	"FILTER_PRICE_CODE" => array(	// ��� ����
		0 => "BASE",
	),
	"FILTER_VIEW_MODE" => "VERTICAL",	// ��� ����������� ������ �������
	"USE_REVIEW" => "Y",	// ��������� ������
	"MESSAGES_PER_PAGE" => "10",	// ���������� ��������� �� ����� ��������
	"USE_CAPTCHA" => "Y",	// ������������ CAPTCHA
	"REVIEW_AJAX_POST" => "Y",	// ������������ AJAX � ��������
	"PATH_TO_SMILE" => "/bitrix/images/forum/smile/",	// ���� ������������ ����� ����� � ����� �� ��������
	"FORUM_ID" => "1",	// ID ������ ��� �������
	"URL_TEMPLATES_READ" => "",	// �������� ������ ���� (����� - �������� �� �������� ������)
	"SHOW_LINK_TO_FORUM" => "Y",	// �������� ������ �� �����
	"POST_FIRST_MESSAGE" => "N",	// �������� ���� ������� ��������
	"USE_COMPARE" => "N",	// ������������ ��������� ���������
	"PRICE_CODE" => array(	// ��� ����
		0 => "BASE",
	),
	"USE_PRICE_COUNT" => "Y",	// ������������ ����� ��� � �����������
	"SHOW_PRICE_COUNT" => "1",	// �������� ���� ��� ����������
	"PRICE_VAT_INCLUDE" => "Y",	// �������� ��� � ����
	"PRICE_VAT_SHOW_VALUE" => "N",	// ���������� �������� ���
	"CONVERT_CURRENCY" => "Y",	// ���������� ���� � ����� ������
	"CURRENCY_ID" => "RUB",	// ������, � ������� ����� ��������������� ����
	"BASKET_URL" => "/personal/cart/",	// URL, ������� �� �������� � �������� ����������
	"ACTION_VARIABLE" => "action",	// �������� ����������, � ������� ���������� ��������
	"PRODUCT_ID_VARIABLE" => "id",	// �������� ����������, � ������� ���������� ��� ������ ��� �������
	"USE_PRODUCT_QUANTITY" => "Y",	// ��������� �������� ���������� ������
	"PRODUCT_QUANTITY_VARIABLE" => "quantity",	// �������� ����������, � ������� ���������� ���������� ������
	"ADD_PROPERTIES_TO_BASKET" => "Y",	// ��������� � ������� �������� ������� � �����������
	"PRODUCT_PROPS_VARIABLE" => "prop",	// �������� ����������, � ������� ���������� �������������� ������
	"PARTIAL_PRODUCT_PROPERTIES" => "N",	// ��������� ��������� � ������� ������, � ������� ��������� �� ��� ��������������
	"PRODUCT_PROPERTIES" => "",	// �������������� ������, ����������� � �������
	"SHOW_TOP_ELEMENTS" => "N",	// �������� ��� ���������
	"SECTION_COUNT_ELEMENTS" => "N",	// ���������� ���������� ��������� � �������
	"SECTION_TOP_DEPTH" => "1",	// ������������ ������������ ������� ��������
	"SECTIONS_VIEW_MODE" => "TEXT",	// ��� ������ �����������
	"SECTIONS_SHOW_PARENT_NAME" => "N",	// ���������� �������� �������
	"PAGE_ELEMENT_COUNT" => "15",	// ���������� ��������� �� ��������
	"LINE_ELEMENT_COUNT" => "3",	// ���������� ���������, ��������� � ����� ������ �������
	"ELEMENT_SORT_FIELD" => "sort",	// �� ������ ���� ��������� ������ � �������
	"ELEMENT_SORT_ORDER" => "asc",	// ������� ���������� ������� � �������
	"ELEMENT_SORT_FIELD2" => "id",	// ���� ��� ������ ���������� ������� � �������
	"ELEMENT_SORT_ORDER2" => "desc",	// ������� ������ ���������� ������� � �������
	"LIST_PROPERTY_CODE" => array(	// ��������
		0 => "",
		1 => "NEWPRODUCT",
		2 => "SALELEADER",
		3 => "SPECIALOFFER",
		4 => "",
	),
	"INCLUDE_SUBSECTIONS" => "Y",	// ���������� �������� ����������� �������
	"LIST_META_KEYWORDS" => "UF_KEYWORDS",	// ���������� �������� ����� �������� �� �������� �������
	"LIST_META_DESCRIPTION" => "UF_META_DESCRIPTION",	// ���������� �������� �������� �� �������� �������
	"LIST_BROWSER_TITLE" => "UF_BROWSER_TITLE",	// ���������� ��������� ���� �������� �� �������� �������
	"DETAIL_PROPERTY_CODE" => array(	// ��������
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
	"DETAIL_META_KEYWORDS" => "-",	// ���������� �������� ����� �������� �� ��������
	"DETAIL_META_DESCRIPTION" => "-",	// ���������� �������� �������� �� ��������
	"DETAIL_BROWSER_TITLE" => "-",	// ���������� ��������� ���� �������� �� ��������
	"DETAIL_DISPLAY_NAME" => "N",	// �������� �������� ��������
	"DETAIL_DETAIL_PICTURE_MODE" => "IMG",	// ����� ������ ��������� ��������
	"DETAIL_ADD_DETAIL_TO_SLIDER" => "N",	// ��������� ��������� �������� � �������
	"DETAIL_DISPLAY_PREVIEW_TEXT_MODE" => "E",	// ����� �������� ��� ������ �� ��������� ��������
	"LINK_IBLOCK_TYPE" => "",	// ��� ���������, �������� �������� ������� � ������� ���������
	"LINK_IBLOCK_ID" => "",	// ID ���������, �������� �������� ������� � ������� ���������
	"LINK_PROPERTY_SID" => "",	// ��������, � ������� �������� �����
	"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",	// URL �� ��������, ��� ����� ������� ������ ��������� ���������
	"USE_ALSO_BUY" => "Y",	// ���������� ���� "� ���� ������� ��������"
	"ALSO_BUY_ELEMENT_COUNT" => "4",	// ���������� ��������� ��� �����������
	"ALSO_BUY_MIN_BUYES" => "1",	// ����������� ���������� ������� ������
	"USE_STORE" => "Y",	// ���������� ���� "���������� ������ �� ������"
	"USE_STORE_PHONE" => "Y",	// �������� �������
	"USE_STORE_SCHEDULE" => "Y",	// �������� ������ ������
	"USE_MIN_AMOUNT" => "N",	// ��������� ����� �� ���������
	"STORE_PATH" => "/store/#store_id#",	// ������ ���� � �������� STORE (������������ �����)
	"MAIN_TITLE" => "������� �� �������",	// ��������� �����
	"PAGER_TEMPLATE" => "arrows",	// ������ ������������ ���������
	"DISPLAY_TOP_PAGER" => "N",	// �������� ��� �������
	"DISPLAY_BOTTOM_PAGER" => "Y",	// �������� ��� �������
	"PAGER_TITLE" => "������",	// �������� ���������
	"PAGER_SHOW_ALWAYS" => "N",	// �������� ������
	"PAGER_DESC_NUMBERING" => "N",	// ������������ �������� ���������
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000000",	// ����� ����������� ������� ��� �������� ���������
	"PAGER_SHOW_ALL" => "N",	// ���������� ������ "���"
	"TEMPLATE_THEME" => "site",	// �������� ����
	"ADD_PICT_PROP" => "MORE_PHOTO",	// �������������� �������� ��������� ������
	"LABEL_PROP" => "-",	// �������� ����� ������
	"SHOW_DISCOUNT_PERCENT" => "Y",	// ���������� ������� ������
	"SHOW_OLD_PRICE" => "Y",	// ���������� ������ ����
	"DETAIL_SHOW_MAX_QUANTITY" => "N",	// ���������� ����� ���������� ������
	"MESS_BTN_BUY" => "������",	// ����� ������ "������"
	"MESS_BTN_ADD_TO_BASKET" => "� �������",	// ����� ������ "�������� � �������"
	"MESS_BTN_COMPARE" => "���������",	// ����� ������ "���������"
	"MESS_BTN_DETAIL" => "���������",	// ����� ������ "���������"
	"MESS_NOT_AVAILABLE" => "��� � �������",	// ��������� �� ���������� ������
	"DETAIL_USE_VOTE_RATING" => "Y",	// �������� ������� ������
	"DETAIL_VOTE_DISPLAY_AS_RATING" => "rating",	// � �������� �������� ����������
	"DETAIL_USE_COMMENTS" => "N",	// �������� ������ � ������
	"DETAIL_BRAND_USE" => "Y",	// ������������ ��������� "������"
	"DETAIL_BRAND_PROP_CODE" => "-",	// ������� � ��������
	"AJAX_OPTION_ADDITIONAL" => "",	// �������������� �������������
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