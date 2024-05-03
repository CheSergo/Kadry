<?php
include 'Variables\\config.php';
// Запрос на чины
// подключаем sql запрос
include 'Sql_requests\\sql_get_chins.php';

$stmt = create_stmt($conn, $sql_chins);

$chins_array = array();
$items = array('O_HMEN01_ID', 'REGION_COD');
$sub_array_name = 'chins_array';
$sub_items = array('chin_id', 'CODE_ID', 'CHIN_DATE_START', 'CHIN_DATE_END', 'CHIN_ORDERDATE', 'CHIN_PRIKAZ', 'CHIN_NAME');

while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC)) {
  fetching($row, 0, $chins_array, $items, $sub_items, $sub_array_name);
}

file_put_contents($main_path . '\Json_returns\2024\employees\employee_chins_array.json', json_encode($chins_array));

unset($stmt);
unset($chins_array);
echo "\n"."=============================================";
echo "\n"."========="." Выгрузка чинов закончена "."=========";
echo "\n"."=============================================";
sleep(3);
