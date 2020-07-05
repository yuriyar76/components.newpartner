<?php
use Bitrix\Main\Localization\Loc;
//dump($arResult['LIST']);
?>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div id="mess-profile" class="card-header py-3">
    </div>
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><?= Loc::getMessage('THEAD') ?></h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" >
                <thead>
                <tr>
                    <th><?= Loc::getMessage("NUMBER") ?></th>
                    <th><?= Loc::getMessage("DATE") ?></th>
                    <th><?= Loc::getMessage("TRACKING") ?></th>
                    <th><?= Loc::getMessage("NUMBER_TRACKING") ?></th>
                    <th><?= Loc::getMessage("REAL_STATE") ?></th>
                    <th><?= Loc::getMessage("TYPE_PAY") ?></th>
                    <th><?= Loc::getMessage("TYPE_USER") ?></th>
                    <th><?= Loc::getMessage("SUMM") ?></th>
                    <th><?= Loc::getMessage("WEIGHT") ?></th>
                    <th><?= Loc::getMessage("SENDER") ?></th>
                    <th><?= Loc::getMessage("RECIPIENT") ?></th>
                    <th><?= Loc::getMessage("INSTR") ?></th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th><?= Loc::getMessage("NUMBER") ?></th>
                    <th><?= Loc::getMessage("DATE") ?></th>
                    <th><?= Loc::getMessage("TRACKING") ?></th>
                    <th><?= Loc::getMessage("NUMBER_TRACKING") ?></th>
                    <th><?= Loc::getMessage("REAL_STATE") ?></th>
                    <th><?= Loc::getMessage("TYPE_PAY") ?></th>
                    <th><?= Loc::getMessage("TYPE_USER") ?></th>
                    <th><?= Loc::getMessage("SUMM") ?></th>
                    <th><?= Loc::getMessage("WEIGHT") ?></th>
                    <th><?= Loc::getMessage("SENDER") ?></th>
                    <th><?= Loc::getMessage("RECIPIENT") ?></th>
                    <th><?= Loc::getMessage("INSTR") ?></th>
                </tr>
                </tfoot>
                <tbody>
                <?php foreach($arResult['LIST'] as $key=>$value):?>
                    <tr>
                        <td><?=$value['NAME']?></td>
                        <td><?=$value['DATE_CREATE']?></td>
                        <td>
                            <a  data-number="<?=$value['PROPERTIES']['ID_1C']['VALUE']?>"
                                data-invoice="<?=$value['PROPERTIES']['INVOICE_NUMBER']['VALUE']?>"
                               class="btn btn-secondary btn-icon-split get_pods_fl">
                                    <span class="icon text-white-50">
                                     <i class="fas fa-paper-plane"></i>
                                    </span>
                            </a>
                        </td>
                        <td>
                            <?=$value['PROPERTIES']['INVOICE_NUMBER']['VALUE'];?>
                        </td>
                        <td>
                            <?=$value['PROPERTIES']['STATE_DEV']['VALUE'];?>
                        </td>
                        <?php
                        /* если банковская карта, то показать чек */
                        if($value['PROPERTIES']['TYPE_PAYMENT']['VALUE_ENUM_ID'] === '408'):?>
                            <td>
                                <a href="#" data-toggle="modal" data-target="#CHECK_CARD_<?=$value['ID']?>"
                                   class="btn btn-secondary btn-icon-split">
                                    <span class="icon text-white-50">
                                      <i class="fas fa-arrow-right"></i>
                                    </span>
                                    <span class="text"><?=$value['PROPERTIES']['TYPE_PAYMENT']['VALUE']?></span>
                                </a>
                            </td>
                        <?php else:?>
                            <td><?=$value['PROPERTIES']['TYPE_PAYMENT']['VALUE']?></td>
                        <?php endif;?>
                        <td><?=$value['PROPERTIES']['STATE']['VALUE']?></td>
                        <td><?=$value['PROPERTIES']['SUMM']['VALUE']?></td>
                        <td><?=$value['PROPERTIES']['WEIGHT']['VALUE']?></td>
                        <td>
                            <a href="#" data-toggle="modal" data-target="#NameSENDER_<?=$value['ID']?>"
                               class="btn btn-primary btn-icon-split">
                                <span class="icon text-white-50">
                                  <i class="fas fa-arrow-right"></i>
                                </span>
                                <span class="text"><?=$value['PROPERTIES']['NAME_SENDER']['VALUE']?></span>
                            </a>
                        </td>
                        <td>
                            <a href="#" data-toggle="modal" data-target="#NameRECIPIENT_<?=$value['ID']?>"
                            class="btn btn-primary btn-icon-split">
                                <span class="icon text-white-50">
                                   <i class="fas fa-arrow-right"></i>
                                </span>
                                <span class="text"><?=$value['PROPERTIES']['NAME_RECIPIENT']['VALUE']?></span>
                            </a>
                        </td>
                        <td>
                         <a  data-toggle="modal" data-target="#INSTR_<?=$value['ID']?>" href="#" class="btn btn-info btn-icon-split">
                            <span class="icon text-white-50">
                              <i class="fas fa-info-circle"></i>
                            </span>
                          </a>
                        </td>
                       </tr>
                    <div class="modal fade " id="NameSENDER_<?=$value['ID']?>" data-backdrop="static" data-keyboard="false"
                         tabindex="-1" role="dialog" aria-labelledby="NameSENDER_<?=$value['ID']?>" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="NameSENDER_<?=$value['ID']?>"><?= Loc::getMessage("DATA_SENDER") ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                     <?php

                                          $id_city_sender = $value['PROPERTIES']['CITY_SENDER']['VALUE'];
                                          //$id_city_recipient = $value['PROPERTIES']['CITY_RECIPIENT']['VALUE'];
                                          $arrCitySender = GetInfoArr(false, $id_city_sender,
                                              6);
                                          //$arrCityRecipient = GetInfoArr(false, $id_city_recipient,6);
                                          $city_sender = $arrCitySender['NAME'].' '.$arrCitySender['SECTION_NAME'];
                                          //$city_recipient = $arrCityRecipient['NAME'].' '.$arrCityRecipient['SECTION_NAME'];
                                     ?>
                                    <div class="col-md-12">
                                        <div class="card border-left-primary shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?= Loc::getMessage("CITY") ?></div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$city_sender?></div>
                                                        <br>
                                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?= Loc::getMessage("ADRESS") ?></div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$value['PROPERTIES']['ADRESS_SENDER']['VALUE']?></div>
                                                        <br>
                                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?= Loc::getMessage("PHONE") ?></div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$value['PROPERTIES']['PHONE_SENDER']['VALUE']?></div>
                                                    </div>
                                                    <div class="col-auto">
                                                          <i class="far fa-address-card fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="#" data-dismiss="modal" class="btn btn-primary btn-icon-split">
                                        <span class="icon text-white-50">
                                          <i class="fas fa-times-circle"></i>
                                        </span>
                                        <span class="text"><?= Loc::getMessage("CLOSE") ?></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade " id="NameRECIPIENT_<?=$value['ID']?>" data-backdrop="static" data-keyboard="false"
                         tabindex="-1" role="dialog" aria-labelledby="NameSENDER_<?=$value['ID']?>" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="NameSENDER_<?=$value['ID']?>"><?= Loc::getMessage("DATA_RECIPIENT") ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <?php

                                    //$id_city_sender = $value['PROPERTIES']['CITY_SENDER']['VALUE'];
                                    $id_city_recipient = $value['PROPERTIES']['CITY_RECIPIENT']['VALUE'];
                                    //$arrCitySender = GetInfoArr(false, $id_city_sender,
                                       // 6);
                                    $arrCityRecipient = GetInfoArr(false, $id_city_recipient,6);
                                    //$city_sender = $arrCitySender['NAME'].' '.$arrCitySender['SECTION_NAME'];
                                    $city_recipient = $arrCityRecipient['NAME'].' '.$arrCityRecipient['SECTION_NAME'];
                                    ?>
                                    <div class="col-md-12">
                                        <div class="card border-left-primary shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?= Loc::getMessage("CITY") ?></div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$city_recipient?></div>
                                                        <br>
                                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?= Loc::getMessage("ADRESS") ?></div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$value['PROPERTIES']['ADRESS_RECIPIENT']['VALUE']?></div>
                                                        <br>
                                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?= Loc::getMessage("PHONE") ?></div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$value['PROPERTIES']['PHONE_RECIPIENT']['VALUE']?></div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="far fa-address-card fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               <div class="modal-footer">
                                   <a href="#" data-dismiss="modal" class="btn btn-primary btn-icon-split">
                                        <span class="icon text-white-50">
                                          <i class="fas fa-times-circle"></i>
                                        </span>
                                       <span class="text"><?= Loc::getMessage("CLOSE") ?></span>
                                   </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade " id="INSTR_<?=$value['ID']?>" data-backdrop="static" data-keyboard="false"
                         tabindex="-1" role="dialog" aria-labelledby="INSTR_<?=$value['ID']?>" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="INSTR_<?=$value['ID']?>"><?= Loc::getMessage("INSTR_COURIER") ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12">
                                        <div class="card border-left-primary shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-primary text-uppercase
                                                        mb-1"><?=$value['PROPERTIES']['INSTRUCTIONS']['VALUE']?></div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-file-signature fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               <div class="modal-footer">
                                  <!--  <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>-->
                                   <a href="#" data-dismiss="modal" class="btn btn-primary btn-icon-split">
                                        <span class="icon text-white-50">
                                          <i class="fas fa-times-circle"></i>
                                        </span>
                                        <span class="text"><?= Loc::getMessage("CLOSE") ?></span>
                                   </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade " id="CHECK_CARD_<?=$value['ID']?>" data-backdrop="static" data-keyboard="false"
                         tabindex="-1" role="dialog" aria-labelledby="CHECK_CARD_<?=$value['ID']?>" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="CHECK_CARD_<?=$value['ID']?>"><?= Loc::getMessage("CHECK") ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12">
                                        <div class="card border-left-primary shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-primary text-uppercase
                                                        mb-1"><?=$value['PROPERTIES']['CHECK']['VALUE']?></div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-money-check-alt fa-2x text-gray-300"></i>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <!--  <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>-->
                                    <a href="#" data-dismiss="modal" class="btn btn-primary btn-icon-split">
                                        <span class="icon text-white-50">
                                          <i class="fas fa-times-circle"></i>
                                        </span>
                                        <span class="text"><?= Loc::getMessage("CLOSE") ?></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
