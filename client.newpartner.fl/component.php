<?php
declare(strict_types=1);
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
use Bitrix\Main\Localization\Loc;
$sessid = bitrix_sessid();
$component_id = 113;
include_once($_SERVER['DOCUMENT_ROOT']."/bitrix/components/black_mist/delivery.packages/functions.php");
global $USER;
$id_user = $USER->GetID();
if($id_user && $USER->Authorize($id_user) ){
    $arrUsr = UserData($id_user);
    $USER_CURRENT = [
      'email' =>  $USER->GetEmail(),
      'name' =>   $USER->GetFirstName(),
      'lastName' => $USER->GetLastName(),
      'phone' =>  $arrUsr[0]['PERSONAL_PHONE'],
      'address' => $arrUsr[0]['PERSONAL_STREET']
    ];
    $arResult['USER'] = $USER_CURRENT;
    $_SESSION['form_mail'] =  trim($USER_CURRENT['email']);

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

    /* изменение профиля пользователя */
    if($_GET['change']==$id_user){
        if(!empty($_POST['form_data'])&&$_POST['form_data'][0]['value']==$sessid){
            foreach($_POST['form_data'] as $key=>$value){
                $arResult[$_POST['form_data'][$key]['name']] = trim(htmlspecialcharsEx($value['value']));
            }
            $arResult = arFromUtfToWin($arResult);
            //dump($arResult);
            //exit;
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
                    "PERSONAL_PHONE"  => (string)$arResult['PERSONAL_PHONE'],
                    "PERSONAL_STREET"  => $arResult['PERSONAL_STREET']
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
    elseif($_GET['sender_add']==='Y'){
       if($_GET['default'] === "Y"){
           $id_item = 0;
           $id_old = 0;

           foreach($_POST['form_data'] as $key=>$value){
               if($id_item>0 && $id_old>0)break;
               $_POST['form_data'][$key]['name'] = trim(htmlspecialcharsEx($value['name']));
               $_POST['form_data'][$key]['value'] = trim(htmlspecialcharsEx($value['value']));
               if($value['name'] === 'DEFAULT' && $value['value'] === '1' ){
                   $id_item = $_POST['form_data'][++$key]['value'];

               }
               if($value['name'] === 'ID_OLD'){
                   $id_old = $_POST['form_data'][$key]['value'];
               }

           }

           if($id_item>0) {
              CIBlockElement::SetPropertyValuesEx($id_item, 114,
                   [
                       972 => 1
                   ]
               );
           }
           if($id_old>0){
               CIBlockElement::SetPropertyValuesEx($id_old, 114,
                   [
                       972 => 0
                   ]
               );
           }


           $_POST['id_item'] = $id_item;
           $_POST['id_old'] = $id_old;
           dump($_POST);
           exit;
       }
       if($_GET['newsender'] == $id_user){

            if(!empty($_POST['form_data'])&&$_POST['form_data'][0]['value'] === $sessid){
                foreach($_POST['form_data'] as $key=>$value){
                    $arResult[$_POST['form_data'][$key]['name']] = trim(htmlspecialcharsEx($value['value']));
                }
                $arResult = arFromUtfToWin($arResult);

                $property = [
                    966 => $id_user,
                    967 => 414,
                    969 => $arResult['PHONE'],
                    971 => $arResult['ADRESS'],

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
        $arResult['MODE'] = 'sender_list';
        $arFilter = [
            'PROPERTY_966' => $id_user,
            'IBLOCK_ID' => 114,
            'ACTIVE' => 'Y',

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
    elseif($_GET['recipient_add']==='Y'){
        $arResult['MODE'] = 'recipient_list';
    }
    else{
        $arResult['MODE'] = 'list';
        $arFilter = [
            'PROPERTY_944' => $id_user,
            'IBLOCK_ID' => $component_id,
            'ACTIVE' => 'Y',
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
