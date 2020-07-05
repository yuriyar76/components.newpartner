<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
{
	die();
}
if ($arResult['OPEN'])
{
	?>
    
    <div class="row">
    	<div class="col-md-12">
			<div class="panel panel-default">
                <div class="panel-heading"><h3><?=$arResult['TITLE'];?></h3></div>
                <div class="panel-body">
                	<div class="row">
                    	<? if ($arResult['ADMIN_AGENT']) : ?>
                    	<div class="col-md-4">
                        	������: <strong><?=$arResult['INVOICE']['PROPERTY_CREATOR_NAME'];?></strong>
                        </div>
                        <? endif; ?>
                        <div class="col-md-4">
                        	������: <strong><?=$arResult['INVOICE']['PROPERTY_BRANCH_NAME'];?></strong>
                        </div>
                        <div class="col-md-4">
                        	�������: <strong><?=$arResult['INVOICE']['PROPERTY_CONTRACT_NAME'];?></strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<div class="row">
        <div class="col-md-4">
            <h4>�����������</h4>
            <div class="panel panel-default-1">
				<div class="panel-heading">��������</div>
				<div class="panel-body"><?=$arResult['INVOICE']['PROPERTY_COMPANY_SENDER_VALUE'];?></div>
			</div>
            <div class="panel panel-default-1">
                <div class="panel-heading">�������</div>
                <div class="panel-body"><?=strlen($arResult['INVOICE']['PROPERTY_NAME_SENDER_VALUE']) ? $arResult['INVOICE']['PROPERTY_NAME_SENDER_VALUE'] : '&nbsp;';?></div>
            </div>
            <div class="panel panel-default-1">
                <div class="panel-heading">�������</div>
                <div class="panel-body"><?=$arResult['INVOICE']['PROPERTY_PHONE_SENDER_VALUE'];?></div>
            </div>
            <div class="panel panel-default-1">
                <div class="panel-heading">�����</div>
                <div class="panel-body"><?=$arResult['INVOICE']['PROPERTY_CITY_SENDER'];?></div>
            </div>
            <div class="panel panel-default-1">
                <div class="panel-heading">������</div>
                <div class="panel-body"><?=strlen($arResult['INVOICE']['PROPERTY_INDEX_SENDER_VALUE']) ? $arResult['INVOICE']['PROPERTY_INDEX_SENDER_VALUE'] : '&nbsp;';?></div>
            </div>
            <div class="panel panel-default-1">
                <div class="panel-heading">�����</div>
                <div class="panel-body"><?=$arResult['INVOICE']['PROPERTY_ADRESS_SENDER_VALUE']['TEXT'];?></div>
            </div>
        </div>
        <div class="col-md-4">
            <h4>����������</h4>
            <div class="panel panel-default">
                <div class="panel-heading">��������</div>
                <div class="panel-body"><?=$arResult['INVOICE']['PROPERTY_COMPANY_RECIPIENT_VALUE'];?></div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">�������</div>
                <div class="panel-body"><?=strlen($arResult['INVOICE']['PROPERTY_NAME_RECIPIENT_VALUE']) ? $arResult['INVOICE']['PROPERTY_NAME_RECIPIENT_VALUE'] : '&nbsp;';?></div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">�������</div>
                <div class="panel-body"><?=$arResult['INVOICE']['PROPERTY_PHONE_RECIPIENT_VALUE'];?></div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">�����</div>
                <div class="panel-body"><?=$arResult['INVOICE']['PROPERTY_CITY_RECIPIENT'];?></div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">������</div>
                <div class="panel-body"><?=strlen($arResult['INVOICE']['PROPERTY_INDEX_RECIPIENT_VALUE']) ? $arResult['INVOICE']['PROPERTY_INDEX_RECIPIENT_VALUE'] : '&nbsp;';?></div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">�����</div>
                <div class="panel-body"><?=$arResult['INVOICE']['PROPERTY_ADRESS_RECIPIENT_VALUE']['TEXT'];?></div>
            </div>
        </div>
        <div class="col-md-2">
        	<h4>�������� �����������</h4>
			<div class="panel panel-default-3">
                <div class="panel-heading">���</div>
                <div class="panel-body"><?=WeightFormat($arResult['INVOICE']['PROPERTY_WEIGHT_VALUE']);?></div>
            </div>
			<div class="panel panel-default-3">
                <div class="panel-heading">��������</div>
                <div class="panel-body">
					<?=$arResult['INVOICE']['PROPERTY_DIMENSIONS_VALUE'][0];?>*<?=$arResult['INVOICE']['PROPERTY_DIMENSIONS_VALUE'][1];?>*<?=$arResult['INVOICE']['PROPERTY_DIMENSIONS_VALUE'][2];?> ��
                </div>
            </div>
			<div class="panel panel-default-3">
                <div class="panel-heading">����</div>
                <div class="panel-body"><?=intval($arResult['INVOICE']['PROPERTY_PLACES_VALUE']);?></div>
            </div>
        	<h4>������� ��������</h4>
			<div class="panel panel-default-3">
                <div class="panel-heading">��� ��������</div>
                <div class="panel-body"><?=$arResult['INVOICE']['PROPERTY_TYPE_DELIVERY_VALUE'];?></div>
            </div>
			<div class="panel panel-default-3">
                <div class="panel-heading">��� �����������</div>
                <div class="panel-body"><?=$arResult['INVOICE']['PROPERTY_TYPE_PACK_VALUE'];?></div>
            </div>
			<div class="panel panel-default-3">
                <div class="panel-heading">���������</div>
                <div class="panel-body">
                    <p><?=$arResult['INVOICE']['PROPERTY_WHO_DELIVERY_VALUE'];?></p>
                    <p><?=$arResult['INVOICE']['PROPERTY_IN_DATE_DELIVERY_VALUE'];?> �� <?=$arResult['INVOICE']['PROPERTY_IN_TIME_DELIVERY_VALUE'];?></p>
                </div>
            </div>
		</div>
        <div class="col-md-2">
        	<h4>������� ������</h4>
			<div class="panel panel-default-3">
                <div class="panel-heading">������</div>
                <div class="panel-body"><?=$arResult['INVOICE']['PROPERTY_PAYMENT_VALUE'];?></div>
            </div>
			<div class="panel panel-default-3">
                <div class="panel-heading">����������</div>
                <div class="panel-body">
                	<?=($arResult['INVOICE']['PROPERTY_TYPE_PAYS_ENUM_ID'] == 253) ? $arResult['INVOICE']['PROPERTY_PAYS_VALUE'] : $arResult['INVOICE']['PROPERTY_TYPE_PAYS_VALUE'];?>
				</div>
            </div>
			<div class="panel panel-default-3">
                <div class="panel-heading">� ������</div>
                <div class="panel-body"><?=CurrencyFormat($arResult['INVOICE']['PROPERTY_FOR_PAYMENT_VALUE'],"RUU");?></div>
            </div>
			<div class="panel panel-default-3">
                <div class="panel-heading">����������� ���������</div>
                <div class="panel-body"><?=CurrencyFormat($arResult['INVOICE']['PROPERTY_COST_VALUE'],"RUU");?></div>
            </div>
			<h4>������</h4>
            <div class="panel panel-default-3">
                <div class="panel-heading">����������� ����������</div>
                <div class="panel-body"><?=$arResult['INVOICE']['PROPERTY_INSTRUCTIONS_VALUE']['TEXT'];?></div>
            </div>
        </div>

	</div> 
	<?
}
?>