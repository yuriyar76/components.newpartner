<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
{
	die();
}
if (($arResult['OPEN']) && ($arResult['REQUEST']))
{
	?>
    <div class="print_block">
       <?for ($i = 0; $i <= 1; $i++):?>
        <div class="print_head_block">
            <div class="img_print_head">
                <img width="286" height="66" alt="" src="<?=$arResult['LOGO_PRINT'];?>">
            </div>
            <div class="adress_print_head">
                <?=$arResult['ADRESS_PRINT'];?>
            </div>
            <div class="number"><?=$arResult['REQUEST']['��������������'];?></div>
            <script type="text/javascript">
                $(document).ready(function() {
					JsBarcode("#barcode_<?=$i;?>", "<?=$arResult['REQUEST']['��������������'];?>", {
					  format: "CODE39",
					  width: 1.8,
					  height: 60,
					  displayValue: false
					});
                });
            </script>
            <svg id="barcode_<?=$i;?>" class="target"></svg>
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
                            <span class="value"><?=$arResult['REQUEST']['������������������'];?></span>
                        </div>
                    </td>
                    <td width="220" rowspan="2">
                        <div style="width:220px; height:80px;">
                            <span class="label">������� / Phone</span>
                            <span class="value"><?=$arResult['REQUEST']['������������������'];?></span>
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
                            <span class="value"><?=$arResult['REQUEST']['������������������'];?></span>
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
                            <span class="value"><?=$arResult['REQUEST']['�����������������'];?></span>
                        </div>
                    </td>
                </tr>
                    <td width="380">
                        <div style="width:380px; height:40px;">
                            <span class="label">��������-����������� / Shipping Company</span>
                            <span class="value" style="font-size: 11pt; line-height: 0.85;"><?=(strlen($arResult['REQUEST']['�������������������'])) ? $arResult['REQUEST']['�������������������'] : $arResult['REQUEST']['����������������'];?></span>
                        </div>
                    </td>
                <tr>
                    <td width="380">
                        <div style="width:380px; height:40px;">
                            <span class="label">������ / Country</span>
                            <span class="value"><?=$arResult['REQUEST']['�����������������'];?></span>
                        </div>
                    </td>
                    <td width="220">
                        <div style="width:220px; height:40px;">
                            <span class="label">������� / State</span>
                            <span class="value"><?=$arResult['REQUEST']['������������������'];?></span>
                        </div>
                    </td>
                    <td width="220" rowspan="3">
                        <div style="width:220px; height:120px;">
                            <span class="label">���������</span>
                            <span class="value"><?=$arResult['REQUEST']['������������������'];?></span>
                            <span class="label">��������� � ����</span>
                            <span class="value"></span>
                            <span class="label">��������� �� ����</span>
                            <span class="value"></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="380">
                        <div style="width:380px; height:40px;">
                            <span class="label">����� / Sity</span>
                            <span class="value"><?=$arResult['REQUEST']['����������������'];?></span>
                        </div>
                    </td>
                    <td width="220">
                        <div style="width:220px; height:40px;">
                            <span class="label">������ / Postal Code</span>
                            <span class="value"><?=$arResult['REQUEST']['�����������������'];?></span>
                        </div>
                    </td>
                    <td width="142" rowspan="2">
                        <div style="width:142px; height:80px;">
                            <span class="label">������</span>
                            <span class="value"><?=$arResult['REQUEST']['����������������'];?></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="600" colspan="2">
                        <div style="width:600px; height:40px;">
                            <span class="label">����� / Street Address</span>
                            <span class="value" style="font-size: 11pt; line-height: 0.85;"><?=$arResult['REQUEST']['����������������'];?></span>
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
                            <span class="value"><?=$arResult['REQUEST']['�����������������'];?></span>
                        </div>
                    </td>
                    <td width="220" rowspan="2">
                        <div style="width:220px; height:80px;">
                            <span class="label">������� / Phone</span>
                            <span class="value"><?=$arResult['REQUEST']['�����������������'];?></span>
                        </div>
                    </td>
                    <td colspan="3" rowspan="3" width="425">
                        <div style="width:425px; height:120px;">
                            <span class="label">����������� ���������� / SPECIAL INSTRUCTIONS</span>
                            <span class="value"><?=$arResult['REQUEST']['���������������������'];?></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="380">
                        <div style="width:380px; height:40px;">
                            <span class="label">��������-���������� / Consignee Company</span>
                            <span class="value" style="font-size: 11pt; line-height: 0.85;"><?=(strlen($arResult['REQUEST']['������������������'])) ? $arResult['REQUEST']['������������������'] : $arResult['REQUEST']['���������������'];?></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="380">
                        <div style="width:380px; height:40px;">
                            <span class="label">������ / Country</span>
                            <span class="value"><?=$arResult['REQUEST']['����������������'];?></span>
                        </div>
                    </td>
                    <td width="220">
                        <div style="width:220px; height:40px;">
                            <span class="label">������� / State</span>
                            <span class="value"><?=$arResult['REQUEST']['�����������������'];?></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="380">
                        <div style="width:380px; height:40px;">
                            <span class="label">����� / Sity</span>
                            <span class="value"><?=$arResult['REQUEST']['���������������'];?></span>
                        </div>
                    </td>
                    <td width="220">
                        <div style="width:220px; height:40px;">
                            <span class="label">������ / Postal Code</span>
                            <span class="value"><?=$arResult['REQUEST']['����������������'];?></span>
                        </div>
                    </td>
                    <td width="140">
                        <div style="width:140px; height:40px;">
                            <span class="label">����� �� ������</span>
                            <span class="value"><?=$arResult['REQUEST']['������������'];?></span>
                        </div>
                    </td>
                    <td width="140">
                        <div style="width:140px; height:40px;">
                            <span class="label">��������� �����</span>
                            <span class="value"><?=$arResult['REQUEST']['��������������'];?></span>
                        </div>
                    </td>
                    <td width="140">
                        <div style="width:140px; height:40px;">
                            <span class="label">����� � ������</span>
                            <span class="value"><?=$arResult['REQUEST']['������������'];?></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="600" colspan="2">
                        <div style="width:600px; height:40px;">
                            <span class="label">����� / Street Address</span>
                            <span class="value" style="font-size: 11pt; line-height: 0.85;"><?=$arResult['REQUEST']['���������������'];?></span>
                        </div>
                    </td>
                    <td colspan="3" width="425">
                        <div style="width:425px; height:40px;">
                            <span class="label">������� � ������� ����������� / Shippers Signature</span>
                            <span class="value" style="font-size: 10pt;line-height: 0.95;padding-right: 160px;"><?=$arResult['REQUEST']['������������������'];?></span>
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
                    <td colspan="3"><div style="width:298px; height:20px;"><span class="value" style="font-size:7pt;"><?=$arResult['REQUEST']['��������']['�������_1']['�������'];?></span></div></td>
                    <td><div style="width:80px; height:20px;"><span class="value"><?=$arResult['REQUEST']['��������']['�������_1']['��������������'];?></span></div></td>
                    <td><div style="width:80px; height:20px;"><span class="value"><?=$arResult['REQUEST']['��������']['�������_1']['��������������'];?></span></div></td>
                    <td><div style="width:140px; height:20px;"><span class="value"><?=$arResult['REQUEST']['��������']['�������_1']['sizes'];?></span></div></td>
                </tr>
                <tr>
                    <td colspan="3"><div style="width:298px; height:20px;"><span class="value" style="font-size:7pt;"><?=$arResult['REQUEST']['��������']['�������_2']['�������'];?></span></div></td>
                    <td><div style="width:80px; height:20px;"><span class="value"><?=$arResult['REQUEST']['��������']['�������_2']['��������������'];?></span></div></td>
                    <td><div style="width:80px; height:20px;"><span class="value"><?=$arResult['REQUEST']['��������']['�������_2']['��������������'];?></span></div></td>
                    <td><div style="width:140px; height:20px;"><span class="value"><?=$arResult['REQUEST']['��������']['�������_2']['sizes'];?></span></div></td>
                </tr>
                <tr>
                    <td colspan="3"><div style="width:298px; height:20px;"><span class="value" style="font-size:7pt;"><?=$arResult['REQUEST']['��������']['�������_3']['�������'];?></span></div></td>
                    <td><div style="width:80px; height:20px;"><span class="value"><?=$arResult['REQUEST']['��������']['�������_3']['��������������'];?></span></div></td>
                    <td><div style="width:80px; height:20px;"><span class="value"><?=$arResult['REQUEST']['��������']['�������_3']['��������������'];?></span></div></td>
                    <td><div style="width:140px; height:20px;"><span class="value"><?=$arResult['REQUEST']['��������']['�������_3']['sizes'];?></span></div></td>
                    <td rowspan="3" width="212"><div style="width:212px; height:60px;"><span class="label">���������</span></div></td>
                    <td rowspan="3" width="212"><div style="width:212px; height:60px;"><span class="label">������� ����������</span></div></td>
                </tr>
                <tr>
                    <td colspan="3"><div style="width:298px; height:20px;"><span class="value" style="font-size:7pt;"><?=$arResult['REQUEST']['��������']['�������_4']['�������'];?></span></div></td>
                    <td><div style="width:80px; height:20px;"><span class="value"><?=$arResult['REQUEST']['��������']['�������_4']['��������������'];?></span></div></td>
                    <td><div style="width:80px; height:20px;"><span class="value"><?=$arResult['REQUEST']['��������']['�������_4']['��������������'];?></span></div></td>
                    <td><div style="width:140px; height:20px;"><span class="value"><?=$arResult['REQUEST']['��������']['�������_4']['sizes'];?></span></div></td>
                </tr>
                <tr>
                    <td colspan="3"><div style="width:298px; height:20px;"><span class="value" style="font-size:7pt;"><?=$arResult['REQUEST']['��������']['�������_5']['�������'];?></span></div></td>
                    <td><div style="width:80px; height:20px;"><span class="value"><?=$arResult['REQUEST']['��������']['�������_5']['��������������'];?></span></div></td>
                    <td><div style="width:80px; height:20px;"><span class="value"><?=$arResult['REQUEST']['��������']['�������_5']['��������������'];?></span></div></td>
                    <td><div style="width:140px; height:20px;"><span class="value"><?=$arResult['REQUEST']['��������']['�������_5']['sizes'];?></span></div></td>
                </tr>
                <tr>
                    <td width="98">
                        <div style="height:50px; width:98px;">
                            <span class="label">����<br>Pieses</span>
                            <span class="value"><?=$arResult['REQUEST']['��������������'];?></span>
                        </div>
                    </td>
                    <td width="98">
                        <div style="height:50px; width:98px">
                            <span class="label">���<br>Weight</span>
                            <span class="value"><?=$arResult['REQUEST']['��������������'];?></span>
                        </div>
                    </td>
                    <td width="98">
                        <div style="height:50px; width:98px;"><span class="label">�������� ���<br>Vol. WT</span>
                            <span class="value"><?=$arResult['REQUEST']['����������������������'];?></span>
                        </div>
                    </td>
                    <td colspan="2"><div style="height:50px;"><span class="label">�����. �����.<br>Control WT</span></div></td>
                    <td>
                        <div style="height:50px;"><span class="label">������. ���������<br>Declared Value</span>
                            <span class="value"><?=$arResult['REQUEST']['��������������������'];?></span>
                        </div>
                    </td>
                    <td><div style="height:50px;"><span class="label">������� ����������</span></div></td>
                    <td><div style="height:50px;"><span class="label">���� � ����� ��������</span></div></td>
                </tr>
            </tbody>
        </table>
        <?endfor;?>
    </div>
    <?
}
?>