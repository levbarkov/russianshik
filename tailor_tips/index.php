<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Советы портного");
?><?$APPLICATION->IncludeComponent(
	"bitrix:iblock.element.add.list",
	"",
	Array(
		"EDIT_URL" => "",
		"NAV_ON_PAGE" => "10",
		"MAX_USER_ENTRIES" => "100000",
		"IBLOCK_TYPE" => "content",
		"IBLOCK_ID" => "7",
		"GROUPS" => array(),
		"STATUS" => "ANY",
		"ELEMENT_ASSOC" => "N",
		"ALLOW_EDIT" => "Y",
		"ALLOW_DELETE" => "Y",
		"SEF_MODE" => "Y",
		"SEF_FOLDER" => "tailor_tips",
		"VARIABLE_ALIASES" => Array(),
		"VARIABLE_ALIASES" => Array(
		)
	)
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>