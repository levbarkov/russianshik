<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="popular__controls">
    <h3 class="popular__title"><?php echo GetMessage("SHOWCASE_TITLE"); ?></h3>
    <button class="btn btn-default popular__controls-btn active" data-filter=".category-<?php echo $arResult['SECTIONS'][17]['ID']?>"><?php echo GetMessage("SHOWCASE_WOMEN"); ?></button>
    <button class="btn btn-default popular__controls-btn" data-filter=".category-<?php echo $arResult['SECTIONS'][18]['ID']?>"><?php echo GetMessage("SHOWCASE_ACCESSORIES"); ?></button>
    <button class="btn btn-default popular__controls-btn" data-filter=".category-<?php echo $arResult['SECTIONS'][19]['ID']?>"><?php echo GetMessage("SHOWCASE_FURSKINS"); ?></button>
</div>

<div class="popular__list">
	<?php foreach ($arResult['SECTIONS'] as $sectionId => $section): ?>
		<?php foreach ($section['ITEMS'] as $product): ?>
			<div class="popular__list-item-col category-<?php echo $sectionId?>">
				<div class="popular__list-item">
					<a href="<?php echo $product['DETAIL_PAGE_URL']; ?>" class="popular__list-item-img-wrapper">
                        <img class="popular__list-item-img" src="<?php echo $product['DETAIL_PICTURE']['SRC']; ?>" alt="<?php echo $product['NAME']; ?>"/>
                        <?php 
						if ($product['PRICE_MATRIX']['MATRIX'][1][0]['DISCOUNT_PRICE'] != $product['PRICE_MATRIX']['MATRIX'][1][0]['PRICE']): 
						?>
							<span class="popular__list-item-alert"><?=GetMessage('SHOWCASE_DISCOUNT');?></span>
						<?php
						elseif ($product['PRICE_MATRIX']['MATRIX'][1][0]['DISCOUNT_PRICE'] == $product['PRICE_MATRIX']['MATRIX'][1][0]['PRICE'] AND !empty($product['PROPERTY_85_VALUE'])):
						?>
							<span class="popular__list-item-alert"><?=GetMessage('SHOWCASE_NEW');?></span>
						<?php endif; ?>
                    </a>
					<a class="popular__list-item-link" href="<?php echo $product['DETAIL_PAGE_URL']; ?>"><?php echo $product['NAME']; ?></a>
					<p class="popular__list-item-cost"><?php echo ((int)$product['CATALOG_PRICE_1']); ?></p>
				</div>
			</div>
		<?php endforeach; ?>
		
	<?php endforeach; ?>
</div>
