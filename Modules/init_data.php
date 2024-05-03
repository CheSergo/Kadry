<?php
include 'Variables\\config.php';
include 'Sql_requests\\sql_get_first_data.php';

$stmt = create_stmt($conn, $sql_first_date);

// Запрос Первоначальный данных
while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC)) {
  init_data_fetch($row, 0, $all_data);
}

file_put_contents($main_path . '\Json_returns\2024\employees\employee_firstData_array.json', json_encode($all_data));