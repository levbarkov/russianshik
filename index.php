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


<h2>������ ���������</h2>
<?$APPLICATION->IncludeComponent("bitrix:catalog.top", "shik", Array(
	"IBLOCK_TYPE_ID" => "catalog",
	"IBLOCK_ID" => "2",	// ��������
	"ELEMENT_SORT_FIELD" => "name",	// �� ������ ���� ��������� ��������
	"ELEMENT_SORT_ORDER" => "asc",	// ������� ���������� ���������
	"ELEMENT_SORT_FIELD2" => "name",	// ���� ��� ������ ���������� ���������
	"ELEMENT_SORT_ORDER2" => "asc",	// ������� ������ ���������� ���������
	"HIDE_NOT_AVAILABLE" => "N",	// �� ���������� ������, ������� ��� �� �������
	"ELEMENT_COUNT" => "8",	// ���������� ��������� ���������
	"LINE_ELEMENT_COUNT" => "4",	// ���������� ��������� ��������� � ����� ������ �������
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
	"ROTATE_TIMER" => "30",	// ����� ������ ������ ������, ��� (0 - ��������� �������������� ����� �������)
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

<!-- ����������� ���� �� �������������� ������ -->
<div class="sections sections-transparent">
    <div class="row">
        <?$APPLICATION->IncludeFile(SITE_DIR."include/offer.php", Array(), Array("MODE" => "html", "NAME" => GetMessage("OFFER"),));?>
    </div>
</div>

<br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>