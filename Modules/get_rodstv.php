<?php
include 'Variables\\config.php';
// Запрос на родственников

// подключаем sql запрос
include 'Sql_requests\\sql_get_rodstv.php';

$stmt = create_stmt($conn, $sql_get_rodstv);

$rodstv_array = array();
$items = array('O_HMEN01_ID', 'REGION_COD');
$sub_array_name = 'rodstv_array';
$sub_items = array('rodstvennik_id', 'RODSTV_FIO', 'RODSTV_DATE_INS', 'RODSTV_BIRTHDATE', 'TIP_RODSTVA');

while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC)) {
  fetching($row, 0, $rodstv_array, $items, $sub_items, $sub_array_name);
}

file_put_contents($main_path . '\Json_returns\2024\employees\employee_rodstvenniki_array.json', json_encode($rodstv_array));