<?
$arUrlRewrite = array(
	array(
		"CONDITION" => "#^/personal/order/#",
		"RULE" => "",
		"ID" => "bitrix:sale.personal.order",
		"PATH" => "/personal/order/index.php",
	),
	array(
		"CONDITION" => "#^/catalog/women/#",
		"RULE" => "",
		"ID" => "bitrix:catalog",
		"PATH" => "/catalog/women/index.php",
	),
	array(
		"CONDITION" => "#^tailor_tips#",
		"RULE" => "",
		"ID" => "bitrix:iblock.element.add.list",
		"PATH" => "/tailor_tips/index.php",
	),
	array(
		"CONDITION" => "#^/catalog/#",
		"RULE" => "",
		"ID" => "bitrix:catalog",
		"PATH" => "/catalog/index.php",
	),
	array(
		"CONDITION" => "#^/store/#",
		"RULE" => "",
		"ID" => "bitrix:catalog.store",
		"PATH" => "/store/index.php",
	),
	array(
		"CONDITION" => "#^/news/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/news/index.php",
	),
	array(
		"CONDITION" => "#^#",
		"RULE" => "",
		"ID" => "bitrix:iblock.element.add.list",
		"PATH" => "/catalog/tailor_tips/index.php",
	),
);

?>