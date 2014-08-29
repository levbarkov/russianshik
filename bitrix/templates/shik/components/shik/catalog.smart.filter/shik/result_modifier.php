<?foreach($arResult["ITEMS"] as $key => $arItem){
	if( !empty( $arItem["VALUES"] ) && ( $arItem["CODE"] == 'SHIRINA_PROFILYA' || $arItem["CODE"] == 'VYSOTA_PROFILYA' || $arItem["CODE"] == 'POSADOCHNYY_DIAMETR' || $arItem["CODE"] == 'SEZONNOST' || $arItem["CODE"] == 'SHIPY' ) ){
		$arResult["PROP"][$arItem["CODE"]][] = $arItem;
		unset( $arResult["ITEMS"][$key] );
	}
}?>