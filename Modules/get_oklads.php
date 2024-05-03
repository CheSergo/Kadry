<?php
include 'Variables\\config.php';
// Запрос ОКЛАДОВ на занимаемых должностях на ГОССЛУЖБЕ

// подключаем sql запрос
include 'Sql_requests\\sql_get_oklads.php';

$stmt = create_stmt($conn, $sql_oklads);

$oklads_array = array();
$items = array('O_HMEN01_ID', 'REGION_COD');

$sub_array_name = 'oklads_array';
$sub_items = array('oklad_id', 'SRT_ID', 'RAZMER_OKLADA', 'BEGIN_OKLAD', 'FINISH_OKLAD');

while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC)) {
  fetching($row, 0, $oklads_array, $items, $sub_items, $sub_array_name);
}

file_put_contents($main_path . '\Json_returns\2024\employees\employee_oklads_array.json', json_encode($oklads_array));