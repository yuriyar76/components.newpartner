<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
{
    die();
}
use Bitrix\Main\Localization\Loc;
?>
<?//dump($arResult)?>
<div class="card shadow mb-4">
    <div id="mess-profile" class="card-header py-3"></div>

    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><?= Loc::getMessage('THEAD') ?></h6>
        <div class="row d-flex flex-row justify-content-end">
            <button data-toggle="modal" data-target="#add_modal_sender"
                    class="btn btn-primary btn-icon-split">
                                           <span class="icon text-white-50">
                                             <i class="fas fa-arrow-right"></i>
                                           </span>
                <span class="text"><?= Loc::getMessage("NEW_SENDER") ?></span>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <form id="dataTable_form" action="/tools/change_user_fl.php?default=Y&sender_add=Y" method="post">
            <table class="table table-bordered" id="dataTable" >
                <thead>
                <tr>
                    <th><?= Loc::getMessage("FIO_SENDER") ?></th>
                    <th><?= Loc::getMessage("PHONE_SENDER") ?></th>
                    <th><?= Loc::getMessage("ADRESS_SENDER") ?></th>
                    <th><?= Loc::getMessage("DEFAULT") ?></th>
                    <th>Изменить</th>
                    <th>Удалить</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th><?= Loc::getMessage("FIO_SENDER") ?></th>
                    <th><?= Loc::getMessage("PHONE_SENDER") ?></th>
                    <th><?= Loc::getMessage("ADRESS_SENDER") ?></th>
                    <th><?= Loc::getMessage("DEFAULT") ?></th>
                    <th>Изменить</th>
                    <th>Удалить</th>
                </tr>
                </tfoot>
                <tbody >
                <?php foreach($arResult['LIST'] as $key=>$value):?>
                    <tr>
                        <td><?=$value['NAME']?></td>
                        <td>
                            <?=$value['PROPERTIES']['PHONE']['VALUE'];?>
                        </td>
                        <td>
                            <?=$value['PROPERTIES']['ADRESS']['VALUE'];?>
                        </td>
                        <td class="d-flex flex-row justify-content-center">
                            <div>
                                <input id="radio_<?=$key?>" type="radio" name="DEFAULT"

                                       <?php if($value['PROPERTIES']['DEFAULT']['VALUE']==1){
                                         echo " checked='checked'";
                                             }
                                        ?>>
                                <?php if($value['PROPERTIES']['DEFAULT']['VALUE']==1):?>
                                <input type="hidden" name="ID_OLD" value="<?=$value['ID']?>">
                                <?php endif;?>
                                <input type="hidden" name="ID_<?=$key?>" value="<?=$value['ID']?>">
                            </div>
                        </td>
                        <td>
                            <i style="color:#0f6fe5; font-size: 20px;" class="fas fa-edit"></i>
                        </td>
                        <td>
                            <i style="color:#710404; font-size: 20px;" class="fas fa-trash-alt"></i>
                        </td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
                <input style="width: 0; height: 0; border: 0" id="dataTable_form_submit"  type="submit">
            </form>
        </div>
    </div>
</div>


