<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
use Bitrix\Main\Localization\Loc;
require_once __DIR__.'/functions.php';
$sessid = bitrix_sessid();
$component_id = 113;
include_once($_SERVER['DOCUMENT_ROOT']."/bitrix/components/black_mist/delivery.packages/functions.php");
global $USER;
$id_user = $USER->GetID();
if($id_user && $USER->Authorize($id_user) ){
    function GetCity(&$arList){
        foreach ($arList as $key=>$value){
            if(empty($value['PROPERTIES']['CITY']['VALUE'])) continue;
            $id_city = (int)$value['PROPERTIES']['CITY']['VALUE'];
            $res = CIBlockElement::GetByID($id_city);
            $arr_city = $res->Fetch();
            $arList[$key]['PROPERTIES']['CITY']['NAME'] = $arr_city['NAME'];

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
    /* массив отправителей для выбора при оформлении новой заявки*/
    $arFilter = [
        'PROPERTY_966' => $id_user,
        'ACTIVE' => 'Y',
        'PROPERTY_967' => 414,
    ];
    $arSelect = [
        "NAME",
        "DATE_CREATE",
        "IBLOCK_ID",
        "ID",
        "PROPERTY_*",
    ];

    $arList = GetInfoArr(false, false, 114, $arSelect, $arFilter, false );
     if(!empty($arList)){
        foreach($arList as $key=>$value){
            $arResult['SENDERS'][$key] = [
                "ID"   => $value['ID'],
                "NAME" => trim($value['NAME']),
                'PHONE' => $value['PROPERTIES']['PHONE']['VALUE'],
                'ADRESS' => $value['PROPERTIES']['ADRESS']['VALUE'],
            ];
        }
         $_SESSION['SENDERS'] =   $arResult['SENDERS'];
    }

    /* массив получателей для выбора при оформлении новой заявки*/
    $arFilter = [
        'PROPERTY_966' => $id_user,
        'ACTIVE' => 'Y',
        'PROPERTY_967' => 415,
    ];
    $arSelect = [
        "NAME",
        "DATE_CREATE",
        "IBLOCK_ID",
        "ID",
        "PROPERTY_*",
    ];

    $arList = GetInfoArr(false, false, 114, $arSelect, $arFilter, false );
    if(!empty($arList)){
        foreach($arList as $key=>$value){
            $arResult['RECIPIENTS'][$key] = [
                "ID"   => $value['ID'],
                "NAME" => trim($value['NAME']),
                'PHONE' => $value['PROPERTIES']['PHONE']['VALUE'],
                'ADRESS' => $value['PROPERTIES']['ADRESS']['VALUE'],
            ];
        }
        $_SESSION['RECIPIENTS'] =   $arResult['RECIPIENTS'];
    }


    /* записать отправителя по умолчанию если есть */
    $arFilter = [
        'PROPERTY_966' => $id_user,
        'ACTIVE' => 'Y',
        'PROPERTY_972' => '1',
        'PROPERTY_967' => 414,
    ];
    $arSelect = [
        "NAME",
        "DATE_CREATE",
        "IBLOCK_ID",
        "ID",
        "PROPERTY_*",
    ];

    $arList = GetInfoArr(false, false, 114, $arSelect, $arFilter, false );
    if( !empty($arList[0]['NAME'])){
        $name_sender = $arList[0]['NAME'];
        $phone_sender = $arList[0]['PROPERTIES']['PHONE']['VALUE'];
        $adress_sender = $arList[0]['PROPERTIES']['ADRESS']['VALUE'];
        $arResult['DEFAULT_SENDER'] = [
            'NAME' => $name_sender,
            'PHONE' => $phone_sender,
            'ADRESS' => $adress_sender
        ];
        $_SESSION['DEFAULT_SENDER'] = $arResult['DEFAULT_SENDER'];
    }

    /* записать получателя по умолчанию если есть */
    $arFilter = [
        'PROPERTY_966' => $id_user,
        'ACTIVE' => 'Y',
        'PROPERTY_972' => '1',
        'PROPERTY_967' => 415,
    ];
    $arSelect = [
        "NAME",
        "DATE_CREATE",
        "IBLOCK_ID",
        "ID",
        "PROPERTY_*",
    ];

    $arList = GetInfoArr(false, false, 114, $arSelect, $arFilter, false );
    if( !empty($arList[0]['NAME'])){
        $name_recipient = $arList[0]['NAME'];
        $phone_recipient = $arList[0]['PROPERTIES']['PHONE']['VALUE'];
        $adress_recipient = $arList[0]['PROPERTIES']['ADRESS']['VALUE'];
        $arResult['DEFAULT_RECIPIENT'] = [
            'NAME' => $name_recipient,
            'PHONE' => $phone_recipient,
            'ADRESS' => $adress_recipient
        ];
        $_SESSION['DEFAULT_RECIPIENT'] = $arResult['DEFAULT_RECIPIENT'];
    }
    /* запрос в 1с за треком отправления */
    if($_GET['number']){
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
    if($_GET['delete']==='Y') {
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
    if($_GET['edit']==='Y'){
         if(!empty($_POST['form_data'])&&$_POST['form_data'][6]['value']===$sessid){
            $id_modal = trim(htmlspecialcharsEx($_POST['form_data'][5]['value']));
            foreach($_POST['form_data'] as $key=>$value){
                $key_arr = preg_replace('/_[0-9]+$/','',$_POST['form_data'][$key]['name']);
                $id_modal = 'editBtn_'.preg_replace('/[a-z]+_{1}/i','',$_POST['form_data'][$key]['name']);
                $arResult[$key_arr] = trim(htmlspecialcharsEx($value['value']));
            }
            $arResult = arFromUtfToWin($arResult);

            $id_item = (int)$arResult['ID'];
            $el = new CIBlockElement;
            if(!empty($arResult['InputFIO'])){
                $el->Update($id_item, ['NAME'=>$arResult['InputFIO']]);
                if(!empty($arResult['CityId'])) {
                    $city_new = (int)$arResult['CityId'];
                     if (!empty($arResult['InputAdr'])) {
                        $adr_new = $arResult['InputAdr'];
                        if (!empty($arResult['InputPhone'])) {
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
    if($_GET['change']==$id_user){
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
    if($_GET['default'] === "Y" && ($_GET['sender_add']==='Y' || $_GET['recipient_add']==='Y')){
        $id_item = 0;
        $type = 0;
        if($_GET['sender_add']==='Y'){
            $type = 414;
        }
        if($_GET['recipient_add']==='Y'){
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
        $arSelect = [
            "NAME",
            "DATE_CREATE",
            "IBLOCK_ID",
            "ID",
            "PROPERTY_*",
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
        exit;
    }
    /* добавление нового отправителя-получателя*/
    if(($_GET['sender_add']==='Y' || $_GET['recipient_add']==='Y') && $_GET['newsender'] == $id_user){
        if(!empty($_POST['form_data']) && $_POST['form_data'][0]['value'] === $sessid){
            $type = 0;
            if($_GET['sender_add']==='Y')$type = 414;
            if($_GET['recipient_add']==='Y')$type = 415;
             foreach($_POST['form_data'] as $key=>$value){
                $arResult[$_POST['form_data'][$key]['name']] = trim(htmlspecialcharsEx($value['value']));
            }
            $arResult = arFromUtfToWin($arResult);
            if(!empty($arResult['PHONE'])){
               if( !preg_match('/[\+?\s?\(?\)?\d-]{10,20}/', $arResult['PHONE'])){
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
     if(!empty($_GET['getid'])){
        $id_el = (int)$_GET['getid'];
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
   /* --------------------------------------------------------------------------------------------------- */
    /* блок обработчиков страниц */
    if($_GET['logout']==="Y"){
        $USER->Logout();
        $arResult['MODE'] = '404';
    }
    elseif($_GET['add']==="Y")
    {
        $arResult['MODE'] = 'add';
    }
    elseif($_GET['arch']==="Y")
    {
        $arResult['MODE'] = 'list';
        $arFilter = [
            'PROPERTY_944' => $id_user,
            'IBLOCK_ID' => $component_id,
            'ACTIVE' => 'Y',
            'PROPERTY_965' => 'Y',
        ];
        $arSelect = [
            "NAME",
            "DATE_CREATE",
            "IBLOCK_ID",
            "ID",
            "PROPERTY_*",
        ];

        $arList = GetInfoArr(false, false, $component_id, $arSelect, $arFilter, false );
        $arResult['LIST'] = $arList;
    }
    elseif($_GET['sender_add']==='Y'){  /* справочник отправителей */
        $arResult['MODE'] = 'sender_list';
        $type = 414;
        $arList = getData($id_user, $type, $component_id);
        GetCity($arList);
        $arResult['LIST'] = $arList;

    }
    elseif($_GET['recipient_add']==='Y'){  /* справочник получателей */
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
        $arSelect = [
            "NAME",
            "DATE_CREATE",
            "IBLOCK_ID",
            "ID",
            "PROPERTY_*",
        ];

        $arList = GetInfoArr(false, false, $component_id, $arSelect, $arFilter, false );
        $arResult['LIST'] = $arList;
    }
    $this->IncludeComponentTemplate($arResult['MODE']);
}else{
    $this->IncludeComponentTemplate('404');
}
