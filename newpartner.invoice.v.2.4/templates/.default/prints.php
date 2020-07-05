<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true){die();}

//dump($arResult['REQUEST']);

?>
    <style>
        .print_block {
            page-break-inside: avoid;
        }
    </style>
 <?
if($USER->isAdmin()){
    //dump($arResult['CURRENT_CLIENT_ADDON']['ID']);
}
if (is_array($arResult['REQUEST'])):?>
<?//dump($arResult['REQUEST'])?>
	<?foreach ($arResult['REQUEST'] as $j => $props):?>
		<div class="print_block">
		<?for ($i = 0; $i <= 1; $i++):?>
        <div class="print_head_block">
            <div class="img_print_head">
                <img width="286" height="66" alt="" src="<?=$props['LOGO_PRINT'];?>">
            </div>
            <div class="adress_print_head">
                <?=$props['ADRESS_PRINT'];?>
            </div>
            <div class="number"><?=$props['NUMDOC'];?></div>
            <?$idnum = str_replace('-', '', $props['NUMDOC']);?>
            <script type="text/javascript">
                $(document).ready(function() {
					JsBarcode("#barcode_<?=$idnum.'_'.$i;?>", "<?=$props['NUMDOC'];?>", {
					  format: "CODE39",
					  width: 2,
					  height: 60,
					  displayValue: false
					});
                });
            </script>
            <svg id="barcode_<?=$idnum.'_'.$i;?>" class="target"></svg>
        </div>
        <table cellpadding="0" cellspacing="0" border="1" bordercolor="#333333">
            <tbody>
                <tr>
                    <td rowspan="5" width="30" bgcolor="#f4ecc5" style="vertical-align:middle;">
                        <div style="width:30px; height:200px;">
                            <img width="30" height="200" alt="�����������" src="/bitrix/components/black_mist/newpartner.invoice/templates/.default/images/l1.png">
                        </div>
                    </td>
                    <td width="380">
                        <div style="width:380px; height:40px;">
                            <span class="label">������� ����������� / Shipper's Last Name</span>
                            <span class="value"><?=$props['������������������'];?></span>
                        </div>
                    </td>
                    <td width="220" rowspan="2">
                        <div style="width:220px; height:80px;">
                            <span class="label">������� / Phone</span>
                            <span class="value"><?=$props['������������������'];?></span>
                        </div>
                    </td>
                    <td rowspan="5" width="30" bgcolor="#d6ffcc" style="vertical-align:middle;">
                        <div style="width:30px; height:200px;">
                            <img width="30" height="200" alt="������� ��������"
                                 src="/bitrix/components/black_mist/newpartner.invoice/templates/.default/images/l3.png">
                        </div>
                    </td>
                    <td width="220" rowspan="2">
                        <div style="width:220px; height:80px;">
                            <span class="label">&nbsp;</span>
                            <span class="value"><?=$props['������������������'];?></span>
                        </div>
                    </td>
                    <td rowspan="5" width="30" bgcolor="#d6ffcc" style="vertical-align:middle;">
                        <div style="width:30px; height:200px;">
                            <img width="30" height="200" alt="������� ������" src="/bitrix/components/black_mist/newpartner.invoice/templates/.default/images/l4.png">
                        </div>
                    </td>
                    <td width="142" rowspan="3">
                        <div style="width:142px; height:120px;">
                            <span class="label">����������</span>
                            <span class="value"><?=$props['�����������������'];?></span>
                            <span class="value"></span>
                        </div>
                    </td>
                </tr>
                    <td width="380">
                        <div style="width:380px; height:40px;">
                            <span class="label">��������-����������� / Shipping Company</span>
                            <span class="value" style="font-size: 11pt; line-height: 0.85;"><?=$props['����������������'];?></span>
                        </div>
                    </td>
                <tr>
                    <td width="380">
                        <div style="width:380px; height:40px;">
                            <span class="label">������ / Country</span>
                            <span class="value"><?=$props['�����������������'];?></span>
                        </div>
                    </td>
                    <td width="220">
                        <div style="width:220px; height:40px;">
                            <span class="label">������� / State</span>
                            <span class="value"><?=$props['������������������'];?></span>
                        </div>
                    </td>
                    <td width="220" rowspan="3">
                        <div style="width:220px; height:120px;">
                            <span class="label">���������</span>
                            <span class="value"><?=$props['������������������'];?></span>
                            <span class="label">��������� � ����</span>
                            <span class="value"><?=$arResult['INVOICE']['PROPERTY_IN_DATE_DELIVERY_VALUE'];?></span>
                            <span class="label">��������� �� ����</span>
                            <span class="value"><?=$arResult['INVOICE']['PROPERTY_IN_TIME_DELIVERY_VALUE'];?></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="380">
                        <div style="width:380px; height:40px;">
                            <span class="label">����� / Sity</span>
                            <span class="value"><?=$props['����������������'];?></span>
                        </div>
                    </td>
                    <td width="220">
                        <div style="width:220px; height:40px;">
                            <span class="label">������ / Postal Code</span>
                            <span class="value"><?=$props['�����������������'];?></span>
                        </div>
                    </td>
                    <td width="142" rowspan="2">
                        <div style="width:142px; height:80px;">
                            <span class="label">������</span>
                            <span class="value"><?=$props['����������������'];?></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="600" colspan="2">
                        <div style="width:600px; height:40px;">
                            <span class="label">����� / Street Address</span>
                            <span class="value" style="font-size: 11pt; line-height: 0.85;">
                                <?=$props['����������������'];?></span>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <table cellpadding="0" cellspacing="0" border="1" bordercolor="#333333" style="margin-top:-1px;">
            <tbody>
                <tr>
                    <td rowspan="5" width="30" bgcolor="#f4ecc5" style="vertical-align:middle;">
                        <div style="width:30px; height:200px;">
                            <img width="30" height="200" alt="����������" src="/bitrix/components/black_mist/newpartner.invoice/templates/.default/images/l2.png">
                        </div>
                    </td>
                    <td width="380">
                        <div style="width:380px; height:40px;">
                            <span class="label">������� ���������� / Consignee's Last Name</span>
                            <span class="value"><?=$props['�����������������'];?></span>
                        </div>
                    </td>
                    <td width="220" rowspan="2">
                        <div style="width:220px; height:80px;">
                            <span class="label">������� / Phone</span>
                            <span class="value"><?=$props['�����������������'];?></span>
                        </div>
                    </td>
                    <td colspan="3" rowspan="3" width="425">
                        <div style="width:425px; height:120px;">
                            <span class="label">����������� ���������� / SPECIAL INSTRUCTIONS</span>
                            <span class="value"><?=$props['���������������������'];?></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="380">
                        <div style="width:380px; height:40px;">
                            <span class="label">��������-���������� / Consignee Company</span>
                            <span class="value" style="font-size: 11pt; line-height: 0.85;">
                                <?=$props['���������������'];?></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="380">
                        <div style="width:380px; height:40px;">
                            <span class="label">������ / Country</span>
                            <span class="value"><?=$props['����������������'];?></span>
                        </div>
                    </td>
                    <td width="220">
                        <div style="width:220px; height:40px;">
                            <span class="label">������� / State</span>
                            <span class="value"><?=$props['�����������������'];?></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="380">
                        <div style="width:380px; height:40px;">
                            <span class="label">����� / Sity</span>
                            <span class="value"><?=$props['���������������'];?></span>
                        </div>
                    </td>
                    <td width="220">
                        <div style="width:220px; height:40px;">
                            <span class="label">������ / Postal Code</span>
                            <span class="value"><?=$props['����������������'];?></span>
                        </div>
                    </td>
                    <td width="140">
                        <div style="width:140px; height:40px;">
                            <span class="label">����� �� ������</span>
                        </div>
                    </td>
                    <td width="140">
                        <div style="width:140px; height:40px;">
                            <span class="label">��������� �����</span>
                        </div>
                    </td>
                    <td width="140">
                        <div style="width:140px; height:40px;">
                            <span class="label">����� � ������</span>
                            <span class="value"></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="600" colspan="2">
                        <div style="width:600px; height:40px;">
                            <span class="label">����� / Street Address</span>
                            <span class="value" style="font-size: 11pt; line-height: 0.85;"><?=$props['���������������'];?></span>
                        </div>
                    </td>
                    <td colspan="3" width="425">
                        <div style="width:425px; height:40px;">
                            <span class="label">������� � ������� ����������� / Shippers Signature</span>
                            <?/* ��� ����� ����������� ��������������� ���������� ���������� ����������� ���� ���������������� ���������  */
                            if($arResult['CURRENT_CLIENT_ADDON']['ID']!='49075174'):?>
                                <span class="value" style="font-size: 10pt;line-height: 0.95;padding-right: 160px;"><?=$props['�����������������'];?></span>
                            <?endif;?>

                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <table cellpadding="0" cellspacing="0" border="1" bordercolor="#333333" style="margin-top:-1px;">
            <tbody>
                <tr>
                    <td rowspan="7" width="30" bgcolor="#ccffff" valign="middle" style="vertical-align:middle;">
                        <div style="height:182px; width:30px;">
                            <img width="30" height="182" alt="�������� �����������" src="/bitrix/components/black_mist/newpartner.invoice/templates/.default/images/l5.png">
                        </div>
                    </td>
                    <td colspan="3" width="298">
                        <div style="width:298px; height:25px;">
                            
                        </div>
                    </td>
                    <td width="80" align="center">
                        <div style="width:80px; height:25px;">
                            <span class="label">����<br>Pieces</span>
                        </div>
                    </td>
                    <td width="80" align="center">
                        <div style="width:80px; height:25px;">
                            <span class="label">���<br>Weight</span>
                        </div>
                    </td>
                    <td width="140" align="center">
                        <div style="width:140px; height:25px;">
                            <span class="label">�������� (�� � �� � ��)<br>Dimensions (cm x cm x cm)</span>
                        </div>
                    </td>
                    <td colspan="2" rowspan="3" width="425"><div style="width:425px; height:65px;">
                            <span class="label">������� ��������</span></div></td>
                </tr>
                <tr>
                    <td colspan="3"><div style="width:298px; height:20px;">
                            <span class="value"><?=$props['��������']['�������_1']['�������'];?>
                            </span></div></td>
                    <td><div style="width:80px; height:20px;">
                            <span class="value">
                                <?=($props['��������']['�������_1']['��������������'])?$props['��������']['�������_1']['��������������']:'';?></span>
                        </div></td>
                    <td><div style="width:80px; height:20px;">
                            <span class="value">
                                <?=($props['��������']['�������_1']['��������������'])?$props['��������']['�������_1']['��������������']:'';?></span>
                        </div></td>
                    <td>
                        <div style="width:140px; height:20px; display:flex; flex-direction: row;">
                            <?if($props['��������']['�������_1']['������']&&
                                $props['��������']['�������_1']['������']&&
                                $props['��������']['�������_1']['�����']):?>
                                <span class="value"><?=$props['��������']['�������_1']['�����'];?></span>
                                <span class="value">x</span>
                                <span class="value"><?=$props['��������']['�������_1']['������'];?></span>
                                <span class="value">x</span>
                                <span class="value"><?=$props['��������']['�������_1']['������'];?></span>
                            <?endif;?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3"><div style="width:298px; height:20px;"><span class="value"><?=$props['��������']['�������_2']['�������'];;?></span></div></td>
                    <td><div style="width:80px; height:20px;">
                            <span class="value">
                                <?=($props['��������']['�������_2']['��������������'])?$props['��������']['�������_2']['��������������']:'';?></span>
                        </div></td>
                    <td><div style="width:80px; height:20px;">
                            <span class="value">
                                <?=($props['��������']['�������_2']['��������������'])?$props['��������']['�������_2']['��������������']:'';?></span>
                        </div></td>
                    <td>
                        <div style="width:140px; height:20px; display:flex; flex-direction: row;">
                            <?if($props['��������']['�������_2']['������']&&
                                $props['��������']['�������_2']['������']&&
                                $props['��������']['�������_2']['�����']):?>
                                <span class="value"><?=$props['��������']['�������_2']['�����'];?></span>
                                <span class="value">x</span>
                                <span class="value"><?=$props['��������']['�������_2']['������'];?></span>
                                <span class="value">x</span>
                                <span class="value"><?=$props['��������']['�������_2']['������'];?></span>
                            <?endif;?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3"><div style="width:298px; height:20px;"><span class="value"><?=$props['��������']['�������_3']['�������'];;?></span></div></td>
                    <td><div style="width:80px; height:20px;">
                            <span class="value">
                                <?=($props['��������']['�������_3']['��������������'])?$props['��������']['�������_3']['��������������']:'';?></span>
                        </div></td>
                    <td><div style="width:80px; height:20px;">
                            <span class="value">
                                <?=($props['��������']['�������_3']['��������������'])?$props['��������']['�������_3']['��������������']:'';?></span>
                        </div></td>
                    <td>
                        <div style="width:140px; height:20px; display:flex; flex-direction: row;">
                            <?if($props['��������']['�������_3']['������']&&
                                $props['��������']['�������_3']['������']&&
                                $props['��������']['�������_3']['�����']):?>
                                <span class="value"><?=$props['��������']['�������_3']['�����'];?></span>
                                <span class="value">x</span>
                                <span class="value"><?=$props['��������']['�������_3']['������'];?></span>
                                <span class="value">x</span>
                                <span class="value"><?=$props['��������']['�������_3']['������'];?></span>
                            <?endif;?>
                        </div>
                    </td>
                    <td rowspan="3" width="212"><div style="width:212px; height:60px;"><span class="label">���������</span></div></td>
                    <td rowspan="3" width="212"><div style="width:212px; height:60px;"><span class="label">������� ����������</span></div></td>
                </tr>
                <tr>
                    <td colspan="3"><div style="width:298px; height:20px;"><span class="value"><?=$props['��������']['�������_4']['�������'];;?></span></div></td>
                    <td><div style="width:80px; height:20px;">
                            <span class="value">
                                <?=($props['��������']['�������_4']['��������������'])?$props['��������']['�������_4']['��������������']:'';?></span>
                        </div></td>
                    <td><div style="width:80px; height:20px;">
                            <span class="value">
                                <?=($props['��������']['�������_4']['��������������'])?$props['��������']['�������_4']['��������������']:'';?></span>
                        </div></td>
                    <td>
                        <div style="width:140px; height:20px; display:flex; flex-direction: row;">
                            <?if($props['��������']['�������_4']['������']&&
                                $props['��������']['�������_4']['������']&&
                                $props['��������']['�������_4']['�����']):?>
                                <span class="value"><?=$props['��������']['�������_4']['�����'];?></span>
                                <span class="value">x</span>
                                <span class="value"><?=$props['��������']['�������_4']['������'];?></span>
                                <span class="value">x</span>
                                <span class="value"><?=$props['��������']['�������_4']['������'];?></span>
                            <?endif;?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3"><div style="width:298px; height:20px;"><span class="value"><?=$props['��������']['�������_5']['�������'];?></span></div></td>
                    <td><div style="width:80px; height:20px;">
                            <span class="value">
                                <?=($props['��������']['�������_5']['��������������'])?$props['��������']['�������_5']['��������������']:'';?></span>
                        </div></td>
                    <td><div style="width:80px; height:20px;">
                            <span class="value">
                                <?=($props['��������']['�������_5']['��������������'])?$props['��������']['�������_5']['��������������']:'';?></span>
                        </div></td>
                    <td>
                        <div style="width:140px; height:20px; display:flex; flex-direction: row;">
                        <?if($props['��������']['�������_5']['������']&&
                            $props['��������']['�������_5']['������']&&
                            $props['��������']['�������_5']['�����']):?>
                            <span class="value"><?=$props['��������']['�������_5']['�����'];?></span>
                            <span class="value">x</span>
                            <span class="value"><?=$props['��������']['�������_5']['������'];?></span>
                             <span class="value">x</span>
                            <span class="value"><?=$props['��������']['�������_5']['������'];?></span>
                         <?endif;?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="98">
                        <div style="height:50px; width:98px;">
                            <?
                              $col_m = $props['��������']['�������_1']['��������������'] + $props['��������']['�������_2']['��������������'] +
                                  $props['��������']['�������_3']['��������������'] + $props['��������']['�������_4']['��������������'] +
                                  $props['��������']['�������_5']['��������������'];
                              $all_weigth = $props['��������']['�������_1']['��������������'] + $props['��������']['�������_2']['��������������'] +
                                  $props['��������']['�������_3']['��������������'] + $props['��������']['�������_4']['��������������'] +
                                  $props['��������']['�������_5']['��������������'];
                            ?>
                            <span class="label">����<br>Pieses</span>
                            <span class="value"><?=$col_m;?></span>
                        </div>
                    </td>
                    <td width="98">
                        <div style="height:50px; width:98px">
                            <span class="label">���<br>Weight</span>
                            <span class="value"><?=$all_weigth;?></span>
                        </div>
                    </td>
                    <td width="98">
                        <div style="height:50px; width:98px;"><span class="label">�������� ���<br>Vol. WT</span>
                            <span class="value"><?=$props['��������']['�������_1']['����������������������'];?></span>
                        </div>
                    </td>
                    <td colspan="2"><div style="height:50px;"><span class="label">�����. �����.<br>Control WT</span></div></td>
                    <td>
                        <div style="height:50px;"><span class="label">������. ���������<br>Declared Value</span>
                            <span class="value"><?=$arResult['INVOICE']['PROPERTY_COST_VALUE'];?></span>
                        </div>
                    </td>
                    <td><div style="height:50px;"><span class="label">������� ����������</span></div></td>
                    <td><div style="height:50px;"><span class="label">���� � ����� ��������</span></div></td>
                </tr>
            </tbody>
        </table>
		<?endfor;?>
		</div>
        <?if(count($arResult['REQUEST']>1)):?>
         <!--<div style="height: 203px; " class="delimeter"></div>-->
        <?endif;?>
		<? //if (($j+1) < count($arResult['INVOICES'])) :?>
	<!--	<div class="print_block_after"></div>-->
		<?//endif;?>
        <?endforeach;?>

