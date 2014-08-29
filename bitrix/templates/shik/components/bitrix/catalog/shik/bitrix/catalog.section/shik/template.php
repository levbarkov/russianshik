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
?>
<pre>
<?php //print_r ($arResult['ITEMS'][0]['PRICE_MATRIX']['MATRIX'][1][0]); ?>
</pre>
<?
if (!empty($arResult['ITEMS'])):
?>

<?php foreach ($arResult['ITEMS'] as $product): ?>
	<div class="col-xs-4 catalog__grid-item">
        <div class="catalog__grid-item-photo">
            <a class="catalog__grid-item-photo-link" href="<?=$product['DETAIL_PAGE_URL'];?>">
                <div class="catalog__grid-item-photo-img-wrapper">
                    <img class="catalog__grid-item-photo-img" src="<?=$product['DETAIL_PICTURE']['SRC']; ?>" alt="<?=$product['NAME'];?>"/>
                    <span class="catalog__grid-item-sale-alert">скидка</span>
                </div>
            </a>
        </div>
        <a class="catalog__grid-item-model"><?=$product['NAME'];?></a>
		<?php if ($product['PRICE_MATRIX']['MATRIX'][1][0]['DISCOUNT_PRICE'] != $product['PRICE_MATRIX']['MATRIX'][1][0]['PRICE']): ?>
			<p class="catalog__grid-item-price"><?=$product['PRICE_MATRIX']['MATRIX'][1][0]['DISCOUNT_PRICE']; ?></p>
			<p class="catalog__grid-item-price-old"><?=$product['PRICE_MATRIX']['MATRIX'][1][0]['PRICE']; ?></p>
		<?php else: ?>
			<p class="catalog__grid-item-price"><?=$product['PRICE_MATRIX']['MATRIX'][1][0]['PRICE']; ?></p>
		<?php endif; ?>
    </div>
<?php endforeach; ?>
<?
	if ($arParams["DISPLAY_BOTTOM_PAGER"])
	{
		?><? echo $arResult["NAV_STRING"]; ?><?
	}
endif;
?>