<?php
include 'Variables\\config.php';
// Заппрос на стажи

// подключаем sql запрос
include 'Sql_requests\\sql_get_staj.php';

$stmt = create_stmt($conn, $sql_staj);

$staj_array = array();
$items = array('O_HMEN01_ID', 'REGION_COD');
$sub_array_name = 'staj_array';
$sub_items = array('STAJ_id', 'STAJ_ORGANIZATION', 'STAJ_DOLJNOST', 'STAJ_BEGIN', 'STAJ_END', 'doc_name', 'doc_num', 'doc_date', 'trud_name', 'trud_number', 'trud_date', 'OSNOVANIE_TYPE', 'OSNOVANIE_CODE');
$third_level_name = 'staj_types';
$third_level = array('type_id', 'STAJ_TYPE', 'COEFFICIENT');

while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC)) {
  fetching($row, 0, $staj_array, $items, $sub_items, $sub_array_name, $third_level, $third_level_name, $staj = true);
}

file_put_contents($main_path . '\Json_returns\2024\employees\employee_staj_array.json', json_encode($staj_array));