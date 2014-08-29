<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "������ ������");
$APPLICATION->SetTitle("������ ������");
?>

<section class="repair">
        <div class="row">
            <div class="col-xs-12 repair__title">
                <h1 class="repair__title">������ ������� �������</h1>
            </div>
            <div class="col-xs-9 repair__wrapper">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="col-xs-4">
                            <span class="repair__list-icon">
                            <span class="repair__list-icon-hover"></span></span>
                            <h2 class="repair__list-title">������ ������</h2>
                            <ul class="repair__list">
                                <li class="repair__list-item">������ �������</li>
                                <li class="repair__list-item">������ ������</li>
                                <li class="repair__list-item">������ ���������</li>
                            </ul>
                            <a class="repair__list-link" href="#">���� ��������</a>
                        </div>
                        <div class="col-xs-4">
                            <span class="repair__list-icon-reshaping">
                            <span class="repair__list-icon-reshaping-hover"></span></span>

                            <h2 class="repair__list-title">�������� �������</h2>
                            <ul class="repair__list">
                                <li class="repair__list-item">�������� �� ������</li>
                                <li class="repair__list-item">��������� �������</li>
                                <li class="repair__list-item">��������� ������</li>
                            </ul>
                            <a class="repair__list-link" href="#">���� ��������</a>
                        </div>
                        <div class="col-xs-4">
                            <span class="repair__list-icon-restoration">
                            <span class="repair__list-icon-restoration-hover"></span></span>

                            <h2 class="repair__list-title">�����������</h2>
                            <ul class="repair__list">
                                <li class="repair__list-item">������ ��������</li>
                                <li class="repair__list-item">���������� �����������</li>
                                <li class="repair__list-item">��������� ����� ����</li>
                            </ul>
                            <a class="repair__list-link" href="#">���� ��������</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 btn-block">
                <a class="btn btn-default repair__download-btn" href="#">������� ����������� ��� �� ������ �������</a>
            </div>
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-12">
                        <h1 class="repair__order-title">������� ������ �� ������� �������� �������</h1>
                    </div>
                    <div class="col-xs-3 repair__order-item">

                        <div class="repair__order-icon-wrapper">
                        <div class="repair__order-icon">
                           <span class="repair__order-icon-receiving"> </span>
                        </div>

                        </div>
                        <p class="repair__order-icon-text">����� �������</p>
                    </div>
                    <div class="col-xs-3 repair__order-item">
                        <div class="repair__order-icon-wrapper">
                        <div class="repair__order-icon">
                           <span class="repair__order-icon-money"> </span>
                        </div>

                        </div>
                        <p class="repair__order-icon-text">���������� ����� ��
                            <a class="repair__order-icon-link" href="#">������</a></p>
                    </div>
                    <div class="col-xs-3 repair__order-item">
                        <div class="repair__order-icon-wrapper">
                            <div class="repair__order-icon">
                                <span class="repair__order-icon-calendar"> </span>
                            </div>

                        </div>
                        <p class="repair__order-icon-text">��������� ������ �� ���� ������</p>
                    </div>
                    <div class="col-xs-3 repair__order-item">
                        <div class="repair__order-icon-wrapper">
                            <div class="repair__order-icon">
                                <span class="repair__order-icon-surrender"> </span>
                            </div>

                        </div>
                        <span class="repair__order-icon-text">����� ������</span>
                    </div>


                </div>
            </div>
            </div>
            <div class="col-xs-3 tips">
<?
$APPLICATION->IncludeComponent("bitrix:news.list", "shik_mainpage", Array(
	"IBLOCK_TYPE" => "content",	// ��� ��������������� ����� (������������ ������ ��� ��������)
	"IBLOCK_ID" => "7",	// ��� ��������������� �����
	"NEWS_COUNT" => "3",	// ���������� �������� �� ��������
	"SORT_BY1" => "ACTIVE_FROM",	// ���� ��� ������ ���������� ��������
	"SORT_ORDER1" => "DESC",	// ����������� ��� ������ ���������� ��������
	"SORT_BY2" => "SORT",	// ���� ��� ������ ���������� ��������
	"SORT_ORDER2" => "ASC",	// ����������� ��� ������ ���������� ��������
	"FILTER_NAME" => "",	// ������
	"FIELD_CODE" => array(	// ����
		0 => "",
		1 => "",
	),
	"PROPERTY_CODE" => array(	// ��������
		0 => "",
		1 => "",
	),
	"CHECK_DATES" => "Y",	// ���������� ������ �������� �� ������ ������ ��������
	"DETAIL_URL" => "",	// URL �������� ���������� ��������� (�� ��������� - �� �������� ���������)
	"AJAX_MODE" => "N",	// �������� ����� AJAX
	"AJAX_OPTION_JUMP" => "N",	// �������� ��������� � ������ ����������
	"AJAX_OPTION_STYLE" => "Y",	// �������� ��������� ������
	"AJAX_OPTION_HISTORY" => "N",	// �������� �������� ��������� ��������
	"CACHE_TYPE" => "A",	// ��� �����������
	"CACHE_TIME" => "36000000",	// ����� ����������� (���.)
	"CACHE_FILTER" => "N",	// ���������� ��� ������������� �������
	"CACHE_GROUPS" => "N",	// ��������� ����� �������
	"PREVIEW_TRUNCATE_LEN" => "",	// ������������ ����� ������ ��� ������ (������ ��� ���� �����)
	"ACTIVE_DATE_FORMAT" => "d.m.Y",	// ������ ������ ����
	"SET_TITLE" => "N",	// ������������� ��������� ��������
	"SET_STATUS_404" => "N",	// ������������� ������ 404, ���� �� ������� ������� ��� ������
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// �������� �������� � ������� ���������
	"ADD_SECTIONS_CHAIN" => "N",	// �������� ������ � ������� ���������
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// �������� ������, ���� ��� ���������� ��������
	"PARENT_SECTION" => "",	// ID �������
	"PARENT_SECTION_CODE" => "",	// ��� �������
	"INCLUDE_SUBSECTIONS" => "Y",	// ���������� �������� ����������� �������
	"DISPLAY_TOP_PAGER" => "N",	// �������� ��� �������
	"DISPLAY_BOTTOM_PAGER" => "N",	// �������� ��� �������
	"PAGER_TITLE" => "�������",	// �������� ���������
	"PAGER_SHOW_ALWAYS" => "N",	// �������� ������
	"PAGER_TEMPLATE" => "",	// ������ ������������ ���������
	"PAGER_DESC_NUMBERING" => "N",	// ������������ �������� ���������
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// ����� ����������� ������� ��� �������� ���������
	"PAGER_SHOW_ALL" => "N",	// ���������� ������ "���"
	"DISPLAY_DATE" => "Y",	// �������� ���� ��������
	"DISPLAY_NAME" => "Y",	// �������� �������� ��������
	"DISPLAY_PICTURE" => "N",	// �������� ����������� ��� ������
	"DISPLAY_PREVIEW_TEXT" => "N",	// �������� ����� ������
	"AJAX_OPTION_ADDITIONAL" => "",	// �������������� �������������
	),
	false
);
?>
            </div>
        </div>
    </section>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>