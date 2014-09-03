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

<?
if (!empty($arResult['ITEMS'])):
?>
<div class="row">
        <div class="col-xs-12 saw">
            <div class="row">
                <div class="col-xs-12 catalog saw__grid">
                    <div class="row">
					<?php foreach ($arResult['ITEMS'] as $product): ?>
						<div class="col-xs-4 catalog__grid-item">
							<div class="catalog__grid-item-photo">
								<a class="catalog__grid-item-photo-link" href="<?=$product['DETAIL_PAGE_URL'];?>">
									<div class="catalog__grid-item-photo-img-wrapper">
										<img class="catalog__grid-item-photo-img" src="<?=$product['DETAIL_PICTURE']['SRC']; ?>" alt="<?=$product['NAME'];?>"/>
										<?php 
										if ($product['PRICE_MATRIX']['MATRIX'][1][0]['DISCOUNT_PRICE'] != $product['PRICE_MATRIX']['MATRIX'][1][0]['PRICE']): 
										?>
										<span class="catalog__grid-item-sale-alert"><?=GetMessage('SHIK_CATALOG_DISCOUNT');?></span>
										<?php
										elseif ($product['PRICE_MATRIX']['MATRIX'][1][0]['DISCOUNT_PRICE'] == $product['PRICE_MATRIX']['MATRIX'][1][0]['PRICE'] AND !empty($product['PROPERTIES']['NOVINKA']['VALUE'])):
										?>
										<span class="catalog__grid-item-new-alert"><?=GetMessage('SHIK_CATALOG_NEW');?></span>
										<?php endif; ?>
									</div>
								</a>
							</div>
							<a class="catalog__grid-item-model"><?=$product['NAME'];?></a>
							<?php if ($product['PRICE_MATRIX']['MATRIX'][1][0]['DISCOUNT_PRICE'] != $product['PRICE_MATRIX']['MATRIX'][1][0]['PRICE']): ?>
								<p class="catalog__grid-item-price"><?=(int)$product['PRICE_MATRIX']['MATRIX'][1][0]['DISCOUNT_PRICE'].' '.GetMessage('SHIK_CATALOG_RUB'); ?></p>
								<p class="catalog__grid-item-price-old"><?=(int)$product['PRICE_MATRIX']['MATRIX'][1][0]['PRICE'].' '.GetMessage('SHIK_CATALOG_RUB'); ?></p>
							<?php else: ?>
								<p class="catalog__grid-item-price"><?=(int)$product['PRICE_MATRIX']['MATRIX'][1][0]['PRICE'].' '.GetMessage('SHIK_CATALOG_RUB'); ?></p>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
					</div>
                </div>
			</div>
		</div>
		<div class="col-xs-12">
			<div class="line">

			</div>
		</div>
	</div>
	<div class="col-xs-12">
		<ul class="pagination">
			<?php 
			if ($arParams["DISPLAY_BOTTOM_PAGER"]) {
				echo $arResult["NAV_STRING"];
			}
			?>
		</ul>
	</div>
<?php endif; ?>