<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "�������� � ������2");
$APPLICATION->SetTitle("�������� � ������2");
?>
<section class="news__page">
	<div class="row">
		<div class="col-xs-9 tailoring">
		<p>������� ��������</p>

	<p><b>������ ��������</b>: 8 (495) 212 85 06 (��������������).</p>

	<p><b>����������� �����</b>: <a href="mailto:sale@russianshik.bureauit.com">sale@russianshik.bureauit.com</a></p>

	<p><b>Skype</b>: <a href="skype:shipping.example.ru">shipping.example.ru</a></p>
		</div>
	</div>
</section>

</div>
<!-- ��������� � �������� ����� �����-->

<!-- ����������� ���� �� �������������� ������ -->
<div class="sections sections-transparent">
    <div class="row">
        <?$APPLICATION->IncludeFile(SITE_DIR."include/offer.php", Array(), Array("MODE" => "html", "NAME" => GetMessage("OFFER"),));?>
    </div>
</div>
<!-- ����������� ���� �� �������������� ������ ����� -->
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>