<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();


$rsSect = \CIBlockSection::GetList(array('SORT' => 'DESC'), array(
		'IBLOCK_ID' => $arParams['IBLOCK_ID'],
		'CODE' => $arResult['VARIABLES'] ['SECTION_CODE']
    ));

$arResult['SECTION'] = $rsSect->Fetch();
?>