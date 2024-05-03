<?php
include 'Variables\\config.php';
// Аттестации

// подключаем sql запрос
include 'Sql_requests\\sql_get_attestation.php';

$stmt = create_stmt($conn, $sql_attestation);

$attestation_array = array();
$items = array('O_HMEN01_ID', 'REGION_COD');
$sub_array_name = 'attestation_array';
$sub_items = array('attestation_id', 'COMMISSION_DECISION_CODE', 'COMMISSION_DECISION', 'ATTESTATION_DATE', 'doc_id', 'DOC_NAME', 'PROTOCOL_NUM', 'POTOCOL_DATE', 'PROTOCOL_ID', 'PROTOCOL_NAME');

while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC)) {
  fetching($row, 0, $attestation_array, $items, $sub_items, $sub_array_name);
}

file_put_contents($main_path . '\Json_returns\2024\employees\employee_attestation_array.json', json_encode($attestation_array));