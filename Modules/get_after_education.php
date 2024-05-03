<?php
include 'Variables\\config.php';
// подключаем sql запрос
include 'Sql_requests\\sql_get_after_education.php';

// Послевузовское образование
$stmt = create_stmt($conn, $sql_after_education);

$after_education_array = array();
$items = array('O_HMEN01_ID', 'REGION_COD');
$sub_array_name = 'after_education_array';
$sub_items = array('AFTER_EDU_ID', 'AFTER_DEGREECODE', 'AFTER_EDU_SPEC', 'AFTER_EDU_DATE', 'AFTER_EDU_ZVANIE');

while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC)) {
  fetching($row, 0, $after_education_array, $items, $sub_items, $sub_array_name);
}

file_put_contents($main_path . '\Json_returns\2024\employees\employee_after_education_array.json', json_encode($after_education_array));