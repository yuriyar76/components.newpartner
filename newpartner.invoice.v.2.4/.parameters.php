<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$arComponentParameters = array(
	"GROUPS" => array(
		"ADDITIONAL" => array(
    		"NAME" => "�������������",
    		"SORT" => 10,
    	),
		"LINKS" => array(
    		"NAME" => "������",
    		"SORT" => 20,
    	)
	),
	"PARAMETERS" => array(
		"CACHE_TIME" => Array("DEFAULT"=>"0"),
		"TYPE" => array(
			"PARENT" => "ADDITIONAL",
			"NAME" => "��� ���������",
			"TYPE" => "LIST",
			"VALUES" => array(
				0 => "",
				53 => '���������',
				242 => '����������'
			),
			"MULTIPLE" => "N",
			"DEFAULT" => array()
		),
		"LINK" => array(
			"PARENT" => "LINKS",
			"NAME" => "������ �� ������",
			"TYPE" => "STRING",
			"MULTIPLE" => "N",
			"DEFAULT" => ""
		),
		"MODE" => array(
			"PARENT" => "ADDITIONAL",
			"NAME" => "�����",
			"TYPE" => "STRING",
			"MULTIPLE" => "N",
			"DEFAULT" => ""
		),
	)
);
?>
