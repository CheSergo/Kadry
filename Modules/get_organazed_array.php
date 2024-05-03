<?php
include 'Variables\\config.php';
// Запрос на ID организаций

// подключаем sql запрос
include 'Sql_requests\\sql_get_workers_id.php';

$stmt = create_stmt($conn, $sql_workers);

$organized_array = array();
// $items = array('O_HMEN01_ID', 'REGION_COD', 'FSTNAME', 'FAMILY', 'LSTNAME', 'SRT_ID', 'DATEFINISH', 'NAME', 'NODE_PAR');
// , 'PARENT_1', 'SRT_2', 'PARENT_2', 'SRT_3', 'PARENT_3', 'SRT_4', 'PARENT_4', 'SRT_5');
// $items = array('O_HMEN01_ID', 'REGION_COD', 'PARENT_ID');

// $sub_array_name = 'rodstv_array';
// $sub_items = array('rodstvennik_id', 'RODSTV_FIO', 'RODSTV_DATE_INS', 'RODSTV_BIRTHDATE', 'TIP_RODSTVA');

while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC)) {
  if (isset($row[1]) && !is_null($row[0])) {
    $key = $row[1]."_".$row[0];
    $no_null = array_filter($row);
    if ( !array_key_exists($key, $organized_array) ) {
      $organized_array[$key] = array(
        'CODE' => $row[1]."_".$row[0],
        'O_HMEN01_ID' => $row[0],
        'REGION_COD' => $row[1],
        'SRT_ID' => $row[5],
        'ORGANIZATION_ID' => $row[1]."_".end($no_null),
      );
    } 
  } 
}

file_put_contents($main_path . '\Json_returns\2024\employees\employee_organized_array.json', json_encode($organized_array));

unset($stmt);
unset($organized_array);
echo "Выгрузка ID организаций завершена";
sleep(3);