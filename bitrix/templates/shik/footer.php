</div>

<div class="sections sections-footer">
    <div class="footer">
        <div class="row">
            <div class="col-xs-3">
                <h4 class="footer__list-title">
                    <?php echo GetMessage("FOOTER_MENU_LEFT"); ?>
                </h4>
				
				<?php
					$APPLICATION->IncludeComponent("bitrix:menu", "footer_menu_left", array(
						"ROOT_MENU_TYPE" => "footer_menu_left",
						"MENU_CACHE_TYPE" => "Y",
						"MENU_CACHE_TIME" => "36000000",
						"MENU_CACHE_USE_GROUPS" => "Y",
						"MENU_CACHE_GET_VARS" => array(
						),
						"MAX_LEVEL" => "1",
						"CHILD_MENU_TYPE" => "left",
						"USE_EXT" => "N",
						"DELAY" => "N",
						"ALLOW_MULTI_SELECT" => "N"
						),
						false
					);
				?>

            </div>
            <div class="col-xs-3">
                <h4 class="footer__list-title">
                    <?php echo GetMessage("FOOTER_MENU_CENTER"); ?>
                </h4>
				
				<?php
					$APPLICATION->IncludeComponent("bitrix:menu", "footer_menu_center", array(
						"ROOT_MENU_TYPE" => "footer_menu_center",
						"MENU_CACHE_TYPE" => "Y",
						"MENU_CACHE_TIME" => "36000000",
						"MENU_CACHE_USE_GROUPS" => "Y",
						"MENU_CACHE_GET_VARS" => array(
						),
						"MAX_LEVEL" => "1",
						"CHILD_MENU_TYPE" => "left",
						"USE_EXT" => "N",
						"DELAY" => "N",
						"ALLOW_MULTI_SELECT" => "N"
						),
						false
					);
			?>
            </div>
            <div class="col-xs-3">
                <h4 class="footer__list-title">
                    <?php echo GetMessage("FOOTER_MENU_RIGHT"); ?>
                </h4>
				
				<?php
					$APPLICATION->IncludeComponent("bitrix:menu", "footer_menu_right", array(
						"ROOT_MENU_TYPE" => "footer_menu_right",
						"MENU_CACHE_TYPE" => "Y",
						"MENU_CACHE_TIME" => "36000000",
						"MENU_CACHE_USE_GROUPS" => "Y",
						"MENU_CACHE_GET_VARS" => array(
						),
						"MAX_LEVEL" => "1",
						"CHILD_MENU_TYPE" => "left",
						"USE_EXT" => "N",
						"DELAY" => "N",
						"ALLOW_MULTI_SELECT" => "N"
						),
						false
					);
				?>
            </div>
			<div class="col-xs-3">
                <p class="footer__about-title">
                    <?$APPLICATION->IncludeFile(SITE_DIR."/include/copyright.php", Array(), Array("MODE" => "html", "NAME" => GetMessage("COPYRIGHT"),));?>
                </p>
                
                <?$APPLICATION->IncludeFile(SITE_DIR."/include/telephone_footer.php", Array(), Array("MODE" => "html", "NAME" => GetMessage("TELEPHONE_FOOTER"),));?>
                
				<?$APPLICATION->IncludeFile(SITE_DIR."/include/about_developers.php", Array(), Array("MODE" => "html", "NAME" => GetMessage("TELEPHONE_FOOTER"),));?>

            </div>
        </div>
    </div>
</div>
</div>
<?//=$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/dist/js/libs.js',true)?> 
<?//=$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/dist/js/suite.js',true)?> 
<!--<script src="<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/suite.min.js',true)?> "></script>-->
<script src="<?=SITE_TEMPLATE_PATH.'/dist/js/libs.js'?>"></script>
<script src="<?=SITE_TEMPLATE_PATH.'/dist/js/suite.js'?>"></script>
</body>
</html>