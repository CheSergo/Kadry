<?php

$all_data = array(); //Итоговый многомерный ассоциативный массив

function init_data_fetch($row, $index, &$array) {
  $row = $row;

  if (isset($row[$index]) && !is_null($row[$index])) {
    $key = $row[$index + 1]."_".$row[$index];
    if ( !array_key_exists($key, $array) ) {
      $array[$key] = array(
        'CODE' => $row[$index + 1]."_".$row[$index],
        'NAME' => trim($row[$index + 2]),
        'FAMILY' => trim($row[$index + 3]),
        'LSTNAME' => trim($row[$index + 4]),
        'BIRTHDATE' => $row[$index + 5],
        'BIRTHPLACE' => trim($row[$index + 6]),
        'SEX' => $row[$index + 7],
        'INN' => trim($row[$index + 8]),
        'INSURANCE' => preg_replace('/[^0-9]/', '', trim($row[$index + 9])),
        'PASSPORT_fullNumber' => preg_replace('/[^0-9]/', '', trim($row[$index + 10])),
        'PASSPORT_PLACE' => trim($row[$index + 11]),
        'PASSPORT_NUM' => trim($row[$index + 12]),
        'PASSPORT_SERIA' => trim($row[$index + 13]),
        'PASSPORT_DATERECV' => date('Y-m-d', strtotime($row[$index + 14])), // $row[$index + 14]
        'PASSPORT_KODPODRAZD' => trim($row[$index + 15]),
        'Number' => is_numeric(preg_replace('/[^0-9]/', '', trim($row[$index + 12]))) ? preg_replace('/[^0-9]/', '', trim($row[$index + 12])).'-'.preg_replace('/[^0-9]/', '', trim($row[$index + 13])) : '',
        'REG_ADDRES' => trim($row[$index + 16]),
        'REAL_ADDRES' => trim($row[$index + 17]),
        'HOMEPHONE' => trim($row[$index + 18]),
        'WORKPHONE' => trim($row[$index + 19]),
        'DATE_INS' => $row[$index + 20],
        'DATE_UPD' => $row[$index + 21],

        'VOENIK_NUMBER' => trim($row[$index + 22]),
        'WUS' => trim($row[$index + 23]),
        'WUS_DATEUPD' => $row[$index + 24],
        'CAT_ZAPAS' => trim($row[$index + 25]),
        'ZVANIE' => trim($row[$index + 26]),
        'GODNOST' => trim($row[$index + 27]),
        'KOMMISARIAT' => trim($row[$index + 28]),
        
        'BRAK' => trim($row[$index + 29]),
      );
    } 
  } 
}

