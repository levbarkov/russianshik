<?
$slider = $arResult['rows'];
$arResult = array();
foreach ($slider as $slide) {
	$patt = '/src=\"([^\"]+)\"/s';
	preg_match($patt, $slide['UF_IMAGE'], $result);
	$slide['IMAGE_LINK'] = $result[1];
	$arResult[] = $slide;
}
?>