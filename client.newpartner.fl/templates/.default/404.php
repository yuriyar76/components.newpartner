<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

$APPLICATION->SetTitle("404 Not Found");

$APPLICATION->IncludeComponent("bitrix:main.map", ".default", Array(
        "LEVEL"	=>	"3",
        "COL_NUM"	=>	"1",
        "SHOW_DESCRIPTION"	=>	"Y",
        "SET_TITLE"	=>	"Y",
        "CACHE_TIME"	=>	"3600"
    )
);

