<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (!empty($arResult['ERROR']))
{
	echo $arResult['ERROR'];
	return false;
}

?>

<div id="slides-container">
<?php foreach ($arResult as $slide): ?>
	<div class="slider__slide">
		<img class="slider__slide-img" src="<?php echo $slide['IMAGE_LINK']; ?>" alt="<?php echo $slide['UF_SLIDE_TITLE']; ?>"/>
		
		<div class="slider__slide-content">
            <h3 class="slider__slide-content-title">
                <?php echo $slide['UF_SLIDE_TITLE']; ?>
            </h3>

            <p class="slider__slide-content-text">
                <?php echo $slide['UF_SLIDE_TEXT']; ?>
            </p>
            <a class="slider__slide-content-link"  href="<?php echo $slide['UF_LINK']; ?>">
                <?php echo $slide['UF_LINK_NAME']; ?>
             </a>
        </div>
	</div>
<? endforeach; ?>
</div>

<div  class="slider__controls">
	<ul id="slides-controls" class="slider__controls-list">
	<?php if ($first = array_shift($arResult)) : ?>
		<li class="slider__controls-list-item active">
			<a><?=$first['UF_SLIDE_NAME']; ?></a>
		</li>
	<?php endif ?>

	<?php foreach ($arResult as $slide): ?>
		<li class="slider__controls-list-item">
			<a><?=$slide['UF_SLIDE_NAME']; ?></a>
		</li>
	<?php endforeach; ?>
	</ul>
</div>