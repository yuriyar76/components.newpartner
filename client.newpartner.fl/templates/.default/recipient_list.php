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
            <button data-toggle="modal" data-target="#add_modal_recipient"
                    class="btn btn-primary btn-icon-split">
                                           <span class="icon text-white-50">
                                             <i class="fas fa-arrow-right"></i>
                                           </span>
                <span class="text"><?= Loc::getMessage("NEW_RECIPIENT") ?></span>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <form id="dataTable_form" action="/tools/change_user_fl.php?default=Y&recipient_add=Y" method="post">
                <table class="table table-bordered" id="dataTableS">
                    <thead>
                    <tr>
                        <th><?= Loc::getMessage("FIO_RECIPIENT") ?></th>
                        <th><?= Loc::getMessage("PHONE_RECIPIENT") ?></th>
                        <th><?= Loc::getMessage("CITY_RECIPIENT") ?></th>
                        <th><?= Loc::getMessage("ADRESS_RECIPIENT") ?></th>
                        <th><?= Loc::getMessage("DEFAULT") ?></th>
                        <th>Изменить</th>
                        <th>Удалить</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th><?= Loc::getMessage("FIO_RECIPIENT") ?></th>
                        <th><?= Loc::getMessage("PHONE_RECIPIENT") ?></th>
                        <th><?= Loc::getMessage("CITY_RECIPIENT") ?></th>
                        <th><?= Loc::getMessage("ADRESS_RECIPIENT") ?></th>
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
                            <?=$value['PROPERTIES']['CITY']['NAME'];?>
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

                                <input type="hidden" name="ID_<?=$key?>" value="<?=$value['ID']?>">
                            </div>
                        </td>
                <td>
                    <i data-toggle="modal" data-target="#editBtn_<?=$value['ID']?>" style="color:#0f6fe5;
                font-size: 20px; cursor:pointer" class="fas fa-edit"></i>
                    <!-- Modal -->
                    <div class="modal fade form-edit" data-backdrop="static" id="editBtn_<?=$value['ID']?>" tabindex="-1"
                         role="dialog" aria-labelledby="editBtn_<?=$value['ID']?> " aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div id='form-edit_<?=$value['ID']?>' class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Изменение данных получателя <?=$value['NAME']?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="err_edit"></div>
                                    <div class="form-group">
                                        <label for="InputFIO_<?=$value['ID']?>">ФИО Получателя <span style="color:red">*</span> </label>
                                        <input required name="InputFIO_<?=$value['ID']?>"
                                               value="<?=$value['NAME']?>" type="text" class="form-control"
                                               id="InputFIO_<?=$value['ID']?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="InputPhone_<?=$value['ID']?>">Телефон получателя <span style="color:red">*</span></label>
                                        <input required name="InputPhone_<?=$value['ID']?>"
                                               value="<?=$value['PROPERTIES']['PHONE']['VALUE'];?>" type="text"
                                               class="form-control" id="InputPhone_<?=$value['ID']?>">
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <input name="CityId_<?=$value['ID']?>" id="citycode_<?=$value['ID']?>"
                                               value="<?=$value['PROPERTIES']['CITY']['VALUE']?>" type="hidden"
                                        >
                                        <label for="city_<?=$value['ID']?>" class="control-label">Город получателя<span
                                                class="form-required">*</span></label>
                                        <input id="city_<?=$value['ID']?>" type="text" name="City_<?=$value['ID']?>"
                                               onclick="return auto_city_send('<?=$value['ID']?>')"
                                               class="form-control autocity ui-autocomplete-input"  required
                                               value="<?=$value['PROPERTIES']['CITY']['NAME']?>" >
                                        <small>Начинайте вводить название города, выберете из выпадающего списка</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="InputAdr_<?=$value['ID']?>">Адрес получателя <span style="color:red">*</span></label>
                                        <input required name="InputAdr_<?=$value['ID']?>"
                                               value="<?=$value['PROPERTIES']['ADRESS']['VALUE'];?>"
                                               type="text" class="form-control" id="InputAdr_<?=$value['ID']?>">
                                    </div>
                                    <input name="modalId" value="editBtn_<?=$value['ID']?>"
                                           type="hidden">
                                    <?=bitrix_sessid_post()?>
                                    <input id="ID_<?=$value['ID']?>" name="ID_<?=$value['ID']?>" value="<?=$value['ID']?>" type="hidden">
                                </div>

                                <div class="modal-footer">
                                    <button type="button" data-dismiss="modal" class="btn btn-secondary btn-icon-split">
                                        <span class="icon text-white-50">
                                          <i class="fas fa-times-circle"></i>
                                        </span>
                                        <span class="text">Закрыть</span>
                                    </button>
                                    <button  onclick="return editItem('form-edit_<?=$value["ID"]?>')"
                                             type="button"  class="btn btn-success btn-icon-split">
                                            <span  class="icon text-white-50">
                                              <i class="far fa-check-circle"></i>
                                            </span>
                                        <span class="text">Изменить</span>
                                    </button>
                                </div>

                                 </div>
                        </div>
                    </div>
                </td>
                <td>
                    <i data-toggle="modal" data-target="#trashBtn_<?=$value['ID']?>"
                       style="color:#710404; font-size: 20px; cursor:pointer" class="fas fa-trash-alt"></i>
                    <!-- Modal -->
                    <div class="modal fade form-del" data-backdrop="static" id="trashBtn_<?=$value['ID']?>" tabindex="-1"
                         role="dialog" aria-labelledby="trashBtn" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <h2 style="color:#840707">Удалить?</h2>
                                    <small>Получатель <?=$value['NAME']?> будет удален из справочника</small>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" data-dismiss="modal" class="btn btn-secondary btn-icon-split">
                            <span class="icon text-white-50">
                              <i class="fas fa-times-circle"></i>
                            </span>
                                        <span class="text">Не удалять</span>
                                    </button>
                                    <button  onclick="return delItem('<?=$value['ID']?>', '<?=bitrix_sessid()?>')"
                                             type="button"  class="btn btn-danger btn-icon-split">
                            <span  class="icon text-white-50">
                              <i class="fas fa-trash-alt"></i>
                            </span>
                                        <span class="text">Удалить</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
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




