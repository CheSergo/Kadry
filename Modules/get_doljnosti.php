<?php
include 'Variables\\config.php';
// Запрос занимаемых должностей на ГОССЛУЖБЕ

// подключаем sql запрос
include 'Sql_requests\\sql_get_doljnosti.php';

$stmt = create_stmt($conn, $sql_doljnosti);

$doljnosti_array = array();
$items = array('O_HMEN01_ID', 'REGION_COD');

$sub_array_name = 'doljnosti_array';
$sub_items = array('execpost_id', 'SRT_ID', 'STAVKA', 'STAVKA_BEGIN', 'STAVKA_END', 'STAJ_BEGIN', 'STAJ_END', 'OSNOVANIE_TYPE', 'Appointment_Reason', 'PRIEM_PRIKAZ_NAME', 'PRIEM_PRIKAZ_NUM', 'PRIEM_PRIKAZ_DATE', 'RETIRE_TYPE', 'RETIRE_CODE', 'RETIRE_PRIKAZ_NAME', 'RETIRE_PRIKAZ_NUM', 'RETIRE_PRIKAZ_DATE');

while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC)) {
  fetching($row, 0, $doljnosti_array, $items, $sub_items, $sub_array_name, null, null, $index_to_inspect = 9);
}

file_put_contents($main_path . '\Json_returns\2024\employees\employee_doljnosti_array.json', json_encode($doljnosti_array));

unset($stmt);
unset($doljnosti_array);
echo "\n"."=============================================";
echo "\n"."====="."Выгрузка должностей закончена"."=====";
echo "\n"."=============================================";
sleep(3);