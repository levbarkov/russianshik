<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
?>

<?if(!empty($arResult["ERROR_MESSAGE"]))
{
	foreach($arResult["ERROR_MESSAGE"] as $v)
		ShowError($v);
}
if(strlen($arResult["OK_MESSAGE"]) > 0)
{
	?><div class="mf-ok-text"><?=$arResult["OK_MESSAGE"]?></div><?
}
?>

<form action="<?=POST_FORM_ACTION_URI?>" method="POST">
    <ul class="individual-coat__form-list">
        <li><p class="individual-coat__form-title"><?=GetMessage("MFT_NAME")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("NAME", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?></p></li>
        <li><input class="individual-coat__form-name" name="NAME" type="text"/></li>
    </ul>
    <ul class="individual-coat__form-list">
        <li> <p class="individual-coat__form-title"><?=GetMessage("MFT_PHONE")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("PHONE", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?></p></li>
		<li>
			<input class="individual-coat__form-phone" name="PHONE" id="phone" placeholder="+7(___)-___-____" pattern="+7 ([0-9]{3}) [0-9]{3}-[0-9]{2}-[0-9]{2}" type="tel" required/>
		</li>
	</ul>
	<input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
	<input type="submit" class="btn btn-default individual-coat__body-btn" href="#" name="submit" value="<?=GetMessage("MFT_SUBMIT")?>">
</form>
