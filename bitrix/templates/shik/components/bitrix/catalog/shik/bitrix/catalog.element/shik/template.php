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
<section class="goods">
    <div class="row">
		<!-- галерея -->
        <div class="col-xs-4">
            <div class="goods__photo-wrapper">
                <div class="goods__photo-main">
                    <a class="goods__photo-main-link" href="#">
                        <div class="goods__photo-main-img-wrapper">
                            <img class="goods__photo-main-img" src="<? echo $arResult['DETAIL_PICTURE']['SRC']; ?>" alt="#"/>
                        </div>
                    </a>
                </div>
                <div class="goods__photo-small">
                    <div class="row">
						<?php 
						$i = 0;
						foreach($arResult['MORE_PHOTO'] as $photo): 
							
							if ($i < 2):
						?>
							<div class="col-xs-6 goods__photo-small-left">
								<a class="goods__photo-small-link" href="#">
									<div class="goods__photo-small-img-wrapper">
										<img class="goods__photo-small-img" src="<?php echo $photo['SRC']; ?>" alt="#"/>
									</div>
								</a>
							</div>
						<?php 
							$i++;
							endif;
						endforeach; 
						?>
                    </div>
                </div>
            </div>
        </div>
		<!-- галерея конец -->
		
		<!-- карточка товара -->
        <div class="col-xs-8">
            <div class="row">
                
				<!-- заголовок -->
				<div class="col-xs-12 goods ">
                    <h1 class="goods__item-title"><?php echo $arResult['NAME']; ?></h1>
                </div>
				<!-- заголовок конец -->
				
				<!-- цена товара-->
				<?php if ($arResult['PRICE_MATRIX']['MATRIX'][1][0]['PRICE']===$arResult['PRICE_MATRIX']['MATRIX'][1][0]['DISCOUNT_PRICE']): ?>
					<!-- цена основная -->
					<div class="col-xs-5 goods new_price">
						<div class="goods__sale">
							<p class="goods__sale-title"><?php echo GetMessage("CATALOG_PRICE");?>:</p>

							<p class="goods__sale-price"><?php echo $arResult['PRICE_MATRIX']['MATRIX'][1][0]['PRICE']; ?><span class="goods__sale-span"><?php echo GetMessage("CATALOG_RUB");?></span></p>
						</div>
					</div>
					<!-- цена основная конец -->
				<?php else: ?>
					<!-- цена со скидкой -->
					<div class="col-xs-5 goods new_price">
						<div class="goods__sale">
							<p class="goods__sale-title"><?php echo GetMessage("CATALOG_PRICE_DISCOUNT");?>:</p>

							<p class="goods__sale-price"><?php echo $arResult['PRICE_MATRIX']['MATRIX'][1][0]['DISCOUNT_PRICE']; ?><span class="goods__sale-span"><?php echo GetMessage("CATALOG_RUB");?></span></p>
						</div>
					</div>
					<!-- цена со скидкой конец -->
					<!-- старая цена -->
					<div class="col-xs-5 goods old_price">
						<div class="goods__old">
							<p class="goods__old-title"><?php echo GetMessage("CATALOG_PRICE_OLD");?>:</p>

							<p class="goods__old-price"><?php echo $arResult['PRICE_MATRIX']['MATRIX'][1][0]['PRICE']; ?><span class="goods__old-span"><?php echo GetMessage("CATALOG_RUB");?></span></p>
						</div>
					</div>
					<!-- старая цена конец -->
				<?php endif; ?>
				<!-- цена товара конец -->
				
				<!-- размер -->
                <div class="col-xs-12 goods sizes">
                    <div class="goods__size">
                        <p class="goods__size-text" itemprop="height"><?php echo GetMessage("CATALOG_SIZE");?>:</p>
                        <a class="goods__size-about" href="#">Как выбрать размер?</a>
                        <ul class="goods__list">
							<?php 
							$i=0;
							foreach($arResult['PROPERTIES']['SIZE']['VALUE'] as $size): 
							$size = explode(' ', $size);
							?>
								
                            <li class="goods__list-item">
                                <input class="goods__list-item-chk" checked type="radio" name="size" id="size<? echo (($i!=0)? ($i) : '');?>"/>
                                <label class="goods__list-item-chk-size" for="size<? echo (($i!=0)? ($i) : '');?>"><b><?php echo $size[0];?></b> <?php echo $size[1];?></label>
                            </li>
							<?php
							$i++;
							endforeach; 
							?>
                        </ul>
                    </div>
                </div>
				<!-- размер конец -->
				
				<!-- количество -->
                <div class="col-xs-12 goods quantity">

                    <p class="goods__amount-title"><?php echo GetMessage("CATALOG_QUANTITY");?>:</p>

                    <div class="goods__amount-box">
                        <a class="goods__amount-box-minus" id="minus" href="#"></a></span>
                        <input type="text" autocomplete="off" value="1" id="amount" class="goods__amount-box-value"/>
                        <span><a class="goods__amount-box-plus" href="#"></a></span>
                    </div>
                </div>
				<!-- количество конец -->
				
				<!-- наличие -->
                <div class="col-xs-12 goods buttons">
                    <a class="btn btn-default goods__buy" href="#"><?php echo GetMessage("CATALOG_BUY_IN_ONE_CLICK");?></a>
					<?php if ($arResult['CATALOG_QUANTITY'] == 0): ?>
						<a class="goods__available"><?php echo GetMessage("CATALOG_ORDER");?></a>
					<?php else: ?>
						<a class="goods__available"><?php echo GetMessage("CATALOG_GOODS_IN_STOCK");?></a>
					<?php endif; ?>
                    <a class="goods__adress" href="/about/contacts/"><?php echo GetMessage("CATALOG_SHOP_ADSRESS");?></a>
                </div>
				<!-- наличие конец -->
				
				<!-- описание -->
                <div class="col-xs-12 goods__about">
                    <ul class="nav nav-tabs goods__about-tabs">
                        <li class="active">
                            <input class="goods__about-hidden" checked type="radio" name="about" id="description"/>
                            <label class="goods__about-visible" for="description"><?php echo GetMessage("CATALOG_DESCRIPTION");?></label>
                        </li>
                    </ul>
                    <div class="goods__about-item">
                        <?php echo $arResult['DETAIL_TEXT']; ?>
                        <table class="goods__about-table">
                            <tr>
                                <td class="goods__about-table-left"><?php echo GetMessage("CATALOG_ARTICLE");?>:</td>
                                <td class="goods__about-table-right"><?php echo $arResult['PROPERTIES']['ARTICLE']['VALUE']; ?></td>
                            </tr>
                            <tr>
                                <td class="goods__about-table-left"><?php echo GetMessage("CATALOG_COLOR");?>:</td>
                                <td class="goods__about-table-right"><?php echo $arResult['PROPERTIES']['COLOR']['VALUE']; ?></td>
                            </tr>
                            <tr>
                                <td class="goods__about-table-left"><?php echo GetMessage("CATALOG_MATERIAL");?>:</td>
                                <td class="goods__about-table-right"><?php echo $arResult['PROPERTIES']['MATERIAL']['VALUE']; ?></td>
                            </tr>
                            <tr>
                                <td class="goods__about-table-left"><?php echo GetMessage("CATALOG_MANUFACTURING");?>:</td>
                                <td class="goods__about-table-right"><?php echo $arResult['PROPERTIES']['MANUFACTURING']['VALUE']; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
				<!-- описание конец -->
            </div>
        </div>
		<!-- карточка товара конец -->
    </div>
