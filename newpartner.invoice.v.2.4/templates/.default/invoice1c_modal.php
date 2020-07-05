<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
{
	die();
}
if (($arResult['OPEN']) && ($arResult['REQUEST']))
{
	?>
    <div class="modal-body">
    	<div class="row">
        	<div class="col-md-12 text-right"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
        </div>
		<div class="row">
            <div class="col-md-12"><h3><?=$arResult['TITLE'];?></h3></div>
		</div>
        <div class="row">
			<div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                    	<div class="row"><div class="col-md-12"><h4>�����������</h4></div></div>
                        <div class="row">
                        	<div class="col-md-3">��������</div>
                            <div class="col-md-9"><strong><?=(strlen($arResult['REQUEST']['�������������������'])) ? $arResult['REQUEST']['�������������������'] : $arResult['REQUEST']['����������������'];?></strong></div>
						</div>
                        <div class="row">
                        	<div class="col-md-3">�������</div>
                            <div class="col-md-9"><strong><?=$arResult['REQUEST']['������������������'];?></strong></div>
						</div>
                        <div class="row">
                        	<div class="col-md-3">�������</div>
                            <div class="col-md-9"><strong><?=$arResult['REQUEST']['������������������'];?></strong></div>
						</div>
                        <div class="row">
                        	<div class="col-md-3">�����</div>
                            <div class="col-md-9"><strong><?=$arResult['REQUEST']['����������������'];?></strong></div>
						</div>
                        <div class="row">
                        	<div class="col-md-3">������</div>
                            <div class="col-md-9"><strong><?=$arResult['REQUEST']['�����������������'];?></strong></div>
						</div>
                        <div class="row">
                        	<div class="col-md-3">�����</div>
                            <div class="col-md-9"><strong><?=$arResult['REQUEST']['����������������'];?></strong></div>
						</div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                    	<div class="row"><div class="col-md-12"><h4>����������</h4></div></div>
                        <div class="row">
                        	<div class="col-md-3">��������</div>
                            <div class="col-md-9"><strong><?=(strlen($arResult['REQUEST']['������������������'])) ? $arResult['REQUEST']['������������������'] : $arResult['REQUEST']['���������������'];?></strong></div>
						</div>
                        <div class="row">
                        	<div class="col-md-3">�������</div>
                            <div class="col-md-9"><strong><?=$arResult['REQUEST']['�����������������'];?></strong></div>
						</div>
                        <div class="row">
                        	<div class="col-md-3">�������</div>
                            <div class="col-md-9"><strong><?=$arResult['REQUEST']['�����������������'];?></strong></div>
						</div>
                        <div class="row">
                        	<div class="col-md-3">�����</div>
                            <div class="col-md-9"><strong><?=$arResult['REQUEST']['���������������'];?></strong></div>
						</div>
                        <div class="row">
                        	<div class="col-md-3">������</div>
                            <div class="col-md-9"><strong><?=$arResult['REQUEST']['����������������'];?></strong></div>
						</div>
                        <div class="row">
                        	<div class="col-md-3">�����</div>
                            <div class="col-md-9"><strong><?=$arResult['REQUEST']['���������������'];?></strong></div>
						</div>
                    </div>
                </div>
            </div>
        </div> 
        <div class="row">
			<div class="col-md-4">
            	<div class="panel panel-default">
                    <div class="panel-body">
                    	<h4>�������� �����������</h4>
						<table class="table table-bordered table-condensed">
							<thead>
								<tr>
									<th width="50%">�������� �����������</th>
									<th width="10%">����</th>
									<th width="10%">���</th>
									<th width="10%">��� ��.</th>
									<th colspan="3" width="30%">��������</th>
								</tr>
							</thead>
							<tbody>
								<?
								$wght = 0;
								$wght_ob = 0;
								$klvmest = 0;
								foreach ($arResult['REQUEST']['��������'] as $g):?>
								<?
								$wght = $wght + $g['��������������'];
								$wght_ob = $wght_ob + $g['����������������������'];
								$klvmest = $klvmest + $g['��������������'];
								?>
								<tr>
									<td><?=$g['�������'];?></td>
									<td><?=$g['��������������'];?></td>
									<td><?=WeightFormat($g['��������������']);?></td>
									<td><?=WeightFormat($g['����������������������']);?></td>
									<td>
									<?=$g['�����'].'x'.$g['������'].'x'.$g['������'].' ��';
									?>
									</td>
								</tr>
								<?endforeach;?>
							</tbody>
							<tfoot>
								<tr>
									<th></th>
									<th><?=$klvmest;?></th>
									<th><?=WeightFormat($wght);?></th>
									<th><?=WeightFormat($wght_ob);?></th>
									<th></th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
			<div class="col-md-8">
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h4>������� ��������</h4>
                                <div class="row">
                                    <div class="col-md-4">��� ��������</div>
                                    <div class="col-md-8"><strong><?=$arResult['REQUEST']['������������������'];?></strong></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">��� �����������</div>
                                    <div class="col-md-8"><strong><?=(intval($arResult['REQUEST']['����������������']) == 1) ? '���������' : '�� ���������';?></strong></div>
                                </div>
                            	<div class="row">
                                	<div class="col-md-4">���������</div>
                                    <div class="col-md-8"><strong><?=$arResult['REQUEST']['������������������'];?></strong></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">���� ����������</div>
                                    <div class="col-md-8"><strong>
                                    	<?
                                            if (strlen($arResult['REQUEST']['��������������������']))
                                            {
												echo substr($arResult['REQUEST']['��������������������'],8,2).'.'.substr($arResult['REQUEST']['��������������������'],5,2).'.'.substr($arResult['REQUEST']['��������������������'],0,4);
                                            }
                                        ?>
                                    </strong></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                 <h4>������� ������</h4>
                            	<div class="row">
                                	<div class="col-md-4">������</div>
                                    <div class="col-md-8"><strong><?=$arResult['REQUEST']['����������������'];?></strong></div>
                                </div>
                            	<div class="row">
                                	<div class="col-md-4">����������</div>
                                    <div class="col-md-8"><strong><?=$arResult['REQUEST']['�����������������'];?></strong></div>
                                </div>
                            	<div class="row">
                                	<div class="col-md-4">����� � ������</div>
                                    <div class="col-md-8"><strong><?=$arResult['REQUEST']['������������'];?></strong></div>
                                </div>
                            	<div class="row">
                                	<div class="col-md-4">����� �� ������</div>
                                    <div class="col-md-8"><strong><?=$arResult['REQUEST']['���������������'];?></strong></div>
                                </div>                  
                            </div>
                        </div>
					</div>
				</div>
                <div class="row">
                	<div class="col-md-6">
						<div class="panel panel-default">
							<div class="panel-body">
								<h4>����. ����������</h4>
								<p><?=$arResult['REQUEST']['���������������������'];?></p>
							</div>
						</div>
					</div>
                	<div class="col-md-6">
                    	<div class="panel panel-default">
                        	<div class="panel-body">
                            	<h4>������������� ��������</h4>
                                <p><strong><?=$arResult['REQUEST']['�������������'];?></strong></p>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
        </div>
        <div class="row">
        	<?if ((is_array($arResult['REQUEST']['Goods'])) && (count($arResult['REQUEST']['Goods']) > 0)):?>
        	<div class="col-md-6">
        		<div class="panel panel-default">
        			<div class="panel-body">
        				<h4>������</h4>
        				<table class="table table-bordered table-condensed">
        					<thead>
        						<tr>
        							<th>������������ ������</th>
        							<th>����������, ��.</th>
        							<th>���� �� 1 ��., ������� ���, ���.</th>
        							<th>�����, ������� ���, ���.</th>
        							<th>����� ���, ���.</th>
        							<th>������ ���</th>
        						</tr>
        					</thead>
        					<tbody>
        						<? foreach ($arResult['REQUEST']['Goods'] as $g):?>
        						<tr>
        							<td><?=$g['GoodsName'];?></td>
        							<td><?=$g['Amount'];?></td>
        							<td><?=$g['Price'];?></td>
        							<td><?=$g['Sum'];?></td>
        							<td><?=$g['SumNDS'];?></td>
        							<td><?=$g['PersentNDS'];?>%</td>
        						</tr>
        						<?endforeach;?>
        					</tbody>
						</table>
					</div>
				</div>
			</div>
        	<?endif;?>
        	<div class="col-md-6">
        	    <?
                if (count($arResult['REQUEST']['�������']) > 0):
                ?>
                <table cellpadding="5" bordercolor="#ccc" border="1" width="600" style=" border-collapse: collapse;" class="show_tracks table table-striped table-hover">
                    <thead>
                        <tr>
                            <th colspan="3" class="text-center">���� ����������� <?=$arResult['REQUEST']['��������������'];?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?
                        foreach ($arResult['REQUEST']['�������'] as $s):
							if (in_array($s['InfoEvent'], $arResult['HIDE_EVENTS']) && ($s['Event'] == '�������������� ��������!'))
							{}
							else
							{
							?>
							<tr>
								<td width="30%"><?=$s['DateEvent'];?>&nbsp;<?=$s['TimeEvent'];?></td>
								<td width="35%"><?=$s['Event'];?></td>
								<td width="35%"><?=$s['InfoEvent'];?></td>
							</tr>
							<?
							}
                        endforeach;
                        ?>
                    </tbody>
                </table>
                <?
                endif;
                ?>
            </div>
        </div>
    </div>
    <?
}