<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (!empty($arResult['ERROR']))
{
	echo $arResult['ERROR'];
	return false;
}

?>

<section class="menu-catalog">
    <nav>
        <div class="row">
		<?php 
		$i = 1;
		foreach($arResult as $banner): 
			if ($i <=2):
		?>
			<div class="menu-catalog__item-col menu-catalog__item-col-big">
				<a href="<?php echo $banner['UF_LINK'];?>" class="menu-catalog__item">
                    <img class="menu-catalog__item-img" src="<?php echo $banner['IMAGE_LINK'];?>" alt=""/>
                    <span class="menu-catalog__item-title"><?php echo $banner['UF_NAME'];?></span>
                </a>
			</div>
			<?php elseif (($i > 2) AND ($i <= 5)): ?>
			<div class="menu-catalog__item-col">
                <a href="<?php echo $banner['UF_LINK'];?>" class="menu-catalog__item">
                    <img class="menu-catalog__item-img" src="<?php echo $banner['IMAGE_LINK'];?>" alt=""/>
                    <span class="menu-catalog__item-title"><?php echo $banner['UF_NAME'];?></span>
                </a>
            </div>
		<?php 
			endif; 
			$i++;
		endforeach; 
		?>
        </div>
    </nav>
</section>