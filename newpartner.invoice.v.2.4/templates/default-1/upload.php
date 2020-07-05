<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true){die();}?>
<?
if (count($arResult["ERRORS"]) > 0) 
{
	?>
    <div class="alert alert-dismissable alert-danger fade in" role="alert">
        <button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">X</span><span class="sr-only">�������</span></button>
        <?=implode('</br>',$arResult["ERRORS"]);?>
    </div>
    <?
}
if (count($arResult["MESSAGE"]) > 0) 
{
	?>
    <div class="alert alert-dismissable alert-success fade in" role="alert">
        <button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">X</span><span class="sr-only">�������</span></button>
        <?=implode('</br>',$arResult["MESSAGE"]);?>
    </div>
    <?
}
if (count($arResult["WARNINGS"]) > 0)
{
	?>
    <div class="alert alert-dismissable alert-warning fade in" role="alert">
    	<button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">X</span><span class="sr-only">�������</span></button>
		<?=implode('</br>',$arResult["WARNINGS"]);?>
    </div>
    <?
}
if ($arResult['OPEN']) :?>
<div class="row">
	<div class="col-md-12">
		<div class="btn-group">
			<div class="btn-group" role="group">
				<a href="<?=$arParams['LINK'];?>index.php?mode=add" class="btn btn-warning" id="new_btn"><span class="glyphicon glyphicon-file" aria-hidden="true"></span> ����� ���������</a>
			</div>
			<div class="btn-group" role="group">
				<a href="<?=$arParams['LINK'];?>index.php" class="btn btn-default" data-toggle="tooltip" data-placement="bottom"  title="������ ���������">
				<span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> ������ ���������
			</a>
			</div>
		</div>

	</div>
</div>
<div class="row">
	<div class="col-md-12">&nbsp;</div>
</div>
<div class="row">
	<div class="col-md-4">
		<div class="well">
			<form method="post" action="" enctype="multipart/form-data">
				<input type="hidden" name="rand" value="<?=rand(100000,999999);?>">
				<input type="hidden" name="key_session" value="key_session_<?=rand(100000,999999);?>">
				<div class="form-group">
					<label for="fileupload">���� XML</label>
					<input type="file" id="fileupload" name="fileupload">
				</div>
				<button type="submit" class="btn btn-primary" name="upload">���������</button>
			</form>
		</div>
	</div>
	<div class="col-md-8">
		<p><strong>���� ��� �������� ������ ���� � ������� XML.</strong></p>
		<p><a href="/upload/iblock/f50/upload_example.xml" target="_blank">������ ��������� ����� ��� ��������</a>, ���:</p>
		<p>
			<strong>Sheeper</strong> - ������ �����������<br>
			<strong>ShipperFIO</strong> - ������� �����������<br>
			<strong>ShipperPhone</strong> - ������� �����������<br>
			<strong>ShipperCompany</strong> - �������� �����������<br>
			<strong>ShipperCity</strong> - ���������� ����� ����������� (������ ������������ ������� ���������� �������)<br>
			<strong>ShipperZip</strong> - ������ �����������<br>
			<strong>ShipperAddress</strong> - ����� �����������
		</p>
		<p>
			<strong>Invoice</strong> - ������ �������� �����������<br>
			<strong>ConsigneeFIO</strong> - ������� ����������<br>
			<strong>ConsigneePhone</strong> - ������� ����������<br>
			<strong>ConsigneeCompany</strong> - �������� ����������<br>
			<strong>ConsigneeCity</strong> - ���������� ����� ����������  (������ ������������ ������� ���������� �������)<br>
			<strong>ConsigneeZip</strong> - ������ ����������<br>
			<strong>ConsigneeAddress</strong> - ����� ����������<br>
			<strong>Weight</strong> - ��� �����������, ��<br>
			<strong>Length</strong> - ����� �����������, ��<br>
			<strong>Height</strong> - ������ �����������, ��<br>
			<strong>Width</strong> - ������ �����������, ��<br>
			<strong>Places</strong> - ���������� ����, ��.<br>
			<strong>PackDescription</strong> - �������� ��������� ���� �����������<br>
			<strong>TypePyas</strong> - ��� ���������� (�����������, ����������, ������)<br>
			<strong>TypePyasDescription</strong> - ��� ����������, ����������� �������� "������"<br>
			<strong>Cost</strong> - � ������, ���.<br>
			<strong>CodCost</strong> - ����� ����������� �������, ���.<br>
			<strong>DeclaredCost</strong> - ����������� ���������, ���.<br>
			<strong>Payment</strong> - ��� ������ (���������, �� �����, ���������� ������)<br>
			<strong>TypeDelivery</strong> - ��� �������� (��������, ��������, ������)<br>
			<strong>TypePack</strong> - ��� ����������� (���������, �� ���������)<br>
			<strong>WhoDelivery</strong> - ��������� (�� ������, �� �������������, ����� � ����)<br>
			<strong>DateDelivery</strong> - ��������� � ���� (� ������� ��.��.���)<br>
			<strong>TimeDelivery</strong> - ��������� �� ���� (� ������� ��:��)<br>
			<strong>SpecDelivery</strong> - ����������� ����������<br>
			<strong>Good</strong> - �������� ������� �����������, ��� <strong>Name</strong> - ������������, <strong>Amount</strong> - ����������, <strong>Price</strong> - ����, <strong>Sum</strong> - �����, <strong>SumNDS</strong> - ����� ���, <strong>PersentNDS</strong> - ������ ���
		</p>
	</div>
</div>
<?/*if ($arResult["FILE_ID"]) :?>
			<form method="post" action="">
				<input type="hidden" name="rand" value="<?=rand(100000,999999);?>">
				<input type="hidden" name="key_session" value="key_session_<?=rand(100000,999999);?>">
				<input type="hidden" name="fileid" value="6839">
				<button type="submit" class="btn btn-primary" name="upload">����������</button>
			</form>
<?endif;*/?>
<?endif;?>