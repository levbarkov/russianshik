<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

if (!$arParams['FILTER_VIEW_MODE'])
	$arParams['FILTER_VIEW_MODE'] = 'VERTICAL';
$arParams['USE_FILTER'] = (isset($arParams['USE_FILTER']) && $arParams['USE_FILTER'] == 'Y' ? 'Y' : 'N');
$verticalGrid = ('Y' == $arParams['USE_FILTER'] && $arParams["FILTER_VIEW_MODE"] == "VERTICAL");
?>

<!-- ������� ������� -->	
<section class="catalog" ng-app="app">
<div class="row">

<div class="col-xs-12">
    <h1 class="catalog__title"><?=$arResult['SECTION']['NAME'];?></h1>
</div>
<div class="col-xs-3 ">
    

    <!-- ����� ������ -->
		<?
			$APPLICATION->IncludeComponent(
			"shik:catalog.smart.filter",
			"shik",
			Array(
				"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
				"IBLOCK_ID" => $arParams["IBLOCK_ID"],
				"IBLOCK_SECTION_ID" => $arResult['SECTION']['ID'],
				"SECTION_ID" => $arCurSection['ID'],
				"FILTER_NAME" => $arParams["FILTER_NAME"],
				"PRICE_CODE" => $arParams["PRICE_CODE"],
				"CACHE_TYPE" => $arParams["CACHE_TYPE"],
				"CACHE_TIME" => $arParams["CACHE_TIME"],
				"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
				"SAVE_IN_SESSION" => "N",
				"XML_EXPORT" => "Y",
				"SECTION_TITLE" => "NAME",
				"SECTION_DESCRIPTION" => "DESCRIPTION",
				'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
				"TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"]
			),
			$component,
			array('HIDE_ICONS' => 'Y')
			);
		?>
	<!-- ����� ������ ����� -->
    <SCRIPT src="<?=SITE_TEMPLATE_PATH.'/bower_components/chosen_v1.1.0/chosen.jquery.js';?>"></SCRIPT>

	<!-- ������ �������� -->
    <div class="tips ">
        <?
