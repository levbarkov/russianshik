<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/".SITE_TEMPLATE_ID."/header.php");
$wizTemplateId = COption::GetOptionString("main", "wizard_template_id", "eshop_adapt_horizontal", SITE_ID);
CUtil::InitJSCore();
CJSCore::Init(array("fx"));
$curPage = $APPLICATION->GetCurPage(true);
?>
<!DOCTYPE html>
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<link rel="shortcut icon" type="image/x-icon" href="<?=SITE_DIR?>/favicon.ico" />
	<?//$APPLICATION->ShowHead();
	echo '<meta http-equiv="Content-Type" content="text/html; charset='.LANG_CHARSET.'"'.(true ? ' /':'').'>'."\n";
	$APPLICATION->ShowMeta("robots", false, true);
	$APPLICATION->ShowMeta("keywords", false, true);
	$APPLICATION->ShowMeta("description", false, true);
	$APPLICATION->ShowCSS(true, true);
	?>
	<link rel="stylesheet" type="text/css" href="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH."/colors.css")?>" />
	<?
	$APPLICATION->ShowHeadStrings();
	$APPLICATION->ShowHeadScripts();
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/script.js");
	?>
	<title><?$APPLICATION->ShowTitle()?></title>
</head>
<body>

<!--[if lt IE 8]>
<style>
    .browsehappy {
        margin: 0.2em 0;
        background: #ccc;
        color: #000;
        padding: 0.2em 0;
    }
</style>
<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
<![endif]-->

