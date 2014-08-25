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
	// $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/script.js");
	?>
	<title><?$APPLICATION->ShowTitle()?></title>
	
	<!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
	
	<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/dist/css/style.css')?>
	<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/dist/css/libs.css')?>
	
	<!--<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH.'/dist/css/style.css'?>"/>-->
    <!--[if lt IE 9]>
    <script src="<?=SITE_TEMPLATE_PATH.'/bower_components/respond/dest/respond.min.js'?>"></script>
    <script src="<?=SITE_TEMPLATE_PATH.'/bower_components/html5shiv/dist/html5shiv.min.js'?>"></script>
    <![endif]-->
	<?php if (CSite::InDir(SITE_DIR.'index.php'))	$isFrontPage = true; ?>
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
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?=SITE_TEMPLATE_PATH?>/bower_components/jquery/dist/jquery.min.js"><\/script>')</script>
<script src="<?=SITE_TEMPLATE_PATH.'/dist/js/main.js' ?>"></script>
<!--<script src="<?=SITE_TEMPLATE_PATH.'/dist/js/main.js' ?>"></script>-->

<div id="panel"><?$APPLICATION->ShowPanel();?></div>
<?$APPLICATION->IncludeComponent("bitrix:eshop.banner", "", array());?>

<div class="container">
<div class="sections">

<section class="header">
    <div class="row">
        <div class="col-xs-4">
            <div class="header__logo-wrapper">
                <div class="header__logo">
					<?$APPLICATION->IncludeFile(SITE_DIR."/include/logo.php", Array(), Array("MODE" => "html", "NAME" => GetMessage("LOGO"),));?>
                </div>
            </div>
        </div>
        <div class="col-xs-2 col-xs-offset-1">
            <div class="header__menu-wrapper">
			
			<?php
			$APPLICATION->IncludeComponent("bitrix:menu", "top_menu_left", array(
				"ROOT_MENU_TYPE" => "top_header_left",
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
			);
			?>
            </div>
        </div>
        <div class="col-xs-2">
            <div class="header__menu-wrapper">
			<?php
			$APPLICATION->IncludeComponent("bitrix:menu", "top_menu_right", array(
				"ROOT_MENU_TYPE" => "top_header_right",
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
			);
			?>
            </div>
        </div>
        <div class="col-xs-3">
            <div class="header__phone-wrapper-container">
                <div class="header__phone-wrapper">
                    <?$APPLICATION->IncludeFile(SITE_DIR."/include/telephone_header.php", Array(), Array("MODE" => "html", "NAME" => GetMessage("TELEPHONE_HEADER"),));?>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="menu">
    <nav>
	
	<?php
		$APPLICATION->IncludeComponent("bitrix:menu", "main_menu", array(
			"ROOT_MENU_TYPE" => "main_menu",
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
		);
	?>
    </nav>
</section>

<?
if(!$isFrontPage): 
	$APPLICATION->IncludeComponent("bitrix:breadcrumb", "", Array(
		"START_FROM" => "0",	// Номер пункта, начиная с которого будет построена навигационная цепочка
		"PATH" => "",	// Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
		"SITE_ID" => SITE_ID,	// Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
		),
		false
	);
endif;
?>