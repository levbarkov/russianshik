<div class="individual-coat__form">
    <div class="col-xs-12 individual-coat__align">
        <div class="individual-coat__form-body">
            <h3 class="individual-coat__form-body-title">
                ������ ���� �� �������������� ������?
            </h3>
			<p class="individual-coat__form-body-text">
                �������� ������ � �� ���������� ���, ����� �������� ������.
            </p>
			 <?$APPLICATION->IncludeComponent("bitrix:main.feedback", "coat_offer", Array(
				"USE_CAPTCHA" => "Y",
				"OK_TEXT" => "�������, ���� ��������� �������.",
				"EMAIL_TO" => "my@email.com",
				"REQUIRED_FIELDS" => Array("NAME","PHONE"),
				// "EVENT_MESSAGE_ID" => Array("5")
			),
			false
			);?>
        </div>
    </div>
</div>