<?endif;?>

 <?if ($arResult['INVOICE']):?>
    <?//dump($arResult['INVOICE']);?>
    <?foreach ($arResult['INVOICE'] as $j => $props):?>
    <div  class="print_block">
        <?for ($i = 0; $i <= 1; $i++):?>
            <div class="print_head_block">
                <div class="img_print_head">
                    <img width="286" height="66" alt="" src="<?=$props['LOGO_PRINT'];?>">
                </div>
                <div class="adress_print_head">
                    <?=$props['ADRESS_PRINT'];?>
                </div>
                <div class="number"><?=$props['NUMDOC'];?></div>
                <?$idnum = str_replace('-', '', $props['NUMDOC']);?>
                <script type="text/javascript">
                    $(document).ready(function() {
                        JsBarcode("#barcode_<?=$props['ID'];?>", "<?=$props['NUMDOC'];?>", {
                            format: "CODE39",
                            width: 2,
                            height: 60,
                            displayValue: false
                        });
                    });
                </script>
                <svg id="barcode_<?=$props['ID'];?>" class="target"></svg>
            </div>
            <table cellpadding="0" cellspacing="0" border="1" bordercolor="#333333">
                <tbody>
                <tr>
                    <td rowspan="5" width="30" bgcolor="#f4ecc5" style="vertical-align:middle;">
                        <div style="width:30px; height:200px;">
                            <img width="30" height="200" alt="�����������" src="/bitrix/components/black_mist/newpartner.invoice/templates/.default/images/l1.png">
                        </div>
                    </td>
                    <td width="380">
                        <div style="width:380px; height:40px;">
                            <span class="label">������� ����������� / Shipper's Last Name</span>
                            <span class="value"><?=$props['PROPERTY_NAME_SENDER_VALUE'];?></span>
                        </div>
                    </td>
                    <td width="220" rowspan="2">
                        <div style="width:220px; height:80px;">
                            <span class="label">������� / Phone</span>
                            <span class="value"><?=$props['PROPERTY_PHONE_SENDER_VALUE'];?></span>
                        </div>
                    </td>
                    <td rowspan="5" width="30" bgcolor="#d6ffcc" style="vertical-align:middle;">
                        <div style="width:30px; height:200px;">
                            <img width="30" height="200" alt="������� ��������" src="/bitrix/components/black_mist/newpartner.invoice/templates/.default/images/l3.png">
                        </div>
                    </td>
                    <td width="220" rowspan="2">
                        <div style="width:220px; height:80px;">
                            <span class="label">&nbsp;</span>
                            <span class="value"><?=$props['PROPERTY_TYPE_DELIVERY_VALUE'];?></span>
                        </div>
                    </td>
                    <td rowspan="5" width="30" bgcolor="#d6ffcc" style="vertical-align:middle;">
                        <div style="width:30px; height:200px;">
                            <img width="30" height="200" alt="������� ������" src="/bitrix/components/black_mist/newpartner.invoice/templates/.default/images/l4.png">
                        </div>
                    </td>
                    <td width="142" rowspan="3">
                        <div style="width:142px; height:120px;">
                            <span class="label">����������</span>
                            <? $result_client_name = preg_replace ("/������/i", "��������",  $props['PROPERTY_TYPE_PAYS_VALUE']);?>
                            <span class="value"><?=$result_client_name;?></span>
                            <span class="value"><?=$props['PROPERTY_PAYS_VALUE'];?></span>

                        </div>
                    </td>
                </tr>
                <td width="380">
                    <div style="width:380px; height:40px;">
                        <span class="label">��������-����������� / Shipping Company</span>
                        <span class="value" style="font-size: 11pt; line-height: 0.85;"><?=$props['PROPERTY_COMPANY_SENDER_VALUE'];?></span>
                    </div>
                </td>
                <tr>
                    <td width="380">
                        <div style="width:380px; height:40px;">
                            <span class="label">������ / Country</span>
                            <span class="value"><?=$props['PROPERTY_CITY_SENDER_AR'][2];?></span>
                        </div>
                    </td>
                    <td width="220">
                        <div style="width:220px; height:40px;">
                            <span class="label">������� / State</span>
                            <span class="value"><?=$props['PROPERTY_CITY_SENDER_AR'][1];?></span>
                        </div>
                    </td>
                    <td width="220" rowspan="3">
                        <div style="width:220px; height:120px;">
                            <span class="label">���������</span>
                            <span class="value"><?=$props['PROPERTY_WHO_DELIVERY_VALUE'];?></span>
                            <span class="label">��������� � ����</span>
                            <span class="value"><?=$props['PROPERTY_IN_DATE_DELIVERY_VALUE'];?></span>
                            <span class="label">��������� �� ����</span>
                            <span class="value"><?=$props['PROPERTY_IN_TIME_DELIVERY_VALUE'];?></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="380">
                        <div style="width:380px; height:40px;">
                            <span class="label">����� / Sity</span>
                            <span class="value"><?=$props['PROPERTY_CITY_SENDER_AR'][0];?></span>
                        </div>
                    </td>
                    <td width="220">
                        <div style="width:220px; height:40px;">
                            <span class="label">������ / Postal Code</span>
                            <span class="value"><?=$props['PROPERTY_INDEX_SENDER_VALUE'];?></span>
                        </div>
                    </td>
                    <td width="142" rowspan="2">
                        <div style="width:142px; height:80px;">
                            <span class="label">������</span>
                            <span class="value"><?=$props['PROPERTY_PAYMENT_VALUE'];?></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="600" colspan="2">
                        <div style="width:600px; height:40px;">
                            <span class="label">����� / Street Address</span>
                            <span class="value" style="font-size: 11pt; line-height: 0.85;"><?=$props['PROPERTY_ADRESS_SENDER_VALUE']['TEXT'];?></span>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
            <table cellpadding="0" cellspacing="0" border="1" bordercolor="#333333" style="margin-top:-1px;">
                <tbody>
                <tr>
                    <td rowspan="5" width="30" bgcolor="#f4ecc5" style="vertical-align:middle;">
                        <div style="width:30px; height:200px;">
                            <img width="30" height="200" alt="����������" src="/bitrix/components/black_mist/newpartner.invoice/templates/.default/images/l2.png">
                        </div>
                    </td>
                    <td width="380">
                        <div style="width:380px; height:40px;">
                            <span class="label">������� ���������� / Consignee's Last Name</span>
                            <span class="value"><?=$props['PROPERTY_NAME_RECIPIENT_VALUE'];?></span>
                        </div>
                    </td>
                    <td width="220" rowspan="2">
                        <div style="width:220px; height:80px;">
                            <span class="label">������� / Phone</span>
                            <span class="value"><?=$props['PROPERTY_PHONE_RECIPIENT_VALUE'];?></span>
                        </div>
                    </td>
                    <td colspan="3" rowspan="3" width="425">
                        <div style="width:425px; height:120px;">
                            <span class="label">����������� ���������� / SPECIAL INSTRUCTIONS</span>
                            <span class="value"><?=$props['PROPERTY_INSTRUCTIONS_VALUE']['TEXT'];?></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="380">
                        <div style="width:380px; height:40px;">
                            <span class="label">��������-���������� / Consignee Company</span>
                            <span class="value" style="font-size: 11pt; line-height: 0.85;"><?=$props['PROPERTY_COMPANY_RECIPIENT_VALUE'];?></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="380">
                        <div style="width:380px; height:40px;">
                            <span class="label">������ / Country</span>
                            <span class="value"><?=$props['PROPERTY_CITY_RECIPIENT_AR'][2];?></span>
                        </div>
                    </td>
                    <td width="220">
                        <div style="width:220px; height:40px;">
                            <span class="label">������� / State</span>
                            <span class="value"><?=$props['PROPERTY_CITY_RECIPIENT_AR'][1];?></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="380">
                        <div style="width:380px; height:40px;">
                            <span class="label">����� / Sity</span>
                            <span class="value"><?=$props['PROPERTY_CITY_RECIPIENT_AR'][0];?></span>
                        </div>
                    </td>
                    <td width="220">
                        <div style="width:220px; height:40px;">
                            <span class="label">������ / Postal Code</span>
                            <span class="value"><?=$props['PROPERTY_INDEX_RECIPIENT_VALUE'];?></span>
                        </div>
                    </td>
                    <td width="140">
                        <div style="width:140px; height:40px;">
                            <span class="label">����� �� ������</span>
                        </div>
                    </td>
                    <td width="140">
                        <div style="width:140px; height:40px;">
                            <span class="label">��������� �����</span>
                        </div>
                    </td>
                    <td width="140">
                        <div style="width:140px; height:40px;">
                            <span class="label">����� � ������</span>
                            <span class="value"><?=($props['PROPERTY_FOR_PAYMENT_VALUE'] > 0) ?$props['PROPERTY_FOR_PAYMENT_VALUE'] : '';?></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="600" colspan="2">
                        <div style="width:600px; height:40px;">
                            <span class="label">����� / Street Address</span>
                            <span class="value" style="font-size: 11pt; line-height: 0.85;"><?=$props['PROPERTY_ADRESS_RECIPIENT_VALUE']['TEXT'];?></span>
                        </div>
                    </td>
                    <td colspan="3" width="425">
                        <div style="width:425px; height:40px;">
                            <span class="label">������� � ������� ����������� / Shippers Signature</span>
                            <span class="value" style="font-size: 10pt;line-height: 0.95;padding-right: 160px;"><?=$props['PROPERTY_NAME_SENDER_VALUE'];?></span>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
            <table cellpadding="0" cellspacing="0" border="1" bordercolor="#333333" style="margin-top:-1px;">
                <tbody>
                <tr>
                    <td rowspan="7" width="30" bgcolor="#ccffff" valign="middle" style="vertical-align:middle;">
                        <div style="height:182px; width:30px;">
                            <img width="30" height="182" alt="�������� �����������" src="/bitrix/components/black_mist/newpartner.invoice/templates/.default/images/l5.png">
                        </div>
                    </td>
                    <td colspan="3" width="298">
                        <div style="width:298px; height:25px;">

                        </div>
                    </td>
                    <td width="80" align="center">
                        <div style="width:80px; height:25px;">
                            <span class="label">����<br>Pieces</span>
                        </div>
                    </td>
                    <td width="80" align="center">
                        <div style="width:80px; height:25px;">
                            <span class="label">���<br>Weight</span>
                        </div>
                    </td>
                    <td width="140" align="center">
                        <div style="width:140px; height:25px;">
                            <span class="label">�������� (�� � �� � ��)<br>Dimensions (cm x cm x cm)</span>
                        </div>
                    </td>
                    <td colspan="2" rowspan="3" width="425"><div style="width:425px; height:65px;"><span class="label">������� ��������</span></div></td>
                </tr>
                <tr>
                    <td colspan="3"><div style="width:298px; height:20px;"><span class="value"><?=$props['PACK_DESCR'][0]['name'];?></span></div></td>
                    <td><div style="width:80px; height:20px;"><span class="value"><?=$props['PACK_DESCR'][0]['place'];?></span></div></td>
                    <td><div style="width:80px; height:20px;"><span class="value"><?=$props['PACK_DESCR'][0]['weight'];?></span></div></td>
                    <td><div style="width:140px; height:20px;"><span class="value"><?=$props['PACK_DESCR'][0]['sizes'];?></span></div></td>
                </tr>
                <tr>
                    <td colspan="3"><div style="width:298px; height:20px;"><span class="value"><?=$props['PACK_DESCR'][1]['name'];?></span></div></td>
                    <td><div style="width:80px; height:20px;"><span class="value"><?=$props['PACK_DESCR'][1]['place'];?></span></div></td>
                    <td><div style="width:80px; height:20px;"><span class="value"><?=$props['PACK_DESCR'][1]['weight'];?></span></div></td>
                    <td><div style="width:140px; height:20px;"><span class="value"><?=$props['PACK_DESCR'][1]['sizes'];?></span></div></td>
                </tr>
                <tr>
                    <td colspan="3"><div style="width:298px; height:20px;"><span class="value"><?=$props['PACK_DESCR'][2]['name'];?></span></div></td>
                    <td><div style="width:80px; height:20px;"><span class="value"><?=$props['PACK_DESCR'][2]['place'];?></span></div></td>
                    <td><div style="width:80px; height:20px;"><span class="value"><?=$props['PACK_DESCR'][2]['weight'];?></span></div></td>
                    <td><div style="width:140px; height:20px;"><span class="value"><?=$props['PACK_DESCR'][2]['sizes'];?></span></div></td>
                    <td rowspan="3" width="212"><div style="width:212px; height:60px;"><span class="label">���������</span></div></td>
                    <td rowspan="3" width="212"><div style="width:212px; height:60px;"><span class="label">������� ����������</span></div></td>
                </tr>
                <tr>
                    <td colspan="3"><div style="width:298px; height:20px;"><span class="value"><?=$props['PACK_DESCR'][3]['name'];?></span></div></td>
                    <td><div style="width:80px; height:20px;"><span class="value"><?=$props['PACK_DESCR'][3]['place'];?></span></div></td>
                    <td><div style="width:80px; height:20px;"><span class="value"><?=$props['PACK_DESCR'][3]['weight'];?></span></div></td>
                    <td><div style="width:140px; height:20px;"><span class="value"><?=$props['PACK_DESCR'][3]['sizes'];?></span></div></td>
                </tr>
                <tr>
                    <td colspan="3"><div style="width:298px; height:20px;"><span class="value"><?=$props['PACK_DESCR'][4]['name'];?></span></div></td>
                    <td><div style="width:80px; height:20px;"><span class="value"><?=$props['PACK_DESCR'][4]['place'];?></span></div></td>
                    <td><div style="width:80px; height:20px;"><span class="value"><?=$props['PACK_DESCR'][4]['weight'];?></span></div></td>
                    <td><div style="width:140px; height:20px;"><span class="value"><?=$props['PACK_DESCR'][4]['sizes'];?></span></div></td>
                </tr>
                <tr>
                    <td width="98">
                        <div style="height:50px; width:98px;">
                            <span class="label">����<br>Pieses</span>
                            <span class="value"><?=$props['PROPERTY_PLACES_VALUE'];?></span>
                        </div>
                    </td>
                    <td width="98">
                        <div style="height:50px; width:98px">
                            <span class="label">���<br>Weight</span>
                            <span class="value"><?=$props['PROPERTY_WEIGHT_VALUE'];?></span>
                        </div>
                    </td>
                    <td width="98">
                        <div style="height:50px; width:98px;"><span class="label">�������� ���<br>Vol. WT</span>
                            <span class="value"><?=$props['PROPERTY_OB_WEIGHT'];?></span>
                        </div>
                    </td>
                    <td colspan="2"><div style="height:50px;"><span class="label">�����. �����.<br>Control WT</span></div></td>
                    <td>
                        <div style="height:50px;"><span class="label">������. ���������<br>Declared Value</span>
                            <span class="value"><?=$props['PROPERTY_COST_VALUE'];?></span>
                        </div>
                    </td>
                    <td><div style="height:50px;"><span class="label">������� ����������</span></div></td>
                    <td><div style="height:50px;"><span class="label">���� � ����� ��������</span></div></td>
                </tr>
                </tbody>
            </table>
        <?endfor;?>
    </div>
        <?if(count($arResult['REQUEST']>1)):?>
           <!-- <div style="height: 203px; " class="delimeter"></div>-->
        <?endif;?>
    <?endforeach;?>
<?endif;?>