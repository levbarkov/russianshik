<div class="individual-coat__form">
    <div class="col-xs-12 individual-coat__align">
        <div class="individual-coat__form-body">
            <h3 class="individual-coat__form-body-title">
                Хотите шубу по индивидуальным меркам?
            </h3>
			<p class="individual-coat__form-body-text">
                Оставьте заявку и мы перезвоним вам, чтобы уточнить детали.
            </p>
			 <?$APPLICATION->IncludeComponent("bitrix:main.feedback", "coat_offer", Array(
				"USE_CAPTCHA" => "Y",
				"OK_TEXT" => "Спасибо, ваше сообщение принято.",
				"EMAIL_TO" => "my@email.com",
				"REQUIRED_FIELDS" => Array("NAME","PHONE"),
				// "EVENT_MESSAGE_ID" => Array("5")
			),
			false
			);?>
        </div>
    </div>
</div>