<div id="panel"><?$APPLICATION->ShowPanel();?></div>
<?$APPLICATION->IncludeComponent("bitrix:eshop.banner", "", array());?>
<div class="wrap" id="bx_eshop_wrap">
	<div class="header_wrap">
		<div class="header_wrap_container">
			<div class="header_top_section">
				<div class="header_top_section_container_one">
					<div class="bx_cart_login_top">
						<table>
							<tr>
								<td>
								<?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.line", "", array(
										"PATH_TO_BASKET" => SITE_DIR."personal/cart/",
										"PATH_TO_PERSONAL" => SITE_DIR."personal/",
										"SHOW_PERSONAL_LINK" => "N",
										"SHOW_NUM_PRODUCTS" => "Y",
										"SHOW_TOTAL_PRICE" => "Y",
										"SHOW_PRODUCTS" => "N",
										"POSITION_FIXED" =>"N"
									),
									false,
									array()
								);?>
								</td>
								<td>
								<?$APPLICATION->IncludeComponent("bitrix:system.auth.form", "eshop_adapt", array(
										"REGISTER_URL" => SITE_DIR."login/",
										"PROFILE_URL" => SITE_DIR."personal/",
										"SHOW_ERRORS" => "N"
									),
									false,
									array()
								);?>
								</td>
							</tr>
						</table>
					</div>
				</div>
				<div class="header_top_section_container_two">
					<?$APPLICATION->IncludeComponent("bitrix:menu", "top_menu", array(
	"ROOT_MENU_TYPE" => "top",
	"MENU_CACHE_TYPE" => "Y",
	"MENU_CACHE_TIME" => "36000000",
	"MENU_CACHE_USE_GROUPS" => "Y",
	"MENU_CACHE_GET_VARS" => array(
	),
	"MAX_LEVEL" => "1",
	"CHILD_MENU_TYPE" => "left",
	"USE_EXT" => "N",
	"DELAY" => "N",
	"ALLOW_MULTI_SELECT" => "N"
	),
	false
);?>
				</div>
				<div class="clb"></div>
			</div>  <!-- //header_top_section -->

			<div class="header_inner" itemscope itemtype = "http://schema.org/LocalBusiness">
				<?if ($curPage == SITE_DIR."index.php"):?><h1 class="site_title"><?endif?>
					<a <?if ($curPage != SITE_DIR."index.php"):?>class="site_title"<?endif?> href="<?=SITE_DIR?>" itemprop = "name"><?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/company_name.php"), false);?></a>
				<?if ($curPage == SITE_DIR."index.php"):?></h1><?endif?>

				<div class="header_inner_container_one">
					<div class="header_inner_include_aria"><span style="color: #1b5c79;">
							<strong style="display: inline-block;padding-top: 7px;"><a style="text-decoration: none;color:#1b5c79;" href="<?=SITE_DIR?>about/contacts/" itemprop = "telephone"><?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/telephone.php"), false);?></a></strong><br />
							<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/schedule.php"), false);?></span>
					</div>
				</div>

				<div class="header_inner_container_two">
					<?$APPLICATION->IncludeComponent("bitrix:search.title", "visual", array(
							"NUM_CATEGORIES" => "1",
							"TOP_COUNT" => "5",
							"CHECK_DATES" => "N",
							"SHOW_OTHERS" => "N",
							"PAGE" => SITE_DIR."catalog/",
							"CATEGORY_0_TITLE" => GetMessage("SEARCH_GOODS") ,
							"CATEGORY_0" => array(
								0 => "iblock_catalog",
							),
							"CATEGORY_0_iblock_catalog" => array(
								0 => "all",
							),
							"CATEGORY_OTHERS_TITLE" => GetMessage("SEARCH_OTHER"),
							"SHOW_INPUT" => "Y",
							"INPUT_ID" => "title-search-input",
							"CONTAINER_ID" => "search",
							"PRICE_CODE" => array(
								0 => "BASE",
							),
							"SHOW_PREVIEW" => "Y",
							"PREVIEW_WIDTH" => "75",
							"PREVIEW_HEIGHT" => "75",
							"CONVERT_CURRENCY" => "Y"
						),
						false
					);?>
				</div>

				<div class="clb"></div>

				<div class="header_inner_bottom_line_container">
					<div class="header_inner_bottom_line">
						<?if ($wizTemplateId == "eshop_adapt_horizontal"):?>
						<?$APPLICATION->IncludeComponent("bitrix:menu", "site_top_menu", Array(
	"ROOT_MENU_TYPE" => "left",	// ��� ���� ��� ������� ������
	"MENU_THEME" => "site",	// ���� ����
	"MENU_CACHE_TYPE" => "A",	// ��� �����������
	"MENU_CACHE_TIME" => "36000000",	// ����� ����������� (���.)
	"MENU_CACHE_USE_GROUPS" => "Y",	// ��������� ����� �������
	"MENU_CACHE_GET_VARS" => "",	// �������� ���������� �������
	"MAX_LEVEL" => "3",	// ������� ����������� ����
	"CHILD_MENU_TYPE" => "left",	// ��� ���� ��� ��������� �������
	"USE_EXT" => "Y",	// ���������� ����� � ������� ���� .���_����.menu_ext.php
	"DELAY" => "N",	// ����������� ���������� ������� ����
	"ALLOW_MULTI_SELECT" => "N",	// ��������� ��������� �������� ������� ������������
	),
	false
);?>
						<?endif?>
					</div>
				</div><!-- //header_inner_bottom_line_container -->

			</div>  <!-- //header_inner -->
			<?if ($APPLICATION->GetCurPage(true) == SITE_DIR."index.php"):?>
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "sect",
						"AREA_FILE_SUFFIX" => "inc",
						"AREA_FILE_RECURSIVE" => "N",
						"EDIT_MODE" => "html",
					),
					false,
					Array('HIDE_ICONS' => 'Y')
				);?>
			<?endif?>

		</div> <!-- //header_wrap_container -->
	</div> <!-- //header_wrap -->

	<div class="workarea_wrap">
		<div class="worakarea_wrap_container workarea <?if ($wizTemplateId == "eshop_adapt_vertical"):?>grid1x3<?else:?>grid<?endif?>">
			<div id="navigation">
				<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "", array(
						"START_FROM" => "0",
						"PATH" => "",
						"SITE_ID" => "-"
					),
					false,
					Array('HIDE_ICONS' => 'Y')
				);?>
			</div>
			<div class="bx_content_section">
				<?if ($curPage != SITE_DIR."index.php"):?>
				<h1><?=$APPLICATION->ShowTitle(false);?></h1>
				<?endif?>
