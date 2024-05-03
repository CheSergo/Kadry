<?php
include dirname(__DIR__) . '\Variables\\config.php';

function get_all() {
  global $main_path;
  $json = file_get_contents($main_path . '\Json_returns\2024\employees\employee_grouped_array.json');
  return json_decode($json, true);
}

$appointment_reason_log = "Appointment_Reason_log.txt";

function makeFile($array, $dom, $root, $key, $addresses_array) {
  global $main_path;
  // print '<pre>';
  // print_r($addresses_array);
  // print '<pre>';
  // die;
  // foreach ($array as $array) {

    $dom = $dom;
    $root = $root;

    $Employee_node = $dom->createElement('Employee');

    $child_node_Code = $dom->createElement('Code', $array['CODE']);
    $Employee_node->appendChild($child_node_Code);
    $child_node_Names = $dom->createElement('Names');
    $Employee_node->appendChild($child_node_Names);
      $child_node_name = $dom->createElement('name');
      $child_node_Names->appendChild($child_node_name);
        $child_node_Begin = $dom->createElement('Begin', date("Y-m-d", strtotime($array['BIRTHDATE'])));
        $child_node_name->appendChild($child_node_Begin);
        $child_node_Begin = $dom->createElement('FirstName', $array['NAME']);
        $child_node_name->appendChild($child_node_Begin);
        $child_node_Begin = $dom->createElement('Patronymic', $array['LSTNAME']);
        $child_node_name->appendChild($child_node_Begin);
        $child_node_Begin = $dom->createElement('FamilyName', $array['FAMILY']);
        $child_node_name->appendChild($child_node_Begin);
    $child_node_Sex = $dom->createElement('Sex', $array['SEX'] == 0 ? 'Female' : 'Male');
    $Employee_node->appendChild($child_node_Sex);
    $child_node_BirthDate = $dom->createElement('BirthDate', date('Y-m-d', strtotime($array['BIRTHDATE'])));
    $Employee_node->appendChild($child_node_BirthDate);
    $child_node_Snils = $dom->createElement('Snils', $array['INSURANCE']);
    $Employee_node->appendChild($child_node_Snils);
    $child_node_BirthPlace = $dom->createElement('BirthPlace');
    $Employee_node->appendChild($child_node_BirthPlace);
      $child_node_region = $dom->createElement('Region', $array['BIRTHPLACE']);
      $child_node_BirthPlace->appendChild($child_node_region);
    $child_node_Inn = $dom->createElement('Inn', $array['INN']);
    $Employee_node->appendChild($child_node_Inn);
    $child_node_Phone = $dom->createElement('Phone', $array['HOMEPHONE']);
    $Employee_node->appendChild($child_node_Phone);
    
    // ================================================== ВЫГРУЗКА АДРЕСОВ ============================================================
    // print '<pre>';
    // print_r($array['REAL_ADDRES']);
    // print '<pre>';
    // die;

    // $ch = curl_init('https://geocode-maps.yandex.ru/1.x/?apikey=e21b7389-9940-4666-b649-9ba7dd45de11&format=json&geocode=' . urlencode($array['REAL_ADDRES']));
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    // curl_setopt($ch, CURLOPT_HEADER, false);
    // $res = curl_exec($ch);
    // curl_close($ch);
    // $address = json_decode($res, true);

    // $addresses_array[$key][$array['CODE']] = $address;
    // sleep(0.5);

    // file_put_contents($main_path . '\Json_returns\employee_address.json', json_encode($addresses_array));

    // $json = file_get_contents($main_path . '\Json_returns\employee_address.json');
    // $address = json_decode($json, true);
    // print '<pre>';
    // print_r($address['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['metaDataProperty']['GeocoderMetaData']['Address']['Components']);
    // print_r($address);
    // print '<pre>';
    // die;
    // ===========================================================================================================================

    $child_node_PermanentRegistrationAddress = $dom->createElement('PermanentRegistrationAddress');
    $Employee_node->appendChild($child_node_PermanentRegistrationAddress);
    // Тут главное не забыть. Недавно сделал много манипуляций. Раньше была проверка if(isset($address))
    if(isset($addresses_array)) {
      $child_node_ActualAddress = $dom->createElement('ActualAddress');
      $Employee_node->appendChild($child_node_ActualAddress);
        $child_node_address = $dom->createElement('address');
        $child_node_ActualAddress->appendChild($child_node_address);
          $child_node_Begin = $dom->createElement('Begin', '1900-01-01');
          $child_node_address->appendChild($child_node_Begin);
          $child_node_Value = $dom->createElement('Value');
          $child_node_address->appendChild($child_node_Value);
            $child_node_address = $dom->createElement('address');
            $child_node_Value->appendChild($child_node_address);
              if (isset($addresses_array[$key][$array['CODE']]['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['metaDataProperty']['GeocoderMetaData']['Address']['Components'][2]['name']) && !is_null($addresses_array[$key][$array['CODE']]['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['metaDataProperty']['GeocoderMetaData']['Address']['Components'][2]['name'])) {
                $child_node_region = $dom->createElement('region');
                $child_node_address->appendChild($child_node_region);
                  $child_node_name = $dom->createElement('name', $addresses_array[$key][$array['CODE']]['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['metaDataProperty']['GeocoderMetaData']['Address']['Components'][2]['name']);
                  $child_node_region->appendChild($child_node_name);
                  $child_node_abbreviation = $dom->createElement('abbreviation');
                  $child_node_region->appendChild($child_node_abbreviation);
                  $child_node_id = $dom->createElement('id');
                  $child_node_region->appendChild($child_node_id);
                  $child_node_fiasId = $dom->createElement('fiasId');
                  $child_node_region->appendChild($child_node_fiasId);
                  $child_node_parentFiasId = $dom->createElement('parentFiasId');
                  $child_node_region->appendChild($child_node_parentFiasId);
              }
              if (isset($addresses_array[$key][$array['CODE']]['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['metaDataProperty']['GeocoderMetaData']['Address']['Components'][4]['name']) && !is_null($addresses_array[$key][$array['CODE']]['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['metaDataProperty']['GeocoderMetaData']['Address']['Components'][4]['name'])) {
                $child_node_city = $dom->createElement('city');
                $child_node_address->appendChild($child_node_city);
                  $child_node_name = $dom->createElement('name', $addresses_array[$key][$array['CODE']]['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['metaDataProperty']['GeocoderMetaData']['Address']['Components'][4]['name']);
                  $child_node_city->appendChild($child_node_name);
                  $child_node_abbreviation = $dom->createElement('abbreviation');
                  $child_node_city->appendChild($child_node_abbreviation);
                  $child_node_id = $dom->createElement('id');
                  $child_node_city->appendChild($child_node_id);
                  $child_node_fiasId = $dom->createElement('fiasId');
                  $child_node_city->appendChild($child_node_fiasId);
                  $child_node_parentFiasId = $dom->createElement('parentFiasId');
                  $child_node_city->appendChild($child_node_parentFiasId);
              }
              if (isset($addresses_array[$key][$array['CODE']]['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['metaDataProperty']['GeocoderMetaData']['Address']['Components'][5]['name']) && !is_null($addresses_array[$key][$array['CODE']]['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['metaDataProperty']['GeocoderMetaData']['Address']['Components'][5]['name'])) {
                $child_node_street = $dom->createElement('street');
                $child_node_address->appendChild($child_node_street);
                  $child_node_name = $dom->createElement('name', $addresses_array[$key][$array['CODE']]['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['metaDataProperty']['GeocoderMetaData']['Address']['Components'][5]['name']);
                  $child_node_street->appendChild($child_node_name);
                  $child_node_abbreviation = $dom->createElement('abbreviation');
                  $child_node_street->appendChild($child_node_abbreviation);
                  $child_node_id = $dom->createElement('id');
                  $child_node_street->appendChild($child_node_id);
                  $child_node_fiasId = $dom->createElement('fiasId');
                  $child_node_street->appendChild($child_node_fiasId);
                  $child_node_parentFiasId = $dom->createElement('parentFiasId');
                  $child_node_street->appendChild($child_node_parentFiasId);
              }
            if (isset($addresses_array[$key][$array['CODE']]['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['metaDataProperty']['GeocoderMetaData']['Address']['Components'][6]['name']) && !is_null($addresses_array[$key][$array['CODE']]['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['metaDataProperty']['GeocoderMetaData']['Address']['Components'][6]['name'])) {
              $child_node_house = $dom->createElement('house');
              $child_node_address->appendChild($child_node_house);
                $child_node_id = $dom->createElement('id');
                $child_node_house->appendChild($child_node_id);
                $child_node_fiasId = $dom->createElement('fiasId');
                $child_node_house->appendChild($child_node_fiasId);
                $child_node_parentFiasId = $dom->createElement('parentFiasId');
                $child_node_house->appendChild($child_node_parentFiasId);
                $child_node_number = $dom->createElement('number', $addresses_array[$key][$array['CODE']]['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['metaDataProperty']['GeocoderMetaData']['Address']['Components'][6]['name']);
                $child_node_house->appendChild($child_node_number);
            }
            if (isset($addresses_array[$key][$array['CODE']]['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['metaDataProperty']['GeocoderMetaData']['Address']['Components'][9]['name']) && !is_null($addresses_array[$key][$array['CODE']]['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['metaDataProperty']['GeocoderMetaData']['Address']['Components'][9]['name'])) {
              $child_node_room = $dom->createElement('room');
              $child_node_address->appendChild($child_node_room);
                $child_node_id = $dom->createElement('id');
                $child_node_room->appendChild($child_node_id);
                $child_node_fiasId = $dom->createElement('fiasId');
                $child_node_room->appendChild($child_node_fiasId);
                $child_node_parentFiasId = $dom->createElement('parentFiasId');
                $child_node_room->appendChild($child_node_parentFiasId);
                $child_node_number = $dom->createElement('roomNumber', preg_replace("/[^0-9]/", "", $addresses_array[$key][$array['CODE']]['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['metaDataProperty']['GeocoderMetaData']['Address']['Components'][9]['name'] ) );
                $child_node_room->appendChild($child_node_number);
            }
    // ЗДЕСЬ КОНЧАЕТСЯ АДРЕС
    }
    // MilitaryStatus
    $child_node_MilitaryStatus = $dom->createElement('MilitaryStatus');
    $Employee_node->appendChild($child_node_MilitaryStatus);
      // $child_node_militaryStatus = $dom->createElement('militaryStatus');
      // $child_node_MilitaryStatus->appendChild($child_node_militaryStatus);
        // $child_node_Begin = $dom->createElement('Begin', '1900-01-01');
        // $child_node_militaryStatus->appendChild($child_node_Begin);
        // $child_node_Code = $dom->createElement('Code', 'no data');
        // $child_node_militaryStatus->appendChild($child_node_Code);
    // MilitaryCategory
    // $child_node_MilitaryCategory = $dom->createElement('MilitaryCategory');
    // $Employee_node->appendChild($child_node_MilitaryCategory);
    //   $child_node_militarycategory = $dom->createElement('militarycategory');
    //   $child_node_MilitaryCategory->appendChild($child_node_militarycategory);
        // $child_node_Begin = $dom->createElement('Begin'); 
        // $child_node_militarycategory->appendChild($child_node_Begin);
        // $child_node_Value = $dom->createElement('Value');//$array['CAT_ZAPAS']
        // $child_node_militarycategory->appendChild($child_node_Value);
    // MilitaryRank
    $child_node_MilitaryRank = $dom->createElement('MilitaryRank');
    $Employee_node->appendChild($child_node_MilitaryRank);
    if ( (!is_null(trim($array['ZVANIE']))) && (str_replace(' ', '', $array['ZVANIE']) != '') ) {
      $child_node_militaryrank = $dom->createElement('militaryrank');
      $child_node_MilitaryRank->appendChild($child_node_militaryrank);
        $child_node_Begin = $dom->createElement('Begin', '1900-01-01'); //$array['DATE_UPD']
        $child_node_militaryrank->appendChild($child_node_Begin);
        $child_node_Code = $dom->createElement('Code', $array['ZVANIE']);
        $child_node_militaryrank->appendChild($child_node_Code);
    }
    // MilitaryStructure - профиль воинского звания
    // $child_node_MilitaryStructure = $dom->createElement('MilitaryStructure');
    // $Employee_node->appendChild($child_node_MilitaryStructure);
    //   $child_node_militarystructure = $dom->createElement('militarystructure');
    //   $child_node_MilitaryStructure->appendChild($child_node_militarystructure);
    //     $child_node_Begin = $dom->createElement('Begin'); //$array['DATE_UPD']
    //     $child_node_militarystructure->appendChild($child_node_Begin);
    //     $child_node_Code = $dom->createElement('Code');
    //     $child_node_militarystructure->appendChild($child_node_Code);
    // MilitaryCode - ВУС
    $child_node_MilitaryCode = $dom->createElement('MilitaryCode');
    $Employee_node->appendChild($child_node_MilitaryCode);
    if( !is_null(trim($array['WUS_DATEUPD'])) && (trim($array['WUS_DATEUPD']) != '') ) {
      $child_node_militarycode = $dom->createElement('militarycode');
      $child_node_MilitaryCode->appendChild($child_node_militarycode);
        $child_node_Begin = $dom->createElement('Begin', !is_null($array['WUS_DATEUPD']) ? date('Y-m-d', strtotime($array['WUS_DATEUPD'])) : '1900-01-01' ); //$array['WUS_DATEUPD']
        $child_node_militarycode->appendChild($child_node_Begin);
        $child_node_Value = $dom->createElement('Value', $array['WUS']);
        $child_node_militarycode->appendChild($child_node_Value);
    }
    // MilitarySuitabilityCategory - Годность
    $child_node_MilitarySuitabilityCategory = $dom->createElement('MilitarySuitabilityCategory');
    $Employee_node->appendChild($child_node_MilitarySuitabilityCategory);
    if( !is_null(trim($array['GODNOST'])) && (trim($array['GODNOST']) != '') ) {
      $child_node_militarysuitabilitycategory = $dom->createElement('militarysuitabilitycategory');
      $child_node_MilitarySuitabilityCategory->appendChild($child_node_militarysuitabilitycategory);
        $child_node_Begin = $dom->createElement('Begin', '1900-01-01'); //$array['DATE_UPD']
        $child_node_militarysuitabilitycategory->appendChild($child_node_Begin);
        $child_node_Code = $dom->createElement('Code', $array['GODNOST']);
        $child_node_militarysuitabilitycategory->appendChild($child_node_Code);
    }
    // MilitaryCommissariat - Коммистариат
    $child_node_MilitaryCommissariat = $dom->createElement('MilitaryCommissariat');
    $Employee_node->appendChild($child_node_MilitaryCommissariat);
    if( !is_null(trim($array['KOMMISARIAT'])) && (trim($array['KOMMISARIAT']) != '') ) {
      $child_node_militarycommissariat = $dom->createElement('militarycommissariat');
      $child_node_MilitaryCommissariat->appendChild($child_node_militarycommissariat);
        $child_node_Begin = $dom->createElement('Begin', '1900-01-01'); //$array['DATE_UPD']
        $child_node_militarycommissariat->appendChild($child_node_Begin);
        $child_node_Value = $dom->createElement('Value', $array['KOMMISARIAT']);
        $child_node_militarycommissariat->appendChild($child_node_Value);
    }
    // MilitaryRegistration
    // $child_node_MilitaryRegistration = $dom->createElement('MilitaryRegistration');
    // $Employee_node->appendChild($child_node_MilitaryRegistration);
    //   $child_node_militaryregistration = $dom->createElement('militaryregistration');
    //   $child_node_MilitaryRegistration->appendChild($child_node_militaryregistration);
    //     $child_node_Begin = $dom->createElement('Begin'); //$array['DATE_UPD']
    //     $child_node_militaryregistration->appendChild($child_node_Begin);
    //     $child_node_RegistrationType = $dom->createElement('RegistrationType');
    //     $child_node_militaryregistration->appendChild($child_node_RegistrationType);
    //     $child_node_CommandNumber = $dom->createElement('CommandNumber');
    //     $child_node_militaryregistration->appendChild($child_node_CommandNumber);
    //     $child_node_Notes = $dom->createElement('Notes');
    //     $child_node_militaryregistration->appendChild($child_node_Notes);
    // ClassRank
    $child_node_ClassRank = $dom->createElement('ClassRank');
    $Employee_node->appendChild($child_node_ClassRank);
    if(isset($array['chins_array'])) {
      foreach($array['chins_array'] as $chin) {
        if ( !is_null($chin['CODE_ID']) and (!is_null($chin['CHIN_ORDERDATE']) or !is_null($chin['CHIN_PRIKAZ'])) ) {

          $child_node_classrank = $dom->createElement('classrank');
          $child_node_ClassRank->appendChild($child_node_classrank);
            $child_node_Begin = $dom->createElement('Begin', !is_null($chin['CHIN_DATE_START']) ? date('Y-m-d', strtotime($chin['CHIN_DATE_START'])) : '-');
            $child_node_classrank->appendChild($child_node_Begin);
            if (!is_null($chin['CHIN_DATE_END'])) {
              $child_node_End = $dom->createElement('End', date('Y-m-d', strtotime($chin['CHIN_DATE_END'])));
              $child_node_classrank->appendChild($child_node_End);
            }

            $chins_kadry_ids = [
              1 => 22,
              2 => 23,
              3 => 24,
              4 => 21,
              5 => 20,
              6 => 19,
              7 => 18,
              8 => 17,
              9 => 16,
              10 => 6,
              11 => 5,
              12 => 4,
              13 => 3,
              14 => 2,
              15 => 1,
              16 => 30,
              17 => 9,
              18 => 8,
              19 => 7,
              20 => 12,
              21 => 11,
              22 => 10,
              23 => 15,
              24 => 14,
              25 => 13,
              26 => 31,
            ];

            $child_node_Code = $dom->createElement('Code', $chins_kadry_ids[$chin['CODE_ID']]);
            $child_node_classrank->appendChild($child_node_Code);

            if (!is_null($chin['CHIN_ORDERDATE'])) {
              $child_node_OrderDate = $dom->createElement('OrderDate', date('Y-m-d', strtotime($chin['CHIN_ORDERDATE'])));
              $child_node_classrank->appendChild($child_node_OrderDate);
            }
            if (!is_null($chin['CHIN_PRIKAZ'])) {
              $child_node_OrderNumber = $dom->createElement('OrderNumber', is_null($chin['CHIN_PRIKAZ']) ? '-' : $chin['CHIN_PRIKAZ']); 
              $child_node_classrank->appendChild($child_node_OrderNumber);
            }

        }
      }
    }
    // MaritalStatus - семейное положение
    $child_node_MaritalStatus = $dom->createElement('MaritalStatus');
    $Employee_node->appendChild($child_node_MaritalStatus);
      $child_node_maritalStatus = $dom->createElement('maritalStatus');
      $child_node_MaritalStatus->appendChild($child_node_maritalStatus);
        $child_node_Begin = $dom->createElement('Begin', '1900-01-01');
        $child_node_maritalStatus->appendChild($child_node_Begin);
        $child_node_Code = $dom->createElement('Code', $array['BRAK']);
        $child_node_maritalStatus->appendChild($child_node_Code);
    // Паспорт 
    $child_node_Passport = $dom->createElement('Passport');
    $Employee_node->appendChild($child_node_Passport);
      $child_node_passport = $dom->createElement('passport');
      $child_node_Passport->appendChild($child_node_passport);
        $child_node_Begin = $dom->createElement('Begin', $array['PASSPORT_DATERECV'] != '1900-01-01' && $array['PASSPORT_DATERECV'] != '1970-01-01' ? $array['PASSPORT_DATERECV'] : '2099-01-01');
        $child_node_passport->appendChild($child_node_Begin);

        if($array['Number'] != null) {
          $child_node_Number = $dom->createElement('Number', $array['Number']);
        } else if ($array['PASSPORT_fullNumber'] != null) {
          $seria = substr($array['PASSPORT_fullNumber'], 0, 4);
          $nomer = substr($array['PASSPORT_fullNumber'], 4);
          $child_node_Number = $dom->createElement('Number', $seria."-".$nomer);
        } else {
          $child_node_Number = $dom->createElement('Number', "0000-000000");
        }

        $child_node_passport->appendChild($child_node_Number);
        $child_node_Authority = $dom->createElement('Authority', $array['PASSPORT_PLACE']);
        $child_node_passport->appendChild($child_node_Authority);
        $child_node_IdentityDocumentType = $dom->createElement('IdentityDocumentType', 1);
        $child_node_passport->appendChild($child_node_IdentityDocumentType);
        $child_node_Code = $dom->createElement('Code', $array['PASSPORT_KODPODRAZD']);
        $child_node_passport->appendChild($child_node_Code);
    // Родственники
    $child_node_Relatives = $dom->createElement('Relatives');
    $Employee_node->appendChild($child_node_Relatives);
      if(isset($array['rodstv_array'])) {
        foreach($array['rodstv_array'] as $rodstvennik) {
          $child_node_relative = $dom->createElement('relative');
          $child_node_Relatives->appendChild($child_node_relative);
            // $child_node_Begin = $dom->createElement('Begin', date('Y-m-d', strtotime($rodstvennik['RODSTV_DATE_INS']) < strtotime($rodstvennik['RODSTV_BIRTHDATE']) ? strtotime($rodstvennik['RODSTV_BIRTHDATE']) : strtotime($rodstvennik['RODSTV_DATE_INS']) ));
            

            // if ( !is_null($rodstvennik['RODSTV_BIRTHDATE']) ) {
              // $rostv_begin_date = date("Y-m-d", strtotime($array['BIRTHDATE'])) >= date('Y-m-d', strtotime($rodstvennik['RODSTV_BIRTHDATE'])) ? date("Y-m-d", strtotime($array['BIRTHDATE'])) : date('Y-m-d', strtotime($rodstvennik['RODSTV_BIRTHDATE']));

              $child_node_Begin = $dom->createElement('Begin', date('Y-m-d', strtotime($rodstvennik['RODSTV_DATE_INS'])) );
              // $child_node_Begin = $dom->createElement('Begin', $rostv_begin_date );
              $child_node_relative->appendChild($child_node_Begin);
            if (!is_null($rodstvennik['RODSTV_BIRTHDATE'])) {
              $child_node_BirthDate = $dom->createElement('BirthDate',  date('Y-m-d', strtotime($rodstvennik['RODSTV_BIRTHDATE'])));
              $child_node_relative->appendChild($child_node_BirthDate);
            } else {
              // $child_node_Begin = $dom->createElement('Begin', '1900-01-01');
              // $child_node_relative->appendChild($child_node_Begin);
              $child_node_BirthDate = $dom->createElement('BirthDate', '1900-01-01');
              $child_node_relative->appendChild($child_node_BirthDate);
            }

            $child_node_Fio = $dom->createElement('Fio', trim($rodstvennik['RODSTV_FIO']));
            $child_node_relative->appendChild($child_node_Fio);
            $type_rodstva = mb_strtolower(trim(str_replace(' ', '', $rodstvennik['TIP_RODSTVA'])));
            switch (strtolower(trim($type_rodstva))) {
              case 'муж':
                $child_node_Type = $dom->createElement('Type', '01');
                $child_node_relative->appendChild($child_node_Type);
                break;
              case 'жена':
                $child_node_Type = $dom->createElement('Type', '02');
                $child_node_relative->appendChild($child_node_Type);
                break;
              case 'отец':
                $child_node_Type = $dom->createElement('Type', '03');
                $child_node_relative->appendChild($child_node_Type);
                break;
              case 'мать':
                $child_node_Type = $dom->createElement('Type', '04');
                $child_node_relative->appendChild($child_node_Type);
                break;
              case 'сын':
                $child_node_Type = $dom->createElement('Type', '05');
                $child_node_relative->appendChild($child_node_Type);
                break;
              case 'дочь':
                $child_node_Type = $dom->createElement('Type', '06');
                $child_node_relative->appendChild($child_node_Type);
                break;
              case 'сестра':
                $child_node_Type = $dom->createElement('Type', '21');
                $child_node_relative->appendChild($child_node_Type);
                break;
              case 'брат':
                $child_node_Type = $dom->createElement('Type', '20');
                $child_node_relative->appendChild($child_node_Type);
                break;
              case 'бывшаясупруга':
                $child_node_Type = $dom->createElement('Type', '94');
                $child_node_relative->appendChild($child_node_Type);
                break;
              case 'бывшийсупруг':
                $child_node_Type = $dom->createElement('Type', '93');
                $child_node_relative->appendChild($child_node_Type);
                break;
              case 'супругсестры':
                $child_node_Type = $dom->createElement('Type', '73');
                $child_node_relative->appendChild($child_node_Type);
                break;
              case 'супругабрата':
                $child_node_Type = $dom->createElement('Type', '72');
                $child_node_relative->appendChild($child_node_Type);
                break;
              case 'сестрасупруги':
                $child_node_Type = $dom->createElement('Type', '77');
                $child_node_relative->appendChild($child_node_Type);
                break;
              case 'сестрасупруга':
                $child_node_Type = $dom->createElement('Type', '76');
                $child_node_relative->appendChild($child_node_Type);
                break;
              case 'братсупруги':
                $child_node_Type = $dom->createElement('Type', '75');
                $child_node_relative->appendChild($child_node_Type);
                break;
              case 'братсупруга':
                $child_node_Type = $dom->createElement('Type', '74');
                $child_node_relative->appendChild($child_node_Type);
                break;
              case 'бабушка':
                $child_node_Type = $dom->createElement('Type', '08');
                $child_node_relative->appendChild($child_node_Type);
                break;
              case 'дедушка':
                $child_node_Type = $dom->createElement('Type', '07');
                $child_node_relative->appendChild($child_node_Type);
                break;
              case 'внук':
                $child_node_Type = $dom->createElement('Type', '09');
                $child_node_relative->appendChild($child_node_Type);
                break;
              case 'внучка':
                $child_node_Type = $dom->createElement('Type', '10');
                $child_node_relative->appendChild($child_node_Type);
                break;
              case 'мачеха':
                $child_node_Type = $dom->createElement('Type', '41');
                $child_node_relative->appendChild($child_node_Type);
                break;
              case 'отчим':
                $child_node_Type = $dom->createElement('Type', '40');
                $child_node_relative->appendChild($child_node_Type);
                break;
              case 'пасынок':
                $child_node_Type = $dom->createElement('Type', '000');
                $child_node_relative->appendChild($child_node_Type);
                break;
              default:
                $child_node_Type = $dom->createElement('Type', '00');
                $child_node_relative->appendChild($child_node_Type);
                break;
            }
        }
      }
    // Citizenship
    $child_node_Citizenship = $dom->createElement('Citizenship');
    $Employee_node->appendChild($child_node_Citizenship);
      $child_node_citizenship = $dom->createElement('citizenship');
      $child_node_Citizenship->appendChild($child_node_citizenship);
        $child_node_Begin = $dom->createElement('Begin', '1900-01-01');
        $child_node_citizenship->appendChild($child_node_Begin);
        $child_node_Value = $dom->createElement('Value', 1);
        $child_node_citizenship->appendChild($child_node_Value);
// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    // LaborContracts
    $child_node_LaborContracts = $dom->createElement('LaborContracts');
    $Employee_node->appendChild($child_node_LaborContracts);
      if(isset($array['contracts_array'])) {
        $len = count($array['contracts_array']);
        foreach(($array['contracts_array']) as $contract_key => $contract) {
          $counter = 0;
          // $counter ++;
          // if (!is_null($staj['doc_num']) && strlen($staj['doc_num']) > 1) {
          //   print '<pre>';
          //   print_r($staj['doc_num']);
          //   print '<pre>';
          //   die;
          // }
          $child_node_laborContract = $dom->createElement('laborContract');
          $child_node_LaborContracts->appendChild($child_node_laborContract);
            $child_node_Begin = $dom->createElement('Begin', is_null($contract['CONTRACT_BEGIN']) ? '1900-01-01' : date('Y-m-d', strtotime($contract['CONTRACT_BEGIN'])) );
            $child_node_laborContract->appendChild($child_node_Begin);
            $child_node_Number = $dom->createElement('Number', is_null($contract['trud_number']) ? $contract['contract_id'] : $contract['trud_number']);
            $child_node_laborContract->appendChild($child_node_Number);
            $child_node_StartDate = $dom->createElement('StartDate', is_null($contract['CONTRACT_BEGIN']) ? '1900-01-01' : date('Y-m-d', strtotime($contract['CONTRACT_BEGIN'])) );
            $child_node_laborContract->appendChild($child_node_StartDate);
            foreach ($contract['doljnosti_array'] as $dolj) {
              if(is_null($dolj['STAJ_END'])) {
                $counter ++;
              }
            }
            // if ($counter != $len) {
            if ($counter == 0) {
              if ( !is_null($contract['CONTRACT_END']) ) {
                $child_node_End = $dom->createElement('End', date('Y-m-d', strtotime($contract['CONTRACT_END'])) );
                $child_node_laborContract->appendChild($child_node_End);
              }
            }
            // LaborContracts - VacationRights ОТПУСКА
            if(isset($array['vacations_array']) || isset($array['vacations2_array'])) {
              $child_node_VacationRights = $dom->createElement('VacationRights');
              $child_node_laborContract->appendChild($child_node_VacationRights);
              $child_node_VacationWorkPeriods = $dom->createElement('VacationWorkPeriods');
              $child_node_laborContract->appendChild($child_node_VacationWorkPeriods);
              $i = 1;
              if(isset($array['vacations_array'])) {
                foreach( $array['vacations_array'] as $vacation_period ) {
                  if( strtotime($vacation_period['word_period_begin']) > (!is_null($contract['CONTRACT_BEGIN']) ? strtotime($contract['CONTRACT_BEGIN']) : '1900-01-01' ) and 
                  strtotime($vacation_period['word_period_finish']) < ( is_null($contract['CONTRACT_END']) ? time() : strtotime($contract['CONTRACT_END']) ) ) {
                    $child_node_vacationRight = $dom->createElement('vacationRight');
                    $child_node_VacationRights->appendChild($child_node_vacationRight);

                      $child_node_VacationTypeCode = $dom->createElement('VacationTypeCode', '2');
                      $child_node_vacationRight->appendChild($child_node_VacationTypeCode);

                      $child_node_Periods = $dom->createElement('Periods');
                      $child_node_vacationRight->appendChild($child_node_Periods);
                        $day_counter = 0;
                        $child_node_periods = $dom->createElement('periods');
                        $child_node_Periods->appendChild($child_node_periods);
                          $child_node_Begin = $dom->createElement('Begin', date('Y-m-d', strtotime($vacation_period['word_period_begin'])) );
                          $child_node_periods->appendChild($child_node_Begin);
                          $child_node_End = $dom->createElement('End', date('Y-m-d', strtotime($vacation_period['word_period_finish'])) );
                          $child_node_periods->appendChild($child_node_End);
                          foreach( $vacation_period as $vacation ) { 
                            if (is_array($vacation)) {
                              !is_null($vacation['USEBDAYCAL']) ? $day_counter += intval($vacation['USEBDAYCAL']) : $day_counter += 0; 
                            }
                          }
                          $child_node_Days = $dom->createElement('Days', $day_counter );
                          $child_node_periods->appendChild($child_node_Days);
                    // LaborContracts - VacationWorkPeriods
                    $child_node_vacationWorkPeriod = $dom->createElement('vacationWorkPeriod');
                    $child_node_VacationWorkPeriods->appendChild($child_node_vacationWorkPeriod);
                      $child_node_Begin = $dom->createElement('Begin', date('Y-m-d', strtotime($vacation_period['word_period_begin'])) );
                      $child_node_vacationWorkPeriod->appendChild($child_node_Begin);
                      $child_node_End = $dom->createElement('End', date('Y-m-d', strtotime($vacation_period['word_period_finish'])) );
                      $child_node_vacationWorkPeriod->appendChild($child_node_End);
                      $child_node_PeriodNumber = $dom->createElement('PeriodNumber', $i );
                      $child_node_vacationWorkPeriod->appendChild($child_node_PeriodNumber);

                      $child_node_UsedVacations = $dom->createElement('UsedVacations');
                      $child_node_vacationWorkPeriod->appendChild($child_node_UsedVacations);
                        foreach( $vacation_period as $vacation ) {
                          if (is_array($vacation)) {
                            $child_node_usedVacations = $dom->createElement('usedVacations');
                            $child_node_UsedVacations->appendChild($child_node_usedVacations);
                              $child_node_Begin = $dom->createElement('Begin', date('Y-m-d', strtotime($vacation['DATE'])) );
                              $child_node_usedVacations->appendChild($child_node_Begin);
                              $child_node_End = $dom->createElement('End', date('Y-m-d', strtotime($vacation['DATEFACTFINISH'])) );
                              $child_node_usedVacations->appendChild($child_node_End);
                              $child_node_VacationTypeCode = $dom->createElement('VacationTypeCode', '2');
                              $child_node_usedVacations->appendChild($child_node_VacationTypeCode);
                              $child_node_Duration = $dom->createElement('Duration', $vacation['USEBDAYCAL']);
                              $child_node_usedVacations->appendChild($child_node_Duration);
                          }
                        }
                    $i += 1;
                  }
                }
              }
              if(isset($array['vacations2_array'])) {
                foreach( $array['vacations2_array'] as $vacation2_period ) {
                  if( strtotime($vacation2_period['DATEFINISH']) > time() && $contract_key === array_key_last($array['contracts_array'])) {
                    // здесь пишем декрет
                    $child_node_vacationRight = $dom->createElement('vacationRight');
                    $child_node_VacationRights->appendChild($child_node_vacationRight);

                      $child_node_VacationTypeCode = $dom->createElement('VacationTypeCode', '3');
                      $child_node_vacationRight->appendChild($child_node_VacationTypeCode);

                      $child_node_Periods = $dom->createElement('Periods');
                      $child_node_vacationRight->appendChild($child_node_Periods);
                        $child_node_periods = $dom->createElement('periods');
                        $child_node_Periods->appendChild($child_node_periods);
                          $child_node_Begin = $dom->createElement('Begin', date('Y-m-d', strtotime($vacation2_period['DATEBEGIN'])) );
                          $child_node_periods->appendChild($child_node_Begin);
                          $child_node_End = $dom->createElement('End', date('Y-m-d', strtotime($vacation2_period['DATEFINISH'])) );
                          $child_node_periods->appendChild($child_node_End);

                          $end = strtotime($vacation2_period['DATEFINISH']);
                          $begin = strtotime($vacation2_period['DATEBEGIN']);
                          $days = abs(round(($end - $begin)/86400));
                          $child_node_Days = $dom->createElement('Days', $days );
                          $child_node_periods->appendChild($child_node_Days);
                  } elseif ( strtotime($vacation2_period['DATEBEGIN']) > strtotime($contract['CONTRACT_BEGIN']) and 
                  strtotime($vacation2_period['DATEFINISH']) < ( is_null($contract['CONTRACT_END']) ? time() : strtotime($contract['CONTRACT_END']) ) ) {
                    $child_node_vacationRight = $dom->createElement('vacationRight');
                    $child_node_VacationRights->appendChild($child_node_vacationRight);

                      $child_node_VacationTypeCode = $dom->createElement('VacationTypeCode', '3');
                      $child_node_vacationRight->appendChild($child_node_VacationTypeCode);

                      $child_node_Periods = $dom->createElement('Periods');
                      $child_node_vacationRight->appendChild($child_node_Periods);
                        $child_node_periods = $dom->createElement('periods');
                        $child_node_Periods->appendChild($child_node_periods);
                          $child_node_Begin = $dom->createElement('Begin', date('Y-m-d', strtotime($vacation2_period['DATEBEGIN'])) );
                          $child_node_periods->appendChild($child_node_Begin);
                          $child_node_End = $dom->createElement('End', date('Y-m-d', strtotime($vacation2_period['DATEFINISH'])) );
                          $child_node_periods->appendChild($child_node_End);

                          $end = strtotime($vacation2_period['DATEFINISH']);
                          $begin = strtotime($vacation2_period['DATEBEGIN']);
                          $days = abs(round(($end - $begin)/86400));
                          $child_node_Days = $dom->createElement('Days', $days);
                          $child_node_periods->appendChild($child_node_Days);
                  }
                }
              }

            }
            // print '<pre>';
            // print_r($contract);
            // print '<pre>';
            // die;
            require "employee_retire_reason.php";
              
          // LaborContracts - ContractWorkType
          $child_node_ContractWorkType = $dom->createElement('ContractWorkType');
          $child_node_laborContract->appendChild($child_node_ContractWorkType);
            $child_node_contractWorkType = $dom->createElement('contractWorkType');
            $child_node_ContractWorkType->appendChild($child_node_contractWorkType);
              $child_node_Begin = $dom->createElement('Begin', !is_null($contract['CONTRACT_BEGIN']) ? date('Y-m-d', strtotime($contract['CONTRACT_BEGIN'])) : '1900-01-01' );
              $child_node_contractWorkType->appendChild($child_node_Begin);
              $child_node_Value = $dom->createElement('Value', 0);
              $child_node_contractWorkType->appendChild($child_node_Value);
          // LaborContracts - ContractType ВИД КОНТРАКТА
          $child_node_ContractType = $dom->createElement('ContractType');
          $child_node_laborContract->appendChild($child_node_ContractType);
            $child_node_contractType = $dom->createElement('contractType');
            $child_node_ContractType->appendChild($child_node_contractType);
              $child_node_Begin = $dom->createElement('Begin', !is_null($contract['CONTRACT_BEGIN']) ? date('Y-m-d', strtotime($contract['CONTRACT_BEGIN'])) : '1900-01-01' );
              $child_node_contractType->appendChild($child_node_Begin);
              $child_node_Value = $dom->createElement('Value', $contract['CONTRACT_TYPE'] == 2 ? '0' : '1' );
              $child_node_contractType->appendChild($child_node_Value);

              if($contract['CONTRACT_TYPE'] != 2) {
                switch ($contract['M_ORD_02_ID']) {
                  case 232:
                    $child_node_SigningReason = $dom->createElement('SigningReason', '25.4.1' );
                    $child_node_contractType->appendChild($child_node_SigningReason);
                    break;
                  case 233:
                    $child_node_SigningReason = $dom->createElement('SigningReason', '25.4.2' );
                    $child_node_contractType->appendChild($child_node_SigningReason);
                    break;
                  case 264:
                    $child_node_SigningReason = $dom->createElement('SigningReason', '25.4.7.1' );
                    $child_node_contractType->appendChild($child_node_SigningReason);
                    break;
                  case 259:
                    $child_node_SigningReason = $dom->createElement('SigningReason', '25.4.1' );
                    $child_node_contractType->appendChild($child_node_SigningReason);
                    break;
                  case 265:
                    $child_node_SigningReason = $dom->createElement('SigningReason', '25.4.7.1' );
                    $child_node_contractType->appendChild($child_node_SigningReason);
                    break;
                  case 262:
                    $child_node_SigningReason = $dom->createElement('SigningReason', '25.4.2' );
                    $child_node_contractType->appendChild($child_node_SigningReason);
                    break;
                  case 228:
                  case 229:
                  case 230:
                  case 231:
                  case 234:
                  case 235:
                  case 236:
                  case 300:
                  case 237:
                  case 254:
                  case 260:
                  case 299:
                  case 246:
                  case 244:
                  case 250:
                  case 242:
                  case 245:
                  case 238:
                  case 239:
                  case 240:
                  case 241:
                  case 247:
                  case 248:
                  case 249:
                  case 252:
                  case 255:
                  case 256:
                  case 301:
                  case 257:
                  case 284:
                  case 296:
                    $child_node_SigningReason = $dom->createElement('SigningReason', '25.4.8' );
                    $child_node_contractType->appendChild($child_node_SigningReason);
                    break;
                  default:
                    $child_node_SigningReason = $dom->createElement('SigningReason', '59' );
                    $child_node_contractType->appendChild($child_node_SigningReason);
                  break;
                }
              }
              if( !is_null($contract['CONTRACT_END']) ) {
                $child_node_End = $dom->createElement('End', date('Y-m-d', strtotime($contract['CONTRACT_END'])) );
                $child_node_contractType->appendChild($child_node_End);
              }
          // LaborContracts - PersonnelNumber 
          $child_node_PersonnelNumber = $dom->createElement('PersonnelNumber'); 
          $child_node_laborContract->appendChild($child_node_PersonnelNumber);

          // LaborContracts - Execposts 
          $child_node_Execposts = $dom->createElement('Execposts');
          $child_node_laborContract->appendChild($child_node_Execposts);
            if (isset($contract['doljnosti_array'])) {
              foreach ($contract['doljnosti_array'] as $doljnost) {
                // if (
                //     (strtotime($doljnost['STAJ_BEGIN']) >= strtotime($contract['CONTRACT_BEGIN']) 
                //     && strtotime($doljnost['STAJ_BEGIN']) <= (!is_null($contract['CONTRACT_END']) ? strtotime($contract['CONTRACT_END']) : time()) ) 
                //     || 
                //     ( (!is_null($doljnost['STAJ_END']) ? strtotime($doljnost['STAJ_END']) : time()) >= strtotime($contract['CONTRACT_BEGIN']) 
                //     && (!is_null($doljnost['STAJ_END']) ? strtotime($doljnost['STAJ_END']) : time()) <= strtotime($contract['CONTRACT_END']))
                //   ) 
                  // {
                    $child_node_execpost = $dom->createElement('execpost');
                    $child_node_Execposts->appendChild($child_node_execpost);
                      // if(!is_null($doljnost['STAJ_BEGIN']) && (strtotime($contract['CONTRACT_BEGIN']) <= strtotime($doljnost['STAJ_BEGIN']))) {
                        $child_node_Begin = $dom->createElement('Begin', date('Y-m-d', strtotime($doljnost['STAJ_BEGIN'])));
                      // } else {
                        // $child_node_Begin = $dom->createElement('Begin', date('Y-m-d', strtotime($contract['CONTRACT_BEGIN'])) );
                      // }

                      $child_node_execpost->appendChild($child_node_Begin);
                      $child_node_PostTypeIsAdditional = $dom->createElement('PostTypeIsAdditional', 'false');
                      $child_node_execpost->appendChild($child_node_PostTypeIsAdditional);
                      if ( !is_null($doljnost['STAJ_END']) ) {
                        $child_node_End = $dom->createElement('End', date('Y-m-d', strtotime($doljnost['STAJ_END'])));
                        $child_node_execpost->appendChild($child_node_End);
                      }
                      
                      // if ($counter != $len) {
                      //   if (!is_null($doljnost['STAJ_END']) && !is_null($contract['CONTRACT_END']) && (strtotime($doljnost['STAJ_END']) <= strtotime($contract['CONTRACT_END']))) {
                      //     $child_node_End = $dom->createElement('End', date('Y-m-d', strtotime($doljnost['STAJ_END'])));
                      //     $child_node_execpost->appendChild($child_node_End);
                      //   } else {
                      //     if ( !is_null($contract['CONTRACT_END']) ) {
                      //       $child_node_End = $dom->createElement('End', date('Y-m-d', strtotime($contract['CONTRACT_END'])));
                      //       $child_node_execpost->appendChild($child_node_End);
                      //     }
                      //   }
                      // }
                      $child_node_PositionCode = $dom->createElement('PositionCode', $array['REGION_COD'].'_'.$doljnost['SRT_ID']);
                      $child_node_execpost->appendChild($child_node_PositionCode);
                      $child_node_Rate = $dom->createElement('Rate');
                      $child_node_execpost->appendChild($child_node_Rate);
                        $child_node_rate = $dom->createElement('rate');
                        $child_node_Rate->appendChild($child_node_rate);
                          $child_node_Begin = $dom->createElement('Begin', date('Y-m-d', strtotime($doljnost['STAVKA_BEGIN'])));
                          $child_node_rate->appendChild($child_node_Begin);
                          $child_node_Value = $dom->createElement('Value', !is_null($doljnost['STAVKA']) ? $doljnost['STAVKA'] : '1.000' );
                          $child_node_rate->appendChild($child_node_Value);
                      $child_node_IsTargetedTraining = $dom->createElement('IsTargetedTraining', '0');
                      $child_node_execpost->appendChild($child_node_IsTargetedTraining);
                      $child_node_Schedule = $dom->createElement('Schedule');
                      $child_node_execpost->appendChild($child_node_Schedule);
                        $child_node_schedule = $dom->createElement('schedule');
                        $child_node_Schedule->appendChild($child_node_schedule);
                          $child_node_Begin = $dom->createElement('Begin', '1900-01-01');
                          $child_node_schedule->appendChild($child_node_Begin);
                          $child_node_Code = $dom->createElement('Code', '-');
                          $child_node_schedule->appendChild($child_node_Code);
                    
                      if ( !is_null($doljnost['PRIEM_PRIKAZ_DATE']) ) {
                        $child_node_RecruitOrderDate = $dom->createElement('RecruitOrderDate', date('Y-m-d', strtotime($doljnost['PRIEM_PRIKAZ_DATE'])));
                        $child_node_execpost->appendChild($child_node_RecruitOrderDate);
                      }
                      if ( !is_null($doljnost['PRIEM_PRIKAZ_NUM']) ) {
                        $child_node_RecruitOrderNumber = $dom->createElement('RecruitOrderNumber', $doljnost['PRIEM_PRIKAZ_NUM']);
                        $child_node_execpost->appendChild($child_node_RecruitOrderNumber);
                      }

                      if ( !is_null($doljnost['RETIRE_PRIKAZ_DATE']) ) {
                        $child_node_RetireOrderDate = $dom->createElement('RetireOrderDate', date('Y-m-d', strtotime($doljnost['RETIRE_PRIKAZ_DATE'])));
                        $child_node_execpost->appendChild($child_node_RetireOrderDate);
                      }
                      
                      if ( !is_null($doljnost['RETIRE_PRIKAZ_NUM']) ) {
                        $child_node_RetireOrderNumber = $dom->createElement('RetireOrderNumber',  $doljnost['RETIRE_PRIKAZ_NUM']);
                        $child_node_execpost->appendChild($child_node_RetireOrderNumber);
                      }

                      if (isset($array['oklads_array'])) {
                        $child_node_Surcharge = $dom->createElement('Surcharge');
                        $child_node_execpost->appendChild($child_node_Surcharge);
                          $oklad_sorted_array = array();
                          foreach($array['oklads_array'] as $srt_id => $oklad_array) {
                            if($contract['SRT_ID'] == $srt_id) {
                              foreach($oklad_array as $oklad) {
                                if (
                                  (strtotime($oklad['BEGIN_OKLAD']) >= strtotime($doljnost['STAJ_BEGIN']) 
                                  && strtotime($oklad['BEGIN_OKLAD']) <= (!is_null($doljnost['STAJ_END']) ? strtotime($doljnost['STAJ_END']) : time() )) 
                                  || 
                                  ( (!is_null($oklad['FINISH_OKLAD']) ? strtotime($oklad['FINISH_OKLAD']) : time()) >= strtotime($doljnost['STAJ_BEGIN']) 
                                  && (!is_null($oklad['FINISH_OKLAD']) ? strtotime($oklad['FINISH_OKLAD']) : time()) <= (!is_null($doljnost['STAJ_END']) ? strtotime($doljnost['STAJ_END']) : time() ))
                                  ) {
                                    array_push($oklad_sorted_array, $oklad);
                                  }
                                }
                                $oklad_array_len = count($oklad_sorted_array);
                                $oklad_counter = 1;
                                foreach ($oklad_sorted_array as $oklad) {
                                  $child_node_surcharge = $dom->createElement('surcharge');
                                  $child_node_Surcharge->appendChild($child_node_surcharge);
                                    if($oklad_counter == 1) {
                                      $child_node_Begin = $dom->createElement('Begin', !is_null($doljnost['STAJ_BEGIN']) ? date('Y-m-d', strtotime($doljnost['STAJ_BEGIN'])) : '1900-01-01' ); 
                                      $child_node_surcharge->appendChild($child_node_Begin);
                                    } else {
                                      $child_node_Begin = $dom->createElement('Begin', !is_null($oklad['BEGIN_OKLAD']) ? date('Y-m-d', strtotime($oklad['BEGIN_OKLAD'])) : '1900-01-01' ); 
                                      $child_node_surcharge->appendChild($child_node_Begin);
                                    }
                                    if ($oklad_counter == $oklad_array_len) {
                                      if (!is_null($doljnost['STAJ_END'])) {
                                        $child_node_End = $dom->createElement('End', date('Y-m-d', strtotime($doljnost['STAJ_END'])) );
                                        $child_node_surcharge->appendChild($child_node_End);
                                      }
                                    } else {
                                      if (!is_null($oklad['FINISH_OKLAD'])) {
                                        $child_node_End = $dom->createElement('End', date('Y-m-d', strtotime($oklad['FINISH_OKLAD'])) );
                                        $child_node_surcharge->appendChild($child_node_End);
                                      }
                                    }

                                    // $child_node_End = $dom->createElement('End', is_null(date('Y-m-d', strtotime($contract['FINISH_OKLAD']))) ? '' : date('Y-m-d', strtotime($contract['FINISH_OKLAD'])) );
                                    // $child_node_surcharge->appendChild($child_node_End);
                                    
                                    if ( str_contains($contract['REESTR_FULLNAME'], 'Реестр государственных должностей АО') ) {
                                      $child_node_Code = $dom->createElement('Code', "0101");
                                      $child_node_surcharge->appendChild($child_node_Code);
                                    } elseif( str_contains($contract['REESTR_FULLNAME'], 'Государственные служащие') ) {
                                      $child_node_Code = $dom->createElement('Code', "01");
                                      $child_node_surcharge->appendChild($child_node_Code);
                                    } elseif( str_contains($contract['REESTR_FULLNAME'], 'Должности не отнесенные к государственной службе') ) {
                                      $child_node_Code = $dom->createElement('Code', "296");
                                      $child_node_surcharge->appendChild($child_node_Code);
                                    } else {
                                      $child_node_Code = $dom->createElement('Code', "-");
                                      $child_node_surcharge->appendChild($child_node_Code);
                                    }
    
                                    $child_node_Value = $dom->createElement('Value', $oklad['RAZMER_OKLADA'] == "" ? '0' : $oklad['RAZMER_OKLADA']);
                                    $child_node_surcharge->appendChild($child_node_Value);

                                    $oklad_counter += 1;
                                }
                              
                            }
                          }
                      }

                      if (isset($doljnost['Appointment_Reason'])) {
                        require "employee_appointment_reason.php";
                        
                      }
                // }
              }

            }
          // BusinessTrips
          if(isset($array['businesstips_array'])) {
            $child_node_BusinessTrips = $dom->createElement('BusinessTrips');
            $child_node_laborContract->appendChild($child_node_BusinessTrips);
            foreach($array['businesstips_array'] as $bussinestip) {
              // Проверяем на соответсвие командировки этому контракту
              if ( strtotime($bussinestip['businesstip_BEGIN']) > ( !is_null($contract['CONTRACT_BEGIN']) ? strtotime($contract['CONTRACT_BEGIN']) : '1900-01-01' ) and 
                  strtotime($bussinestip['businesstip_FINISH']) < ( is_null($contract['CONTRACT_END']) ? time() : strtotime($contract['CONTRACT_END']) ) ) {
                $child_node_businesstrip = $dom->createElement('businesstrip');
                $child_node_BusinessTrips->appendChild($child_node_businesstrip);
                  $child_node_Begin = $dom->createElement('Begin', date('Y-m-d', strtotime($bussinestip['businesstip_BEGIN'])) );
                  $child_node_businesstrip->appendChild($child_node_Begin);
                  $child_node_End = $dom->createElement('End', date('Y-m-d', strtotime($bussinestip['businesstip_FINISH'])) );
                  $child_node_businesstrip->appendChild($child_node_End);
                  $child_node_Destination = $dom->createElement('Destination', $bussinestip['businesstip_PLACE'] );
                  $child_node_businesstrip->appendChild($child_node_Destination);

                  $child_node_OrderNumber = $dom->createElement('OrderNumber', !is_null($bussinestip['DOC_NUM']) ? $bussinestip['DOC_NUM'] : '-' );
                  $child_node_businesstrip->appendChild($child_node_OrderNumber);
                  
                  $child_node_OrderDate = $dom->createElement('OrderDate', !is_null($bussinestip['DOC_DATE']) ? date('Y-m-d', strtotime($bussinestip['DOC_DATE'])) : '1900-01-01' );
                  $child_node_businesstrip->appendChild($child_node_OrderDate);

                  $child_node_Reason = $dom->createElement('Reason', !is_null($bussinestip['businesstip_REASON']) ? $bussinestip['businesstip_REASON'] : '-' );
                  $child_node_businesstrip->appendChild($child_node_Reason);
              }
            }
          }
          // SickLeaves
          if(isset($contract['sick_array'])) { 
            // print '<pre>';
            // print_r($contract['sick_array']);
            // print '<pre>';
            // die;
            $child_node_SickLeaves = $dom->createElement('SickLeaves');
            $child_node_laborContract->appendChild($child_node_SickLeaves);
              foreach( $contract['sick_array'] as $sick ) {
                // if (strtotime($sick['SICK_BEGIN']) > strtotime($contract['CONTRACT_BEGIN']) and 
                // strtotime($sick['SICK_END']) < ( is_null($contract['CONTRACT_END']) ? time() : strtotime($contract['CONTRACT_END'])) ) {
                $child_node_sickleave = $dom->createElement('sickleave');
                $child_node_SickLeaves->appendChild($child_node_sickleave);
                  $child_node_Begin = $dom->createElement('Begin', date('Y-m-d', strtotime($sick['SICK_BEGIN'])) );
                  $child_node_sickleave->appendChild($child_node_Begin);
                  $child_node_End = $dom->createElement('End', date('Y-m-d', strtotime($sick['SICK_END'])) );
                  $child_node_sickleave->appendChild($child_node_End);
                  $child_node_MedicalCertificateNumber = $dom->createElement('MedicalCertificateNumber', !is_null($sick['SICK_NUM']) ? $sick['SICK_NUM'] : '-' );
                  $child_node_sickleave->appendChild($child_node_MedicalCertificateNumber);
                  $child_node_MedicalCertificateDate = $dom->createElement('MedicalCertificateDate', date('Y-m-d', strtotime($sick['SICK_DATEGIVEN'])) );
                  $child_node_sickleave->appendChild($child_node_MedicalCertificateDate);
                  switch ($sick['SICK_CODE']) {
                    case 1:
                      $child_node_ReasonCode = $dom->createElement('ReasonCode', '01');
                      $child_node_sickleave->appendChild($child_node_ReasonCode);
                      break;
                    case 2:
                      $child_node_ReasonCode = $dom->createElement('ReasonCode', '09');
                      $child_node_sickleave->appendChild($child_node_ReasonCode);
                      break;
                    case 3:
                      $child_node_ReasonCode = $dom->createElement('ReasonCode', '05');
                      $child_node_sickleave->appendChild($child_node_ReasonCode);
                      break;
                    default:
                      $child_node_ReasonCode = $dom->createElement('ReasonCode', '0');
                      $child_node_sickleave->appendChild($child_node_ReasonCode);
                      break;
                  }
                // }
              }
              if(isset($contract['sickpregnant_array'])) { 
              foreach( $contract['sickpregnant_array'] as $sickpregnant ) {
                $child_node_sickleave = $dom->createElement('sickleave');
                $child_node_SickLeaves->appendChild($child_node_sickleave);
                  $child_node_Begin = $dom->createElement('Begin', date('Y-m-d', strtotime($sickpregnant['DATEBEGIN'])) );
                  $child_node_sickleave->appendChild($child_node_Begin);
                  $child_node_End = $dom->createElement('End', date('Y-m-d', strtotime($sickpregnant['DATEFINISH'])) );
                  $child_node_sickleave->appendChild($child_node_End);
                  $child_node_MedicalCertificateNumber = $dom->createElement('MedicalCertificateNumber', !is_null($sickpregnant['DOC_NUM']) ? $sickpregnant['DOC_NUM'] : '-' );
                  $child_node_sickleave->appendChild($child_node_MedicalCertificateNumber);
                  $child_node_MedicalCertificateDate = $dom->createElement('MedicalCertificateDate', date('Y-m-d', strtotime($sickpregnant['DATEFINISH'])) );
                  $child_node_sickleave->appendChild($child_node_MedicalCertificateDate);
                  $child_node_ReasonCode = $dom->createElement('ReasonCode', '05');
                  $child_node_sickleave->appendChild($child_node_ReasonCode);
              }
            }
          }
        }
      }
      // GovProfEducation 
      $child_node_GovProfEducation = $dom->createElement('GovProfEducation');
      $Employee_node->appendChild($child_node_GovProfEducation);
      if(isset($array['education_array'])) {
        foreach(($array['education_array']) as $education) {
        $child_node_govprofeducation = $dom->createElement('govprofeducation');
        $child_node_GovProfEducation->appendChild($child_node_govprofeducation);
          $child_node_Begin = $dom->createElement('Begin', !is_null($education['EDUCATION_BEGIN']) ? date('Y-m-d', strtotime($education['EDUCATION_BEGIN'])) : '1900-01-01' );
          $child_node_govprofeducation->appendChild($child_node_Begin);
          if (!is_null($education['EDUCATION_FINISH'])) {
            $child_node_End = $dom->createElement('End', date('Y-m-d', strtotime($education['EDUCATION_FINISH'])));
            $child_node_govprofeducation->appendChild($child_node_End);
          } 
          // $child_node_LevelCode = $dom->createElement('LevelCode', $education['EDUCATION_LEVEL']);
          // $child_node_govprofeducation->appendChild($child_node_LevelCode);
          switch ($education['EDUCATION_LEVEL']) {
            case 35:
              $child_node_LevelCode = $dom->createElement('LevelCode', '03');
              $child_node_govprofeducation->appendChild($child_node_LevelCode);
              break;
            case 36:
              $child_node_LevelCode = $dom->createElement('LevelCode', '04');
              $child_node_govprofeducation->appendChild($child_node_LevelCode);
              break;
            case 19:
              $child_node_LevelCode = $dom->createElement('LevelCode', '05');
              $child_node_govprofeducation->appendChild($child_node_LevelCode);
              break;
            case 37:
              $child_node_LevelCode = $dom->createElement('LevelCode', '08');
              $child_node_govprofeducation->appendChild($child_node_LevelCode);
              break;
            case 28:
              $child_node_LevelCode = $dom->createElement('LevelCode', '03');
              $child_node_govprofeducation->appendChild($child_node_LevelCode);
              break;
            case 29:
              $child_node_LevelCode = $dom->createElement('LevelCode', '13');
              $child_node_govprofeducation->appendChild($child_node_LevelCode);
              break;
            case 30:
              $child_node_LevelCode = $dom->createElement('LevelCode', '11');
              $child_node_govprofeducation->appendChild($child_node_LevelCode);
              break;
            case 31:
              $child_node_LevelCode = $dom->createElement('LevelCode', '12');
              $child_node_govprofeducation->appendChild($child_node_LevelCode);
              break;
            case 32:
              $child_node_LevelCode = $dom->createElement('LevelCode', '03');
              $child_node_govprofeducation->appendChild($child_node_LevelCode);
              break;
            case 33:
              $child_node_LevelCode = $dom->createElement('LevelCode', '14');
              $child_node_govprofeducation->appendChild($child_node_LevelCode);
              break;
            case 34:
              $child_node_LevelCode = $dom->createElement('LevelCode', '15');
              $child_node_govprofeducation->appendChild($child_node_LevelCode);
              break;
            default:
              $child_node_LevelCode = $dom->createElement('LevelCode', '0');
              $child_node_govprofeducation->appendChild($child_node_LevelCode);
              break;
          }

          $child_node_PlaceOfEducation = $dom->createElement('PlaceOfEducation', !is_null($education['EDUCATION_ORGANIZATION']) ? $education['EDUCATION_ORGANIZATION'] : '-'); 
          $child_node_govprofeducation->appendChild($child_node_PlaceOfEducation);
          $child_node_DocumentDate = $dom->createElement('DocumentDate', !is_null($education['EDUCATION_DOC_DATE']) ? date('Y-m-d', strtotime($education['EDUCATION_DOC_DATE'])) : '1900-01-01' );
          $child_node_govprofeducation->appendChild($child_node_DocumentDate);
          $child_node_DocumentSeries = $dom->createElement('DocumentSeries', !is_null($education['EDUCATION_DOC_SER']) ? $education['EDUCATION_DOC_SER'] : '-' );
          $child_node_govprofeducation->appendChild($child_node_DocumentSeries);
          $child_node_DocumentNumber = $dom->createElement('DocumentNumber', !is_null($education['EDUCATION_DOC_NUMB']) ? $education['EDUCATION_DOC_NUMB'] : '-' );
          $child_node_govprofeducation->appendChild($child_node_DocumentNumber);
          if(!is_null($education['OKSO_COD'])) {
            $child_node_SpecialityCode = $dom->createElement('SpecialityCode', $education['OKSO_COD']);
            $child_node_govprofeducation->appendChild($child_node_SpecialityCode);
          } else {
            $child_node_SpecialityCode = $dom->createElement('SpecialityCode', '0');
            $child_node_govprofeducation->appendChild($child_node_SpecialityCode);
          }
          $child_node_QualificationCode = $dom->createElement('QualificationCode', !is_null($education['Qualification']) ? $education['Qualification'] : '-' );
          $child_node_govprofeducation->appendChild($child_node_QualificationCode);

          if ( count($array['education_array']) > 1 ) {
            if ( str_contains($education['EDUCATION_ORGANIZATION'], '+') ) {
              $child_node_IsPrimary = $dom->createElement('IsPrimary', 'true');
              $child_node_govprofeducation->appendChild($child_node_IsPrimary);
            } else {
              $child_node_IsPrimary = $dom->createElement('IsPrimary', 'false');
              $child_node_govprofeducation->appendChild($child_node_IsPrimary);
            }
          } else {
            $child_node_IsPrimary = $dom->createElement('IsPrimary', 'true');
            $child_node_govprofeducation->appendChild($child_node_IsPrimary);
          }
          $child_node_FormCode = $dom->createElement('FormCode', '1');
          $child_node_govprofeducation->appendChild($child_node_FormCode);
        }
      }
      // GovPostGraduateEducation - Послевузовское образование
      if ( isset($array['after_education_array']) ) {
        $child_node_GovPostGraduateEducation = $dom->createElement('GovPostGraduateEducation');
        $Employee_node->appendChild($child_node_GovPostGraduateEducation);
        foreach($array['after_education_array'] as $after_education) {
          $child_node_govpostgraduateeducation = $dom->createElement('govpostgraduateeducation');
          $child_node_GovPostGraduateEducation->appendChild($child_node_govpostgraduateeducation);
            $child_node_Begin = $dom->createElement('Begin', '1900-01-01');
            $child_node_govpostgraduateeducation->appendChild($child_node_Begin);
            $child_node_End = $dom->createElement('End', date('Y-m-d', strtotime($after_education['AFTER_EDU_DATE'])));
            $child_node_govpostgraduateeducation->appendChild($child_node_End);
            $child_node_LevelCode = $dom->createElement('LevelCode', '0');
            $child_node_govpostgraduateeducation->appendChild($child_node_LevelCode);
            $child_node_PlaceOfEducation = $dom->createElement('PlaceOfEducation', 'no_data');
            $child_node_govpostgraduateeducation->appendChild($child_node_PlaceOfEducation);
            // $child_node_DocumentName = $dom->createElement('DocumentName', 'no_data');
            // $child_node_govpostgraduateeducation->appendChild($child_node_DocumentName);
            $child_node_DocumentDate = $dom->createElement('DocumentDate', date('Y-m-d', strtotime($after_education['AFTER_EDU_DATE']))  );
            $child_node_govpostgraduateeducation->appendChild($child_node_DocumentDate);
            $child_node_DocumentNumber = $dom->createElement('DocumentNumber', '0');
            $child_node_govpostgraduateeducation->appendChild($child_node_DocumentNumber);
            $child_node_SpecialityCode = $dom->createElement('SpecialityCode', $after_education['AFTER_EDU_SPEC']);
            $child_node_govpostgraduateeducation->appendChild($child_node_SpecialityCode);
            $child_node_DegreeCode = $dom->createElement('DegreeCode', $after_education['AFTER_DEGREECODE'] );
            $child_node_govpostgraduateeducation->appendChild($child_node_DegreeCode);
            $child_node_AwardDate = $dom->createElement('AwardDate', '1900-01-01');
            $child_node_govpostgraduateeducation->appendChild($child_node_AwardDate);
        }
      }
        
      // GovAdditionalEducation 
      if(isset($array['addedu_array']) || isset($array['addedu2_array'])) {
        $child_node_GovAdditionalEducation = $dom->createElement('GovAdditionalEducation');
        $Employee_node->appendChild($child_node_GovAdditionalEducation);
        if ( isset($array['addedu_array']) ) {
          foreach(($array['addedu_array']) as $addedu) {
            $child_node_govadditionaleducation = $dom->createElement('govadditionaleducation');
            $child_node_GovAdditionalEducation->appendChild($child_node_govadditionaleducation);
              $child_node_Begin = $dom->createElement('Begin', date('Y-m-d', strtotime($addedu['DATEBEGIN'])) );
              $child_node_govadditionaleducation->appendChild($child_node_Begin);
              if (!is_null($addedu['DATEFINISH'])) {
                // $child_node_End = $dom->createElement('End', !is_null($addedu['DATEFINISH']) ? date('Y-m-d', strtotime($addedu['DATEFINISH'])) : '' );
                $child_node_End = $dom->createElement('End', date('Y-m-d', strtotime($addedu['DATEFINISH'])) );
                $child_node_govadditionaleducation->appendChild($child_node_End);
              }

              $child_node_ProgramType = $dom->createElement('ProgramType', '1' );
              $child_node_govadditionaleducation->appendChild($child_node_ProgramType);
              $child_node_Speciality = $dom->createElement('Speciality', $addedu['EDUPROG'] );
              $child_node_govadditionaleducation->appendChild($child_node_Speciality);
              if ( !is_null($addedu['HOURS']) ) {
                $child_node_HoursAmount = $dom->createElement('HoursAmount', $addedu['HOURS'] );
                $child_node_govadditionaleducation->appendChild($child_node_HoursAmount);
              }
              $child_node_Document = $dom->createElement('Document', '1' );
              $child_node_govadditionaleducation->appendChild($child_node_Document);
              $child_node_DocumentDate = $dom->createElement('DocumentDate', '1900-01-01' );
              $child_node_govadditionaleducation->appendChild($child_node_DocumentDate);
              $child_node_DocumentNumber = $dom->createElement('DocumentNumber', '-' );
              $child_node_govadditionaleducation->appendChild($child_node_DocumentNumber);
              $child_node_IsDistance = $dom->createElement('IsDistance', 'false' );
              $child_node_govadditionaleducation->appendChild($child_node_IsDistance);
              $child_node_PlaceOfEducation = $dom->createElement('PlaceOfEducation', $addedu['ORG'] );
              $child_node_govadditionaleducation->appendChild($child_node_PlaceOfEducation);
          }
        }
        if ( isset($array['addedu2_array']) ) {
          foreach(($array['addedu2_array']) as $addedu2) {
            $child_node_govadditionaleducation = $dom->createElement('govadditionaleducation');
            $child_node_GovAdditionalEducation->appendChild($child_node_govadditionaleducation);
              $child_node_Begin = $dom->createElement('Begin', !is_null($addedu2['DATEBEGIN']) ? date('Y-m-d', strtotime($addedu2['DATEBEGIN'])) : '1900-01-01' );
              $child_node_govadditionaleducation->appendChild($child_node_Begin);
              $child_node_End = $dom->createElement('End', !is_null($addedu2['DATEFINISH']) ? date('Y-m-d', strtotime($addedu2['DATEFINISH'])) : '2100-01-01');
              $child_node_govadditionaleducation->appendChild($child_node_End);
              $child_node_ProgramType = $dom->createElement('ProgramType', '0' );
              $child_node_govadditionaleducation->appendChild($child_node_ProgramType);
              $child_node_Speciality = $dom->createElement('Speciality', $addedu2['SPECIAL'] );
              $child_node_govadditionaleducation->appendChild($child_node_Speciality);
              $child_node_Document = $dom->createElement('Document', '6' );
              $child_node_govadditionaleducation->appendChild($child_node_Document);
              $child_node_DocumentDate = $dom->createElement('DocumentDate', '1900-01-01' );
              $child_node_govadditionaleducation->appendChild($child_node_DocumentDate);
              $child_node_DocumentNumber = $dom->createElement('DocumentNumber', '-' );
              $child_node_govadditionaleducation->appendChild($child_node_DocumentNumber);
              $child_node_IsDistance = $dom->createElement('IsDistance', 'false' );
              $child_node_govadditionaleducation->appendChild($child_node_IsDistance);
              $child_node_PlaceOfEducation = $dom->createElement('PlaceOfEducation', $addedu2['ORG'] );
              $child_node_govadditionaleducation->appendChild($child_node_PlaceOfEducation);
          }
        }
      }

      // Attestation 
      if(isset($array['attestation_array'])) {
        $child_node_Attestation = $dom->createElement('Attestation');
        $Employee_node->appendChild($child_node_Attestation);
        foreach(($array['attestation_array']) as $attestation) {
          $child_node_attestation = $dom->createElement('attestation');
          $child_node_Attestation->appendChild($child_node_attestation);
            $child_node_Begin = $dom->createElement('Begin', date('Y-m-d', strtotime($attestation['ATTESTATION_DATE'])) );
            $child_node_attestation->appendChild($child_node_Begin);
            if( !is_null($attestation['COMMISSION_DECISION_CODE']) ) {
              switch ($attestation['COMMISSION_DECISION_CODE']) {
                case 3:
                  $child_node_Code = $dom->createElement('Code', '04');
                  $child_node_attestation->appendChild($child_node_Code);
                  break;
                case 4:
                  $child_node_Code = $dom->createElement('Code', '02');
                  $child_node_attestation->appendChild($child_node_Code);
                  break;
                case 5:
                  $child_node_Code = $dom->createElement('Code', '01');
                  $child_node_attestation->appendChild($child_node_Code);
                  break;
                case 14:
                  $child_node_Code = $dom->createElement('Code', '03');
                  $child_node_attestation->appendChild($child_node_Code);
                  break;
              }
            }

            $child_node_ProtocolDate = $dom->createElement('ProtocolDate', !is_null($attestation['POTOCOL_DATE']) ? date('Y-m-d', strtotime($attestation['POTOCOL_DATE'])) : date('Y-m-d', strtotime($attestation['ATTESTATION_DATE'])) );
            $child_node_attestation->appendChild($child_node_ProtocolDate);

            if ( $attestation['PROTOCOL_ID'] != 18 ) {
              $child_node_ProtocolNumber = $dom->createElement('ProtocolNumber', $attestation['PROTOCOL_NUM'].'п');
              $child_node_attestation->appendChild($child_node_ProtocolNumber);
            } else {
              $child_node_ProtocolNumber = $dom->createElement('ProtocolNumber', !is_null($attestation['PROTOCOL_NUM']) ? $attestation['PROTOCOL_NUM'] : '-');
              $child_node_attestation->appendChild($child_node_ProtocolNumber);
            }
        }
      }
      // Reward 
      $child_node_Reward = $dom->createElement('Reward');
      $Employee_node->appendChild($child_node_Reward);
        if( isset($array['rewards_array']) ) {
          foreach( $array['rewards_array'] as $reward ) {
            $child_node_reward = $dom->createElement('reward');
            $child_node_Reward->appendChild($child_node_reward);
              $child_node_Begin = $dom->createElement('Begin', date('Y-m-d', strtotime($reward['REWARD_DATE'])));
              $child_node_reward->appendChild($child_node_Begin);
              $child_node_Code = $dom->createElement('Code', $reward['REWARD_ID']);
              $child_node_reward->appendChild($child_node_Code);
              $child_node_Number = $dom->createElement('Number', !is_null($reward['DOC_NUM']) ? $reward['DOC_NUM'] : '-' );
              $child_node_reward->appendChild($child_node_Number);
              $child_node_RewardDate = $dom->createElement('RewardDate', date('Y-m-d', strtotime($reward['REWARD_DATE'])) );
              $child_node_reward->appendChild($child_node_RewardDate);
          }
        }
        if( isset($array['rewards2_array']) ) {
          foreach( $array['rewards2_array'] as $reward2 ) {
            $child_node_reward = $dom->createElement('reward');
            $child_node_Reward->appendChild($child_node_reward);
              $child_node_Begin = $dom->createElement('Begin', date('Y-m-d', strtotime($reward2['REWARD_DATE'])));
              $child_node_reward->appendChild($child_node_Begin);
              if ($reward2['REWARD_ID'] == 13) {
                $child_node_Code = $dom->createElement('Code', 1013);
                $child_node_reward->appendChild($child_node_Code);
              } elseif ($reward2['REWARD_ID'] == 15) {
                $child_node_Code = $dom->createElement('Code', 1015);
                $child_node_reward->appendChild($child_node_Code);
              } else {
                $child_node_Code = $dom->createElement('Code', $reward2['REWARD_ID']);
                $child_node_reward->appendChild($child_node_Code);
              }
              $child_node_Number = $dom->createElement('Number', !is_null($reward2['DOC_NUM']) ? $reward2['DOC_NUM'] : '-' );
              $child_node_reward->appendChild($child_node_Number);
              $child_node_RewardDate = $dom->createElement('RewardDate', date('Y-m-d', strtotime($reward2['REWARD_DATE'])) );
              $child_node_reward->appendChild($child_node_RewardDate);
          }
        }

      // SeniorityPeriods
      $child_node_SeniorityPeriods = $dom->createElement('SeniorityPeriods');
      $Employee_node->appendChild($child_node_SeniorityPeriods);
        if(isset($array['staj_array'])) {
          foreach($array['staj_array'] as $staj) {
            $child_node_seniorityperiod = $dom->createElement('seniorityperiod');
            $child_node_SeniorityPeriods->appendChild($child_node_seniorityperiod);
              $child_node_Begin = $dom->createElement('Begin', date('Y-m-d', strtotime($staj['STAJ_BEGIN'])));
              $child_node_seniorityperiod->appendChild($child_node_Begin);
              if (!is_null($staj['STAJ_END'])) {
                $child_node_End = $dom->createElement('End', date('Y-m-d', strtotime($staj['STAJ_END'])));
                $child_node_seniorityperiod->appendChild($child_node_End);
              }
              $child_node_Post = $dom->createElement('Post', !is_null($staj['STAJ_DOLJNOST']) ? $staj['STAJ_DOLJNOST'] : '-');
              $child_node_seniorityperiod->appendChild($child_node_Post);
              $child_node_OrganizationName = $dom->createElement('OrganizationName', !is_null($staj['STAJ_ORGANIZATION']) ? $staj['STAJ_ORGANIZATION'] : '-');
              $child_node_seniorityperiod->appendChild($child_node_OrganizationName);
              $child_node_OrganizationAddress = $dom->createElement('OrganizationAddress');
              $child_node_seniorityperiod->appendChild($child_node_OrganizationAddress);
              $child_node_SeniorityUnits = $dom->createElement('SeniorityUnits');
              $child_node_seniorityperiod->appendChild($child_node_SeniorityUnits);
                // $child_node_seniorityunit = $dom->createElement('seniorityunit');
                // $child_node_SeniorityUnits->appendChild($child_node_seniorityunit);
                  if(isset($staj['staj_types']) && count($staj['staj_types'])){
                    foreach($staj['staj_types'] as $type) {
                      $child_node_seniorityunit = $dom->createElement('seniorityunit');
                      $child_node_SeniorityUnits->appendChild($child_node_seniorityunit);
                      switch ($type['STAJ_TYPE']) {
                        case 1:
                          $child_node_SeniorityTypeCode = $dom->createElement('SeniorityTypeCode', '03');
                          $child_node_seniorityunit->appendChild($child_node_SeniorityTypeCode);
                          if ($type['COEFFICIENT'] == 2) {
                            $child_node_Coefficient = $dom->createElement('Coefficient', 2);
                            $child_node_seniorityunit->appendChild($child_node_Coefficient); 
                          } else {
                            $child_node_Coefficient = $dom->createElement('Coefficient', 1);
                            $child_node_seniorityunit->appendChild($child_node_Coefficient);
                          }
                          break;
                        case 2:
                          $child_node_SeniorityTypeCode = $dom->createElement('SeniorityTypeCode', '01');
                          $child_node_seniorityunit->appendChild($child_node_SeniorityTypeCode);
                          $child_node_Coefficient = $dom->createElement('Coefficient', 1);
                          $child_node_seniorityunit->appendChild($child_node_Coefficient);
                          break;
                        case 3:
                          $child_node_SeniorityTypeCode = $dom->createElement('SeniorityTypeCode', '02');
                          $child_node_seniorityunit->appendChild($child_node_SeniorityTypeCode);
                          $child_node_Coefficient = $dom->createElement('Coefficient', 1);
                          $child_node_seniorityunit->appendChild($child_node_Coefficient);
                          break;
                        case 4:
                          $child_node_SeniorityTypeCode = $dom->createElement('SeniorityTypeCode', '09');
                          $child_node_seniorityunit->appendChild($child_node_SeniorityTypeCode);
                          $child_node_Coefficient = $dom->createElement('Coefficient', 1);
                          $child_node_seniorityunit->appendChild($child_node_Coefficient);
                          break;
                        case 5:
                          $child_node_SeniorityTypeCode = $dom->createElement('SeniorityTypeCode', '08');
                          $child_node_seniorityunit->appendChild($child_node_SeniorityTypeCode);
                          $child_node_Coefficient = $dom->createElement('Coefficient', 1);
                          $child_node_seniorityunit->appendChild($child_node_Coefficient);
                          break;
                        case 7:
                          $child_node_SeniorityTypeCode = $dom->createElement('SeniorityTypeCode', '05');
                          $child_node_seniorityunit->appendChild($child_node_SeniorityTypeCode);
                          $child_node_Coefficient = $dom->createElement('Coefficient', 1);
                          $child_node_seniorityunit->appendChild($child_node_Coefficient);
                          break;
                        default:
                          // $child_node_SeniorityTypeCode = $dom->createElement('SeniorityTypeCode', '0');
                          // $child_node_seniorityunit->appendChild($child_node_SeniorityTypeCode);
                          // $child_node_Coefficient = $dom->createElement('Coefficient', 1);
                          // $child_node_seniorityunit->appendChild($child_node_Coefficient);
                          break;
                      }
                      
                    }
                  }
                    // $child_node_Coefficient = $dom->createElement('Coefficient', 1);
                    // $child_node_seniorityunit->appendChild($child_node_Coefficient);
          }
        }

    $root->appendChild($Employee_node);

  // }
}

$all_data = get_all();
// $addresses_array = array();

$json = file_get_contents($main_path . '\Json_returns\2024\employees\employee_address.json');
$addresses_array = json_decode($json, true);

// Check if the decoding was successful
// if ($addresses_array !== null) {
//   // Print the first 5 lines
//   echo $addresses_array['40_1023']['40_243']['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['metaDataProperty']['GeocoderMetaData']['text'];
// } else {
//   echo "Failed to decode JSON data." . PHP_EOL;
// }
// die;

foreach($all_data as $key => $ministerstvo) {
  global $main_path;
  $dom = new DOMDocument();
		$dom->encoding = 'utf-8';
		$dom->xmlVersion = '1.0';
		$dom->formatOutput = true;

	$xml_file_name = $main_path . '\xml_returns\2024\employees\\'.$key.'_employees.xml';

    $root = $dom->createElement('Employees');
      foreach($ministerstvo as $person) {
        makeFile($person, $dom, $root, $key, $addresses_array);
      }

    $dom->appendChild($root);

	$dom->save($xml_file_name);
	echo "$xml_file_name has been successfully created"."\n";
}

?>