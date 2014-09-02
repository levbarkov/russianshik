<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Доставка и оплата2");
$APPLICATION->SetTitle("Доставка и оплата2");
?>
<section class="news__page">
	<div class="row">
		<div class="col-xs-9 tailoring">
		<p>Оптовым клиентам</p>

	<p><b>Служба доставки</b>: 8 (495) 212 85 06 (многоканальный).</p>

	<p><b>Электронная почта</b>: <a href="mailto:sale@russianshik.bureauit.com">sale@russianshik.bureauit.com</a></p>

	<p><b>Skype</b>: <a href="skype:shipping.example.ru">shipping.example.ru</a></p>
		</div>
	</div>
</section>

</div>
<!-- заголовок и основная часть конец-->

<!-- предложение шубы по индивидуальным меркам -->
<div class="sections sections-transparent">
    <div class="row">
        <?$APPLICATION->IncludeFile(SITE_DIR."include/offer.php", Array(), Array("MODE" => "html", "NAME" => GetMessage("OFFER"),));?>
    </div>
</div>
<!-- предложение шубы по индивидуальным меркам конец -->
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>