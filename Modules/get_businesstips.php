<?php 
include 'Variables\\config.php';
// Командировки

// подключаем sql запрос
include 'Sql_requests\\sql_get_businesstips.php';

$stmt = create_stmt($conn, $sql_businesstips);

$businesstips_array = array();
$items = array('O_HMEN01_ID', 'REGION_COD');
$sub_array_name = 'businesstips_array';
$sub_items = array('businesstip_id', 'businesstip_PLACE', 'businesstip_REASON', 'businesstip_BEGIN', 'businesstip_FINISH', 'businesstip_DOC_NUM', 'businesstip_DOC_DATE', 'DOC_ID', 'DOC_NAME', 'DOC_NUM', 'DOC_DATE');

while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC)) {
  fetching($row, 0, $businesstips_array, $items, $sub_items, $sub_array_name);
}

file_put_contents($main_path . '\Json_returns\2024\employees\employee_businesstips_array.json', json_encode($businesstips_array));