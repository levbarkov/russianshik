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
				<div class="col-xs-12 catalog saw__linear">
					<div class="row">
					<?php foreach ($arResult['ITEMS'] as $product): ?>
						<div class="col-xs-12 catalog__linear-item">
							<table class="linear__table">
								<tr class="linear__table-row">
									<?php 
									if ($product['PRICE_MATRIX']['MATRIX'][1][0]['DISCOUNT_PRICE'] != $product['PRICE_MATRIX']['MATRIX'][1][0]['PRICE']): 
									?>
									<td class="linear__table-col-alert"><span class="catalog__linear-item-sale-alert">скидка</span>
                                    </td>
									<?php
									elseif ($product['PRICE_MATRIX']['MATRIX'][1][0]['DISCOUNT_PRICE'] == $product['PRICE_MATRIX']['MATRIX'][1][0]['PRICE'] AND !empty($product['PROPERTIES']['NOVINKA']['VALUE'])):
									?>
									<td class="linear__table-col-alert"><span class="catalog__linear-item-new-alert">новинка</span></td>
									<?php endif; ?>
									<td class="linear__table-col-name">
										<a class="catalog__linear-item-name" href="<?=$product['DETAIL_PAGE_URL'];?>"><?=$product['NAME'];?></a>
									</td>
									<td class="linear__table-col-icon">
										<a class="catalog__linear-item-icon" href="#"></a>
										<div class="catalog__linear-item-photo-img-wrapper" >
											<img class="catalog__linear-item-photo-img" src="<?=$product['DETAIL_PICTURE']['SRC']; ?>" alt="<?=$product['NAME'];?>"/>
										</div>
									</td>
									
									<?php if ($product['PRICE_MATRIX']['MATRIX'][1][0]['DISCOUNT_PRICE'] != $product['PRICE_MATRIX']['MATRIX'][1][0]['PRICE'].' '.GetMessage('SHIK_CATALOG_RUB')): ?>
									<td class="linear__table-col-price-old">
										<p class="catalog__linear-item-price-old"><?=(int)$product['PRICE_MATRIX']['MATRIX'][1][0]['PRICE'].' '.GetMessage('SHIK_CATALOG_RUB'); ?></p>
									</td>
									<td class="linear__table-col-price-new">
										<p class="catalog__linear-item-price-new"><?=(int)$product['PRICE_MATRIX']['MATRIX'][1][0]['DISCOUNT_PRICE'].' '.GetMessage('SHIK_CATALOG_RUB'); ?></p>
									</td>
									<?php else: ?>
									
									<td class="linear__table-col-price-old">
										<p class="catalog__linear-item-price-old"></p>
									</td>
									<td class="linear__table-col-price-new"> 
										<p class="catalog__linear-item-price-new"><?=(int)$product['PRICE_MATRIX']['MATRIX'][1][0]['PRICE'].' '.GetMessage('SHIK_CATALOG_RUB'); ?></p>
									</td>
									<?php endif; ?>
								</tr>
							</table>
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
