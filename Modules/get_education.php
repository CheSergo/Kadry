<?php
include 'Variables\\config.php';
// Запрос на Образование

// подключаем sql запрос
include 'Sql_requests\\sql_get_education.php';

$stmt = create_stmt($conn, $sql_education);

$education_array = array();
$items = array('O_HMEN01_ID', 'REGION_COD');

$sub_array_name = 'education_array';
$sub_items = array('education_id', 'EDUCATION_LEVEL', 'EDUCATION_ORGANIZATION', 'EDUCATION_SPECIAL', 'EDUCATION_BEGIN', 'EDUCATION_FINISH', 'EDUCATION_DOC_SER', 'EDUCATION_DOC_NUMB', 'EDUCATION_DOC_DATE', 'Qualification', 'OKSO_COD');

while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC)) {
  fetching($row, 0, $education_array, $items, $sub_items, $sub_array_name);
}

file_put_contents($main_path . '\Json_returns\2024\employees\employee_education_array.json', json_encode($education_array));