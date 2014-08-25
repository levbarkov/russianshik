<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="col-xs-9 page__news">
    <div class="col-xs-9 page__news-item">
		<div class="row">
		<h1 class="page__news-item-title">
            «<?=$arResult['NAME'];?>»
        </h1>
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
		
		<div class="col-xs-12">
            <div class="news__item-img-wrapper">
                <img class="news__item-img" src="<?=$arItem['PREVIEW_PICTURE']['SRC'];?>" alt="<?=$arItem['NAME'];?>"/>
            </div>
            <h2><a class="page__news-item-link" href="<?=$arItem['DETAIL_PAGE_URL'];?>"><?=$arItem['NAME'];?></a></h2>
            <p class="page__news-item-text"><?=$arItem['PREVIEW_TEXT'];?></p>
            <a class="btn btn-default page__news-item-btn" href="<?=$arItem['DETAIL_PAGE_URL'];?>">Подробнее</a>
        </div>
		
<?endforeach;?>
		</div>
	</div>
</div>
<div class="col-xs-12">
    <ul class="pagination">
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>
	</ul>
</div>
	


