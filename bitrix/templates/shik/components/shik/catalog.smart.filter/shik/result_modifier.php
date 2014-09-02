<?

if (CSite::InDir(SITE_DIR.'catalog'))
{
	$arFilter = array_merge(array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "SECTION_ID" => $arParams["IBLOCK_SECTION_ID"] , "ACTIVE" => "Y"), $GLOBALS["arrFilter"]);
	$arResult["FINDED_COUNT"] = CIBlockElement::GetList( array("SORT"=>"ASC"), $arFilter, false, false, array("ID"))->SelectedRowsCount();
	}
?>

