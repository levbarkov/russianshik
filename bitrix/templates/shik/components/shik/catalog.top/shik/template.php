<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
global $APPLICATION;
if (!empty($arResult['ITEMS']))
{
	switch ($arParams['VIEW_MODE'])
	{
		case 'BANNER':
			include($strFullPath.'/banner/template.php');
			break;
		case 'SLIDER':
			include($strFullPath.'/slider/template.php');
			break;
		case 'SECTION':
			include($strFullPath.'/section/template.php');
			break;
	}
?>
<script type="text/javascript">
BX.message({
	MESS_BTN_BUY: '<? echo ('' != $arParams['MESS_BTN_BUY'] ? CUtil::JSEscape($arParams['MESS_BTN_BUY']) : GetMessageJS('CT_BCT_TPL_MESS_BTN_BUY')); ?>',
	MESS_BTN_ADD_TO_BASKET: '<? echo ('' != $arParams['MESS_BTN_ADD_TO_BASKET'] ? CUtil::JSEscape($arParams['MESS_BTN_ADD_TO_BASKET']) : GetMessageJS('CT_BCT_TPL_MESS_BTN_ADD_TO_BASKET')); ?>',
	MESS_NOT_AVAILABLE: '<? echo ('' != $arParams['MESS_NOT_AVAILABLE'] ? CUtil::JSEscape($arParams['MESS_NOT_AVAILABLE']) : GetMessageJS('CT_BCT_TPL_MESS_PRODUCT_NOT_AVAILABLE')); ?>',
	BTN_MESSAGE_BASKET_REDIRECT: '<? echo GetMessageJS('CT_BCT_CATALOG_BTN_MESSAGE_BASKET_REDIRECT'); ?>',
	BASKET_URL: '<? echo $arParams["BASKET_URL"]; ?>',
	ADD_TO_BASKET_OK: '<? echo GetMessageJS('ADD_TO_BASKET_OK'); ?>',
	TITLE_ERROR: '<? echo GetMessageJS('CT_BCT_CATALOG_TITLE_ERROR') ?>',
	TITLE_BASKET_PROPS: '<? echo GetMessageJS('CT_BCT_CATALOG_TITLE_BASKET_PROPS') ?>',
	TITLE_SUCCESSFUL: '<? echo GetMessageJS('ADD_TO_BASKET_OK'); ?>',
	BASKET_UNKNOWN_ERROR: '<? echo GetMessageJS('CT_BCT_CATALOG_BASKET_UNKNOWN_ERROR') ?>',
	BTN_MESSAGE_SEND_PROPS: '<? echo GetMessageJS('CT_BCT_CATALOG_BTN_MESSAGE_SEND_PROPS'); ?>',
	BTN_MESSAGE_CLOSE: '<? echo GetMessageJS('CT_BCT_CATALOG_BTN_MESSAGE_CLOSE') ?>'
});
</script>
<?
}
?>