$APPLICATION->IncludeComponent("bitrix:news.list", "shik_mainpage", Array(
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
);
?>
    </div>
	<!-- ������ �������� ����� -->
</div>

<!-- ���������� ������� �������� -->

<?
		global $sCatalogDisplay;
		if ($_REQUEST['display']) {
			$sCatalogDisplay = $_REQUEST['display'];
		} elseif ($_SESSION['display']) {
			$sCatalogDisplay = $_SESSION['display'];
		} else {
			$sCatalogDisplay = 'block';
		}
		$_SESSION['display'] = $sCatalogDisplay;
		
		global $sCatalogSort;
		global $sCatalogSortOrder;
		$sCatalogSort = strtolower($arParams["ELEMENT_SORT_FIELD"]);
		$sCatalogSortOrder = strtolower($arParams["ELEMENT_SORT_ORDER"]);
		if($_REQUEST['sort']) {$sCatalogSort = $_REQUEST['sort'];}
		elseif($_SESSION['sort']) {$sCatalogSort = $_SESSION['sort'];}
		$_SESSION['sort'] = $sCatalogSort;
		if($_REQUEST['order']) {$sCatalogSortOrder = $_REQUEST['order'];}
		elseif($_SESSION['order']) {$sCatalogSortOrder = $_SESSION['order'];}
		$_SESSION['order'] = $sCatalogSortOrder;
		
		global $pageElementCount;
		$pageElementCount = strtolower($arParams["PAGE_ELEMENT_COUNT"]);
		if($_REQUEST['count']) {
			$pageElementCount = $_REQUEST['count'];
		} elseif($_SESSION['count']) {
			$pageElementCount = $_SESSION['count'];
		}
		$_SESSION['count'] = $pageElementCount;
?>

<div class="col-xs-9 filtr__top">
    <div class="row">
        <div class="col-xs-2">
			<a rel="nofollow" <?if ($sCatalogDisplay!="block"):?>href="<?=$APPLICATION->GetCurPageParam('display=block', array('display', 'mode'))?>"<?endif;?> class="filtr__top-grid"></a>
			<a rel="nofollow" <?if ($sCatalogDisplay!="list"):?>href="<?=$APPLICATION->GetCurPageParam('display=list', 	array('display', 'mode'))?>"<?endif;?> class="filtr__top-linear"></a>
        </div>
		
		<div class="col-xs-6">
            <p class="filtr__top-sort-text"><?=GetMessage("CATALOG_SORT");?></p>
            <select class="chosen-select" onChange="goTo(this.value)">
                <?$arSorts = array(
					"POPULARITY" => array("NAME"=>"SHOW_COUNTER", "ORDER"=>array("desc")),
					"DATE_CREATE" => array("NAME"=>"DATE_CREATE", "ORDER"=>array("desc")),
				);
				foreach($arSorts as $key=>$arSort) {
					foreach($arSort["ORDER"] as $sortOrder) {
						$selected="";
						if ((strtoupper($sCatalogSort)==$arSort["NAME"]) && (strtoupper($sCatalogSortOrder)==strtoupper($sortOrder))) {
							$selected="selected ";
						}
						echo '<option '.$selected.' value="'.$APPLICATION->GetCurPageParam('sort='.strtolower($arSort["NAME"]).'&order='.$sortOrder, array("sort", "order")).'">'.GetMessage("CATALOG_SORT_".$key."_".strtoupper($sortOrder)).'</option>';
						}
					}
				?>
            </select>
        </div>
		
        <div class="col-xs-4">
            <p class="filtr__top-sort-text">����������</p>
            <select class="chosen-select-saw" onChange="goTo(this.value)">
				<?$arShow = array(
					"30 �������" => '30',
					"60 �������" => '60',
					"90 �������" => '90',
					"120 �������" => '120',
				);
				?>
                <?php 
				foreach ($arShow as $key=>$value): 
					$selected ='';
					$value = $APPLICATION->GetCurPageParam('count='.strtolower($value), array('count'));
					($_SESSION['count'] == $value)? $selected = 'selected' : '';
					echo "<option ${selected} value=${value}>${key}</option>";
				endforeach;
				?>
            </select>
        </div>
		<script type="text/javascript">
		function goTo(url) {
			location.href = url;
		}
		</script>
    </div>
</div>
<!-- ���������� ������� �������� ����� -->

<!-- ������� -->
<div class="col-xs-9">
<?$intSectionID = $APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	($sCatalogDisplay==='block')? 'shik_grid' : 'shik_line',
	array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"ELEMENT_SORT_FIELD" => $sCatalogSort,
		"ELEMENT_SORT_ORDER" => $sCatalogSortOrder,
		"ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
		"ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
		"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
		"META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
		"META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
		"BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
		"INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
		"BASKET_URL" => $arParams["BASKET_URL"],
		"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
		"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
		"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
		"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
		"PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
		"FILTER_NAME" => $arParams["FILTER_NAME"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_FILTER" => $arParams["CACHE_FILTER"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"SET_TITLE" => $arParams["SET_TITLE"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
		"PAGE_ELEMENT_COUNT" => $pageElementCount,
		"LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
		"PRICE_CODE" => $arParams["PRICE_CODE"],
		"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
		"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

		"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
		"USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
		"ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
		"PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
		"PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],

		"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
		"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
		"PAGER_TITLE" => $arParams["PAGER_TITLE"],
		"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
		"PAGER_TEMPLATE" => 'catalog_pagination',
		"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
		"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
		"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],

		"OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
		"OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
		"OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
		"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
		"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
		"OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
		"OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
		"OFFERS_LIMIT" => $arParams["LIST_OFFERS_LIMIT"],

		"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
		"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
		'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
		'CURRENCY_ID' => $arParams['CURRENCY_ID'],
		'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],

		'LABEL_PROP' => $arParams['LABEL_PROP'],
		'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
		'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],

		'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
		'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
		'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
		'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
		'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
		'MESS_BTN_BUY' => $arParams['MESS_BTN_BUY'],
		'MESS_BTN_ADD_TO_BASKET' => $arParams['MESS_BTN_ADD_TO_BASKET'],
		'MESS_BTN_SUBSCRIBE' => $arParams['MESS_BTN_SUBSCRIBE'],
		'MESS_BTN_DETAIL' => $arParams['MESS_BTN_DETAIL'],
		'MESS_NOT_AVAILABLE' => $arParams['MESS_NOT_AVAILABLE'],

		'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
		"ADD_SECTIONS_CHAIN" => "N"
	),
	$component
);?>
</div>
<!-- ������� ����� -->

</div>
</section>
<!-- ������� ������� ����� -->