<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-53fe943118de2c15"></script>
<section class="news__item">
    <div class="row">
        <div class="col-xs-12">
            <h1 class="news__item-title">
                «<?php echo $arResult['IBLOCK']['NAME']; ?>»
            </h1>
        </div>
        <div class="col-xs-9 news">
            <div class="row">
                <div class="col-xs-12 ">
                    <div class="col-xs-12 ">
                        <div class="news__item-img-wrapper">
							<img class="news__item-img" src="<?=$arResult['DETAIL_PICTURE']['SRC'];?>" alt="#"/>
                        </div>
                        <h2><a href="#"><?=$arResult['NAME'];?></a></h2>
						<?=$arResult['DETAIL_TEXT'];?>
						<hr>
                        <div class="addthis_native_toolbox"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>