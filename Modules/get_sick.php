<?php
include 'Variables\\config.php';
// подключаем sql запрос
include 'Sql_requests\\sql_get_sick.php';
include 'Sql_requests\\sql_get_sickpregnant.php';

// Больничные листы
$stmt = create_stmt($conn, $sql_sick);

$sick_array = array();
$items = array('O_HMEN01_ID', 'REGION_COD');
$sub_array_name = 'sick_array';
$sub_items = array('SICK_ID', 'SICK_NUM', 'SICK_BEGIN', 'SICK_END', 'SICK_DATEGIVEN', 'SICK_CODE');

while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC)) {
  fetching($row, 0, $sick_array, $items, $sub_items, $sub_array_name);
}

file_put_contents($main_path . '\Json_returns\2024\employees\employee_sick_array.json', json_encode($sick_array));

// Больничные листы (откуска по беременности)
$stmt = create_stmt($conn, $sql_sickpregnant);

$sickpregnant_array = array();
$items = array('O_HMEN01_ID', 'REGION_COD');
$sub_array_name = 'sickpregnant_array';
$sub_items = array('sickpregnant_ID', 'NAME', 'DATEBEGIN', 'DATEFINISH', 'DOC_ID', 'DOC_NAME', 'DOC_NUM', 'DOC_DATE');

while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC)) {
  fetching($row, 0, $sickpregnant_array, $items, $sub_items, $sub_array_name);
}

file_put_contents($main_path . '\Json_returns\2024\employees\employee_sickpregnant_array.json', json_encode($sickpregnant_array));