</section>



<script type="text/javascript">
var <? echo $strObName; ?> = new JCCatalogElement(<? echo CUtil::PhpToJSObject($arJSParams, false, true); ?>);
BX.message({
	MESS_BTN_BUY: '<? echo ('' != $arParams['MESS_BTN_BUY'] ? CUtil::JSEscape($arParams['MESS_BTN_BUY']) : GetMessageJS('CT_BCE_CATALOG_BUY')); ?>',
	MESS_BTN_ADD_TO_BASKET: '<? echo ('' != $arParams['MESS_BTN_ADD_TO_BASKET'] ? CUtil::JSEscape($arParams['MESS_BTN_ADD_TO_BASKET']) : GetMessageJS('CT_BCE_CATALOG_ADD')); ?>',
	MESS_NOT_AVAILABLE: '<? echo ('' != $arParams['MESS_NOT_AVAILABLE'] ? CUtil::JSEscape($arParams['MESS_NOT_AVAILABLE']) : GetMessageJS('CT_BCE_CATALOG_NOT_AVAILABLE')); ?>',
	TITLE_ERROR: '<? echo GetMessageJS('CT_BCE_CATALOG_TITLE_ERROR') ?>',
	TITLE_BASKET_PROPS: '<? echo GetMessageJS('CT_BCE_CATALOG_TITLE_BASKET_PROPS') ?>',
	BASKET_UNKNOWN_ERROR: '<? echo GetMessageJS('CT_BCE_CATALOG_BASKET_UNKNOWN_ERROR') ?>',
	BTN_SEND_PROPS: '<? echo GetMessageJS('CT_BCE_CATALOG_BTN_SEND_PROPS'); ?>',
	BTN_MESSAGE_CLOSE: '<? echo GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE') ?>'
});
</script>