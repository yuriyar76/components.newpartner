<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();


use Bitrix\Main\Context;
use Bitrix\Main\Localization\Loc;

$req = Context::getCurrent()->getRequest();
$id_partner = 27122866;  /* id ук новый партнер */
require_once __DIR__.'/functions.php';
$sessid = bitrix_sessid();
$component_id = 113;
include_once($_SERVER['DOCUMENT_ROOT']."/bitrix/components/black_mist/delivery.packages/functions.php");
global $USER;
$id_user = $USER->GetID();
if ($id_user && $USER->Authorize($id_user) ){
    function GetCity(&$arList){

        foreach ($arList as $key=>$value){
            if(empty($value['PROPERTIES']['CITY']['VALUE'])) continue;
            $id_city = (int)$value['PROPERTIES']['CITY']['VALUE'];
            $res = CIBlockElement::GetByID($id_city);
            $arr_city = $res->Fetch();
            if(!empty($arr_city['NAME'])){
                $arList[$key]['PROPERTIES']['CITY']['NAME'] = $arr_city['NAME'];
            }


        }
    }
    $arrUsr = UserData($id_user);
    $USER_CURRENT = [
      'email' =>  $USER->GetEmail(),
      'name' =>   $USER->GetFirstName(),
      'lastName' => $USER->GetLastName(),
      'phone' =>  $arrUsr[0]['PERSONAL_PHONE'],
      'adress' => $arrUsr[0]['PERSONAL_STREET']
    ];
    $arResult['USER'] = $USER_CURRENT;
    $_SESSION['form_mail'] =  trim($USER_CURRENT['email']);
    $_SESSION['user_current'] =   $USER_CURRENT;


    /* общий массив для выбора данных из инфоблоков*/
    $arSelect = [
        "NAME",
        "DATE_CREATE",
        "IBLOCK_ID",
        "ID",
        "PROPERTY_*",
    ];
    /* массив отправителей для выбора при оформлении новой заявки*/
    $arFilter = [
        'PROPERTY_966' => $id_user,
        'ACTIVE' => 'Y',
        'PROPERTY_967' => 414,
    ];
    $arList = GetInfoArr(false, false, 114, $arSelect, $arFilter, false );

    if (!empty($arList)){
        foreach($arList as $key=>$value){
            $arResult['SENDERS'][$key] = [
                "ID"   => $value['ID'],
                "NAME" => trim($value['NAME']),
                'PHONE' => $value['PROPERTIES']['PHONE']['VALUE'],
                'CITY' => $value['PROPERTIES']['CITY']['VALUE'],
                'ADRESS' => $value['PROPERTIES']['ADRESS']['VALUE'],
            ];
        }
         $_SESSION['SENDERS'] = $arResult['SENDERS'];
    }
    /* массив отправители-получатели с учетом города для передачи в модальное окно оформления новой заявки */
    if ($req->getQuery('invoice') === "Y"){

        $arResult['SENDERS'] = [];
        $arResult['RECIPIENTS'] = [];
        $arResult['DEFAULT_RECIPIENT'] = [];
        $arResult['DEFAULT_SENDER'] = [];
        $arRes = $_POST;
        foreach($arRes as $key=>$value){
            $arResult[$key] = iconv('utf-8', 'windows-1251', htmlspecialcharsEx($value));
        }
        $id_city_sender =  (int)$arResult['citycode_0'];
        $id_city_recipient = (int)$arResult['citycode_1'];

        /* отправители */

        $arFilter = [
            'PROPERTY_966' => $id_user,
            'ACTIVE' => 'Y',
            'PROPERTY_967' => 414,
            '=PROPERTY_974' => $id_city_sender,
        ];

        $arList = GetInfoArr(false, false, 114, $arSelect, $arFilter, false );

        if(!empty($arList)){
            foreach($arList as $key=>$value){
                $arResult['SENDERS'][$key] = [
                    "ID"   => (int)$value['ID'],
                    "NAME" => trim($value['NAME']),
                    'PHONE' => $value['PROPERTIES']['PHONE']['VALUE'],
                    'CITY' => (int)$value['PROPERTIES']['CITY']['VALUE'],
                    'ADRESS' => $value['PROPERTIES']['ADRESS']['VALUE'],
                ];
            }

        }

        /* записать отправителя по умолчанию если есть */

        $arFilter = [
            'PROPERTY_966' => $id_user,
            'ACTIVE' => 'Y',
            'PROPERTY_972' => '1',
            'PROPERTY_967' => 414,
            '=PROPERTY_974' => $id_city_sender,
        ];


        $arList = GetInfoArr(false, false, 114, $arSelect, $arFilter, false );
        if( !empty($arList[0]['NAME'])){
            $id_sender = $arList[0]['ID'];
            $name_sender = $arList[0]['NAME'];
            $phone_sender = $arList[0]['PROPERTIES']['PHONE']['VALUE'];
            $adress_sender = $arList[0]['PROPERTIES']['ADRESS']['VALUE'];
            $city_sender = $arList[0]['PROPERTIES']['CITY']['VALUE'];
            $arResult['DEFAULT_SENDER'] = [
                'ID' => $id_sender,
                'NAME' => $name_sender,
                'PHONE' => $phone_sender,
                'CITY' => $city_sender,
                'ADRESS' => $adress_sender
            ];

        }

        /* получатели */

        $arFilter = [
            'PROPERTY_966' => $id_user,
            'ACTIVE' => 'Y',
            'PROPERTY_967' => 415,
            '=PROPERTY_974' => $id_city_recipient,
        ];

        $arList = GetInfoArr(false, false, 114, $arSelect, $arFilter, false );
        if(!empty($arList)){
            foreach($arList as $key=>$value){
                $arResult['RECIPIENTS'][$key] = [
                    "ID"   => $value['ID'],
                    "NAME" => trim($value['NAME']),
                    'PHONE' => $value['PROPERTIES']['PHONE']['VALUE'],
                    'CITY' => $value['PROPERTIES']['CITY']['VALUE'],
                    'ADRESS' => $value['PROPERTIES']['ADRESS']['VALUE'],
                ];
            }

        }
        /* записать получателя по умолчанию если есть */

        $arFilter = [
            'PROPERTY_966' => $id_user,
            'ACTIVE' => 'Y',
            'PROPERTY_972' => '1',
            'PROPERTY_967' => 415,
            '=PROPERTY_974' => $id_city_recipient,
        ];


        $arList = GetInfoArr(false, false, 114, $arSelect, $arFilter, false );
        if( !empty($arList[0]['NAME'])){
            $id_recipient = $arList[0]['ID'];
            $name_recipient = $arList[0]['NAME'];
            $phone_recipient = $arList[0]['PROPERTIES']['PHONE']['VALUE'];
            $adress_recipient = $arList[0]['PROPERTIES']['ADRESS']['VALUE'];
            $city_recipient = $arList[0]['PROPERTIES']['CITY']['VALUE'];

            $arResult['DEFAULT_RECIPIENT'] = [
                'ID' => $id_recipient,
                'NAME' => $name_recipient,
                'PHONE' => $phone_recipient,
                'CITY' => $city_recipient,
                'ADRESS' => $adress_recipient
            ];
        }
        $req = [
            'default_sender'=> $arResult['DEFAULT_SENDER'],
            'default_recipient'=> $arResult['DEFAULT_RECIPIENT'],
            'senders' => $arResult['SENDERS'],
            'recipients' => $arResult['RECIPIENTS'],
            'user' => $arResult['USER'],
        ];
        $request = convArrayToUTF($req);
        echo json_encode($request);
        exit;
    }
    /* запрос в 1с за треком отправления */
    if ($req->getQuery('number')){
        $result_pod_arr = [];
        $client = soap_inc();
        $number = htmlspecialcharsEx($_GET['number']);
        $result_status = $client->GetDocsStatus(['ID'=>$number]);
        $mResult = $result_status->return;
        $result_obj = json_decode($mResult, true);
        if(is_array($result_obj)){
            $invoice_number = $result_obj['INVOICE_NUMBER'];
            if($invoice_number){
                $result_pod = $client->GetPods(['NumDocs'=>$invoice_number]);
                $mResult_pod = $result_pod->return;
                if($mResult_pod){
                    $result_pod_arr = json_decode($mResult_pod, true);
                    $result_pod_arr['Documents']['Document_1']['Events']['Event_0'] = $result_obj;
                }
            }else{
                $result_pod_arr['Documents']['Document_1']['Events']['Event_0'] = $result_obj;
            }
            AddToLogs('TRACK', ['Response'=> $result_pod_arr]);
        }
        else{
            $result_pod_arr['ERROR'] = iconv('windows-1251','utf-8',"ERROR");
        }
        if($result_pod_arr['Documents']['Document_1']['Events'])ksort($result_pod_arr['Documents']['Document_1']['Events']);
        $request = [
            $result_pod_arr
        ];
        echo json_encode($request);
        exit;
    }
    /* удаление записи в таблице Отправители - получатели */
    if ($req->getQuery('delete') === 'Y') {

        if($_POST['sess_id'] === $sessid){
            $id_item = (int)$_POST['id'];
            $el = new CIBlockElement;
            if($el->Update($id_item, ['ACTIVE'=>"N"])){
                $req = iconv('windows-1251', 'utf-8', "ok");
                $request = [
                    'mess' => $req,
                    "change"=>1
                ];
             }else{
                $req = iconv('windows-1251', 'utf-8', "no");
                $request = [
                    'messerr' => $req,
                    "change"=>0
                ];
            }
            echo json_encode($request);
            exit;
        }
            exit;

     }
    /* изменение справочника отправители-получатели */
    if ($req->getQuery('edit') === 'Y'){
        $arResult = [];
        $arRes = json_decode($_POST['form_data'], true);
            if(!empty($arRes) && $arRes['sessid'] === $sessid){
            $id_modal = trim(htmlspecialcharsEx($arRes['modalId']));
            foreach($arRes as $key=>$value){
                $key_arr = preg_replace('/_[0-9]+$/','', $key);
                $arResult[$key_arr] = iconv('utf-8', 'windows-1251', $value);
            }
            $id_modal = 'editBtn_'.preg_replace('/[a-z]+_{1}/i','', $key);
            $id_item = (int)$arResult['ID'];
            $el = new CIBlockElement;
            if(!empty($arResult['InputFIO'])){
                $el->Update($id_item, ['NAME'=>$arResult['InputFIO']]);
                if(!empty($arResult['CityId'])) {
                    $city_new = (int)$arResult['CityId'];
                     if (!empty($arResult['InputAdr'])) {
                        $adr_new = $arResult['InputAdr'];
                        if (!empty($arResult['InputPhone'])) {

                                if (!preg_match('/[+\s()\d-]{8,20}/', $arResult['InputPhone'])) {
                                    $req = iconv('windows-1251', 'utf-8',
                                        Loc::getMessage('ERR_ADD_PHONE_V'));
                                    $request = [
                                        'id' => $id_modal,
                                        'messerr' => $req,
                                        "change" => 0
                                    ];
                                    echo json_encode($request);
                                    exit;
                                }


                                    $phone_new = $arResult['InputPhone'];
                            $arrUpdate = [
                                969 => $phone_new,
                                971 => $adr_new,
                                974 => $city_new
                            ];
                            CIBlockElement::SetPropertyValuesEx($id_item, 114, $arrUpdate);
                            $req = iconv('windows-1251', 'utf-8',
                                "Успешно внесены изменения в справочник.");
                            $request = [
                                'id' => $id_modal,
                                'mess' => $req,
                                "change" => 1
                            ];
                            echo json_encode($request);
                            exit;
                        } else {
                            $req = iconv('windows-1251', 'utf-8',
                                "Не заполнено обязательное поле Телефон");
                            $request = [
                                'id' => $id_modal,
                                'messerr' => $req,
                                "change" => 0
                            ];
                        }
                    } else {
                        $req = iconv('windows-1251', 'utf-8',
                            "Не заполнено обязательное поле Адрес");
                        $request = [
                            'id' => $id_modal,
                            'messerr' => $req,
                            "change" => 0
                        ];
                    }
                } else {
                    $req = iconv('windows-1251', 'utf-8',
                        "Поле Город не заполнено или заполнено не верно");
                    $request = [
                        'id' => $id_modal,
                        'messerr' => $req,
                        "change" => 0
                    ];
                }
            }else{
                $req =  iconv('windows-1251', 'utf-8',
                    "Не заполнено обязательное поле ФИО");
                $request = [
                    'id' => $id_modal,
                    'messerr' => $req,
                    "change"=>0
                ];
            }
        }else{
            $req =  iconv('windows-1251', 'utf-8',
                "Общая ошибка");
            $request = [
                'messerr' => $req,
                "change"=>0
            ];
        }
        echo json_encode($request);
        exit;

    }
    /* изменение профиля пользователя */
    if ($req->getQuery('change') == $id_user){
        if(!empty($_POST['form_data'])&&$_POST['form_data'][0]['value']==$sessid){
            foreach($_POST['form_data'] as $key=>$value){
                $arResult[$_POST['form_data'][$key]['name']] = trim(htmlspecialcharsEx($value['value']));
            }
            $arResult = arFromUtfToWin($arResult);
              if($arResult['NAME'] && $arResult['EMAIL']){
                $user_up = new CUser;
                if(!empty($arResult['PASSWORD'])&&!empty($arResult['CONFIRM_PASSWORD'])&&!empty($arResult['EMAIL'])){
                    if($arResult['PASSWORD']===$arResult['CONFIRM_PASSWORD']){
                        $arPolicy = CUser::GetGroupPolicy($id_user);
                        $passwordErrors = CUser::CheckPasswordAgainstPolicy($arResult['PASSWORD'], $arPolicy);
                        if (!empty($passwordErrors)){
                            echo json_encode(["MESSAGE_ERROR"=>"Invalid password format!"]);
                        }

                        $fields = [
                            "EMAIL"   => $arResult['EMAIL'],
                            'PASSWORD'=>$arResult['PASSWORD'],
                            'CONFIRM_PASSWORD'=>$arResult['CONFIRM_PASSWORD'],
                            "ACTIVE"  => "Y",
                        ];
                        $user_up->Update($id_user, $fields, false);
                    }
                }
                $fields = [
                    "NAME"              => $arResult['NAME'],
                    "LAST_NAME"         => $arResult['LAST_NAME'],
                    "SECOND_NAME"       => $arResult['SECOND_NAME'],
                    "EMAIL"             => $arResult['EMAIL'],
                    "LID"               => "ru",
                    "ACTIVE"            => "Y",
                    "GROUP_ID"          => [3,29],
                    "PERSONAL_PHONE"    => (string)$arResult['PERSONAL_PHONE'],
                    "PERSONAL_STREET"   => (string)$arResult['PERSONAL_STREET']
                ];
                 $user_up->Update($id_user, $fields, false);
                if($user_up->LAST_ERROR){
                    $user_err = $user_up->LAST_ERROR;
                    $req =  iconv('windows-1251', 'utf-8',$user_err);
                    $request = [
                        'messerr' => $req,
                        "change"=>0
                    ];
                 }else{
                    $req =  iconv('windows-1251', 'utf-8',
                        Loc::getMessage('CHANGE'));
                    $request = [
                        "mess"=>$req,
                        "change"=>1
                    ];
                }
            }else{
                $req =  iconv('windows-1251', 'utf-8','Поля обязательные к заполнению - Имя и EMAIL!');
                $request = [
                    'messerr' => $req,
                    "change"=>0
                ];
            }
            echo json_encode($request);
            exit;
         }
    }
    /* отправитель-получатель по умолчанию */
    if ($req->getQuery('default') === "Y" && ($req->getQuery('sender_add') === 'Y' ||
            $req->getQuery('recipient_add') ==='Y')){
        $id_item = 0;
        $type = 0;
        if($req->getQuery('sender_add') === 'Y'){
            $type = 414;
        }
        if($req->getQuery('recipient_add') === 'Y'){
            $type = 415;
        }
        foreach($_POST['form_data'] as $key=>$value){
            if($id_item>0)break;
            $_POST['form_data'][$key]['name'] = trim(htmlspecialcharsEx($value['name']));
            $_POST['form_data'][$key]['value'] = trim(htmlspecialcharsEx($value['value']));
            if($value['name'] === 'DEFAULT' && ($value['value'] === 'on' || $value['value'] === '1') ){
                $id_item = $_POST['form_data'][++$key]['value'];
            }
        }
        /* снять отметку default если есть */
        $arFilter = [
            'PROPERTY_966' => $id_user,
            'ACTIVE' => 'Y',
            'PROPERTY_972' => '1',
            'PROPERTY_967' => $type,
        ];


        $arList = GetInfoArr(false, false, 114, $arSelect, $arFilter, false );
        foreach($arList as $key=>$value){
            $id_old = (int)$arList[$key]['ID'];
            if($id_old>0) {
                CIBlockElement::SetPropertyValuesEx($id_old, 114,
                    [
                        972 => 0
                    ]
                );
            }
        }

        if($id_item>0) {
            CIBlockElement::SetPropertyValuesEx($id_item, 114,
                [
                    972 => 1
                ]
            );
        }
        $request = [
            'id' => $id_item,
        ];
        echo json_encode($request);
        exit;

    }
    /* добавление нового отправителя-получателя */
    if (($req->getQuery('sender_add') === 'Y' || $req->getQuery('recipient_add') === 'Y') &&
        $req->getQuery('newsender') == $id_user){
        if(!empty($_POST['form_data']) && $_POST['form_data'][0]['value'] === $sessid){
            $type = 0;
            if($req->getQuery('sender_add') === 'Y')$type = 414;
            if($req->getQuery('recipient_add') === 'Y')$type = 415;
             foreach($_POST['form_data'] as $key=>$value){
                $arResult[$_POST['form_data'][$key]['name']] = trim(htmlspecialcharsEx($value['value']));
            }
            $arResult = arFromUtfToWin($arResult);
            if(!empty($arResult['PHONE'])){
               if( !preg_match('/[+\s()\d-]{8,20}/', $arResult['PHONE'])){
                   $req =  iconv('windows-1251', 'utf-8',
                       Loc::getMessage('ERR_ADD_PHONE_V'));
                   $request = [
                       'messerr' => $req,
                       "change"=>0
                   ];
                   echo json_encode($request);
                   exit;
               }
            }
            if(empty($arResult['PHONE'])){
                $req =  iconv('windows-1251', 'utf-8',
                    Loc::getMessage('ERR_ADD_PHONE'));
                $request = [
                    'messerr' => $req,
                    "change"=>0
                ];
                echo json_encode($request);
                exit;
            }
            if(empty($arResult['ADRESS'])){
                $req =  iconv('windows-1251', 'utf-8',
                    Loc::getMessage('ERR_ADD_ADRESS'));
                $request = [
                    'messerr' => $req,
                    "change"=>0
                ];
                echo json_encode($request);
                exit;
            }
            if(empty($arResult['CITY_ID'])){
                $req =  iconv('windows-1251', 'utf-8',
                    Loc::getMessage('ERR_ADD_CITY'));
                $request = [
                    'messerr' => $req,
                    "change"=>0
                ];
                echo json_encode($request);
                exit;
            }
            $property = [
                966 => $id_user,
                967 => $type,
                969 => $arResult['PHONE'],
                971 => $arResult['ADRESS'],
                974 => $arResult['CITY_ID'],
            ];
            $arLoadArray = [
                "IBLOCK_ID" => 114,
                "NAME"  => $arResult['NAME'],
                "ACTIVE" => "Y",
                "PROPERTY_VALUES"=> $property,
            ];
            $el = new CIBlockElement;
            $id_sender = $el->Add($arLoadArray);

            if( $id_sender){
                $req =  iconv('windows-1251', 'utf-8',
                    Loc::getMessage('ADD_SENDER'));
                $request = [
                    'mess' => $req,
                    "change"=>1
                ];
            }else{
                $req =  iconv('windows-1251', 'utf-8',
                    Loc::getMessage('ERR_ADD'));
                $request = [
                    'messerr' => $req,
                    "change"=>0
                ];
            }
            echo json_encode($request);
            exit;
        }

    }
    /* выбор данных отправителя-получателя по запросу из новой заявки */
    if (!empty($req->getQuery('getid'))){
        $id_el = (int)$req->getQuery('getid');
         $arFilter = [];
         $arSelect = [
             "NAME",
             "DATE_CREATE",
             "IBLOCK_ID",
             "ID",
         ];
         $arList = GetInfoArr(false, $id_el, 114, $arSelect, $arFilter, false );
         $arRes = convArrayToUTF($arList);
         $req = [
             'NAME' => $arList[0]['NAME'],
             "PHONE" => $arList[0]['PROPERTIES']['PHONE']['VALUE'],
             "ADRESS" => $arList[0]['PROPERTIES']['ADRESS']['VALUE'],
             "DEFAULT" => $arList[0]['PROPERTIES']['DEFAULT']['VALUE'],
             "TYPE_ID" => $arList[0]['PROPERTIES']['TYPE']['VALUE_ENUM_ID'],
             "TYPE" =>  $arList[0]['PROPERTIES']['TYPE']['VALUE_ENUM'],
         ];
         $request = convArrayToUTF($req);
         echo json_encode($request);
         exit;
      }
    /* отменить дефолтного отправителя-получателя */
    if ($req->getQuery('ban') === 'Y'){
        $id_item = (int)$_POST['id'];
        $key_item = (int)$_POST['key'];
        if( $id_item>0){
            CIBlockElement::SetPropertyValuesEx($id_item, 114,
                [
                    972 => 0
                ]
            );
            $request =[
                'key' => $key_item
            ];
            echo json_encode($request);
        }
        exit;
    }
    /* добавить в справочник отправители-получатели при оформлении новой заявки */
    if ($req->getQuery('sprav')  === "Y"){
        $arRes = [];
        if(!empty($_POST && $_POST['sessid'] === $sessid)){
           foreach ($_POST as $key=>$value){
               $arRes[$key] = trim(htmlspecialcharsEx($value));
           }
        }
        $arResult['FORM_INVOICE'] = arFromUtfToWin($arRes);
        /* проверить есть или нет получатель в адресной книге и записать если нет */
        if ( $arResult['FORM_INVOICE']['form_radio_SIMPLE_QUESTION_971']  == '102'){
            $name_rec =  $arResult['FORM_INVOICE']['form_text_62'];
            $name_city_recipient = $arResult['FORM_INVOICE']['form_text_hidden57'];
            $id_city_recipient = GetCityId($name_city_recipient);
            if($name_rec){
                $arFilter = [
                    'NAME' => $name_rec,
                    'ACTIVE' => 'Y',
                    'PROPERTY_967' => 415,
                    '=PROPERTY_974' => $id_city_recipient,
                ];
                $arList = GetInfoArr(false, false, 114, $arSelect, $arFilter, false );
                if(empty($arList)){
                    $property = [
                        966 => $id_user,
                        967 => 415,
                        971 => $arResult['FORM_INVOICE']['form_textarea_103'],
                        969 => $arResult['FORM_INVOICE']['form_text_149'],
                        974 => $id_city_recipient
                    ];
                    $arLoadArray = [
                        "IBLOCK_ID" => 114,
                        "NAME"  => $name_rec,
                        "ACTIVE" => "Y",
                        "PROPERTY_VALUES"=> $property,
                    ];
                    $el = new CIBlockElement;
                    $id_rec = $el->Add($arLoadArray);
                }
            }else{
                exit;
            }
        }
        /* проверить есть или нет отправитель в адресной книге и записать если нет */
        if ( $arResult['FORM_INVOICE']['form_radio_SIMPLE_QUESTION_971']  == '121'){
            $name_send =  $arResult['FORM_INVOICE']['form_text_50'];
            $name_city_send = $arResult['FORM_INVOICE']['form_text_hidden55'];
            $id_city_send = GetCityId($name_city_send);
            if($name_send){
                $arFilter = [
                    'NAME' => $name_send,
                    'ACTIVE' => 'Y',
                    'PROPERTY_967' => 415,
                    '=PROPERTY_974' => $id_city_send,
                ];
                $arList = GetInfoArr(false, false, 114, $arSelect, $arFilter, false );
                if(empty($arList)){
                    $property = [
                        966 => $id_user,
                        967 => 414,
                        971 => $arResult['FORM_INVOICE']['form_textarea_56'],
                        969 => $arResult['FORM_INVOICE']['form_text_51'],
                        974 => $id_city_send
                    ];
                    $arLoadArray = [
                        "IBLOCK_ID" => 114,
                        "NAME"  => $name_send,
                        "ACTIVE" => "Y",
                        "PROPERTY_VALUES"=> $property,
                    ];
                    $el = new CIBlockElement;
                    $id_rec = $el->Add($arLoadArray);
                }
            }else{
                exit;
            }
        }
        /* проверить есть или нет отправитель и получатель в адресной книге и записать если нет */
        if ( $arResult['FORM_INVOICE']['form_radio_SIMPLE_QUESTION_971']  == 'creator'){
            $name_rec =  $arResult['FORM_INVOICE']['form_text_62'];
            $name_city_recipient = $arResult['FORM_INVOICE']['form_text_hidden57'];
            $id_city_recipient = GetCityId($name_city_recipient);
            if($name_rec){
                $arFilter = [
                    'NAME' => $name_rec,
                    'ACTIVE' => 'Y',
                    'PROPERTY_967' => 415,
                    '=PROPERTY_974' => $id_city_recipient,
                ];
                $arList = GetInfoArr(false, false, 114, $arSelect, $arFilter, false );
                if(empty($arList)){
                    $property = [
                        966 => $id_user,
                        967 => 415,
                        971 => $arResult['FORM_INVOICE']['form_textarea_103'],
                        969 => $arResult['FORM_INVOICE']['form_text_149'],
                        974 => $id_city_recipient
                    ];
                    $arLoadArray = [
                        "IBLOCK_ID" => 114,
                        "NAME"  => $name_rec,
                        "ACTIVE" => "Y",
                        "PROPERTY_VALUES"=> $property,
                    ];
                    $el = new CIBlockElement;
                    $id_rec = $el->Add($arLoadArray);
                }
            }else{
                exit;
            }
            $name_send =  $arResult['FORM_INVOICE']['form_text_50'];
            $name_city_send = $arResult['FORM_INVOICE']['form_text_hidden55'];
            $id_city_send = GetCityId($name_city_send);
            if($name_send){
                $arFilter = [
                    'NAME' => $name_send,
                    'ACTIVE' => 'Y',
                    'PROPERTY_967' => 415,
                    '=PROPERTY_974' => $id_city_send,
                ];
                $arList = GetInfoArr(false, false, 114, $arSelect, $arFilter, false );
                if(empty($arList)){
                    $property = [
                        966 => $id_user,
                        967 => 414,
                        971 => $arResult['FORM_INVOICE']['form_textarea_56'],
                        969 => $arResult['FORM_INVOICE']['form_text_51'],
                        974 => $id_city_send
                    ];
                    $arLoadArray = [
                        "IBLOCK_ID" => 114,
                        "NAME"  => $name_send,
                        "ACTIVE" => "Y",
                        "PROPERTY_VALUES"=> $property,
                    ];
                    $el = new CIBlockElement;
                    $id_rec = $el->Add($arLoadArray);
                }
            }else{
                exit;
            }

        }
        exit;
    }
    /* обработка отправки новой заявки */
    if ($req->getQuery('payorder') === "cashe"){
        $arReq = $req->getPostList()->toArray();
        foreach($arReq as $key=>$value){
            $arResult['PAYORDER'][$key] = trim(htmlspecialcharsEx($value));
        }
        $arResult['PAYORDER'] = arFromUtfToWin( $arResult['PAYORDER']);
        if ($arResult['PAYORDER']['sessid'] === $sessid){
           /* получить номер накладной из 1с */
            $arParamsJsonw = ['INN' => $id_partner];
            $clientw = soap_inc();
            $resultw = $clientw->GetPrefixAgent1($arParamsJsonw);
            $mResultw = $resultw->return;
            $objw = json_decode($mResultw, true);
            $nmb = $objw['Prefix_'.$id_partner];  /* utf-8 */
            $number = iconv('utf-8', 'windows-1251',$nmb);
            $number_invoice = trim(preg_replace('/^[^0-9]+-/','',$number));
            $sum = preg_replace('/\s[а-я]{3}\.$/', '', $arResult['PAYORDER']['price_calc']);
            $weight = $arResult['PAYORDER']['form_text_hidden58'];
            $desc = $arResult['PAYORDER']['form_textarea_61'];
            $data_from = $arResult['PAYORDER']['form_text_53'];
            $time_from = $arResult['PAYORDER']['form_text_54'];
            $time_is = ($time_from)?:"не указано";
            $date_timestamp = strtotime($data_from);
            $date_to =  date('d.m.Y', $date_timestamp);
            $date_take = $data_from. ' Время - '. $time_is;
            if($arResult['USER']['lastName']){
                $name = $arResult['USER']['name'].' '.$arResult['USER']['lastName'];
            }else{
                $name = $arResult['USER']['name'];
            }
            $email = $arResult['USER']['email'];
            $phone = $arResult['USER']['phone'];
            $name_send = $arResult['PAYORDER']['form_text_50'];
            $phone_send = $arResult['PAYORDER']['form_text_51'];
            $adress_send = $arResult['PAYORDER']['form_textarea_56'];
            $name_rec = $arResult['PAYORDER']['form_text_62'];
            $phone_rec = $arResult['PAYORDER']['form_text_149'];
            $adress_rec = $arResult['PAYORDER']['form_textarea_103'];
            $city_send = GetCityId($arResult['PAYORDER']['form_text_hidden55']);
            $city_rec = GetCityId($arResult['PAYORDER']['form_text_hidden57']);
            /* создать заявку и записать ее в базу */
            if($arResult['PAYORDER']['form_radio_SIMPLE_QUESTION_971'] == 102){  /* отправителем */
                $adress = $arResult['PAYORDER']['form_textarea_56'];
                $city = GetCityId($arResult['PAYORDER']['form_text_hidden55']);

                /* свойства для записи в базу */
                $prop = [
                    957 => 'CFL-'.$number_invoice,
                    944 => $id_user,
                    945 => $name,
                    946 => $phone,
                    947 => $city,
                    948 => $adress,
                    949 => $name_rec,
                    950 => $phone_rec,
                    951 => $city_rec,
                    952 => $adress_rec,
                    953 => $date_to,
                    955 => $weight,
                    958 => $desc.' Дата и время забора - '.$date_take,
                    959 => $sum,
                    960 => '',
                    962 => 407,
                    956 => 411
                ];
                /* записать заявку в 1с */
            }
            if($arResult['PAYORDER']['form_radio_SIMPLE_QUESTION_971'] == 121){   /* получателем */
                $adress = $arResult['PAYORDER']['form_textarea_103'];
                $city = GetCityId($arResult['PAYORDER']['form_text_hidden57']);


                /* свойства для записи в базу */
                $prop = [
                    957 => 'CFL-'.$number_invoice,
                    944 => $id_user,
                    945 => $name_send,
                    946 => $phone_send,
                    947 => $city_send,
                    948 => $adress_send,
                    949 => $name,
                    950 => $phone,
                    951 => $city,
                    952 => $adress,
                    953 => $date_to,
                    955 => $weight,
                    958 => $desc.' Дата и время забора - '.$date_take,
                    959 => $sum,
                    960 => '',
                    962 => 407,
                    956 => 412
                ];

            }

            if($arResult['PAYORDER']['form_radio_SIMPLE_QUESTION_971'] === 'creator'){     /* заказчиком */

                $city_send = GetCityId($arResult['PAYORDER']['form_text_hidden55']);
                $name_rec = $arResult['PAYORDER']['form_text_62'];
                $phone_rec = $arResult['PAYORDER']['form_text_149'];
                $adress_rec = $arResult['PAYORDER']['form_textarea_103'];
                $city_rec = GetCityId($arResult['PAYORDER']['form_text_hidden57']);
                $payer = $arResult['PAYORDER']['form_dropdown_payment'];
                if($payer === 'sender_pay'){
                    $pr = 416;
                }
                if($payer === 'recipient_pay'){
                    $pr = 417;
                }
                /* свойства для записи в базу */
                $prop = [
                    957 => 'CFL-'.$number_invoice,
                    944 => $id_user,
                    945 => $name_send,
                    946 => $phone_send,
                    947 => $city_send,
                    948 => $adress_send,
                    949 => $name_rec,
                    950 => $phone_rec,
                    951 => $city_rec,
                    952 => $adress_rec,
                    953 => $date_to,
                    955 => $weight,
                    958 => $desc.' Дата и время забора - '.$date_take,
                    959 => $sum,
                    960 => '',
                    962 => 407,
                    956 => 413,
                    975 => $pr
                ];
            }
            /* записать в базу если  выбор Отправителем или Получателем */

                $fields = [
                    "ACTIVE_FROM" => date('d.m.Y H:i:s'),
                    "IBLOCK_SECTION_ID" => false,
                    "MODIFIED_BY" => $id_user,
                    "CREATED_BY" => $id_user,
                    "IBLOCK_ID" => 113,
                    'NAME'=> $number,
                    'ACTIVE' => 'Y',
                    "PROPERTY_VALUES" => $prop
                ];
                $arrNewApp = saveIblockElement($fields, $arSelect, true);
                if(!empty($arrNewApp)){
                    AddToLogs('newApplication', $arrNewApp);
                }else{
                    AddToLogs('newApplication', ["ERROR"=>iconv('utf-8', 'windows-1251', "Ошибка добавления заявки")]);
                }

            dump($arResult);
            exit;
        }
        exit;

    }

   /* --------------------------------------------------------------------------------------------------- */
    /* блок обработчиков страниц */

    if($req->getQuery('logout') === "Y"){
        $USER->Logout();
        $arResult['MODE'] = '404';
    }

    elseif($req->getQuery('add') === "Y")
    {
        setcookie("dr_name", "", time() - 3600);
        setcookie("dr_phone", "", time() - 3600);
        setcookie("dr_adr", "", time() - 3600);
        setcookie("ds_name", "", time() - 3600);
        setcookie("ds_phone", "", time() - 3600);
        setcookie("ds_adr", "", time() - 3600);
        $arResult['MODE'] = 'add';
    }
    elseif($req->getQuery('arch') === "Y")
    {
        $arResult['MODE'] = 'list';
        $arFilter = [
            'PROPERTY_944' => $id_user,
            'IBLOCK_ID' => $component_id,
            'ACTIVE' => 'Y',
            'PROPERTY_965' => 'Y',
        ];


        $arList = GetInfoArr(false, false, $component_id, $arSelect, $arFilter, false );
        $arResult['LIST'] = $arList;
    }
    elseif($req->getQuery('sender_add') === 'Y'){  /* справочник отправителей */
        $arResult['MODE'] = 'sender_list';
        $type = 414;
        $arList = getData($id_user, $type, $component_id);
        GetCity($arList);
        $arResult['LIST'] = $arList;

    }
    elseif($req->getQuery('recipient_add') === 'Y'){  /* справочник получателей */
        $arResult['MODE'] = 'recipient_list';
        $type = 415;
        $arList = getData($id_user, $type, $component_id);
        GetCity($arList);
        $arResult['LIST'] = $arList;
     }
    else{
        $arResult['MODE'] = 'list';
        $arFilter = [
            'PROPERTY_944'  => $id_user,
            'IBLOCK_ID'     => $component_id,
            'ACTIVE'        => 'Y',
            '=PROPERTY_965' => false,
        ];


        $arList = GetInfoArr(false, false, $component_id, $arSelect, $arFilter, false );
        $arResult['LIST'] = $arList;
    }
    $this->IncludeComponentTemplate($arResult['MODE']);
}else{
    $this->IncludeComponentTemplate('404');
}
