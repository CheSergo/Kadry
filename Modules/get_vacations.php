<?php
include 'Variables\\config.php';
// Отпуска

// подключаем sql запрос
include 'Sql_requests\\sql_get_vacations.php';
include 'Sql_requests\\sql_get_vacations2.php';

$stmt = create_stmt($conn, $sql_vacations);

$vacations_array = array();
$items = array('O_HMEN01_ID', 'REGION_COD');
$sub_array_name = 'vacations_array';
$sub_items = array('vacation_ID', 'DATEBEGIN', 'DATEFINISH', 'USEBDAYCAL', 'USEADAYRAB', 'DATE', 'DATEFACTFINISH');
$rebuild_vacations_array = array();

while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC)) {
  fetching($row, 0, $vacations_array, $items, $sub_items, $sub_array_name);
}

foreach( $vacations_array as $id => $worker_arr ) {
  foreach( $worker_arr['vacations_array'] as $key => $vacation ) {
    $rebuild_vacations_array[$id]['vacations_array'][$vacation['DATEBEGIN']]['word_period_begin'] = $vacation['DATEBEGIN'];
    $rebuild_vacations_array[$id]['vacations_array'][$vacation['DATEBEGIN']]['word_period_finish'] = $vacation['DATEFINISH'];
    $rebuild_vacations_array[$id]['vacations_array'][$vacation['DATEBEGIN']][$vacation['DATE']] = $vacation; 
    ksort($rebuild_vacations_array[$id]['vacations_array'][$vacation['DATEBEGIN']]);
  }
  ksort($rebuild_vacations_array[$id]['vacations_array']);
}

file_put_contents($main_path . '\Json_returns\2024\employees\employee_vacations_array.json', json_encode($rebuild_vacations_array));
// file_put_contents('C:\xampp\htdocs\phpKadry\employee\employee_vacations_rebuild_array.json', json_encode($rebuild_vacations_array));

// Отпкуска2 
$stmt = create_stmt($conn, $sql_vacations2);

$vacations2_array = array();
$items = array('O_HMEN01_ID', 'REGION_COD');
$sub_array_name = 'vacations2_array';
$sub_items = array('vacation2_ID', 'NAME', 'DATEBEGIN', 'DATEFINISH');
$rebuild_vacations2_array = array();

while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC)) {
  fetching($row, 0, $vacations2_array, $items, $sub_items, $sub_array_name);
}

foreach( $vacations2_array as $id => $worker_arr ) {
  foreach( $worker_arr['vacations2_array'] as $key => $vacation ) {
    $rebuild_vacations2_array[$id]['vacations2_array'][$vacation['DATEBEGIN']] = $vacation; 
    ksort($rebuild_vacations2_array[$id]['vacations2_array'][$vacation['DATEBEGIN']]);
  }
  ksort($rebuild_vacations2_array[$id]['vacations2_array']);
}

file_put_contents($main_path . '\Json_returns\2024\employees\employee_vacations2_array.json', json_encode($rebuild_vacations2_array));

