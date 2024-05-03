<?php
include 'Variables\\config.php';
// Запрос на Контрактов

// подключаем sql запрос
include 'Sql_requests\\sql_get_contracts.php';

$stmt = create_stmt($conn, $sql_contracts);

$contracts_array = array();
$items = array('O_HMEN01_ID', 'REGION_COD');

$sub_array_name = 'contracts_array';
$sub_items = array('contract_id', 'CONTRACT_TYPE', 'CONTRACT_BEGIN', 'CONTRACT_END', 'SRT_ID', 'STAVKA', 'STAVKA_BEGIN', 'trud_name', 'trud_number', 'trud_date', 'M_ORD_02_ID', 'WFL_DATEFINISH', 'FIRED_ID', 'REESTR_FULLNAME');

while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC)) {
  fetching($row, 0, $contracts_array, $items, $sub_items, $sub_array_name);
}

file_put_contents($main_path . '\Json_returns\2024\employees\employee_init_contracts_array.json', json_encode($contracts_array));