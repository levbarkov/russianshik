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
	<?$APPLICATION->ShowHead();
	echo '<meta http-equiv="Content-Type" content="text/html; charset='.LANG_CHARSET.'"'.(true ? ' /':'').'>'."\n";
	$APPLICATION->ShowMeta("robots", false, true);
	$APPLICATION->ShowMeta("keywords", false, true);
	$APPLICATION->ShowMeta("description", false, true);
	$APPLICATION->ShowCSS(true, true);
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
	<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700|PT+Sans+Narrow:400,700|PT+Serif:400,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
</head>
<body>
<!-- Google Tag Manager --> 

<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-NLDWN8" 
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript> 
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': 
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], 
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src= 
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f); 
})(window,document,'script','dataLayer','GTM-NLDWN8');</script> 
<!-- End Google Tag Manager --> 
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

<div id="panel"><?$APPLICATION->ShowPanel();?></div>
<?$APPLICATION->IncludeComponent("bitrix:eshop.banner", "", array());?>

<!-- страница -->
<div class="container">

<!-- заголовок и основная часть -->
<div class="sections">

<!-- заголовок -->
<section class="header">
    <div class="row">
	
		<!-- лого -->
        <div class="col-xs-4">
            <div class="header__logo-wrapper">
                <div class="header__logo">
					<?$APPLICATION->IncludeFile(SITE_DIR."/include/logo.php", Array(), Array("MODE" => "html", "NAME" => GetMessage("LOGO"),));?>
                </div>
            </div>
        </div>
		<!-- лого конец-->
		
		<!-- верхнее левое меню -->
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
		<!-- верхнее левое меню конец -->
		
		<!-- верхнее правое меню -->
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
		<!-- верхнее правое меню конец -->
		
		<!-- телефон хеадер -->
        <div class="col-xs-3">
            <div class="header__phone-wrapper-container">
                <div class="header__phone-wrapper">
                    <?$APPLICATION->IncludeFile(SITE_DIR."/include/telephone_header.php", Array(), Array("MODE" => "html", "NAME" => GetMessage("TELEPHONE_HEADER"),));?>
                </div>
            </div>
        </div>
		<!-- телефон хеадер конец -->
    </div>
</section>
<!-- заголовок конец -->

<!-- основное меню -->
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
<!-- основное меню конец -->

<!-- хлебные крошки -->
<section>
    <div class="row">
        <div class="col-xs-12 goods">
            <div class="goods__breadcrumb">
				<ol class="breadcrumb goods__breadcrumb-list">
<?
if(!$isFrontPage): 
	$APPLICATION->IncludeComponent("bitrix:breadcrumb", "shik", array(
	"START_FROM" => "0",
	"PATH" => "",
	"SITE_ID" => "-"
	),
	false
);
endif;
?>
				</ol>
            </div>
        </div>
    </div>
</section>
<!-- хлебные крошки конец -->