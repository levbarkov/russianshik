<?php
// CModule::IncludeModule("iblock");	
// echo 1;
// $items = GetIBlockElementList(2, 17, Array("SORT"=>"DESC"), 6);

// if(CModule::IncludeModule("iblock"))
// {
   // выберем 10 элементов из папки $ID информационного блока $BID
   // $items = GetIBlockElementList($_GET['BID'], $_GET['ID'], Array("SORT"=>"ASC"), 10);
   // $items->NavPrint("Товары");
   // while($arItem = $items->GetNext())
   // {
      // echo $arItem["NAME"]."<br>";
      // echo $arItem["PREVIEW_TEXT"]."<br>";
   // }
   // $items->NavPrint("Товары");
// }
	
	// if (!function_exists('sort_sections'))
	// {
		// function sort_sections( $arr )
		// {
			// $count = count( $arr );
			// for( $i = 0; $i < $count; $i++ ){
				// for( $j = 0; $j < $count; $j++ ){
					// if( strtoupper($arr[$i]["NAME"]) < strtoupper($arr[$j]["NAME"]) ){
						// $tmp = $arr[$i];
						// $arr[$i] = $arr[$j];
						// $arr[$j] = $tmp;
					// }
				// }
			// }
			// return $arr;
		// }
	// }
	
	// $arSections = array();
	// $arIblocksID = array();
	// if((IntVal($arParams["IBLOCK_ID1"]) > 0)||(IntVal($arParams["IBLOCK_ID2"]) > 0)||(IntVal($arParams["IBLOCK_ID3"]) > 0)||(IntVal($arParams["IBLOCK_ID4"]) > 0))
	// {
		// $arIblocksFilter = array();
		// if (IntVal($arParams["IBLOCK_ID1"]) > 0) 
		// {
			// $arSections[intval($arParams["IBLOCK_ID1"])] = array();
			// $arIblocksID[] = intval($arParams["IBLOCK_ID1"]);
		// }
		// if (IntVal($arParams["IBLOCK_ID2"]) > 0)
		// {
			// $arSections[intval($arParams["IBLOCK_ID2"])] = array();
			// $arIblocksID[] = intval($arParams["IBLOCK_ID2"]);
		// }
		// if (IntVal($arParams["IBLOCK_ID3"]) > 0)
		// {
			// $arSections[intval($arParams["IBLOCK_ID3"])] = array();
			// $arIblocksID[] = intval($arParams["IBLOCK_ID3"]);
		// }
		// if (IntVal($arParams["IBLOCK_ID4"]) > 0)
		// {
			// $arSections[intval($arParams["IBLOCK_ID4"])] = array();
			// $arIblocksID[] = intval($arParams["IBLOCK_ID4"]);
		// }
	// }
	
	// foreach ($arIblocksID as $key=>$id)
	// {
		// $res=CIBlock::GetByID($id);
		// if($ar_res = $res->GetNext())$arSections[$id]["NAME"] = $ar_res['NAME'];
	// }

	// foreach( $arResult["SECTIONS"] as $arSection )
	// {
		// $arSections[$arSection["IBLOCK_ID"]]["ITEMS"][$arSection["IBLOCK_SECTION_ID"]]["CHILD"][] = $arSection;
	// }
	// $arResult["SECTIONS"] = $arSections;
	// unset($arSections);
	// unset($arIblocksID);
// echo '<pre>';
// print_r($items); 
// echo '</pre>';
?>