<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
{
	die();
}
if($USER->isAdmin()){
    //dump($arResult['CURRENT_CLIENT_ADDON']['ID']);
}
if (($arResult['OPEN']) && ($arResult['REQUEST']))
{
	?>
	<? //------------------  ?>
	
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>	
	
<style> 
div.mainBlock {
-webkit-filter: blur(0);
font-family: Tahoma, Geneva, sans-serif;
font-size: 12px;
color:black;
width:950px;
}

div.block1
{
height:auto;
text-align:center;
margin-right:0px;padding-right:0px;margin-left:0px;padding-left:0px;
line-height:14px;
font-size:12px;
font-weight:bold;
}

div.block1left
{
height:auto;
text-align:left;
margin-right:0px;
padding-right:0px;
margin-left:0px;
line-height:12px;
padding-left:3px;
font-size:12px;
font-weight:bold;
}

div.column {
margin-right:0px;
padding-right:0px;
margin-left:0px;
padding-left:0px;
padding-left:0px;}

div.container {
max-width:850px;
min-width:850px;
width:850px;
align-items:flex-start;
font-size:10px;
-webkit-print-color-adjust:exact;
-webkit-filter:opacity(1);
text-shadow: none;
}

div.stringHeight {
height:30px; 
min-height:30px;
}

div.stringHeight1 {
min-height:60px;
}

span.label {
	color: #536ac2;
	font-size: 8pt;
	display: block;
	width:100%;
	text-align:center;
	font-weight:normal;
	border:0;
}
span.label2 {
	color: #536ac2;
	font-size: 8pt;
	display: block;
	width:100%;
	text-align:left;
	font-weight:normal;
	border:0
}

.print_head_block1 {
	width: 900px;
	overflow: hidden;
	position: relative;
	height: 85px;
	font-size:13px;
}

div.application_for_delivery_print_head_inner {
height: 60px;
text-align: center;
line-height: 14px;
}

.print_head_block1 .number {
text-align: center;
text-align: left;
height: 50px;
font-size: 23pt;
}

.b-l {border-left:1px solid #222;}
.b-r {border-right:1px solid #222;} 
.b-b {border-bottom:1px solid #222;} 
.b-t {border-top:1px solid #222;}

.b-b-0 {border-bottom:0px solid #222;}

span.senderBar      {transform: rotate(-90deg);transform-origin: left top 0;position: absolute;left:5px;bottom: 20px;font-weight:bold;font-size:10px;background:#f4c5dd;letter-spacing:1px;}
span.recipientBar   {transform: rotate(-90deg);transform-origin: left top 0;position: absolute;left:5px;bottom: 20px;font-weight:bold;font-size:10px;letter-spacing:1px;}
span.reviewSender   {transform: rotate(-90deg);transform-origin: left top 0;position: absolute;left:5px;bottom: 50px;font-weight:bold;font-size:10px;}
span.deliveryTerms  {transform: rotate(-90deg);transform-origin: left top 0;position: absolute;left:5px;bottom: -8px;font-weight:bold;font-size:10px;width:120px;}
span.TermsOfPayment {transform: rotate(-90deg);transform-origin: left top 0;position: absolute;left:5px;bottom: -8px;font-weight:bold;font-size:10px;width:120px;}

div.senderBar       {float:left;height:151px;width:25px;background:#f4c5dd}
div.deliveryTerms   {background:#d6ffcc;width:25px;}
div.TermsOfPayment  {background:#d6ffcc;width:25px;} 
div.recipientBar    {float:left;height:151px;width:25px;background:#f4ecc5}
div.reviewSender    {float:left;height:100%;width:25px;background:#ccffff} 

svg.target {width:400px!important}

.print_block span.label {
    margin-left: 2px;
}

</style>

<div id="print_block" class="print_block">
<?for ($i = 0; $i <= 1; $i++){?>

<div class="mainBlock">	
<div class="container">	
<div class="row ">
    <div class="col-3 number" style="min-height:80px;padding-left:0;padding-right:0">
	<div class="number" style="font-size:21px;padding-top:30px;font-weight:bold;margin-left:20px;"><?=$arResult['REQUEST']['��������������'];?></div>
	</div>
	<div class="col-6 " style="min-height:80px;padding-left:0;padding-right:0">
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
	<div class="col-3" style="min-height:80px;padding-left:0;padding-right:0">
	        <div class="img_print_head">
                <img width="200" height="47" alt="" src="<?=$arResult['LOGO_PRINT'];?>">
            </div>
            <div class="adress_print_head" style="max-width:150px;margin:0 auto">
                <?=$arResult['ADRESS_PRINT'];?>
            </div>
	</div>
</div> 
<div class="row block1  b-t b-r b-l b-b-0">
  <div class="column col-8 block1"   >
	  <div class= "b-r senderBar">
	  <span class="senderBar">
	  �����������
	  </span>
	  </div>
	  <div class="row">
		  <div class="column  col-8 block1"    >
			  
			<div class="row stringHeight block1left b-r"  >
			  <div class="column col-12  block1left">
			   <span class="label2" >������� ����������� / Shipper's Last Name </span> <?=$arResult['REQUEST']['������������������'];?>
			  </div>
			</div>
			<div class="row stringHeight block1left  b-t b-r "  >
			  <div class="column col-12  block1left">
			   <span class="label2" >��������-����������� / Shipping Company  </span><?=(strlen($arResult['REQUEST']['�������������������'])) ? $arResult['REQUEST']['�������������������'] : $arResult['REQUEST']['����������������'];?> 
			  </div>
			</div>
			<div class="row stringHeight block1left  b-t b-r "  >
			  <div class="column col-12  block1left">
			   <span class="label2" >������ / Country </span><?=$arResult['REQUEST']['�����������������'];?>
			  </div>
			</div>
			<div class="row stringHeight block1left  b-t b-r "  >
			  <div class="column col-12  block1left">
			   <span class="label2" >����� / City </span><?=$arResult['REQUEST']['����������������'];?>
			  </div>
			</div>
		  </div>
		  <div class="col-4 block1">
			<div class="row block1 stringHeight b-r"  style="height:60px;"  >
			  <div class="column col-12 block1"><span class="label" style="border:0"> ������� / Phone </span> <?
                    $strExplode = preg_split('/[;:\\\,]/u', $arResult['REQUEST']['������������������'], -1, PREG_SPLIT_NO_EMPTY);
						foreach ($strExplode as $k=>$v){
							echo $v."<br/>";
					}
			   ?>
			  </div>
			</div>
			<div class="row block1 stringHeight  b-t b-r "  >
			  <div class="column col-12 block1">
			   <span class="label"> ������� / State </span><?=$arResult['REQUEST']['������������������'];?> </span>
			  </div>
			</div>
			<div class="row block1 stringHeight  b-t b-r " >
			  <div class="column col-12 block1"><span class="label"> ������ / Postal Code</span>
			  <?=$arResult['REQUEST']['�����������������'];?>
			  </div>
			</div>
		  </div>
	  </div>
	  <div class="col-12 block1" > 
	  <div class="row block1 stringHeight  b-t  b-r" style="text-align:center;height:31px">
		  <span class="label">����� / Street Address</span> 
		  <span style="text-align:center;width:100%"><?=$arResult['REQUEST']['����������������'];?></span>
	  </div>
      </div>
  </div>
  
  
  <div class="row column col-4 block1" >
        <div class="column col-1 block1 b-r deliveryTerms" > 
		<span class="deliveryTerms">
	     ������� ��������
	    </span>
		</div>
        <div class="column col-5 block1"   >
		  <div class="column col-12 block1 b-r" >
		  <div class="row block1 stringHeight" style="height:60px">
			  <div class="column col-12 block1">
                        <?=$arResult['REQUEST']['������������������'];?>
			  </div>
		  </div>
		  </div>
		  <div class="column col-12 block1  b-t b-r "   >
		  <div class="row block1 stringHeight" style="height:90px">
			  <div class="column col-12 block1">
					<span class="label">���������</span>
					<span><?=$arResult['REQUEST']['������������������'];?></span>
					<span class="label">��������� � ����</span>
					<span>
					<? //$arResult['REQUEST']['������������������'];?>
					</span>
					<span class="label">��������� �� ����</span>
					<span>
					<? //$arResult['REQUEST']['������������������'];?>
					</span>
			  </div>
		  </div>
		  </div>
		</div>  
        <div class="column col-1 block1 b-r TermsOfPayment" > 
		<span  class="TermsOfPayment">
	     �������  ������
	    </span>
		</div>
		 <div class="column col-5 block1" > 
		  <div class="column col-12 block1" > 
		  <div class="row block1 stringHeight" style="height:40px;"  >
			  <div class="column col-12 block1" >
			    <span class="label">����������</span>
				<?=$arResult['REQUEST']['�����������������'];?>
			  </div>
		  </div>
		  </div>
		  <div class="column col-12 block1 b-t"> 
		  <div class="row block1 stringHeight">
			  <div class="column col-12 block1">
			    <span class="label">������</span>
				<?=$arResult['REQUEST']['����������������'];?>
			  </div>
		  </div>
		  </div>
		</div>
 </div>
</div>
<div class="row block1  b-t b-r b-l"  >
  <div class="column col-8 block1 b-r"   >
	  <div class="b-r recipientBar" >
	  <span class="recipientBar">
	  ����������
	  </span>
	  </div>
	  <div class="row">
		  <div class="column  col-8 block1" >
			<div class="row stringHeight block1left b-r" >
			  <div class="column col-12  block1left">
			   <span class="label2" >������� ���������� / Consignee's Last Name   </span> <?=$arResult['REQUEST']['�����������������'];?> 
			  </div>
			</div>
			<div class="row stringHeight block1left  b-t b-r  b-r" >
			  <div class="column col-12  block1left">
			   <span class="label2" >��������-���������� / Consignee Company </span><?=(strlen($arResult['REQUEST']['������������������'])) ? $arResult['REQUEST']['������������������'] : $arResult['REQUEST']['���������������'];?>
			  </div>
			</div>
			<div class="row stringHeight block1left  b-t b-r  b-r" >
			  <div class="column col-12  block1left">
			   <span class="label2" >������ / Country </span><?=$arResult['REQUEST']['����������������'];?> 
			  </div>
			</div>
			<div class="row stringHeight block1left  b-t b-r  b-r" >
			  <div class="column col-12  block1left">
			   <span class="label2" >����� / City</span><?=$arResult['REQUEST']['���������������'];?>
			  </div>
			</div>
		  </div>
		  <div class="col-4 block1">
			  <div class="row block1 stringHeight"  style="min-height:60px;"  >
			  <div class="column col-12 block1"> <span class="label
			  " style="border:0"> ������� / Phone </span> 
			  <? 
				$strExplode = preg_split('/[;:\\\,]/u', $arResult['REQUEST']['�����������������'], -1, PREG_SPLIT_NO_EMPTY);
					foreach  ($strExplode as $k=>$v){
						  echo $v."<br/>";
					}
			  ?>
			  </div>
			</div>
			<div class="row block1 stringHeight b-t" >
			  <div class="column col-12 block1">
			   <span class="label"> ������� / State </span>
			   <?=$arResult['REQUEST']['�����������������'];?></span>
			  </div>
			</div>
			<div class="row block1 stringHeight b-t">
			  <div class="column col-12 block1"><span class="label"> ������ / Postal Code</span>
			  <?=$arResult['REQUEST']['����������������'];?>
			  </div>
			</div>
		  </div>
		  <div class="col-12 block1" >
			  <div class="row stringHeight block1left b-t" style="text-align:center">
				<span class="label">����� / Street Address</span> <span style="text-align:center;width:100%"><?=$arResult['REQUEST']['���������������'];?></span>
			  </div> 	
		  </div>
	  </div>
  </div>
  <div class="row block1 column col-4 block1" style="line-height:10px;">
   <span class="label" style="border:0;height:1px">
	����������� ���������� / <br/> SPECIAL INSTRUCTIONS: 
   </span>
   <span style="font-size:11px;">
   <?=$arResult['REQUEST']['���������������������'];?>
   </span>
    <div class="col-12 block1">
    <!-- ������ ������� -->
    <div class="row block1 stringHeight" >
    <div class="column col-4 block1 stringHeight b-b b-t b-r" >
      <span class="label"> ����� �� ������</span><?
       if  ($arResult['REQUEST']['������������']!='0'){echo $arResult['REQUEST']['������������'];};?>
    </div>
    <div class="column col-4 block1 stringHeight b-b b-t b-r" >
      <span class="label"> ��������� �����  </span><?
	  if  ($arResult['REQUEST']['��������������']!='0'){echo $arResult['REQUEST']['��������������'];};?>
    </div>
	<div class="column col-4 block1 stringHeight b-b b-t " >
      <span class="label"> ����� � ������ </span><?
	  if  ($arResult['REQUEST']['������������'] !='0') {echo $arResult['REQUEST']['������������'];} ;?>
    </div>
	<div class="column col-12 block1 stringHeight" style="text-align:left;padding-left:10px;height:31px;">
       <span class="label" style="text-align:left;"> ������� � ������� ����������� / Shippers Signature </span> 
	<?
    /* ��� ����� ����������� ��������������� ���������� ���������� ����������� ���� ���������������� ���������  */
    if($arResult['CURRENT_CLIENT_ADDON']['ID']!='49075174'):?>
        <?=$arResult['REQUEST']['������������������'];?>
    <?endif;?>
    </div>
    </div>
    </div>
  </div>
</div>
<div class="row block1 b-r b-l b-b">
  <div class="column col-8 block1"  > 
  <div class=" b-t b-r reviewSender">
  <span class="reviewSender">
  ��������  �����������
  </span>
  </div>
	  <div class="row block1 stringHeight">
		  <div class="column col-5 block1  b-t b-r " ></div>
		  <div class="column col-2 block1  stringHeight b-t b-r " ><span class="label">���� Pieces</span></div>
		  <div class="column col-2 block1  stringHeight b-t b-r " ><span class="label">��� Weight</span></div>
		  <div class="column col-3 block1  b-t b-r " ><span class="label">�������� (�� � �� � ��) <br/> Dimensions (cm x cm x cm)</span></div>
	  </div>
	  
	  <div class="row block1 stringHeight">
		  <div class="column col-5 block1 stringHeight b-t b-r " style="line-height:30px" ><? if ($arResult['REQUEST']['��������']['�������_1']['�������']!='0') {echo $arResult['REQUEST']['��������']['�������_1']['�������'];};?></div>
		  <div class="column col-2 block1 stringHeight b-t b-r " style="line-height:30px" ><? if ($arResult['REQUEST']['��������']['�������_1']['��������������']!='0') {echo $arResult['REQUEST']['��������']['�������_1']['��������������'];};?></div>
		  <div class="column col-2 block1 stringHeight b-t b-r " style="line-height:30px" ><? if ($arResult['REQUEST']['��������']['�������_1']['��������������']!='0') {echo $arResult['REQUEST']['��������']['�������_1']['��������������'];};?></div>
		  <div class="column col-3 block1 stringHeight b-t b-r " style="line-height:30px" ><? if ($arResult['REQUEST']['��������']['�������_1']['sizes']!='0x0x0') {echo $arResult['REQUEST']['��������']['�������_1']['sizes'];};?></div>
	  </div>

	  <div class="row block1 stringHeight">
		  <div class="column col-5 block1 stringHeight b-t b-r " style="line-height:30px" ><? if ($arResult['REQUEST']['��������']['�������_2']['�������']!='0') {echo $arResult['REQUEST']['��������']['�������_2']['�������'];};?></div>
		  <div class="column col-2 block1 stringHeight b-t b-r " style="line-height:30px" ><? if ($arResult['REQUEST']['��������']['�������_2']['��������������']!='0') {echo $arResult['REQUEST']['��������']['�������_2']['��������������'];};?></div>
		  <div class="column col-2 block1 stringHeight b-t b-r " style="line-height:30px" ><? if ($arResult['REQUEST']['��������']['�������_2']['��������������']!='0') {echo $arResult['REQUEST']['��������']['�������_2']['��������������'];};?></div>
		  <div class="column col-3 block1 stringHeight b-t b-r " style="line-height:30px" ><? if ($arResult['REQUEST']['��������']['�������_2']['sizes']!='0x0x0') {echo $arResult['REQUEST']['��������']['�������_2']['sizes'];};?></div>
	  </div>

	  <div class="row block1 stringHeight">
		  <div class="column col-5 block1 stringHeight b-t b-r " style="line-height:30px" ><? if ($arResult['REQUEST']['��������']['�������_3']['�������']!='0') {echo $arResult['REQUEST']['��������']['�������_3']['�������'];};?></div>
		  <div class="column col-2 block1 stringHeight b-t b-r " style="line-height:30px" ><? if ($arResult['REQUEST']['��������']['�������_3']['��������������']!='0'){echo $arResult['REQUEST']['��������']['�������_3']['��������������'];};?></div>
		  <div class="column col-2 block1 stringHeight b-t b-r " style="line-height:30px" ><? if ($arResult['REQUEST']['��������']['�������_3']['��������������']!='0'){echo $arResult['REQUEST']['��������']['�������_3']['��������������'];};?></div>
		  <div class="column col-3 block1 stringHeight b-t b-r " style="line-height:30px" ><? if ($arResult['REQUEST']['��������']['�������_3']['sizes']!='0x0x0'){echo $arResult['REQUEST']['��������']['�������_3']['sizes'];};?></div>
	  </div>

	  <div class="row block1 stringHeight">
		  <div class="column col-5 block1 stringHeight b-t b-r " style="line-height:30px" ><? if ($arResult['REQUEST']['��������']['�������_4']['�������']!='0'){echo $arResult['REQUEST']['��������']['�������_4']['�������'];};?></div>
		  <div class="column col-2 block1 stringHeight b-t b-r " style="line-height:30px" ><? if ($arResult['REQUEST']['��������']['�������_4']['��������������']!='0'){echo $arResult['REQUEST']['��������']['�������_4']['��������������'];};?></div>
		  <div class="column col-2 block1 stringHeight b-t b-r " style="line-height:30px" ><? if ($arResult['REQUEST']['��������']['�������_4']['��������������']!='0'){echo $arResult['REQUEST']['��������']['�������_4']['��������������'];};?></div>
		  <div class="column col-3 block1 stringHeight b-t b-r " style="line-height:30px" ><? if ($arResult['REQUEST']['��������']['�������_4']['sizes']!='0x0x0' ){echo $arResult['REQUEST']['��������']['�������_4']['sizes'];};?></div>
	  </div>
	 
	  <div class="row block1 stringHeight">
		  <div class="column col-5 block1 stringHeight b-t b-r " style="line-height:30px"  ><? if ($arResult['REQUEST']['��������']['�������_5']['�������']!='0'){echo $arResult['REQUEST']['��������']['�������_5']['�������'];};?></div>
		  <div class="column col-2 block1 stringHeight b-t b-r " style="line-height:30px" ><? if ($arResult['REQUEST']['��������']['�������_5']['��������������']!='0'){echo $arResult['REQUEST']['��������']['�������_5']['��������������'];};?></div>
		  <div class="column col-2 block1 stringHeight b-t b-r " style="line-height:30px" ><? if ($arResult['REQUEST']['��������']['�������_5']['��������������']!='0'){echo $arResult['REQUEST']['��������']['�������_5']['��������������'];};?></div>
		  <div class="column col-3 block1 stringHeight b-t b-r " style="line-height:30px" ><? if ($arResult['REQUEST']['��������']['�������_5']['sizes']!='0x0x0'){echo $arResult['REQUEST']['��������']['�������_5']['sizes'];};?></div>
	  </div>
	  
	  <div class="row block1 stringHeight stringHeight1 b-t">
		  <div class="column col-2 block1 b-r"  ><span class="label"> ���� Pieses </span><?=$arResult['REQUEST']['��������������'];?></div>
		  <div class="column col-2 block1 b-r"  ><span class="label"> ��� Weight  </span><?=$arResult['REQUEST']['��������������'];?></div>
		  <div class="column col-2 block1 b-r"  ><span class="label"> �������� ��� Vol. WT  </span><?=$arResult['REQUEST']['����������������������'];?></div>
		  <div class="column col-4 block1 b-r"  ><span class="label"> �����. �����. Control WT</div>
		  <div class="column col-2 block1 b-r"  ><span class="label"> ������. ��������� Declared Value</span><?=$arResult['REQUEST']['��������������������'];?></div>
	  </div>
	  
  </div>
  <div class="col-4 block1 b-t" style="line-height:15px;">
    <div class="row block1 stringHeight">
	<div class="column col-12 block1 b-b" style="height:90px;" >
      <span class="label">������� �������� </span>
    </div>
    <div class="column col-6 block1 b-b b-r" style="height:90px;" >
      <span class="label">���������</span> 
    </div>
    <div class="column col-6 block1 b-b" style="height:90px;">
      <span class="label">������� ���������� </span>
    </div>
	<div class="column col-6 block1 b-r" style="text-align:left;padding-left:5px;height:60px;">
       <span class="label" style="text-align:left;">������� ���������� </span> 
    </div>
	<div class="column col-6 block1" style="text-align:left;padding-left:5px;height:60px;">
       <span class="label" style="text-align:left;">���� � ����� �������� </span> 
    </div>
    </div>
 </div>
</div>
</div>	
</div>
<? }; ?>	
<? }; ?>	
	
	
	
	
	
	
	
	
	
	
 
