<?php
include 'Variables\\config.php';
// подключаем sql запрос
include 'Sql_requests\\sql_get_addedu.php';
include 'Sql_requests\\sql_get_addedu2.php';

// Дополнительное образование
$stmt = create_stmt($conn, $sql_addedu);

$addedu_array = array();
$items = array('O_HMEN01_ID', 'REGION_COD');
$sub_array_name = 'addedu_array';
$sub_items = array('addedu_ID', 'M_EDU_06_ID', 'ORG', 'EDUPROG', 'DATEBEGIN', 'DATEFINISH', 'HOURS');

while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC)) {
  fetching($row, 0, $addedu_array, $items, $sub_items, $sub_array_name);
}

file_put_contents($main_path . '\Json_returns\2024\employees\employee_addedu_array.json', json_encode($addedu_array));

// // Дополнительное образование 2
$stmt = create_stmt($conn, $sql_addedu2);

$addedu2_array = array();
$items = array('O_HMEN01_ID', 'REGION_COD');
$sub_array_name = 'addedu2_array';
$sub_items = array('addedu2_ID', 'M_EDU_06_ID', 'ORG', 'SPECIAL', 'DATEBEGIN', 'DATEFINISH');

while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC)) {
  fetching($row, 0, $addedu2_array, $items, $sub_items, $sub_array_name);
}

file_put_contents($main_path . '\Json_returns\2024\employees\employee_addedu2_array.json', json_encode($addedu2_array));