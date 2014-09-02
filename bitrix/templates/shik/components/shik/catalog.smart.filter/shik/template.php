<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

CJSCore::Init(array("fx"));

if (file_exists($_SERVER["DOCUMENT_ROOT"].$this->GetFolder().'/themes/'.$arParams["TEMPLATE_THEME"].'/colors.css'))
	$APPLICATION->SetAdditionalCSS($this->GetFolder().'/themes/'.$arParams["TEMPLATE_THEME"].'/colors.css');
?>
<h3 class="filtr__left-amount"><?=GetMessage('CATALOG_SMARTFILTER_ITEMS_COUNT');?> <?=$arResult['FINDED_COUNT'];?></h3>
<div class="filtr__left">

<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get" class="smartfilter">

			<?foreach($arResult["HIDDEN"] as $arItem):?>
				<input
					type="hidden"
					name="<?echo $arItem["CONTROL_NAME"]?>"
					id="<?echo $arItem["CONTROL_ID"]?>"
					value="<?echo $arItem["HTML_VALUE"]?>"
				/>
			<?endforeach;?>
			
			<?php $key = md5($arResult['ITEMS'][84]); ?>
			<div class="filtr__left-menu">
				<p class="filtr__left-menu-title"><?=$arResult['ITEMS'][84]['NAME'];?></p>
				<ul class="filtr__left-menu-list">
					<?php foreach ($arResult['ITEMS'][84]['VALUES'] as $productType): ?>
						<li>
							<input
								class="filtr__left-menu-chk"
								type="checkbox"
								value="<?echo $productType["HTML_VALUE"]?>"
								name="<?echo $productType["CONTROL_NAME"]?>"
								id="<?echo $productType["CONTROL_ID"]?>"
								<?echo $productType["CHECKED"]? 'checked="checked"': ''?>
								onclick="smartFilter.click(this)"
								<?if ($productType["DISABLED"]):?>disabled<?endif?>
								<?if ($size["DISABLED"]):?>disabled<?endif?>
							/>
							<input class="filtr__left-menu-chk" type="checkbox" id="<?=$productType['CONTROL_ID'];?>"/>
							<label class="filtr__left-menu-label" for="<?=$productType['CONTROL_ID'];?>"><span class="filtr__left-menu-square"></span><?=$productType['VALUE'];?></label>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
			
			<?foreach($arResult["ITEMS"] as $key=>$arItem):
				$key = md5($key);
				?>
				<?if(isset($arItem["PRICE"])):?>
					<?
					if (!$arItem["VALUES"]["MIN"]["VALUE"] || !$arItem["VALUES"]["MAX"]["VALUE"] || $arItem["VALUES"]["MIN"]["VALUE"] == $arItem["VALUES"]["MAX"]["VALUE"])
						continue;
					?>
					
					<div class="filtr__left-price">
						<p class="filtr__left-price-title"><?=GetMessage('CATALOG_SMARTFILTER_PRICE');?> <span class="filtr__left-price-title-span"><?=GetMessage('CATALOG_SMARTFILTER_RUB');?></span>
						</p>
						<div class="filtr__left-price-align">
							<p class="filtr__left-price-before"><?=GetMessage('CATALOG_SMARTFILTER_FROM');?></p>
							<input
								class="min-price"
								type="text"
								name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
								id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
								value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
								size="5"
								onkeyup="smartFilter.keyup(this)"
							/>
							<p class="filtr__left-price-after"><?=GetMessage('CATALOG_SMARTFILTER_TO');?></p>
								<input
									class="max-price"
									type="text"
									name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
									id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
									value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
									size="5"
									onkeyup="smartFilter.keyup(this)"
								/>
						</div>
					</div>
				<?endif?>
			<?endforeach?>
			
			<?php $key = md5($arResult['ITEMS'][63]); ?>
			<div class="filtr__left-size">
				<p class="filtr__left-size-title"><?=$arResult['ITEMS'][63]['NAME'];?></p>
				<ul class="filtr__left-size-list">
					<?php foreach($arResult['ITEMS'][63]['VALUES'] as $size): ?>
						 <li class="filtr__left-size-item">
							<input
								class="filtr__left-size-item-chk"
								type="checkbox"
								value="<?echo $size["HTML_VALUE"]?>"
								name="<?echo $size["CONTROL_NAME"]?>"
								id="<?echo $size["CONTROL_ID"]?>"
								<?echo $size["CHECKED"]? 'checked="checked"': ''?>
								onclick="smartFilter.click(this)"
								<?if ($size["DISABLED"]):?>disabled<?endif?>
							/>
							<label class="filtr__left-size-item-label" for="<?=$size['CONTROL_ID'];?>"><?=$size['VALUE'];?></label>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>

			<div class="filtr__left-pick">
				<input class="filtr__left-pick-up" type="submit" id="set_filter" name="set_filter" value="<?=GetMessage("CT_BCSF_SET_FILTER")?>" />
				<input class="filtr__left-pick-reset" type="submit" id="del_filter" name="del_filter" value="<?=GetMessage("CT_BCSF_DEL_FILTER")?>" />
			</div>
		</form>
<script>
	var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>');
</script>

</div>